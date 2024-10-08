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
class shipping
{
    public $modules;

    // class constructor
    public function __construct($module = '')
    {
        global $language, $PHP_SELF;

        if (\defined('MODULE_SHIPPING_INSTALLED') && !empty(MODULE_SHIPPING_INSTALLED)) {
            $this->modules = explode(';', MODULE_SHIPPING_INSTALLED);

            $include_modules = [];

            if ((!empty($module)) && \in_array(substr($module['id'], 0, strpos($module['id'], '_')).'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1), $this->modules, true)) {
                $include_modules[] = ['class' => substr($module['id'], 0, strpos($module['id'], '_')), 'file' => substr($module['id'], 0, strpos($module['id'], '_')).'.'.substr($PHP_SELF, strrpos($PHP_SELF, '.') + 1)];
            } else {
                foreach ($this->modules as $value) {
                    $class = substr($value, 0, strrpos($value, '.'));
                    $include_modules[] = ['class' => $class, 'file' => $value];
                }
            }

            for ($i = 0, $n = \count($include_modules); $i < $n; ++$i) {
                include 'includes/languages/'.$language.'/modules/shipping/'.$include_modules[$i]['file'];

                include 'includes/modules/shipping/'.$include_modules[$i]['file'];

                $GLOBALS[$include_modules[$i]['class']] = new $include_modules[$i]['class']();
            }
        }
    }

    public function quote($method = '', $module = '')
    {
        global $total_weight, $shipping_weight, $shipping_quoted, $shipping_num_boxes;

        $quotes_array = [];

        if (\is_array($this->modules)) {
            $shipping_quoted = '';
            $shipping_num_boxes = 1;
            $shipping_weight = $total_weight;

            if (SHIPPING_BOX_WEIGHT >= $shipping_weight * SHIPPING_BOX_PADDING / 100) {
                $shipping_weight += SHIPPING_BOX_WEIGHT;
            } else {
                $shipping_weight += ($shipping_weight * SHIPPING_BOX_PADDING / 100);
            }

            if ($shipping_weight > SHIPPING_MAX_WEIGHT) { // Split into many boxes
                $shipping_num_boxes = ceil($shipping_weight / SHIPPING_MAX_WEIGHT);
                $shipping_weight /= $shipping_num_boxes;
            }

            $include_quotes = [];

            foreach ($this->modules as $value) {
                $class = substr($value, 0, strrpos($value, '.'));

                if (!empty($module)) {
                    if (($module === $class) && $GLOBALS[$class]->enabled) {
                        $include_quotes[] = $class;
                    }
                } elseif ($GLOBALS[$class]->enabled) {
                    $include_quotes[] = $class;
                }
            }

            $size = \count($include_quotes);

            for ($i = 0; $i < $size; ++$i) {
                $quotes = $GLOBALS[$include_quotes[$i]]->quote($method);

                if (\is_array($quotes)) {
                    $quotes_array[] = $quotes;
                }
            }
        }

        return $quotes_array;
    }

    public function get_first()
    {
        foreach ($this->modules as $value) {
            $class = substr($value, 0, strrpos($value, '.'));

            if ($GLOBALS[$class]->enabled) {
                foreach ($GLOBALS[$class]->quotes['methods'] as $method) {
                    if (isset($method['cost']) && !empty($method['cost'])) {
                        return ['id' => $GLOBALS[$class]->quotes['id'].'_'.$method['id'],
                            'title' => $GLOBALS[$class]->quotes['module'].' ('.$method['title'].')',
                            'cost' => $method['cost']];
                    }
                }
            }
        }
    }

    public function cheapest()
    {
        if (\is_array($this->modules)) {
            $rates = [];

            foreach ($this->modules as $value) {
                $class = substr($value, 0, strrpos($value, '.'));

                if ($GLOBALS[$class]->enabled) {
                    $quotes = $GLOBALS[$class]->quotes;

                    for ($i = 0, $n = \count($quotes['methods']); $i < $n; ++$i) {
                        if (isset($quotes['methods'][$i]['cost']) && !empty($quotes['methods'][$i]['cost'])) {
                            $rates[] = ['id' => $quotes['id'].'_'.$quotes['methods'][$i]['id'],
                                'title' => $quotes['module'].' ('.$quotes['methods'][$i]['title'].')',
                                'cost' => $quotes['methods'][$i]['cost']];
                        }
                    }
                }
            }

            $cheapest = false;

            for ($i = 0, $n = \count($rates); $i < $n; ++$i) {
                if (\is_array($cheapest)) {
                    if ($rates[$i]['cost'] < $cheapest['cost']) {
                        $cheapest = $rates[$i];
                    }
                } else {
                    $cheapest = $rates[$i];
                }
            }

            return $cheapest;
        }
    }
}
