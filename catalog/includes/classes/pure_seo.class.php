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
class pure_seo
{
    public $parA = [];
    public $langId = 0;
    public $langCode = '';
    public $suspend = false;

    public function href_link($page, $params, $connection = 'NONSSL', $add_session_id = true)
    {
        global $languages_id, $session_started, $SID;

        // trocha puv. plesnive omacky pro kompatibilitu:
        if ($connection === 'NONSSL') {
            $server = HTTP_SERVER;
        } elseif ($connection === 'SSL') {
            if (ENABLE_SSL === true) {
                $server = HTTPS_SERVER;
            } else {
                $server = HTTP_SERVER;
            }
        } else {
            exit('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><strong>Error!</strong></font><br /><br /><strong>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</strong><br /><br />');
        }

        if (($add_session_id === true) && ($session_started === true) && (SESSION_FORCE_COOKIE_USE === 'False')) {
            if (tep_not_null($SID)) {
                $_sid = $SID;
            } elseif ((($request_type === 'NONSSL') && ($connection === 'SSL') && (ENABLE_SSL === true)) || (($request_type === 'SSL') && ($connection === 'NONSSL'))) {
                if (HTTP_COOKIE_DOMAIN !== HTTPS_COOKIE_DOMAIN) {
                    $_sid = tep_session_name().'='.tep_session_id();
                }
            }
        }

        if (isset($_sid)) {
            $_sid = tep_output_string($_sid);
        }

        // ..a dal uz pekne po nasem:
        if (isset($_SESSION['noseo'])) {
            $this->suspend = $_SESSION['noseo'];
        } else {
            $this->suspend = false; // podpora vypnuti tohohle cirkusu..
        }

        $this->parA = []; // assoc.pole parametru ke zpracovani

        if (\is_array($pars = explode('&', str_replace('?', '', $params)))) {
            foreach ($pars as $par) {
                $par = explode('=', $par);

                if (\count($par) > 1) {
                    $this->parA[$par[0]] = $par[1];
                }
            }
        }

        $pages = ['index.php', 'product_info.php', 'index_authors.php', 'index_manufacturers.php']; // seznam rewr. cilu

        if ((!\in_array($page, $pages, true)) || $this->suspend) { // na ost. se sere - stejne tak pri vynuc.potlaceni
            $add = '';

            if (\count($this->parA) > 0) {
                foreach ($this->parA as $pK => $pV) {
                    if (!empty($pV)) {
                        $add .= (($add ? '&' : '?').$pK.'='.$pV);
                    }
                }
            }

            if (isset($_sid)) {
                $add .= ($add ? '&' : '?').$_sid; // sestavit NErewr.link, pridat ev.sid
            }

            return $server.'/'.$page.$add; // a vratit ho.
        }

        // jinak norm.prubeh:
        $catSeoPath = '';
        $prodSeoName = '';

        if (isset($this->parA['language_id'])) {
            if (empty($this->langId = $this->parA['language_id'])) {
                $this->langId = $languages_id;
            }
        } else {
            $this->langId = $languages_id;
        }

        $lQ = tep_db_query('SELECT * FROM languages WHERE languages_id = '.$this->langId);

        if ($lQ) {
            if (tep_db_num_rows($lQ) > 0) {
                $this->langCode = tep_db_fetch_array($lQ)['code'];
            }
        }

        if ($page === 'index_authors.php') {
            $catSeoPath = 'autori/';
        } elseif ($page === 'index_manufacturers.php') {
            $catSeoPath = 'vydavatele/';
        } else { // normalne
            if (isset($this->parA['cPath'])) { // prvne zkusit tohle..
                if (!empty($cPath = $this->parA['cPath'])) {
                    $catSeoPath = $this->getCatSeoPath($cPath);
                }
            }

            if (isset($this->parA['manufacturers_id'])) { // ..pak onohle..
                if (!empty($manufId = $this->parA['manufacturers_id'])) {
                    $catSeoPath = $this->getManufSeoName($manufId); // premazat ev.puv.!!
                }
            }

            if (isset($this->parA['authors_id'])) { // a dtto s autorem
                if (!empty($authorsId = $this->parA['authors_id'])) {
                    $catSeoPath = $this->getAuthorSeoName($authorsId); // prerazi predch.vyskyty vseho, pokud je
                }
            }

            if (isset($this->parA['products_id'])) {
                if (!empty($prodId = $this->parA['products_id'])) {
                    $prodId = rawurldecode($prodId); // prevence dobytkaren odjinud

                    if (($fuj = strpos($prodId, '{')) !== false) {
                        $prodId = substr($prodId, 0, $fuj); // ev.doparsovani
                    }

                    if (!is_numeric($prodId)) {
                        return ''; // TODO asi neco steknout
                    }

                    $prodSeoName = $this->getProdSeoName($prodId);

                    if (empty($catSeoPath)) { // NEPRIPUSTNE!!! Kdyz nebylo nic z predch.parametru pro kategorii, dosadit kanon
                        $cQ = tep_db_query('SELECT categories_id FROM products_to_categories WHERE canonical > 0 AND products_id = '.$prodId);

                        // ..a kdyz neni, vzit co je:
                        if (tep_db_num_rows($cQ) < 1) {
                            $cQ = tep_db_query('SELECT categories_id FROM products_to_categories WHERE products_id = '.$prodId.' LIMIT 1');
                        }

                        if (tep_db_num_rows($cQ) > 0) {
                            $parId = tep_db_fetch_array($cQ)['categories_id'];
                        } else {
                            $parId = 0;
                        }

                        // sestavit cPath:
                        $cPath = $parId; // od posledni..

                        while ($parId > 0) { // ..doskakat nahoru k prvni
                            $cQ = tep_db_query('SELECT parent_id FROM categories WHERE categories_id = '.$parId);

                            if ($parId = tep_db_fetch_array($cQ)['parent_id']) {
                                $cPath = ($parId.($cPath ? '_' : '').$cPath);
                            }
                        }

                        $catSeoPath = $this->getCatSeoPath($cPath);
                    }
                }
            }
        }

        // velka slava - vsechno zkompletovat a vysypat
        return $server.'/'.$catSeoPath.$prodSeoName;
        // orig        return $server . '/' . ($this->langCode ? ($this->langCode . '/') : '') . $catSeoPath . $prodSeoName;
    } // END function href_link
    // --------------------------------------------------------------------------------------

    private function getCatSeoPath($cPath)
    {
        // vraci rewr.cestu do kategorie
        $catSeoPath = '';

        if (!\defined('WEB_CANON_TYPE')) {
            \define('WEB_CANON_TYPE', 'categ'); // 'categ' || 'author'
        }

        // --------- TOHLE JE PRO AUTORSKO-KANONICKOU VERZI!!! -------------
        if (WEB_CANON_TYPE === 'author') {
            if (isset($this->parA['products_id'])) {
                if (!empty($prodId = $this->parA['products_id'])) {
                    $prodId = rawurldecode($prodId); // prevence dobytkaren odjinud

                    if (($fuj = strpos($prodId, '{')) !== false) {
                        $prodId = substr($prodId, 0, $fuj); // ev.doparsovani
                    }

                    if (!is_numeric($prodId)) {
                        return ''; // TODO asi neco steknout
                    }

                    $aQ = tep_db_query('SELECT authors_id FROM products WHERE products_id = '.$prodId); // bez dalsich cavyku vratit cestu do autora

                    if (tep_db_num_rows($aQ) > 0) {
                        return $this->getAuthorSeoName(tep_db_fetch_array($aQ)['authors_id']);
                    }
                }
            }
        }

        // ----------------------------------------

        if (\is_array($path = explode('_', $cPath))) {
            foreach ($path as $cID) { // poslepovat nazvy:
                $cQ = tep_db_query('SELECT categories_name FROM categories_description WHERE language_id = '.$this->langId.' AND categories_id = '.$cID);

                if (tep_db_num_rows($cQ) > 0) {
                    $append = $this->seoStringRewrite(tep_db_fetch_array($cQ)['categories_name']);

                    if (!$append) {
                        $append = 'bez-nazvu-'.$cID;
                    }

                    $catSeoPath .= $append.'/';
                } else {
                    $catSeoPath .= 'bez-nazvu-'.$cID.'/';
                }
            }
        }

        return $catSeoPath;
    } // END function getCatSeoPath

    private function getProdSeoName($prodId)
    {
        global $db_link;
        // vraci rewr.nazev produktu
        $seoName = '';

        if (!is_numeric($prodId)) {
            return 'bez-nazvu/';
        }

        $pQ = tep_db_query('SELECT products_name FROM products_description WHERE language_id = '.$this->langId.' AND products_id = '.$prodId);

        if (tep_db_num_rows($pQ) > 0) {
            $seoName = (($rawName = tep_db_fetch_array($pQ)['products_name']) ? $this->seoStringRewrite($rawName) : '');

            if (!$seoName) {
                return 'bez-nazvu-'.$prodId.'/';
            }

            $uQ = tep_db_query("SELECT products_id FROM products_description WHERE products_name = '".mysqli_real_escape_string($db_link, $rawName)."' AND language_id = ".$this->langId);

            if (tep_db_num_rows($uQ) > 1) {
                $seoName .= ('-'.$prodId); // tohle existuje vickrat - uniqizovat
            }
        } else {
            $seoName = 'bez-nazvu-'.$prodId;
        }

        return $seoName.'/';
    } // END function getProdSeoName

    private function getManufSeoName($manufId)
    {
        // vraci rewr.jmeno vyrobce
        $seoName = '';
        $mQ = tep_db_query('SELECT manufacturers_name FROM manufacturers WHERE manufacturers_id = '.$manufId);

        if (tep_db_num_rows($mQ) > 0) {
            $seoName = $this->seoStringRewrite(tep_db_fetch_array($mQ)['manufacturers_name']);
        }

        return ($seoName ?: ('bez-nakladatele-'.$manufId)).'/';
    } // END function getManufSeoName

    private function getAuthorSeoName($authorsId)
    {
        // vraci rewr.jmeno autora
        $seoName = '';
        $mQ = tep_db_query('SELECT authors_name FROM authors WHERE authors_id = '.$authorsId);

        if (tep_db_num_rows($mQ) > 0) {
            $seoName = (($rawName = tep_db_fetch_array($mQ)['authors_name']) ? $this->seoStringRewrite($rawName) : '');
        }

        return ($seoName ?: 'bez-autora').'/';
    } // END function getAuthorSeoName

    private function seoStringRewrite($str)
    {
        // komplet prepracovani surovin do fin.podoby
        $ret = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $str));
        $ret = preg_replace('/[^a-z0-9]/', '-', $ret);
        $ret = preg_replace('/\-{2,}/', '-', $ret); // omezit vice pomlcek za sebou na 1

        return preg_replace(['/^(\-{1})/', '/(\-{1})$/'], '', $ret); // vyhodit ev.pomlcky na zac. a konci
    }
} // END class
