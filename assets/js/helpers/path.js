export const getBaseUrl = () => {
  return window.location.origin + window.location.pathname;
};

export const redirect = (param, value) => {
  const baseUrl = getBaseUrl();
  if (param && value)
    window.location.href = `${baseUrl}${value && '?' + param + '=' + value}`;
  else window.location.href = `${baseUrl}`;
};
