let fromLoc = undefined;
let toLoc = undefined;


document.getElementById("go").onclick = function () {
    if (fromLoc == undefined) {
        alert('Provide starting point first');
        return;
    }

    if (toLoc == undefined) {
        alert('Provide destination first');
        return;
    }

    let currURL = window.location.href;
    let rootURL = currURL.substr(0, currURL.indexOf(currURL.indexOf('/'), currURL.indexOf('//') + 2) + 1);
    window.location.href = `${rootURL}suggest?from_lat=${fromLoc.lat}&from_lng=${fromLoc.lng}&to_lat=${toLoc.lat}&to_lng=${toLoc.lng}`;
};


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
        if (value) {
            sendRequest('autocomplete', `q=${encodeURIComponent(value)}`, 
                response => { handleInputAutoCompleteResponse(response, id); });
        }
    }
}


function onFocusOut(id) {
    let value = document.getElementById(id).value;
    if (value) {
        sendRequest('autocomplete', `q=${encodeURIComponent(value)}`, 
            response => { handleInputAutoCompleteResponse(response, id); });
    }
}


function sendRequest(apiType, params, responseHandler) {
    console.log('Sending request to ' + apiType + ' with params: ' + params);
    fetch(`${getAPI_URL()}/${apiType}.php?${params}`, { method: "GET", mode: 'cors' })
        .then(response => { return response.json(); })
        .then(response => { responseHandler(response); })
        .catch(error => alert(error.message));
}


function handleGPSGeoLocReverseResponse(response) {
    console.log(response);
    document.getElementById('from').value = response.items[0].title;
}


function handleInputAutoCompleteResponse(response, id) {
    console.log(response);
    if (response.items.length == 0) {
        alert('Cannot find specified location');
        document.getElementById(id).value = '';
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

    if (id == 'from') {
        fromLoc = response.items[0].position;
    } else {
        toLoc = response.items[0].position;
    }
}