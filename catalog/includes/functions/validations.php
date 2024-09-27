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

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;

function tep_validate_email($email)
{
    $validator = new EmailValidator();

    if (ENTRY_EMAIL_ADDRESS_CHECK === 'true') {
        $multipleValidations = new MultipleValidationWithAnd([
            new RFCValidation(),
            new DNSCheckValidation(),
        ]);
    } else {
        $multipleValidations = new MultipleValidationWithAnd([
            new RFCValidation(),
        ]);
    }

    return $validator->isValid(trim($email), $multipleValidations);
}
