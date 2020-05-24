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
    $console_command->url = 'http://147.175.121.210:8043/api/console';
    $console_command->method = 'POST';
    $console_command->uri_params = array();
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

    $all_experiments = new stdClass();
    $all_experiments->title = array(
      'sk' => 'Získaj všetky experimenty',
      'en' => 'List all Experiments'
    );
    $all_experiments->url = 'http://147.175.121.210:8043/api/experiments';
    $all_experiments->method = 'GET';
    $all_experiments->uri_params = array();
    $all_experiments->body_params = array();

    $inverted_pendulum = new stdClass();
    $inverted_pendulum->title = array(
      'sk' => 'Získaj dáta prevráteného kyvadla',
      'en' => 'Get inverted pendulum data'
    );
    $inverted_pendulum->url = 'http://147.175.121.210:8043/api/experiments/pendulum?session={sessionID}&r={r}';
    $inverted_pendulum->method = 'GET';
    $inverted_pendulum->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      )
    );
    $inverted_pendulum->body_params = array();

    $ball_beam = new stdClass();
    $ball_beam->title = array(
      'sk' => 'Získaj dáta guličky na tyči',
      'en' => 'Get ball beam data'
    );
    $ball_beam->url = 'http://147.175.121.210:8043/api/experiments/ball?session={sessionID}&r={r}';
    $ball_beam->method = 'GET';
    $ball_beam->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      )
    );
    $ball_beam->body_params = array();

    $car_suspension = new stdClass();
    $car_suspension->title = array(
      'sk' => 'Získaj dáta tlmiča kolesa',
      'en' => 'Get car suspension data'
    );
    $car_suspension->url = 'http://147.175.121.210:8043/api/experiments/suspension?session={sessionID}&r={r}';
    $car_suspension->method = 'GET';
    $car_suspension->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      )
    );
    $car_suspension->body_params = array();

    $aircraft_pitch = new stdClass();
    $aircraft_pitch->title = array(
      'sk' => 'Získaj dáta náklonu lietadla',
      'en' => 'Get aircraft pitch data'
    );
    $aircraft_pitch->url = 'http://147.175.121.210:8043/api/experiments/aircraft?session={sessionID}&r={r}';
    $aircraft_pitch->method = 'GET';
    $aircraft_pitch->uri_params = array(
      'sessionID' => array(
        'sk' => 'Session ID používateľa',
        'en' => 'User\'s session ID'
      ),
      'r' => array(
        'sk' => 'Číselná hodnota vstupu používateľa',
        'en' => 'Numeric value of user\'s input'
      )
    );
    $aircraft_pitch->body_params = array();

    $all_logs = new stdClass();
    $all_logs->title = array(
      'sk' => 'Získaj všetky zalogované súbory',
      'en' => 'List all log files'
    );
    $all_logs->url = 'http://147.175.121.210:8043/api/logs';
    $all_logs->method = 'GET';
    $all_logs->uri_params = array();
    $all_logs->body_params = array();

    $statistics = new stdClass();
    $statistics->title = array(
      'sk' => 'Získaj štatistiky',
      'en' => 'Get Statistics'
    );
    $statistics->url = 'http://147.175.121.210:8043/api/stats';
    $statistics->method = 'GET';
    $statistics->uri_params = array();
    $statistics->body_params = array();

    return array($console_command, $all_experiments, $inverted_pendulum, $ball_beam, $car_suspension, $aircraft_pitch, $all_logs, $statistics);
  }