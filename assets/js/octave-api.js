const onArrowClick = (e) => {
  const id = $(e.target).attr('id').split('-').pop();
  $(e.target).toggleClass('icon-rot-180');

  if ($(`#text-response-${id}`).hasClass('slide-down')) {
    $(`#text-response-${id}`).removeClass('slide-down');
    $(`#text-response-${id}`).addClass('slide-up');
  } else {
    $(`#text-response-${id}`).removeClass('slide-up');
    $(`#text-response-${id}`).addClass('slide-down');
  }
};

$('.icon-arrow').each(function () {
  $(this).on('click', onArrowClick);
});
