<?php 

  session_start();

  define('__ROOT__', dirname(__FILE__));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/config.php');

  require_once(__ROOT__ . '/helpers/curl.php');
  require_once(__ROOT__ . '/language/lang.php');

  // LANGUAGE SET UP
  $lang = get_current_language();
  $lang_path = realpath(__ROOT__ . '/language/lang.' . $lang . '.php');
  require_once($lang_path);

  function get_logs_csv() {
    global $lang;
    global $language;

    $logs = curl_request('http://52.233.133.56/api/logs?api-key=' . $GLOBALS['octave_api_key']);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="logs-' . $lang . '.csv"');
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "\xEF\xBB\xBF";
    $fp = fopen('php://output', 'wb');

    foreach ($logs as $key => $log) {
        fputcsv($fp, array($language['OCTAVE_API_LOG'] . ' #' . ($key + 1)), ';');
        foreach ($log as $key => $value) {
          fputcsv($fp, array($key, $value), ';');
        }
        fputcsv($fp, array(PHP_EOL), ';');
    }

    fclose($fp);
  }

  if ($_GET['csv'] === 'logs') {
    get_logs_csv();
  } 

  die();