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

  // INIT EXPERIMENT
  $experiments = get_all_experiments();
  $experiment = $experiments[0]->name;
  if (isset($_GET['init']) && in_array($_GET['init'], get_experiments_names())) {
    $experiment = $_GET['init'];
  }

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
  <script defer src="./assets/js/experiments.js" type="module"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/normalize.css">
  <link rel="stylesheet" href="./assets/css/chart.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">  
  <link rel="stylesheet" href="./assets/css/icon.css">  
  <link rel="stylesheet" href="./assets/css/input.css">  
  <link rel="stylesheet" href="./assets/css/button.css">  
  <link rel="stylesheet" href="./assets/css/header/header.css">  
  <link rel="stylesheet" href="./assets/css/experiments/experiments.css">  

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
              foreach ($experiments as $key => $value) {
                echo '<li>';
                echo '<a href="' . get_root_url() . DIRECTORY_SEPARATOR . 'experiments.php?init=' . $value->name . '">' . $language['HEADER_SUB_MENU'][$value->name] . '</a>';
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
        <img <?php echo ($lang === 'sk' ? 'id="lang-active"': ''); ?> class="icon icon-rec" src="./assets/icons/slovakia-flag.svg" alt="sk" title="sk" />
      </a>
    </div>
    <div class="flag-delimeter"></div>
    <div class="flag-container <?php echo ($lang === 'en' ? 'flag-active': ''); ?>">
      <a class="language-button" href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" title="en">
        <img <?php echo ($lang === 'en' ? 'id="lang-active"': ''); ?> class="icon icon-flag" src="./assets/icons/united-kingdom-flag.svg" alt="en" title="en" />
      </a>
    </div>
  </div>
  <div class="experiment-header">
    <?php 
      foreach (get_experiments_names() as $key => $value) {
        ?>
         <button id="<?php echo 'experiment-button-' . $value; ?>" name="<?php echo $value; ?>" class="button experiment-button"><?php echo $language['EXPERIMENT'][$value]; ?></button>
        <?php
      }
    ?>
  </div>
  <main id="<?php echo $experiment; ?>">
    <?php 
      foreach ($experiments as $key => $value) {
        ?>
        <div class="hidden <?php echo $value->name; ?>">
          <div class="container content-container container-title">
            <div class="container content-title">
              <img class="icon icon-big" src="./assets/icons/<?php echo $value->name; ?>.svg" alt="Icon" />
              <h1><?php echo $language['EXPERIMENT'][$value->name]; ?></h1>
            </div>
          </div> 
          <div class="container content-container">
            <div class="container content-title">
              <img class="icon icon-big" src="./assets/icons/slider.svg" alt="Icon" />
              <h3><?php echo $language['EXPERIMENT_SUBTITLE']; ?></h3>
            </div>
            <div class="container container-full">
              <input id="input-range-<?php echo $value->name; ?>" class="input input-full input-range" type="range"
                     min="<?php echo $value->min; ?>"
                     max="<?php echo $value->max; ?>"
                     step="<?php echo $value->step; ?>"
                     value="0" />
              <div class="input-container">
                <span class="arrow-left"></span>
                <input type="text" id="input-range-label-<?php echo $value->name; ?>" class="input-range-label" value="0" />
              </div>
            </div>
            <div class="container group-container">
              <div class="container graph-container">
               <canvas id="line-chart-<?php echo $value->name; ?>" width="800" height="450"></canvas>
              </div>
              <div id="experiment-visualization-<?php echo $value->name; ?>" class="container container-full experiment"></div>
            </div>
          </div>
        </div>
        <?php
      }
    ?>
  </main>
</body>
</html>