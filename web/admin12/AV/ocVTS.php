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

require('../includes/configure.php');
require('../includes/filenames.php');

// default configuration
$CONFIG = Array();
$CONFIG['debug'] = 1;//jsp:default stop
$CONFIG['scanpath'] = $_SERVER['DOCUMENT_ROOT'];
$CONFIG['extensions'] = Array();

// attempt to load configuration file
@include("config.php");
@include("whitespace.php");
//@include("english.php");

// declare variables
$report = '';
$renadm = false;  // check if admin folder is renamed
$filem = false;   // check if file_manager.php excist in admin folder
$th_folder = true;  // check for known threat folder //jsp:default stop
$flagThreat = false;

// output html headers
renderhead();

// set counters
$dircount = 0;
$filecount = 0;
$infected = 0;
$finfected = 0;
$cnt = 0;
$wscnt = 0;

// load virus defs from flat file
if (!check_defs('virus.def'))
	trigger_error("Virus.def vulnerable to overwrite, please change permissions", E_USER_ERROR);
$defs = load_defs('virus.def', $CONFIG['debug']);
$filedefs = load_filedefs('files.def', $CONFIG['debug']);

//****************************************************************************
//****************************************************************************

// scan specified root for specified defs
file_scan($CONFIG['scanpath'], $defs, $CONFIG['debug']);


// output summary
echo '<p class=top>Scan Completed</p>';
echo '<p>osCommerce Virus & Threat Scan ' . $ver . '</p><br>';
echo '<p>Scan root: ' . $CONFIG['scanpath'] . '</p>';
echo '<div id=summary>';
echo '<p><strong>Threats Definitions:</strong> ' . sizeof($defs) . '</p>';
echo '<p><strong>Files Definitions:</strong> ' . sizeof($filedefs) . '</p>';
echo '<p><strong>Scanned folders:</strong> ' . $dircount . '</p>';
echo '<p><strong>Scanned files:</strong> ' . $filecount . '</p>';
echo '<p class=r><strong>Possible Infected files:</strong> ' . $infected . '</p>';
echo '<p class=f><strong>Possible Threat files:</strong> ' . $finfected . '</p>';
if ($chk_ws == true) {
echo '<p class=d><strong>Whitespace found:</strong> ' . $wscnt . '</p>';
}
echo '</div><br>';

// output full report
echo $report;
echo $reportws;

//****************************************************************************

//****************************************************************************
//removes string from the end of other
function removeFromEnd($string, $stringToRemove) {
    $stringToRemoveLen = strlen($stringToRemove);
    $stringLen = strlen($string);
    
    $pos = $stringLen - $stringToRemoveLen;

    $out = substr($string, 0, $pos);

    return $out;
}

//$string = 'picture.jpg.jpg';
//$string = removeFromEnd($string, '.jpg');

//****************************************************************************
function load_filedefs($file, $debug) {
	// reads tab-delimited defs file
	$filedefs = file($file);

	$counter = 0;
	$counttop = sizeof($filedefs);
	while ($counter < $counttop) {
		$filedefs[$counter] = explode('	', $filedefs[$counter]);
		$counter++;		
	}
	if ($debug)
		echo '<p>Loaded ' . sizeof($filedefs) . ' files definitions</p>';
	return $filedefs;
}
//*******************************************************************************  
function File_scan_threats($file) {
    global $report, $filem;

	$lines = file('files.def'); 
    foreach ($lines as $line_num => $line) 
    { 
    if (basename($file) == trim($line)) {	
	  $fname = basename($file);
	  $kat = removeFromEnd($file, $fname);
	  $prob = true;
      $report .= '<p class="f">File could be a potentional threat: ' . $kat . '<font color="blue">' . $fname . '</font>&nbsp;&nbsp;(Known filename threat)</p>';	  
      $flagThreat = true;
    }  
	// sijo - check for filemanager.php
    //if ($file == DIR_FS_ADMIN . FILENAME_FILE_MANAGER) {
	if ($file == DIR_FS_ADMIN . 'file_manager.php') {
	$filem = true;
	}
	// sijo - check for filemanager.php
	  if ($flagThreat) return true;
    }    
}   
//****************************************************************************

function file_scan($folder, $defs, $debug) {
	// hunts files/folders recursively for scannable items	
	global $dircount, $report, $renadm;	
	$dircount++;
	if ($debug)
		$report .= "<b><p class=\"d\">Scanning folder $folder ...</p></b>";
	if ($d = @dir($folder)) {
		while (false !== ($entry = $d->read())) {
			$isdir = @is_dir($folder.'/'.$entry);
			if (!$isdir and $entry!='.' and $entry!='..') {
				virus_check($folder.'/'.$entry,$defs,$debug);				
			} elseif ($isdir  and $entry!='.' and $entry!='..') {
				file_scan($folder.'/'.$entry,$defs,$debug);
			}
		}
		$d->close();	
	}
	
	// sijo - rename admin
	/*
    $findme   = 'admin';
    $pos = strpos($folder, $findme);
	if ($pos === false) {
	//do nothing
	} else {
	$renadm = true;
	}
	*/
	if (preg_match("/\badmin\b/i", DIR_FS_ADMIN)) { 
    $renadm = true;
    } else { 
    $renadm = false;
    } 

	// sijo - rename admin
	
	// sijo - threath folder
    $thdir   = '89trr';
    $pos = strpos($folder, $thdir);
	if ($pos === false) {
	//do nothing
	} else {
	$th_folder = true;
	}
	// sijo - threath folder
}

function virus_check($file, $defs, $debug) {
	global $filecount, $infected, $finfected, $report, $reportws, $wscnt, $CONFIG;
	
	@include("whitespace.php");
	
	// find scannable files
	$scannable = 0;
	foreach ($CONFIG['extensions'] as $ext) {
	
		if ((substr($file,-3)==$ext) || (substr($file,-2)==$ext) || (substr($file,-4)==$ext) || (substr($file,-5)==$ext))
			$scannable = 1;
	}
	
	if ($scannable) {
	// ************************************************** compare against defs - sijo	
	  // Check file for potential threats
      if (File_scan_threats($file)) {              
        // Set threat flag
          $flagThreat = true;
		  $finfected++;
      } 
	  // ************************************************** compare against defs - sijo
	  
	  // BOF sijo - check for leading & trailing whitspace
	  if (preg_match('/\\?'.'>\\s\\s+\\Z/m',file_get_contents($file)) && ($chk_ws == true)) {
	  $reportws .= '<p class="tws">Trailing WhiteSpace found in file: ' . "$file\n" . '</p>';
	  $wscnt++;
	  // sijo	
      if ($rmv_ws == true) {
	  //chmod file:
	  $chfile = substr($file,strpos($file,$ftp_root),strlen($file));
	  $conn = ftp_connect($ftp_site) or die("Could not connect");
      ftp_login($conn,$ftp_usr,$ftp_pwd);
      //ftp_chmod($conn,0777,$chfile);
	  //ftp_chmod($conn,$mode,$chfile);
	  //*********************
	  $phpv = substr(phpversion(), 0,1);
	  //echo $phpv;
	  if ($phpv == '5') {
	  ftp_chmod($conn, 0777, $chfile);
	  }
	  if ($phpv == '4') {
	  chmod($chfile, 0777);
	  }
      
	  /*
	  //Backup file:
	  $t=date("dmyHis");
	  $bck_file = $chfile . '.' . $t;
	  copy(basename($chfile), $bck_dir . basename($bck_file)); // make backup of file before removing whitespace
	  */
      // remove trailing whitespace:
	  $file_contents = file_get_contents($file);	
      $fh = fopen($file, "w");
	  $file_contents = rtrim($file_contents);
      fwrite($fh, $file_contents);
      fclose($fh);
	  //chmod file:
	  //ftp_chmod($conn,0644,$chfile);
	  if ($phpv == '5') {
	  ftp_chmod($conn, 0644, $chfile);
	  }
	  if ($phpv == '4') {
	  chmod($chfile, 0644);
	  }
      ftp_close($conn);
	  $reportws .= '<p class="rws">Trailing WhiteSpace removed from file: ' . "$file\n" . '</p>';
	  }
	  // sijo
	  }
	  if (preg_match('/^[\n\r|\n\r|\n|\r|\s]+\<\?php/',file_get_contents($file)) && ($chk_ws == true)) {
	  $reportws .= '<p class="lws">Leading WhiteSpace found in file: ' . "$file\n" . '</p>';
	  $wscnt++;
	  // sijo	       
	  if ($rmv_ws == true) {
	  //chmod file:
	  $chfile = substr($file,strpos($file,$ftp_root),strlen($file));
	  $conn = ftp_connect($ftp_site) or die("Could not connect");
      ftp_login($conn,$ftp_usr,$ftp_pwd);
      //ftp_chmod($conn,0777,$chfile);
	  $phpv = substr(phpversion(), 0,1);
	  //echo $phpv;
	  if ($phpv == '5') {
	  ftp_chmod($conn, 0777, $chfile);
	  }
	  if ($phpv == '4') {
	  chmod($chfile, 0777);
	  }
	  /*
	  //Backup file:
	  $t=date("dmyHsi");
	  $bck_file = $chfile . '.' . $t;
	  copy(basename($chfile), $bck_dir . basename($bck_file)); // make backup of file before removing whitespace
	  */
      // remove leading whitespace:	  
	  $file_contents = file_get_contents($file);
      $fh = fopen($file, "w");
	  $file_contents = ltrim($file_contents);
      fwrite($fh, $file_contents);
      fclose($fh);
	  //chmod file:
	  //ftp_chmod($conn,0644,$chfile);
	  if ($phpv == '5') {
	  ftp_chmod($conn, 0644, $chfile);
	  }
	  if ($phpv == '4') {
	  chmod($chfile, 0644);
	  }
      ftp_close($conn);
	  $reportws .= '<p class="rws">Leading WhiteSpace removed from file: ' . "$file\n" . '</p>';
	  }
	  // sijo
	  }
	  /*
	  1.trailingWhitespace = /\?\>[\n\r|\n\r|\n|\r|\s]+$/
	  2.leadingWhitespace = /^[\n\r|\n\r|\n|\r|\s]+\<\?php/
      	 
	  */
	  // EOF sijo - check for leading & trailing whitspace
	  
		// affectable formats
		$filecount++;
		$data = file($file);		
		$data = implode('\r\n', $data);
		$clean = 1;			
        
		foreach ($defs as $virus) {		
		//echo 'Test1 (' . $virus[0] . ')  -  (' . trim($virus[1]) . ')';        			
			if (strpos($data, trim($virus[1]))) {
			   if (trim($virus[1]) == '<iframe') {
			   $virus[1] = 'iframe';
			   }		
			   if (trim($virus[1]) == '<frame') {
			   $virus[1] = 'frame';
			   }	
			   $prob = true;	
			   
                // sijo - find linenumber of threat BOF
		        $cnt = 1; 				
                $mfile = fopen($file, "r") ;

                while (!feof($mfile)) { // Untill the end of the file 
                $line = fgets($mfile);                 
                if (strstr($line, trim($virus[1]))) {
                break; 
                } 
                $cnt++; 
                }                 
		        // sijo - find linenumber of threat EOF
				
				// file matches virus defs
				//if ($exvts == true) {
				// sijo - check permission of .htaccess
				If (basename($file) == '.htaccess') {
				$perms = substr(sprintf('%o', fileperms($file)), -4);
				//echo '(' . $perms . ')';
                 if (($perms <> '0644') || ($perms <> '644'))
			     $report .= '<p class="perms"><b>You should change permission on file: ' . $file . ' (' . $perms . ')' . '</b></p>';
			    }
				// sijo - check permission of .htaccess
				if ((basename($file) <> 'ocVTS.php') && (basename($file) <> 'ocVTSa.php')) // sijo - exclude VTS scanning
				$report .= '<p class="r">Possible Infection: ' . $file . ' (' . $virus[0] . ' <=> <font color="blue">' . $virus[1] . '</font>) on line: ' . $cnt . '</p>';
                if ((basename($file) <> 'ocVTS.php') && (basename($file) <> 'ocVTSa.php')) // sijo - exclude VTS count
				$infected++;
				$clean = 0;
			}
			//if ($virus[1] == 'eval(base64_decode') {
			//echo 'Test1 ' . $virus[0] . '  -  ' . $virus[1];
			//}
		}
		
		if (($debug)&&($clean))
			$report .= '<p class="g">&nbsp;&nbsp;&nbsp;&nbsp;Clean: ' . $file . '</p>';			
	}
}

function load_defs($file, $debug) {
	// reads tab-delimited defs file
	
	$defs = file($file);
	$counter = 0;
	$counttop = sizeof($defs);
	while ($counter < $counttop) {
		$defs[$counter] = explode('	', $defs[$counter]);
		$counter++;		
	}
	if ($debug)
		echo '<p>Loaded ' . sizeof($defs) . ' virus definitions</p>';
	return $defs;
}

function check_defs($file) {
	// check for >755 perms on virus defs
	clearstatcache();
	$perms = substr(decoct(fileperms($file)),-2);
	
	if ($perms > 55)
		return false;
	else
		return true;
}

function renderhead() {
?>

<html>
<head>
<title>osCommerce Virus and Threats Scan</title>
<style type="text/css">
.top {
	font-family: arial;
	font-size: 20px;
}

p {
	font-family: arial;
	padding: 0;
	margin: 0;
	font-size: 10px;
}

.g {
	color: #808080; 
}
.perms {
	color: red; 
}

.tws {
	color: #0066FF; 
	font-size: 10px;
	font-weight: bold;
}
.lws {
	color: #3399FF; 
	font-size: 10px;
	font-weight: bold;
}
.rws {
	color: #009933; 
	font-size: 10px;
	font-weight: bold;
}

.r {
	color: #990000;
	font-weight: bold;
}
.f {
	color: #FF33CC;
	font-weight: bold;
}

.d {
	color: #0066FF;
}
.bg {
	background-color: green;
}


#summary {
	border: #333 solid 1px;
	background: #D7E8FF;
	padding: 10px;
	/*margin: 10px;*/
}

#summary p {
	font-size: 12px;
}
.print {
	text-align: right;
}
.ren {
	color: #FFFF00;
	font-size: 14px;
	background-color: #FF0000;
}
.donate {
	font-size: small;
}
</style>
</head>

<body>
<?php
}
?>
<br> 

<?php
if ($renadm == true) {
echo '<p><span class="ren"><strong>&nbsp;&nbsp;==>>&nbsp; You should rename your admin folder !&nbsp;&nbsp;
      </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://forums.oscommerce.com/index.php?showtopic=340995">
      How to rename admin</a></p><br>';
}
if ($filem == true) {
echo '<p><span class="ren"><strong>&nbsp;&nbsp;==>>&nbsp; You should delete <b>file_manager.php</b> from your admin folder !&nbsp;&nbsp;
      </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;</p><br>';
}
if ($th_folder == true) {
echo '<p><span class="ren"><strong>&nbsp;&nbsp;==>>&nbsp; You should delete ' . $thdir . ' from your site !&nbsp;&nbsp;
      </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;</p><br>';
}


echo '<BUTTON onclick="window.close();">Close me</BUTTON>';
?>
<td style="width: 306px" class="donate">&nbsp;&nbsp;&nbsp;
			<a target="_blank" href="http://www.dyg.no/donate.htm" class="style6">
			Donate</a></td>
<div class="print">
<a href="JavaScript:window.print();">Print this page</a> 
</div>
</body>
</html>
