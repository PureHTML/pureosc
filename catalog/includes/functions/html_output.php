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
 * ULTIMATE Seo Urls 5 PRO by FWR Media
 * Replacement for osCommerce href link wrapper function.
 */
require_once DIR_WS_MODULES.'ultimate_seo_urls5/main/usu5.php';

function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true)
{
    return Usu_Main::i()->hrefLink($page, $parameters, $connection, $add_session_id, $search_engine_safe);
}

// The HTML image wrapper function
function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '')
{
    if ((empty($src) || ($src === DIR_WS_IMAGES)) && (IMAGE_REQUIRED === 'false')) {
        return false;
    }

    if (!is_file($src)) {
        $src = 'images/no_picture.gif';
    }

    // alt is added to the img tag even if it is null to prevent browsers from outputting
    // the image filename as default
    $image = '<img src="'.tep_output_string($src).'" alt="'.tep_output_string($alt).'"';

    if (!empty($alt)) {
        $image .= ' title="'.tep_output_string($alt).'"';
    }

    if ((CONFIG_CALCULATE_IMAGE_SIZE === 'true') && (empty($width) || empty($height))) {
        if ($image_size = @getimagesize($src)) {
            if (empty($width) && !empty($height)) {
                $ratio = $height / $image_size[1];
                $width = (int) ($image_size[0] * $ratio);
            } elseif (!empty($width) && empty($height)) {
                $ratio = $width / $image_size[0];
                $height = (int) ($image_size[1] * $ratio);
            } elseif (empty($width) && empty($height)) {
                $width = $image_size[0];
                $height = $image_size[1];
            }
        } elseif (IMAGE_REQUIRED === 'false') {
            return false;
        }
    }

    if (!empty($width) && !empty($height)) {
        $image .= ' width="'.tep_output_string($width).'" height="'.tep_output_string($height).'"';
    }

    if (!empty($parameters)) {
        $image .= ' '.$parameters;
    }

    $image .= ' loading="lazy">';

    return $image;
}

// The HTML form submit button wrapper function
// Outputs a button in the selected language
function tep_image_submit($image, $alt = '', $parameters = '')
{
    global $language;

    $image_submit = '<input type="image" src="'.tep_output_string('includes/languages/'.$language.'/images/buttons/'.$image).'" alt="'.tep_output_string($alt).'"';

    if (!empty($alt)) {
        $image_submit .= ' title=" '.tep_output_string($alt).' "';
    }

    if (!empty($parameters)) {
        $image_submit .= ' '.$parameters;
    }

    $image_submit .= '>';

    return $image_submit;
}

// Output a function button in the selected language
function tep_image_button($image, $alt = '', $parameters = '')
{
    global $language;

    return tep_image('includes/languages/'.$language.'/images/buttons/'.$image, $alt, '', '', $parameters);
}

// Output a separator either through whitespace, or with an image
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1')
{
    return tep_image('images/'.$image, '', $width, $height);
}

// Output a form
function tep_draw_form($name, $action, $method = 'post', $parameters = '', $tokenize = false)
{
    global $sessiontoken;

    $form = '<form name="'.tep_output_string($name).'" action="'.tep_output_string($action).'" method="'.tep_output_string($method).'"';

    if (!empty($parameters)) {
        $form .= ' '.$parameters;
    }

    $form .= '>';

    if (($tokenize === true) && isset($sessiontoken)) {
        $form .= '<input type="hidden" name="formid" value="'.tep_output_string($sessiontoken).'">';
    }

    return $form;
}

// Output a form input field
function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true)
{
    $field = '<input type="'.tep_output_string($type).'" name="'.tep_output_string($name).'"';

    if (($reinsert_value === true) && ((isset($_GET[$name]) && \is_string($_GET[$name])) || (isset($_POST[$name]) && \is_string($_POST[$name])))) {
        if (isset($_GET[$name]) && \is_string($_GET[$name])) {
            $value = stripslashes($_GET[$name]);
        } elseif (isset($_POST[$name]) && \is_string($_POST[$name])) {
            $value = stripslashes($_POST[$name]);
        }
    }

    if (!empty($value)) {
        $field .= ' value="'.tep_output_string($value).'"';
    }

    if (!empty($parameters)) {
        $field .= ' '.$parameters;
    }

    $field .= '>';

    return $field;
}

// Output a form password field
function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"')
{
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
}

// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '')
{
    $selection = '<input type="'.tep_output_string($type).'" name="'.tep_output_string($name).'"';

    if (!empty($value)) {
        $selection .= ' value="'.tep_output_string($value).'"';
    }

    if (($checked === true) || (isset($_GET[$name]) && \is_string($_GET[$name]) && (($_GET[$name] === 'on') || (stripslashes($_GET[$name]) === $value))) || (isset($_POST[$name]) && \is_string($_POST[$name]) && (($_POST[$name] === 'on') || (stripslashes($_POST[$name]) === $value)))) {
        $selection .= ' checked="checked"';
    }

    if (!empty($parameters)) {
        $selection .= ' '.$parameters;
    }

    $selection .= '>';

    return $selection;
}

// Output a form checkbox field
function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '')
{
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
}

// Output a form radio field
function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '')
{
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
}

// Output a form textarea field
// The $wrap parameter is no longer used in the core xhtml template
function tep_draw_textarea_field($name, $text = '', $parameters = '', $reinsert_value = true)
{
    $field = '<textarea name="'.tep_output_string($name).'"';

    if (!empty($parameters)) {
        $field .= ' '.$parameters;
    }

    $field .= '>';

    if (($reinsert_value === true) && ((isset($_GET[$name]) && \is_string($_GET[$name])) || (isset($_POST[$name]) && \is_string($_POST[$name])))) {
        if (isset($_GET[$name]) && \is_string($_GET[$name])) {
            $field .= tep_output_string_protected(stripslashes($_GET[$name]));
        } elseif (isset($_POST[$name]) && \is_string($_POST[$name])) {
            $field .= tep_output_string_protected(stripslashes($_POST[$name]));
        }
    } elseif (!empty($text)) {
        $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
}

// Output a form hidden field
function tep_draw_hidden_field($name, $value = '', $parameters = '')
{
    $field = '<input type="hidden" name="'.tep_output_string($name).'"';

    if (!empty($value)) {
        $field .= ' value="'.tep_output_string($value).'"';
    } elseif ((isset($_GET[$name]) && \is_string($_GET[$name])) || (isset($_POST[$name]) && \is_string($_POST[$name]))) {
        if (isset($_GET[$name]) && \is_string($_GET[$name])) {
            $field .= ' value="'.tep_output_string(stripslashes($_GET[$name])).'"';
        } elseif (isset($_POST[$name]) && \is_string($_POST[$name])) {
            $field .= ' value="'.tep_output_string(stripslashes($_POST[$name])).'"';
        }
    }

    if (!empty($parameters)) {
        $field .= ' '.$parameters;
    }

    $field .= '>';

    return $field;
}

// Hide form elements
function tep_hide_session_id()
{
    global $session_started, $SID;

    $field = '';

    if (($session_started === true) && !empty($SID) && (SESSION_FORCE_COOKIE_USE === 'False')) {
        $field = tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }

    return $field;
}

// Output a form pull down menu
function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false)
{
    $field = '<select name="'.tep_output_string($name).'"';

    if (!empty($parameters)) {
        $field .= ' '.$parameters;
    }

    $field .= '>';

    if (empty($default) && ((isset($_GET[$name]) && \is_string($_GET[$name])) || (isset($_POST[$name]) && \is_string($_POST[$name])))) {
        if (isset($_GET[$name]) && \is_string($_GET[$name])) {
            $default = stripslashes($_GET[$name]);
        } elseif (isset($_POST[$name]) && \is_string($_POST[$name])) {
            $default = stripslashes($_POST[$name]);
        }
    }

    for ($i = 0, $n = \count($values); $i < $n; ++$i) {
        $field .= '<option value="'.tep_output_string($values[$i]['id']).'"';

        if ($default === $values[$i]['id']) {
            $field .= ' selected="selected"';
        }

        $field .= '>'.tep_output_string($values[$i]['text'], ['"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;']).'</option>';
    }

    $field .= '</select>';

    if ($required === true) {
        $field .= TEXT_FIELD_REQUIRED;
    }

    return $field;
}

// Creates a pull-down list of countries
function tep_get_country_list($name, $selected = '', $parameters = '')
{
    $countries_array = [['id' => '', 'text' => PULL_DOWN_DEFAULT]];
    $countries = tep_get_countries();

    for ($i = 0, $n = \count($countries); $i < $n; ++$i) {
        $countries_array[] = ['id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']];
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
}

// Output a Bootstrap Button
function tep_draw_button($title = null, $icon = null, $link = null, $priority = 'btn-primary', $params = null)
{
    $types = ['submit', 'button', 'reset'];

    if (!isset($params['type'])) {
        $params['type'] = 'submit';
    }

    if (!\in_array($params['type'], $types, true)) {
        $params['type'] = 'submit';
    }

    if (($params['type'] === 'submit') && isset($link)) {
        $params['type'] = 'button';
    }

    if (($params['type'] === 'button') && isset($link)) {
        $button = '<a class="btn '.tep_output_string($priority).'" href="'.$link.'"';
    } else {
        $button = '<button class="btn '.tep_output_string($priority).'" type="'.tep_output_string($params['type']).'"';
    }

    if (isset($params['params'])) {
        $button .= ' '.$params['params'];
    }

    $button .= '>';

    if (isset($icon)) {
        if (!isset($params['iconpos'])) {
            $params['iconpos'] = 'left';
        }

        if ($params['iconpos'] === 'left') {
            $button .= '<i class="ms-1 icon-'.$icon.'"></i>'.$title;
        } else {
            $button .= $title.'<i class="ms-1 icon-'.$icon.'"></i>';
        }
    } else {
        $button .= $title;
    }

    if (($params['type'] === 'button') && isset($link)) {
        $button .= '</a>';
    } else {
        $button .= '</button>';
    }

    return $button;
}

// //
// PureHTML Css generator
// nested fiter:
function css_compile($data)
{
    return preg_replace('/}}}}}}/', '}', preg_replace('/}}}}/', '}}', str_replace(': ', ':', str_replace('; }', '}', str_replace('} ', '}', preg_replace('/\s+/', ' ', preg_replace('/\t/', ' ', preg_replace('/\n/', ' ', preg_replace(':/\*.*\*/:', '', $data)))))))), 1);
}
function cssquery($max = 0, $min = 0, $template = '', $tag = '', $status = 1, $inline = 0)
{
    // nejprve jedeme max
    if ($max === 0 && $min === 0) {
        $min_max = 'min';
    } elseif ($max === 0 && $min > 0) {
        $min_max = 'min';
    } else {
        $min_max = 'max';
    }

    $data = '';
    $old = 0;
    $current = 0;
    $counter = 0;
    $css_query = tep_db_query('SELECT * from css WHERE max='.$max.' AND min='.$min." AND template='".$template."' AND status=1 AND inline=0 ORDER BY ".$min_max.', sort_order');

    while ($css = tep_db_fetch_array($css_query)) {
        /*
        //na zacatek
        if ($counter == 0){
            $old = $css[$min_max];
            if ($old > 0) {
            $data .= '}' . "\n" . '@media (' . $min_max . '-width: ' . $css[$min_max] . 'px){' . "\n"; //}
            }
        }
         */
        $current = $css[$min_max];

        if ($css[$min_max] === $old) {
            $data .= $css['name'].'{'.$css['value']."}\n";
        } else { // {
            //      $data .= 'xxx}' . "\n" . '@media (' . $min_max . '-width: ' . $css[$min_max] . 'px){' . $css['name'] . '{' . $css['value'] .'}' . "\n"; //}
            $data .= "\n@media (".$min_max.'-width: '.$css[$min_max].'px){'.$css['name'].'{'.$css['value']."}\n"; // }
        }

        $old = $current;
        ++$counter;
    }

    if ($max > 0 || $min > 0) {
        $data .= '}';
    }

    return $data;
}
function cssgenerator(): void
{
    $data = '';
    // 1. WHERE max > 0 AND min=0 AND template='' AND subtemplate='' AND inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT max AS init from css WHERE max > 0 AND min=0 AND template='' AND subtemplate='' AND inline=0 AND status=1 ORDER BY max");

    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery($cssmain['init']);
    }

    // remove first bracket:
    $data = preg_replace('/^}/', '', $data, 1);
    // css_compile
    $data = css_compile($data);

    // 2. default values
    $data .= css_compile(cssquery(0, 0, '', '', '', 1, 0));

    // 3. WHERE max = 0 AND min > 0 AND template='' AND subtemplate='' AND inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT DISTINCT min AS init from css WHERE max = 0 AND min > 0 AND template='' AND subtemplate='' AND inline=0 AND status=1 ORDER BY min");

    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery(0, $cssmain['init']);
    }

    $data = css_compile($data);
    file_put_contents(DIR_FS_CATALOG.'s.css.gz', gzencode($data, 9), 644);
    // working file:
    file_put_contents(DIR_FS_CATALOG.'s.css', $data, 644);
    // debug file
    $data = str_replace('{', "\n{", str_replace('}', "}\n", $data));
    file_put_contents(DIR_FS_CATALOG.'s_debug.css', $data, 644);
}

function cssgenerator_index_top(): void
{
    $data = '';
    // 1. WHERE max > 0 AND min=0 AND template='index_top' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT max AS init from css WHERE max > 0 AND min=0 AND template='index_top' AND  inline=0 AND status=1 ORDER BY max");

    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery($cssmain['init'], 0, 'index_top');
    }

    // remove first bracket:
    $data = preg_replace('/^}/', '', $data, 1);
    // css_compile
    $data = css_compile($data);

    // 2. default values
    $data .= css_compile(cssquery(0, 0, 'index_top', '', 1, 0));

    // 3. WHERE max = 0 AND min > 0 AND template='index_top' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT DISTINCT min AS init from css WHERE max = 0 AND min > 0 AND template='index_top' AND  inline=0 AND status=1 ORDER BY min");

    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery(0, $cssmain['init'], 'index_top');
    }

    $data = css_compile($data);
    file_put_contents(DIR_FS_CATALOG.'index_top.css.gz', gzencode($data, 9), 644);
    // working file:
    file_put_contents(DIR_FS_CATALOG.'index_top.css', $data, 644);
    // debug file
    $data = str_replace('{', "\n{", str_replace('}', "}\n", $data));
    file_put_contents(DIR_FS_CATALOG.'index_top_debug.css', $data, 644);
}
function cssgenerator_index_products(): void
{
    $data = '';
    // 1. WHERE max > 0 AND min=0 AND template='index_products' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT max AS init from css WHERE max > 0 AND min=0 AND template='index_products' AND  inline=0 AND status=1 ORDER BY max");

    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery($cssmain['init'], 0, 'index_products');
    }

    // remove first bracket:
    $data = preg_replace('/^}/', '', $data, 1);
    // css_compile
    $data = css_compile($data);

    // 2. default values
    $data .= css_compile(cssquery(0, 0, 'index_products', '', 1, 0));

    // 3. WHERE max = 0 AND min > 0 AND template='index_products' AND  inline=0 AND status=1
    $cssmain_query = tep_db_query("SELECT DISTINCT min AS init from css WHERE max = 0 AND min > 0 AND template='index_products' AND  inline=0 AND status=1 ORDER BY min");

    while ($cssmain = tep_db_fetch_array($cssmain_query)) {
        $data .= cssquery(0, $cssmain['init'], 'index_products');
    }

    $data = css_compile($data);
    file_put_contents(DIR_FS_CATALOG.'index_products.css.gz', gzencode($data, 9), 644);
    // working file:
    file_put_contents(DIR_FS_CATALOG.'index_products.css', $data, 644);
    // debug file
    $data = str_replace('{', "\n{", str_replace('}', "}\n", $data));
    file_put_contents(DIR_FS_CATALOG.'index_products_debug.css', $data, 644);
}
