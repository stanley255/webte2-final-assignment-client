<?php

  session_start();  

  define('__ROOT__', dirname(dirname(__FILE__)));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/helpers/mail.php');
  require_once(__ROOT__ . '/language/lang.php');

  // LANGUAGE SET UP
  $lang = get_current_language();
  $lang_path = realpath(__ROOT__ . '/language/lang.' . $lang . '.php');
  require_once($lang_path);

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=utf8');

  if (isset($_POST['email_to']) && isset($_POST['content'])) {
    $results = send_mail('noreply@webte2final.stuba.sk', $_POST['email_to'], $language['MAIL_TITLE'], $_POST['content']);

    if ($results) {
      http_response_code(201);
  
      echo json_encode(
        array('message' => $results),
        JSON_UNESCAPED_UNICODE
      );
    } else {
      http_response_code(404);
  
      echo json_encode(
        array('message' => $results),
        JSON_UNESCAPED_UNICODE
      );
    }

    die();
  }

  require_once(__ROOT__ . '/api/not-found.php');