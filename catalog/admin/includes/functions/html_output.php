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

// //
// The HTML href link wrapper function
function tep_href_link($page = '', $parameters = '', $connection = 'SSL', $add_session_id = true)
{
    global $request_type, $SID;

    $page = tep_output_string($page);

    if ($page === '') {
        exit('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><strong>Error!</strong></font><br /><br /><strong>Unable to determine the page link!<br /><br />Function used:<br /><br />tep_href_link(\''.$page.'\', \''.$parameters.'\', \''.$connection.'\')</strong>');
    }

    if ($connection === 'NONSSL') {
        $link = HTTP_SERVER.DIR_WS_ADMIN;
    } elseif ($connection === 'SSL') {
        if (ENABLE_SSL === true) {
            $link = HTTPS_SERVER.DIR_WS_HTTPS_ADMIN;
        } else {
            $link = HTTP_SERVER.DIR_WS_ADMIN;
        }
    } else {
        exit('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><strong>Error!</strong></font><br /><br /><strong>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL<br /><br />Function used:<br /><br />tep_href_link(\''.$page.'\', \''.$parameters.'\', \''.$connection.'\')</strong>');
    }

    if (!empty($parameters)) {
        $link .= $page.'?'.tep_output_string($parameters);
        $separator = '&';
    } else {
        $link .= $page;
        $separator = '?';
    }

    while ((substr($link, -1) === '&') || (substr($link, -1) === '?')) {
        $link = substr($link, 0, -1);
    }

    // Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if (($add_session_id === true) && (SESSION_FORCE_COOKIE_USE === 'False')) {
        if (!empty($SID)) {
            $_sid = $SID;
        } elseif ((($request_type === 'NONSSL') && ($connection === 'SSL') && (ENABLE_SSL === true)) || (($request_type === 'SSL') && ($connection === 'NONSSL'))) {
            if (HTTP_COOKIE_DOMAIN !== HTTPS_COOKIE_DOMAIN) {
                $_sid = tep_session_name().'='.tep_session_id();
            }
        }
    }

    if (isset($_sid)) {
        $link .= $separator.tep_output_string($_sid);
    }

    while (strstr($link, '&&')) {
        $link = str_replace('&&', '&', $link);
    }

    return $link;
}

function tep_catalog_href_link($page = '', $parameters = '', $connection = 'SSL')
{
    if ($connection === 'NONSSL') {
        $link = HTTP_CATALOG_SERVER.DIR_WS_CATALOG;
    } elseif ($connection === 'SSL') {
        if (ENABLE_SSL_CATALOG === 'true') {
            $link = HTTPS_CATALOG_SERVER.(\defined('DIR_WS_HTTPS_CATALOG') ? DIR_WS_HTTPS_CATALOG : DIR_WS_CATALOG);
        } else {
            $link = HTTP_CATALOG_SERVER.DIR_WS_CATALOG;
        }
    } else {
        exit('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><strong>Error!</strong></font><br /><br /><strong>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL<br /><br />Function used:<br /><br />tep_href_link(\''.$page.'\', \''.$parameters.'\', \''.$connection.'\')</strong>');
    }

    if ($parameters === '') {
        $link .= $page;
    } else {
        $link .= $page.'?'.$parameters;
    }

    while ((substr($link, -1) === '&') || (substr($link, -1) === '?')) {
        $link = substr($link, 0, -1);
    }

    return $link;
}

// //
// The HTML image wrapper function
function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '')
{
    $image = '<img src="'.tep_output_string($src).'" border="0" alt="'.tep_output_string($alt).'"';

    if (!empty($alt)) {
        $image .= ' title="'.tep_output_string($alt).'"';
    }

    if (!empty($width)) {
        $image .= ' width="'.tep_output_string($width).'"';
    }

    if (!empty($height)) {
        $image .= ' height="'.tep_output_string($height).'"';
    }

    if (!empty($parameters)) {
        $image .= ' '.$parameters;
    }

    $image .= ' />';

    return $image;
}

// //
// The HTML form submit button wrapper function
// Outputs a button in the selected language
function tep_image_submit($image, $alt = '', $parameters = '')
{
    global $language;

    $image_submit = '<input type="image" src="'.tep_output_string('includes/languages/'.$language.'/images/buttons/'.$image).'" border="0" alt="'.tep_output_string($alt).'"';

    if (!empty($alt)) {
        $image_submit .= ' title=" '.tep_output_string($alt).' "';
    }

    if (!empty($parameters)) {
        $image_submit .= ' '.$parameters;
    }

    $image_submit .= ' />';

    return $image_submit;
}

// //
// Draw a 1 pixel black line
function tep_black_line()
{
    return tep_image('images/pixel_black.gif', '', '100%', '1');
}

// //
// Output a separator either through whitespace, or with an image
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1')
{
    return tep_image('images/'.$image, '', $width, $height);
}

// //
// Output a function button in the selected language
function tep_image_button($image, $alt = '', $params = '')
{
    global $language;

    return tep_image('includes/languages/'.$language.'/images/buttons/'.$image, $alt, '', '', $params);
}

// //
// javascript to dynamically update the states/provinces list when the country is changed
// TABLES: zones
function tep_js_zone_list($country, $form, $field)
{
    $countries_query = tep_db_query('select distinct zone_country_id from zones order by zone_country_id');
    $num_country = 1;
    $output_string = '';

    while ($countries = tep_db_fetch_array($countries_query)) {
        if ($num_country === 1) {
            $output_string .= '  if ('.$country.' == "'.$countries['zone_country_id'].'") {'."\n";
        } else {
            $output_string .= '  } else if ('.$country.' == "'.$countries['zone_country_id'].'") {'."\n";
        }

        $states_query = tep_db_query("select zone_name, zone_id from zones where zone_country_id = '".(int) $countries['zone_country_id']."' order by zone_name");

        $num_state = 1;

        while ($states = tep_db_fetch_array($states_query)) {
            if ($num_state === '1') {
                $output_string .= '    '.$form.'.'.$field.'.options[0] = new Option("'.PLEASE_SELECT.'", "");'."\n";
            }

            $output_string .= '    '.$form.'.'.$field.'.options['.$num_state.'] = new Option("'.$states['zone_name'].'", "'.$states['zone_id'].'");'."\n";
            ++$num_state;
        }

        ++$num_country;
    }

    $output_string .= "  } else {\n".
                      '    '.$form.'.'.$field.'.options[0] = new Option("'.TYPE_BELOW.'", "");'."\n".
                      "  }\n";

    return $output_string;
}

// //
// Output a form
function tep_draw_form($name, $action, $parameters = '', $method = 'post', $params = '')
{
    $form = '<form name="'.tep_output_string($name).'" action="';

    if (!empty($parameters)) {
        $form .= tep_href_link($action, $parameters);
    } else {
        $form .= tep_href_link($action);
    }

    $form .= '" method="'.tep_output_string($method).'"';

    if (!empty($params)) {
        $form .= ' '.$params;
    }

    $form .= '>';

    return $form;
}

// //
// Output a form input field
function tep_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true)
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

    $field .= ' />';

    if ($required === true) {
        $field .= TEXT_FIELD_REQUIRED;
    }

    return $field;
}

// //
// Output a form password field
function tep_draw_password_field($name, $value = '', $required = false)
{
    return tep_draw_input_field($name, $value, 'maxlength="40"', $required, 'password', false);
}

// //
// Output a form filefield
function tep_draw_file_field($name, $required = false)
{
    return tep_draw_input_field($name, '', '', $required, 'file');
}

// //
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
function tep_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '')
{
    $selection = '<input type="'.tep_output_string($type).'" name="'.tep_output_string($name).'"';

    if (!empty($value)) {
        $selection .= ' value="'.tep_output_string($value).'"';
    }

    if (($checked === true) || (isset($_GET[$name]) && \is_string($_GET[$name]) && (($_GET[$name] === 'on') || (stripslashes($_GET[$name]) === $value))) || (isset($_POST[$name]) && \is_string($_POST[$name]) && (($_POST[$name] === 'on') || (stripslashes($_POST[$name]) === $value))) || (!empty($compare) && ($value === $compare))) {
        $selection .= ' checked="checked"';
    }

    $selection .= ' />';

    return $selection;
}

// //
// Output a form checkbox field
function tep_draw_checkbox_field($name, $value = '', $checked = false, $compare = '')
{
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $compare);
}

// //
// Output a form radio field
function tep_draw_radio_field($name, $value = '', $checked = false, $compare = '')
{
    return tep_draw_selection_field($name, 'radio', $value, $checked, $compare);
}

// //
// Output a form textarea field
// The $wrap parameter is no longer used in the core xhtml template
function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true)
{
    $field = '<textarea name="'.tep_output_string($name).'" cols="'.tep_output_string($width).'" rows="'.tep_output_string($height).'"';

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

// //
// output Summernote specialID textarea
// The $wrap parameter is no longer used in the core xhtml template
function tep_draw_textarea_summernote($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true)
{
    $field = '<textarea id="summernote" name="'.tep_output_string($name).'" cols="'.tep_output_string($width).'" rows="'.tep_output_string($height).'"';

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


// //
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

    $field .= ' />';

    return $field;
}

// //
// Hide form elements
function tep_hide_session_id()
{
    $string = '';

    if (\defined('SID') && !empty(SID)) {
        $string = tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }

    return $string;
}

// //
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

// //
// Output a jQuery UI Button
function tep_draw_button($title = null, $icon = null, $link = null, $priority = null, $params = null)
{
    static $button_counter = 1;

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

    if (!isset($priority)) {
        $priority = 'secondary';
    }

    $button = '<span class="tdbLink">';

    if (($params['type'] === 'button') && isset($link)) {
        $button .= '<a id="tdb'.$button_counter.'" href="'.$link.'"';

        if (isset($params['newwindow'])) {
            $button .= ' target="_blank"';
        }
    } else {
        $button .= '<button id="tdb'.$button_counter.'" type="'.tep_output_string($params['type']).'"';
    }

    if (isset($params['params'])) {
        $button .= ' '.$params['params'];
    }

    $button .= '>'.$title;

    if (($params['type'] === 'button') && isset($link)) {
        $button .= '</a>';
    } else {
        $button .= '</button>';
    }

    $button .= '</span><script>$("#tdb'.$button_counter.'").button(';

    $args = [];

    if (isset($icon)) {
        if (!isset($params['iconpos'])) {
            $params['iconpos'] = 'left';
        }

        if ($params['iconpos'] === 'left') {
            $args[] = 'icons:{primary:"ui-icon-'.$icon.'"}';
        } else {
            $args[] = 'icons:{secondary:"ui-icon-'.$icon.'"}';
        }
    }

    if (empty($title)) {
        $args[] = 'text:false';
    }

    if (!empty($args)) {
        $button .= '{'.implode(',', $args).'}';
    }

    $button .= ').addClass("ui-priority-'.$priority.'").parent().removeClass("tdbLink");</script>';

    ++$button_counter;

    return $button;
}
function fix_editor_output($txt){
    return str_replace(' class=""', '', $txt);
}