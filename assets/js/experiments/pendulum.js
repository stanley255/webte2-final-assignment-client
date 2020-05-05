class Pendulum extends Experiment {

    constructor() {
        super(SVG_PATHS.pendulum);
        this.layers = LAYERS.pendulum;
        this.basePosition = {
            x: 0,
            y: 0
        }
        this.angle = 0;
        // $(this.layers.ballAndStick).css("transform-origin", "15px 0px");
        super.loadObject("inversePendulum");
    }

    async runAnimation(octaveData) {
        for (let record of octaveData.content) {
            this.moveBaseAbsolute(record.y)
            // this.rotateBallAndStickAbsolute(record.angle);
            await new Promise(r => setTimeout(r, 50));
        }
    }

    rotateBallAndStickAbsolute(value) {
        this.angle = value;
        super.rotate(this.layers.ballAndStick, value);
    }

    moveBaseAbsolute(value) {
        this.basePosition.x = value;
        super.move(this.layers.body, {x:this.basePosition.x, y:0});
    }

}