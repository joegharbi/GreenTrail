let platform = new H.service.Platform({ apikey: getAPIKey() });
let defaultLayers = platform.createDefaultLayers();

let map = new H.Map(
    document.getElementById('map'),
    defaultLayers.vector.normal.map,
    { zoom: 13, pixelRatio: window.devicePixelRatio || 1 }
);
window.addEventListener('resize', () => map.getViewPort().resize());

let summary = document.getElementById('summary');
let trafficState = document.getElementById('trafficState');

let behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
let ui = H.ui.UI.createDefault(map, defaultLayers);

let markerGroup = new H.map.Group();
map.addObject(markerGroup);

let lineGroup = new H.map.Group();
map.addObject(lineGroup);


function addMarker(loc) {
    marker = new H.map.Marker(loc);
    markerGroup.addObject(marker);
    map.getViewModel().setLookAtData({
        bounds: markerGroup.getBoundingBox()
    });
}


function calcAndDisplayRoutes(from, to) {
    let router = platform.getRoutingService(null, 8);
    let routeRequestParams = {
        routingMode: 'fast',
        transportMode: 'car',
        origin: `${fromLoc.lat},${fromLoc.lng}`,
        destination: `${toLoc.lat},${toLoc.lng}`,
        spans: 'speedLimit,length',
        return: 'polyline,travelSummary'
    };
    router.calculateRoute(
        routeRequestParams,
        result => { displayRouteData(result, 'Car', 'rgba(204, 37, 41, 0.7)'); calcTrafficState(result); },
        onRouteError
    );

    routeRequestParams.transportMode = 'bicycle';
    router.calculateRoute(
        routeRequestParams,
        result => { displayRouteData(result, 'Bike', 'rgba(57, 106, 177, 0.7)'); },
        onRouteError
    );

    routeRequestParams = {
        origin: `${fromLoc.lat},${fromLoc.lng}`,
        destination: `${toLoc.lat},${toLoc.lng}`,
        return: 'polyline,travelSummary'
    };
    router = platform.getPublicTransitService();
    router.getRoutes(
        routeRequestParams,
        result => { displayRouteData(result, 'Public Transport', 'rgba(62, 180, 81, 0.7)'); },
        onRouteError
    );
}


function displayRouteData(result, vehicle, color) {
    if (result.routes.length == 0) {
        summary.innerHTML += `<li style='color:${color}'><b>${vehicle}</b>: Not available</li>`;
        return;
    }

    var route = result.routes[0];
    let duration = 0, distance = 0;
  
    route.sections.forEach((section) => {
        let linestring = H.geo.LineString.fromFlexiblePolyline(section.polyline);
        let polyline = new H.map.Polyline(linestring, {
            style: {
                lineWidth: 4,
                strokeColor: color
            }
        });
        lineGroup.addObject(polyline);

        distance += section.travelSummary.length;
        duration += section.travelSummary.duration;
    });

    
    map.getViewModel().setLookAtData({
        bounds: lineGroup.getBoundingBox()
    });
    
    summary.innerHTML += `<li style='color:${color}'><b>${vehicle}</b>: ${Math.floor(duration/60)} min ${duration%60} sec, ${Math.round(distance/100) / 10} km</li>`;
}


function onRouteError(error) {
    alert(`Can't reach the remote server: ${error}`);
}


function calcTrafficState(result) {
    var route = result.routes[0];
    let realDuration = 0, fastestDuration = 0;
    
    route.sections.forEach((section) => {
        section.spans.forEach((span) => {
            fastestDuration += span.length / span.speedLimit;
        });

        realDuration += section.travelSummary.duration;
    });

    let ratio = realDuration / fastestDuration;
    let trafficStateStr = '';
    if (ratio > 3.0) {
        trafficStateStr = 'very high';
    } else if (ratio > 2.0) {
        trafficStateStr = 'high';
    } else if (ratio > 1.5) {
        trafficStateStr = 'medium';
    } else if (ratio > 1.2) {
        trafficStateStr = 'low';
    } else {
        trafficStateStr = 'very low';
    }

    trafficState.innerHTML = `<b>The traffic is: <i>${trafficStateStr}</i></b>`;
}