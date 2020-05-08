<?php 

  function get_all_experiments() {
    $inversePendulum = new stdClass();
    $inversePendulum->name = 'inversePendulum';
    $inversePendulum->min = -10;
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