<?php 

  function get_all_experiments() {
    $inversePendulum = new stdClass();
    $inversePendulum->name = 'inversePendulum';
    $inversePendulum->min = 0;
    $inversePendulum->max = 10;
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
    $jan_korcek->age = '22';
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
    $stanislav_pekarovic->age = '22';
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
    $matej_friedel->image = './assets/images/programmer.jpg';
    $matej_friedel->name = 'Matej Friedel';
    $matej_friedel->age = 'xx';
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
    $martin_knosko->image = './assets/images/programmer.jpg';
    $martin_knosko->name = 'Martin Knoško';
    $martin_knosko->age = 'xx';
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