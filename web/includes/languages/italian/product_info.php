<?php
/*
  $Id: product_info.php,v 1.15 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/
// Points/Rewards Module V2.00 BOF
define('TEXT_PRODUCT_POINTS', '<span class="b">Credito Punti: </span> %s punti Correntemente valutati  %s');
define('TEXT_PRODUCT_NO_POINTS', '<span class="b">Credito Punti:</span> Non ci sono punti per i prodotti scontati.');
// Points/Rewards Module V2.00 EOF
define('TEXT_PRODUCT_NOT_FOUND', 'Prodotto non trovato!');
define('TEXT_CURRENT_REVIEWS', 'Attuale recensione:');
define('TEXT_MORE_INFORMATION', 'Per ulteriori informazioni, visita il <a href="%s" ><span class="ColorSpan">sito</span></a>.');
define('TEXT_DATE_ADDED', 'Questo prodotto &egrave; stato aggiunto al nostro catalogo il %s.');
define('TEXT_DATE_AVAILABLE', '<span class="ColorSpanRed">Questo Prodotto &egrave; in magazzino dal %s.</span>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'I clienti che hanno questo preso questo prodotto hanno anche comprato :');
define('TEXT_PRODUCT_OPTIONS', 'Opzioni disponibili:');
define('TEXT_CLICK_TO_ENLARGE', 'Clicca per ingrandire');
define('TABLE_HEADING_QUANTITY', 'Quantit&agrave;');

// multi image
define('TEXT_LIST_ENLARGE', 'Lista di immagini per l\'articolo : ');

// image for QTY
  define('TEXT_IN_STOCK', 'Stock articolo : ');
 define('TEXT_NOT_AVAIBLE', 'Non Disponibile');
 define('TEXT_FEW_QTY', 'Disponibilit&agrave; Normale');
 define('TEXT_BIG_QTY', 'Ottima Disponibilit&agrave;');

  define('TEXT_PRODUCTS_HEIGHT', 'Altezza:');
  define('TEXT_PRODUCTS_LENGTH', 'Lunghezza:');
  define('TEXT_PRODUCTS_WIDTH', 'Profondit&agrave;:');
  define('TEXT_PRODUCTS_READY_TO_SHIP', 'Pronto per la spedizione:');
  define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'il prodotto pu&ograve; essere spedito nel suo contenitore.');
  define('TEXT_PRODUCTS_CODEBAR', 'CODE-BAR:');
  define('TEXT_PRODUCTS_WEIGHT', 'Peso del prodotto:');
  
/* Optional Related Products (ORP) */
define('TEXT_RELATED_PRODUCTS', 'Altri prodotti collegati a questo articolo');
define('RELATED_PRODUCTS_MODEL_COMBO', ' (%s)');
define('RELATED_PRODUCTS_PRICE_TEXT', '%s');
define('RELATED_PRODUCTS_QUANTITY_TEXT', 'Ne sono rimasti solo %s !');
/***********************************/

define('MAX_REVIEWS', 5); # Number of maximum reviews on product_info page.
define('NO_REVIEWS_TEXT', 'Nessuno ha rilasciato recensioni per questo articolo, se vuoi essere tu il primo.....'); #Text
define('BOX_REVIEWS_HEADER_TEXT', 'Recensioni scritte'); #Text
define('ALL_REVIEWS', 'Clicca per vedere tutte le recensioni su questo articolo');
?>