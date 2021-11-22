const urlParams = new URLSearchParams(window.location.search);
const fromLoc = {
    lat: urlParams.get('lat'),
    lng: urlParams.get('lng')
};
const n = urlParams.get('n');


if (stations.length != 0) {
    initMap(main);
}

function main() {
    addMarker(fromLoc);
    markBubi();
}


function markBubi() {
    for (let i in stations) {
        addMarker({lat: stations[i].lat, lng: stations[i].lon}, getSVGFolder() + '/bubi.png');
    }
}


function redirectHome() {
    window.location.href = getHome_URL();
}
