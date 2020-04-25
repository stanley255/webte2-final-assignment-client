<?php 

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
  <script src="./assets/js/main.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/normalize.css">
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
        <a class="nav-link">Projekty</a>
        <span class="delimeter"></span>
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
      <img class="icon icon-rec" src="./assets/icons/slovakia-flag.svg" alt="SK" />
    </div>
    <div class="flag-container">
      <img class="icon icon-rec" src="./assets/icons/united-kingdom-flag.svg" alt="SK" />
    </div>
  </div>
  <main>
    <div class="container content-container">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/command-line.svg" alt="Icon" />
        <h3>Napíš svoj prvý príkaz …</h3>
      </div>
      <textarea class="command-line" id="command-line"></textarea>
    </div>
    <div class="container content-container">
      <div class="container content-title">
        <img class="icon icon-big" src="./assets/icons/statistics.svg" alt="Icon" />
        <h3>Štatistiky použitia našich projektov</h3>
      </div>
      <div class="container container-full">
        <img class="icon icon-small icon-abs icon-input" src="./assets/icons/send.svg" alt="Icon" />
        <input type="email" class="input input-full input-with-icon" placeholder="example@example.com" />
      </div>
    </div>
  </main>
</body>
</html>