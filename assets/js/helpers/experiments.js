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
      body: '#body',
      ballAndStick: '#ball-and-stick',
    },
    labels: ['Pozícia kyvadla', 'Vychýlenie (radiány)'],
    endpoint: 'pendulum',
    regex: /^-?([0-9]$|^-?[1-9][0-9]$|^-?[1][0]{2})?$/m,
  },
  ballOnStick: {
    svg: './assets/svg/beamAndBall.svg',
    layers: {
      platform: '#platform',
      ball: '#ball',
    },
    labels: ['Pozícia guličky', 'Uhol tyče'],
    endpoint: 'ball',
    regex: /^[0](\.\d{0,2})?$|^[1]{1}$/m,
  },
  carShockAbsorber: {
    svg: './assets/svg/car.svg',
    layers: {
      body: '#body',
      wheel: '#wheel',
    },
    labels: ['Výška kolesa', 'Výška auta'],
    endpoint: 'suspension',
    regex: /^[0-9](\.\d{0,1})?$|^[1][0]{1}$/m,
  },
  aircraftTilt: {
    svg: './assets/svg/plane.svg',
    layers: {
      body: '#plane\\ 1',
      flap: '#flap',
    },
    labels: ['Náklon lietadla (radiány)', 'Náklon zadnej klapky (radiány)'],
    endpoint: 'aircraft',
    regex: /^[0](\.\d{0,2})?$|^[1]{1}$/m,
  },
};
