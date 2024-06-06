<?php
/*

 ************************************************
 * osCommerce Virus & Threat Scanner - v.1.0.10 *
 ************************************************
 
 Support:
 http://forums.oscommerce.com/topic/356128-oscommerce-vts/
 
 * Original developer of this script are 
 * E.Yekta

 * This software is provided as-is, without warranty or guarantee of
 * any kind. Use at your own risk. 
 */

@include("config.php");
?>
<html>
<head>
<style type="text/css">
.style2 {
	text-align: center;
	background-color: #D7E8FF;
	font-size: medium;
	color: #0000FF;
}
.style9 {
	text-align: center;
	font-size: x-small;
}
</style>
</head>
<body>
<dt>
<p class="style2"><b>ocVTS grep <?php echo $ver; ?></b></p>
<p class="style9">(Search your site for keywords)</p>
</dt>
<?php
ini_set('display_errors', 1);  // set to 0 for production version 
error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL); 
//error_reporting(0); 

$txt1 = '';
$results = '';
$txt3 = '';
$txt2 = '';


	define("SLASH", stristr($_SERVER[SERVER_SOFTWARE], "win") ? "\\" : "/");
	
	$path	= ($_POST[path]) ? $_POST[path] : dirname(__FILE__) ;
	$q		= $_POST[q];
	$cnt = 0;
	
	function php_grep($q, $path){
		global $cnt, $q;
		$fp = opendir($path);
		while($f = readdir($fp)){
			if( preg_match("#^\.+$#", $f) ) continue; // ignore symbolic links
			$file_full_path = $path.SLASH.$f;
			if(is_dir($file_full_path)) {
				$ret .= php_grep($q, $file_full_path);				
			} else if( stristr(file_get_contents($file_full_path), $q) ) {
				$ret .= "\n$file_full_path"; 
                $cnt++;				
			}				
		}
		return $ret;	
	}


	if($q){
		$results = php_grep($q, $path);
		$txt1 = '<b>Result:</b> Found ' . $cnt . ' files containing your keyword';
		$txt2 = '<br><BUTTON onclick="window.close();">Close me</BUTTON>';
		$txt3 = '<br><a href="JavaScript:window.print();">Print this page</a>';
	}
	
	echo <<<HRD
	<pre >
	<form method=post>
		<input name=path size=100 value="$path" /> <b>Path </b>
		<input name=q size=100 value="$q" /> <b>Query</b>
		<input type=submit>
	</form>
    $txt1
		$results
	$txt3
	$txt2
	</pre >	
HRD;
echo '</body></html>';
?>