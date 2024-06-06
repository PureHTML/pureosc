<?php 
/* 
   (c) 2000-2001 The Exchange Project 
   (c) 2002-2003 osCommerce www.oscommerce.com 

   Released under the GNU General Public License 
   ----------------------------------------------------------------------------------------- 
   dirty coded by alex / poolie - alex@pooliestudios.com 
   added code 2004 by KAI "Saletco" - total-inn.de 
   FULL ENGLISH VERSION & ENHANCED INFO VERSION COMPILED BY DOMINIC STEIN
*/ 

require('includes/application_top.php'); 
require(DIR_WS_LANGUAGES .$language . '/birthday.php');
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" /> 
</head> 
<html>
<body> 
<!-- header //--> 
<?php require(DIR_WS_INCLUDES . 'header.php'); ?> 
<!-- header_eof //--> 

<!-- body //--> 
<table border="0" width="100%" cellspacing="2" cellpadding="2"> 
  <tr> 
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft"> 
<!-- left_navigation //--> 
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?> 
<!-- left_navigation_eof //--> 
    </table></td> 
<!-- body_text //--> 
    <td width="100%" valign="top"> 
     <table border="0" width="100%" cellspacing="0" cellpadding="2"> 
       <tr> 
          <td> 
          <table border="0" width="100%" cellspacing="0" cellpadding="0"> 
              <tr> 
                <td class="pageHeading"><?php echo HEADING_BIRTHDAYS; ?></td> 
              </tr> 
            </table> 
         </td> 
        </tr> 
            <tr> 
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0"> 
          <tr> 
            <td valign="top" class="smalltext"><?php echo TEXT_BIRTHDAYS; ?><br /><br /></td> 
          </tr> 
        </table></td> 
      </tr> 
       <tr> 
          <td> 
          <table border="0" width="80%" cellspacing="0" cellpadding="1"> 
                       <tr> 
                <td width="40%" bgcolor="#919FAE" class="dataTableHeadingContent"><?php echo TEXT_BIRTHDAYS_NAME; ?></td> 
		        <td width="40%" bgcolor="#919FAE" class="dataTableHeadingContent"><?php echo TEXT_BIRTHDAYS_DATE; ?></td> 
                <td width="40%" bgcolor="#919FAE" class="dataTableHeadingContent"><?php echo TEXT_BIRTHDAYS_EMAIL; ?></td> 
              </tr>
              </table>
<table border="0" width="80%" cellspacing="0" cellpadding="4"> 
<tr><td bgcolor="#919FAE" class="dataTableHeadingContent"><?php echo TEXT_BIRTHDAYS_NOWMONTH; ?></td></tr> 
</table>

<?php 
// $geburtstags_query = tep_db_query("SELECT customers_dob, customers_firstname, customers_id, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE MONTH(customers_dob) = MONTH(DATE_ADD(NOW(), INTERVAL 1 MONTH))"); 
//$geburtstags_query = tep_db_query("SELECT customers_dob, customers_firstname, customers_id, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE MONTH(customers_dob) = MONTH(DATE_ADD(NOW(),INTERVAL 0 MONTH))"); 
//while ($geburtstag = tep_db_fetch_array($geburtstags_query)){ 
?> 
<?php 
//      } 
?> 
            </table> 
           <table border="0" width="80%" cellspacing="0" cellpadding="1"> 
              <?php 
//$geburtstags_query = tep_db_query("SELECT customers_dob, customers_firstname, customers_id, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE MONTH(customers_dob) = MONTH(DATE_ADD(NOW(), INTERVAL 1 MONTH))"); 
$geburtstags_query = tep_db_query("SELECT customers_email_address, customers_dob, customers_firstname, customers_id, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE MONTH(customers_dob) = MONTH(DATE_ADD(NOW(),INTERVAL 0 MONTH)) ORDER BY DAYOFMONTH(customers_dob)"); 
while ($geburtstag = tep_db_fetch_array($geburtstags_query)){ 
?> 
<tr align="left"><td width="40%" class="main" bgcolor="#F0F1F1">&nbsp;
<?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, 'cID=' . $geburtstag['customers_id']) . '">' . tep_image(DIR_WS_ICONS . 'preview.png', ICON_ORDERS) . '</a>&nbsp;'; ?>
<a href="customers.php?cID=<?php echo $geburtstag['customers_id'] ?>&amp;action=edit"><?php echo $geburtstag['customers_lastname'] . ', ' . $geburtstag['customers_firstname']; ?></a></td> 
<td width="40%" class="smallText" bgcolor="#F0F1F1">&nbsp;<?php echo tep_date_short($geburtstag['customers_dob']); ?></td> 
<td width="40%" class="main" bgcolor="#F0F1F1">
<a href="mail.php?selected_box=tools&amp;customer=<?php echo $geburtstag['customers_email_address'] . '"><u>' . $geburtstag['customers_email_address'] . '</u></a>'; ?>

</td>
              </tr> 
              <?php 
      } 
?> 

            </table><br /> 
<table border="0" width="80%" cellspacing="0" cellpadding="4"> 
<tr><td bgcolor="#919FAE" class="dataTableHeadingContent"><?php echo TEXT_BIRTHDAYS_NEXTMONTH; ?></td></tr> 
</table>
           <table border="0" width="80%" cellspacing="0" cellpadding="1"> 

              <?php 
$geburtstags_query2 = tep_db_query("SELECT customers_email_address, customers_dob, customers_firstname, customers_id, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE MONTH(customers_dob) = MONTH(DATE_ADD(NOW(), INTERVAL 1 MONTH)) ORDER BY DAYOFMONTH(customers_dob)"); 
while ($geburtstag2 = tep_db_fetch_array($geburtstags_query2)){ 
?>
<tr align="left"><td width="40%" class="main" bgcolor="#F0F1F1">&nbsp;
<?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, 'cID=' . $geburtstag2['customers_id']) . '">' . tep_image(DIR_WS_ICONS . 'preview.png', ICON_ORDERS) . '</a>&nbsp;'; ?>
<a href="customers.php?cID=<?php echo $geburtstag2['customers_id'] ?>&amp;action=edit"><?php echo $geburtstag2['customers_lastname'] . ', ' . $geburtstag2['customers_firstname']; ?></a></td> 
<td width="40%" class="smallText" bgcolor="#F0F1F1">&nbsp;<?php echo tep_date_short($geburtstag2['customers_dob']); ?></td> 
<td width="40%" class="main" bgcolor="#F0F1F1">
<a href="mail.php?selected_box=tools&amp;customer=<?php echo $geburtstag2['customers_email_address'] . '"><u>' . $geburtstag2['customers_email_address'] . '</u></a>'; ?>
</td>
              </tr> 
              <?php 
      } 
?> 

            </table></td> 
        </tr> 

<!-- body_text_eof //--> 
      </table> 

<!-- body_eof //--> 

<!-- footer //--> 
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?> 
<!-- footer_eof //--> 
</body> 
</html> 
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>