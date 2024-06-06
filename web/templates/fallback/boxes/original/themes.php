<?php
/*
themes.php v.1.2
made by Vlad Savitsky 2005/07/05
http://www.solti.com.ua
Released under the GNU General Public License
*/

if (TEMPLATE_SWITCHING_MENU_BOX == 'true') {

$boxHeading = BOX_HEADING_THEMES;
$corner_left = 'square';
$corner_right = 'square';
$box_base_name = 'themes'; // for easy unique box template setup (added BTSv1.2)
$box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
$boxContent_attributes = ' align="center"';

function get_themes() {
    $dir=getcwd()."/templates/";
    if (is_dir($dir)) {
        if ($dh=opendir($dir)) {
            while (($file = readdir($dh))!==false) {
                if(filetype($dir.$file)=="dir") {
                    if($file!= "..") {
                        $firstchar=substr($file, 0, 1);
                        if(($firstchar != "_")&&($firstchar != "."))     $themes[]=array('id'=>$file, 'text'=>$file);
                    }
                }
            }
            closedir($dh);
        }
    }
    return $themes;
}

$boxContent = tep_draw_form('themes', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');

$tmpl_name=explode ( '/', $tplDir);
$boxContent .= tep_draw_pull_down_menu_label(BOX_HEADING_THEMES, 'theme_change', 'tplDir', get_themes(), $tmpl_name[1], 'onchange="this.form.submit();"');
$boxContent .= '</form>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
$boxContent_attributes = '';

}
?>