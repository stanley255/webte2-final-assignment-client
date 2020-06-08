import { getCookie } from './cookies.js';

const OCTAVE_API_URL = 'https://wt43.fei.stuba.sk:4443/api';
const CLIENT_API_URL = 'https://wt43.fei.stuba.sk:4443/client/api';

export const ajaxRequest = async (type, url, data = {}, timeout = 3000) => {
  return $.ajax({
    type,
    url,
    dataType: 'json',
    data,
    timeout,
  });
};

export const sendCommand = async (command, returnObj = null) => {
  const apiKey = await getApiKey('octave');
  if (!apiKey) return;

  const url = `${OCTAVE_API_URL}/console?api-key=${apiKey.key}`;
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

  const url = `${OCTAVE_API_URL}/stats?api-key=${apiKey.key}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const getExperiment = async (experiment, r, returnObj = null) => {
  const apiKey = await getApiKey('octave');
  if (!apiKey) return;

  const session = getCookie('PHPSESSID');
  const url = `${OCTAVE_API_URL}/experiments/${experiment}?r=${r}&session=${session}&api-key=${apiKey.key}`;

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
  const url = `${OCTAVE_API_URL}/logs?experiment=${experiment}&session=${session}&api-key=${apiKey.key}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const sendStatsToEmail = async (sendTo, stats, returnObj = null) => {
  const url = `${CLIENT_API_URL}/stats.php`;
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
  const url = `${CLIENT_API_URL}/api-keys.php?key=${name}`;

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};
