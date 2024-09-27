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

/**
 * lastRSS
 * Simple yet powerfull PHP class to parse RSS files.
 */
class rss
{
    // -------------------------------------------------------------------
    // Public properties
    // -------------------------------------------------------------------
    public $default_cp = 'UTF-8';
    public $CDATA = 'strip';
    public $cp = '';
    public $items_limit = 0;
    public $stripHTML = false;
    public $date_format = '';

    // -------------------------------------------------------------------
    // Private variables
    // -------------------------------------------------------------------
    public $channeltags = ['title', 'link', 'description', 'language', 'copyright', 'managingEditor', 'webMaster', 'lastBuildDate', 'rating', 'docs'];
    public $itemtags = ['title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'pubDate', 'source'];
    public $imagetags = ['title', 'url', 'link', 'width', 'height'];
    public $textinputtags = ['title', 'description', 'name', 'link'];

    // -------------------------------------------------------------------
    // Parse RSS file and returns associative array.
    // -------------------------------------------------------------------
    public function Get($rss_url)
    {
        // If CACHE ENABLED
        if ($this->cache_dir !== '') {
            $cache_file = $this->cache_dir.'/rss_'.md5($rss_url).'.cache';
            $timedif = @(time() - filemtime($cache_file));

            if ($timedif < $this->cache_time) {
                // cached file is fresh enough, return cached array
                $result = unserialize(implode('', file($cache_file)));

                // set 'cached' to 1 only if cached file is correct
                if ($result) {
                    $result['cached'] = 1;
                }
            } else {
                // cached file is too old, create new
                $result = $this->Parse($rss_url);
                $serialized = serialize($result);

                if ($f = @fopen($cache_file, 'wb')) {
                    fwrite($f, $serialized, \strlen($serialized));
                    fclose($f);
                }

                if ($result) {
                    $result['cached'] = 0;
                }
            }
        }
        // If CACHE DISABLED >> load and parse the file directly
        else {
            $result = $this->Parse($rss_url);

            if ($result) {
                $result['cached'] = 0;
            }
        }

        // return result
        return $result;
    }

    // -------------------------------------------------------------------
    // Modification of preg_match(); return trimed field with index 1
    // from 'classic' preg_match() array output
    // -------------------------------------------------------------------
    public function my_preg_match($pattern, $subject)
    {
        // start regullar expression
        preg_match($pattern, $subject, $out);

        // if there is some result... process it and return it
        if (isset($out[1])) {
            // Process CDATA (if present)
            if ($this->CDATA === 'content') { // Get CDATA content (without CDATA tag)
                $out[1] = strtr($out[1], ['<![CDATA[' => '', ']]>' => '']);
            } elseif ($this->CDATA === 'strip') { // Strip CDATA
                $out[1] = strtr($out[1], ['<![CDATA[' => '', ']]>' => '']);
            }

            // If code page is set convert character encoding to required
            if ($this->cp !== '') {
                // $out[1] = $this->MyConvertEncoding($this->rsscp, $this->cp, $out[1]);
                $out[1] = iconv($this->rsscp, $this->cp.'//TRANSLIT', $out[1]);
            }

            // Return result
            return trim($out[1]);
        }

        // if there is NO result, return empty string
        return '';
    }

    // -------------------------------------------------------------------
    // Replace HTML entities &something; by real characters
    // -------------------------------------------------------------------
    public function unhtmlentities($string)
    {
        // Get HTML entities table
        $trans_tbl = get_html_translation_table(\HTML_ENTITIES, \ENT_QUOTES);
        // Flip keys<==>values
        $trans_tbl = array_flip($trans_tbl);
        // Add support for &apos; entity (missing in HTML_ENTITIES)
        $trans_tbl += ['&apos;' => "'"];

        // Replace entities by values
        return strtr($string, $trans_tbl);
    }

    // -------------------------------------------------------------------
    // Parse() is private method used by Get() to load and parse RSS file.
    // Don't use Parse() in your scripts - use Get($rss_file) instead.
    // -------------------------------------------------------------------
    public function Parse($rss_url)
    {
        $rss_content = '';

        // Open and load RSS file
        if (\function_exists('curl_init')) {
            $curl = curl_init($rss_url);
            curl_setopt($curl, \CURLOPT_HEADER, 0);
            curl_setopt($curl, \CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, \CURLOPT_FRESH_CONNECT, 1);

            $rss_content = curl_exec($curl);

            curl_close($curl);
        } else {
            if ($f = @fopen($rss_url, 'rb')) {
                while (!feof($f)) {
                    $rss_content .= fgets($f, 4096);
                }

                fclose($f);
            }
        }

        if (!empty($rss_content)) {
            // Parse document encoding
            $result['encoding'] = $this->my_preg_match("'encoding=[\\'\"](.*?)[\\'\"]'si", $rss_content);

            // if document codepage is specified, use it
            if ($result['encoding'] !== '') {
                $this->rsscp = $result['encoding'];
            } // This is used in my_preg_match()
            // otherwise use the default codepage
            else {
                $this->rsscp = $this->default_cp;
            }

 // This is used in my_preg_match()

            // Parse CHANNEL info
            preg_match("'<channel.*?>(.*?)</channel>'si", $rss_content, $out_channel);

            foreach ($this->channeltags as $channeltag) {
                $temp = $this->my_preg_match("'<{$channeltag}.*?>(.*?)</{$channeltag}>'si", $out_channel[1]);

                if ($temp !== '') {
                    $result[$channeltag] = $temp;
                } // Set only if not empty
            }

            // If date_format is specified and lastBuildDate is valid
            if ($this->date_format !== '' && ($timestamp = strtotime($result['lastBuildDate'])) !== -1) {
                // convert lastBuildDate to specified date format
                $result['lastBuildDate'] = date($this->date_format, $timestamp);
            }

            // Parse TEXTINPUT info
            preg_match("'<textinput(|[^>]*[^/])>(.*?)</textinput>'si", $rss_content, $out_textinfo);

            // This a little strange regexp means:
            // Look for tag <textinput> with or without any attributes, but skip truncated version <textinput /> (it's not beggining tag)
            if (isset($out_textinfo[2])) {
                foreach ($this->textinputtags as $textinputtag) {
                    $temp = $this->my_preg_match("'<{$textinputtag}.*?>(.*?)</{$textinputtag}>'si", $out_textinfo[2]);

                    if ($temp !== '') {
                        $result['textinput_'.$textinputtag] = $temp;
                    } // Set only if not empty
                }
            }

            // Parse IMAGE info
            preg_match("'<image.*?>(.*?)</image>'si", $rss_content, $out_imageinfo);

            if (isset($out_imageinfo[1])) {
                foreach ($this->imagetags as $imagetag) {
                    $temp = $this->my_preg_match("'<{$imagetag}.*?>(.*?)</{$imagetag}>'si", $out_imageinfo[1]);

                    if ($temp !== '') {
                        $result['image_'.$imagetag] = $temp;
                    } // Set only if not empty
                }
            }

            // Parse ITEMS
            preg_match_all("'<item(| .*?)>(.*?)</item>'si", $rss_content, $items);
            $rss_items = $items[2];
            $i = 0;
            $result['items'] = []; // create array even if there are no items

            foreach ($rss_items as $rss_item) {
                // If number of items is lower then limit: Parse one item
                if ($i < $this->items_limit || $this->items_limit === 0) {
                    foreach ($this->itemtags as $itemtag) {
                        $temp = $this->my_preg_match("'<{$itemtag}.*?>(.*?)</{$itemtag}>'si", $rss_item);

                        if ($temp !== '') {
                            $result['items'][$i][$itemtag] = $temp;
                        } // Set only if not empty
                    }

                    // Strip HTML tags and other bullshit from DESCRIPTION
                    if ($this->stripHTML && $result['items'][$i]['description']) {
                        $result['items'][$i]['description'] = strip_tags($this->unhtmlentities(strip_tags($result['items'][$i]['description'])));
                    }

                    // Strip HTML tags and other bullshit from TITLE
                    if ($this->stripHTML && $result['items'][$i]['title']) {
                        $result['items'][$i]['title'] = strip_tags($this->unhtmlentities(strip_tags($result['items'][$i]['title'])));
                    }

                    // If date_format is specified and pubDate is valid
                    if ($this->date_format !== '' && ($timestamp = strtotime($result['items'][$i]['pubDate'])) !== -1) {
                        // convert pubDate to specified date format
                        $result['items'][$i]['pubDate'] = date($this->date_format, $timestamp);
                    }

                    // Item counter
                    ++$i;
                }
            }

            $result['items_count'] = $i;

            return $result;
        }

        // Error in opening return False

        return false;
    }
}
