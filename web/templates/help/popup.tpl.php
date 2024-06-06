<html <?php echo HTML_PARAMS; ?>>
<head>
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_TEMPLATE_FILES; // BTSv1.4 ?>stylesheet.css">
<style type="text/css">
<!--
body {
margin: 10px;
}
-->
</style>
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
</head>
<body <?php echo $body_attributes; ?>>
<?php include (bts_select('content_popup')); // BTSv1.5 ?>
</body>
</html>

