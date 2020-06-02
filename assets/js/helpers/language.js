import { getCookie } from './cookies.js';

export const getCurrentLanguage = (defaultLang = 'sk') => {
  const lang = getCookie('language');
  return lang ? lang : defaultLang;
};
