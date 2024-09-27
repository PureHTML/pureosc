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
 * Simple uri redirects.
 *
 * @see includes/uri_redirects_array.php
 */
final class uri_redirects_class
{
    private static $_singleton;
    private static $redirects = [];
    /**
     * Class constructor.
     */
    private function __construct()
    {
    } // end constructor
    /**
     * Class destructor.
     */
    public function __destruct()
    {
    } // end destructor
    /**
     * Returns a singleton instance of Uri_Redirects.
     *
     * @uses is_array()
     *
     * @return Uri_Redirects
     */
    public static function i()
    {
        if (!self::$_singleton instanceof Uri_Redirects) {
            include_once Usu_Main::i()->getVar('includes_path').'uri_redirects_array.php';

            if (isset($usu5_uri_redirects) && \is_array($usu5_uri_redirects) && !empty($usu5_uri_redirects)) {
                self::$redirects = $usu5_uri_redirects;
            }

            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Iterates the redirects array returning the uri to redirect to if a match is found.
     *
     * @uses htmlspecialchars_decode()
     *
     * @return mixed - bool false / string redirection url
     */
    public function needsRedirect()
    {
        if (!empty(self::$redirects)) {
            foreach (self::$redirects as $target => $uri_data) {
                if (Usu_Main::i()->getVar('request_uri') === $target) {
                    return htmlspecialchars_decode(tep_href_link($uri_data[0], $uri_data[1]));
                }
            }
        }

        return false;
    }
} // end class
