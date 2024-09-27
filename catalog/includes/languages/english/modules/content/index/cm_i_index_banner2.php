<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
  Updated by JcMagpie 24-03-2020 V1.0
 */
?>

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lobster" />
<style>

@media (min-width: 360px) {
    #JcM-carousel-banner { font-size: 1rem; }
}
@media (min-width: 768px) {
    #JcM-carousel-banner { font-size: 3rem; }
}
@media (min-width: 992px) {
    #JcM-carousel-banner { font-size: 3rem; }
}
@media (min-width: 1200px) {
    #JcM-carousel-banner { font-size: 3rem; }
}
</style>
<?php

const MODULE_CONTENT_INDEX_BANNER2_DESCRIPTION = 'Adds JcM carousel banner into the index Area of your site.';
const MODULE_CONTENT_INDEX_BANNER2_TITLE = 'JcM index carousel banner';

// const MODULE_CONTENT_INDEX_BANNER2_IMAGE1 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape1.jpg"alt="image1"></a>';
// const MODULE_CONTENT_INDEX_BANNER2_IMAGE2 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape2.jpg"alt="image2"></a>';
// const MODULE_CONTENT_INDEX_BANNER2_IMAGE3 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape3.jpg"alt="image3"></a>';
// const MODULE_CONTENT_INDEX_BANNER2_IMAGE4 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape4.jpg"alt="image4"></a>';

// const MODULE_CONTENT_INDEX_BANNER2_IMAGE5 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape5.jpg"alt="image5"></a>';
// const MODULE_CONTENT_INDEX_BANNER2_IMAGE6 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape6.jpg"alt="image6"></a>';
// const MODULE_CONTENT_INDEX_BANNER2_IMAGE7 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape7.jpg"alt="image7"></a>';
// const MODULE_CONTENT_INDEX_BANNER2_IMAGE8 =   '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Landscape8.jpg"alt="image8"></a>';

const MODULE_CONTENT_INDEX_BANNER2_IMAGE1 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers1.webp"alt="image1"></a>';
const MODULE_CONTENT_INDEX_BANNER2_IMAGE2 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers2.webp"alt="image2"></a>';
const MODULE_CONTENT_INDEX_BANNER2_IMAGE3 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers3.webp"alt="image3"></a>';
const MODULE_CONTENT_INDEX_BANNER2_IMAGE4 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers4.webp"alt="image4"></a>';

const MODULE_CONTENT_INDEX_BANNER2_IMAGE5 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers5.webp"alt="image5"></a>';
const MODULE_CONTENT_INDEX_BANNER2_IMAGE6 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers6.webp"alt="image6"></a>';
const MODULE_CONTENT_INDEX_BANNER2_IMAGE7 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers7.webp"alt="image7"></a>';
const MODULE_CONTENT_INDEX_BANNER2_IMAGE8 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank"><img class="img-fluid" src="images/banners/Flowers8.webp"alt="image8"></a>';

const MODULE_CONTENT_INDEX_BANNER2_TITLEB1 = '<a " id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:green;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB1 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
const MODULE_CONTENT_INDEX_BANNER2_TITLEB2 = '<a " id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:white;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB2 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
const MODULE_CONTENT_INDEX_BANNER2_TITLEB3 = '<a " id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:yellow;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB3 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
const MODULE_CONTENT_INDEX_BANNER2_TITLEB4 = '<a id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:red;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB4 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';

const MODULE_CONTENT_INDEX_BANNER2_TITLEB5 = '<a id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:green;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB5 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
const MODULE_CONTENT_INDEX_BANNER2_TITLEB6 = '<a id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:white;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB6 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
const MODULE_CONTENT_INDEX_BANNER2_TITLEB7 = '<a id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:yellow;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB7 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
const MODULE_CONTENT_INDEX_BANNER2_TITLEB8 = '<a id="JcM-carousel-banner"; href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank" style="font-family:lobster; color:red;">Welcome</a><br/><a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">This is a test site</a>';
const MODULE_CONTENT_INDEX_BANNER2_TEXTB8 = '<a href="https://apps.oscommerce.com/pLcEO&jcm-header-banner-carousel-v1-2-phoenix" target="_blank">Please do not buy <i class="fas fa-smile"></i> Please do not buy</a>';
