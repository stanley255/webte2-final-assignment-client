import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class Plane extends Experiment {
  constructor() {
    super(EXPERIMENTS.aircraftTilt.svg);
    this.layers = EXPERIMENTS.aircraftTilt.layers;
    super.loadObject('aircraftTilt');
  }

  async runAnimation(octaveData) {}

  rotatePlane(angle) {
    super.rotate(this.layers.body, angle);
  }

  rotateFlap(angle) {
    super.rotate(this.layers.flap, angle);
  }
}

export default Plane = Plane;
