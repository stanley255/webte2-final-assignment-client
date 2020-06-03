import { radToDeg } from '../helpers/experiments.js';

class Experiment {
  constructor(path) {
    this.path = path;
  }

  loadObject(experimentName, callback = () => {}) {
    $(`#experiment-visualization-${experimentName}`).load(this.path, callback);
  }

  rotate(layer, angle, offsets) {
    d3.select(layer).attr('transform', function () {
      const x1 =
        this.getBBox().x +
        (!offsets.offsetX
          ? 0
          : offsets.centerX
          ? this.getBBox().width / 2
          : this.getBBox().width);

      const y1 =
        this.getBBox().y +
        (!offsets.offsetY
          ? 0
          : offsets.centerY
          ? this.getBBox().height / 2
          : this.getBBox().height);

      return `rotate(${radToDeg(angle)} ${x1} ${y1})`;
    });
  }

  move(layer, coords) {
    d3.select(layer).attr(
      'transform',
      'translate(' + coords.x + ',' + coords.y + ')'
    );
  }
}

export default Experiment = Experiment;
