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

\define('NAVBAR_TITLE', 'Bezpečnostní kontrola');
\define('HEADING_TITLE', 'Bezpečnostní kontrola');

\define('TEXT_INFORMATION', 'Zjistili jsme, že váš prohlížeč má generován jiný SSL Session ID použité v našich zabezpečených stránkách .<br><br>Z bezpečnostních opatřeních , které budete potřebovat pro přihlášení ke svému účtu znovu pokračovat v nakupování on-line .<br><br>Některé prohlížeče, například Konqueror 3.1 nemá schopnost automaticky které vyžadují vytváření zabezpečené SSL ID relace . Používáte-li takový prohlížeč , doporučujeme přechod na jiný prohlížeč , jako je <a href="http://www.microsoft.com/ie/" target="_blank">Microsoft Internet Explorer</a>, <a href="http://channels.netscape.com/ns/browsers/download_other.jsp" target="_blank">Netscape</a>, nebo <a href="http://www.mozilla.org/releases/" target="_blank">Mozilla</a>, , Pokračovat v on-line nakupování .<br><br>Vzali jsme toto měření bezpečnosti pro váš prospěch , a omlouváme pokud nějaké nepříjemnosti způsobené .<br><br>Prosím kontaktujte majitele obchodu , pokud máte jakékoliv dotazy týkající se tohoto požadavku , nebo pokračovat v nákupu výrobků v režimu offline .');

\define('BOX_INFORMATION_HEADING', 'Soukromí a bezpečnost');
\define('BOX_INFORMATION', <<<'EOD'
Jsme ověřit SSL Session ID automaticky generované vaším prohlížečem na každém bezpečném požadavku na stránku li se na tento server.
<br><br>Toto ověření zaručuje, že jste to vy, kdo je navigace na této stránce k vašemu účtu, a ne někdo jiný.
EOD);
