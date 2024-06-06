<?php
/*
  $Id: currencies.php,v 1.12 2003/06/25 20:36:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('HEADING_TITLE', 'Valute');

define('TABLE_HEADING_CURRENCY_NAME', 'Valuta');
define('TABLE_HEADING_CURRENCY_CODES', 'Codice');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valore');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_INFO_EDIT_INTRO', 'Effettua i cambiamenti necessari');
define('TEXT_INFO_CURRENCY_TITLE', 'Titolo:');
define('TEXT_INFO_CURRENCY_CODE', 'Codice:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Simbolo a sinistra:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Simbolo a destra:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Punto dei Decimi:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Punto delle migliaia:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Posizioni Decimali:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Ultima modifica:');
define('TEXT_INFO_CURRENCY_VALUE', 'Valore:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Output d\'esempio:');
define('TEXT_INFO_INSERT_INTRO', 'Immetti la nuova Valuta con i dati necessari');
define('TEXT_INFO_DELETE_INTRO', 'Sicuro di voler eliminare questa Valuta?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nuova Valuta');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Modifica Valuta');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Cancella Valuta');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (occorre un aggiornamento manuale per il valore della valuta)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Il tasso di cambio di %s (%s) &egrave; stato aggiornato con successo a  %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Errore: La valuta di Default non può essere rimossa. Seleziona un\' altra Valuta  di default e riprova.');
define('ERROR_CURRENCY_INVALID', 'Errore: Il tasso di cambio di %s (%s) non &egrave; stato aggiornato con successo a %s. E\' un codice di valuta valido?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Attenzione: Il tasso di cambio primario (%s) manca di %s (%s) - prova con il secondo tasso di cambio.');
?>
