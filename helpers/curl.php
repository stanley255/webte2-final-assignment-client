<?php 

  function curl($url) {

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);

    $json = curl_exec($ch);
    if (curl_error($ch)) {
      $json = "{}";
    }
    curl_close($ch);

    return json_decode($json, true);
  }