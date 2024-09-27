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

class logger
{
    public $timer_start;
    public $timer_stop;
    public $timer_total;

    // class constructor
    public function __construct()
    {
        $this->timer_start();
    }

    public function timer_start(): void
    {
        if (\defined('PAGE_PARSE_START_TIME')) {
            $this->timer_start = PAGE_PARSE_START_TIME;
        } else {
            $this->timer_start = microtime();
        }
    }

    public function timer_stop($display = 'false')
    {
        $this->timer_stop = microtime();

        $time_start = explode(' ', $this->timer_start);
        $time_end = explode(' ', $this->timer_stop);

        $this->timer_total = number_format($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0]), 3);

        $this->write(getenv('REQUEST_URI'), $this->timer_total.'s');

        if ($display === 'true') {
            return $this->timer_display();
        }
    }

    public function timer_display()
    {
        return '<span class="smallText">Parse Time: '.$this->timer_total.'s</span>';
    }

    public function write($message, $type): void
    {
        error_log(strftime(STORE_PARSE_DATE_TIME_FORMAT).' ['.$type.'] '.$message."\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }
}
