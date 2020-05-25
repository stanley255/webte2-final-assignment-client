<?php 

  function curl_request($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $json = curl_exec($ch);
    if (!$json) {
      $json = "{}";
    }
    curl_close($ch);

    return json_decode($json, true);
  }