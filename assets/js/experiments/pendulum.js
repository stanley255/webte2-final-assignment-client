import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class Pendulum extends Experiment {
  constructor(timeout = 0) {
    super(EXPERIMENTS.inversePendulum.svg);
    this.layers = EXPERIMENTS.inversePendulum.layers;
    this.basePosition = {
      x: 0,
      y: 0,
    };
    this.segmentStep = 0;
    this.angle = 0;
    this.timeout = timeout;
    this.rotationOffsets = {
      offsetX: true,
      offsetY: true,
      centerX: true,
      centerY: false,
    };
    super.loadObject('inversePendulum');
  }

  async runAnimation(octaveData) {
    for (let record of octaveData.content) {
      this.moveBaseAbsolute(record.y);
      this.rotateBallAndStickAbsolute(record.angle);
      await new Promise((r) => setTimeout(r, this.timeout));
    }
  }

  rotateBallAndStickAbsolute(value) {
    this.angle = -value;
    super.rotate(this.layers.ballAndStick, this.angle, this.rotationOffsets);
  }

  setSegmentStep(constant = 40) {
    // warning !!! viewbox
    const platform = d3.select(this.layers.platform).node();
    const width = platform.getBoundingClientRect().width;
    this.segmentStep = width / constant;
  }

  moveBaseAbsolute(value) {
    this.setSegmentStep();
    this.basePosition.x = value * this.segmentStep;

    super.move(this.layers.body, {
      x: this.basePosition.x,
      y: 0,
    });
  }

  registerEvents = () => {
    window.onresize = this.setSegmentStep;
  };
}

export default Pendulum = Pendulum;
