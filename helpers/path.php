<?php 

  require_once(__ROOT__ . '/config.php');

  function get_root_url() {
    return ( ( ! empty($_SERVER['HTTPS']) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . basename(__ROOT__));
  }

  function get_client_ip() {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
          $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
          $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }

    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];
  
    if(filter_var($client, FILTER_VALIDATE_IP)) { $ip = $client; }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) { $ip = $forward; }
    else { $ip = $remote; }
  
    return $ip;
  }

  function redirect($page, $status_code = 302) {
    if ($page === '/') {
      $location = get_root_url();
    } else {
      $location =  get_root_url() . DIRECTORY_SEPARATOR . $page;
    }

    $location = sanitize_url($location);
    header("Location: $location", true, $status_code);
    exit();
  }

  function redirect_external($external_page, $status_code = 302) {
    $location = filter_var($external_page, FILTER_SANITIZE_URL);
    header("Location: $location", true, $status_code);
    exit();
  }

  function sanitize_url($url) {
    return filter_var($url, FILTER_SANITIZE_URL);
  }

  function is_ajax() {
    return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}

?>