$(document).ready(function () {
  const getBaseUrl = () => {
    return window.location.origin + window.location.pathname;
  };

  const redirect = (param, value) => {
    const baseUrl = getBaseUrl();
    window.location.href = `${baseUrl}${value && '?' + param + '=' + value}`;
  };
});
