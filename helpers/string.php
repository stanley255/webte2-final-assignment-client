<?php 

  function my_ucfirst($str) {
    if (empty($str)) return FALSE;
    $fc = mb_strtoupper(mb_substr($str, 0, 1));
    return $fc.mb_substr($str, 1);
  }

  function my_strtolower($str) {
    if (empty($str)) return FALSE;
    return mb_strtolower($str);
  }

  function trim_all($str) {  
    return trim(str_replace('\xEF\xBB\xBF', '', $str));
  }

  function date_diff_in_days($date_1, $date_2, $date_format = '%a') {
    $datetime_1 = date_create($date_1);
    $datetime_2 = date_create($date_2);

    $diff_in_days = date_diff($datetime_1, $datetime_2);

    return $diff_in_days->format($date_format);
  }

  function my_date_format($date, $date_format = 'Y-m-d H:i:s') {
    $datetime = date_create($date, timezone_open('Europe/Bratislava'));
    if (!$datetime) return;

    return $datetime->format($date_format);
  }

  function my_date_from_format($date, $date_format_from = 'm-d-Y', $date_format_to = 'Y-m-d H:i:s') {
    $datetime = date_create_from_format($date_format_from, $date, timezone_open('Europe/Bratislava'));
    if (!$datetime) return;

    return $datetime->format($date_format_to);
  }

  function my_date_time_by_timezone($date, $timezone, $format = 'Y-m-d H:i:s') {
    $datetime = new DateTime($date, new DateTimeZone($timezone));
    if (!$datetime) return;

    return $datetime->format($format);
  }

  function get_extension($file) {
    return pathinfo($file, PATHINFO_EXTENSION);
  }

  function get_filename($file) {
    return pathinfo($file, PATHINFO_FILENAME);
  }

?>