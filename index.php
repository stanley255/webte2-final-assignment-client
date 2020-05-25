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
  <script src="./assets/js/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
  <script defer src="./assets/js/command-line.js" type="module"></script>
  <script defer src="./assets/js/stats.js" type="module"></script>
  <script defer src="./assets/js/main.js" type="module"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/normalize.css">
  <link rel="stylesheet" href="./assets/css/chart.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">  
  <link rel="stylesheet" href="./assets/css/icon.css">  
  <link rel="stylesheet" href="./assets/css/input.css">  
  <link rel="stylesheet" href="./assets/css/button.css">  
  <link rel="stylesheet" href="./assets/css/header/header.css">  
  <link rel="stylesheet" href="./assets/css/home/home.css">  

  <!-- TITLE -->
  <title>Webte2Final</title>
</head>
<body>
  <header class="container header-container">
    <div class="container container-space">
      <div class="container">
        <img src="./assets/icons/logo.svg" alt="Logo" class="icon" />
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" class="logo-title"><strong>Webte2</strong>Final</a>
      </div>
      <div class="container">
        <img id="menu-button" class="icon icon-menu" src="./assets/icons/menu.svg" alt="Menu" />
      </div>
    </div>
    <nav id="navigation" class="container navigation-container">
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" class="nav-link link-active"><?php echo $language['HEADER_MENU_1']; ?></a>
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
    <div class="container content-container">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/command-line.svg" alt="Icon" />
        <h3><?php echo $language['HOME_PAGE_TITLE_1']; ?></h3>
      </div>
      <div class="command-line" id="command-line">
        <div class="command-init-txt" id="command-init-txt"></div>
        <div class="line clearfix hidden" id="line-template">
          <strong class="command-desc float"><span class="command-desc-txt"></span>&nbsp;</strong><div class="command-content float" contenteditable="true" tabindex="0"></div>
        </div>
        <div class="line hidden" id="result-template">
          <span class="command-desc-txt"></span>
        </div>
      </div>
    </div>
    <div class="container content-container">
      <div class="container content-title"> 
        <img class="icon icon-big" src="./assets/icons/statistics.svg" alt="Icon" />
        <h3><?php echo $language['HOME_PAGE_TITLE_2']; ?></h3>
      </div>
      <div id="stats-not-found" class="container container-full stats-not-found hidden"><?php echo $language['HOME_PAGE_MESSAGE_1']; ?></div>
      <div id="stats" class="container-full">
        <form id="form-email" class="container container-full">
          <div class="container container-full">
            <img class="icon icon-small icon-abs icon-input" src="./assets/icons/send.svg" alt="Icon" />
            <input id="input-email" autocomplete="off" type="email" class="input input-full input-with-icon" placeholder="example@example.com" />
          </div>
          <button type="submit" class="button button-left-space"><?php echo $language['HOME_PAGE_BUTTON_1']; ?></button>
        </form>
        <div class="container stats-container">
          <ul id="chart-legend" class="legend-list"></ul>
          <div>
            <canvas class="stats-chart" id="stats-chart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>