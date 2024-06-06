<?php
  require('includes/application_top.php');

$kategorie = $_GET['k'];
//$vyrobce = 24;
$vyrobce = $_GET['v'];



$vyber_query = tep_db_query("SELECT products_id FROM products_to_categories WHERE categories_id = $kategorie");
while ($vyber = tep_db_fetch_array($vyber_query)) {
echo $vyber['products_id'] . '<br>';
tep_db_query("UPDATE products set manufacturers_id = '". $vyrobce ."' WHERE products_id = '" . $vyber['products_id']  .   "'");
}