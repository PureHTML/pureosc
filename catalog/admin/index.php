<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$languages = tep_get_languages();
$languages_array = [];
$languages_selected = DEFAULT_LANGUAGE;

for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
    $languages_array[] = ['id' => $languages[$i]['code'],
        'text' => $languages[$i]['name']];

    if ($languages[$i]['directory'] === $language) {
        $languages_selected = $languages[$i]['code'];
    }
}

require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2" height="40">
          <tr>
            <td class="pageHeading"><?php echo STORE_NAME; ?></td>

<?php
  if (\count($languages_array) > 1) {
      ?>

            <td class="pageHeading" align="right"><?php echo tep_draw_form('adminlanguage', 'index.php', '', 'get').tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onchange="this.form.submit();"').tep_hide_session_id().'</form>'; ?></td>

<?php
  }

?>

          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (\defined('MODULE_ADMIN_DASHBOARD_INSTALLED') && !empty(MODULE_ADMIN_DASHBOARD_INSTALLED)) {
      $adm_array = explode(';', MODULE_ADMIN_DASHBOARD_INSTALLED);

      $col = 0;

      for ($i = 0, $n = \count($adm_array); $i < $n; ++$i) {
          $adm = $adm_array[$i];

          $class = substr($adm, 0, strrpos($adm, '.'));

          if (!class_exists($class)) {
              include 'includes/languages/'.$language.'/modules/dashboard/'.$adm;

              include 'includes/modules/dashboard/'.$class.'.php';
          }

          $ad = new $class();

          if ($ad->isEnabled()) {
              if ($col < 1) {
                  echo "          <tr>\n";
              }

              ++$col;

              if ($col <= 2) {
                  echo '            <td width="50%" valign="top">'."\n";
              }

              echo $ad->getOutput();

              if ($col <= 2) {
                  echo "            </td>\n";
              }

              if (!isset($adm_array[$i + 1]) || ($col === 2)) {
                  if (!isset($adm_array[$i + 1]) && ($col === 1)) {
                      echo '            <td width="50%" valign="top">&nbsp;</td>'."\n";
                  }

                  $col = 0;

                  echo "  </tr>\n";
              }
          }
      }
  }

?>
        </table></td>
      </tr>
    </table>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
