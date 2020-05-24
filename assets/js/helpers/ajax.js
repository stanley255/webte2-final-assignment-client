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

  const url = `http://52.233.133.56/api/console?api-key=${apiKey.key}`;
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

  const url = `http://52.233.133.56/api/stats?api-key=${apiKey.key}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const sendStatsToEmail = async (sendTo, stats, returnObj = null) => {
  const url = `http://52.233.133.56/client/api/stats.php`;
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

export const getExperiment = async (experiment, r, returnObj = null) => {
  const apiKey = await getApiKey('octave');
  if (!apiKey) return;

  const session = getCookie('PHPSESSID');
  const url = `http://52.233.133.56/api/experiments/${experiment}?r=${r}&session=${session}&api-key=${apiKey.key}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const getLatestInput = async (experiment, returnObj = null) => {
  const apiKey = await getApiKey('octave');
  if (!apiKey) return;

  const session = getCookie('PHPSESSID');
  const url = `http://52.233.133.56/api/logs?experiment=${experiment}&session=${session}&api-key=${apiKey.key}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const getApiKey = async (name, returnObj = null) => {
  const url = `http://52.233.133.56/client/api/api-keys.php?key=${name}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};
