<?php
/*
 ************************************************
 * osCommerce Virus & Threat Scanner - v.1.0.10 *
 ************************************************
*/

ini_set('display_errors', 1);  // set to 0 for production version 
error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL); 
//error_reporting(0); 

@include("config.php");
$newver = '';
$fnts = '<font color="red"><b>';
$fnte = '</b></font>';

@include("whitespace.php");
if ($rmv_ws == true) {
Echo $fnts . 'You have activated whitespace removing. (whitespace.php) Remember to BACKUP first!' . $fnte;
}

// make sure curl is installed - Removed until version checking by Jack is implemented
if (function_exists('xxxcurl_init')) {
   // initialize a new curl resource
   $ch = curl_init(); 

   // set the url to fetch
   curl_setopt($ch, CURLOPT_URL, 'http://www.dyg.no/catalog/ocVTS.txt'); 

   // don't give me the headers just the content
   curl_setopt($ch, CURLOPT_HEADER, 0); 

   // return the value instead of printing the response to browser
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   // use a user agent to mimic a browser
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0'); 

   $content = curl_exec($ch); 
   $newver = ltrim($content, "ÿþ");
   if ($newver <> $ver) {
   $newver = $fnts . 'New version available: ' . $newver . $fnte;
   //echo $newver;
   } else {
   $newver = 'Your have current version.';
   }
   //echo 'current version in use.';
   // remember to always close the session and free all resources 
   curl_close($ch);
} else {
   // curl library is not installed so we better use something else
   $newver = 'Check for new version';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="no-bok" />
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>osCommerce Virus and Threats Scanner <?php echo $ver; ?></title>
<style type="text/css">
.style2 {
	text-align: center;
	background-color: #D7E8FF;
	font-size: medium;
	color: #0000FF;
}

.style4 {
	text-align: center;
	text-decoration: underline;
}
.style6 {
	text-decoration: none;
}
a:visited {
	color: #0000FF;
}
.style7 {
	font-size: x-small;
	text-align: center;
	background-color: #D7E8FF;
}
.style8 {
	border: 2px solid #D7E8FF;
}
.style9 {
	text-align: center;
}
.style10 {
	font-size: x-small;
}
.style11 {
	text-align: center;
	font-size: small;
}
</style>
</head>

<body>
<?php
// attempt to load configuration file
//@include("config.php");
?>
<dl>
	<table style="width: 500px" align="center" class="style8">
		<tr>
			<td colspan="3" class="style2">
<strong>Welcome to osCommerce Virus &amp; Threat Scanner <?php echo $ver; ?></strong></td>
		</tr>
		<tr>
			<td colspan="3">
&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">
<dl>
	<dt class="style4"><strong>What do you want to do?</strong></dt>
</dl>
			</td>
		</tr>
		<tr>
			<td style="width: 81px; height: 23px;" class="style9">
			<a target="_blank" href="ocVTS.php" class="style6" alt="Please be patient.  This will take some time depending on how many files and folders you are scanning!" title="Please be patient.  This will take some time depending on how many files and folders you are scanning!" >
			<strong>ocVTS</strong></a> 
		</td>
			<td style="height: 23px; width: 306px">Scan your site using 
			'virus.def' and 'files.def' files</td>
			<td style="height: 23px">&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">
			<a target="_blank" href="ocVTSa.php" class="style6" alt="Please be patient.  This will take some time depending on how many files and folders you are scanning!" title="Please be patient.  This will take some time depending on how many files and folders you are scanning!" >
			<strong>ocVTSa</strong></a> </td>
			<td style="width: 306px">Scan your site for more possible threats</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">
			<a target="_blank" href="grep.php" class="style6" alt="Please be patient.  This will take some time depending on how many files and folders you are scanning!" title="Please be patient.  This will take some time depending on how many files and folders you are scanning!" >
			<strong>ocVTS grep</strong></a> </td>
			<td style="width: 306px">Scan your site for your own keywords</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">&nbsp;</td>
			<td style="width: 306px">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">
			<a target="_blank" href="http://forums.oscommerce.com/topic/313323-how-to-secure-your-site/" class="style6">
			<strong>Help</strong></a></td>
			<td style="width: 306px">Get security help from osCommerce Forums</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">
			<a target="_blank" href="http://addons.oscommerce.com/info/7279" class="style6">
			<strong>Version</strong></a></td>
			<td style="width: 306px"><?php echo $newver; ?> <!--Check if you have latest version of these scanners--></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">
			<a target="_blank" href="http://forums.oscommerce.com/topic/356128-oscommerce-vts/" class="style6">
			<strong>Support</strong></a></td>
			<td style="width: 306px">osCommerce VTS support forum</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px">&nbsp;</td>
			<td style="width: 306px">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px">&nbsp;</td>
			<td style="width: 306px">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 81px" class="style9">
<input type=button value="Back" onClick="history.go(-1)"/></td>
			<td style="width: 306px" class="style10">
			<a target="_blank" href="http://www.dyg.no/donate.htm" class="style6">
			Donate</a></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" class="style11">
Get other security contributions:</td>
		</tr>
		<tr>
			<td colspan="3" class="style9">
<span class="style10">
<a target="_blank" href="http://addons.oscommerce.com/info/5752">Security Pro</a> |
<a target="_blank" href="http://addons.oscommerce.com/info/4441">SiteMonitor</a> | 
<a target="_blank" href="http://addons.oscommerce.com/info/5914">IP trap</a> |
<a target="_blank" href="http://addons.oscommerce.com/info/6066">htaccess</a> |
<a target="_blank" href="http://addons.oscommerce.com/info/6044">AntiXSS</a> |
<a target="_blank" href="http://addons.oscommerce.com/info/6134">Check Permissions</a> |
<a target="_blank" href="http://addons.oscommerce.com/info/7546">KISS FileSafe</a>
</span></td>
		</tr>
		<tr>
			<td colspan="3" class="style7">
osCommerce VTS <?php echo $ver; ?>&nbsp; Copyright © sijo 2010</td>
		</tr>
	</table>
</dl>
</body>

</html>
