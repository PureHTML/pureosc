<?php
//pozadi prostredek: #d6d0b8
// COLOR OPTION
$sfondo = '#'. COLORE_SFONDO ;
$colore_testo = '#' . COLORE_TESTO ;
$bordo = '#' . COLORE_BORDO ;
$ripieno = '#' . COLORE_RIPIENO;
$notification = '#f2fff7';
$orderEdit = '#000000';
//cervena
$pozadi_sloupce = '#8f2005';
// TEXT OPTION
$caracter = '"Times New Roman", Times, serif';
$caracter2 = '"", ';
//template width hack for IE 4-6
$template_width = 900;
$template_width_hack = $template_width / 2;
?>

/**********instantnishop.cz special START *************************/
.ColorWhite {color:#fff}
/*nepodtrzeny odkaz:*/
.n {
text-decoration: none;
font-size:14px;
}
hr {
border-top: 1px solid black;
}
.menuCat {
color: #b19b6a;
text-decoration: none;
}
p {
margin:0px;
}
.dotisk {
border: 1px solid <?echo $pozadi_sloupce; ?>;
height: 14px;
font-size:12px;
margin-right:10px;
padding-left:4px;
padding-right:4px;
background:#cdc4a5;
font-weight:bold;
float:right;
}
.r {
border: 1px solid <?echo $pozadi_sloupce; ?>;
height: 14px;
font-size:12px;
margin-left:8px;
text-decoration:none;
}
.top10 {
border: 0px none;
text-align:left;
}
.paddBack {
left: -20px;
}
.padd {
padding-left: 20px;
}
.centerBoxik {
width:100%;
text-align:center;
}
.tabnovinka {
text-align: left;
font-weight: normal;
font-size:100%;
padding-top:10px;
/*width:50px; */
}
.obrtab {
width:115px!important;
}
.Table_templateColumnRight {
position:absolute;
right:0px;
top:160px;
width: 160px;
border: 1px solid <?echo $pozadi_sloupce; ?>;
background: #cdc4a5;
}
.menicko {
position:absolute;
right:0px;
top:116px;
width: 500px;
height:24px;
color:#8f8255;
background:#8f2005;
border-top: 1px solid black;
}

.banner {
position:absolute;
right:0px;
top:0px;
width: 500px;
height:120px;
color:yellow;

}

table {
border: 0px;
}
td {
border: 0px none;
font-size: 12px;
padding-left:5px;
padding-top:5px;
text-align:left;
vertical-align:top;
}
/* price in product_listing.php */
/*
.ppr {
  position:relative; 
  clear:both;
  float:left;
  right: 0px;
  width:250px;
text-align:right;
  top:21px;
}
*/
.prod_desc {
  padding-left:5px;
  width:370px;
/*  height:10%; */
  text-align:left;
}
h3 {
/*  margin-top:0px; */
}

/**********instantnishop.cz special END *************************/
#page {
  margin-left:  -<?php echo $template_width_hack ?>px; 
  width: <?php echo $template_width ?>px; 
 position: absolute;
  top:0px; 
  left: 50%;
  background: <?php echo $sfondo; ?>;
/*  border: 2px solid red;*/
  clear: both;
}
.productsNotifications { background: <?php echo $notification ?>; color: <?php echo $colore_testo ?>; }
.orderEdit { color: <?php echo $orderEdit ?>; text-decoration: underline; background: transparent; }

BODY {
  font-family: <?php echo $caracter ?>;
  text-align: center;
  color: <?php echo $colore_testo ?>;
  margin: 0px;
  background-image: url(/i/pozadiHneda.gif);
  background-position: center top;
  background-repeat: repeat-y;
  background-color:#c0b693;
}

A {
  color: <?php echo $colore_testo ?>;
}

A:hover {
/*  color: #cccccc; */
  text-decoration: underline;
}
HR {
  color: #dddddd; background: #dddddd;
 height:1px;
}
.header {
height:128px;
width:100%;
color: <?php echo $colore_testo ?>;
}

FORM {
  display: inline;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.s {
  text-decoration: line-through;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.b {
  font-weight: bold;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}
h2.b {color:#000000;}
.productListing-odd, .productListing-even {
  background: <?php echo $ripieno ?>;
  color: <?php echo $colore_testo ?>;
}

.productListing-heading {
  background: <?php echo $bordo ?>;
  color: #fFFfff<?php //echo $sfondo ?>;
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
  color: <?php echo $colore_testo ?>;
}

.smallText {
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.tableHeading {
  font-size: 1em;
  font-weight: bold;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

CHECKBOX, RADIO, SELECT {
  font-size: 80%;
  width:160px;
  background: #ffffff;
  color: #000000;
  border: 0px none;
}

.input2ma {
  font-size: 0.7em;
 /* width:120px; */
  background: #ffffff;
  height:16px;
  color: #000000;border:0px;border-color:#cccccc; border-bottom:1px;border-style:solid;border-bottom-color:#dddddd;
}

TEXTAREA.input2ma {
  height: 40px;
  width: 99%;
  font-size: 1em;
  background: #fff;
  color: <?php echo $colore_testo ?>;
}

TEXTAREA {
  width: 99%;
  font-size: 1em;
  background: #fff;
  color: <?php echo $colore_testo ?>;
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
.moduleRowOver { background-color: #D7E9F7; cursor: pointer; color: <?php echo $colore_testo ?>; }
.moduleRowSelected { background-color: #E9F4FC; color: <?php echo $colore_testo ?>; }

.checkoutBarFrom, .checkoutBarTo { color: #8c8c8c; background: transparent; }
.checkoutBarCurrent { color: <?php echo $colore_testo ?>; background: transparent; }

/* message box */

.messageBox { }
.messageStackError, .messageStackWarning { background-color: #ffb3b5; color: <?php echo $colore_testo ?>; }
.messageStackSuccess { background-color: #99ff00; color: <?php echo $colore_testo ?>; }

/* input requirement */

.inputRequirement { color: #ff0000; background: transparent; }

/* TABLE FOR TEMPLATE */

.Table_templateSx {
  width: <?php echo BOX_WIDTH_LEFT ?>;
  float: left;
}

.column_left {
  width: 197px!important;
 position: absolute; top: 100px; left:0px;
}
.Table_templateCentral {
width: 500px;
position:absolute;
left:220px;
top:160px;
}
.Table_templateCentral2 {
 /*background:transparent;*/

}
.Table_templateCentral3 {
 /*background:transparent;*/
 padding: 1px;
}
.Retta {
  width: 0%;
  float: left;
}

.Table_templateClear {
  font-size: 0.2em;
  clear: both;
}

.TemplateSpazio {
  font-size: 0.2em;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.AlignLeft {
  text-align: left;
  background: transparent;
  color: #000000;
  font-size:100%;
}

.Venticinque2 {
/*  width: 24%; todo */
  float: left;
  background: transparent;
  color: <?php echo $colore_testo ?>;
  font-size:100%; 
  text-align:left;
}
.qtaCart {
  float: left;
  left: 265px;
  position:absolute;
}
.toTal {
  float: left;
  left: 400px;
  position:absolute;
}

.CinquantaL {
  padding-left: 1%;
  text-align: left;
  width: 49%;
  float: left;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.CinquantaR {
  text-align: right;
  width: 49%;
  float: left;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.Venticinque {
  background: #cdc4a5;
  font-weight: bold;
  width: 24%;
  float: left;
}

.Trenta {
  width: 30%;
  float: left;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.InfoBoxContenent2MA {
/*
  clear: both;
  border-style:solid;
  border-width:1px;
  border-color: <?php echo $bordo ?>;
  background: <?php echo $ripieno ?>;
  color: <?php echo $colore_testo ?>;
  padding: 1%;
*/
}
.ColorRed {
  color: #ff0000;
  background: transparent;
}

/*todo*/
.Clear {
  font-size: 0em;
  clear:both; 
  background: transparent;
  color: <?php echo $colore_testo ?>;
  width:20%;
}

.HeaderLeft {
  float: left;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.HeaderRight {
  float: right;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

.HeaderNavigationLeft {
/*
  float: left;text-align:left;
  padding-left:32px;
*/
  background: #d6c5a0;
  color: #795daa;
  position:absolute; 
  left:215px;
  top:58px;
  width:532px; 
  height:29px;  
  font-size:12px;
/*  border-top:9px solid #d6c5a0; */
}
.HeaderNavigationLeft A{
text-align:left;
  background: transparent;
  color: #795daa;
}
.HeaderNavigationLeft A:hover{

  background: #d6c5a0;
  color: #dddddd;
}
.HeaderNavigationRight {
  float: right;
  background: transparent;
  color: #393d99;
}

.HeaderNavigation {
  text-align: center;
  width:95%;
  background: transparent;
  color: #795daa;
  font-weight: bold;
}


.Footer-text {
  text-align: left;
  background: transparent;
  color: #795daa;
  font-weight: bold;
}

.HeaderNavigationText {
  text-align: center;
  background: transparent;
  color: #b19b6a; /*#8f8255;*/
  font-weight : bold;
  font-variant:small-caps;
  font-size:14px;
  font-variant:small-caps;
  letter-spacing:0.07em;
  text-decoration: none;
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
  color: #b61d0d;
  border:0px;
 /*width:100px;*/
}
.imgXcat {
  background: transparent;
  color: #b61d0d;
  border:0px;
 width:100px;
}
.img2cat {
  background: transparent;
  color: <?php echo $colore_testo ?>;  
  border:0px;
  float: right;
}
.ie6balengo{
  display:block;
  background: transparent;
  color: <?php echo $colore_testo ?>;  
  border:0px;
}

.ColorSpan {
  color: #000000;
  text-decoration: underline;
  background: transparent;
}

.ColorSpanRed {
  color: #ff0000;
  background: transparent;
}

.pageHeading {
text-align:left;
font-size: 20px;
margin-top:0px;
margin-bottom:5px;
}

.categoriesH1 {
position:absolute;
left:-28px;
text-align: left;
padding-left: 28px;
padding-right:25px;
font-size: 180%;
line-height:100%;
font-weight: bold;
width: 350px;
border: 1px solid #b61d0d;
color: #b61d0d;
height:26px;
letter-spacing:0.03em;
}
.ramTlusty {
background:#b61d0d;
height:35px;
color: #b19b6a;
font-weight:bold;
padding-left:12px;
padding-right:12px;
}

h1 {
text-align:left;
font-size: 18px;
margin-top:0px;
margin-bottom:10px;
}


h2 {
margin-top:5px;
margin-bottom:0px;
color: #b61d0d;
font-size: 18px;
}
.TrentaTre {
  float:left;
  width: 33%;
  height:230px;
  background: transparent;
  color: <?php echo $colore_testo ?>;
}

/* inizio box.php */
/*
.fedora-corner-tl, .fedora-corner-tr {
  background-color: <?php echo $bordo ?>;
  position: relative;
  width: 11px;
  height: 14px;
  display: none;
}


.fedora-corner-tl { float: left; left: 0px; }
.fedora-corner-tr { float: right; right: 0px; }
.fedora-corner-tl, .fedora-corner-tr { top: 0px; }

.fedora-corner-tl { background: <?php echo $bordo ?> url("templates/a_pligg/images/infobox/corner_left.png") no-repeat left top; }
.fedora-corner-tr { background: <?php echo $bordo ?> url("templates/a_pligg/images/infobox/corner_right.png") no-repeat right top; }



.fedora-corner-tl, .fedora-corner-tr {
  display: block;
}
*/

.BoxesInfoBoxHeadingCenterBoxRight {
  color: #ffffff;
  text-decoration:none;
}

.BoxesInfoBoxHeadingCenterBoxTitle {
  font-size: 15px;
  text-align: left;
  font-weight: bold;
  font-variant:small-caps;
  background:  #8F2005;
  color:#b19b6a;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  letter-spacing:0.09em;
  padding-left:10px;
}
.BoxRamecekTop {
  font-size: 15px;
  text-align: left;
  font-weight: bold;
  font-variant:small-caps;
  background:  #8F2005;
  color:#b19b6a;
  border-top: 1px solid black;
  letter-spacing:0.09em;
  padding-left:10px;
}
.nadpis1 {
  color:#b19b6a;
  text-decoration: none;
}
.InfoBoxContenent2MABox {
  border-style:solid;
  border-width:0px;
  border-color: <?php echo $bordo ?>;
  color: #000000;
  background: transparent;
  padding: 10px;
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

.de { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(includes/languages/german/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px;font-family: <?php echo $caracter ?>;  font-size: 1.5em; }
.en { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(includes/languages/english/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: <?php echo $caracter ?>; font-size: 1.5em; }
.it { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(includes/languages/italian/images/icon.png);background-repeat:no-repeat;padding-top:1px;padding-left:2px; padding-right:2px;  font-family: <?php echo $caracter ?>;   font-size: 1.5em; }
.es { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(includes/languages/espanol/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: <?php echo $caracter ?>; font-size: 1.5em; }
.fr { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(includes/languages/french/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: <?php echo $caracter ?>; font-size: 1.5em; }
.nl { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(includes/languages/dutch/images/icon.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: <?php echo $caracter ?>; font-size: 1.5em; }

.EUR { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(images/currencies/eur.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: <?php echo $caracter ?>;font-size: 1.5em; }
.USD { color: <?php echo $colore_testo ?>; background: transparent; background-image: url(images/currencies/usd.png);background-repeat:no-repeat;padding-top:1px; padding-left:2px; padding-right:2px; font-family: <?php echo $caracter ?>;font-size: 1.5em; }

.cssbutton {
  background: #b81f11;
  color: #b19b6a;
  font-size: 12px; font-weight: bold; 
  cursor: pointer;
  text-align:center;
  border: 0px none;
/*  border-style: outset;
  border-color: <?php echo $bordo ?>;
  border-spacing: 1px;
*/
  letter-spacing:0.05em;
  height:18px;
  text-decoration:none;
}
