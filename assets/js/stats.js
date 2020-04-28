import { getStats } from './helpers/ajax.js';
import { createGraph } from './helpers/graph.js';
import { getCurrentLanguage } from './helpers/language.js';
import { experimentColors, translate, revert } from './helpers/experiments.js';

const parseData = (data, language) =>
  data.reduce((reducer, { experiment, count }) => {
    reducer[translate(language, experiment)] = Number(count);
    return reducer;
  }, {});

const initData = async () => {
  const language = getCurrentLanguage();
  const response = await getStats();

  if (response) return parseData(response, language);
  return null;
};

const initLegend = (data) =>
  Object.entries(data).forEach(([k, v]) => {
    if (v <= 0) return;
    const color = experimentColors[revert(k)];

    const list = $('#chart-legend');

    const item = $('<li></li>');

    const dot = $('<div></div>').appendTo(item);
    $(dot).css({ 'background-color': color });

    const text = $('<span></span>').text(k).appendTo(item);
    $(text).css({ color });

    $(list).append(item);
  });

const initStats = async () => {
  const fetchedData = await initData();
  if (!fetchedData || Object.keys(fetchedData).length === 0) {
    $('#stats').addClass('hidden');
    $('#stats-not-found').removeClass('hidden');
    return;
  }

  const ctx = $('#stats-chart');

  const graphData = {
    labels: Object.keys(fetchedData),
    datasets: [
      {
        label: 'Experiments',
        data: Object.values(fetchedData),
        backgroundColor: Object.keys(fetchedData).map(
          (v) => experimentColors[revert(v)]
        ),
        borderColor: '#f0f0f0',
        borderWidth: 2,
      },
    ],
  };

  const options = {
    responsive: false,
    title: {
      display: false,
    },
    legend: {
      display: false,
    },
  };

  createGraph(ctx, 'pie', graphData, options);
  initLegend(fetchedData);
};

initStats();
