<?php 

  function get_current_language($default_language = 'sk') {
    if (isset($_COOKIE['language']))
      $language = $_COOKIE['language'];
    else 
      $language = $default_language;

    $lang_file_path = realpath(__ROOT__ . '/language/lang.' . $language . '.php');
    if (file_exists($lang_file_path)) {
      return $language;
    }

    return $default_language;
  }