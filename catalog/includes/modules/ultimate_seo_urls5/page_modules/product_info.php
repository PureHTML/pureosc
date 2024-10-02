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
 * Page module for product_info.
 */
class product_info extends page_modules
{
    /**
     * Array of _GET key dependencies for this page
     * - marker is the seo url replacement for the _GET key ( e.g. -c-1 replaces cPath=1 )
     * - query is the query used to extract the link text from the database
     * - to_replace is an array of texts that are to be replace with real values in the query.
     */
    protected array $dependencies = ['products_id' => ['marker' => '-p-',
        'query' => "SELECT pd.products_name, m.manufacturers_name, cd.categories_name, p.products_model, p2c.categories_id FROM :TABLE_PRODUCTS_DESCRIPTION pd INNER JOIN :TABLE_PRODUCTS_TO_CATEGORIES p2c ON p2c.products_id = pd.products_id INNER JOIN :TABLE_PRODUCTS p ON pd.products_id = p.products_id LEFT JOIN :TABLE_MANUFACTURERS m ON m.manufacturers_id = p.manufacturers_id INNER JOIN :TABLE_CATEGORIES_DESCRIPTION cd ON p2c.categories_id = cd.categories_id AND cd.language_id=':languages_id' WHERE pd.products_id=':pid' AND pd.language_id=':languages_id' LIMIT 1",
        'to_replace' => [':TABLE_PRODUCTS_DESCRIPTION', ':TABLE_PRODUCTS_TO_CATEGORIES', ':TABLE_PRODUCTS', ':TABLE_MANUFACTURERS', ':TABLE_CATEGORIES_DESCRIPTION', ':languages_id', ':pid']]];

    /**
     * The current dependency key extracted from the incoming parameters.
     *
     * @var string - dependency key
     */
    protected string $key = '';

    /**
     * extracts the key => value pairs from the querystring in order to build a unique cache name for the loaded page.
     */
    protected array $cache_name_builder = ['products_id' => 1, 'page' => 1];
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
     * @return Product_Info_Page_Module
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
        $extract = (\defined('USU5_ADD_CPATH_TO_PRODUCT_URLS') && (USU5_ADD_CPATH_TO_PRODUCT_URLS === 'false')) ? ['cPath', 'manufacturers_id'] : ['manufacturers_id'];
        $this->setAllParams($page, $parameters, $add_session_id, $connection, $extract);

        if (false === $this->validRequest()) {
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
            case $this->key === 'products_id':
                // This array contains replacements for the to_replace array
                $this->setQuery([TABLE_PRODUCTS_DESCRIPTION, TABLE_PRODUCTS_TO_CATEGORIES, TABLE_PRODUCTS, TABLE_MANUFACTURERS, TABLE_CATEGORIES_DESCRIPTION, Usu_Main::i()->getVar('languages_id'), $this->keys_index[$this->key]]);

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
                ->separateUriText($this->linktext($this->linkTextOrder($link_text))), $this->dependencies[$this->key]['marker'], $this->keys_index[$this->key]));
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
        if (false !== $final_text_array = Usu_Main::i()->getVar('registry')->retrieve($this->key, $this->keys_index[$this->key])) {
            if (Usu_Main::monitorPerformance()) {
                ++Usu_Main::$performance['queries_saved'];
            }

            return $final_text_array;
        }

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
        Usu_Main::i()->getVar('registry')->attach($this->key, $this->keys_index[$this->key], $final_text_array);

        return $final_text_array;
    }
    /**
     * Like text options offered by b,c,m,p.
     *
     * Builds the link text based on the settings chosen in admin .. products name must be present or the script adds it regardless.
     *
     * @uses array_flip()
     * @uses array_intersect_key()
     * @uses array_key_exists()
     * @uses count()
     * @uses str_split()
     * @uses stripos()
     *
     * @param array $details - link text key=>value pairs
     *
     * @return array $to_seperate - array of link text options in the correct order
     */
    private function linkTextOrder(array $details = [])
    {
        $text_types = ['p' => $details['products_name'], 'c' => $details['categories_name'], 'm' => $details['products_model']];
        //      $text_types = array( 'p' => $details['products_name']);
        // manufacturers_name is gained through a left join and may not exist
        \array_key_exists('manufacturers_name', $details) ? $text_types['b'] = $details['manufacturers_name'] : null;

        // Products name MUST be present, if not we force it to the end
        if (false === stripos(USU5_PRODUCTS_LINK_TEXT_ORDER, 'p')) {
            $admin_order = str_split(USU5_PRODUCTS_LINK_TEXT_ORDER.'p');
        } else {
            $admin_order = str_split(USU5_PRODUCTS_LINK_TEXT_ORDER);
        }

        // Split the string value entered in admin ( like mcp etc ) to an array
        $text_order = array_flip($admin_order); // Flip key => value to value => key
        $text_to_format = array_intersect_key($text_types, $text_order); // return only those key => value pairs that match the admin selection
        $link_text_count = \count($admin_order);
        $ordered_array = [];

        for ($i = 0; $i < $link_text_count; ++$i) {
            if (\array_key_exists($admin_order[$i], $text_to_format) && tep_not_null($text_to_format[$admin_order[$i]])) { // If a value is empty then we don't want to add it to the link text
                $to_seperate[] = $text_to_format[$admin_order[$i]]; // Create an array where the  link text is in the same order as the admin selection
            }
        }

        return $to_seperate;
    } // End method
} // end class
