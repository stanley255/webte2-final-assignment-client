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
  <link rel="stylesheet" href="./assets/css/contact/contact.css">  

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
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'octave-api.php'; ?>" class="nav-link"><?php echo $language['HEADER_MENU_3']; ?></a>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" class="nav-link link-active"><?php echo $language['HEADER_MENU_4']; ?></a>
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
    <div class="container container-space container-title">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/programmer.svg" alt="Icon" />
        <h1><?php echo $language['CONTANT_PAGE_TITLE']; ?></h1>
      </div>
      <div class="container container-reference">
        <a href="https://github.com/stanley255/webte2-final-assignment-client" title="front-end" target="_blank">
          <img class="icon icon-breath icon-opacity" src="./assets/icons/front-end.svg" alt="Icon" />
        </a>
        <a href="https://github.com/stanley255/webte2-final-assignment-server" title="back-end" target="_blank">
          <img class="icon icon-breath breath-delay icon-opacity" src="./assets/icons/back-end.svg" alt="Icon" />
        </a>
      </div> 
    </div>
    <div class="contact-container">
      <?php 
        foreach (get_contacts() as $key => $value) {
          ?>
            <div class="card">
              <div style="background-image: url(<?php echo $value->image; ?>);" class="card-image"></div>
              <a href="<?php echo $value->git; ?>" target="_blank">
                <img class="icon icon-git" src="./assets/icons/github.svg" />
              </a>
              <div class="card-content">
                <h3 class="card-title"><?php echo $value->name; ?></h3>
                <div class="card-section section-border">
                  <div class="container container-space item-container">
                    <img src="./assets/icons/mail.svg" class="icon icon-small" />
                    <a class="text-info text-bold" href="mailto:<?php echo $value->mail; ?>" ><?php echo $value->mail; ?></a>
                  </div>
                  <div class="container container-space item-container">
                    <img src="./assets/icons/aisid.svg" class="icon icon-small" />
                    <span class="text-info"><?php echo $value->ais_id; ?></span>
                  </div>
                  <div class="container container-space item-container">
                    <img src="./assets/icons/calendar.svg" class="icon icon-small" />
                    <span class="text-info"><?php echo $value->age[$lang]; ?></span>
                  </div>
                </div>
                <div class="card-section section-border">
                  <div class="container container-space item-container">
                    <img src="./assets/icons/experiment.svg" class="icon icon-small" />
                    <a class="text-info text-bold" href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . 'experiments.php?init=' . $value->experiment; ?>"><?php echo $language['EXPERIMENT'][$value->experiment]; ?></a>
                  </div>
                </div>
                <div class="card-section">
                  <?php 
                    foreach ($value->tasks as $key => $task) {
                      ?>
                        <div class="container container-space item-container">
                          <img src="./assets/icons/checkbox-checked.svg" class="icon icon-mini" />
                          <span class="text-info"><?php echo $task[$lang]; ?></span>
                        </div>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          <?php
        }
      ?>
    </div>
  </main>
</body>
</html>