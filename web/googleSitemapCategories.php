<?php
	/**
	 * Google Sitemap Generator - Categories
	 * 
	 * Script to generate a Google sitemap (categories) for osCommerce based stores
	 *
	 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
	 * @version 1.1
	 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
	 * @copyright Copyright 2006, Bobby Easland 
	 * @author Bobby Easland 
	 * @filesource
	 */

	/*
	 * Include the application_top.php script
	 */
	include_once('includes/application_top.php');

	/*
	 * Send the XML content header
	 */
	header('Content-Type: text/xml');

	/*
	 * Echo the XML out tag
	 */
	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php

	/*
	 * Define the uniform node function 
	 */
	function GenerateNode($data){
		$content = '';
		$content .= "\t" . '<url>' . "\n";
		$content .= "\t\t" . '<loc>'.trim($data['loc']).'</loc>' . "\n";
		$content .= "\t\t" . '<lastmod>'.trim($data['lastmod']).'</lastmod>' . "\n";
		$content .= "\t\t" . '<changefreq>'.trim($data['changefreq']).'</changefreq>' . "\n";
		$content .= "\t\t" . '<priority>'.trim($data['priority']).'</priority>' . "\n";
		$content .= "\t" . '</url>' . "\n";
		return $content;
	} # end function

	/*
	 * Define the SQL for the categories query 
	 */
	$sql = "SELECT 
					c.categories_id as cID, 
					c.date_added as category_date_added, 
					c.last_modified as category_last_mod,
					MAX(p.products_date_added) as products_date_added, 
					MAX(p.products_last_modified) as products_last_mod   
			FROM " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c 
				LEFT JOIN " . TABLE_PRODUCTS . " p 
					ON (p2c.products_id = p.products_id) 
			WHERE c.categories_id = p2c.categories_id 
			GROUP BY cID  
			ORDER BY 
				category_date_added ASC, 
				category_last_mod ASC, 
				products_date_added ASC, 
				products_last_mod ASC";
	
	/*
	 * Execute the query
	 */
	$query = tep_db_query($sql);

	/*
	 * If there are returned rows...
	 * Basic sanity check 
	 */
	if ( tep_db_num_rows($query) > 0 ){
		/*
		 * Initialize the container
		 */
		$container = array();

		/*
		 * Loop query result and populate container
		 */
		while( $result = tep_db_fetch_array($query) ){
			$container[$result['cID']] = max( $result['category_date_added'], 
																				$result['category_last_mod'], 
																				$result['products_last_mod'], 
																				$result['products_date_added']
																			 );
		} # end while

		/*
		 * Free the resource...could be large
		 * ...clean as we go
		 */
		tep_db_free_result($query);

		/*
		 * Sort the container based on last mod date
		 */
		arsort($container);
	} # end if

	/*
	 * Loop the result set
	 * Basic sanity check
	 */
	if ( sizeof($container) > 0 ){
		$total = sizeof($container);
		$_total = $total;
		foreach( $container as $cID => $last_mod ){
			$location = tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cID, 'NONSSL', false);
			$changefreq = 'weekly';
			$priority = max( number_format($_total/$total, 1, '.', ','), .1);
			$_total--;		
			$container = array('loc' => htmlspecialchars(utf8_encode($location)),
												 'lastmod' => date ("Y-m-d", strtotime($last_mod)),
												 'changefreq' => $changefreq,
												 'priority' => $priority
												);
			/*
			 * Echo the generated node
			 */
			echo generateNode($container);
		} # end while
	} # end if

	/*
	 * Close the urlset
	 */
	echo '</urlset>';
	
	/*
	 * Include the application_bottom.php script 
	 */
	include_once('includes/application_bottom.php');
?>