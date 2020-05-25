import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class Plane extends Experiment {
  constructor(timeout = 0) {
    super(EXPERIMENTS.aircraftTilt.svg);
    this.layers = EXPERIMENTS.aircraftTilt.layers;
    this.timeout = timeout;
    super.loadObject('aircraftTilt');
  }

  async runAnimation(octaveData) {
    for (let record of octaveData.content) {
      console.log(record);
      this.rotatePlane(record.y);
      this.rotateFlap(record.rearFlapAngle);
      await new Promise((r) => setTimeout(r, this.timeout));
    }
  }

  rotatePlane(angle) {
    super.rotate(this.layers.body, angle);
  }

  rotateFlap(angle) {
    super.rotate(this.layers.flap, angle);
  }
}

export default Plane = Plane;
