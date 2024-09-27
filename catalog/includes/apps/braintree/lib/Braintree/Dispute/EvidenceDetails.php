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

namespace Braintree\Dispute;

use Braintree\Instance;

/**
 * Evidence details for a dispute.
 *
 * @property string    $category
 * @property string    $comment
 * @property \DateTime $createdAt
 * @property string    $id
 * @property \DateTime $sentToProcessorAt
 * @property string    $sequenceNumber
 * @property string    $tag
 * @property string    $url
 */
class EvidenceDetails extends Instance
{
    public function __construct($attributes)
    {
        if (\array_key_exists('category', $attributes)) {
            $attributes['tag'] = $attributes['category'];
        }

        parent::__construct($attributes);
    }
}
