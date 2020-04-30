import { getCookie } from './cookies.js';

export const ajaxRequest = async (type, url, headers = {}, data = {}) => {
  return $.ajax({
    type,
    url,
    dataType: 'json',
    headers,
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
  const headers = {
    'api-key': '51b1144a-b7a2-47c1-a6c5-f15330213465',
  };

  try {
    const response = await ajaxRequest('POST', url, headers, data);
    return response;
  } catch (error) {
    return returnObj;
  }
};

export const getStats = async (returnObj = null) => {
  const url = 'http://147.175.121.210:8043/api/stats';
  const headers = {
    'api-key': '51b1144a-b7a2-47c1-a6c5-f15330213465',
  };

  try {
    const response = await ajaxRequest('GET', url, headers);
    return response;
  } catch (error) {
    return returnObj;
  }
};
