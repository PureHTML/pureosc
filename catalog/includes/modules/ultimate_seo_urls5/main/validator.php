<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Validation and redirection of seo urls.
 */
final class validator
{
    private static $_singleton;
    private $current_seo_marker;

    /**
     * Constructor.
     */
    private function __construct()
    {
    } // end constructor
    /**
     * Destructor.
     */
    public function __destruct()
    {
    } // end destructor
    /**
     * Return a singleton instance of the class.
     *
     * @return Usu_Validator
     */
    public static function i()
    {
        if (!self::$_singleton instanceof Usu_Validator) {
            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Initial validation checks.
     *
     * Do we have a page module for the request? If not return false allowing the standard osCommerce link wrapper to take over.
     * Is it an seo url request? If not return false allowing the standard osCommerce link wrapper to take over.
     *
     * @see Usu_Main::getVar()
     * @see Usu_Validator::isSeoUrlRequest()
     * @see Usu_Validator::homePageRedirect()
     * @see Usu_Validator::validate()
     *
     * @uses is_readable()
     *
     * @return mixed - bool false / void
     */
    public function initiate()
    {
        // Confirm we have a page module if not return false
        if (false === is_readable(Usu_Main::i()->getVar('page_modules_path').Usu_Main::i()->getVar('filename'))) {
            return false; // This means that the request will not be handled by USU5
        }

        if (false === $this->isSeoUrlRequest()) {
            $this->homePageRedirect(); // If it's not an seo url request we can action the index.php redirect

            return false; // This means that the request will not be handled by USU5
        }

        $this->validate();
    } // end method
    /**
     * Checks if a valid seo url request.
     *
     * @uses array_key_exists()
     * @uses strpos()
     * @uses substr()
     *
     * @see Usu_Main::getVar()
     *
     * @return bool $validated
     */
    private function isSeoUrlRequest()
    {
        $dependencies = Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()->getVar('filename'), 0, -4))->retrieveDependencies();
        $validated = false;

        // Check if a dependency can be found in the superglobal _GET array
        foreach ($dependencies as $dep => $dummy) {
            if (false !== \array_key_exists($dep, $_GET)) {
                $validated = true;
            }

            // Check for osC experimental urls
            if (false !== strpos(Usu_Main::i()->getVar('request_uri'), $dep.'/')) {
                $validated = true;
            }

            // Check if an seo marker can be found in the uri
            if (false !== strpos(Usu_Main::i()->getVar('request_uri'), $dependencies[$dep]['marker'])) {
                $this->current_seo_marker = $dependencies[$dep]['marker'];
                $validated = true;
            }
        }

        return $validated;
    } // end method
    /**
     * 1) Compares request uri against a fresh seo url for validity and 301 redirects if not matching
     * 2) Shows a 404 page if the page cannot be found.
     *
     * @see Usu_Validator::pageNotFound()
     * @see includes/notfound_404.php
     * @see Usu_Main::setVar()
     * @see Usu_Main::getVar()
     * @see includes/usu_general_functions.php -  remove_session_id()
     * @see Usu_Validator::redirect()
     *
     * @uses htmlspecialchars_decode()
     * @uses str_replace()
     */
    private function validate(): void
    {
        // Get the incoming seo uri minus the session id
        Usu_Main::i()->setVar('request_compare_in', remove_session_id(htmlspecialchars_decode(Usu_Main::i()->getVar('original_request_uri'))));
        // Get a brand new url based on the querystring
        $new_url = htmlspecialchars_decode(tep_href_link(Usu_Main::i()->getVar('filename'), Usu_Main::i()->getVar('request_querystring')));
        // Strip the new url of domain name and session id to arrive at a comparible uri
        Usu_Main::i()->setVar('request_compare_new', remove_session_id(str_replace([HTTPS_SERVER, HTTP_SERVER], '', $new_url)));

        /**
         * If $page_not_found has been set to bool true then the page module returned a result of bool false from the database
         * this means that the product/category etc does not exist so we need to show 404 headers and page.
         */
        if (false !== Usu_Main::i()->getVar('page_not_found')) {
            $this->pageNotFound();
        }

        // If the incoming uri and the newly created uri do not match then we need to 301 redirect to the new.
        if (Usu_Main::i()->getVar('request_compare_in') !== Usu_Main::i()->getVar('request_compare_new')) {
            $this->redirect($new_url);
        }
    } // end method
    /**
     * The page does not exist so we will show our custom 404 error page and header.
     *
     * @see Usu_Main::getVar()
     * @see Uri_Redirects::needsRedirect()
     * @see Usu_Validator::redirect()
     *
     * @uses exit()
     * @uses header()
     * @uses session_write_close()
     */
    private function pageNotFound(): void
    {
        include_once Usu_Main::i()->getVar('includes_path').'uri_redirects_class.php';

        if (false !== ($url = Uri_Redirects::i()->needsRedirect())) {
            $this->redirect($url);
        }

        session_write_close();
        header('HTTP/1.0 404 Not Found');

        include_once Usu_Main::i()->getVar('includes_path').'notfound_404.php';

        exit;
    }
    /**
     * Action a 301 redirect for an seo url request that didn't match a fresh request.
     *
     * @uses exit()
     * @uses header()
     * @uses session_write_close()
     *
     * @param mixed $url
     */
    private function redirect($url): void
    {
        // write/close the session before redirect
        session_write_close();
        header('HTTP/1.0 301 Moved Permanently');
        header('Location: '.$url);

        // always exit after an "attempted" redirect to stop the script "falling through"
        exit;
    } // End method
    /**
     * Force www.mysite.com/index.php to 301 redirect to www.mysite.com/.
     *
     * @uses htmlspecialchars_decode()
     * @uses str_replace()
     *
     * @return mixed - bool false / void
     */
    private function homePageRedirect()
    {
        if (false !== do_homepage_redirect()) {
            $this->redirect(str_replace(FILENAME_DEFAULT, '', htmlspecialchars_decode(tep_href_link(FILENAME_DEFAULT))));
        }

        return false;
    } // end method;
} // end class
