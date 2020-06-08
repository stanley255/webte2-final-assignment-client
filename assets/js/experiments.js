import { getExperiment, getLatestInput } from './helpers/ajax.js';
import { createGraph } from './helpers/graph.js';
import { getCurrentLanguage } from './helpers/language.js';
import EXPERIMENTS from './helpers/experiments.js';

EXPERIMENTS;
import BeamAndBall from './experiments/beam-and-ball.js';
import Car from './experiments/car.js';
import Pendulum from './experiments/pendulum.js';
import Plane from './experiments/plane.js';

let CURRENT_EXPERIMENT;
let CHART;
let EXPERIMENT_TIMEOUT;
let EXPERIMENT_OBJECTS;

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
  return EXPERIMENT_OBJECTS[getCurrentExperiment()];
};

const getCurrentExperiment = () => {
  return $('main').attr('id');
};

const setCurrentExperiment = async (experiment) => {
  $(`.${getCurrentExperiment()}`).addClass('hidden');
  $('main').attr({ id: experiment });

  initExperiment();

  const response = await getLatestInput(getCurrentExperiment());
  $(`.${getCurrentExperiment()}`).removeClass('hidden');

  if (response.r) {
    CURRENT_EXPERIMENT.runAnimation({
      content: [response.lastPosition],
    });

    onInputRangeChange({ target: { value: response.r } });
  }
};

const onInputRangeChange = (e) => {
  const { value } = e.target;
  const regex = EXPERIMENTS[getCurrentExperiment()].regex;

  if (!regex.test(value)) return;

  $(`#input-range-label-${getCurrentExperiment()}`).val(value);
  $(`#input-range-${getCurrentExperiment()}`).val(value);
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

const setDisableToCurrentInputRange = (disabled) => {
  $(`#input-range-${getCurrentExperiment()}`).prop({ disabled });
  $(`#input-range-label-${getCurrentExperiment()}`).prop({ disabled });
};

const isCurrentInputRangeDisabled = () => {
  return $(`#input-range-${getCurrentExperiment()}`).prop('disabled');
};

const setHiddenToSpinner = (hidden) => {
  if (hidden) $('#spinner').addClass('hidden');
  else $('#spinner').removeClass('hidden');
};

const onRunExperimentAnimation = async () => {
  if (isCurrentInputRangeDisabled()) return;

  const value = $(`#input-range-${getCurrentExperiment()}`).val();

  setHiddenToSpinner(false);
  const octaveData = await getExperiment(
    EXPERIMENTS[getCurrentExperiment()].endpoint,
    value,
    {}
  );

  setDisableToCurrentInputRange(true);
  setDisableToAllButtons(true);

  CHART.destroy();
  CHART = createEmptyLineChart();
  setHiddenToSpinner(true);

  CURRENT_EXPERIMENT.runAnimation(octaveData);

  await addDataToPlot(octaveData);
  setDisableToCurrentInputRange(false);
  setDisableToAllButtons(false);
};

const addDataToPlot = async (octaveData) => {
  let modifiers = EXPERIMENTS[getCurrentExperiment()].octaveData;
  for (let record of octaveData.content) {
    Object.entries(modifiers).forEach(([key, value], i) => {
      if (i === 0) {
        CHART.data.labels.push(value(record[key]));
      } else {
        CHART.data.datasets[i - 1].data.push(value(record[key]));
      }
    });
    await new Promise((r) => setTimeout(r, EXPERIMENT_TIMEOUT));

    CHART.update();
  }
};

const initInputRanges = () => {
  $('.input-range').each(function () {
    $(this)
      .on('input', onInputRangeChange)
      .on('change', onRunExperimentAnimation);
  });

  $('.input-range-label').each(function () {
    $(this)
      .on('input', onInputRangeLabelChange)
      .on('keyup', (e) => {
        if (e.keyCode === 13) {
          onRunExperimentAnimation();
        }
      });
  });
};

const setDisableToAllButtons = (disabled) => {
  $('.experiment-button').each(function () {
    $(this).attr({
      disabled,
    });
  });
};

const initDisableButton = () => {
  setDisableToAllButtons(false);

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

const initExperimentCheckboxes = () => {
  $('.checkbox').each(function () {
    $(this).on('change', (e) => {
      const status = $(e.target).prop('checked');
      let globalStatus = true;
      const targetId = $(e.target).val();
      const parent = $(e.target).closest('.checkbox-container');

      $(parent)
        .find('input')
        .each(function () {
          globalStatus =
            globalStatus === false ? false : $(this).prop('checked');
        });

      if (status) $(`#${targetId}`).removeClass('hidden');
      else $(`#${targetId}`).addClass('hidden');

      if (globalStatus)
        $(`#parent-container-${getCurrentExperiment()}`).removeClass(
          'one-item'
        );
      else
        $(`#parent-container-${getCurrentExperiment()}`).addClass('one-item');
    });
  });
};

const initExperimentTimeout = () => {
  EXPERIMENT_TIMEOUT = $('#experiment-timeout').val() || 0;
};

const initExperimentObjects = () => {
  EXPERIMENT_OBJECTS = {
    inversePendulum: new Pendulum(EXPERIMENT_TIMEOUT),
    ballOnStick: new BeamAndBall(EXPERIMENT_TIMEOUT),
    carShockAbsorber: new Car(EXPERIMENT_TIMEOUT),
    aircraftTilt: new Plane(EXPERIMENT_TIMEOUT),
  };
};

initExperimentTimeout();
initExperimentButtons();
initExperimentCheckboxes();
initExperimentObjects();
initInputRanges();
setCurrentExperiment(getCurrentExperiment());
