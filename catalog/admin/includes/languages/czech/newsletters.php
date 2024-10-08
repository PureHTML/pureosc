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

\define('HEADING_TITLE', 'Novinky Správce');

\define('TABLE_HEADING_NEWSLETTERS', 'Zpravodaje');
\define('TABLE_HEADING_SIZE', 'Velikost');
\define('TABLE_HEADING_MODULE', 'Typ');
\define('TABLE_HEADING_SENT', 'Poslat');
\define('TABLE_HEADING_STATUS', 'Stav');
\define('TABLE_HEADING_ACTION', 'Proveď');

\define('TEXT_NEWSLETTER_MODULE', 'Typ:');
\define('TEXT_NEWSLETTER_TITLE', 'Titulek dopisu:');
\define('TEXT_NEWSLETTER_CONTENT', 'Zpráva:');

\define('TEXT_NEWSLETTER_DATE_ADDED', 'Vloženo:');
\define('TEXT_NEWSLETTER_DATE_SENT', 'Upraveno:');

\define('TEXT_INFO_DELETE_INTRO', 'Opravdu to chceš vymazat?');

\define('TEXT_PLEASE_WAIT', 'Čekejte prosím .. odesílání e-mailů .. <br /><br /> Prosím nepřerušujte tento proces!');
\define('TEXT_FINISHED_SENDING_EMAILS', 'Dokončení zasílání e-mailů!');

\define('ERROR_NEWSLETTER_TITLE', 'Chyba: Novinky Název nutné');
\define('ERROR_NEWSLETTER_MODULE', 'Chyba: Novinky modul vyžaduje');
\define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Chyba: Prosím, zajistěte newsletter před odstraněním.');
\define('ERROR_EDIT_UNLOCKED_NEWSLETTER', <<<'EOD'
Chyba: Prosím, zajistěte newsletter před úpravou.

EOD);
\define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Chyba: prosím zamknout newsletter před odesláním.');
