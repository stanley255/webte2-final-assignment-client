const SVG_PATHS = {
    plane: "./assets/svg/plane.svg",
    pendulum: "./assets/svg/pendulum.svg",
    beamAndBall: "./assets/svg/beamAndBall.svg",
    car: "./assets/svg/car_new.svg"
}

const LAYERS = {
    plane: {
        body: "#plane\\ 1",
        flap: "#flap"
    },
    pendulum: {
        body: "#body",
        ballAndStick: "#ball-and-stick"
    },
    beamAndBall: {
        platform: "#platform",
        ball: "#ball"
    },
    car: {
        body: "#body",
        wheel: "#wheel"
    }
}

const CHARTS_LABELS = {
    inversePendulum: [
        "Pozícia kyvadla",
        "Vychýlenie (radiány)"
    ],
    ballOnStick: [
        "Pozícia guličky",
        "Uhol tyče"
    ],
    carShockAbsorber: [
        "Výška kolesa",
        "Výška auta"
    ],
    aircraftTilt: [
        "Náklon lietadla (radiány)",
        "Náklon zadnej klapky (radiány)"
    ]
}

const NAME_OF_ENDPOINTS = {
    inversePendulum: "pendulum",
    ballOnStick : "ball",
    carShockAbsorber: "suspension",
    aircraftTilt: "aircraft"
}