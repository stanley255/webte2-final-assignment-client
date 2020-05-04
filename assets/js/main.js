import { setCookie } from './helpers/cookies.js';

const onLanguageChange = (e) => {
  const title = $(e.target).attr('title');
  setCookie('language', title);
};

$('.language-button').each(function () {
  $(this).on('click', onLanguageChange);
});
