export const createGraph = (ctx, type, data, options) =>
  new Chart(ctx, {
    type,
    data,
    options,
  });
