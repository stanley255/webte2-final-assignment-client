class Experiment {
  constructor(path) {
    this.path = path;
  }

  loadObject(experimentName) {
    $(`#experiment-visualization-${experimentName}`).load(this.path);
  }

  rotate(layer, angle) {
    $(layer).attr('transform', 'rotate(' + angle + ')');
  }

  move(layer, coords) {
    $(layer).attr('transform', 'translate(' + coords.x + ',' + coords.y + ')');
  }
}

export default Experiment = Experiment;
