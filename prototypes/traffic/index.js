let from = document.getElementById('from');


function useGPS() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onGPSSuccess, onGPSError, {enableHighAccuracy: true});
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}


function onGPSSuccess(position) {
    let geo_loc = position.coords;
    sendRequest('revgeocode?at=' + geo_loc.latitude + '%2C' + geo_loc.longitude + '&lang=en-US', handleGPSGeoLocReverseResponse);
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


function sendRequest(params, responseHandler) {
    console.log('Sending request with params: ' + params);
    let api_key = getAPIKey();
    fetch('https://revgeocode.search.hereapi.com/v1/' + params + '&apiKey=' + api_key)
        .then(response => {return response.json();})
        .then(response => {responseHandler(response);})
        .catch(error => alert(error.message));
}


function handleGPSGeoLocReverseResponse(response) {
    console.log(response);
    from.value = response.items[0].title;
}