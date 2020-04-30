<?php 

  session_start();

  define('__ROOT__', dirname(__FILE__));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/helpers/path.php');
  require_once(__ROOT__ . '/helpers/string.php');
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
  <script src="./assets/js/chart.min.js"></script>
  <script defer src="./assets/js/main.js" type="module"></script>
  <script defer src="./assets/js/experiments/experiments.js" type="module"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/normalize.css">
  <link rel="stylesheet" href="./assets/css/chart.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">  
  <link rel="stylesheet" href="./assets/css/icon.css">  
  <link rel="stylesheet" href="./assets/css/input.css">  
  <link rel="stylesheet" href="./assets/css/header/header.css">  
  <link rel="stylesheet" href="./assets/css/experiments/pendulum.css">  

  <!-- TITLE -->
  <title>Webte2Final</title>
</head>
<body>
  <header class="container header-container">
    <div class="container">
      <img src="./assets/icons/logo.svg" alt="Logo" class="icon" />
      <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'index.php'; ?>" class="logo-title"><strong>Webte2</strong>Final</a>
    </div>
    <nav class="container">
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'index.php'; ?>" class="nav-link"><?php echo $language['HEADER_MENU_1']; ?></a>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <div class="nav-link-container">
          <ul class="nav-sub-menu">
            <li>
              <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>"><?php echo $language['HEADER_SUB_MENU_1'] ?></a>
            </li>
            <li>
              <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'ball.php'; ?>"><?php echo $language['HEADER_SUB_MENU_2'] ?></a>
            </li>
            <li>
              <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'absorber.php'; ?>"><?php echo $language['HEADER_SUB_MENU_3'] ?></a>
            </li>
            <li>
              <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'aircraft.php'; ?>"><?php echo $language['HEADER_SUB_MENU_4'] ?></a>
            </li>
          </ul>
          <span class="nav-link link-active"><?php echo $language['HEADER_MENU_2']; ?></span>
        </div>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'octave-api.php'; ?>" class="nav-link"><?php echo $language['HEADER_MENU_3']; ?></a>
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
    <div class="container content-container container-title">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/pendulum.svg" alt="Icon" />
        <h1><?php echo $language['PENDULUM']; ?></h1>
      </div>
    </div>
    <div class="container content-container">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/slider.svg" alt="Icon" />
        <h3><?php echo $language['PENDULUM_PAGE_TITLE_1']; ?></h3>
      </div>
      <div class="container container-full">
        <input id="input-range" class="input input-full input-range" type="range" min="0" max="1" step="0.01" value="0" />
        <div class="input-container">
          <span class="arrow-left"></span>
          <input type="text" id="input-range-label" class="input-range-label" value="0" />
        </div>
      </div>
    </div>
  </main>
</body>
</html>