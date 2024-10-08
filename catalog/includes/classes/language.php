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
class language
{
    public $languages;
    public $catalog_languages;
    public $browser_languages;
    public $language;

    public function __construct($lng = '')
    {
        $this->languages = ['ar' => 'ar([-_][[:alpha:]]{2})?|arabic',
            'bg' => 'bg|bulgarian',
            'br' => 'pt[-_]br|brazilian portuguese',
            'ca' => 'ca|catalan',
            'cs' => 'cs|czech',
            'da' => 'da|danish',
            'de' => 'de([-_][[:alpha:]]{2})?|german',
            'el' => 'el|greek',
            'en' => 'en([-_][[:alpha:]]{2})?|english',
            'es' => 'es([-_][[:alpha:]]{2})?|spanish',
            'et' => 'et|estonian',
            'fi' => 'fi|finnish',
            'fr' => 'fr([-_][[:alpha:]]{2})?|french',
            'gl' => 'gl|galician',
            'he' => 'he|hebrew',
            'hu' => 'hu|hungarian',
            'id' => 'id|indonesian',
            'it' => 'it|italian',
            'ja' => 'ja|japanese',
            'ko' => 'ko|korean',
            'ka' => 'ka|georgian',
            'lt' => 'lt|lithuanian',
            'lv' => 'lv|latvian',
            'nl' => 'nl([-_][[:alpha:]]{2})?|dutch',
            'no' => 'no|norwegian',
            'pl' => 'pl|polish',
            'pt' => 'pt([-_][[:alpha:]]{2})?|portuguese',
            'ro' => 'ro|romanian',
            'ru' => 'ru|russian',
            'sk' => 'sk|slovak',
            'sr' => 'sr|serbian',
            'sv' => 'sv|swedish',
            'th' => 'th|thai',
            'tr' => 'tr|turkish',
            'uk' => 'uk|ukrainian',
            'tw' => 'zh[-_]tw|chinese traditional',
            'zh' => 'zh|chinese simplified'];

        $this->catalog_languages = [];
        $languages_query = tep_db_query('select languages_id, name, code, image, directory from languages order by sort_order');

        while ($languages = tep_db_fetch_array($languages_query)) {
            $this->catalog_languages[$languages['code']] = ['id' => $languages['languages_id'],
                'name' => $languages['name'],
                'image' => $languages['image'],
                'directory' => $languages['directory']];
        }

        $this->browser_languages = '';
        $this->language = '';

        $this->set_language(empty($lng) ? 'en' : $lng);
    }

    public function set_language($language): void
    {
        if ((!empty($language)) && (isset($this->catalog_languages[$language]))) {
            $this->language = $this->catalog_languages[$language];
        } else {
            $this->language = $this->catalog_languages[\defined('DEFAULT_LANGUAGE') ? DEFAULT_LANGUAGE : 'cs'];
        }
    }

    public function get_browser_language(): void
    {
        $this->browser_languages = explode(',', empty(getenv('HTTP_ACCEPT_LANGUAGE')) ? 'cs' : getenv('HTTP_ACCEPT_LANGUAGE'));

        for ($i = 0, $n = \count($this->browser_languages); $i < $n; ++$i) {
            foreach ($this->languages as $key => $value) {
                if (preg_match('/^('.$value.')(;q=[0-9]\\.[0-9])?$/i', $this->browser_languages[$i]) && isset($this->catalog_languages[$key])) {
                    $this->language = $this->catalog_languages[$key];

                    break 2;
                }
            }
        }
    }
}
