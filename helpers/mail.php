<?php 

  function send_mail($from, $to, $subject, $content = array()) {
    $from = filter_var($from, FILTER_SANITIZE_EMAIL);
    $to = filter_var($to, FILTER_SANITIZE_EMAIL);

    if (empty($from) || empty($to)) {
      return 'Email was incorrect';
    }

    if (empty($subject) || empty($content)) {
      return 'Subject or content is incorrect';
    }

    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "Return-Path: " . $from . "\r\n";
    $headers .= "From: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

    $message = "<h1>" . $subject ."</h1><ul>";
    foreach ($content as $key => $value) {
      $message .= "<li><b>$key : </b>" . $value . "</li>";
    }
    $message .= "</ul>";

    
    return mail($to, $subject, $message, $headers);
  }