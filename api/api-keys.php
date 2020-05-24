<?php

  define('__ROOT__', dirname(dirname(__FILE__)));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/config.php');

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=utf8');

  if ($_GET['key'] === 'octave') {
    http_response_code(200);
  
    echo json_encode(
      array('key' => $GLOBALS['octave_api_key']),
      JSON_UNESCAPED_UNICODE
    );

    die();
  } 

  require_once(__ROOT__ . '/api/not-found.php');