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
 class objectInfo { 
 public function __construct($object_array) { 
 foreach ($object_array as $key => $value) { $this->$key = $value; 
     } } }
/*
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class object_info
//class object_info extends stdClass
{
    // class constructor
function __construct($object_array)
    {
        $this->objectInfo($object_array);
    }

function objectInfo($object_array): void
    {
        foreach ($object_array as $key => $value) {
            $this->{$key} = tep_db_prepare_input($value);
        }
    }
}
*/