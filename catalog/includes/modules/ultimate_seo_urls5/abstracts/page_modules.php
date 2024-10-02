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
 * Abstract class extended by all page modules.
 *
 * Enforces the contract where all page modules are required to have methods acquireLinkText() and buildLink()
 */
abstract class page_modules
{
    protected $urlInitial;
    protected $parameters = [];
    protected $add_session_id;
    protected $_sid = false;
    protected $cache_name = '';
    protected $query;
    protected $keys_index = [];
    protected $page;
    private $extract;
    /**
     * Located in the individual modules
     * builds a link uri with text and markers.
     *
     * @param string $page           - base filename
     * @param mixed  $parameters     - Currently unused
     * @param mixed  $add_session_id
     * @param mixed  $connection
     */
    abstract public function buildLink($page, $parameters, $add_session_id, $connection);
    /**
     * Build the name of the cache using language, file name and _GET keys as set in the page modules.
     *
     * @uses array_key_exists()
     * @uses substr()
     *
     * @return string - final name of the cache
     */
    public function buildCacheName()
    {
        $cachename = Usu_Main::i()->getVar('languages_id').'_'.substr(Usu_Main::i()->getVar('filename'), 0, -4);

        foreach ($this->cache_name_builder as $get_key => $dummy) {
            if (\array_key_exists($get_key, $_GET)) {
                $cachename .= '_'.$get_key.'_'.usu_cleanse($_GET[$get_key]);
            }
        }

        return $cachename;
    }
    /**
     * Returns single or multiple link text via a query and adds this to the registry.
     */
    abstract protected function acquireLinkText();
    /**
     * Set all parameters required by the page module.
     *
     * @uses explode
     *
     * @param string $page           - base filename
     * @param string $parameters     - querystring parameters
     * @param bool   $add_session_id
     * @param string $connection     - SSL / NONSSL
     * @param mixed  $extract        - bool false / array of _GET keys we do not want to use / extract
     */
    protected function setAllParams($page, $parameters, $add_session_id, $connection, $extract): void
    {
        $this->urlInitial = $connection === 'NONSSL' ? Usu_Main::i()->getVar('base_url') : Usu_Main::i()->getVar('base_url_ssl');
        $this->cleanParams(explode('&', $parameters));
        $this->add_session_id = $add_session_id;
        $this->setSid($connection);
        $this->page = $page;
        $this->extract = $extract;
    }
    /**
     * Add the session id to the querystring.
     *
     * @param string $connection - request type NONSSL / SSL
     */
    protected function setSid($connection): void
    {
        // Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
        if (($this->add_session_id === true) && (Usu_Main::i()->getVar('session_started') === true) && (SESSION_FORCE_COOKIE_USE === 'False')) {
            if (tep_not_null(Usu_Main::i()->getVar('sid'))) {
                $_sid = Usu_Main::i()->getVar('sid');
            } elseif (((Usu_Main::i()->getVar('request_type') === 'NONSSL') && ($connection === 'SSL') && (ENABLE_SSL === true)) || ((Usu_Main::i()->getVar('request_type') === 'SSL') && ($connection === 'NONSSL'))) {
                if (HTTP_COOKIE_DOMAIN !== HTTPS_COOKIE_DOMAIN) {
                    $_sid = tep_session_name().'='.tep_session_id();
                }
            }
        }

        if (isset($_sid)) {
            $this->_sid = tep_output_string($_sid);
        }
    } // end method
    /**
     * Builds the final URL extracting unwanted _GET keys.
     *
     * Builds the querystring extracting unwanted _GET keys.
     * Adds the session id if appropriate.
     * Outputs a W3C valid URL if required by the settings.
     *
     * @uses defined()
     * @uses htmlspecialchars()
     * @uses implode()
     * @uses is_array()
     * @uses strpos()
     * @uses tep_utf8_encode()
     *
     * @param string $uri - base uri prior to adding the scheme the domain and the querystring
     *
     * @return string - final URL
     */
    protected function returnFinalLink($uri)
    {
        $this->removeDependencyKey(); // If we have an seo url like -p-6 we don't also want products_id=6 appended to the url
        $separator = '?';
        $link = $this->urlInitial.$uri;
        $this->rationaliseParameters();

        if (\is_array($this->extract) && !empty($this->extract)) {
            foreach ($this->parameters as $numkey => $get_pair) {
                foreach ($this->extract as $numkey2 => $extract_key) {
                    if (false !== strpos($get_pair, $extract_key)) {
                        unset($this->parameters[$numkey]);
                    }
                }
            }
        }

        if (tep_not_null($this->parameters)) {
            $link .= $separator.implode('&', $this->parameters);
            $separator = '&';
        }

        if (tep_not_null($this->_sid)) {
            $link .= $separator.$this->_sid;
        }

        $this->unsetProperties();

        switch (\defined('USU5_USE_W3C_VALID') && (USU5_USE_W3C_VALID === 'true')) {
            case true:
                return htmlspecialchars(tep_utf8_encode($link));

                break;

            default:
                return $link;

                break;
        }
    } // end method
    /**
     * Reset all class properties to prevent incorrect re-use.
     */
    protected function unsetProperties(): void
    {
        $this->urlInitial = null;
        $this->parameters = [];
        $this->add_session_id = null;
        $this->_sid = false;
        $this->cache_name = '';
        $this->query = null;
        $this->keys_index = [];
        $this->page = null;
        $this->extract = null;
    }
    /**
     * Check if the current request is valid for the page module.
     * If the dependency key of the page module does not exist in the _GET keys_index it is not a valid request.
     *
     * @uses array_key_exists()
     *
     * @return bool
     */
    protected function validRequest()
    {
        foreach ($this->keys_index as $key => $value) {
            if (\array_key_exists($key, $this->dependencies)) {
                return true;
            }
        }

        return false;
    }
    /**
     * Ensure that the _GET value is either numeric or at least an underscored numeric path ( e.g. 3_34_57 ).
     *
     * @see page_modules::cleanParams()
     *
     * @param mixed string/int $value -passed by reference
     */
    protected function rationaliseGetValue(&$value): void
    {
        if (!is_numeric(str_replace('_', '', $value))) {
            $value = 0;
        }
    }
    /**
     * Retrieve the dependency key if it exists in the current request querystring.
     *
     * @uses array_key_exists()
     *
     * @return mixed - bool false / string dependency key
     */
    protected function getDependencyKey()
    {
        foreach ($this->dependencies as $depkey => $dummy) {
            if (\array_key_exists($depkey, $this->keys_index)) {
                return $depkey;
            }
        }

        return false;
    }
    /**
     * Build a valid query by replacing placeholders with actual values.
     * Type casting/cleansing/escaping must be actioned in the page module.
     *
     * @uses str_replace()
     *
     * @param mixed $replace_with
     */
    protected function setQuery(array $replace_with): void
    {
        $this->query = str_replace($this->dependencies[$this->getDependencyKey()]['to_replace'], $replace_with, $this->dependencies[$this->getDependencyKey()]['query']);
    }
    /**
     * Return the final number in a path string ( e.g. 48_24_12 ).
     *
     * @uses count()
     * @uses explode()
     * @uses is_numeric()
     * @uses strpos()
     * @uses trigger_error()
     *
     * @param string $path - either an integer or a path string
     *
     * @return string - path integer as a string
     */
    protected function stripPathToLastNumber($path)
    {
        if (is_numeric($path)) {
            return (int) $path;
        }

        if (false !== strpos($path, '_')) {
            $split = explode('_', $path);

            return (int) array_pop($split);
        }

        trigger_error(__CLASS__.'::'.__FUNCTION__.': Incorrect path value of '.$path.' presented', \E_USER_WARNING);
    }
    /**
     * Iterate an array of text strings passing to a method to format correctly.
     *
     * @see page_modules::linkTextParts()
     *
     * @param mixed $array_of_texts
     *
     * @return array - formatted link text array
     */
    protected function linkText(array $array_of_texts)
    {
        $link_text = [];

        foreach ($array_of_texts as $key => $text) {
            $link_text[$key] = $this->linkTextParts($text);
        }

        return $link_text;
    }
    /**
     * Formatter for URI text.
     *
     * Takes a text string and formats it based on existing settings
     *
     * @uses defined()
     * @uses explode()
     * @uses implode()
     * @uses is_array()
     * @uses is_numeric()
     * @uses preg_replace()
     * @uses str_replace()
     * @uses strlen()
     * @uses strtolower()
     * @uses strtr()
     * @uses version_compare()
     *
     * @param string $string - The raw URI string to be converted
     *
     * @return string - the final formated URI string
     */
    protected function linkTextParts($string)
    {
        // Action character conversions
        if (\is_array(Usu_Main::i()->getVar('character_conversion'))) {
            $string = strtr($string, Usu_Main::i()->getVar('character_conversion'));
        }

        $string = str_replace('-', ' ', $string); // some strings will already have -(hyphen) so we convert them to spaces
        // Remove special characters
        $pattern = (\defined('SEO_REMOVE_ALL_SPEC_CHARS') && SEO_REMOVE_ALL_SPEC_CHARS === 'true') ? '@[^\\sa-z0-9]@i' : "@[!#\$%&'\"()\\*\\+,\\-\\./:;<=>\\?\\@\\[\\]\\^_`\\{|\\}~]+@";
        $link_text = preg_replace($pattern, '', strtolower($string));

            $link_text = preg_replace("@[\\s\v]+@", '-', $link_text);
        

        // No short words so return the base text
        if (false === strpos($link_text, '-')) {
            return $link_text;
        }

        // Remove any words less than or equal in legnth the our filter
        if (\defined('USU5_FILTER_SHORT_WORDS') && is_numeric(USU5_FILTER_SHORT_WORDS)) {
            $to_array = @explode('-', $link_text);
            $parts = [];

            foreach ($to_array as $index => $value) {
                if (\strlen($value) > USU5_FILTER_SHORT_WORDS) {
                    $parts[] = $value;
                }
            }

 // end foreach

            return implode('-', $parts);
        }

        return $link_text;
    } // End method
    /**
     * Clears out any parameters that have null _GET key => value pairs.
     *
     * @uses sort()
     */
    private function rationaliseParameters(): void
    {
        foreach ($this->parameters as $numkey => $get_pair) {
            if (!tep_not_null($get_pair)) {
                unset($this->parameters[$numkey]);
            }
        }

        sort($this->parameters);
    } // end method
    /**
     * Remove the dependency key of this page module from the parameters.
     * $this->key is set in the page module.
     *
     * @uses array_search()
     */
    private function removeDependencyKey(): void
    {
        $search = $this->key.'='.$this->keys_index[$this->key];
        $pos = array_search($search, $this->parameters, true);

        if (false !== $pos) {
            unset($this->parameters[$pos]);
        }
    }
    /**
     * Cleans the keys and values of the querystring as used internally.
     *
     * @see  page_modules::usu_cleanse()
     * @see page_modules::rationaliseGetValue()
     *
     * @uses array_key_exists()
     * @uses explode()
     * @uses strpos()
     *
     * @param mixed $params
     */
    private function cleanParams(array $params = []): void
    {
        if (empty($params)) {
            return;
        }

        // Add the cleansed querystring as a key => value pair to $keys_index
        // Add the cleansed querystring to the string $parameters
        $clean_params = [];

        foreach ($params as $numkey => $param) {
            $split = explode('=', $param);
            $key = usu_cleanse($split[0]);

            if (\array_key_exists(1, $split)) {
                if (false !== strpos($split[1], '{')) {
                    $value = (int) $split[1];
                } else {
                    $value = usu_cleanse($split[1]);
                }

                $param = $key.'='.$value;
            } else {
                $value = '';
            }

            $this->rationaliseGetValue($value);
            $this->keys_index[$key] = $value;
            $clean_params[] = $param;
        }

        $this->parameters = $clean_params;
    }
} // end class
