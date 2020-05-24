<?php 

  session_start();

  define('__ROOT__', dirname(__FILE__));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/helpers/path.php');
  require_once(__ROOT__ . '/helpers/string.php');
  require_once(__ROOT__ . '/helpers/content.php');
  require_once(__ROOT__ . '/language/lang.php');

  // LANGUAGE SET UP
  $lang = get_current_language();
  $lang_path = realpath(__ROOT__ . '/language/lang.' . $lang . '.php');
  require_once($lang_path);

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- FONT -->
  <link
      href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700&display=swap&subset=latin-ext"
      rel="stylesheet"
    />

  <!-- FAVICON -->
  <link rel="icon" href="./assets/icons/favicon.ico">

  <!-- JS -->
  <script src="./assets/js/jquery.min.js"></script>
  <script defer src="./assets/js/main.js" type="module"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/normalize.css">
  <link rel="stylesheet" href="./assets/css/chart.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">  
  <link rel="stylesheet" href="./assets/css/icon.css">  
  <link rel="stylesheet" href="./assets/css/input.css">  
  <link rel="stylesheet" href="./assets/css/header/header.css">  
  <link rel="stylesheet" href="./assets/css/octave-api/octave-api.css">  

  <!-- TITLE -->
  <title>Webte2Final</title>
</head>
<body>
  <header class="container header-container">
    <div class="container container-space">
      <div class="container">
        <img src="./assets/icons/logo.svg" alt="Logo" class="icon" />
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'index.php'; ?>" class="logo-title"><strong>Webte2</strong>Final</a>
      </div>
      <div class="container">
        <img id="menu-button" class="icon icon-menu" src="./assets/icons/menu.svg" alt="Menu" />
      </div>
    </div>
    <nav id="navigation" class="container navigation-container">
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'index.php'; ?>" class="nav-link"><?php echo $language['HEADER_MENU_1']; ?></a>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <div class="nav-link-container">
          <ul class="nav-sub-menu">
            <?php 
              foreach (get_experiments_names() as $key => $value) {
                echo '<li>';
                echo '<a href="' . get_root_url() . DIRECTORY_SEPARATOR . 'experiments.php?init=' . $value . '">' . $language['HEADER_SUB_MENU'][$value] . '</a>';
                echo '</li>';
              }
            ?>
          </ul>
          <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'experiments.php'; ?>" class="nav-link"><?php echo $language['HEADER_MENU_2']; ?></a>
        </div>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" class="nav-link link-active"><?php echo $language['HEADER_MENU_3']; ?></a>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'contact.php'; ?>" class="nav-link"><?php echo $language['HEADER_MENU_4']; ?></a>
      </div>
    </nav>
  </header>
  <div class="container flags-container">
    <div class="flag-container <?php echo ($lang === 'sk' ? 'flag-active': ''); ?>">
      <a class="language-button" href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" title="sk">
        <img id="<?php echo ($lang === 'sk' ? 'lang-active': ''); ?>" class="icon icon-rec" src="./assets/icons/slovakia-flag.svg" alt="sk" title="sk" />
      </a>
    </div>
    <div class="flag-delimeter"></div>
    <div class="flag-container <?php echo ($lang === 'en' ? 'flag-active': ''); ?>">
      <a class="language-button" href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" title="en">
        <img id="<?php echo ($lang === 'en' ? 'lang-active': ''); ?>" class="icon icon-flag" src="./assets/icons/united-kingdom-flag.svg" alt="en" title="en" />
      </a>
    </div>
  </div>
  <main>
    <div class="container container-space content-container container-title">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/api.svg" alt="Icon" />
        <h1><?php echo $language['OCTAVE_API_PAGE_TITLE']; ?></h1>
      </div>
      <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'helpers/pdf.php?pdf=octave'; ?>" target="_blank">
        <img id="pdf-file" class="icon icon-file" src="./assets/icons/pdf.svg" alt="Icon" />
      </a>
    </div>
    <div class="container container-full octave-api-container">
      <?php 
        foreach (get_octave_api_endpoints() as $key => $endpoint) {
          ?>
            <div class="card container-full">
              <div class="container card-title">
                <img class="icon icon-mini icon-opacity" src="./assets/icons/link.svg" alt="Icon" />
                <h3><?php echo $endpoint->title[$lang]; ?></h3>
              </div>
              <div class="card-box">
                <div class="box-method <?php echo ($endpoint->method === 'POST' ? 'border-error' : 'border-secondary'); ?>">
                  <span class="text-method"><?php echo $endpoint->method; ?></span>
                </div>
                <div class="box-url">
                  <span class="text-url"><?php echo $endpoint->url; ?></span>
                </div>
              </div>
              <?php 
                  if (!empty($endpoint->uri_params)) {
                    echo '<div class="card-params">';
                    echo '<div class="params-title">' . $language['OCTAVE_API_URI_PARAMS'] . '</div>';
                    foreach ($endpoint->uri_params as $param => $param_desc) {
                      echo '<div class="param-row">';
                      echo '<span>' . $param . '</span>';
                      echo '<span>' . $param_desc[$lang] . '</span>';
                      echo '</div>';
                    }
                    echo '</div>';
                  }
                ?>
                <?php 
                  if (!empty($endpoint->body_params)) {
                    echo '<div class="card-params">';
                    echo '<div class="params-title">' . $language['OCTAVE_API_BODY_PARAMS'] . '</div>';
                    foreach ($endpoint->body_params as $param => $param_desc) {
                      echo '<div class="param-row">';
                      echo '<span>' . $param . '</span>';
                      echo '<span>' . $param_desc[$lang] . '</span>';
                      echo '</div>';
                    }
                    echo '</div>';
                  }
                ?>
            </div>
          <?php
        }
      ?>
    </div>
  </main>
</body>
</html>