<?php
  class pollInfo {
    var $id, $title, $votes, $timestamp;

// class constructor
    function pollInfo($poInfo_array) {
      $this->id = $poInfo_array['pollID'];
      $this->title = $poInfo_array['pollTitle'];
      $this->votes = $poInfo_array['voters'];
      $this->timestamp = $poInfo_array['timeStamp'];
    }
  }
?>