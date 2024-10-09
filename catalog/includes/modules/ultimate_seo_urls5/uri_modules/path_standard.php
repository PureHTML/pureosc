<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Path standard uri modiule.
 *
 * @example product_info.php/something-here/my-great-product-p-47
 */
class path_standard extends uri_modules
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
    } // end constructor
    /**
     * Add the base file name to the uri.
     *
     * @return string - file name/
     */
    public function addFilename()
    {
        return usu::$basename.'/';
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
        return $page.'/'.usu5_multi_language($separator = 'right').$text.$seperator.$value;
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
     * @return bool - true ( not identified as another uri type ) false ( identified as a different uri type )
     */
    public function isValidUri()
    {
        $dependencies = usu5::i()->getVar('page_modules', substr(usu5::i()->getVar('filename'), 0, -4))->retrieveDependencies();
        $validated = false;

        foreach ($dependencies as $dep => $dummy) {
            // osC experimental urls
            if (false !== strpos(usu5::i()->getVar('request_uri'), $dep.'/')) {
                return false;
            }
        }

        // Not a rewrite uri
        if (false !== strpos(usu5::i()->getVar('request_uri'), '.html')) { // path_standard seo url does not have .html
            return false;
        }

        // Is a path based uri
        if (false === strpos(usu5::i()->getVar('request_uri'), '/')) { // path_standard seo url must have a / in the uri
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
        usu5::i()->setVar('parsing_module', __CLASS__);
        $dependencies = usu5::i()->getVar('page_modules', substr(usu5::i()->getVar('filename'), 0, -4))->retrieveDependencies();

        foreach ($dependencies as $get_key => $detail) {
            if (false !== strpos(usu5::i()->getVar('request_uri'), $detail['marker'])) {
                // Found an seo marker so explode into two component parts
                $tmp = explode($detail['marker'], usu5::i()->getVar('request_uri'));
                // assign the key=>value pair to _GET
                $value = (false !== strpos($tmp[1], '.html')) ? usu_cleanse(str_replace('.html', '', $tmp[1])) : usu_cleanse($tmp[1]);
                $_GET[$get_key] = $value;
                $HTTP_GET_VARS[$get_key] = $value;
                usu5::i()->setVar('request_querystring', http_build_query($_GET));

                return $get_key.'='.$value;
            }
        }

        return false;
    } // end method
} // End class
