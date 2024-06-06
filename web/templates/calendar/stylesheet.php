<?php
/*
Contributed by: maury2ma - magnino maurizio / VitForLinux vittorio bisoglio 
ITALY Resurce
Released under the GNU General Public License 2
2006/05/05
www.magnino.net
to change template automatically to change date 
*/

$Happyday = date("md");  
// per le date con il giorno 
$Happy = '';
// per le date con solo il mese
$HappyTemp = date("m"); 

if (file_exists('templates/calendar/' . $Happyday . '/stylesheet.php')==1) {
    $Happy = $Happyday;
  } elseif ($HappyTemp == '01' ) {
    $Happy = '01_January';
  } elseif ($HappyTemp == '02') {
    $Happy = '02_February';
  } elseif ($HappyTemp == '03') {
    $Happy = '03_March';
  } elseif ($HappyTemp == '04') {
    $Happy = '04_April';
  } elseif ($HappyTemp == '05') {
    $Happy = '05_May';
  } elseif ($HappyTemp == '06') {
    $Happy = '06_June';
  } elseif ($HappyTemp == '07') {
    $Happy = '07_July';
  } elseif ($HappyTemp == '08') {
    $Happy = '08_August';
  } elseif ($HappyTemp == '09') {
    $Happy = '09_September';
  } elseif ($HappyTemp == '10') {
    $Happy = '10_October';
  } elseif ($HappyTemp == '11') {
    $Happy = '11_November';
  } elseif ($HappyTemp == '12') {
    $Happy = '12_December';
  } else {
    $Happy = '00_Default';
}
if (file_exists('templates/calendar/' . $Happy . '/stylesheet.php')==1){ 
  require ('templates/calendar/' . $Happy . '/stylesheet.php');
  } else { 
  require ('templates/calendar/00_Default/stylesheet.php');
}
?>