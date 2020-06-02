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
      this.rotatePlane(record.y);
      this.rotateFlap(record.rearFlapAngle);
      await new Promise((r) => setTimeout(r, this.timeout));
    }
  }

  rotatePlane(angle) {
    super.rotate(this.layers.body, angle);
  }

  rotateFlap(angle) {
    super.rotate(this.layers.flap, angle, false, true);

    // d3.select('#flap').attr('transform', function () {
    //   const x1 = this.getBBox().x;
    //   const y1 = this.getBBox().y + this.getBBox().height / 2; //the center y about which you want to rotate

    //   return `rotate(${angle * 57.2957795} ${x1} ${y1})`;
    // });
  }
}

export default Plane = Plane;
