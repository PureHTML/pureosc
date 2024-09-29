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

class messageStack
{
    public array $messages = [];
    public function __construct()
    {
        if (isset($_SESSION['messageToStack'])) {
            for ($i = 0, $n = \count($_SESSION['messageToStack']); $i < $n; ++$i) {
                $this->add($_SESSION['messageToStack'][$i]['class'], $_SESSION['messageToStack'][$i]['text'], $_SESSION['messageToStack'][$i]['type']);
            }

            unset($_SESSION['messageToStack']);
        }
    }

    // class methods
    public function add($class, $message, $type = 'error'): void
    {
        $this->messages[] = ['type' => $type,
            'class' => $class,
            'text' => $message];
    }

    public function add_session($class, $message, $type = 'error'): void
    {
        if (!isset($_SESSION['messageToStack'])) {
            $_SESSION['messageToStack'] = [];
        }

        $_SESSION['messageToStack'][] = ['class' => $class,
            'text' => $message,
            'type' => $type];
    }

    public function reset(): void
    {
        $this->messages = [];
    }

    public function output($class)
    {
        $output = '';

        for ($i = 0, $n = \count($this->messages); $i < $n; ++$i) {
            if ($this->messages[$i]['class'] === $class) {
                if ($i === 0) {
                    $type = $this->messages[$i]['type'] === 'error' ? 'danger' : $this->messages[$i]['type'];

                    $output .= '<div class="alert alert-'.$type.' d-flex align-items-center" role="alert">';

                    switch ($type) {
                        case 'warning':
                        case 'danger':
                            $output .= <<<'EOD'
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
EOD;

                            break;
                        case 'success':
                            $output .= <<<'EOD'
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg>
EOD;

                            break;
                        case 'info':
                            $output .= <<<'EOD'
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</svg>
EOD;

                            break;
                    }

                    $output .= '<div>';
                }

                $output .= $this->messages[$i]['text'].'<br>';

                if ($i === ($n - 1)) {
                    $output .= '</div></div>';
                }
            }
        }

        return $output;
    }

    public function size($class)
    {
        $count = 0;

        for ($i = 0, $n = \count($this->messages); $i < $n; ++$i) {
            if ($this->messages[$i]['class'] === $class) {
                ++$count;
            }
        }

        return $count;
    }
}
