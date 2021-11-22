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

const urlParams = new URLSearchParams(window.location.search);
const fromLoc = {
    lat: urlParams.get('from_lat'),
    lng: urlParams.get('from_lng')
};
const toLoc = {
    lat: urlParams.get('to_lat'),
    lng: urlParams.get('to_lng')
};

let trafficState = document.getElementById('trafficState');
let suggestionTable = document.getElementById('suggestionTable');

// States
let weatherCat = getWeatherCategory(getWeatherType());
let trafficStateInd;
let vehicles = {
    car: {
        name: 'Car',
        class: 'car-box',
        icon: 'car.svg',
        available: true,
        data: {}
    },
    pt: {
        name: 'Public Transport',
        class: 'pt-box',
        icon: 'pt.svg',
        available: true,
        data: {}
    },
    bike: {
        name: 'Bike',
        class: 'bike-box',
        icon: 'bike.svg',
        available: true,
        data: {}
    },
    walk: {
        name: 'Walking',
        class: 'walk-box',
        icon: 'walk.svg',
        available: true,
        data: {}
    }
};

initMap(main);


function main() {
    addMarker(fromLoc);
    addMarker(toLoc);
    routeNormalVehicle(fromLoc, toLoc, 'car', processCarRoute, 'rgba(204, 37, 41, 0.7)');
    routeNormalVehicle(fromLoc, toLoc, 'bicycle', processBikeRoute, 'rgba(57, 106, 177, 0.7)');
    routeNormalVehicle(fromLoc, toLoc, 'pedestrian', processWalkRoute, 'rgba(107, 76, 154, 0.7)');
    routePT(fromLoc, toLoc, processPTRoute, 'rgba(62, 180, 81, 0.7)');
}

  
// Functions
function getWeatherCategory(iconName) {
    let index = weatherClassifications.findIndex(category => category.includes(iconName));
    return index == undefined ? 5 : index + 1;
}


let readyVehicle = 0;
function vehicleReady() {
    readyVehicle++;
    if (readyVehicle == 4) {
        suggest();
    }
}


function suggest() {
    console.log(vehicles);
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
    let tableContent = displayTitle('Our suggestion');
    tableContent += displaySuggestion(order[0]);
    if (order[1].available) {
        tableContent += displayTitle('Alternatives');
        for (let i = 1; i < order.length; ++i) {
            if (order[i].available) {
                tableContent += displaySuggestion(order[i]);
            }
        }
    }
    suggestionTable.innerHTML = tableContent;
}


function displaySuggestion(vehicle) {
    let button;
    if (vehicle.name == 'Car') {
        button = `<button class="btn btn-warning" onclick="onTransportChoose('${vehicle.name}', 0)"><b>Use car</b></button>`;
    } else {
        let emissionReduction = vehicles.car.data.emission - vehicle.data.emission;
        button = `<button class="btn btn-success btn-sm" onclick="onTransportChoose('${vehicle.name}', ${emissionReduction})"><b>Reduce emission by ${formatEmission(emissionReduction)}</b>`;
    }
    return `<div class="row m-2 align-items-center rounded ${vehicle.class}">
        <div class="col-1 col-md-2 col-lg-1 p-2 m-0">
            <img src="${getSVGFolder()}/${vehicle.icon}" />
        </div>
        <div class="col-7 col-md-6 col-lg-7 p-2 text-center">
            <b>${vehicle.name}</b><br>
            <hr class="p-0 m-0">
            ${formatTime(vehicle.data.duration)} ${formatLength(vehicle.data.length)}
        </div>
        <div class="col-4 p-2 d-grid gap-2">${button}</div>
    </div>`
    ;
}


function displayTitle(title) {
    return `<div class="row m-2"><div class="col-12 text-center h6 m-0 p-0">${title}</div></div>`;
}


function onTransportChoose(vehicle, emissionReductionKG) {
    let userID = getUserID();
    if (userID) {
        fetch(getChosenTransport_URL(), {
            method: 'post',
            body: JSON.stringify({
                    _token: getCSRF_Token(),
                    user_id: userID,
                    source: document.getElementById('from').innerText,
                    destination: document.getElementById('to').innerText,
                    chosen_transportation: vehicle,
                    reduced_emission: Math.round(emissionReductionKG * 1000)
            }),
            headers: {
                'X-CSRF-TOKEN': getCSRF_Token(),
                'Content-Type': 'application/json'
            }
        })
            .then(response => { return response.text(); })
            .then(response => { ckeckDBResponse(response, vehicle == 'Bike'); })
            .catch(error => alert(error.message));
    } else {
        ckeckDBResponse('No logged in user', vehicle == 'Bike');
    }
}


function ckeckDBResponse(response, isBike) {
    console.log(response);
    if (isBike) {
        window.location.href = `${getHome_URL()}/bubi?lat=${fromLoc.lat}&lng=${fromLoc.lng}&n=8`;
    } else {
        window.location.href = getHome_URL();
    }
}


function processCarRoute(result) {
    let route = result.routes[0];
    trafficStateInd = calcTrafficState(route);
    trafficState.innerHTML = `<i style="color: ${trafficStates[trafficStateInd].color}">${trafficStates[trafficStateInd].name}</i>`;

    let routeData = calcLengthAndDuration(route);
    vehicles.car.data = {
        length: routeData[0],
        duration: routeData[1],
        emission: Math.floor(routeData[0] * carCO2EmissionPerKm / 1000) / 1000,
        kcal: 0
    }
    vehicleReady();
    return true;
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
    vehicleReady();
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
    vehicleReady();
    return canUseBike(routeData[0]) == 'can';
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
    vehicleReady();
    return canWalk(routeData[0]) == 'can';
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


function formatTime(time) {
    let hours = Math.floor(time / 3600);
    let minutes = Math.floor(time / 60) - hours * 60;
    let seconds = time % 60;
    let minutesPadding = (minutes < 10) ? '0' : '';
    let secondsPadding = (seconds < 10) ? '0' : '';
    return `${hours}:${minutesPadding}${minutes}:${secondsPadding}${seconds}`;
}


function formatEmission(emissionKg) {
    if (emissionKg >= 1.0) {
        return `${Math.round(emissionKg * 1000) / 1000}kg`;
    }
    return `${Math.round(emissionKg * 1000)}g`;
}


function formatLength(lengthM) {
    return `${Math.round(lengthM / 10) / 100}km`;
}