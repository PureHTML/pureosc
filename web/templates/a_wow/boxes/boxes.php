<?php
/*
  $Id: boxes.php,v 1.33 2003/06/09 22:22:50 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  class tableBox {
    var $table_parameters = '';
    var $table_row_parameters = '';
    var $table_data_parameters = '';

// class constructor
    function tableBox($contents, $direct_output = false) {
      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= $contents[$i]['form'] . "\n";

        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $n2=sizeof($contents[$i]); $x<$n2; $x++) {
            if (isset($contents[$i][$x]['text']) && tep_not_null($contents[$i][$x]['text'])) {
              $tableBox_string .= '<div ';
              if (isset($contents[$i][$x]['params']) && tep_not_null($contents[$i][$x]['params'])) {
                $tableBox_string .= $contents[$i][$x]['params'];
              } elseif (tep_not_null($this->table_data_parameters)) {
                $tableBox_string .= $this->table_data_parameters;
              }
              $tableBox_string .= '>';
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              $tableBox_string .= $contents[$i][$x]['text'];
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
              $tableBox_string .= '</div> ' . "\n";
            }
          }
        } else {
          $tableBox_string .= '<div class="pippino"><div class="InfoBoxContenent2MABox""';
                               
          if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) {
            $tableBox_string .= $contents[$i]['params'];
          } elseif (tep_not_null($this->table_data_parameters)) {
            $tableBox_string .= $this->table_data_parameters;
          }
          $tableBox_string .= '><br />' . $contents[$i]['text'] . '</div><div class="Clear"><br /></div></div><br />' . "\n";
        }

        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= '</form>' . "\n";
      }

      if ($direct_output == true) echo $tableBox_string;

      return $tableBox_string;
    }
  }

  class infoBox extends tableBox {
    function infoBox($contents) {
      $info_box_contents = array();
      $info_box_contents[] = array('text' => $this->infoBoxContents($contents));
      $this->table_parameters = '';
      $this->tableBox($info_box_contents, true);
    }

    function infoBoxContents($contents) {
      $this->table_parameters = '';
      $info_box_contents = array();

      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        $info_box_contents[] = array(array('form' => (isset($contents[$i]['form']) ? $contents[$i]['form'] : ''),
                                           'text' => (isset($contents[$i]['text']) ? $contents[$i]['text'] : '')));
      }

      return $this->tableBox($info_box_contents);
    }
  }

  class infoBoxHeading extends tableBox {
    function infoBoxHeading($contents, $left_corner = true, $right_corner = true, $right_arrow = false) {

      if ($right_arrow == true) {
        $right_arrow = '<a class="BoxesInfoBoxHeadingCenterBoxRight" title="Box_grafic_Details" href="' . $right_arrow . '">' . '&nbsp;&raquo;&nbsp;' . '</a>';
      }

      $info_box_contents = array();
      $info_box_contents[] = array(array('text' => '<div class="fedora-corner-tr">&nbsp;</div>' 
                                                   . '<div class="fedora-corner-tl">&nbsp;</div>'
                                                   . '<div class="BoxesInfoBoxHeadingCenterBoxTitle">' 
                                                   . $right_arrow . $contents[0]['text'] . '</div>'));

      $this->tableBox($info_box_contents, true);
    }
  }

  class contentBox extends tableBox {
    function contentBox($contents) {
      $info_box_contents = array();
      $info_box_contents[] = array('text' => $this->contentBoxContents($contents));
      $this->table_parameters = '';
      $this->tableBox($info_box_contents, true);
    }

    function contentBoxContents($contents) {
      $this->table_parameters = '';
      return $this->tableBox($contents);
    }
  }

  class contentBoxHeading extends tableBox {
    function contentBoxHeading($contents) {

      $info_box_contents = array();
      $info_box_contents[] = array(array('text' => '<div class="fedora-corner-tr">&nbsp;</div>' 
                                                   . '<div class="fedora-corner-tl">&nbsp;</div>'
                                                   . '<div class="BoxesInfoBoxHeadingCenterBoxTitle">' 
                                                   . $contents[0]['text'] . '</div>'));

      $this->tableBox($info_box_contents, true);
    }
  }

  class errorBox extends tableBox {
    function errorBox($contents) {
      $this->table_data_parameters = 'class="BoxesErrorBox"';
      $this->tableBox($contents, true);
    }
  }

  class productListingBox extends tableBox {
    function productListingBox($contents) {
      $this->table_parameters = 'class="BoxesProductListing"';
      $this->tableBox($contents, true);
    }
  }
?>
