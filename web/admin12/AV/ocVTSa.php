<?php
/*
 ************************************************
 * osCommerce Virus & Threat Scanner - v.1.0.10 *
 ************************************************

 Support:
 http://forums.oscommerce.com/topic/356128-oscommerce-vts/
 
 * Original developers of this script are 
 * Miroslav Yovchev aka SecretR Copyright 2010 free-source.net

 * This software is provided as-is, without warranty or guarantee of
 * any kind. Use at your own risk.

*/

ini_set('display_errors', 1);  // set to 0 for production version 
error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL); 
//error_reporting(0); 

// attempt to load configuration file
@include("config.php");

$self = basename(__FILE__);

//$eroot = '../';
$eroot = $CONFIG['scanpath'];
$print_infected = true;
$print_suspected = true;
$print_all = false;
$recurse = 100;
$cnt = 0;
$ext = '';
?>
<html>
<head>
<title>osCommerce Virus and Threats Scan</title>
<style type="text/css">
.print {
	text-align: right;
}
#report {
	font-size: x-small;
}
#summary {
	border: #333 solid 1px;
	background: #D7E8FF;
	padding: 10px;
	/*margin: 10px;*/
}
</style>

</head>
<body>

<?php

print "<pre>";
print "<div id=summary>";
print "<b>osCommerce VTSa {$ver} \n</b>";
print "Directory depth set to {$recurse}\n";
print "Directory root: {$eroot}\n";
print "</div><br><div id=report>";

$fl = new e_file();
//$tree = $fl->get_files($eroot, '\.php|\.sc|.bb|\.gif', 'standard', $recurse);
$tree = $fl->get_files($eroot, '\.php|\.php3|\.php4|\.php5|\.js|\.sc|.bb|\.gif', 'standard', $recurse);

$counter_infected = 0;
$counter_cleaned = 0;
$counter_suspected = 0;
$counter_error = 0;
$counter_warning = 0;

// just in case
//set_time_limit(60);  // use if not in safe mode
error_reporting(E_ALL);

foreach ($tree as $finfo) 
{
	// exclude self
	if(strpos($finfo['fname'], $self) !== FALSE && realpath(__FILE__) == realpath($finfo['path'].$finfo['fname']))
	{
		continue;
	}
	
	if($print_all) print "{$finfo['path']}{$finfo['fname']}....CHECKING";
	$tmp = file_get_contents($finfo['path'].$finfo['fname']);
	
	preg_match('/[^.\s]*([a-z])$/i', $finfo['fname'], $match);
	
	if(preg_match('/[^.\s]*([a-z])$/i', $finfo['fname'], $match))
	{
		$ext = $match[0];
		unset($match);
	}
	
	//<\?(php)?/i - short tag detection problem
	//if('gif' == $ext && preg_match('/<\?php/i', $tmp))
	if($ext == 'gif' && preg_match('/<\?php/i', $tmp))
	{
	    // sijo - find linenumber of threat BOF
		        $cnt = 1; 
                $mfile = fopen($finfo['path'].$finfo['fname'], "r") ;

                while (!feof($mfile)) { // Untill the end of the file 
                $line = fgets($mfile); 
                if ('gif' == $ext && preg_match('/<\?php/i',$line)) {      				
                break; 
                } 
                $cnt++; 
                } 
                //echo $cnt; 
		// sijo - find linenumber of threat EOF
		$counter_infected++;
		$counter_error++;
		if($print_infected) print "{$finfo['path']}{$fb3}{$finfo['fname']}{$fe3}";
		if($print_infected || $print_all) 
		{
			print $fb1 . "...INFECTED (PHP open tag inside GIF image)";
			print("\n\ERROR: {$finfo['path']}{$finfo['fname']} will not be auto-deleted, you have to delete it manually if you think it's a threat!" . $fe1 . ' on line: ' . $cnt . "\n\n");
		}
		
	}
	// known infection - can be auto-cleaned
	elseif(preg_match('#^(.*)<\?php(.*)eval(\s*)\((\s*)base64_decode(\s*)\((\s*)(.*)(\?><\?php)*\n#i', $tmp, $matches))
	{
		if($print_infected) print "{$finfo['path']}{$finfo['fname']}";
		if($print_infected || $print_all) print "...INFECTED";
		$counter_infected++;
		$counter_error++;
		print("\n\ERROR: {$finfo['path']}{$finfo['fname']} will NOT BE CLEANED! Please use the shell version of this script.\n\n");
		continue;
	}
	// just a guess - eval(base64_decode(... pattern match 
	elseif(preg_match('#eval(\s*)\((.*)base64_decode(\s*)\(#i', $tmp))
	{
	    // sijo - find linenumber of threat BOF	
		        $cnt = 1; 
                $mfile = fopen($finfo['path'].$finfo['fname'], "r") ;

                while (!feof($mfile)) { // Untill the end of the file 
                $line = fgets($mfile); 
                if (preg_match('#eval(\s*)\((.*)base64_decode(\s*)\(#i',$line)) {                 
                break; 
                } 
                $cnt++; 
                } 
                //echo $cnt; 
		// sijo - find linenumber of threat EOF
		if($print_suspected) print "{$finfo['path']}{$finfo['fname']}"; 
		if($print_suspected || $print_all) print $fb4 . "...SUSPECTED (eval/base64_decode found)" . $fe4 . ' on line: ' . $cnt ;
		$counter_suspected++;
		if($print_suspected || $print_all) print "\n";			
	}  
	// Found inside the compromised e107 full release (class2.php)
	elseif(preg_match('/\$_COOKIE\[[\'|"]access-admin[\'|"]\]/i', $tmp))
	{
	    // sijo - find linenumber of threat BOF
		        $cnt = 1; 
                $mfile = fopen($finfo['path'].$finfo['fname'], "r") ;

                while (!feof($mfile)) { // Untill the end of the file 
                $line = fgets($mfile); 
                if (preg_match('/\$_COOKIE\[[\'|"]access-admin[\'|"]\]/i',$line)) {                 
                break; 
                } 
                $cnt++; 
                } 
                //echo $cnt; 
		// sijo - find linenumber of threat EOF
		if($print_infected) print "{$finfo['path']}{$finfo['fname']}";
		if($print_infected || $print_all) 
		{
			print "...INFECTED (access-admin COOKIE reference)\n";
		}
		print("\nERROR: {$finfo['path']}{$finfo['fname']} can't be auto-cleaned!\n\n");
		$counter_infected++;
		$counter_error++;
		continue;
	}
	// Just search for shell execution here, it'll also match some clean core files
	elseif(preg_match('/([^a-z0-9_>])(shell_exec(\s*)\(|system(\s*)\(|exec(\s*)\(|passthru(\s*)\()/i', $tmp))
	{
	    // sijo - find linenumber of threat BOF
		        $cnt = 1; 
                $mfile = fopen($finfo['path'].$finfo['fname'], "r") ;

                while (!feof($mfile)) { // Untill the end of the file 
                $line = fgets($mfile); 
                if (preg_match('/([^a-z0-9_>])(shell_exec(\s*)\(|system(\s*)\(|exec(\s*)\(|passthru(\s*)\()/i',$line)) {                 
                break; 
                } 
                $cnt++; 
                } 
                //echo $cnt; 
		// sijo - find linenumber of threat EOF
		if($print_suspected) print "{$finfo['path']}{$finfo['fname']}";
		if($print_suspected || $print_all) print $fb2 . "...SUSPECTED (shell execution)" . $fe2 . ' on line: ' . $cnt . "\n";
		$counter_suspected++;
	}
	elseif($print_all) print "...OK\n";
	unset($tmp);
}
echo "\n</div>";
print "<div id=summary>";
print "Files checked: ".count($tree)."\n";
print "Files suspected: ".$counter_suspected."\n";
print $fb1 . "Files infected: ".$counter_infected."\n" . $fe1;
print "Files cleaned: ".$counter_cleaned."\n";
print "Clean errors: ".$counter_error."\n";
print "Clean warnings: ".$counter_warning."\n\n";
if($counter_suspected) print "<b>NOTE: SUSPECTED DOESN'T MEAN INFECTED!\n" .
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIFF AGAINST TRUSTED COPY OF SUSPECTED FILES TO BE SURE EVERYTHING IS OK. \n\n</b>";
print "</div></pre>";
echo '<BUTTON onclick="window.close();">Close me.</BUTTON>';
?>
<div class="print">
<a href="JavaScript:window.print();">Print this page</a> 
</div>
</body>
</html>
<?php
exit;

class e_file
{
	function get_files($path, $fmask = '', $omit='standard', $recurse_level = 0, $current_level = 0)
	{
		$ret = array();
		if($recurse_level != 0 && $current_level > $recurse_level)
		{
			return $ret;
		}
		if(substr($path,-1) == '/')
		{
			$path = substr($path, 0, -1);
		}

		if(!$handle = opendir($path))
		{
			return $ret;
		}
		if($omit == 'standard')
		{
			$rejectArray = array('^\.$','^\.\.$','^\/$','^CVS$','thumbs\.db','.*\._$','^\.htaccess$','index\.html','null\.txt');
		}
		else
		{
			if(is_array($omit))
			{
				$rejectArray = $omit;
			}
			else
			{
				$rejectArray = array($omit);
			}
		}
		while (false !== ($file = readdir($handle)))
		{
			if(is_dir($path.'/'.$file))
			{
				if($file != '.' && $file != '..' && $file != 'CVS' && $recurse_level > 0 && $current_level < $recurse_level)
				{
					$xx = $this->get_files($path.'/'.$file, $fmask, $omit, $recurse_level, $current_level+1);
					$ret = array_merge($ret,$xx);
				}
			}
			elseif ($fmask == '' || preg_match("#".$fmask."#i", $file))
			{
				$rejected = FALSE;

				foreach($rejectArray as $rmask)
				{
					if(preg_match("#".$rmask."#", $file))
					{
						$rejected = TRUE;
						break;
					}
				}
				if($rejected == FALSE)
				{
					$finfo['path'] = $path."/";  // important: leave this slash here and update other file instead.
					$finfo['fname'] = $file;
					$ret[] = $finfo;
				}
			}
		}
		return $ret;
	}

	function get_dirs($path, $fmask = '', $omit='standard')
	{
		$ret = array();
		if(substr($path,-1) == '/')
		{
			$path = substr($path, 0, -1);
		}

		if(!$handle = opendir($path))
		{
			return $ret;
		}
		if($omit == 'standard')
		{
			$rejectArray = array('^\.$','^\.\.$','^\/$','^CVS$','thumbs\.db','.*\._$');
		}
		else
		{
			if(is_array($omit))
			{
				$rejectArray = $omit;
			}
			else
			{
				$rejectArray = array($omit);
			}
		}
		while (false !== ($file = readdir($handle)))
		{
			if(is_dir($path.'/'.$file) && ($fmask == '' || preg_match("#".$fmask."#", $file)))
			{
				$rejected = FALSE;
				foreach($rejectArray as $rmask)
				{
					if(preg_match("#".$rmask."#", $file))
					{
						$rejected = TRUE;
						break;
					}
				}
				if($rejected == FALSE)
				{
					$ret[] = $file;
				}
			}
		}
		return $ret;
	}

	function rmtree($dir)
	{
		if (substr($dir, strlen($dir)-1, 1) != '/')
		{
			$dir .= '/';
		}
		if ($handle = opendir($dir))
		{
			while ($obj = readdir($handle))
			{
				if ($obj != '.' && $obj != '..')
				{
					if (is_dir($dir.$obj))
					{
						if (!$this->rmtree($dir.$obj))
						{
							return false;
						}
					}
					elseif (is_file($dir.$obj))
					{
						if (!unlink($dir.$obj))
						{
							return false;
						}
					}
				}
			}

			closedir($handle);

			if (!@rmdir($dir))
			{
				return false;
			}
			return true;
		}
		return false;
	}

}
?>