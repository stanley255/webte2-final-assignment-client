import { getExperiment, getLatestInput } from './helpers/ajax.js';
import { createGraph } from './helpers/graph.js';
import { getCurrentLanguage } from './helpers/language.js';
import EXPERIMENTS from './helpers/experiments.js';

// EXPERIMENTS
import BeamAndBall from './experiments/beam-and-ball.js';
import Car from './experiments/car.js';
import Pendulum from './experiments/pendulum.js';
import Plane from './experiments/plane.js';

let CURRENT_EXPERIMENT;
let CHART;
let EXPERIMENT_TIMEOUT;

const createEmptyLineChart = () => {
  const currExp = getCurrentExperiment();
  const labels = EXPERIMENTS[currExp].labels[getCurrentLanguage()];
  const ctx = $(`#line-chart-${currExp}`);

  const graphData = {
    labels: [],
    datasets: [
      {
        data: [],
        label: labels[0],
        borderColor: '#3e95cd',
        fill: false,
      },
      {
        data: [],
        label: labels[1],
        borderColor: '#8e5ea2',
        fill: false,
      },
    ],
  };

  const options = {
    events: [],
    animation: {
      duration: 0,
    },
    responsiveAnimationDuration: 0,
  };

  return createGraph(ctx, 'line', graphData, options);
};

const createExperimentObject = () => {
  let experimentObjectsByName = {
    inversePendulum: new Pendulum(EXPERIMENT_TIMEOUT),
    ballOnStick: new BeamAndBall(EXPERIMENT_TIMEOUT),
    carShockAbsorber: new Car(EXPERIMENT_TIMEOUT),
    aircraftTilt: new Plane(EXPERIMENT_TIMEOUT),
  };

  return experimentObjectsByName[getCurrentExperiment()];
};

const getCurrentExperiment = () => {
  return $('main').attr('id');
};

const setCurrentExperiment = async (experiment) => {
  $(`.${getCurrentExperiment()}`).addClass('hidden');
  $('main').attr({ id: experiment });

  initExperiment();

  // Start loading
  const response = await getLatestInput(getCurrentExperiment());
  if (response.r) {
    CURRENT_EXPERIMENT.runAnimation({
      content: [response.lastPosition]
    });
    onInputRangeChange({ target: { value: response.r } });
  }
  // End loading

  $(`.${getCurrentExperiment()}`).removeClass('hidden');
};

const onInputRangeChange = (e) => {
  const { value } = e.target;
  const regex = EXPERIMENTS[getCurrentExperiment()].regex;

  // if (!regex.test(value)) return;

  $(`#input-range-label-${getCurrentExperiment()}`).val(value);
  $(`#input-range-${getCurrentExperiment()}`).val(value);
};

const onInputRangeRelease = async (e) => {
  const { value } = e.target;
  const octaveData = await getExperiment(
    EXPERIMENTS[getCurrentExperiment()].endpoint,
    value,
    {}
  );

  $(`#input-range-${getCurrentExperiment()}`).prop('disabled', true);
  setDisableToAllButtons(true);

  CHART.destroy();
  CHART = createEmptyLineChart();

  CURRENT_EXPERIMENT.runAnimation(octaveData);

  await addDataToPlot(octaveData);
  $(`#input-range-${getCurrentExperiment()}`).prop('disabled', false);
  setDisableToAllButtons();
};

const addDataToPlot = async (octaveData) => {
  let labels = EXPERIMENTS[getCurrentExperiment()].octaveDataLabels;
  for (let record of octaveData.content) {
    CHART.data.labels.push(record[labels[0]]);
    CHART.data.datasets[0].data.push(record[labels[1]]);
    CHART.data.datasets[1].data.push(record[labels[2]]);
    await new Promise((r) => setTimeout(r, EXPERIMENT_TIMEOUT));

    CHART.update();
  }
};

const onInputRangeLabelChange = (e) => {
  const regex = EXPERIMENTS[getCurrentExperiment()].regex;
  let { value } = e.target;

  // if (!regex.test(value)) {
  //   value = value.slice(0, -1);
  // }

  $(e.target).val(value);
  $(`#input-range-${getCurrentExperiment()}`).val(value);
};

const initInputRanges = () => {
  $('.input-range').each(function () {
    $(this).on('input', onInputRangeChange).on('change', onInputRangeRelease);
  });

  $('.input-range-label').each(function () {
    $(this).on('input', onInputRangeLabelChange);
  });
};

const setDisableToAllButtons = (disabled = false) => {
  $('.experiment-button').each(function () {
    $(this).attr({
      disabled,
    });
  });
};

const initDisableButton = () => {
  setDisableToAllButtons();

  $(`#experiment-button-${getCurrentExperiment()}`).attr({
    disabled: true,
  });
};

const initExperiment = () => {
  initDisableButton();
  CURRENT_EXPERIMENT = createExperimentObject();
  CHART = createEmptyLineChart();
};

const initExperimentButtons = () => {
  $('.experiment-button').each(function () {
    $(this).on('click', (e) => setCurrentExperiment($(e.target).attr('name')));
  });
};

const initExperimentTimeout = () => {
  EXPERIMENT_TIMEOUT = $('#experiment-timeout').val() || 0;
};

initExperimentTimeout();
initExperimentButtons();
initInputRanges();
setCurrentExperiment(getCurrentExperiment());
