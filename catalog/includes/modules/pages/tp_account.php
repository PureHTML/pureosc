<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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
class tp_account
{
    public $group = 'account';

    public function prepare(): void
    {
        global $oscTemplate;

        $oscTemplate->_data[$this->group] = ['account' => ['title' => MY_ACCOUNT_TITLE,
            'links' => ['edit' => ['title' => MY_ACCOUNT_INFORMATION,
                'link' => tep_href_link('account_edit.php'),
                'icon' => 'person'],
                'address_book' => ['title' => MY_ACCOUNT_ADDRESS_BOOK,
                    'link' => tep_href_link('address_book.php'),
                    'icon' => 'home'],
                'password' => ['title' => MY_ACCOUNT_PASSWORD,
                    'link' => tep_href_link('account_password.php'),
                    'icon' => 'key']]],
            'orders' => ['title' => MY_ORDERS_TITLE,
                'links' => ['history' => ['title' => MY_ORDERS_VIEW,
                    'link' => tep_href_link('account_history.php'),
                    'icon' => 'cart']]],
            'notifications' => ['title' => EMAIL_NOTIFICATIONS_TITLE,
                'links' => ['newsletters' => ['title' => EMAIL_NOTIFICATIONS_NEWSLETTERS,
                    'link' => tep_href_link('account_newsletters.php'),
                    'icon' => 'mail-closed'],
                    'products' => ['title' => EMAIL_NOTIFICATIONS_PRODUCTS,
                        'link' => tep_href_link('account_notifications.php'),
                        'icon' => 'heart']]]];
    }

    public function build(): void
    {
        global $oscTemplate;

        $output = '';

        foreach ($oscTemplate->_data[$this->group] as $group) {
            $output .= '<h2>'.$group['title'].'</h2>'.
                       '  <ul class="list-unstyled">';

            foreach ($group['links'] as $entry) {
                $output .= '    <li>';

                if (isset($entry['icon'])) {
                    $output .= '<span class="ui-icon ui-icon-'.$entry['icon'].'"></span>';
                }

                $output .= '<a href="'.$entry['link'].'">'.$entry['title'].'</a></li>';
            }

            $output .= '  </ul>';
        }

        $oscTemplate->addContent($output, $this->group);
    }
}
