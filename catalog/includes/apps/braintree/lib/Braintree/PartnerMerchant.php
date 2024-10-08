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

namespace Braintree;

/**
 * Partner Merchant information that is generated when a partner is connected
 * to or disconnected from a user.
 *
 * Creates an instance of PartnerMerchants
 *
 * @property string $clientSideEncryptionKey
 * @property string $merchantPublicId
 * @property string $partnerMerchantId
 * @property string $privateKey
 * @property string $publicKey
 */
class PartnerMerchant extends Base
{
    protected $_attributes = [];

    /**
     * @ignore
     *
     * @param mixed $attributes
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /**
     * @ignore
     *
     * @param mixed $attributes
     */
    protected function _initialize($attributes): void
    {
        $this->_attributes = $attributes;
    }
}
