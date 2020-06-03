import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class BeamAndBall extends Experiment {
  constructor(timeout = 0) {
    super(EXPERIMENTS.ballOnStick.svg);
    this.layers = EXPERIMENTS.ballOnStick.layers;
    this.timeout = timeout;
    this.rotationOffsets = {
      offsetX: true,
      offsetY: true,
      centerX: true,
      centerY: true
    }
    super.loadObject('ballOnStick');
  }

  async runAnimation(octaveData) {
    for (let record of octaveData.content) {
      this.moveBallAbsolute(record.y);
      this.rotatePlatformAbsolute(record.angle);
      await new Promise((r) => setTimeout(r, this.timeout));
    }
  }

  moveBallAbsolute(value) {
    super.move(this.layers.ball, { x: value, y: 0 });
  }

  rotatePlatformAbsolute(angle) {
    super.rotate(this.layers.platform, angle, this.rotationOffsets);
  }
}

export default BeamAndBall = BeamAndBall;
