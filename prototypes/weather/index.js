let result = document.getElementById('result');
let city = document.getElementById('city');
let imgdiv = document.getElementById('img');


function getWeatherLocal() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onGPSSuccess, onGPSError, {enableHighAccuracy: true});
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}


function onGPSSuccess(position) {
    let geo_loc = position.coords;
    sendRequest('latitude=' + geo_loc.latitude + '&longitude=' + geo_loc.longitude);
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


function getWeatherCity() {
    sendRequest('name=' + city.value);
}


function sendRequest(params) {
    console.log('Sending request with params: ' + params);
    result.innerText = 'Loading...';
    imgdiv.innerHTML = '';
    let api_key = getAPIKey();
    fetch('https://weather.cc.api.here.com/weather/1.0/report.json?apiKey=' + api_key + '&product=observation&' + params)
        .then(response => {return response.json();})
        .then(response => {handleResponse(response);})
        .catch(error => alert(error.message));
}


function handleResponse(response) {
    console.log(response);
    result.innerText = 'The weather is: ' +
        response.observations.location[0].observation[0].description;
    imgdiv.innerHTML = '<img src="' + response.observations.location[0].observation[0].iconLink + '"/>';
}