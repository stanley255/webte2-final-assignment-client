import { radToDeg } from '../helpers/experiments.js';

class Experiment {
  constructor(path) {
    this.path = path;
  }

  loadObject(experimentName) {
    $(`#experiment-visualization-${experimentName}`).load(this.path);
  }

  rotate(layer, angle, centerX = false, centerY = false) {
    // $(layer).css({ transform: 'rotate(' + angle + 'rad)' });

    d3.select(layer).attr('transform', function () {
      const x1 = this.getBBox().x + this.getBBox().width / 2; // if false => do not add half of width
      const y1 = this.getBBox().y + this.getBBox().height / 2; // if false => do not add half of height

      return `rotate(${radToDeg(angle)} ${x1} ${y1})`;
    });
  }

  move(layer, coords) {
    // Refactor to d3.js
    $(layer).attr({
      transform: 'translate(' + coords.x + ',' + coords.y + ')',
    });
  }
}

export default Experiment = Experiment;
