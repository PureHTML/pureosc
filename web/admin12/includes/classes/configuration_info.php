<?php
  class configurationInfo {
    var $id, $title, $key, $value, $description, $date_added, $last_modified, $use_function, $set_function;

// class constructor
    function configurationInfo($cfgInfo_array) {
      $this->id = $cfgInfo_array['cfgID'];
      $this->title = $cfgInfo_array['cfgTitle'];
      $this->key = $cfgInfo_array['cfgKey'];
      $this->value = htmlspecialchars($cfgInfo_array['cfgValue']);
      $this->description = $cfgInfo_array['cfgDesc'];
      $this->date_added = $cfgInfo_array['date_added'];
      $this->last_modified = $cfgInfo_array['last_modified'];
      $this->use_function = $cfgInfo_array['use_function'];
      $this->set_function = $cfgInfo_array['set_function'];
    }
  }
?>