import { getExperiment } from "./helpers/ajax.js";

let CURRENT_EXPERIMENT;
let CHART;

$( document ).ready(function() {
  CURRENT_EXPERIMENT = createExperimentObject(getCurrentExperiment());
  CHART = createEmptyLineChart(CHARTS_LABELS[getCurrentExperiment()]);
});

const createEmptyLineChart = (labels) => {
  return new Chart(document.getElementById(`line-chart-${getCurrentExperiment()}`), {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        data: [],
        label: labels[0],
        borderColor: "#3e95cd",
        fill: false
      }, {
        data: [],
        label: labels[1],
        borderColor: "#8e5ea2",
        fill: false
      }]},
    options: {
      events: [],
      animation: {
        duration: 0,
      },
      responsiveAnimationDuration: 0,
    }
  });
}

const createExperimentObject = (experimentName) => {
  let experimentObjectsByName = {
    inversePendulum: new Pendulum(),
    ballOnStick: new BeamAndBall(),
    carShockAbsorber: new Car(),
    aircraftTilt: new Plane()
  }
  return experimentObjectsByName[experimentName];
}

const getCurrentExperiment = () => {
  return $('main').attr('id');
};

const setCurrentExperiment = (experiment) => {
  $('main').attr({ id: experiment });
  initInputRanges();
};

const onInputRangeChange = (e) => {
  const { value } = e.target;
  $(`#input-range-label-${getCurrentExperiment()}`).val(value);
};

const onInputRangeRelease = async (e) => {
  const { value } = e.target;
  const octaveData = await getExperiment(NAME_OF_ENDPOINTS[getCurrentExperiment()], value, {});

  $(`#input-range-${getCurrentExperiment()}`).prop( "disabled", true);

  // TODO Clear plot data

  CURRENT_EXPERIMENT.runAnimation(octaveData);
  plotExperiment(octaveData).then(() => {
    $(`#input-range-${getCurrentExperiment()}`).prop("disabled", false);
    // TODO Allow onlick/onhover after animation
  });
}

const plotExperiment = async (octaveData) => {
  for (let record of octaveData.content) {
    CHART.data.labels.push(record.x);
    CHART.data.datasets[0].data.push(record.y);
    CHART.data.datasets[1].data.push(record.bodyworkHeight);
    await new Promise(r => setTimeout(r, 50));
    CHART.update();
  }
}

const onInputRangeLabelChange = (e) => {
  const regex = /^[0](\.\d{0,2})?$|^[1]{1}$/m;
  let { value } = e.target;

  if (!regex.test(value)) {
    value = value.slice(0, -1);
  }

  $(e.target).val(value);
  $(`#input-range-${getCurrentExperiment()}`).val(value);
};

const initInputRanges = () => {
  $(`#input-range-${getCurrentExperiment()}`).on('input', onInputRangeChange).on('change', onInputRangeRelease);
  $(`#input-range-label-${getCurrentExperiment()}`).on(
    'input',
    onInputRangeLabelChange
  );
};

initInputRanges();