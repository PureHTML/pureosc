<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

function tep_opendir($path)
{
    $path = rtrim($path, '/').'/';

    $exclude_array = ['.', '..', '.DS_Store', 'Thumbs.db'];

    $result = [];

    if ($handle = opendir($path)) {
        while (false !== ($filename = readdir($handle))) {
            if (!\in_array($filename, $exclude_array, true)) {
                $file = ['name' => $path.$filename,
                    'is_dir' => is_dir($path.$filename),
                    'writable' => tep_is_writable($path.$filename)];

                $result[] = $file;

                if ($file['is_dir'] === true) {
                    $result = array_merge($result, tep_opendir($path.$filename));
                }
            }
        }

        closedir($handle);
    }

    return $result;
}

$whitelist_array = [];

$whitelist_query = tep_db_query('select directory from sec_directory_whitelist');

while ($whitelist = tep_db_fetch_array($whitelist_query)) {
    $whitelist_array[] = $whitelist['directory'];
}

$admin_dir = basename(DIR_FS_ADMIN);

if ($admin_dir !== 'admin') {
    for ($i = 0, $n = \count($whitelist_array); $i < $n; ++$i) {
        if (substr($whitelist_array[$i], 0, 6) === 'admin/') {
            $whitelist_array[$i] = $admin_dir.substr($whitelist_array[$i], 5);
        }
    }
}

require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DIRECTORIES; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_WRITABLE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_RECOMMENDED; ?></td>
              </tr>
<?php
  foreach (tep_opendir(DIR_FS_CATALOG) as $file) {
      if ($file['is_dir']) {
          ?>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent"><?php echo substr($file['name'], \strlen(DIR_FS_CATALOG)); ?></td>
                <td class="dataTableContent" align="center"><?php echo tep_image('images/icons/'.(($file['writable'] === true) ? 'tick.gif' : 'cross.gif')); ?></td>
                <td class="dataTableContent" align="center"><?php echo tep_image('images/icons/'.(\in_array(substr($file['name'], \strlen(DIR_FS_CATALOG)), $whitelist_array, true) ? 'tick.gif' : 'cross.gif')); ?></td>
              </tr>
<?php
      }
  }

?>
              <tr>
                <td colspan="3" class="smallText"><?php echo TEXT_DIRECTORY.' '.DIR_FS_CATALOG; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
