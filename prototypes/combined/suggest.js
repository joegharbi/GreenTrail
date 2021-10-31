// Global constants
const weatherClassifications = [
/*1*/   ['strong_thunderstorms', 'severe_thunderstorms', 'tornado', 'hurricane'],
/*2*/   ['tstorms_late', 'tstorms', 'thunderstorms', 'tstorms_early', 'night_tstorms', 'tropical_storm',  'sandstorm', 'duststorm', 'snowstorm', 'blizzard'],
/*3*/   ['heavy_rain_early', 'isolated_tstorms_late', 'scattered_tstorms_late', 'thundershowers', 'widely_scattered_tstorms', 'isolated_tstorms', 'a_few_tstorms', 'scattered_tstorms', 'night_widely_scattered_tstorms', 'night_isolated_tstorms', 'night_a_few_tstorms', 'night_scattered_tstorms', 'hail', 'icy_mix', 'heavy_mixture_of_precip', 'icy_mix_early', 'icy_mix_late', 'freezing_rain', 'heavy_rain', 'lots_of_rain', 'tons_of_rain', 'heavy_rain_early', 'heavy_rain_late', 'flood', 'heavy_snow', 'heavy_snow_early', 'heavy_snow_late'],
/*4*/   ['rain_early', 'ice_fog', 'rain_showers', 'showers', 'sleet', 'mixture_of_precip', 'snow_changing_to_rain', 'snow_changing_to_an_icy_mix', 'an_icy_mix_changing_to_snow', 'an_icy_mix_changing_to_rain', 'rain_changing_to_snow', 'rain_changing_to_an_icy_mix', 'light_icy_mix_early', 'light_icy_mix_late', 'snow_rain_mix', 'snow_flurries', 'snow_showers', 'flurries_early', 'snow_showers_early', 'flurries_late', 'snow_showers_late', 'night_rain_showers', 'night_showers', 'light_freezing_rain', 'flash_floods', 'rain', 'numerous_showers', 'showery', 'showers_early', 'rain_early', 'showers_late', 'rain_late', 'snow', 'moderate_snow', 'snow_early', 'snow_late'],
/*5*/   ['scattered_showers', 'a_few_showers', 'light_showers', 'passing_showers', 'smoke', 'dense_fog', 'night_smoke', 'light_mixture_of_precip', 'scattered_flurries', 'light_snow_showers', 'light_snow', 'light_snow_early', 'light_snow_late', 'night_scattered_showers', 'night_a_few_showers', 'night_light_showers', 'night_passing_showers', 'night_sprinkles', 'drizzle', 'sprinkles', 'light_rain', 'sprinkles_early', 'light_rain_early', 'sprinkles_late', 'light_rain_late'],
/*6*/   ['high_level_clouds', 'increasing_cloudiness', 'high_clouds', 'more_clouds_than_sun', 'haze', 'night_haze', 'early_fog', 'fog', 'mostly_cloudy', 'cloudy', 'overcast', 'night_high_level_clouds', 'night_high_clouds', 'increasing_cloudiness', 'night_mostly_cloudy'],
/*7*/   ['a_mixture_of_sun_and_clouds', 'breaks_of_sun_late', 'afternoon_clouds', 'morning_clouds', 'partly_sunny', 'decreasing_cloudiness', 'broken_clouds', 'hazy_sunshine', 'low_level_haze', 'early_fog_followed_by_sunny_skies', 'light_fog', 'night_low_level_haze', 'night_decreasing_cloudiness', 'night_afternoon_clouds', 'night_morning_clouds', 'night_broken_clouds'],
/*8*/   ['passing_clouds', 'more_sun_than_clouds', 'scattered_clouds', 'partly_cloudy', 'clearing_skies', 'low_clouds', 'night_clearing_skies', 'night_passing_clouds', 'night_scattered_clouds', 'night_partly_cloudy'],
/*9*/   ['mostly_sunny', 'mostly_clear', 'night_mostly_clear'],
/*10*/  ['sunny', 'clear', 'night_clear']
];
const weatherClassificationIcons = [ 29, 6, 7, 5, 27, 17, 9, 3, 2, 1 ];
const carCO2EmissionPerKm = 122; // [g]
const busCO2EmissionPerPersonPerKm = 50; // [g]
const kcalBurntByWalk = 50; // [kcal/km]
const kcalBurntByBike = 30; // [kcal/km]
const trafficStates = [
    {
        name: 'very low',
        color: '#0392CF',
        lower_bound: 0,
        upper_bound: 1.2
    },
    {
        name: 'low',
        color: '#008744',
        lower_bound: 1.2,
        upper_bound: 1.5
    },
    {
        name: 'medium',
        color: '#FFCC5C',
        lower_bound: 1.5,
        upper_bound: 2.0
    },
    {
        name: 'high',
        color: '#F37736',
        lower_bound: 2.0,
        upper_bound: 3.0
    },
    {
        name: 'very high',
        color: '#EE4035',
        lower_bound: 3.0,
        upper_bound: 999
    }
];

// User Data
let walkSpeed = 1.5; // [m/s]
let maxWalkDistance = 2000; // [m]
let maxBikeDistance = 4000; // [m]
let worstWeatherToWalk = 6;
let worstWeatherToBike = 6;


// UI elements for displaying results
let weatherImg = document.getElementById('weatherImg');
let weatherDesc = document.getElementById('weatherDesc');
let trafficState = document.getElementById('trafficState');
let suggestionTable = document.getElementById('suggestionTable');

// States
let weatherCat;
let trafficStateInd;
let vehicles = {
    car: {
        name: 'Car',
        color: 'rgba(204, 37, 41, 0.7)',
        available: true,
        data: {}
    },
    pt: {
        name: 'Public Transport',
        color: 'rgba(62, 180, 81, 0.7)',
        available: true,
        data: {}
    },
    bike: {
        name: 'Bike',
        color: 'rgba(57, 106, 177, 0.7)',
        available: true,
        data: {}
    },
    walk: {
        name: 'Walking',
        color: 'rgba(107, 76, 154, 0.7)',
        available: true,
        data: {}
    }
};


// Functions
function getWeatherCategory(iconName) {
    let index = weatherClassifications.findIndex(category => category.includes(iconName));
    return index == undefined ? 5 : index + 1;
}

function getIconForWeatherCategory(category) {
    return `https://weather.api.here.com/static/weather/icon/${weatherClassificationIcons[category - 1]}.png`
}


function suggest() {
    let order = [vehicles.car];
    if (vehicles.pt.available &&
        (trafficStateInd > 2 || // high or very high
        vehicles.car.data.duration > vehicles.pt.data.duration)){
        order.unshift(vehicles.pt);
    } else {
        order.push(vehicles.pt);
    }
    vehicles.bike.available ? order.unshift(vehicles.bike) : order.push(vehicles.bike);
    vehicles.walk.available ? order.unshift(vehicles.walk) : order.push(vehicles.walk);

    displaySuggestions(order);
}


function displaySuggestions(order) {
    let tableContent = '<table>';
    tableContent += tableHeader();
    for (let i = 0; i < order.length; ++i) {
        tableContent += tableRow(i + 1, order[i]);
    }
    tableContent += '</table>';
    suggestionTable.innerHTML = tableContent;
}


let readyVehicle = 0;
function vehicleReady() {
    readyVehicle++;
    if (readyVehicle == 4) {
        suggest();
    }
}


function processCarRoute(result) {
    let route = result.routes[0];
    trafficStateInd = calcTrafficState(route);
    trafficState.innerHTML =
        `<b>The traffic is: <i style="color: ${trafficStates[trafficStateInd].color}">${trafficStates[trafficStateInd].name}</i></b>`;

    let routeData = calcLengthAndDuration(route);
    vehicles.car.data = {
        length: routeData[0],
        duration: routeData[1],
        emission: Math.floor(routeData[0] * carCO2EmissionPerKm / 1000) / 1000,
        kcal: 0
    }
}


function processPTRoute(result) {
    if (result.routes.length == 0) {
        vehicles.pt.available = false;
        vehicles.pt.data = {
            reason: 'Not available in this route'
        }
        return;
    }

    let route = result.routes[0];
    let routeData = calcLengthAndDuration(route);

    let emission = 0;
    route.sections.forEach((section) => {
        if (section.type == 'transit' && ['bus', 'privateBus', 'busRapid'].includes(section.transport.mode)) {
            emission += section.travelSummary.length * busCO2EmissionPerPersonPerKm / 1000; 
        }
    });

    let kcal = 0;
    route.sections.forEach((section) => {
        if (section.type == 'pedestrian') {
            kcal += section.travelSummary.length * kcalBurntByWalk / 1000; 
        }
    });

    vehicles.pt.data = {
        length: routeData[0],
        duration: routeData[1],
        emission: Math.round(emission) / 1000,
        kcal: kcal
    }
}


function processBikeRoute(result) {
    if (result.routes.length == 0) {
        vehicles.bike.available = false;
        vehicles.bike.data = {
            reason: 'Not available in this route'
        }
        return;
    }

    let route = result.routes[0];
    let routeData = calcLengthAndDuration(route);
    let bikeReason = canUseBike(routeData[0]);
    vehicles.bike.available = (bikeReason == 'can');
    vehicles.bike.data = {
        reason: bikeReason,
        length: routeData[0],
        duration: routeData[1],
        emission: 0,
        kcal: routeData[0] * kcalBurntByBike / 1000
    }
}


function processWalkRoute(result) {
    if (result.routes.length == 0) {
        vehicles.walk.available = false;
        vehicles.walk.data = {
            reason: 'Not available in this route'
        }
        return;
    }

    let route = result.routes[0];
    let routeData = calcLengthAndDuration(route);
    let walkReason = canWalk(routeData[0]);
    vehicles.walk.available = (walkReason == 'can');
    vehicles.walk.data = {
        reason: walkReason,
        length: routeData[0],
        duration: routeData[1],
        emission: 0,
        kcal: routeData[0] * kcalBurntByWalk / 1000
    }
}


function processWeather(observation) {
    weatherCat = getWeatherCategory(observation.iconName);
    weatherDesc.innerHTML = '<b>The weather is: <i>' + observation.description + '</i></b> [' +
        formatTemperature(observation.temperature) + ' C°, Category: ' + weatherCat + ']';
    weatherImg.innerHTML = '<img src="' + observation.iconLink + '"/>';
}


function formatTemperature(tempStr) {
    return Math.round(parseFloat(tempStr) * 10) / 10;
}


function calcLengthAndDuration(route) {
    let length = 0; // [m]
    let duration = 0; // [s]
    route.sections.forEach((section) => {
        length += section.travelSummary.length;
        duration += section.travelSummary.duration;
    });

    return [length, duration];
}


function calcTrafficState(route) {
    let realDuration = 0, fastestDuration = 0;
    
    route.sections.forEach((section) => {
        section.spans.forEach((span) => {
            fastestDuration += span.length / span.speedLimit;
        });

        realDuration += section.travelSummary.duration;
    });

    let ratio = realDuration / fastestDuration;
    for (let i = 0; i < trafficStates.length; ++i) {
        if (ratio < trafficStates[i].upper_bound) {
            return i;
        }
    }

    return 2;
}


function canUseBike(length) {
    return canUse(length, worstWeatherToBike, maxBikeDistance);
}


function canWalk(length) {
    return canUse(length, worstWeatherToWalk, maxWalkDistance);
}


function canUse(length, worstWeather, maxLength) {
    if (weatherCat < worstWeather) {
        return 'The weather is too bad';
    }

    if (length > maxLength) {
        return 'Too long distance';
    }

    return 'can';
}


function tableHeader() {
    return '<tr><th>Suggestion</th><th>Description</th><th>Emission reduced</th><th>Calories burnt</th></tr>';
}


function tableRow(ind, vehicle) {
    if (!vehicle.available) {
        return `<tr style="color: ${vehicle.color}"><td><i>${ind}. ${vehicle.name}</i></td><td><i>` +
            `${vehicle.data.reason}</i></td><td><i>---</i></td><td><i>---</i></td>`;
    }

    return `<tr style="color: ${vehicle.color}"><td><b>${ind}. ${vehicle.name}</b></td><td>${formatTime(vehicle.data.duration)}<br>` +
        `${Math.floor(vehicle.data.length / 10) / 100} km</td><td>${vehicles.car.data.emission - vehicle.data.emission} kg</td>` +
        `<td>${Math.floor(vehicle.data.kcal)} kcal</td></tr>`;
}


function formatTime(time) {
    let hours = Math.floor(time / 3600);
    let minutes = Math.floor(time / 60) - hours * 60;
    let seconds = time % 60;
    let minutesPadding = (minutes < 10) ? '0' : '';
    let secondsPadding = (seconds < 10) ? '0' : '';
    return `${hours}:${minutesPadding}${minutes}:${secondsPadding}${seconds}`;
}