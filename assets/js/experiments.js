const getCurrentExperiment = () => {
  return $('main').attr('id');
};

const setCurrentExperiment = (experiment) => {
  $('main').attr({ id: experiment });
  initInputRanges();
};

const onInputRangeChange = (e) => {
  const { value } = e.target;
  $(`#input-range-label-${getCurrentExperiment()}`).val(value);
};

const onInputRangeLabelChange = (e) => {
  const regex = /^[0](\.\d{0,2})?$|^[1]{1}$/m;
  let { value } = e.target;

  if (!regex.test(value)) {
    value = value.slice(0, -1);
  }

  $(e.target).val(value);
  $(`#input-range-${getCurrentExperiment()}`).val(value);
};

const initInputRanges = () => {
  $(`#input-range-${getCurrentExperiment()}`).on('input', onInputRangeChange);
  $(`#input-range-label-${getCurrentExperiment()}`).on(
    'input',
    onInputRangeLabelChange
  );
};

initInputRanges();
