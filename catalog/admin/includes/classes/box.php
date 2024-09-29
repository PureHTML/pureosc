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
class box extends table_block {

    public string $heading = '';
    public string $contents = '';

    public function __construct() {
        parent::__construct();
    }

    public function infoBox($heading, $contents) {
        $this->table_row_parameters = 'class="infoBoxHeading"';
        $this->table_data_parameters = 'class="infoBoxHeading"';
        $this->heading = $this->table_block($heading);

        $this->table_row_parameters = '';
        $this->table_data_parameters = 'class="infoBoxContent"';
        $this->contents = $this->table_block($contents);

        return $this->heading . $this->contents;
    }

    public function menuBox($heading, $contents) {
        $this->table_data_parameters = 'class="menuBoxHeading"';

        if (isset($heading[0]['link'])) {
            $this->table_data_parameters .= ' onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . $heading[0]['link'] . '\'"';
            $heading[0]['text'] = '&nbsp;<a href="' . $heading[0]['link'] . '" class="menuBoxHeadingLink">' . $heading[0]['text'] . '</a>&nbsp;';
        } else {
            $heading[0]['text'] = '&nbsp;' . $heading[0]['text'] . '&nbsp;';
        }

        $this->heading = $this->table_block($heading);

        $this->table_data_parameters = 'class="menuBoxContent"';
        $this->contents = (!empty($contents) ? $this->table_block($contents) : '');

        return $this->heading . $this->contents;
    }
}
