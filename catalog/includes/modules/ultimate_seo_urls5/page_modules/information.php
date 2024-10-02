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
 * Page module for information pages.
 */
class information extends page_modules
{
    /**
     * Array of _GET key dependencies for this page
     * - marker is the seo url replacement for the dependent _GET key ( e.g. -c- replaces cPath )
     * - query is the query used to extract the link text from the database
     * - to_replace is an array of texts that are to be replace with real values in the query.
     *
     * @example protected $dependencies = array( 'cPath' => array( 'marker'     => '-c-',
     */
    protected array $dependencies = ['info_id' => ['marker' => '-i-',
        'query' => "SELECT information_title FROM :TABLE_INFORMATION WHERE information_id=':info_id' AND language_id=':languages_id' LIMIT 1",
        'to_replace' => [':TABLE_INFORMATION', ':info_id', ':languages_id']]];

    /**
     * The current dependency key extracted from the incoming parameters.
     *
     * @var string - dependency key
     */
    protected string $key = '';

    /**
     * extracts the key => value pairs from the querystring in order to build a unique cache name for the loaded page.
     */
    protected array $cache_name_builder = ['info_id' => 1]; // xxx = _GET key ( e.g. cPath ), you may want to add "page" if there are paging functions
    private static $_singleton;
    /**
     * Class constructor.
     */
    private function __construct()
    {
    } // end constructor
    /**
     * Returns a singleton instance of this object.
     *
     * @return Information_Page_Module
     */
    public static function i()
    {
        if (!self::$_singleton instanceof self) {
            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Retrieve the dependencies array for this page module.
     *
     * @return array $dependencies
     */
    public function retrieveDependencies()
    {
        return $this->dependencies;
    }
    /**
     * The main method of this class that receives input needed to build a link
     * then finally returns a fully built seo link if it has not previousluy returned false.
     *
     * @see Usu_Main::getVar()
     * @see Usu_Main::setVar()
     * @see page_modules::stripPathToLastNumber()
     * @see page_modules::setQuery()
     * @see page_modules::unsetProperties()
     * @see page_modules::getDependencyKey()
     * @see page_modules::setAllParams()
     * @see page_modules::validRequest()
     * @see page_modules::returnFinalLink()
     *
     * @uses trigger_error()
     *
     * @param string $page           - valid osCommerce page name
     * @param string $parameters     - querystring parameters
     * @param bool   $add_session_id - true / false
     * @param string $connection     - NONSSL / SSL
     *
     * @throws - triggers an error of type E_USER_WARNING for an incorrect or inexistant dependency key
     *
     * @return bool   false - forces the system to return the standard osCommerce link wrapper
     * @return string - fully built seo url
     */
    public function buildLink($page, $parameters, $add_session_id, $connection)
    {
        $extract = ['info_id'];
        $this->setAllParams($page, $parameters, $add_session_id, $connection, $extract);

        if (false === $this->validRequest()) {
            $this->unsetProperties();

            return false;
        }

        $this->key = $this->getDependencyKey();

        /**
         * If the shop has issues it may pass in null values, in this case return false to force the standard osCommerce link wrapper.
         */
        if (!\array_key_exists($this->key, $this->keys_index) || !tep_not_null($this->keys_index[$this->key])) {
            return false;
        }

        // Switch statement where the correct query and query marker replacements to use are selected via the _GET key detected
        switch (true) {
            case $this->key === 'info_id': // xxx = _GET key ( e.g. cPath )
                // This array contains replacements for the to_replace array ( see the $dependencies array )
                $this->setQuery([TABLE_INFORMATION, $this->stripPathToLastNumber($this->keys_index[$this->key]), Usu_Main::i()->getVar('languages_id')]);

                break;

            default:
                trigger_error(__CLASS__.'::'.__FUNCTION__.' Incorrect or inexistant dependency key.', \E_USER_WARNING);

                break;
        }

 // end switch
        $link_text = $this->acquireLinkText();
        // If the query returned false then we return nothing and set $page_not_found to true forcing a 404 page
        Usu_Main::i()->setVar('page_not_found', false);

        if (false === $link_text) {
            Usu_Main::i()->setVar('page_not_found', true);
            $this->unsetProperties();

            return;
        }

        // Return a fully built seo url
        return $this->returnFinalLink(Usu_Main::i()
            ->getVar('uri_modules', USU5_URLS_TYPE)
            ->createLinkString($this->page, Usu_Main::i()
                ->getVar('uri_modules', USU5_URLS_TYPE)
                ->separateUriText($this->linktext($link_text)), $this->dependencies[$this->key]['marker'], $this->keys_index[$this->key]));
    } // end method
    /**
     * Acquire an array of single or multiple link texts from the query
     * this will be cached for later retrieval.
     *
     * @see Usu_Main::query()
     *
     * @uses trim()
     *
     * @return array array of link test
     */
    protected function acquireLinkText()
    {
        $result = Usu_Main::i()->query($this->query);
        $text_array = tep_db_fetch_array($result);
        tep_db_free_result($result);

        if (false === $text_array) {
            return false;
        }

        $final_text_array = [];

        foreach ($text_array as $key => $text) {
            if (tep_not_null(trim((string) $text))) {
                $final_text_array[$key] = $text;
            }
        }

        // We will cache this result
        return $final_text_array;
    }
} // end class
