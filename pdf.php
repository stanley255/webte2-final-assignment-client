<?php 

  session_start();

  define('__ROOT__', dirname(__FILE__));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/config.php');

  require_once(__ROOT__ . '/vendor/autoload.php');
  require_once(__ROOT__ . '/helpers/content.php');
  require_once(__ROOT__ . '/helpers/string.php');
  require_once(__ROOT__ . '/helpers/curl.php');
  require_once(__ROOT__ . '/language/lang.php');

  // LANGUAGE SET UP
  $lang = get_current_language();
  $lang_path = realpath(__ROOT__ . '/language/lang.' . $lang . '.php');
  require_once($lang_path);

  function get_octave_api_pdf() {
    global $lang;
    global $language;

    $mpdf = new \Mpdf\Mpdf();

    $html = '<h1>' . $language['OCTAVE_API_PAGE_TITLE'] . '</h1>';

    $html .= '<div>';

    foreach (get_octave_api_endpoints() as $key => $endpoint) {
      $html .= '<div><h3>&bull; ' . $endpoint->title[$lang] . '</h3></div>';
      $html .= '<p><strong class="' . my_strtolower($endpoint->method) . '">' . $endpoint->method . '</strong> | ' . $endpoint->url . '</p>';
      if (!empty($endpoint->uri_params)) {
        $html .= '<table><thead>';
        $html .= '<tr><th colspan="2"><h4>' . $language['OCTAVE_API_URI_PARAMS'] . '</h4></th></tr>';
        $html .= '</thead><tbody>';
        foreach ($endpoint->uri_params as $param => $param_desc) {
          $html .= '<tr>';
          $html .= '<td>' . $param . '</td>';
          $html .= '<td>' . $param_desc[$lang] . '</td>';
          $html .= '</tr>';
        }
        $html .= '</tbody></table>';
      }

      if (!empty($endpoint->body_params)) {
        $html .= '<table><thead>';
        $html .= '<tr><th colspan="2"><h4>' . $language['OCTAVE_API_BODY_PARAMS'] . '</h4></th></tr>';
        $html .= '</thead><tbody>';
        foreach ($endpoint->body_params as $param => $param_desc) {
          $html .= '<tr>';
          $html .= '<td>' . $param . '</td>';
          $html .= '<td>' . $param_desc[$lang] . '</td>';
          $html .= '</tr>';
        }
        $html .= '</tbody></table>';
      }

      $html .= '<h4>' . $language['OCTAVE_API_RESPONSE_BODY'] . '</h4>';
      $html .= '<pre>' . json_encode($endpoint->response, JSON_PRETTY_PRINT) . '</pre>';
    }

    $html .= '</div>';

    // CSS
    $stylesheet = file_get_contents(__ROOT__ . '/assets/css/octave-api/pdf.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    // HTML
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    // DOWNLOAD
    $mpdf->Output('octave-api-' . $lang . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
  }

  function get_logs_pdf() {
    global $lang;
    global $language;

    $logs = curl_request('http://52.233.133.56/api/logs?api-key=' . $GLOBALS['octave_api_key']);

    $mpdf = new \Mpdf\Mpdf();

    $html = '<h1>' . $language['OCTAVE_API_EXPORT_SUBTITLE'] . '</h1>';

    $html .= '<div>';
    foreach ($logs as $key => $log) {
      $html .= '<table>';
      $html .= '<tr><th colspan="2">' . $language['OCTAVE_API_LOG'] . ' #' . ($key + 1) . '</th></tr>';
      foreach ($log as $key => $value) {
        $html .= '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
      }
      $html .= '</table>';
    }
    $html .= '</div>';

    // CSS
    $stylesheet = file_get_contents(__ROOT__ . '/assets/css/octave-api/pdf.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    // HTML
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    // DOWNLOAD
    $mpdf->Output('logs-' . $lang . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
  }

  if ($_GET['pdf'] === 'octave') {
    get_octave_api_pdf();
  } else if ($_GET['pdf'] === 'logs') {
    get_logs_pdf();
  }

  die();