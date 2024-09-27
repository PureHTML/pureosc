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
 * Path rewrite uri modiule.
 *
 * @example something-here/my-great-product-p-47
 */
class path_rewrite extends aUri_Modules
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
    } // end constructor
    /**
     * Add the base file name to the uri.
     */
    public function addFilename()
    {
        return '';
    }
    /**
     * Create the uri link string for this module.
     *
     * @param string $page      - base file name
     * @param string $text      - uri link text
     * @param string $seperator - e.g. -p- or -c- etc.
     * @param string $value     - integer or string if a path like 44_22_2
     *
     * @see includes/usu_general_functions.php usu5_multi_language()
     *
     * @return string - uri link string
     */
    public function createLinkString($page, $text, $seperator, $value)
    {
        return usu5_multi_language($separator = 'right').$text.$seperator.$value.'.html';
    } // end method
    /**
     * Seperate the products test.
     *
     * products text can be made up of category model products name
     *
     * @uses rtrim()
     *
     * @param mixed $array
     *
     * @return string - link text separated by /
     */
    public function separateUriText($array)
    {
        $return = '';

        foreach ($array as $index => $text) {
            $return .= $text.'/';
        }

        return rtrim($return, '/');
    } // end method
    /**
     * Ensure the difference between this uri class and all the other uri classes
     * Marker validity is checked later.
     *
     * @uses strpos()
     * @uses substr()
     *
     * @see aUri_Modules::withoutLanguage()
     * @see Usu_Main::getvar()
     *
     * @return bool - true ( not identified as another uri type ) false ( identified as a different uri type )
     */
    public function isValidUri()
    {
        $dependencies = Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()->getVar('filename'), 0, -4))->retrieveDependencies();
        $validated = false;

        foreach ($dependencies as $dep => $dummy) {
            // osC experimental urls
            if (false !== strpos(Usu_Main::i()->getVar('request_uri'), $dep.'/')) {
                return false;
            }
        }

        if (false === strpos(Usu_Main::i()->getVar('request_uri'), '.html')) { // path_rewrite seo url must have .html
            return false;
        }

        // Is a path based uri
        if (false === strpos(Usu_Main::i()->getVar('request_uri'), '/')) { // path_rewrite seo url must have a / in the uri
            return false;
        }

        return __CLASS__;
    } // end method
    /**
     * Parse the path into superglobal _GET and long array HTTP_GET_VARS.
     *
     * @uses explode()
     * @uses http_build_query()
     * @uses str_replace()
     * @uses strpos()
     * @uses substr()
     *
     * @return mixed - bool false / string key=value
     */
    public function parsePath()
    {
        global $HTTP_GET_VARS;
        Usu_Main::i()->setVar('parsing_module', __CLASS__);
        $dependencies = Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()->getVar('filename'), 0, -4))->retrieveDependencies();

        foreach ($dependencies as $get_key => $detail) {
            if (false !== strpos(Usu_Main::i()->getVar('request_uri'), $detail['marker'])) {
                // Found an seo marker so explode into two component parts
                $tmp = explode($detail['marker'], Usu_Main::i()->getVar('request_uri'));
                // assign the key=>value pair to _GET
                $value = (false !== strpos($tmp[1], '.html')) ? usu_cleanse(str_replace('.html', '', $tmp[1])) : usu_cleanse($tmp[1]);
                $_GET[$get_key] = $value;
                $HTTP_GET_VARS[$get_key] = $value;
                Usu_Main::i()->setVar('request_querystring', http_build_query($_GET));

                return $get_key.'='.$value;
            }
        }

        return false;
    } // end method
} // End class