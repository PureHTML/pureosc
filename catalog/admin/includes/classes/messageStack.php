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
class messageStack extends table_block {

    public $size = 0;
    public array $errors = [];

    public function __construct() {
        global $messageToStack;

        parent::__construct();
        if (isset($_SESSION['messageToStack'])) {
            for ($i = 0, $n = \count($messageToStack); $i < $n; ++$i) {
                $this->add($messageToStack[$i]['text'], $messageToStack[$i]['type']);
            }

            unset($_SESSION['messageToStack']);
        }
    }

    public function add($message, $type = 'error'): void {
        if ($type === 'error') {
            $this->errors[] = ['params' => 'class="messageStackError"', 'text' => tep_image('images/icons/error.gif', ICON_ERROR) . '&nbsp;' . $message];
        } elseif ($type === 'warning') {
            $this->errors[] = ['params' => 'class="messageStackWarning"', 'text' => tep_image('images/icons/warning.gif', ICON_WARNING) . '&nbsp;' . $message];
        } elseif ($type === 'success') {
            $this->errors[] = ['params' => 'class="messageStackSuccess"', 'text' => tep_image('images/icons/success.gif', ICON_SUCCESS) . '&nbsp;' . $message];
        } else {
            $this->errors[] = ['params' => 'class="messageStackError"', 'text' => $message];
        }

        ++$this->size;
    }

    public function add_session($message, $type = 'error'): void {
        global $messageToStack;

        if (!isset($_SESSION['messageToStack'])) {
            tep_session_register('messageToStack');
            $messageToStack = [];
        }

        $messageToStack[] = ['text' => $message, 'type' => $type];
    }

    public function reset(): void {
        $this->errors = [];
        $this->size = 0;
    }

    public function output() {
        $this->table_data_parameters = 'class="messageBox"';

        return $this->table_block($this->errors);
    }
}
