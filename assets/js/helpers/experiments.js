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
      platform: '#pendulum-platform',
      body: '#pendulum-body',
      ballAndStick: '#ball-and-stick',
    },
    labels: {
      sk: ['Pozícia kyvadla', 'Vychýlenie (stupne)'],
      en: ['Pendulum position', 'Deflection (degrees)'],
    },
    endpoint: 'pendulum',
    octaveData: {
      x: (value) => value,
      y: (value) => value,
      angle: (value) => radToDeg(value),
    },
    regex: /^-?([0-9]$|^-?[1][0-9]$|^-?[2][0])?$/m,
  },
  ballOnStick: {
    svg: './assets/svg/beamAndBall.svg',
    layers: {
      platform: '#ball-platform',
      ball: '#ball',
    },
    labels: {
      sk: ['Pozícia guličky', 'Uhol tyče (stupne)'],
      en: ['Ball position', 'Rod angle (degrees)'],
    },
    endpoint: 'ball',
    octaveData: {
      x: (value) => value,
      y: (value) => value,
      angle: (value) => radToDeg(value),
    },
    regex: /^-?([0-9]$|^-?[1-9][0-9]$|^-?[1][0-7][0-9]$|^-?[1][8][0])?$/m,
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
    octaveData: {
      x: (value) => value,
      y: (value) => value,
      bodyworkHeight: (value) => value,
    },
    regex: /^-?([0-9](\.\d{0,1})?$|^-?[1][0]{1})?$/m,
  },
  aircraftTilt: {
    svg: './assets/svg/plane.svg',
    layers: {
      body: '#plane-container',
      flap: '#flap',
    },
    labels: {
      sk: ['Náklon lietadla (stupne)', 'Náklon zadnej klapky (stupne)'],
      en: ['Tilt of the aircraft (degrees)', 'Tilt of the rear flap (degrees)'],
    },
    endpoint: 'aircraft',
    octaveData: {
      x: (value) => value,
      y: (value) => radToDeg(value),
      rearFlapAngle: (value) => radToDeg(value),
    },
    regex: /^-?([0](\.([0-4][0-9]?$|[5]?$)?)?)?$/m,
  },
};
