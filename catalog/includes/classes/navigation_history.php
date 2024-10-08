<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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
class navigation_history
{
    public $path;
    public $snapshot;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->path = [];
        $this->snapshot = [];
    }

    public function add_current_page(): void
    {
        global $PHP_SELF, $request_type, $cPath;

        $set = 'true';

        for ($i = 0, $n = \count($this->path); $i < $n; ++$i) {
            if ($this->path[$i]['page'] === $PHP_SELF) {
                if (isset($cPath)) {
                    if (!isset($this->path[$i]['get']['cPath'])) {
                        continue;
                    }

                    if ($this->path[$i]['get']['cPath'] === $cPath) {
                        array_splice($this->path, $i + 1);
                        $set = 'false';

                        break;
                    }

                    $old_cPath = explode('_', $this->path[$i]['get']['cPath']);
                    $new_cPath = explode('_', $cPath);

                    for ($j = 0, $n2 = \count($old_cPath); $j < $n2; ++$j) {
                        if ($old_cPath[$j] !== $new_cPath[$j]) {
                            array_splice($this->path, $i);
                            $set = 'true';

                            break 2;
                        }
                    }
                } else {
                    array_splice($this->path, $i);
                    $set = 'true';

                    break;
                }
            }
        }

        if ($set === 'true') {
            $this->path[] = ['page' => $PHP_SELF,
                'mode' => $request_type,
                'get' => $this->filter_parameters($_GET),
                'post' => $this->filter_parameters($_POST)];
        }
    }

    public function remove_current_page(): void
    {
        global $PHP_SELF;

        $last_entry_position = \count($this->path) - 1;

        if ($this->path[$last_entry_position]['page'] === $PHP_SELF) {
            unset($this->path[$last_entry_position]);
        }
    }

    public function set_snapshot($page = ''): void
    {
        global $PHP_SELF, $request_type;

        if (\is_array($page)) {
            $this->snapshot = ['page' => $page['page'],
                'mode' => $page['mode'],
                'get' => $this->filter_parameters($page['get']),
                'post' => $this->filter_parameters($page['post'])];
        } else {
            $this->snapshot = ['page' => $PHP_SELF,
                'mode' => $request_type,
                'get' => $this->filter_parameters($_GET),
                'post' => $this->filter_parameters($_POST)];
        }
    }

    public function clear_snapshot(): void
    {
        $this->snapshot = [];
    }

    public function set_path_as_snapshot($history = 0): void
    {
        $pos = (\count($this->path) - 1 - $history);
        $this->snapshot = ['page' => $this->path[$pos]['page'],
            'mode' => $this->path[$pos]['mode'],
            'get' => $this->path[$pos]['get'],
            'post' => $this->path[$pos]['post']];
    }

    public function debug(): void
    {
        for ($i = 0, $n = \count($this->path); $i < $n; ++$i) {
            echo $this->path[$i]['page'].'?';

            foreach ($this->path[$i]['get'] as $key => $value) {
                echo $key.'='.$value.'&';
            }

            if (\count($this->path[$i]['post']) > 0) {
                echo '<br />';

                foreach ($this->path[$i]['post'] as $key => $value) {
                    echo '&nbsp;&nbsp;<strong>'.$key.'='.$value.'</strong><br />';
                }
            }

            echo '<br />';
        }

        if (\count($this->snapshot) > 0) {
            echo '<br /><br />';

            echo $this->snapshot['mode'].' '.$this->snapshot['page'].'?'.tep_array_to_string($this->snapshot['get'], [tep_session_name()]).'<br />';
        }
    }

    public function filter_parameters($parameters)
    {
        $clean = [];

        if (\is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                if (strpos($key, '_nh-dns') < 1) {
                    $clean[$key] = $value;
                }
            }
        }

        return $clean;
    }
}
