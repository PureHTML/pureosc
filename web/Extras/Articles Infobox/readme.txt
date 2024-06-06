Just drop the file in your includes/boxes directory and include it in your column_right.php like this:
require(DIR_WS_BOXES . 'articles_lastN.php');

Or if you want to go fancy and display it only on certain pages (e.g. anywhere else but the articles themselves) do it this way

if ((isset($HTTP_GET_VARS['articles_id'])) || ($_SERVER['PHP_SELF'] == '/articles.php') || (sizeof($HTTP_GET_VARS) < 1)){
require(DIR_WS_BOXES . 'articles.php');
}
else {
require(DIR_WS_BOXES . 'articles_lastN.php');
}