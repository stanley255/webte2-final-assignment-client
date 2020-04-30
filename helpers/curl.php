<?php 

  function curl_request($url, $headers = array()) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $json = curl_exec($ch);
    if (!$json) {
      $json = "{}";
    }
    echo 'Curl error: ' . curl_error($ch);
    print_r(curl_getinfo($ch));
    curl_close($ch);

    return json_decode($json, true);
  }