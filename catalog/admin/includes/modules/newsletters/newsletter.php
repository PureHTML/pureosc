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

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class newsletter
{
    public $show_choose_audience;
    public $title;
    public $content;

    public function __construct($title, $content)
    {
        $this->show_choose_audience = false;
        $this->title = $title;
        $this->content = $content;
    }

    public function choose_audience()
    {
        return false;
    }

    public function confirm()
    {
        $mail_query = tep_db_query("SELECT count(*) AS count FROM customers WHERE customers_newsletter = '1'");
        $mail = tep_db_fetch_array($mail_query);

        $confirm_string = '<table border="0" cellspacing="0" cellpadding="2">'."\n".
                          "  <tr>\n".
                          '    <td class="main"><strong style="color:#ff0000">'.sprintf(TEXT_COUNT_CUSTOMERS, $mail['count'])."</strong></td>\n".
                          "  </tr>\n".
                          "  <tr>\n".
                          '    <td>'.tep_draw_separator('pixel_trans.gif', '1', '10')."</td>\n".
                          "  </tr>\n".
                          "  <tr>\n".
                          '    <td class="main"><strong>'.$this->title."</strong></td>\n".
                          "  </tr>\n".
                          "  <tr>\n".
                          '    <td>'.tep_draw_separator('pixel_trans.gif', '1', '10')."</td>\n".
                          "  </tr>\n".
                          "  <tr>\n".
                          '    <td class="main">'.nl2br($this->content)."</td>\n".
                          "  </tr>\n".
                          "  <tr>\n".
                          '    <td>'.tep_draw_separator('pixel_trans.gif', '1', '10')."</td>\n".
                          "  </tr>\n".
                          "  <tr>\n".
                          '    <td class="smallText" align="right">'.tep_draw_button(IMAGE_SEND, 'mail-closed', tep_href_link('newsletters.php', 'page='.$_GET['page'].'&nID='.$_GET['nID'].'&action=confirm_send'), 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('newsletters.php', 'page='.$_GET['page'].'&nID='.$_GET['nID']))."</td>\n".
                          "  </tr>\n".
                          '</table>';

        return $confirm_string;
    }

    public function send($newsletter_id): void
    {
        $mail_query = tep_db_query("SELECT customers_firstname, customers_lastname, customers_email_address FROM customers WHERE customers_newsletter = '1'");

        $to_name = [];

        while ($mail = tep_db_fetch_array($mail_query)) {
            $to_name[$mail['customers_email_address']] = $mail['customers_firstname'].' '.$mail['customers_lastname'];
        }

        tep_mail($to_name, null, $this->title, $this->content, tep_extra_emails_array(EMAIL_FROM), null);

        tep_db_query("update newsletters set date_sent = now(), status = '1' where newsletters_id = '".(int) $newsletter_id."'");
    }
}
