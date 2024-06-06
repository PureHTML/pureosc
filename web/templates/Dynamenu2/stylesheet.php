<style type="text/css">

/*
  $Id: dynamenu_for_osc_styles.txt,v 1.00 2006/05/07 20:04:02 nate_02631 Exp $
	
	Dynamenu for osCommerce CSS Definitions

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  
	Released under the GNU General Public License
	
	Below are styles to be included in your catalog stylesheet (stylesheet.css) for
	use with Dynamenu for osCommerce. All the CSS declarations for various menu styles
	are included below. You need only include the style for the type of menu you plan
	to use in your store template (of course feel free to paste them all in if experimenting).
	
	The plain and DHTML menus also work with a set of templates found in the
	/includes/functions/dynamenu/templates folder, but in just about all cases
	modifying the styles below should net you the results you want. 
	
*/

	 

/*-------------------------------------*/
/*   Horizontal Drop-Down Menu Style   */
/*-------------------------------------*/

.horbar	{   /* Color of main horizontal menubar and border */
	color: black;
	background-color: #e6e7e6;
	border: 1px outset #525252;
}

.horizitem	{          /* Behaviour of main horizontal menu items, leave as is for proper operation */
	float: left;
	white-space: nowrap;
}

.horizitem a {              /* Font style, size of submenu items */
  font-family: Verdana, Arial, sans-serif;
	font-size: 12px;	
	text-decoration: none;
	position: relative;	
	display: block;	
}

.horizitem a:link, .horizitem a:visited 	{      /* Font style & color of main menu items */
	color: #000000;
	text-decoration: none;
}

.horizitem a:hover	{       /* Font style & color, background menu color of main menu item when hovered over */
	color: #ffffff;
	background-color: #21459c;
	text-decoration: none;
}

.horizitem a:active	{       /* Font style & color, background menu color of main menu item when clicked */
	color: #ffff00;
	background-color: #666666;	
	text-decoration: none;
}

.horizsubmenu	{       /* Behaviour of sub-menu items - leave as is for proper operation of submenus */
	position: absolute;
	left: 0;
	top: 0;
	visibility: hidden;
}

.horizsubframe	{      /* Color of submenu item and border */
	background-color: #e6e7e6;
	border: 2px outset #fdfefd;
	
	position: relative;
	display: block;	
}

.horizsubitem	{       /* Behaviour of sub-menu items - leave as is for proper operation of submenus */
	text-align: left;
	white-space: nowrap;
}

.horizsubitem a {            /* Font style, size of submenu items */
  font-family: Verdana, Arial, sans-serif;
	font-size: 12px;	
	text-decoration: none;
	
	position: relative;
	display: block;	
}

.horizsubitem a:link, .horizsubitem a:visited	{       /* Font color, style of submenu items */
	color: #000000;
	font-size: 12px;	
	text-decoration: none;
}

.horizsubitem a:hover	{      /* Font color, style, background submenu color of submenu item when hovered over */
	color: #ffffff;
	background-color: #21459c;
	text-decoration: none;
}

.horizsubitem a:active	{      /* Font color, style, background submenu color of submenu item when clicked */
	color: #ffff00;
	background-color: #666666;		
	text-decoration: none;
}

.horizsubitem .horizfwdarr, .horizitem .horizfwdarr	{      /* Positioning of right arrow for submenus */
	position: absolute;
	top: 5px;
	right: 8px;
}

.dmselected {   /* Style override for selected category tree */
    background-color: #ccc;
		font-weight: bold;
}

.horbar .dmselected {   /* Style override for selected root category */
    background-color: #999;
}


/*---------------------------------*/
/*   Vertical Fly-Out Menu Style   */
/*---------------------------------*/

.verbar	{   /* Color of main vertical menubar and border */
	color: black;
	background-color: #e6e7e6;
	border: 1px outset #fdfefd;
}

.vertitem	{          /* Behaviour of main vertical menu items, leave as is for proper operation */
	text-align: left;
	white-space: nowrap;
}

.vertitem	a {   /* Font style, size of main menu items */
  font-family: Verdana, Arial, sans-serif;
	font-size: 12px;		
	text-decoration: none;
	position: relative;
	display: block;		
}

.vertitem a:link, .vertitem a:visited	{   /* Default font style & color of main menu items */
	color: #000000;
	text-decoration: none;	
}

.vertitem a:hover	{   /* Font style & color, background menu color of main menu item when hovered over */
	color: #ffffff;
	background-color: #21449c;
	text-decoration: none;
}

.vertitem a:active	{   /* Font style & color, background menu color of main menu item when clicked */
	color: #ffff00;
	background-color: #666666;	
	text-decoration: none;	
}

.vertsubmenu	{   /* Behaviour of sub-menu  - leave as is for proper operation of submenus */
	position: absolute;
	left: 0;
	top: 0;
	visibility: hidden;
}

.vertsubframe	{   /* Color of submenu item and border */
	background-color: #e6e7e6;
	border: 2px outset #fdfefd;

	position: relative;
	display: block;	
}

.vertsubitem	{     /* Behaviour of sub-menu  - leave as is for proper operation of submenus */
	text-align: left;
	white-space: nowrap;
}

.vertsubitem a	{   /* Font style, size of submenu items */
  font-family: Verdana, Arial, sans-serif;
	font-size: 12px;			
	text-decoration: none;
	
	position: relative;
	display: block;	
}

.vertsubitem a:link, .vertsubitem a:visited	{   /* Default font style & color of submenu items */
	color: #000000;
	text-decoration: none;	
}

.vertsubitem a:hover	{   /* Font style & color, background submenu color of submenu item when hovered over */
	color: #ffffff;
	background-color: #21449c;
	text-decoration: none;
}

.vertsubitem a:active	{   /* Font style & color, background submenu color of submenu item when clicked */
	color: #ffff00;
	background-color: #666666;	
	text-decoration: none;			
}

.vertsubitem .vertfwdarr, .vertitem .vertfwdarr	{   /* Positioning of right arrow for submenus */
	position: absolute;
	top: 5px;
	right: 8px;
}

.dmselected {   /* Style override for selected category tree */
    background-color: #ccc;
		font-weight: bold;
}

.verbar .dmselected {   /* Style override for selected root category */
    background-color: #999;
}

/*---------------------------*/
/* Tree and Plain Menu Style */
/*---------------------------*/

.treemenudiv	{     /* Behaviour of tree/plain menu item - leave as is for proper performance */
	display: block;
	white-space: nowrap;
}


.phplmbodytable { /* Class of table cells containing plain menus */

}

.phplmnormal {     /* Font size & color of unlinked menu items */
	color: #000000;
	font-size: 13px;	
	text-decoration: none;	
}


a.phplm:link, a.phplm:visited	{      /* Font color, style of linked & visited menu items */
	color: #003300;
	font-size: 13px;	
	text-decoration: none;	
}


a.phplm:hover	{      /* Font color, style of menu items when hovered over */
	color: #841212;
	background-color: #ccc;
	font-size: 13px;	
	text-decoration: none;	
}

a.phplm:active	{      /* Font size & color of menu items when clicked */
	color: #ff0000;
	font-size: 13px;	
	text-decoration: none;	
}

.dmselected {   /* Style overide for selected category tree */
    background-color: #ccc;
		font-weight: bold;
}


 </style>
 
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