<?php
// COLOR OPTION
$sfondo = '#'. COLORE_SFONDO ;
$colore_testo = '#' . COLORE_TESTO ;
$bordo = '#' . COLORE_BORDO ;
$ripieno = '#' . COLORE_RIPIENO;
$notification = '#f2fff7';
$orderEdit = '#70d250';
// TEXT OPTION
$caracter = 'Arial, sans-serif';
$caracter2 = 'Verdana, ';
//template width hack for IE 4-6
$template_width = 760;
$template_width_hack = $template_width / 2;
?>


<style title="default" type="text/css" media="all"><!--

#page {
  margin-left:  -<?php echo $template_width_hack ?>px; 
  width: <?php echo $template_width ?>px; 
  position: absolute; 
  top:10px; 
  left: 50%; 
}
.productsNotifications { 
  background: <?php echo $notification ?>; color: inherit; 
}
.orderEdit { 
  color: <?php echo $orderEdit ?>;
  text-decoration: underline; 
  background: inherit; 
}

BODY {
  font-family: <?php echo $caracter ?>;
  font-size: 0.7em;
  text-align: center;
  background: <?php echo $sfondo ?>;
  color: <?php echo $colore_testo ?>;
  margin: 0px;
}

A {
  color: <?php echo $colore_testo ?>;
  text-decoration: none;
  background: inherit;
}

A:hover {
  color: #AABBDD;
  text-decoration: underline;
}
.header {
  background-color: <?php echo $sfondo ?>;
  color: <?php echo $colore_testo ?>;
}

.productListing-odd, .productListing-even {
  background: <?php echo $ripieno ?>;
  color: inherit;
}

.productListing-heading {
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
  font-weight: bold;
}
SPAN.markProductOutOfStock {
  font-family: <?php echo $caracter2 ?><?php echo $caracter ?>;
  font-size: 0.75em;
  color: #c76170;
  font-weight: bold;
  background: inherit;
}
.checkoutBarCurrent { color: <?php echo $colore_testo ?>; background: inherit; }
/* TABLE FOR TEMPLATE */

.Table_templateSx {
  width: <?php echo BOX_WIDTH_LEFT ?>;
  float: left;
}

.Table_templateDx {
  width: <?php echo BOX_WIDTH_RIGHT ?>;
  float: left;
}

.Table_templateCentral {
  width: <?php echo BOX_WIDTH_XX ?>;
  float: left;
}
.Venticinque {
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
  font-weight: bold;
  width: 24%;
  float: left;
}
.InfoBoxContenent2MA {
  clear: both;
  border-style:solid;
  border-width:1px;
  border-color: <?php echo $bordo ?>;
  background: <?php echo $ripieno ?>;
  color: <?php echo $colore_testo ?>;
  padding: 1%;
}
.HeaderNavigation {
  text-align: center;
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
  font-weight : bold;
}

.HeaderNavigationText {
  text-align: center;
  background: transparent;
  color: <?php echo $sfondo ?>;
  font-weight : bold;
}

.HeaderError {
  font-family: <?php echo $caracter2 ?><?php echo $caracter ?>;
  font-size: 1em;
  background: #ff0000;
  color: <?php echo $sfondo ?>;
  font-weight : bold;
  text-align : center;
}

.HeaderInfo {
  font-family: <?php echo $caracter2 ?><?php echo $caracter ?>;
  font-size: 0.75em;
  background: #00ff00;
  color: <?php echo $sfondo ?>;
  font-weight: bold;
  text-align: center;
}

A.HeaderNavigation:hover {
  background: #bbccdd;
  color: <?php echo $sfondo ?>;
}
/* inizio box.php */

.fedora-corner-tl, .fedora-corner-tr {
  background-color: <?php echo $bordo ?>;
  position: relative;
  width: 11px;
  height: 14px;
  /* The following line is to render PNGs with alpha transparency within IE/Win, using DirectX */
  /* Work-around for IE6/Mac borkage (Part 1) */
  display: none;
}
.fedora-corner-tl { background: <?php echo $bordo ?> url("<?php echo bts_select(images, 'infobox/corner_left.png') ?>") no-repeat left top; }

.fedora-corner-tr { background: <?php echo $bordo ?> url("<?php echo bts_select(images, 'infobox/corner_right.png') ?>") no-repeat right top; }

/*
.fedora-corner-tl { filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo bts_select(images, 'infobox/corner_left.png') ?>",sizingMethod='scale'); }
.fedora-corner-tr { filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo bts_select(images, 'infobox/corner_right.png') ?>",sizingMethod='scale'); }
*/
/* \*/
.fedora-corner-tl, .fedora-corner-tr {
  /* Restore the view for everything but IE6/Mac (part 2 of the "IE/Mac fix") */
  display: block;
}
/* */
.BoxesInfoBoxHeadingCenterBoxRight {
  background: <?php echo $bordo ?>;
  color: #ff0000;
}

.BoxesInfoBoxHeadingCenterBoxTitle {
  font-size: 1em;
  text-align: left;
  font-weight: bold;
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
}

.InfoBoxContenent2MABox {
  border-style:solid;
  border-width:1px;
  border-color: <?php echo $bordo ?>;
  color: inherit;
  background: <?php echo $ripieno ?>;
  color: <?php echo $colore_testo ?>;
  padding: 0.3em;
}

.BoxesErrorBox { 
  background: #ffb3b5; 
  font-weight: bold; 
  color: <?php echo $colore_testo ?>;
}

.BoxesProductListing {
  border: 1px;
  border-style: solid;
  border-color: <?php echo $bordo ?>;
  background: <?php echo $sfondo ?>;
  color: <?php echo $colore_testo ?>;
}

/* fine box.php */

.Product_listingProductListing-heading {
  width: 24%;
  float: left;
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
  font-weight: bold;
}
.cssbutton {
  background: <?php echo $sfondo ?>;
  color : <?php echo $colore_testo ?>;
  font-size: 10px;
  cursor: pointer;
  text-align:center;
  border: 2px;
  border-style: outset;
  border-color: <?php echo $bordo ?>;
  border-spacing: 1px;
}
--></style>

