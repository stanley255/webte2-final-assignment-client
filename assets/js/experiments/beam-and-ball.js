import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class BeamAndBall extends Experiment {
  constructor() {
    super(EXPERIMENTS.ballOnStick.svg);
    this.layers = EXPERIMENTS.ballOnStick.layers;
    super.loadObject('ballOnStick');
  }

  async runAnimation(octaveData) {
    for (let record of octaveData.content) {
      this.moveBallAbsolute(record.y);
      this.rotatePlatformAbsolute(record.angle);
      await new Promise((r) => setTimeout(r, 50));
    }
  }

  moveBallAbsolute(value) {
    super.move(this.layers.ball, { x: value, y: 0 });
  }

  rotatePlatformAbsolute(angle) {
    super.rotate(this.layers.platform, angle);
  }
}

export default BeamAndBall = BeamAndBall;
