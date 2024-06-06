<?php
/*
  $Id: newsletters.php,v 1.5 2002/03/08 22:10:08 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('HEADING_TITLE', 'Newsletter Manager');

define('TABLE_HEADING_NEWSLETTERS', 'Newsletters');
define('TABLE_HEADING_SIZE', 'Dimensione');
define('TABLE_HEADING_MODULE', 'Modulo');
define('TABLE_HEADING_SENT', 'Spedita');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_NEWSLETTER_MODULE', 'Modulo:');
define('TEXT_NEWSLETTER_TITLE', 'Titolo Newsletter:');
define('TEXT_NEWSLETTER_CONTENT', 'Contenuto:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Data inserimento:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Data di spedizione:');

define('TEXT_INFO_DELETE_INTRO', 'Sicuro di voler cancellare questa Newsletter?');

define('TEXT_PLEASE_WAIT', 'Prego attendere .. e-mails in spedizione ..<br /><br />Non interrompere il processo!');
define('TEXT_FINISHED_SENDING_EMAILS', 'E-mails spedite!');

define('ERROR_NEWSLETTER_TITLE', 'Errore: Titolo Newsletter necessario');
define('ERROR_NEWSLETTER_MODULE', 'Errore: Modulo Newsletter necessario');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Errore: Chiudi la Newsletter prima di cancellarla.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Errore: Chiudi la Newsletter prima di modificarla.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Errore: Chiudi la Newsletter prima di spedire le E-mails.');
?>