<?php 

  function get_all_experiments() {
    $inversePendulum = new stdClass();
    $inversePendulum->name = 'inversePendulum';
    $inversePendulum->min = -100;
    $inversePendulum->max = 100;
    $inversePendulum->step = 1;

    $ballOnStick = new stdClass();
    $ballOnStick->name = 'ballOnStick';
    $ballOnStick->min = 0;
    $ballOnStick->max = 1;
    $ballOnStick->step = 0.01;

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
      return array('inversePendulum', 'ballOnStick', 'carShockAbsorber', 'aircraftTilt');
  }