class Plane extends Experiment {

    constructor() {
        super(SVG_PATHS.plane);
        this.layers = LAYERS.plane;
        super.loadObject("aircraftTilt");
    }

    async runAnimation(octaveData) {

    }

    rotatePlane(angle) {
        super.rotate(this.layers.body, angle);
    }

    rotateFlap(angle) {
        super.rotate(this.layers.flap, angle);
    }

}