<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=utf8');

  http_response_code(404);
  
  echo json_encode(
      array('message' => 'Zadaná adresa nie je platná.'),
      JSON_UNESCAPED_UNICODE
  );

  die();