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

// Pouzivani bez souhlasu autora neni povoleno
// #Ver:PRV089-22-g45d1515b:2021-09-02#

require_once __DIR__.'/UniGPWebPay.php';

class UniGPWebPayGpe extends UniGPWebPay
{
    public function __construct($configSetting, $subMethod)
    {
        parent::__construct($configSetting, $subMethod, 'GPWebPayGpe');
    }

    public function getConfigInfo($language = 'en')
    {
        $configInfo = parent::getConfigInfo($language);
        $configInfo->configFields = array_filter($configInfo->configFields, static function ($v) {
            return !\in_array($v->name, ['provider', 'cronSecret', 'convertToCurrencyIfUnsupported'], true);
        });

        return $configInfo;
    }
    public function setConfigFromData($configSetting): void
    {
        parent::setConfigFromData($configSetting);
        $this->config->convertToCurrencyIfUnsupported = '';
    }

    public function getInfoBoxData($uniAdapterName, $language)
    {
        $prev = $this->name;
        $this->name = 'GPWebPay';
        $ret = parent::getInfoBoxData($uniAdapterName, $language);
        $this->name = $prev;

        return $ret;
    }
}
