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
  const url = 'http://147.175.121.210:8043/api/console';

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
  const url = 'http://147.175.121.210:8043/api/stats';

  try {
    const response = await ajaxRequest('GET', url);
    return response;
  } catch (error) {
    return returnObj;
  }
};
