#!/usr/bin/php
<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(1);
///TODO CONFIG!!!!!!!!!!!
chdir('../catalog/');
require('includes/application_top.php');

//echo 'HTTPS_SERVER' . HTTPS_SERVER;exit;
file_put_contents('../otvor.log', "\n\nGENERUN\n\n", FILE_APPEND);
global $data;

//------------------------------------------------------------------------------------------------

function treeTouch($parentId=0, $cPath='', $langId=0) {
global $data;

if(! $langId){ echo 'errror: no languageID';
return;
}

if($cPath) {
  //$link = HTTPS_SERVER . '/index.php?cPath='.$cPath; 
  //$link = tep_href_link(FILENAME_DEFAULT, 'cPath='.$cPath, 'NONSSL', false);
  
  $data .= 'RewriteCond %{REQUEST_URI} ' . str_replace(HTTPS_SERVER , '^', str_replace('/?', '/', preg_replace('/PHPSESSID.*/', '/', tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cPath, 'NONSSL', false)))) . '$' . "\n";
  $data .= 'RewriteRule ^(.*)$ ' . str_replace(HTTPS_SERVER , '', str_replace('&amp;', '&', preg_replace('/&amp;PHPSESSID.*/', '', tep_href_link_original(FILENAME_DEFAULT, 'cPath=' . $cPath . '&language_id=' . $langId, 'NONSSL', false)))) . ' [PT,QSA]' . "\n\n";
  

/*  
  echo $link . "\n";
  $dump = file_get_contents($link, false, $context);
  if($dump === false) echo "WARNING - NESTAZENO!!!\n";
  unset($dump);
*/

  $ca = explode('_', $cPath);
  $cid = $ca[count($ca) - 1];
  $pQ = tep_db_query("SELECT p.products_id AS pid FROM products_to_categories p2c, products p WHERE p.products_id = p2c.products_id AND categories_id = ".$cid." AND products_status = 1 ORDER BY p.products_id"); 
  while($p = tep_db_fetch_array($pQ)) {
    //$link = HTTPS_SERVER . '/product_info.php?cPath='.$cPath."&products_id=".$p['pid']; 
    //$link = tep_href_link(FILENAME_PRODUCT_INFO, 'cPath='.$cPath.'&products_id='.$p['pid'], 'NONSSL', false);

    $data .= 'RewriteCond %{REQUEST_URI} ' . str_replace(HTTPS_SERVER , '^', str_replace('/?', '/', preg_replace('/PHPSESSID.*/', '/', tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $p['pid'], 'NONSSL', false)))) . '$' . "\n";
    $data .= 'RewriteRule ^(.*)$ ' . str_replace(HTTPS_SERVER , '', str_replace('&amp;', '&', preg_replace('/&amp;PHPSESSID.*/', '', tep_href_link_original(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $p['pid'] . '&language_id=' . $langId, 'NONSSL', false)))) . ' [PT,QSA]' . "\n\n";    

/*
    echo "\t" . $link . "\n";
    $dump = file_get_contents($link, false, $context);
    if($dump === false) echo "WARNING - NESTAZENO!!!\n";
    unset($dump);
*/
  }
}

$cQ = tep_db_query("SELECT categories_id AS cid FROM categories WHERE parent_id = ".$parentId."  ORDER BY categories_id");
//TODO:categories_status : $cQ = tep_db_query("SELECT categories_id AS cid FROM categories WHERE parent_id = ".$parentId." AND categories_status = 1 ORDER BY categories_id");
while($c = tep_db_fetch_array($cQ)) {
  $cid = $c['cid'];
  $cPathFwd = ($cPath ? ($cPath.'_') : '') . $cid;
  treeTouch($cid, $cPathFwd, $langId);
}
}
//------------------------------------------------------------------------------------------------

$data= '';
//index.php
$data .= 'RewriteRule ^$ /index.php [R=301,L]' . "\n";
$data .= 'RewriteRule ^/$ /index.php [R=301,L]' . "\n";

//staticke nahrady
$data .= 'RewriteCond %{REQUEST_URI} ^/novinky/$' . "\n";
$data .= 'RewriteRule ^(.*)$ /products_new.php [PT,QSA]' . "\n";

//$data .= 'RewriteCond %{REQUEST_URI} ^/quick-shop/$' . "\n";
//$data .= 'RewriteRule ^(.*)$ /quick_shop.php [PT,QSA]' . "\n";


$data .= "\n\n";

$lang_query = tep_db_query("SELECT languages_id FROM languages ORDER BY sort_order");
while ($lang = tep_db_fetch_array($lang_query)) {

  treeTouch(0, '', $lang['languages_id']);

/*
  $products_query = tep_db_query("SELECT products.products_id from products, products_description WHERE products.products_id=products_description.products_id AND products_status=1 AND language_id=" . $lang['languages_id']);
  while ($products = tep_db_fetch_array($products_query)){
    $data .= 'RewriteCond %{REQUEST_URI} ' . str_replace(HTTPS_SERVER , '^', str_replace('/?', '/', preg_replace('/PHPSESSID.* /', '', tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'])))) . '$' . "\n";
    $data .= 'RewriteRule ^(.*)$ ' . str_replace(HTTPS_SERVER , '', str_replace('&amp;', '&', preg_replace('/&amp;PHPSESSID.* /', '', tep_href_link_original(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'] . '&language_id=' . $lang['languages_id'])))) . ' [PT,QSA]' . "\n\n";
  }
//exit;
  $categories_query = tep_db_query("SELECT categories.categories_id from categories, categories_description WHERE categories.categories_id=categories_description.categories_id AND language_id=" . $lang['languages_id']);
//TODO:status  $categories_query = tep_db_query("SELECT categories.categories_id from categories, categories_description WHERE categories.categories_id=categories_description.categories_id AND categories_status=1 AND language_id=" . $lang['languages_id']);
  while ($categories = tep_db_fetch_array($categories_query)){
    $data .= 'RewriteCond %{REQUEST_URI} ' . str_replace(HTTPS_SERVER , '^', str_replace('/?', '/', preg_replace('/PHPSESSID.* /', '', tep_href_link(FILENAME_DEFAULT, 'cPath=' . tep_get_category_path($categories['categories_id']))))) . '$' . "\n";
    $data .= 'RewriteRule ^(.*)$ ' . str_replace(HTTPS_SERVER , '', str_replace('&amp;', '&', preg_replace('/&amp;PHPSESSID.* /', '', tep_href_link_original(FILENAME_DEFAULT, 'cPath=' . tep_get_category_path($categories['categories_id']) . '&language_id=' . $lang['languages_id'])))) . ' [PT,QSA]' . "\n\n";
  }
*/
  
  $manufacturers_query = tep_db_query("SELECT manufacturers_id from manufacturers");
  while ($manufacturers = tep_db_fetch_array($manufacturers_query)){
    $data .= 'RewriteCond %{REQUEST_URI} ' . str_replace(HTTPS_SERVER , '^', str_replace('/?', '/', preg_replace('/[?|&]PHPSESSID.*/', '', tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers['manufacturers_id'])))) . '$' . "\n";
    $data .= 'RewriteRule ^(.*)$ ' . str_replace(HTTPS_SERVER , '', str_replace('&amp;', '&', preg_replace('/&amp;[?|&]PHPSESSID.*/', '', tep_href_link_original(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers['manufacturers_id']) . '&language_id=' . $lang['languages_id']))) . ' [PT,QSA]' . "\n\n";
  }


  $information_query = tep_db_query("SELECT pages_id FROM information_pages_content");
  while ($information = tep_db_fetch_array($information_query)){
    $data .= 'RewriteCond %{REQUEST_URI} ' . str_replace(HTTPS_SERVER , '^', str_replace('/?', '/', preg_replace('/[?|&]PHPSESSID.*/', '', tep_href_link(FILENAME_DEFAULT, 'information_id=' . $information['information_id'])))) . '$' . "\n";
    $data .= 'RewriteRule ^(.*)$ ' . str_replace(HTTPS_SERVER , '', str_replace('&amp;', '&', preg_replace('/&amp;[?|&]PHPSESSID.*/', '', tep_href_link_original(FILENAME_DEFAULT, 'information_id=' . $information['information    _id']) . '&language_id=' . $lang['languages_id']))) . ' [PT,QSA]' . "\n\n";
  }




} //end lang loop

file_put_contents(DIR_FS_CATALOG . '.htaccess',$data);



exit;










function msg($s) { echo $s; }

//if(! ($subject = $argv[1])) die("\nERROR - chybi povinny parametr s cestou a nazvem clanku!\nKONEC\n\n");
if(! ($srcFileName = $argv[1])) die("\nERROR - chybi povinny parametr s nazvem zdrojoveho HTML souboru!\nKONEC\n\n");
if(! ($artDescr = file_get_contents($srcFileName))) die("\nERROR - soubor '".$srcFileName."' se nepodarilo nacist!\nKONEC\n\n");

$m = null;
if(preg_match('/\<h[12]\>(.*)\<\/h[12]\>/Uis', $artDescr, $m)) $artName = $m[1];
else $artName = $srcFileName;
//echo $artDescr."\n".var_export($m, true)."\n";

$ad = getcwd();
//echo $ad."\n";
$topics = explode('/', $ad); 
foreach($topics as $k => $v) if($v != 'html') unset($topics[$k]); else { unset($topics[$k]); break; }
//echo "topics: '".implode('/', $topics)."'\n";

chdir('/home/pure21/WWW/osc/catalog/admin/');

require('includes/configure.php');
require('includes/functions/database.php');

tep_db_connect() or die("ERROR - unable to connect to database server!\n\n");
// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration');
while ($configuration = tep_db_fetch_array($configuration_query)) {
  define($configuration['cfgKey'], $configuration['cfgValue']);
}

tep_db_close();


$db = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
if($db->connect_errno) {
  die("\nERROR [".$db->connect_errno."] [".$db->connect_error."] - nelze se připojit k db '".DB_NAME."' na serveru '".DB_SERVER."' jako '".DB_SERVER_USERNAME."' s heslem '".DB_SERVER_PASSWORD."' !!!\n\n");
}
  
$langs = [];
$langQ = $db->query("SELECT * FROM languages ORDER BY sort_order");
if($langQ) {
  if($langQ->num_rows > 0) while($langA = $langQ->fetch_assoc()) $langs[$langA['code']] = $langA['languages_id'];
  $langQ->free();
}

if(! count($langs)) {
  die("\nERROR - načtení jazyků z tabulky 'languages' SELHALO!!!\n\n");
}
  
  
$authors = [];
$authQ = $db->query("SELECT authors_id, authors_email FROM authors WHERE authors_email != ''"); 
if($authQ) {
  if($authQ->num_rows > 0) while($authA = $authQ->fetch_assoc()) $authors[$authA['authors_email']] = $authA['authors_id'];
  $authQ->free();
}

if(! count($authors)) {
  die("\nERROR - načtení autorů z tabulky 'authors' SELHALO!!!\n\n");
}


$authorsId = 1;
if(isset($argv[2])) if(isset($authors[trim($argv[2])])) $authorsId = $authors[trim($argv[2])];
/*
  $topics = explode('/', $subject);
  if(array_key_exists($topics[0], $langs)) $language = array_shift($topics); //1.polozka cesty MUZE(!) byt jazyk
  else $language = array_keys($langs)[0]; //jinak vzit defaultni
*/
  
$language = array_keys($langs)[0];
$language_id = $langs[$language]; 
  
  //$artName = $topics[count($topics)-1]; //posl. v rade je jmeno clanku
  //unset($topics[count($topics)-1]); //zbydou topicy 
  
if(count($topics) < 1) unset($topics); 
  
/*  
  $nA = explode(' ', $artName); //oddelit ev.datum
  if(($cnt = count($nA)) > 1) {
    if(preg_match('/\d{4}-\d{2}-\d{2}/', $nA[$cnt-1])) { 
      $pubDate = $nA[$cnt-1];
      unset($nA[$cnt-1]);
      $artName = implode(' ', $nA);
    } else $pubDate = date('Y-m-d H:i:s');
  } else $pubDate = date('Y-m-d H:i:s');
  
  $validQ = $db->query("SELECT (UNIX_TIMESTAMP('".$pubDate."') IS NOT NULL) AS valid"); 
  if($validQ) { //validace db dotazem 
    if(! $validQ->fetch_assoc()['valid']) $pubDate = date('Y-m-d H:i:s'); //nekdo napsal picovinu
  } else $pubDate = date('Y-m-d H:i:s'); //..tak velkou, az to spadlo!
*/

$pubDate = date('Y-m-d H:i:s');
$images = [];

if($artName) { //jedeeeem:-)! 

  
  
  //postprocessing:
  $pm = false;
  if(preg_match_all('/<[\/\s]*(html|head|meta|body){1}[^>]*>/Uis', $artDescr, $pm)) { //vymazat nezadouci tagy z html zpravy
    foreach($pm[0] as $rep) $artDescr = str_replace($rep, '', $artDescr); 
    $mStr = '';
    foreach($pm[1] as $rep) $mStr .= $rep.' ';
    msg("Vymazány tagy '".$mStr."'\n\n", 1);
  }

  
  $pm = false;
  if(preg_match_all('/img.+src="([^"]+)"/Uis', $artDescr, $pm)) { //dosadit ev.chybejici cestu k obrazkum pro clanky
    foreach($pm[1] as $rep) if(strpos($rep, 'images/') === false) {
      $artDescr = str_replace($rep, 'images/'.$rep, $artDescr); 
      msg("Doplněna cesta k obrázku '".$rep."'\n", 1);
    }
  }

  //zakladani ev. topicu:
  $tID = 0;
  if(isset($topics)) foreach($topics as $top) {
    
    $tdQ = $db->query("SELECT cd.categories_id, c.parent_id FROM categories c LEFT JOIN categories_description cd USING(categories_id) 
      WHERE cd.language_id=".$language_id." AND cd.categories_name='".$db->real_escape_string($top)."'");
    if($tdQ) {
      if($tdQ->num_rows < 1) {
        if(! $db->query("INSERT INTO categories SET parent_id=".$tID)) msg("TOPIC INS: DB ERROR '".$db->error."'\n\n");
        $tID = $db->insert_id; 
        
        if(! $db->query("INSERT INTO categories_description SET categories_id=".$tID.", language_id=".$language_id.", categories_name='".$db->real_escape_string($top)."'")) msg("TOPIC_DESCR INS: DB ERROR '".$db->error."'\n\n");
        
        msg("VYTVOŘENA KATEGORIE '".$top."' id=".$tID."\n");
        
      } else if($row = $tdQ->fetch_assoc()) $tID = $row['categories_id'];
      
      $tdQ->free();
        
    } else msg("KATEGORIE tdQ: DB ERROR '".$db->error."'\n\n");
  }


  $ok = true;

  $imgFileName = ((count($images) > 0) ? $images[0]['name'] : '');
  $artStatus = 1; //(isset(ARTICLE_STATUS) ? ARTICLE_STATUS : 0);
  $aID = 0;
  $exQ = $db->query("SELECT pd.products_id FROM products_description pd LEFT JOIN products_to_categories p2c USING(products_id) 
    WHERE pd.products_name='".$db->real_escape_string($artName)."' AND p2c.categories_id=".$tID." AND pd.language_id=".$language_id); 
  if($exQ) if($exQ->num_rows > 0) if($row = $exQ->fetch_assoc()) $aID = $row['products_id']; 
    
  if(! $aID) { //neexist - vlozit 
      
    msg("Vkladam clanek '".$artName."' language_id=".$language_id."\n");
      
    if($db->query("INSERT INTO products SET products_status=".$artStatus.", products_date_added=NOW(), authors_id = ".$authorsId.", 
      products_image='".$db->real_escape_string($imgFileName)."', products_date_available='".$pubDate."'")) {
      
      $aID = $db->insert_id;
      
      if(! $db->query("INSERT INTO products_description SET language_id=".$language_id.", products_id=".$aID.", products_name='".$db->real_escape_string($artName)."', products_description='".$db->real_escape_string($artDescr)."'")) { 
        msg("ARTDESCR INS DB ERROR ".$db->error." \n");
        $ok = false; 
      }
      
      if(! $db->query("INSERT INTO products_to_categories SET products_id=".$aID.", categories_id=".$tID)) { 
        msg("A2T INS DB ERROR ".$db->error." \n"); 
        $ok = false; 
      }
    
    } else { msg("ERROR - vlozeni clanku selhalo!\n"); $ok = false; }
  
    if($ok) msg("OK - clanek uspesne vlozen (id=".$aID.").\n");
    
  } else { //updatovat
    
    if($db->query("UPDATE products_description SET products_description='".$db->real_escape_string($artDescr)."' WHERE products_id=".$aID." AND  language_id=".$language_id)) msg("OK - clanek '".$artName."' (id=".$aID.") uspesne updatovan.\n");
    else msg("ERROR - update clanku '".$artName."' (id=".$aID.") selhal!\n");
  }
  
} else msg("ERROR - chybi nazev clanku!\n");

exit(0);
?>

