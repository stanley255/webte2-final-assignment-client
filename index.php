<?php 

  session_start();

  define('__ROOT__', dirname(__FILE__));
  define('__SCRIPT_NAME__', basename($_SERVER['SCRIPT_FILENAME']));

  require_once(__ROOT__ . '/helpers/path.php');
  require_once(__ROOT__ . '/helpers/string.php');

?>

<!DOCTYPE html>
<html lang="sk">
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
  <script defer src="./assets/js/main.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/normalize.css">
  <link rel="stylesheet" href="./assets/css/chart.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">  
  <link rel="stylesheet" href="./assets/css/icon.css">  
  <link rel="stylesheet" href="./assets/css/input.css">  
  <link rel="stylesheet" href="./assets/css/header/header.css">  
  <link rel="stylesheet" href="./assets/css/home/home.css">  

  <!-- TITLE -->
  <title>Webte2Final</title>
</head>
<body>
  <header class="container header-container">
    <div class="container">
      <img src="./assets/icons/logo.svg" alt="Logo" class="icon" />
      <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" class="logo-title"><strong>Webte2</strong>Final</a>
    </div>
    <nav class="container">
      <div class="container nav-item">
        <a href="<?php echo get_root_url() . DIRECTORY_SEPARATOR . __SCRIPT_NAME__; ?>" class="nav-link">Domov</a>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <div class="nav-link-container">
          <ul class="nav-sub-menu">
            <li>
              <a>Kyvadlo</a>
            </li>
            <li>
              <a>Gulička</a>
            </li>
            <li>
              <a>Tlmenie</a>
            </li>
            <li>
              <a>Lietadlo</a>
            </li>
          </ul>
          <a class="nav-link">Projekty</a>
        </div>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <a class="nav-link">Octave API</a>
        <span class="delimeter"></span>
      </div>
      <div class="container nav-item">
        <a class="nav-link">Kontakt</a>
      </div>
    </nav>
  </header>
  <div class="container language-container">
    <div class="flag-container">
      <img class="icon icon-rec" src="./assets/icons/slovakia-flag.svg" alt="SK" title="SK" />
    </div>
    <div class="lang-delimeter"></div>
    <div class="flag-container">
      <img class="icon icon-rec" src="./assets/icons/united-kingdom-flag.svg" alt="EN" title="EN" />
    </div>
  </div>
  <main>
    <div class="container content-container">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/command-line.svg" alt="Icon" />
        <h3>Napíš svoj prvý príkaz ...</h3>
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
        <h3>Štatistiky použitia našich projektov</h3>
      </div>
      <div id="stats-not-found" class="container container-full stats-not-found hidden">Neboli nájdené žiadne štatistické dáta</div>
      <div id="stats" class="container-full">
        <div class="container container-full">
          <img class="icon icon-small icon-abs icon-input" src="./assets/icons/send.svg" alt="Icon" />
          <input type="email" class="input input-full input-with-icon" placeholder="example@example.com" />
        </div>
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