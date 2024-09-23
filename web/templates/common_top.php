<?php
/*
Contributed by: <-- R O B --> La Rochelle France
Released under the GNU General Public License
2004/01/29

Automaticly shows all templates folders except the ones starting with an underscore
(i.e.: "_my-secret-template-dir/")
Just copy this file to your templates directory,
and include it in your main_page.tpl.php files for example.
*/

if (GOOGLE_ANLYTICS_CODE_USE == 'true') {
   if( $_SERVER['HTTPS'] != "on" ){
?>
    <!-- Google Analytics Code -->
    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
    </script>
    <script>
    _uacct = "<?php echo GOOGLE_ANLYTICS_CODE; ?>";
    urchinTracker();
    </script>
    <!-- End Google Analytics Code -->
<?php
  } else {
?>
    <!-- Google Analytics Code -->
    <script src="https://ssl.google-analytics.com/urchin.js" type="text/javascript">
    </script>
    <script>
    _uacct = "<?php echo GOOGLE_ANLYTICS_CODE; ?>";
    urchinTracker();
    </script>
    <!-- End Google Analytics Code -->
<?php
  }
}
 
if ((TEMPLATE_SWITCHING_ALLOWED == 'true') && (TEMPLATE_SWITCHING_MENU == 'true'))
{
  echo '<div id="templateSwitcher" class="InfoBoxContenent2MA">';
  echo 'Switch template: ';
  $dir =  getcwd()."/templates/" ; /* get the current path and add "/templates/" to the end */
  if (is_dir($dir))
  {
    /* check if the path is a directory */
    if ($dh = opendir($dir))
    {
      /* create a file system object ($dh) */
      while (($file = readdir($dh)) !== false)
        {
          /* repeat with all the files in the directory */
          if(filetype($dir . $file) == "dir")
          {
            /* if the file in the directory is a folder */
            if($file != "..")
            {
              /* if the folder isn't called ".." (this is not a folder as such, I think its to go up one level?) */
              $firstchar = substr($file, 0, 1); // get the first character of the folder's name
              if(($firstchar != "_")&&($firstchar != "."))
              {
                /* this means that any folder starting with "_" won't be displayed, allows to have secret template in the directory */
                $ts_template_array[]= $file;              }
            }
          }
        }
      closedir($dh); /* close the file sytem object */
    }
  }
if (is_array ($ts_template_array)) sort ($ts_template_array,SORT_STRING);
foreach ($ts_template_array as $file) {
  echo "<a class=\"ColorRed\" href=\"" . tep_href_link('index.php', 'tplDir='.$file) . "\">$file</a>  -  "; 
}  
echo '<br />Current template directory: ' .  '<span class="ColorRed">' . DIR_WS_TEMPLATES . '</span>';
echo '</div>';
}
?>