import Experiment from './experiment.js';
import EXPERIMENTS from '../helpers/experiments.js';

class Car extends Experiment {
  constructor(timeout) {
    super(EXPERIMENTS.carShockAbsorber.svg);
    this.layers = EXPERIMENTS.carShockAbsorber.layers;
    this.carPosition = {
      x: 0,
      y: 0,
    };
    this.wheelPosition = {
      x: 0,
      y: 0,
    };
    this.timeout = timeout;
    super.loadObject('carShockAbsorber');
  }

  async runAnimation(octaveData) {
    for (let record of octaveData.content) {
      this.moveTierAbsolute(-record.y);
      this.moveCarAbsolute(record.bodyworkHeight);
      await new Promise((r) => setTimeout(r, this.timeout));
    }
  }

  moveTierUp(value) {
    this.moveTierRelative(value > 0 ? -value : value);
  }

  moveTierDown(value) {
    this.moveTierRelative(value < 0 ? -value : value);
  }

  moveTierRelative(value) {
    this.wheelPosition.y += value;
    this.moveTierAbsolute(this.wheelPosition.y);
  }

  moveTierAbsolute(value) {
    this.wheelPosition.y = value;
    super.move(this.layers.wheel, { x: 0, y: this.wheelPosition.y });
  }

  moveCarUp(value) {
    this.moveCarRelative(value > 0 ? -value : value);
  }

  moveCarDown(value) {
    this.moveCarRelative(value < 0 ? -value : value);
  }

  moveCarRelative(value) {
    this.carPosition.y += value;
    this.moveCarAbsolute(this.carPosition.y);
  }

  moveCarAbsolute(value) {
    this.carPosition.y = value;
    super.move(this.layers.body, { x: 0, y: this.carPosition.y });
  }
}

export default Car = Car;
