class BeamAndBall extends Experiment {

    constructor() {
        super(SVG_PATHS.beamAndBall);
        this.layers = LAYERS.beamAndBall;
        super.loadObject("ballOnStick");
    }

    async runAnimation(octaveData) {

    }

}