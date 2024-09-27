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
 * Abstract class extended by all uri modules.
 *
 * Sets the contract for all uri modules to implement the abstract methods of this class
 */
abstract class uri_modules
{
    /**
     * Abstract method implemented in the uri modules.
     *
     * Creates a link string based on the uri type
     *
     * @see includes/usu_general_functions usu5_multi_language()
     *
     * @param string $page      - base filename
     * @param string $text      - uri link text
     * @param string $seperator - e.g. -p- or -c-
     * @param string $value     - either an integer or a path based string
     */
    abstract public function createLinkString($page, $text, $seperator, $value);
    /**
     * Abstract method implemented in the uri modules.
     *
     * Seperates the uri text with e.g. hyphen
     *
     * @param array $array
     *
     * @todo method should be separateUriText( array $array = array() )
     */
    abstract public function separateUriText($array);
    /**
     * Abstract method implemented in the uri modules.
     * Adds a filename to the uri if a non rewrite uri.
     *
     * @example product_info.php/my-great-product-p-32
     */
    abstract public function addFilename();
    /**
     * Global method available to all extending classes, strips scheme, domain, path and querystring from the uri.
     *
     * @uses ltrim()
     * @uses str_replace()
     * @uses strrchr()
     *
     * @param string $fulluri  - full request uri
     * @param mixed  $basename - looks to be superfluous
     *
     * @todo Remove $basename as it looks superfluous
     *
     * @return mixed - bool false / string stripped uri
     */
    public function stripSeoUri($fulluri, $basename)
    {
        $http_strip = ltrim(str_replace([HTTP_SERVER, HTTPS_SERVER, DIR_WS_CATALOG], ['', '', '/'], $fulluri), '/');

        if (false === $this->isValidUri()) {
            return false;
        }

        return str_replace(strrchr($http_strip, '?'), '', $http_strip);
    } // end method
    /**
     * Abstract method implemented in the uri modules.
     * Examines the current request to determine if it is valid for a particular uri module.
     */
    abstract protected function isValidUri();
    /**
     * Remove the language from the request uri if present.
     *
     * @uses array_key_exists()
     * @uses preg_match()
     * @uses str_replace()
     *
     * @return string - uri with language removed
     */
    protected function withoutLanguage()
    {
        preg_match('@^[a-z]{2}/@', Usu_Main::i()->getVar('request_uri'), $matches);

        if (\array_key_exists(0, $matches)) {
            return str_replace($matches[0], '', Usu_Main::i()->getVar('request_uri'));
        }

        return Usu_Main::i()->getVar('request_uri');
    } // end method
} // end class
