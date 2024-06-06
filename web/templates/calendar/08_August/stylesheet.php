<?php
// COLOR OPTION
$sfondo = '#FFF0B3';
$colore_testo = '#000000';
$bordo = '#FFCC00';
$ripieno = '#FFE680';
$notification = '#f2fff7';
$orderEdit = '#70d250';
// TEXT OPTION
$caracter = 'Verdana, Arial, sans-serif';
$caracter2 = 'Tahoma, ';
?>


<style title="default" type="text/css" media="all"><!--

/*
  $Id: stylesheet.css,v 1.56 2003/06/30 20:04:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

.productsNotifications { background: <?php echo $notification ?>; color: inherit; }
.orderEdit { color: <?php echo $orderEdit ?>; text-decoration: underline; background: inherit; }

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

FORM {
	display: inline;
	background: inherit;
	color: inherit;
}

.s {
  text-decoration: line-through;
	background: inherit;
	color: inherit;
}

.b {
  font-weight: bold;
	background: inherit;
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
  background: inherit;
}

A.pageResults:hover {
  color: #0000FF;
  background: #FFFF33;
}

.main {
  font-size: 0.7em;
  line-height: 1.5;
  background: inherit;
  color: inherit;
}

.smallText {
  background: inherit;
  color: inherit;
}

.tableHeading {
  font-size: 1em;
  font-weight: bold;
	background: inherit;
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
	background: inherit;
	color: inherit;
}

TEXTAREA {
  width: 99%;
  font-size: 1em;
	background: inherit;
	color: inherit;
}

SPAN.greetUser {
  font-size: 1em;
  color: #f0a480;
  font-weight: bold;
	background: inherit;
}

SPAN.markProductOutOfStock {
  font-family: <?php echo $caracter2 ?><?php echo $caracter ?>;
  font-size: 0.75em;
  color: #c76170;
  font-weight: bold;
	background: inherit;
}

.moduleRow { }
.moduleRowOver { background-color: #D7E9F7; cursor: pointer; color: inherit; }
.moduleRowSelected { background-color: #E9F4FC; color: inherit; }

.checkoutBarFrom, .checkoutBarTo { color: #8c8c8c; background: inherit; }
.checkoutBarCurrent { color: <?php echo $colore_testo ?>; background: inherit; }

/* message box */

.messageBox { }
.messageStackError, .messageStackWarning { background-color: #ffb3b5; color: inherit; }
.messageStackSuccess { background-color: #99ff00; color: inherit; }

/* input requirement */

.inputRequirement { color: #ff0000; background: inherit; }

/* TABLE FOR TEMPLATE */

.Table_templateSx {
  width: 15%;
  float: left;
}

.Table_templateDx {
  width: 15%;
  float: left;
}

.Table_templateCentral {
  width: 66%;
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
	background: inherit;
	color: inherit;
}

.AlignLeft {
  text-align: left;
	background: inherit;
	color: inherit;
}

.Venticinque2 {
  width: 24%;
  float: left;
	background: inherit;
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
	background: inherit;
	color: inherit;
}

.CinquantaL {
  padding-left: 1%;
  text-align: left;
  width: 49%;
  float: left;
  background: inherit;
  color: inherit;
}

.CinquantaR {
  text-align: right;
  width: 49%;
  float: left;
  background: inherit;
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
	background: inherit;
}

.Clear {
  font-size: 0em;
  clear: both;
	background: inherit;
	color: inherit;
}

.HeaderLeft {
  float: left;
	background: inherit;
	color: inherit;
}

.HeaderRight {
  float: right;
	background: inherit;
	color: inherit;
}

.HeaderNavigationLeft {
  float: left;
	background: inherit;
	color: inherit;
}

.HeaderNavigationRight {
  float: right;
	background: inherit;
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
	background: inherit;
	color: inherit;	
  border:0px;
}

.ColorSpan {
  color: #0000ff;
  text-decoration: underline;
	background: inherit;
}

.ColorSpanRed {
  color: #ff0000;
	background: inherit;
}

.pageHeading {
  font-size: 1.6em;
  font-weight: bold;
  color: #9a9a9a;
	background: inherit;
}

.TrentaTre {
  float:left;
  width: 33%;
	background: inherit;
	color: inherit;
}

/* inizio box.php */

.BoxesInfoBoxHeadingCenter {
  font-size: 1em;
  text-align: center;
  font-weight: bold;
  background: <?php echo $bordo ?>;
  color: <?php echo $sfondo ?>;
}

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

.de { color: inherit; background: inherit; background-image: url(includes/languages/german/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px;font-family: Tahoma, Verdana, Arial, sans-serif;  font-size: 1.5em; }
.en { color: inherit; background: inherit; background-image: url(includes/languages/english/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }
.it { color: inherit; background: inherit; background-image: url(includes/languages/italian/images/icon.png);background-repeat:no-repeat;padding-top:1px;padding-left:2px; padding-right:2px;  font-family: Tahoma, Verdana, Arial, sans-serif;   font-size: 1.5em; }
.es { color: inherit; background: inherit; background-image: url(includes/languages/espanol/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }
.fr { color: inherit; background: inherit; background-image: url(includes/languages/french/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }
.nl { color: inherit; background: inherit; background-image: url(includes/languages/dutch/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 1.5em; }

.EUR { color: inherit; background: inherit; background-image: url(images/currencies/eur.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif;font-size: 1.5em; }
.USD { color: inherit; background: inherit; background-image: url(images/currencies/usd.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: Tahoma, Verdana, Arial, sans-serif;font-size: 1.5em; }

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