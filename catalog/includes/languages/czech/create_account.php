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

\define('NAVBAR_TITLE', 'Založit účet');
\define('HEADING_TITLE', 'Informace o mém účtu');
\define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>INFO:</b></font></small> Pokud zde již máte vytvořen účet, prosím přihlašte se <a href="%s"><u>zde</u></a>.');

\define('EMAIL_SUBJECT', 'Vítejte v '.STORE_NAME);
\define('EMAIL_GREET_MR', 'Vážený pane. '.stripslashes($HTTP_POST_VARS['lastname']).",\n\n");
\define('EMAIL_GREET_MS', 'Vážená paní. '.stripslashes($HTTP_POST_VARS['lastname']).",\n\n");
\define('EMAIL_GREET_NONE', 'Vážený(á) '.stripslashes($HTTP_POST_VARS['firstname']).",\n\n");
\define('EMAIL_WELCOME', 'Vítáme vás v <b>'.STORE_NAME."</b>.\n\n");
\define('EMAIL_TEXT', "Nyní můžete využívat <b>různé služby</b>, které vám nabízíme. Některé z těchtoslužeb jsou:\n\n<li><b>Zákaznický košík</b> - Veškeré zboží vložené do košíku je vněm uloženo dokud se neodstraní z košíku, nebo nedokončí nákup.\n<li><b>Adresář</b> - Můžeme doručit zboží i na jiné adresy, než kterou uvedete v registraci! Toto je skvělé například pro zaslání dárku k narozeninám přímo osobě, kterou chcete obdarovat.\n<li><b>Historie objednávek</b> - Zobrazení veškerých objednávek provedených v našem obchodě.\n<li><b>Hodnocení produktů</b> - Podělte se o své zkušenosti s nabízeným zbožím i s ostatními návštěvníky.\n\n");
\define('EMAIL_CONTACT', 'Pro pomoc s čímkoliv na našem on=line obchodě prosím kontaktujte provozovatele: '.STORE_OWNER_EMAIL_ADDRESS.".\n\n");
\define('EMAIL_WARNING', '<b>Poznámka:</b> Tento e-mail nám byl poskytnut jedním z našich zákazníků. Pokud nejste přihlášený zákazník a nepřejete si dostávat žádné nabídky, pošlete prosím e-mail na '.STORE_OWNER_EMAIL_ADDRESS.".\n");
