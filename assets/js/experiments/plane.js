import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class Plane extends Experiment {
  constructor(timeout = 0) {
    super(EXPERIMENTS.aircraftTilt.svg);
    this.layers = EXPERIMENTS.aircraftTilt.layers;
    this.timeout = timeout;
    this.planeRotationOffsets = {
      offsetX: true,
      offsetY: true,
      centerX: true,
      centerY: true
    }
    this.flapRotationOffsets = {
      offsetX: false,
      offsetY: true,
      centerX: false,
      centerY: true
    }
    super.loadObject('aircraftTilt');
  }

  async runAnimation(octaveData) {
    for (let record of octaveData.content) {
      this.rotatePlane(record.y);
      this.rotateFlap(record.rearFlapAngle);
      await new Promise((r) => setTimeout(r, this.timeout));
    }
  }

  rotatePlane(angle) {
    super.rotate(this.layers.body, angle, this.planeRotationOffsets);
  }

  rotateFlap(angle) {
    super.rotate(this.layers.flap, angle, this.flapRotationOffsets);
  }
}

export default Plane = Plane;
