import { setCookie } from './helpers/cookies.js';

const getBaseUrl = () => {
  return window.location.origin + window.location.pathname;
};

const redirect = (param, value) => {
  const baseUrl = getBaseUrl();
  window.location.href = `${baseUrl}${value && '?' + param + '=' + value}`;
};

const onLanguageChange = (e) => {
  const title = $(e.target).attr('title');
  setCookie('language', title);
};

$('.language-button').each(function () {
  $(this).on('click', onLanguageChange);
});
