<?php
/*
  $Id: banner_rotator.php v1.1.2 20110108 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

class cm_carousel_rotator {

    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_carousel_rotator() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));
      
      $this->title = MODULE_CAROUSEL_ROTATOR_TITLE;
      $this->description = MODULE_CAROUSEL_ROTATOR_DESCRIPTION;

      if (defined('MODULE_CAROUSEL_ROTATOR_STATUS')) {
        $this->sort_order = MODULE_CAROUSEL_ROTATOR_SORT_ORDER;
        $this->enabled = (MODULE_CAROUSEL_ROTATOR_STATUS == 'True');
      }
    }



    function execute() {
    
     global $PHP_SELF, $oscTemplate, $cPath;
      
      $content_width = (int)MODULE_CAROUSEL_ROTATOR_CONTENT_WIDTH;
      

      if ($PHP_SELF == 'index.php' && $cPath == '') {
        // Set the Javascript to go in the header
        $footer_scripts = '<script>' . '$(\'#carousel-example-generic.carousel\').carousel({ interval: ' . ( int ) MODULE_CAROUSEL_ROTATOR_HOLD_TIME . '})' . "\n" .'</script>';
  
        $oscTemplate->addBlock($footer_scripts, 'footer_scripts');


// Set the banner rotator code to display on the front page
        $banner_query_raw = "
                  select
                    banners_id,
                    banners_url,
                    banners_image,
                    banners_html_text
                  from
                    " . TABLE_BANNERS . "
                  where
                    banners_group = '" . MODULE_CAROUSEL_ROTATOR_GROUP . "'
                    and status
                  order by banners_id " . MODULE_CAROUSEL_ROTATOR_BANNER_ORDER . "
                  limit
                    " . MODULE_CAROUSEL_ROTATOR_MAX_DISPLAY;


        $banner_query = tep_db_query($banner_query_raw);
        
        if (tep_db_num_rows($banner_query) > 0) {
          $body_text = '<!-- Banner Rotator BOF -->' . "\n";
          $body_text .= '  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">' . "\n";

          $indicators = '<!-- Indicators -->
          <ol class="carousel-indicators">';
          $wrapper_slides = '<!-- Wrapper for slides -->' . "\n" .
          '<div class="carousel-inner">';

          $background = $this->createImage(544, 172, 118, 115, 115);

          $counter = 0;
          while ($banner = tep_db_fetch_array($banner_query)) {
            $indicators .= '  <li data-target="#carousel-example-generic" data-slide-to="' . $counter . '"' . ($counter == 0 ? 'class="active"' : '') . '></li>';

            $wrapper_slides .= '      <div class="item' . ($counter == 0 ? ' active' : '') . '">';
            if ($banner['banners_url'] != '') {
              $wrapper_slides .= '<a href="' . tep_href_link('redirect.php', 'action=banner&goto=' . $banner['banners_id']) . '">';
            }

              //$wrapper_slides .= tep_image(DIR_WS_IMAGES . $banner['banners_image'], $banner['banners_html_text']);


            if ($banner['banners_image'] !== '') {
              //$wrapper_slides .= tep_image(DIR_WS_IMAGES . $banner['banners_image'], $banner['banners_html_text']);
              $wrapper_slides .= tep_image('images/' . $banner['banners_image'], '', 1222, 300); //1800, 600 // 544, 172
              $wrapper_slides .= '<div class="carousel-caption"> </div>';
            } else {
              //$wrapper_slides .= tep_image(DIR_WS_IMAGES . 'pixel_silver.gif', 'alt', 544, 172 );
              $wrapper_slides .= '<img class="img-responsive" alt="544x172" src="' . $background . '" />';
              $wrapper_slides .= '<div class="carousel-caption">' . $banner['banners_html_text'] . '</div>';
            }

            if ($banner['banners_url'] != '') {
              $wrapper_slides .= '</a>';
            }

            $wrapper_slides .= ' </div>' . "\n";
            $counter++;
          }

          $indicators .= '</ol>';  // close indicator

          $wrapper_slides .= '</div>';  // wrapper close

          $controls = '  <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          </a>';

          // öszefuzés
          $body_text .= $indicators . $wrapper_slides . $controls;
 
          $body_text .= '  </div>' . "\n";
          $body_text .= '  <div class="clearfix"></div>' . "\n";
          $body_text .= '<!-- Banner Rotator EOF -->' . "\n";
          
          $carousel = $body_text;

        }
  

      ob_start();
      //include(DIR_WS_MODULES . 'content/' . $this->group . '/templates/tpl_cm_carousel.php');
      include('includes/modules/content/' . $this->group . '/templates/tpl_' . basename(__FILE__));
      $template = ob_get_clean();

      $oscTemplate->addContent($template, $this->group);
      
      
    }

}

 function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_CAROUSEL_ROTATOR_STATUS');
    }
                
                

                                                                                                                                                                                                                                                                                                                                                                      
    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CAROUSEL_ROTATOR_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CAROUSEL_ROTATOR_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '1', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Banner Rotator', 'MODULE_CAROUSEL_ROTATOR_STATUS', 'True', 'Do you want to show the banner rotator?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Hold Time', 'MODULE_CAROUSEL_ROTATOR_HOLD_TIME', '4000', 'The time each banner is shown. 1000 = 1 second', '6', '0', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Banner Order', 'MODULE_CAROUSEL_ROTATOR_BANNER_ORDER', 'Desc', 'Order that the Banner Rotator uses to show the banners.', '6', '0', 'tep_cfg_select_option(array(\'Asc\', \'Desc\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Banner Rotator Group', 'MODULE_CAROUSEL_ROTATOR_GROUP', 'rotator', 'Name of the banner group that the Banner Rotator uses to show the banners.', '6', '0', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Banner Rotator Max Banners', 'MODULE_CAROUSEL_ROTATOR_MAX_DISPLAY', '4', 'Maximum number of banners that the Banner Rotator will show', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array (
        'MODULE_CAROUSEL_ROTATOR_CONTENT_WIDTH',
        'MODULE_CAROUSEL_ROTATOR_STATUS',
        'MODULE_CAROUSEL_ROTATOR_SORT_ORDER',
        'MODULE_CAROUSEL_ROTATOR_HOLD_TIME',
        'MODULE_CAROUSEL_ROTATOR_BANNER_ORDER',
        'MODULE_CAROUSEL_ROTATOR_GROUP',
        'MODULE_CAROUSEL_ROTATOR_MAX_DISPLAY'
      );
    }
    
    
      function createImage($width = 900, $height = 500, $red = 255, $green = 0, $blue = 0) {
      $im = imagecreatetruecolor($width, $height);

      // sets background to red
      $color = imagecolorallocate($im, (int)$red, (int)$green, (int)$blue);
      imagefill($im, 0, 0, $color);

      //header('Content-type: image/png');
      ob_start();
      imagepng($im);
      $contents =  ob_get_contents();
      ob_end_clean();
      imagedestroy($im);

      $imgData = base64_encode($contents);
      $src = 'data: image/png;base64,'.$imgData;
      return $src;
    }







  
  
  } 
  

?>

