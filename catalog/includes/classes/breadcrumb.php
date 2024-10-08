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
class breadcrumb
{
    public $_trail;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->_trail = [];
    }

    public function add($title, $link = ''): void
    {
        $this->_trail[] = ['title' => $title, 'link' => $link];
    }

    public function trail($separator = ' - ')
    {
        $trail_string = '';

        if ($_SERVER['SCRIPT_NAME'] === 'index.php' && !$cPath) {
            for ($i = 0, $n = \count($this->_trail); $i < $n; ++$i) {
                if (isset($this->_trail[$i]['link']) && !empty($this->_trail[$i]['link'])) {
                    if ($i === 0) {
                        $trail_string .= '<li class="list-inline-item"><a href="'.$this->_trail[$i]['link'].'">'.$this->_trail[$i]['title'].'</a></li>';
                    } else {
                        $trail_string .= '<li class="list-inline-item mx-2"><a href="'.$this->_trail[$i]['link'].'">'.$this->_trail[$i]['title'].'</a></li>';
                    }
                } else {
                    $trail_string .= '<li class="list-inline-item mx-2">'.$this->_trail[$i]['title'].'</li>';
                }

                if (($i + 1) < $n) {
                    $trail_string .= $separator;
                }
            }
        }

        return $trail_string;
    }
}
