import { radToDeg } from '../helpers/experiments.js';

class Experiment {
  constructor(path) {
    this.path = path;
  }

  loadObject(experimentName) {
    this.parentId = `#experiment-visualization-${experimentName}`;
    $(this.parentId).load(this.path);
  }

  isHidden() {
    return $(this.parentId).hasClass('hidden');
  }

  rotate(layer, angle, offsets) {
    if (this.isHidden()) return;

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
    if (this.isHidden()) return;

    d3.select(layer).attr(
      'transform',
      'translate(' + coords.x + ',' + coords.y + ')'
    );
  }
}

export default Experiment = Experiment;
