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
 * Page module for index.php this is slightly more complex than usual as it has variations.
 */
class index extends aPage_Modules
{
    /**
     * Array of _GET key dependencies for this page
     * - marker is the seo url replacement for the _GET key ( e.g. -c-1 replaces cPath=1 )
     * - query is the query used to extract the link text from the database
     * - to_replace is an array of texts that are to be replace with real values in the query.
     */
    protected array $dependencies = ['cPath' => ['marker' => '-c-',
        'query' => 'SELECT cd2.categories_name AS pName, cd.categories_name AS cName FROM :TABLE_CATEGORIES c LEFT JOIN :TABLE_CATEGORIES_DESCRIPTION cd2 ON c.parent_id = cd2.categories_id AND c.parent_id = cd2.categories_id AND cd2.language_id = :languages_id, :TABLE_CATEGORIES_DESCRIPTION cd WHERE c.categories_id = cd.categories_id AND c.categories_id = :cid AND cd.language_id = :languages_id',
        'to_replace' => [':TABLE_CATEGORIES_DESCRIPTION', ':TABLE_CATEGORIES', ':languages_id', ':cid']],
        'manufacturers_id' => ['marker' => '-m-',
            'query' => "SELECT manufacturers_name FROM :TABLE_MANUFACTURERS WHERE manufacturers_id=':manufacturers_id' LIMIT 1",
            'to_replace' => [':TABLE_MANUFACTURERS', ':manufacturers_id']]];

    /**
     * The current dependency key extracted from the incoming parameters.
     *
     * @var string - dependency key
     */
    protected string $key = null;

    /**
     * extracts the key => value pairs from the querystring in order to build a unique cache name for the loaded page.
     */
    protected array $cache_name_builder = ['cPath' => 1, 'manufacturers_id' => 1, 'page' => 1];
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
     * @return Index_Page_Module
     */
    public static function i()
    {
        if (!self::$_singleton instanceof Index_Page_Module) {
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
     * @see aPage_Modules::stripPathToLastNumber()
     * @see aPage_Modules::setQuery()
     * @see aPage_Modules::unsetProperties()
     * @see aPage_Modules::getDependencyKey()
     * @see aPage_Modules::setAllParams()
     * @see aPage_Modules::validRequest()
     * @see aPage_Modules::returnFinalLink()
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
        $extract = ['cPath' => 'manufacturers_id'];
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
            case $this->key === 'cPath':
                // This array contains replacements for the to_replace array
                $this->setQuery([TABLE_CATEGORIES_DESCRIPTION, TABLE_CATEGORIES, (int) Usu_Main::i()->getVar('languages_id'), $this->stripPathToLastNumber($this->keys_index[$this->key])]);

                break;
            case $this->key === 'manufacturers_id':
                // This array contains replacements for the to_replace array
                $this->setQuery([TABLE_MANUFACTURERS, (int) $this->keys_index[$this->key]]);

                break;

            default:
                trigger_error(__CLASS__.'::'.__FUNCTION__.' Incorrect or inexistant dependency key.', \E_USER_WARNING);

                break;
        }

 // end switch
        $link_text = $this->acquireLinkText();
        // If the query returned no results then we return false forcing the use of the standard osCommerce link wrapper
        Usu_Main::i()->setVar('page_not_found', false);

        if (false === $link_text) {
            Usu_Main::i()->setVar('page_not_found', true);
            $this->unsetProperties();

            return;
        }

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
     * @see Usu_Main::getVar()
     * @see Data_Registry::retrieve()
     * @see Data_Registry::attach()
     * @see Usu_Main::monitorPerformance()
     *
     * @uses array_key_exists()
     * @uses defined()
     * @uses trim()
     *
     * @return array array of link test
     */
    protected function acquireLinkText()
    {
        if (false !== $final_text_array = Usu_Main::i()->getVar('registry')
            ->retrieve($this->key, $this->keys_index[$this->key])) {
            if (Usu_Main::monitorPerformance()) {
                ++Usu_Main::$performance['queries_saved'];
            }

            return $final_text_array;
        }

        $result = Usu_Main::i()->query($this->query);
        $text_array = [];
        $text_array = tep_db_fetch_array($result);
        tep_db_free_result($result);

        if (false === $text_array) {
            return false;
        }

        $final_text_array = [];

        foreach ($text_array as $key => $text) {
            if (tep_not_null(trim($text))) {
                $final_text_array[$key] = $text;
            }
        }

        if (\defined('USU5_ADD_CAT_PARENT') && (USU5_ADD_CAT_PARENT === 'false')
                                             && \array_key_exists('pName', $final_text_array)) {
            unset($final_text_array['pName']);
        }

        // We will cache this result
        Usu_Main::i()->getVar('registry')->attach($this->key, $this->keys_index[$this->key], $final_text_array);

        return $final_text_array;
    }
} // end class
