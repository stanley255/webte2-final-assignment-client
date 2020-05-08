import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class BeamAndBall extends Experiment {
  constructor() {
    super(EXPERIMENTS.ballOnStick.svg);
    this.layers = EXPERIMENTS.ballOnStick.layers;
    super.loadObject('ballOnStick');
  }

  async runAnimation(octaveData) {}
}

export default BeamAndBall = BeamAndBall;
