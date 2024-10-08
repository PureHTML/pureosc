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
class table_block
{
    public $table_border = '0';
    public $table_width = '100%';
    public $table_cellspacing = '0';
    public $table_cellpadding = '2';
    public $table_parameters = '';
    public $table_row_parameters = '';
    public $table_data_parameters = '';

    public function __construct()
    {
    }

    public function table_block($contents)
    {
        $tableBox_string = '';

        $form_set = false;

        if (isset($contents['form'])) {
            $tableBox_string .= $contents['form']."\n";
            $form_set = true;
            array_shift($contents);
        }

        $tableBox_string .= '<table border="'.$this->table_border.'" width="'.$this->table_width.'" cellspacing="'.$this->table_cellspacing.'" cellpadding="'.$this->table_cellpadding.'"';

        if (!empty($this->table_parameters)) {
            $tableBox_string .= ' '.$this->table_parameters;
        }

        $tableBox_string .= ">\n";

        for ($i = 0, $n = \count($contents); $i < $n; ++$i) {
            $tableBox_string .= '  <tr';

            if (!empty($this->table_row_parameters)) {
                $tableBox_string .= ' '.$this->table_row_parameters;
            }

            if (isset($contents[$i]['params']) && !empty($contents[$i]['params'])) {
                $tableBox_string .= ' '.$contents[$i]['params'];
            }

            $tableBox_string .= ">\n";

            if (isset($contents[$i][0]) && \is_array($contents[$i][0])) {
                for ($x = 0, $y = \count($contents[$i]); $x < $y; ++$x) {
                    if (isset($contents[$i][$x]['text']) && !empty($contents[$i][$x]['text'])) {
                        $tableBox_string .= '    <td';

                        if (isset($contents[$i][$x]['align']) && !empty($contents[$i][$x]['align'])) {
                            $tableBox_string .= ' align="'.$contents[$i][$x]['align'].'"';
                        }

                        if (isset($contents[$i][$x]['params']) && !empty($contents[$i][$x]['params'])) {
                            $tableBox_string .= ' '.$contents[$i][$x]['params'];
                        } elseif (!empty($this->table_data_parameters)) {
                            $tableBox_string .= ' '.$this->table_data_parameters;
                        }

                        $tableBox_string .= '>';

                        if (isset($contents[$i][$x]['form']) && !empty($contents[$i][$x]['form'])) {
                            $tableBox_string .= $contents[$i][$x]['form'];
                        }

                        $tableBox_string .= $contents[$i][$x]['text'];

                        if (isset($contents[$i][$x]['form']) && !empty($contents[$i][$x]['form'])) {
                            $tableBox_string .= '</form>';
                        }

                        $tableBox_string .= "</td>\n";
                    }
                }
            } else {
                $tableBox_string .= '    <td';

                if (isset($contents[$i]['align']) && !empty($contents[$i]['align'])) {
                    $tableBox_string .= ' align="'.$contents[$i]['align'].'"';
                }

                if (isset($contents[$i]['params']) && !empty($contents[$i]['params'])) {
                    $tableBox_string .= ' '.$contents[$i]['params'];
                } elseif (!empty($this->table_data_parameters)) {
                    $tableBox_string .= ' '.$this->table_data_parameters;
                }

                $tableBox_string .= '>'.$contents[$i]['text']."</td>\n";
            }

            $tableBox_string .= "  </tr>\n";
        }

        $tableBox_string .= "</table>\n";

        if ($form_set === true) {
            $tableBox_string .= "</form>\n";
        }

        return $tableBox_string;
    }
}
