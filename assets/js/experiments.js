import { getExperiment } from './helpers/ajax.js';
import { createGraph } from './helpers/graph.js';
import EXPERIMENTS from './helpers/experiments.js';

// EXPERIMENTS
import BeamAndBall from './experiments/beam-and-ball.js';
import Car from './experiments/car.js';
import Pendulum from './experiments/pendulum.js';
import Plane from './experiments/plane.js';

let CURRENT_EXPERIMENT;
let CHART;

const createEmptyLineChart = () => {
  const currExp = getCurrentExperiment();
  const labels = EXPERIMENTS[currExp].labels;
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
    inversePendulum: new Pendulum(),
    ballOnStick: new BeamAndBall(),
    carShockAbsorber: new Car(),
    aircraftTilt: new Plane(),
  };

  return experimentObjectsByName[getCurrentExperiment()];
};

const getCurrentExperiment = () => {
  return $('main').attr('id');
};

const setCurrentExperiment = (experiment) => {
  $(`.${getCurrentExperiment()}`).addClass('hidden');
  $('main').attr({ id: experiment });
  $(`.${getCurrentExperiment()}`).removeClass('hidden');
  initExperiment();
};

const onInputRangeChange = (e) => {
  const { value } = e.target;
  $(`#input-range-label-${getCurrentExperiment()}`).val(value);
};

const onInputRangeRelease = async (e) => {
  const { value } = e.target;
  const octaveData = await getExperiment(
    EXPERIMENTS[getCurrentExperiment()].endpoint,
    value,
    {}
  );

  $(`#input-range-${getCurrentExperiment()}`).prop('disabled', true);

  CHART.destroy();
  CHART = createEmptyLineChart();

  CURRENT_EXPERIMENT.runAnimation(octaveData);
  addDataToPlot(octaveData).then(() => {
    $(`#input-range-${getCurrentExperiment()}`).prop('disabled', false);
    // TODO Allow onlick/onhover after animation
  });
};

const addDataToPlot = async (octaveData) => {
  for (let record of octaveData.content) {
    CHART.data.labels.push(record.x);
    CHART.data.datasets[0].data.push(record.y);
    if (record.bodyworkHeight) {
      CHART.data.datasets[1].data.push(record.bodyworkHeight);
    } else {
      CHART.data.datasets[1].data.push(record.angle);
    }
    await new Promise((r) => setTimeout(r, 50));

    CHART.update();
  }
};

const onInputRangeLabelChange = (e) => {
  const regex = EXPERIMENTS[getCurrentExperiment()].regex;
  let { value } = e.target;

  if (!regex.test(value)) {
    value = value.slice(0, -1);
  }

  $(e.target).val(value);
  $(`#input-range-${getCurrentExperiment()}`).val(value);
};

const initInputRanges = () => {
  $(`#input-range-${getCurrentExperiment()}`)
    .on('input', onInputRangeChange)
    .on('change', onInputRangeRelease);
  $(`#input-range-label-${getCurrentExperiment()}`).on(
    'input',
    onInputRangeLabelChange
  );
};

const initDisableButton = () => {
  $('.experiment-button').each(function () {
    $(this).attr({
      disabled: false,
    });
  });

  $(`#experiment-button-${getCurrentExperiment()}`).attr({
    disabled: true,
  });
};

const initExperiment = () => {
  initDisableButton();
  initInputRanges();
  CURRENT_EXPERIMENT = createExperimentObject();
  CHART = createEmptyLineChart();
};

const initExperimentButtons = () => {
  $('.experiment-button').each(function () {
    $(this).on('click', (e) => setCurrentExperiment($(e.target).attr('name')));
  });
};

initExperimentButtons();
initExperiment();
