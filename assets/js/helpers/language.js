import { getCookie } from './cookies.js';

export const getCurrentLanguage = () => {
  const lang = getCookie('language');
  return lang ? lang : 'sk';
};
