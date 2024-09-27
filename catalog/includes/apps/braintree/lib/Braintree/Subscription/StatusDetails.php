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

namespace Braintree\Subscription;

use Braintree\Instance;

/**
 * Status details from a subscription
 * Creates an instance of StatusDetails, as part of a subscription response.
 *
 * @property string    $balance
 * @property string    $currencyIsoCode
 * @property string    $planId
 * @property string    $price
 * @property string    $status
 * @property string    $subscriptionSource
 * @property \DateTime $timestamp
 * @property string    $user
 */
class StatusDetails extends Instance
{
}
