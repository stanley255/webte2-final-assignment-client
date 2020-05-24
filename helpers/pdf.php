<?php 

  session_start();

  define('__ROOT__', dirname(dirname(__FILE__)));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/vendor/autoload.php');
  require_once(__ROOT__ . '/helpers/content.php');
  require_once(__ROOT__ . '/helpers/string.php');
  require_once(__ROOT__ . '/language/lang.php');

  // LANGUAGE SET UP
  $lang = get_current_language();
  $lang_path = realpath(__ROOT__ . '/language/lang.' . $lang . '.php');
  require_once($lang_path);

  function get_octave_api_pdf() {
    global $lang;
    global $language;

    $mpdf = new \Mpdf\Mpdf();

    $html = '<div><h1>' . $language['OCTAVE_API_PAGE_TITLE'] . '</h1></div>';

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

  if ($_GET['pdf'] === 'octave') {
    get_octave_api_pdf();
  }

  die();