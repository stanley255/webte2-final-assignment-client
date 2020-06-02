export const translate = (lang, value) => {
  return dictionary[value] ? dictionary[value][lang] : undefined;
};

export const revert = (value) =>
  Object.entries(dictionary).reduce((reducer, [k, { sk, en }]) => {
    if (sk === value || en === value) {
      reducer = k;
    }

    return reducer;
  }, undefined);

export const radToDeg = (rad) => rad * 57.2957795;

export const experimentColors = {
  aircraftTilt: '#768ca5',
  ballOnStick: '#1A3F69',
  carShockAbsorber: '#FFC733',
  inversePendulum: '#FF5752',
};

export const dictionary = {
  inversePendulum: {
    sk: 'Prevrátené kyvadlo',
    en: 'Inverse pendulum',
  },
  ballOnStick: {
    sk: 'Gulička na tyči',
    en: 'Ball on stick',
  },
  carShockAbsorber: {
    sk: 'Tlmič kolesa',
    en: 'Car shock absorber',
  },
  aircraftTilt: {
    sk: 'Náklon lietadla',
    en: 'Aircraft pitch',
  },
};

export default {
  inversePendulum: {
    svg: './assets/svg/pendulum.svg',
    layers: {
      body: '#pendulum-body',
      ballAndStick: '#ball-and-stick',
    },
    labels: {
      sk: ['Pozícia kyvadla', 'Vychýlenie (radiány)'],
      en: ['Pendulum position', 'Deflection (radians)'],
    },
    endpoint: 'pendulum',
    octaveDataLabels: ["x", "y", "angle"],
    regex: /^-?([0-9]$|^-?[1-9][0-9]$|^-?[1][0]{2})?$/m,
  },
  ballOnStick: {
    svg: './assets/svg/beamAndBall.svg',
    layers: {
      platform: '#platform',
      ball: '#ball',
    },
    labels: {
      sk: ['Pozícia guličky', 'Uhol tyče'],
      en: ['Ball position', 'Rod angle'],
    },
    endpoint: 'ball',
    octaveDataLabels: ["x", "y", "angle"],
    regex: /^(-[1-9]|-?[1-9][0-9]|-?1[0-5][0-9]|-?16[0-5]|[0-9])?$/m,
  },
  carShockAbsorber: {
    svg: './assets/svg/car.svg',
    layers: {
      body: '#car-body',
      wheel: '#wheel',
    },
    labels: {
      sk: ['Výška kolesa', 'Výška auta'],
      en: ['Wheel height', 'Car height'],
    },
    endpoint: 'suspension',
    octaveDataLabels: ["x", "y", "bodyworkHeight"],
    regex: /^[0-9](\.\d{0,1})?$|^[1][0]{1}$/m,
  },
  aircraftTilt: {
    svg: './assets/svg/plane.svg',
    layers: {
      body: '#plane\\ 1',
      flap: '#flap',
    },
    labels: {
      sk: ['Náklon lietadla (radiány)', 'Náklon zadnej klapky (radiány)'],
      en: ['Tilt of the aircraft (radians)', 'Tilt of the rear flap (radians)'],
    },
    endpoint: 'aircraft',
    octaveDataLabels: ["x", "y", "rearFlapAngle"],
    regex: /^[0](\.\d{0,2})?$|^[1]{1}$/m,
  },
};
