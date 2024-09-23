<?php
//shop2.0brain:todo: error ajax viz //todo:error nekdy zustane BOX_HEADING_SEARCH + spatne hleda hacky
/*
  $Id: search.php,v 1.22 2003/02/10 22:31:05 hpdl Exp $

  modified by paulm_nl 2003/12/23
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- search //-->
				<script><!--
//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();

//Called from keyup on the search textbox.
//Starts the AJAX request.
function searchsuggest() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('keywords').value);
		searchReq.open("GET", 'searchsuggest.php?search=' + str + '&<?php echo tep_session_name() . '=' . tep_session_id() ?>', true);
		searchReq.onreadystatechange = handlesearchsuggest;
		searchReq.send(null);
	}
}

//Called when the AJAX response is returned.
function handlesearchsuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = str[i] + '<br \/>';
			ss.innerHTML += suggest;
		}
	}
}

				//--></script>
<?php
  $boxHeading = BOX_HEADING_SEARCH;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxContent_attributes = ' align="left"';
  $box_base_name = 'search'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $boxContent = tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
//todo:error nekdy zustane   $boxContent .= tep_draw_input_field_label(BOX_HEADING_SEARCH, true, 'keywords', BOX_HEADING_SEARCH, ' onkeyup="searchsuggest();" size="10" maxlength="30" ') . '<br />' . tep_hide_session_id() ;
  $boxContent .= tep_draw_input_field_label('', true, 'keywords', '', ' onkeyup="searchsuggest();" size="16" maxlength="30" ') . '' . tep_hide_session_id() ;
  $boxContent .= '<label for="quick_find_lanch" accesskey="S">'
                 . tep_image_submit('button_quick_find.png', 'ok', 'id="quick_find_lanch"') 
                 . '</label>' . '<br />' 
                 . BOX_SEARCH_TEXT . '<br /><a accesskey="A" href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) 
                 . '"><span class="b">' . '&nbsp;[A]&nbsp;' . BOX_SEARCH_ADVANCED_SEARCH . '</span></a></form>';
  $boxContent .= '<div id="search_suggest"></div>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxContent_attributes = '';
?>
<!-- search_eof //-->