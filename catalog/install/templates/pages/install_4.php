<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require '../includes/database_tables.php';

osc_db_connect(trim($_POST['DB_SERVER']), trim($_POST['DB_SERVER_USERNAME']), trim($_POST['DB_SERVER_PASSWORD']));
osc_db_select_db(trim($_POST['DB_DATABASE']));

osc_db_query('update configuration  set configuration_value = "'.trim($_POST['CFG_STORE_NAME']).'" where configuration_key = "STORE_NAME"');
osc_db_query('update configuration set configuration_value = "'.trim($_POST['CFG_STORE_OWNER_NAME']).'" where configuration_key = "STORE_OWNER"');
osc_db_query('update configuration set configuration_value = "'.trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']).'" where configuration_key = "STORE_OWNER_EMAIL_ADDRESS"');

if (!empty($_POST['CFG_STORE_OWNER_NAME']) && !empty($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS'])) {
    osc_db_query('update configuration set configuration_value = "\"'.trim($_POST['CFG_STORE_OWNER_NAME']).'\" <'.trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']).'>" where configuration_key = "EMAIL_FROM"');
} else {
    osc_db_query('update configuration set configuration_value = "'.trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']).'" where configuration_key = "EMAIL_FROM"');
}

if (!empty($_POST['CFG_ADMINISTRATOR_USERNAME'])) {
    $check_query = osc_db_query('select user_name from administrators where user_name = "'.trim($_POST['CFG_ADMINISTRATOR_USERNAME']).'"');

    if (osc_db_num_rows($check_query)) {
        osc_db_query('update administrators set user_password = "'.osc_encrypt_password(trim($_POST['CFG_ADMINISTRATOR_PASSWORD'])).'" where user_name = "'.trim($_POST['CFG_ADMINISTRATOR_USERNAME']).'"');
    } else {
        osc_db_query('insert into administrators (user_name, user_password) values ("'.trim($_POST['CFG_ADMINISTRATOR_USERNAME']).'", "'.osc_encrypt_password(trim($_POST['CFG_ADMINISTRATOR_PASSWORD'])).'")');
    }
}

osc_db_query('update configuration set configuration_value = "'.trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']).'" where configuration_key = "MODULE_PAYMENT_PAYPAL_EXPRESS_SELLER_ACCOUNT"');
?>

<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li>Web Server</li>
      <li>Online Store Settings</li>
      <li style="font-weight: bold;">Finished!</li>
    </ol>
  </div>

  <h1>New Installation</h1>

  <p>This web-based installation routine will correctly setup and configure osCommerce Online Merchant to run on this server.</p>
  <p>Please follow the on-screen instructions that will take you through the database server, web server, and store configuration options. If help is needed at any stage, please consult the documentation or seek help at the community support forums.</p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Step 4: Finished!</h3>

    <div class="infoPaneContents">
      <p>Congratulations on installing and configuring osCommerce Online Merchant as your online store solution!</p>
      <p>We wish you all the best with the success of your online store and welcome you to join and participate in our community.</p>
      <p align="right">- The osCommerce Team</p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Finished!</h2>

    <?php
    $dir_fs_document_root = $_POST['DIR_FS_DOCUMENT_ROOT'];

if ((substr($dir_fs_document_root, -1) !== '\\') && (substr($dir_fs_document_root, -1) !== '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
        $dir_fs_document_root .= '\\';
    } else {
        $dir_fs_document_root .= '/';
    }
}

osc_db_query('update configuration set configuration_value = "'.$dir_fs_document_root.'includes/work/" where configuration_key = "DIR_FS_CACHE"');
osc_db_query('update configuration set configuration_value = "'.$dir_fs_document_root.'includes/work/" where configuration_key = "SESSION_WRITE_DIRECTORY"');

if ($handle = opendir($dir_fs_document_root.'includes/work/')) {
    while (false !== ($filename = readdir($handle))) {
        if (substr($filename, strrpos($filename, '.')) === '.cache') {
            @unlink($dir_fs_document_root.'includes/work/'.$filename);
        }
    }

    closedir($handle);
}

$url = parse_url($_POST['WWW_ADDRESS']);

if ($url['scheme'] === 'http') {
    $http_server = $url['scheme'].'://'.$url['host'];
    $https_server = '';
} else {
    $http_server = substr($url['scheme'], 0, -1).'://'.$url['host'];
    $https_server = $url['scheme'].'://'.$url['host'];
}

$http_catalog = $url['path'];

if (isset($url['port']) && !empty($url['port'])) {
    $http_server .= ':'.$url['port'];
}

if (substr($http_catalog, -1) !== '/') {
    $http_catalog .= '/';
}

$admin_folder = 'admin';

if (isset($_POST['CFG_ADMIN_DIRECTORY']) && !empty($_POST['CFG_ADMIN_DIRECTORY']) && osc_is_writable($dir_fs_document_root) && osc_is_writable($dir_fs_document_root.'admin')) {
    $admin_folder = preg_replace('/[^a-zA-Z0-9]/', '', trim($_POST['CFG_ADMIN_DIRECTORY']));

    if (empty($admin_folder)) {
        $admin_folder = 'admin';
    }
}

$file_contents = "<?php\n".
                 'define(\'HTTP_SERVER\', \''.$http_server.'\');'."\n".
                 'define(\'HTTPS_SERVER\', \''.$https_server.'\');'."\n".
                 'define(\'ENABLE_SSL\', '.json_encode(getenv('HTTPS') === 'on').");\n".
                 'define(\'HTTP_COOKIE_DOMAIN\', \'\');'."\n".
                 'define(\'HTTPS_COOKIE_DOMAIN\', \'\');'."\n".
                 'define(\'HTTP_COOKIE_PATH\', \''.$http_catalog.'\');'."\n".
                 'define(\'HTTPS_COOKIE_PATH\', \''.$http_catalog.'\');'."\n".
                 'define(\'DIR_WS_HTTP_CATALOG\', \''.$http_catalog.'\');'."\n".
                 'define(\'DIR_WS_HTTPS_CATALOG\', \''.$http_catalog.'\');'."\n".
                 'define(\'DIR_WS_IMAGES\', \'images/\');'."\n".
                 'define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');'."\n".
                 'define(\'DIR_WS_INCLUDES\', \'includes/\');'."\n".
                 'define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');'."\n".
                 'define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');'."\n".
                 'define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');'."\n".
                 'define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');'."\n\n".
                 'define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');'."\n".
                 'define(\'DIR_FS_CATALOG\', \''.$dir_fs_document_root.'\');'."\n".
                 'define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');'."\n".
                 'define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');'."\n\n".
                 'define(\'DB_SERVER\', \''.trim($_POST['DB_SERVER']).'\');'."\n".
                 'define(\'DB_SERVER_USERNAME\', \''.trim($_POST['DB_SERVER_USERNAME']).'\');'."\n".
                 'define(\'DB_SERVER_PASSWORD\', \''.trim($_POST['DB_SERVER_PASSWORD']).'\');'."\n".
                 'define(\'DB_DATABASE\', \''.trim($_POST['DB_DATABASE']).'\');'."\n".
                 'define(\'USE_PCONNECT\', \'false\');'."\n".
                 'define(\'STORE_SESSIONS\', \'mysql\');'."\n";

if (isset($_POST['CFG_TIME_ZONE'])) {
    $file_contents .= 'define(\'CFG_TIME_ZONE\', \''.trim($_POST['CFG_TIME_ZONE']).'\');'."\n";
}

$fp = fopen($dir_fs_document_root.'includes/configure.php', 'wb');
fwrite($fp, $file_contents);
fclose($fp);

@chmod($dir_fs_document_root.'includes/configure.php', 0644);

$file_contents = "<?php\n".
                 'define(\'HTTP_SERVER\', \''.$http_server.'\');'."\n".
                 'define(\'HTTPS_SERVER\', \''.$https_server.'\');'."\n".
                 'define(\'ENABLE_SSL\', '.json_encode(getenv('HTTPS') === 'on').");\n".
                 'define(\'HTTP_COOKIE_DOMAIN\', \'\');'."\n".
                 'define(\'HTTPS_COOKIE_DOMAIN\', \'\');'."\n".
                 'define(\'HTTP_COOKIE_PATH\', \''.$http_catalog.$admin_folder.'\');'."\n".
                 'define(\'HTTPS_COOKIE_PATH\', \''.$http_catalog.$admin_folder.'\');'."\n".
                 'define(\'HTTP_CATALOG_SERVER\', \''.$http_server.'\');'."\n".
                 'define(\'HTTPS_CATALOG_SERVER\', \''.$https_server.'\');'."\n".
                 'define(\'ENABLE_SSL_CATALOG\', \''.json_encode(getenv('HTTPS') === 'on').'\');'."\n".
                 'define(\'DIR_FS_DOCUMENT_ROOT\', \''.$dir_fs_document_root.'\');'."\n".
                 'define(\'DIR_WS_ADMIN\', \''.$http_catalog.$admin_folder.'/\');'."\n".
                 'define(\'DIR_WS_HTTPS_ADMIN\', \''.$http_catalog.$admin_folder.'/\');'."\n".
                 'define(\'DIR_FS_ADMIN\', \''.$dir_fs_document_root.$admin_folder.'/\');'."\n".
                 'define(\'DIR_WS_CATALOG\', \''.$http_catalog.'\');'."\n".
                 'define(\'DIR_WS_HTTPS_CATALOG\', \''.$http_catalog.'\');'."\n".
                 'define(\'DIR_FS_CATALOG\', \''.$dir_fs_document_root.'\');'."\n".
                 'define(\'DIR_WS_IMAGES\', \'images/\');'."\n".
                 'define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');'."\n".
                 'define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');'."\n".
                 'define(\'DIR_WS_INCLUDES\', \'includes/\');'."\n".
                 'define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');'."\n".
                 'define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');'."\n".
                 'define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');'."\n".
                 'define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');'."\n".
                 'define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');'."\n".
                 'define(\'DIR_WS_CATALOG_LANGUAGES\', DIR_WS_CATALOG . \'includes/languages/\');'."\n".
                 'define(\'DIR_FS_CATALOG_LANGUAGES\', DIR_FS_CATALOG . \'includes/languages/\');'."\n".
                 'define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');'."\n".
                 'define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');'."\n".
                 'define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');'."\n".
                 'define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');'."\n".
                 'define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');'."\n\n".
                 'define(\'DB_SERVER\', \''.trim($_POST['DB_SERVER']).'\');'."\n".
                 'define(\'DB_SERVER_USERNAME\', \''.trim($_POST['DB_SERVER_USERNAME']).'\');'."\n".
                 'define(\'DB_SERVER_PASSWORD\', \''.trim($_POST['DB_SERVER_PASSWORD']).'\');'."\n".
                 'define(\'DB_DATABASE\', \''.trim($_POST['DB_DATABASE']).'\');'."\n".
                 'define(\'USE_PCONNECT\', \'false\');'."\n".
                 'define(\'STORE_SESSIONS\', \'mysql\');'."\n";

if (isset($_POST['CFG_TIME_ZONE'])) {
    $file_contents .= 'define(\'CFG_TIME_ZONE\', \''.trim($_POST['CFG_TIME_ZONE']).'\');'."\n";
}

$fp = fopen($dir_fs_document_root.'admin/includes/configure.php', 'wb');
fwrite($fp, $file_contents);
fclose($fp);

@chmod($dir_fs_document_root.'admin/includes/configure.php', 0644);

if ($admin_folder !== 'admin') {
    @rename($dir_fs_document_root.'admin', $dir_fs_document_root.$admin_folder);
}

?>

    <p>The installation of your online store was successful! Click on either button to start your online selling experience:</p>

    <br/>

    <table border="0" width="99%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right" width="50%" style="padding-right: 30px;"><?php echo osc_draw_button('Online Store (Frontend)', 'cart', (getenv('HTTPS') === 'on' ? $https_server : $http_server).$http_catalog.'index.php', 'primary', ['newwindow' => 1]); ?></td>
        <td width="50%" style="padding-left: 30px;"><?php echo osc_draw_button('Administration Tool (Backend)', 'locked', (getenv('HTTPS') === 'on' ? $https_server : $http_server).$http_catalog.$admin_folder.'/index.php', 'primary', ['newwindow' => 1]); ?></td>
      </tr>
    </table>
  </div>
</div>
