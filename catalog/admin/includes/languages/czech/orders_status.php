<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\define('HEADING_TITLE', 'Stav objednávek');

\define('TABLE_HEADING_ORDERS_STATUS', 'Stav objednávek');
\define('TABLE_HEADING_PUBLIC_STATUS', 'Veřejné Stav');
\define('TABLE_HEADING_DOWNLOADS_STATUS', 'Ke stažení Stav');
\define('TABLE_HEADING_ACTION', 'Proveď');

\define('TEXT_INFO_EDIT_INTRO', 'Prosím proveďte potřebné změny');
\define('TEXT_INFO_ORDERS_STATUS_NAME', 'Stav objednávek:');
\define('TEXT_INFO_INSERT_INTRO', 'Prosím, zadejte nový stav objednávek s ním ve spojení dat');
\define('TEXT_INFO_DELETE_INTRO', 'Opravdu to chcete smazat?');
\define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Nový stav objednávek');
\define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Úprava objednávek');
\define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Smazat');

\define('TEXT_SET_PUBLIC_STATUS', 'Zobrazit rozkaz k zákazníkovi na této úrovni stavu objednávky');
\define('TEXT_SET_DOWNLOADS_STATUS', 'Povolit stahování virtuálních produktů na této úrovni stavu objednávky');

\define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Chyba: výchozí stav objednávky nemohou být odstraněny. Prosím nastavte jiný stav objednávky jako výchozí, a zkuste to znovu.');
\define('ERROR_STATUS_USED_IN_ORDERS', 'Chyba: Tento stav objednávky je v současné době v objednávce.');
\define('ERROR_STATUS_USED_IN_HISTORY', 'Chyba: Tento stav objednávky se v současné době používá v historii stavu objednávky.');
