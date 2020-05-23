import { setCookie } from './helpers/cookies.js';

const onLanguageChange = (e) => {
  const title = $(e.target).attr('title');
  setCookie('language', title);
};

const onNavigationToggle = () => {
  $('#navigation').css('display', (i, value) => {
    if (value === 'none') return 'flex';
    return 'none';
  });
};

$('#menu-button').on('click', onNavigationToggle);

$('.language-button').each(function () {
  $(this).on('click', onLanguageChange);
});
