<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\define('HEADING_TITLE', 'Správa banerů');

\define('TABLE_HEADING_BANNERS', 'Baner');
\define('TABLE_HEADING_GROUPS', 'Skupina');
\define('TABLE_HEADING_STATISTICS', 'Zobrazeno / kliknuto');
\define('TABLE_HEADING_STATUS', 'Stav');
\define('TABLE_HEADING_ACTION', 'Proveď');

\define('TEXT_BANNERS_TITLE', 'Název baneru:');
\define('TEXT_BANNERS_URL', 'URL baneru:');
\define('TEXT_BANNERS_GROUP', 'Skupina banerů:');
\define('TEXT_BANNERS_NEW_GROUP', ', nebo založ novou skupinu banerů.');
\define('TEXT_BANNERS_IMAGE', 'Obrázek:');
\define('TEXT_BANNERS_IMAGE_LOCAL', ', na svém lokálním disku');
\define('TEXT_BANNERS_IMAGE_TARGET', 'Cesta k baneru(již uložený):');
\define('TEXT_BANNERS_HTML_TEXT', 'HTML text:');
\define('TEXT_BANNERS_EXPIRES_ON', 'Zobrazovat do:');
\define('TEXT_BANNERS_OR_AT', ', nebo');
\define('TEXT_BANNERS_IMPRESSIONS', 'zobrazení.');
\define('TEXT_BANNERS_SCHEDULED_AT', 'Zobrazovat od:');
\define('TEXT_BANNERS_BANNER_NOTE', '<b>Poznámky k banerům:</b><ul><li>použijte obrázek nebo text HTML pro banneru - ne obojí </li><li>HTML Text má přednost před obrazem</li></ul>');
\define('TEXT_BANNERS_INSERT_NOTE', '<b>Poznámky k obrázkům:</b><ul><li>Nahrávání adresáře musí mít správné nastavení uživatele ( zápis ) oprávnění !</li><li>Ještě vyplňte \' Uložit do \' pole, pokud si nejste nahrávání obrazu na webový server ( tzn. , že používáte místní ( serverside ) obraz ) .</li><li>Příkaz \' Uložit do \' pole musí býtexistující adresář s koncovkou lomítkem ( např. bannery / ) .</li></ul>');
\define('TEXT_BANNERS_EXPIRCY_NOTE', <<<'EOD'
<b>Vypršení Poznámky :</b><ul><li>By měl být předložen pouze jeden ze dvou polí</li><li>Pokudbanner není automaticky vyprší , pak tato pole ponechte prázdná
</li></ul>
EOD);
\define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Plán Poznámky :</b><ul><li>Pokud je nastavenprogram, budebanner bude aktivován k tomuto datu .</li><li>Všechny naplánované bannery jsou označeny jako Neaktivní až do data jejich dorazil , na které se pak bude označen aktivní .</li></ul>');

\define('TEXT_BANNERS_DATE_ADDED', 'Přidán:');
\define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Zobrazován od: <b>%s</b>');
\define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Zobrazován do: <b>%s</b>');
\define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Zobrazován do: <b>%s</b> zobrazení.');
\define('TEXT_BANNERS_STATUS_CHANGE', 'Změnit stav: %s');

\define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
\define('TEXT_BANNERS_LAST_3_DAYS', 'Poslední 3 dny');
\define('TEXT_BANNERS_BANNER_VIEWS', 'Zobrazení baneru');
\define('TEXT_BANNERS_BANNER_CLICKS', 'Kliknuto na baner');

\define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete vymazat tento baner?');
\define('TEXT_INFO_DELETE_IMAGE', 'Vymazat baner.');

\define('SUCCESS_BANNER_INSERTED', 'Proces: baner byl zobrazen.');
\define('SUCCESS_BANNER_UPDATED', 'Proces: baner byl upraven.');
\define('SUCCESS_BANNER_REMOVED', 'Proces: baner byl opraven.');
\define('SUCCESS_BANNER_STATUS_UPDATED', 'Proces :stav banneru byla aktualizována .');

\define('ERROR_BANNER_TITLE_REQUIRED', 'Chyba:. Název Banner vyžaduje');
\define('ERROR_BANNER_GROUP_REQUIRED', 'Chyba: Banner skupina vyžaduje.');
\define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Cílový adresář neexistuje: %s');
\define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: Cílový adresář není zapisovatelný: %s');
\define('ERROR_IMAGE_DOES_NOT_EXIST', 'Chyba: Obrázek neexistuje.');
\define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Chyba: Obrázek nelze odstranit.');
\define('ERROR_UNKNOWN_STATUS_FLAG', 'Chyba: Neznámý stav vlajka.');

\define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Grafy adresář neexistuje. Prosím vytvořte a \'grafy \' adresáře uvnitř \' obrazy \'.');
\define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Chyba: Grafy adresář není zapisovatelný.');
