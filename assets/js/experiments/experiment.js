class Experiment {
  constructor(path) {
    this.path = path;
  }

  loadObject(experimentName) {
    $(`#experiment-visualization-${experimentName}`).load(this.path);
  }

  rotate(layer, angle) {
    $(layer).css({ transform: 'rotate(' + angle + 'rad)' });
  }

  move(layer, coords) {
    $(layer).attr({
      transform: 'translate(' + coords.x + ',' + coords.y + ')',
    });
  }
}

export default Experiment = Experiment;
