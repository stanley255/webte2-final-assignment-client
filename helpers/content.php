<?php 

  function get_all_experiments() {
    $inversePendulum = new stdClass();
    $inversePendulum->name = 'inversePendulum';
    $inversePendulum->min = -100;
    $inversePendulum->max = 100;
    $inversePendulum->step = 1;

    $ballOnStick = new stdClass();
    $ballOnStick->name = 'ballOnStick';
    $ballOnStick->min = -190;
    $ballOnStick->max = 190;
    $ballOnStick->step = 1;

    $carShockAbsorber = new stdClass();
    $carShockAbsorber->name = 'carShockAbsorber';
    $carShockAbsorber->min = 0;
    $carShockAbsorber->max = 10;
    $carShockAbsorber->step = 0.1;

    $aircraftTilt = new stdClass();
    $aircraftTilt->name = 'aircraftTilt';
    $aircraftTilt->min = 0;
    $aircraftTilt->max = 1;
    $aircraftTilt->step = 0.01;
    return array($inversePendulum, $ballOnStick, $carShockAbsorber, $aircraftTilt);
  }

  function get_experiments_names() {
    $experiments = array();

    foreach (get_all_experiments() as $key => $value) {
      array_push($experiments, $value->name);
    }

    return $experiments;
  }

  function get_contacts() {
    $jan_korcek = new stdClass();
    $jan_korcek->image = './assets/images/jan-korcek.jpg';
    $jan_korcek->name = 'Ján Korček';
    $jan_korcek->age = array(
      'sk' => '22 rokov',
      'en' => '22 years'
    );
    $jan_korcek->mail = 'xkorcek@stuba.sk';
    $jan_korcek->ais_id = '92230';
    $jan_korcek->git = 'https://github.com/korcekj';
    $jan_korcek->experiment = 'inversePendulum';
    $jan_korcek->tasks = array(
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
    );

    $stanislav_pekarovic = new stdClass();
    $stanislav_pekarovic->image = './assets/images/stanislav-pekarovic.jpg';
    $stanislav_pekarovic->name = 'Stanislav Pekarovič';
    $stanislav_pekarovic->age = array(
      'sk' => '22 rokov',
      'en' => '22 years'
    );
    $stanislav_pekarovic->mail = 'xpekarovic@stuba.sk';
    $stanislav_pekarovic->ais_id = '92323';
    $stanislav_pekarovic->git = 'https://github.com/stanley255';
    $stanislav_pekarovic->experiment = 'ballOnStick';
    $stanislav_pekarovic->tasks = array(
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
    );

    $matej_friedel = new stdClass();
    $matej_friedel->image = './assets/images/matej-friedel.jpg';
    $matej_friedel->name = 'Matej Friedel';
    $matej_friedel->age = array(
      'sk' => '22 rokov',
      'en' => '22 years'
    );
    $matej_friedel->mail = 'xfriedel@stuba.sk';
    $matej_friedel->ais_id = '92274';
    $matej_friedel->git = 'https://github.com/MatejFriedel';
    $matej_friedel->experiment = 'carShockAbsorber';
    $matej_friedel->tasks = array(
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
    );

    $martin_knosko = new stdClass();
    $martin_knosko->image = './assets/images/martin-knosko.jpg';
    $martin_knosko->name = 'Martin Knoško';
    $martin_knosko->age = array(
      'sk' => '23 rokov',
      'en' => '23 years'
    );
    $martin_knosko->mail = 'xknosko@stuba.sk';
    $martin_knosko->ais_id = '92226';
    $martin_knosko->git = 'https://github.com/mknosko';
    $martin_knosko->experiment = 'aircraftTilt';
    $martin_knosko->tasks = array(
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#2',
        'en' => 'EN - Task#2',
      ),
      array(
        'sk' => 'SK - Task#1',
        'en' => 'EN - Task#1',
      ),
    );

    return array($jan_korcek, $stanislav_pekarovic, $matej_friedel, $martin_knosko);
  }

  function get_octave_api_endpoints() {
    $console_command = new stdClass();
    $console_command->title = array(
      'sk' => 'Pošli Octave príkaz',
      'en' => 'Send an Octave command'
    );
    $console_command->url = 'http://52.233.133.56/api/console?api-key=<span class="primary">{apiKey}</span>';
    $console_command->method = 'POST';
    $console_command->uri_params = array(
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $console_command->body_params = array(
      'session' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'command' => array(
        'sk' => 'Octave príkaz',
        'en' => 'Octave command'
      )
    );
    $console_command->response = array(
      'session' => 'j057t7hrv9d71p1vt1b010e080',
      'output' => array(
        '1 3',
        '2 2',
        '3 1',
      )
    );

    $all_experiments = new stdClass();
    $all_experiments->title = array(
      'sk' => 'Získaj všetky experimenty',
      'en' => 'List all Experiments'
    );
    $all_experiments->url = 'http://52.233.133.56/api/experiments?api-key=<span class="primary">{apiKey}</span>';
    $all_experiments->method = 'GET';
    $all_experiments->uri_params = array(
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $all_experiments->body_params = array();
    $all_experiments->response = array(
      'experiments' => array(
        array(
          'experiment' => 'Inverted Pendulum',
          'endpoint' => '/experiments/pendulum',
        ),
        array(
          'experiment' => 'Ball Beam',
          'endpoint' => '/experiments/ball',
        ),
        array(
          'experiment' => 'Car Suspension',
          'endpoint' => '/experiments/suspension',
        ),
        array(
          'experiment' => 'Aircraft Pitch',
          'endpoint' => '/experiments/aircraft',
        )
      )
    );

    $inverted_pendulum = new stdClass();
    $inverted_pendulum->title = array(
      'sk' => 'Získaj dáta prevráteného kyvadla',
      'en' => 'Get inverted pendulum data'
    );
    $inverted_pendulum->url = 'http://52.233.133.56/api/experiments/pendulum?session=<span class="primary">{sessionID}</span>&r=<span class="primary">{r}</span>&api-key=<span class="primary">{apiKey}</span>';
    $inverted_pendulum->method = 'GET';
    $inverted_pendulum->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      ),
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $inverted_pendulum->body_params = array();
    $inverted_pendulum->response = array(
      'experiment' => 'Inverted Pendulum',
      'session' => 'j057t7hrv9d71p1vt1b010e080',
      'data' => array(
        array(
          'x' => 420,
          'y' => 420,
          'angle' => 69
        )
      )
    );

    $ball_beam = new stdClass();
    $ball_beam->title = array(
      'sk' => 'Získaj dáta guličky na tyči',
      'en' => 'Get ball beam data'
    );
    $ball_beam->url = 'http://52.233.133.56/api/experiments/ball?session=<span class="primary">{sessionID}</span>&r=<span class="primary">{r}</span>&api-key=<span class="primary">{apiKey}</span>';
    $ball_beam->method = 'GET';
    $ball_beam->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      ),
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $ball_beam->body_params = array();
    $ball_beam->response = array(
      'experiment' => 'Ball Beam',
      'session' => 'j057t7hrv9d71p1vt1b010e080',
      'data' => array(
        array(
          'x' => 420,
          'y' => 420,
          'angle' => 69
        )
      )
    );

    $car_suspension = new stdClass();
    $car_suspension->title = array(
      'sk' => 'Získaj dáta tlmiča kolesa',
      'en' => 'Get car suspension data'
    );
    $car_suspension->url = 'http://52.233.133.56/api/experiments/suspension?session=<span class="primary">{sessionID}</span>&r=<span class="primary">{r}</span>&api-key=<span class="primary">{apiKey}</span>';
    $car_suspension->method = 'GET';
    $car_suspension->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      ),
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $car_suspension->body_params = array();
    $car_suspension->response = array(
      'experiment' => 'Car Suspension',
      'session' => 'j057t7hrv9d71p1vt1b010e080',
      'data' => array(
        array(
          'x' => 420,
          'y' => 420,
          'bodyworkHeight' => 69
        )
      )
    );

    $aircraft_pitch = new stdClass();
    $aircraft_pitch->title = array(
      'sk' => 'Získaj dáta náklonu lietadla',
      'en' => 'Get aircraft pitch data'
    );
    $aircraft_pitch->url = 'http://52.233.133.56/api/experiments/aircraft?session=<span class="primary">{sessionID}</span>&r=<span class="primary">{r}</span>&api-key=<span class="primary">{apiKey}</span>';
    $aircraft_pitch->method = 'GET';
    $aircraft_pitch->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      ),
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $aircraft_pitch->body_params = array();
    $aircraft_pitch->response = array(
      'experiment' => 'Aircraft Pitch',
      'session' => 'j057t7hrv9d71p1vt1b010e080',
      'data' => array(
        array(
          'x' => 420,
          'y' => 420,
          'rearFlapAngle' => 69
        )
      )
    );

    $all_logs = new stdClass();
    $all_logs->title = array(
      'sk' => 'Získaj všetky zalogované súbory',
      'en' => 'List all log files'
    );
    $all_logs->url = 'http://52.233.133.56/api/logs?api-key=<span class="primary">{apiKey}</span>';
    $all_logs->method = 'GET';
    $all_logs->uri_params = array(
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $all_logs->body_params = array();
    $all_logs->response = array(
      'logs' => array(
        array(
          'timestamp' => '2020-01-01 10:10:10',
          'command' => 'console',
          'session' => 'j057t7hrv9d71p1vt1b010e080',
          'status' => 'success',
          'info' => 'Operation was successfull',
        )
      )
    );

    $last_input = new stdClass();
    $last_input->title = array(
      'sk' => 'Získaj posledný vstup a hodnoty experimentu',
      'en' => 'Get last input and values of experiment'
    );
    $last_input->url = 'http://52.233.133.56/api/logs?experiment=<span class="primary">{experiment}</span>&session=<span class="primary">{sessionID}</span>&api-key=<span class="primary">{apiKey}</span>';
    $last_input->method = 'GET';
    $last_input->uri_params = array(
      'experiment' => array(
        'sk' => 'Názov experimentu',
        'en' => 'Experiment name'
      ),
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $last_position = new stdClass();
    $last_position->x = 5;
    $last_position->y = 4.90037;
    $last_position->bodyworkHeight = 0.00037;
    $last_input->body_params = array();
    $last_input->response = array(
      'r' => 0,
      'lastPosition' => $last_position
    );

    $statistics = new stdClass();
    $statistics->title = array(
      'sk' => 'Získaj štatistiky',
      'en' => 'Get Statistics'
    );
    $statistics->url = 'http://52.233.133.56/api/stats?api-key=<span class="primary">{apiKey}</span>';
    $statistics->method = 'GET';
    $statistics->uri_params = array(
      'apiKey' => array(
        'sk' => 'Tajný autentifikačný token používateľa',
        'en' => 'Secret authentication token of user'
      ),
    );
    $statistics->body_params = array();
    $statistics->response = array(
      'stats' => array(
        array(
          'experiment' => 'Inverted Pendulum',
          'count' => 1
        ),
        array(
          'experiment' => 'Ball Beam',
          'count' => 1
        ),
        array(
          'experiment' => 'Car Suspension',
          'count' => 1
        ),
        array(
          'experiment' => 'Aircraft Pitch',
          'count' => 1
        )
      )
    );

    return array($console_command, $all_experiments, $inverted_pendulum, $ball_beam, $car_suspension, $aircraft_pitch, $all_logs, $last_input, $statistics);
  }