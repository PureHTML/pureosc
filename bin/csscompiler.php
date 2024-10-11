#!/usr/bin/php 
<?php
chdir('../catalog');

include('includes/local/configure.php');

// include the list of project filenames
//require(DIR_WS_INCLUDES.'filenames.php');
// include the database functions
require('includes/functions/database.php');
//require('includes/functions/general.php');
// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration');
while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

echo 'configuration loaded id Store name:' . constant('STORE_NAME') . "\n";

////
// PureHTML Css generator
//nested fiter:
function css_compile($data) {
    $data = preg_replace('/}}}}}}/', '}', preg_replace('/}}}}/', '}}', str_replace(': ', ':', str_replace('; }', '}', str_replace('} ', '}', preg_replace('/\s+/', ' ', preg_replace('/\t/', ' ', preg_replace('/\n/', ' ', preg_replace(':/\*.*\*/:', '', $data)))))))), 1);
    return $data;
}

function cssquery($max = 0, $min = 0, $template = '', $tag = '', $status = 1, $inline = 0) {
//$min_max = query sort order
    
    if ($max == 0 && $min == 0) {
        $min_max = 'min';
    } elseif ($max == 0 && $min > 0) {
        $min_max = 'min';
    } else {
        $min_max = 'max';
    }
    $data = '';
    $old = 0;
    $current = 0;
    $counter = 0;
    $css_query = tep_db_query("SELECT * from css WHERE max=" . $max . " AND min=" . $min . " AND template='" . $template . "' AND status=1 AND inline=0 ORDER BY " . $min_max . ", sort_order");
    while ($css = tep_db_fetch_array($css_query)) {
        
          //na zacatek
          if ($counter == 0){
          $old = $css[$min_max];
          if ($old > 0) {
          $data .= '}' . "\n" . '@media (' . $min_max . '-width: ' . $css[$min_max] . 'px){' . "\n"; 
          }
          }
        $current = $css[$min_max];
        if ($css[$min_max] == $old) {
            $data .= $css['name'] . '{' . $css['value'] . '}' . "\n";
        } else { //{
            //      $data .= 'xxx}' . "\n" . '@media (' . $min_max . '-width: ' . $css[$min_max] . 'px){' . $css['name'] . '{' . $css['value'] .'}' . "\n"; //}
            $data .= "\n" . '@media (' . $min_max . '-width: ' . $css[$min_max] . 'px){' . $css['name'] . '{' . $css['value'] . '}' . "\n"; 
        }
        $old = $current;
        $counter++;
    }
    if ($max > 0 || $min > 0) {
        $data .= '}';
    }

    return $data;
}

function cssgenerator() {

    $data = '';
//1. phone only => WHERE max > 0 AND min=0 AND template='' AND subtemplate='' AND inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT max AS init from css WHERE max > 0 AND min=0 AND template='' AND subtemplate='' AND inline=0 AND status=1 ORDER BY max");
    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery($cssmain['init']);
    }
// remove first bracket:
    $data = preg_replace('/^}/', '', $data, 1);
//css_compile
    $data = css_compile($data);

//2. default values
    $data .= css_compile(cssquery()); //defaults: $max = 0, $min = 0, $template = '', $tag = '', $status = 1, $inline = 0

//3. desktop only => WHERE max = 0 AND min > 0 AND template='' AND subtemplate='' AND inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT DISTINCT min AS init from css WHERE max = 0 AND min > 0 AND template='' AND subtemplate='' AND inline=0 AND status=1 ORDER BY min");
    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery(0, $cssmain['init']);
    }
    $data = css_compile($data);
    file_put_contents(DIR_FS_CATALOG . 's.css.gz', gzencode($data, 9), 644);
//working file:
    file_put_contents(DIR_FS_CATALOG . 's.css', $data, 644);
//debug file
    $data = str_replace("{", "\n{", str_replace("}", "}\n", $data));
    file_put_contents(DIR_FS_CATALOG . 's_debug.css', $data, 644);
}

function cssgenerator_index_top() {

    $data = '';
//1. WHERE max > 0 AND min=0 AND template='index_top' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT max AS init from css WHERE max > 0 AND min=0 AND template='index_top' AND  inline=0 AND status=1 ORDER BY max");
    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery($cssmain['init'], 0, 'index_top');
    }
// remove first bracket:
    $data = preg_replace('/^}/', '', $data, 1);
//css_compile
    $data = css_compile($data);

//2. default values
    $data .= css_compile(cssquery(0, 0, 'index_top', '', 1, 0));

//3. WHERE max = 0 AND min > 0 AND template='index_top' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT DISTINCT min AS init from css WHERE max = 0 AND min > 0 AND template='index_top' AND  inline=0 AND status=1 ORDER BY min");
    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery(0, $cssmain['init'], 'index_top');
    }
    $data = css_compile($data);
    file_put_contents(DIR_FS_CATALOG . 'index_top.css.gz', gzencode($data, 9), 644);
//working file:
    file_put_contents(DIR_FS_CATALOG . 'index_top.css', $data, 644);
//debug file
    $data = str_replace("{", "\n{", str_replace("}", "}\n", $data));
    file_put_contents(DIR_FS_CATALOG . 'index_top_debug.css', $data, 644);
}

function cssgenerator_index_products() {

    $data = '';
//1. WHERE max > 0 AND min=0 AND template='index_products' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT max AS init from css WHERE max > 0 AND min=0 AND template='index_products' AND  inline=0 AND status=1 ORDER BY max");
    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery($cssmain['init'], 0, 'index_products');
    }
// remove first bracket:
    $data = preg_replace('/^}/', '', $data, 1);
//css_compile
    $data = css_compile($data);

//2. default values
    $data .= css_compile(cssquery(0, 0, 'index_products', '', 1, 0));

//3. WHERE max = 0 AND min > 0 AND template='index_products' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT DISTINCT min AS init from css WHERE max = 0 AND min > 0 AND template='index_products' AND  inline=0 AND status=1 ORDER BY min");
    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery(0, $cssmain['init'], 'index_products');
    }
    $data = css_compile($data);
    file_put_contents(DIR_FS_CATALOG . 'index_products.css.gz', gzencode($data, 9), 644);
//working file:
    file_put_contents(DIR_FS_CATALOG . 'index_products.css', $data, 644);
//debug file
    $data = str_replace("{", "\n{", str_replace("}", "}\n", $data));
    file_put_contents(DIR_FS_CATALOG . 'index_products_debug.css', $data, 644);
    echo '$data:' . $data . "\n";
}

cssgenerator();
cssgenerator_index_top();
cssgenerator_index_products();
