<?php
//pozadi prostredek: #d6d0b8
// COLOR OPTION
/*
oranzova: #e95d0f;
*/
$sfondo = '#ffffff';
$colore_testo = '#777';
$bordo = '#' . COLORE_BORDO ;
$ripieno = '#' . COLORE_RIPIENO;
$notification = '#f2fff7';
$orderEdit = '#000000';
//cervena
$pozadi_sloupce = 'transparent';
// TEXT OPTION
$caracter = 'arial, Helvetica, sans-serif';
$caracter2 = '"", ';
//template width hack for IE 4-6
$template_width = 900;
$template_width_hack = $template_width / 2;
?>
/*jsp:new:events_calendar*/
/*@import url("calendar.css");*/
/**********instantnishop.cz special START *************************/
.spodlinka {
  background-image: url(/i/linka-vodorovna.gif); background-position: left bottom; background-repeat: repeat-x; 
}
TD.pollBoxRow {
font-family:  Arial, sans-serif;
font-size: 10px;
border-color: #fff;
border-style: solid;
border-width: 1px;
}
TD.pollBoxText {
font-family: Verdana, Arial, sans-serif;
font-size: 10px;   
border-color: #fff;
border-style: solid;
border-width: 1px;
}

TR.pollOptRow {
background: #fff;
}
TR.pollFooter {
  background: #fff;
}


.adminmenutoplista {
text-align:left;
position:absolute;
z-index:9089897;
left:800px; 
top:-100px;
width:600px;
height:80%;
background:#eee;
color:#000 !important;
}
.adminmenutoplista_zahlavi {
background: #ccc;
width:100%;
color:#fff;
font-size:22px;
}
.admintophref {
background: #e95d0f;
color:#fff;
text-decoration: none;
margin-right:8px;
}
.nh2 {
text-decoration: none;
}
.hpnewsimage {
width:80px;
margin-right:12px;
}
.searchwindow {
position:absolute;
z-index:1111;
left:644px; 
top:60px;
width:220px;
height:16px;
}
.langselector {
position:absolute;
z-index:122221;
right:0px; 
top:60px;
width:80px;
height:16px;
text-align:right;
}
.searchtext {
color: #979797; 
width:190px;
border:1px solid #ccc;
font-size:11px;
}
.claim {
position:absolute;
left:134px; 
top:26px;
font-size:11px;
text-align:left;
font-variant:small-caps;
color:#ccc;
width:100%;
height:100%;
}
img {border: none}
.homelinka {
  background-image: url(/i/linka-vnitrni-svisla.gif); background-position: right top; background-repeat: repeat-y; 
position:absolute;left:15px;top:0px;width:340px !important; 

}
.fnhref {
text-decoration: none;
}
div, p, li {color:#666}
.ColorWhite {color:#fff}
div, p, td {font-size:12px;}
/*nepodtrzeny odkaz:*/
.n {
text-decoration: none;
font-size:12px;
}
.nlezaty {
text-decoration: none;
font-size:12px;
float: left;
margin-right:70px;
}
hr {
border-top: 1px solid black;
}
.menuCat {
color: #333;
text-decoration: underline;
font-size:14px;
line-height:130%;
margin-left:5px;
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
right:8px;
top:152px;
width: 155px;
/*border: 1px solid <?echo $pozadi_sloupce; ?>;*/
background: transparent;
}
.menicko {
position:absolute;
right:0px;
top:90px;
width: 100%;
height:20px;
color:#ccc;
background:#939393;
opacity: 0.7;
/* filter: alpha(opacity=100); */
z-index:287667857;

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
  width:430px;
/*  height:10%; */
  text-align:left;
}
h3 {
/*  margin-top:0px; */
}

/**********instantnishop.cz special END *************************/
#page {
  background: <?php echo $sfondo; ?>;
  clear: both;
  position: absolute;

}
.productsNotifications { background: <?php echo $notification ?>; color: <?php echo $colore_testo ?>; }
.orderEdit { color: <?php echo $orderEdit ?>; text-decoration: underline; background: transparent; }

BODY {
  font-family: <?php echo $caracter ?>;
  text-align: center;
  color: <?php echo $colore_testo ?>;
  margin: 0px;
  background-image: url(i/prouzek.gif);
  <? if (ADMIN_LOGIN==1)  echo 'background-position: -10px top;'; else echo 'background-position: center top;'; ?>
  background-repeat: repeat-y;
  background-color:#ffffff;
 }

A {
  color: #868686;
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
position:relative;
left:-1px;
top:0px;
height:120px;
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
  font-size: 10px;
  margin-bottom:4px;
 /* width:120px; */
  background: #ffffff;
  height:16px;
  color: #000000;border:1px solid;
  border-color:<?php echo $bordo ?>; 
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
  width: 200px!important;
 position: absolute; top: 120px; left:0px;
}
.Table_templateCentral {
width: 486px;
position:absolute;
left:224px;
top:145px;
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
  position: absolute;
  left:0px;
  top:0px;
  width: 100%;
  height: 120px;
  background: url('i/bannerhorniDvere.gif');
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
  text-align: right;
  background: transparent;
  color: #ffffff; /*#8f8255;*/
  font-size:13px;
/*  font-variant:small-caps;*/
  letter-spacing:0.07em;
  text-decoration: none;
  margin-right:30px;
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
  background: #e95d0f;
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
  color: <?php echo $colore_testo ?>;
  border:0px;
 /*width:100px;*/
}
.imgXcat {
  background: transparent;
  color: #cccccc;
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
  text-decoration: none;
  font-size:10px;
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
left:0px;
text-align: left;
font-size: 180%;
line-height:100%;
font-weight: bold;
color: #cccccc;
height:26px;
letter-spacing:0.03em;
}
.ramTlusty {
background:#cccccc;
height:35px;
color: #ffffff;
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
margin-top:0px;
margin-bottom:0px;
color: <?php echo $colore_testo ?>;
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
  background:  #cccccc;
  color:#ffffff;
  letter-spacing:0.09em;
  padding-left:10px;
}
.BoxRamecekTop {
  font-size: 15px;
  text-align: left;
  font-weight: bold;
  font-variant:small-caps;
  background:  #ffffff;
  color:#ffffff;
  border-top: 1px solid black;
  letter-spacing:0.09em;
  padding-left:10px;
}
.nadpis1 {
  color:#ffffff;
  text-decoration: none;
}
.InfoBoxContenent2MABox {
  border-style:solid;
  border-width:0px;
  border-color: <?php echo $bordo ?>;
  color: #000000;
  background: transparent;
  padding: 0px;
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
  background: #fe0000;
  color: #ffffff;
  font-size: 10px;
  cursor: pointer;
  text-align:center;
  border: 1px solid #ffffff;
/*  border-style: outset;
  border-color: <?php echo $bordo ?>;
  border-spacing: 1px;
*/
  letter-spacing:0.05em;
  height:20px;
  text-decoration:none;
}
