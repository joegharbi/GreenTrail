let from = document.getElementById('from');
let trafficMapCheck = document.getElementById('trafficMap');
let fromLoc = undefined;
let toLoc = undefined;


function useGPS() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onGPSSuccess, onGPSError, {enableHighAccuracy: true});
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}


function onGPSSuccess(position) {
    let geo_loc = position.coords;
    fromLoc = {
        lat:geo_loc.latitude,
        lng:geo_loc.longitude
    };
    addMarker(fromLoc);
    sendRequest('revgeocode', `at=${geo_loc.latitude}%2C${geo_loc.longitude}&lang=en-US`, handleGPSGeoLocReverseResponse);
}


function onGPSError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}


function onInputEnter(id) {
    if (event.code == 'Enter') {
        let value = document.getElementById(id).value;
        sendRequest('autocomplete', `q=${encodeURIComponent(value)}`, 
            response => { handleInputAutoCompleteResponse(response, id); });
    }
}


function doSuggestion() {
    if (fromLoc == undefined) {
        alert('Provide starting point first');
        return;
    }

    if (toLoc == undefined) {
        alert('Provide destination first');
        return;
    }

    sendWeatherRequest(fromLoc);
}


function onTrafficMap() {
    changeTrafficMap();
}


function sendRequest(apiType, params, responseHandler) {
    console.log('Sending request to ' + apiType + ' with params: ' + params);
    let api_key = getAPIKey();
    fetch(`https://${apiType}.search.hereapi.com/v1/${apiType}?apiKey=${api_key}&${params}`)
        .then(response => { return response.json(); })
        .then(response => { responseHandler(response); })
        .catch(error => alert(error.message));
}

function sendWeatherRequest(loc) {
    console.log('Sending weather request of: ' + loc.lat + ', ' + loc.lng);
    let api_key = getAPIKey();
    fetch(`https://weather.cc.api.here.com/weather/1.0/report.json?apiKey=${api_key}&product=observation&latitude=${loc.lat}&longitude=${loc.lng}`)
        .then(response => { return response.json(); })
        .then(response => { handleWeatherResponse(response); })
        .catch(error => alert(error.message));
}


function handleWeatherResponse(response) {
    console.log(response);
    processWeather(response.observations.location[0].observation[0]);
    calcAndDisplayRoutes(fromLoc, toLoc);
}


function handleGPSGeoLocReverseResponse(response) {
    console.log(response);
    from.value = response.items[0].title;
}


function handleInputAutoCompleteResponse(response, id) {
    console.log(response);
    if (response.items.length == 0) {
        alert('Cannot find specified location');
        return;
    }

    let value = response.items[0].title;
    document.getElementById(id).value = value;
    sendRequest('geocode', `q=${encodeURIComponent(value)}`, 
        response => { handleInputGeoCodeResponse(response, id); });
}


function handleInputGeoCodeResponse(response, id) {
    console.log(response);
    if (response.items.length == 0) {
        alert('Cannot geolocate specified location');
        return;
    }

    addMarker(response.items[0].position);
    if (id == 'from') {
        fromLoc = response.items[0].position;
    } else {
        toLoc = response.items[0].position;
    }
}