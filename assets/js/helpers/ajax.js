import { getCookie } from './cookies.js';

export const ajaxRequest = async (type, url, data = {}) => {
  return $.ajax({
    type,
    url,
    dataType: 'json',
    data,
  });
};

export const sendCommand = async (command, returnObj = null) => {
  const apiKey = await getApiKey('octave');
  if (!apiKey) return;

  const url = `http://147.175.121.210:8043/api/console?api-key=${apiKey.key}`;
  const session = getCookie('PHPSESSID');
  const data = {
    session,
    command,
  };

  try {
    const response = await ajaxRequest('POST', url, data);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const getStats = async (returnObj = null) => {
  const apiKey = await getApiKey('octave');
  if (!apiKey) return;

  const url = `http://147.175.121.210:8043/api/stats?api-key=${apiKey.key}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const sendStatsToEmail = async (sendTo, stats, returnObj = null) => {
  const url = `http://147.175.121.210:8057/xzadanie-finalx/api/stats.php`;
  const data = {
    content: stats,
    email_to: sendTo,
  };

  try {
    const response = await ajaxRequest('POST', url, data);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const getApiKey = async (name, returnObj = null) => {
  const url = `http://147.175.121.210:8057/xzadanie-finalx/api/api-keys.php?key=${name}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};
