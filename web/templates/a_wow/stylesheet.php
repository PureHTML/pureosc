<?php
// COLOR OPTION
$sfondo = '#'. COLORE_SFONDO ;
$colore_testo = '#' . COLORE_TESTO ;
$bordo = '#' . COLORE_BORDO ;
$ripieno = '#' . COLORE_RIPIENO;
$notification = '#f2fff7';
$orderEdit = '#70d250';
// TEXT OPTION
$caracter = 'Verdana, Arial, sans-serif';
$caracter2 = 'Tahoma, ';
?>


<style title="default" type="text/css" media="all">

/*
  $Id: stylesheet.css,v 1.56 2003/06/30 20:04:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

.productsNotifications { background: <?php echo $notification ?>; color: inherit; }
.orderEdit { color: <?php echo $orderEdit ?>; text-decoration: underline; background: transparent; }

BODY {
  font-family: <?php echo $caracter ?>;
  font-size: 0.7em;
  text-align: center;
  background: <?php echo $sfondo ?>;background-image:url("<?php echo bts_select(images, 'infobox/bmw.jpg') ?>");background-attachment: fixed;
  color: <?php echo $colore_testo ?>;
  margin: 0px;
}

A {
  color: <?php echo $colore_testo ?>;
  text-decoration: none;
  background: transparent;
}

A:hover {
  color: #AABBDD;
  text-decoration: underline;
}
.header {
  background-color: <?php echo $sfondo ?>;
  color: <?php echo $colore_testo ?>;
}

FORM {
  display: inline;
  background: transparent;
  color: inherit;
}

.s {
  text-decoration: line-through;
  background: transparent;
  color: inherit;
}

.b {
  font-weight: bold;
  background: transparent;
  color: inherit;
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

A.pageResults {
  color: #0000FF;
  background: transparent;
}

A.pageResults:hover {
  color: #0000FF;
  background: #FFFF33;
}

.main {
  font-size: 0.7em;
  line-height: 1.5;
  background: transparent;
  color: inherit;
}

.smallText {
  background: transparent;
  color: inherit;
}

.tableHeading {
  font-size: 1em;
  font-weight: bold;
  background: transparent;
  color: inherit;
}

CHECKBOX, RADIO, SELECT {
  font-size: 0.9em;
  background: #ffffff;
  color: #000000;
}

.input2ma {
  font-size: 1em;
  background: #ffffff;
  color: #000000;
}

TEXTAREA.input2ma {
  width: 99%;
  font-size: 1.5em;
  background: transparent;
  color: inherit;
}

TEXTAREA {
  width: 99%;
  font-size: 1em;
  background: transparent;
  color: inherit;
}

SPAN.greetUser {
  font-size: 1em;
  color: #f0a480;
  font-weight: bold;
  background: transparent;
}

SPAN.markProductOutOfStock {
  font-family: <?php echo $caracter2 ?><?php echo $caracter ?>;
  font-size: 0.75em;
  color: #c76170;
  font-weight: bold;
  background: transparent;
}

.moduleRow { }
.moduleRowOver { background-color: #D7E9F7; cursor: pointer; color: inherit; }
.moduleRowSelected { background-color: #E9F4FC; color: inherit; }

.checkoutBarFrom, .checkoutBarTo { color: #8c8c8c; background: transparent; }
.checkoutBarCurrent { color: <?php echo $colore_testo ?>; background: transparent; }

/* message box */

.messageBox { }
.messageStackError, .messageStackWarning { background-color: #ffb3b5; color: inherit; }
.messageStackSuccess { background-color: #99ff00; color: inherit; }

/* input requirement */

.inputRequirement { color: #ff0000; background: transparent; }

/* TABLE FOR TEMPLATE */

.Table_templateSx {
  width: 17%;
  float: left;
}

.Table_templateDx {
  width: 17%;
  float: left;
}

.Table_templateCentral {
  width: 62%;
  float: left;
}

.Retta {
  width: 1%;
  float: left;
}

.Table_templateClear {
  font-size: 0.2em;
  clear: both;
}

.TemplateSpazio {
  font-size: 0.2em;
  background: transparent;
  color: inherit;
}

.AlignLeft {
  text-align: left;
  background: transparent;
  color: inherit;
}

.Venticinque2 {
  width: 24%;
  float: left;
  background: transparent;
  color: inherit;
}

.CinquantaL {
  padding-left: 1%;
  text-align: left;
  width: 49%;
  float: left;
  background: transparent;
  color: inherit;
}

.CinquantaR {
  text-align: right;
  width: 49%;
  float: left;
  background: transparent;
  color: inherit;
}

.Venticinque {
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
  font-weight: bold;
  width: 24%;
  float: left;
}

.Trenta {
  width: 30%;
  float: left;
  background: transparent;
  color: inherit;
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

.ColorRed {
  color: #ff0000;
  background: transparent;
}

.Clear {
  font-size: 0em;
  clear: both;
  background: transparent;
  color: inherit;
}

.HeaderLeft {
  float: left;
  background: transparent;
  color: inherit;
}

.HeaderRight {
  float: right;
  background: transparent;
  color: inherit;
}

.HeaderNavigationLeft {
  float: left;
  background: transparent;
  color: inherit;
}

.HeaderNavigationRight {
  float: right;
  background: transparent;
  color: inherit;
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

.img2ma {
  background: transparent;
  color: inherit;  
  border:0px;
}

.ColorSpan {
  color: #0000ff;
  text-decoration: underline;
  background: transparent;
}

.ColorSpanRed {
  color: #ff0000;
  background: transparent;
}

.pageHeading {
  font-size: 1.6em;
  font-weight: bold;
  color: #9a9a9a;
  background: transparent;
}

.TrentaTre {
  float:left;
  width: 33%;
  background: transparent;
  color: inherit;
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

.fedora-corner-tl { float: left; left: 0px; }
.fedora-corner-tr { float: right; right: 0px; }
.fedora-corner-tl, .fedora-corner-tr { top: 0px; }

.fedora-corner-tl { background: <?php echo $bordo ?> url("<?php echo bts_select(images, 'infobox/corner_left.png') ?>") no-repeat left top; }
.fedora-corner-tr { background: <?php echo $bordo ?> url("<?php echo bts_select(images, 'infobox/corner_right.png') ?>") no-repeat right top; }



.BoxesInfoBoxHeadingCenterBoxRight {
  background: transparent;position: relative;
  color: #ff0000;
}

.BoxesInfoBoxHeadingCenterBoxTitle {
  font-size: 1em;
  text-align: left;
  font-weight: bold;
  background: transparent;
  color: black;
}

.InfoBoxContenent2MABox {
  border-style:solid;
  border-width:0px;
  border-color: <?php echo $bordo ?>;
  color: inherit;
  
  color: <?php echo $colore_testo ?>;
  padding: 0.3em;



  
}
.pippino { 
 position:relative;background-image:url("<?php echo bts_select(images, 'infobox/mcw.png') ?>");height:100%;
}
.pippino1 { 
 position:relative; border-style:solid; border-width:0px;
border-color:red;background-image:url("<?php echo bts_select(images, 'infobox/mlw.png') ?>");background-repeat:repeat-y;background-position:top left;height:100%;padding-left:20px;
}
.pippino2 { 
 position:relative; border-style:solid;
  border-width:0px;border-color:blue;background-image:url("<?php echo bts_select(images, 'infobox/mrw.png') ?>");background-repeat:repeat-y;background-position:top right;height:100%;  padding-right:38px; 
}
.pippino3 { 
background:transparent; position:relative; border-style:solid;
  border-width:0px;border-color:green;background-image:url("<?php echo bts_select(images, 'infobox/mcw.png') ?>");background-repeat:repeat;background-position:top right;height:100%; 
}
.pippino4 { 
 position:relative; border-style:solid; border-width:0px;
border-color:red;background-image:url("<?php echo bts_select(images, 'infobox/blw.png') ?>");background-repeat:repeat-y;background-position:top left;height:28px;padding-left:20px;
}
.pippino5 { 
 position:relative; border-style:solid;
  border-width:0px;border-color:blue;background-image:url("<?php echo bts_select(images, 'infobox/brw.png') ?>");background-repeat:repeat-y;background-position:top right;height:28px;  padding-right:38px; 
}
.pippino6 { 
background:transparent; position:relative; border-style:solid;
  border-width:0px;border-color:green;background-image:url("<?php echo bts_select(images, 'infobox/bcw.png') ?>");background-repeat:repeat;background-position:top right;height:28px; 
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

.de { color: inherit; background: transparent; background-image: url(includes/languages/german/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px;font-family: Tahoma, Verdana, Arial, sans-serif;  font-size: 1.5em; }
.en { color: inherit; background: transparent; background-image: url(includes/languages/english/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }
.it { color: inherit; background: transparent; background-image: url(includes/languages/italian/images/icon.png);background-repeat:no-repeat;padding-top:1px;padding-left:2px; padding-right:2px;  font-family: Tahoma, Verdana, Arial, sans-serif;   font-size: 1.5em; }
.es { color: inherit; background: transparent; background-image: url(includes/languages/espanol/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }
.fr { color: inherit; background: transparent; background-image: url(includes/languages/french/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }
.nl { color: inherit; background: transparent; background-image: url(includes/languages/dutch/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }

.EUR { color: inherit; background: transparent; background-image: url(images/currencies/eur.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif;font-size: 1.5em; }
.USD { color: inherit; background: transparent; background-image: url(images/currencies/usd.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif;font-size: 1.5em; }



<?php /*

	if (eregi("MSIE", $_server['HTTP_USER_AGENT'])) {
	echo('.bbhcbt1 { border: 0px; border-style: solid; border-color:red; padding-left:23px; background-image:url("' . bts_select(images, 'infobox/tnw.png') . ' ");background-repeat:no-repeat;background-position:top right;height:46px; filter:progid:DXImageTransform.Microsoft.AlphaimageLoader(src=\'tw.png\',sizingMethod=\'scale\')'); 
	}
	else{
	echo('.bbhcbt1 { border: 0px; border-style: solid; border-color:blue; padding-left:23px; background-image:url("' .bts_select(images, 'infobox/tlw.png').'");background-repeat:no-repeat;background-position:top left;height:46px;}');
	}
	*/?>	
<?php
function intelligent_css()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (eregi("MSIE", $user_agent) && !eregi("Opera", $user_agent)) {
        $return = ".bbhcbt1 { padding-top:7px; font-size: 1.3em; color:white; border: 0px; border-style: solid; border-color:red; padding-left:23px; background-image:url(". bts_select(images, 'infobox/tnw.png') .");background-repeat:no-repeat;background-position:top right;height:40px; filter:progid:DXImageTransform.Microsoft.AlphaimageLoader(src='". bts_select(images, 'infobox/tw.png'). "',sizingMethod=\'scale\')'); 
	}";
  /*  } elseif (eregi("Firefox", $user_agent)) {
        $return = "Mozilla Firefox";
    } elseif (eregi("Opera", $user_agent)) {
        $return = "Opera";
    } elseif (eregi("Gecko", $user_agent)) {
        $return = "Netscape Navigator";*/
    } else {
        $return = ".bbhcbt1 { border: 0px; border-style: solid; border-color:blue; padding-left:20px; background-image:url(".bts_select(images, 'infobox/tlw.png').");background-repeat:no-repeat;background-position:top left;height:46px;}
.bbhcbt2 { border: 0px; border-style: solid; border-color:blue; padding-right:38px; background-image:url(".bts_select(images, 'infobox/trw.png').");background-repeat:no-repeat;background-position:top right;height:46px;}
.bbhcbt3 { border: 0px; border-style: solid; border-color:green;background-image:url(".bts_select(images, 'infobox/tcw.png').");background-repeat:repeat;background-position:top;height:39px;padding-top:7px;font-size: 1.3em; color: white;}
	";
    }

    return $return;
}

echo intelligent_css();

?> 
.bbhcbt2 { border: 0px; border-style: solid; border-color:blue; padding-right:38px;background-repeat:no-repeat;background-position:top right;height:46px;}
.bbhcbt3 { border: 0px; border-style: solid; border-color:green;background-repeat:repeat;background-position:top;height:39px;padding-top:7px;font-size: 1.3em; color: white;}
	
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