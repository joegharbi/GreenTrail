// weatherCategory-Icon association
const weatherClassificationIcons = [ 29, 6, 7, 5, 27, 17, 9, 3, 2, 1 ];

setup(300);


async function setup(sleep) {
    await new Promise(r => setTimeout(r, sleep)); // to make sure the DB is loaded
    onInput('worstWeatherToWalk');
    onInput('worstWeatherToBike');
}

function onInput(id) {
    let value = document.getElementById(id).value;
    let indicator = document.getElementById(id + "Indicator");
    indicator.style.left = Number((value - 1) * 10) + "%";
    indicator.innerHTML = `<img src="https://weather.api.here.com/static/weather/icon/${weatherClassificationIcons[value - 1]}.png" />`;
}