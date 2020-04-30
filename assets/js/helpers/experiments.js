export const experimentColors = {
  aircraftTilt: '#768ca5',
  ballOnStick: '#1A3F69',
  carShockAbsorber: '#FFC733',
  inversePendulum: '#FF5752',
};

export const dictionary = {
  aircraftTilt: {
    sk: 'Náklon lietadla',
    en: 'Aircraft titl',
  },
  ballOnStick: {
    sk: 'Gulička na tyči',
    en: 'Ball on stick',
  },
  carShockAbsorber: {
    sk: 'Tlmič kolesa',
    en: 'Car shock absorber',
  },
  inversePendulum: {
    sk: 'Prevrátené kyvadlo',
    en: 'Inverse pendulum',
  },
};

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
