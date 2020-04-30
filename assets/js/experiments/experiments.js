const onInputRangeChange = (e) => {
  const { value } = e.target;
  $('#input-range-label').val(value);
};

const onInputRangeLabelChange = (e) => {
  const regex = /^[0](\.\d{0,2})?$|^[1]{1}$/m;
  let { value } = e.target;

  if (!regex.test(value)) {
    value = value.slice(0, -1);
  }

  $(e.target).val(value);
  $('#input-range').val(value);
};

$('#input-range').on('input', onInputRangeChange);
$('#input-range-label').on('input', onInputRangeLabelChange);
