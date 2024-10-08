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
 * Module for the osCommerce experimental urls.
 */
class osc_experimental
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    } // end constructor
    /**
     * Strip an seo uri.
     *
     * @param string $fulluri - uri to be stripped
     *
     * @return bool false
     */
    public function stripSeoUri($fulluri)
    {
        return false;
    } // end method
    /**
     * Ensure the difference between this uri class and all the other uri classes.
     * Marker validity is checked later.
     *
     * @uses strpos()
     * @uses substr()
     *
     * @return bool - true ( not identified as another uri type ) false ( identified as a different uri type )
     */
    public function isValidUri()
    {
        // Check for an seo url marker, if there it is not an experimental uri
        $dependencies = Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()->getVar('filename'), 0, -4))->retrieveDependencies();

        foreach ($dependencies as $dep => $dummy) {
            if (false !== strpos(Usu_Main::i()->getVar('request_uri'), $dependencies[$dep]['marker'])) {
                return false;
            }
        }

        if (false !== strpos(Usu_Main::i()->getVar('request_uri'), '.html')) { // uri should not have .html
            return false;
        }

        if (false === strpos(Usu_Main::i()->getVar('request_uri'), '/')) { // uri must have / in the uri
            return false;
        }

        return __CLASS__;
    } // end method
    /**
     * Break up an osC experimental seo url into an _GET query
     * Add the key => value pairs to _GET and $HTTP_GET_VARS.
     *
     * @uses count()
     * @uses explode()
     * @uses http_build_query(
     *
     * @see Usu_Main::setVar()
     * @see Usu_Main::getVar()
     * @see includes/usu_general_functions.php usu_cleanse()
     *
     * @return string - querystring
     */
    public function parsePath()
    {
        global $HTTP_GET_VARS;
        Usu_Main::i()->setVar('parsing_module', __CLASS__);
        $tmp = explode('/', Usu_Main::i()->getVar('request_uri'));
        $count = \count($tmp);

        for ($i = 0; $i < $count; $i += 2) {
            $newget[usu_cleanse($tmp[$i])] = usu_cleanse($tmp[$i + 1]);
            // assign cleansed key=>value pair to _GET
            $_GET[usu_cleanse($tmp[$i])] = usu_cleanse($tmp[$i + 1]);
            $HTTP_GET_VARS[usu_cleanse($tmp[$i])] = usu_cleanse($tmp[$i + 1]);
        }

        Usu_Main::i()->setVar('request_querystring', http_build_query($_GET));

        // Newly created _GET array added to the querystring and converted to _GET string
        return http_build_query($newget);
    } // End method
} // End class
