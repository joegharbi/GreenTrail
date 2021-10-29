let platform = new H.service.Platform({ apikey: getAPIKey() });
let defaultLayers = platform.createDefaultLayers();

let map = new H.Map(
    document.getElementById('map'),
    defaultLayers.vector.normal.map,
    { zoom: 13, pixelRatio: window.devicePixelRatio || 1 }
);
window.addEventListener('resize', () => map.getViewPort().resize());

let behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
let ui = H.ui.UI.createDefault(map, defaultLayers);

let markerGroup = new H.map.Group();
map.addObject(markerGroup);

let lineGroup = new H.map.Group();
map.addObject(lineGroup);

let trafficMapState = false;


function addMarker(loc) {
    marker = new H.map.Marker(loc);
    markerGroup.addObject(marker);
    map.getViewModel().setLookAtData({
        bounds: markerGroup.getBoundingBox()
    });
}


function changeTrafficMap() {
    trafficMapState = !trafficMapState;
    if (trafficMapState) {
        map.addLayer(defaultLayers.vector.normal.traffic);
    } else {
        map.removeLayer(defaultLayers.vector.normal.traffic);
    }
}


function calcAndDisplayRoutes(from, to) {
    console.log('Start routing...');
    let router = platform.getRoutingService(null, 8);
    let routeRequestParams = {
        routingMode: 'fast',
        transportMode: 'car',
        origin: `${fromLoc.lat},${fromLoc.lng}`,
        destination: `${toLoc.lat},${toLoc.lng}`,
        spans: 'speedLimit,length',
        return: 'polyline,travelSummary'
    };
    calcAndDisplayRoute(router, routeRequestParams, processCarRoute, 'rgba(204, 37, 41, 0.7)');

    routeRequestParams.transportMode = 'bicycle';
    calcAndDisplayRoute(router, routeRequestParams, processBikeRoute, 'rgba(57, 106, 177, 0.7)');

    routeRequestParams.transportMode = 'pedestrian';
    calcAndDisplayRoute(router, routeRequestParams, processWalkRoute, 'rgba(107, 76, 154, 0.7)');

    routeRequestParams = {
        origin: `${fromLoc.lat},${fromLoc.lng}`,
        destination: `${toLoc.lat},${toLoc.lng}`,
        return: 'polyline,travelSummary'
    };
    router = platform.getPublicTransitService();
    calcAndDisplayPTRoute(router, routeRequestParams, processPTRoute, 'rgba(62, 180, 81, 0.7)');
}


function calcAndDisplayRoute(router, params, processor, color) {
    router.calculateRoute(params, result => {
        displayRoute(result, color);
        processor(result);
        vehicleReady();
    },
        onRouteError
    );
}


function calcAndDisplayPTRoute(router, params, processor, color) {
    router.getRoutes(params, result => {
        displayRoute(result, color);
        processor(result);
        vehicleReady();
    },
        onRouteError
    );
}


function displayRoute(result, color) {
    if (result.routes.length == 0) {
        return;
    }

    var route = result.routes[0];
  
    route.sections.forEach((section) => {
        let linestring = H.geo.LineString.fromFlexiblePolyline(section.polyline);
        let polyline = new H.map.Polyline(linestring, {
            style: {
                lineWidth: 4,
                strokeColor: color
            }
        });
        lineGroup.addObject(polyline);
    });

    map.getViewModel().setLookAtData({
        bounds: lineGroup.getBoundingBox()
    });    
}


function onRouteError(error) {
    alert(`Can't reach the remote server: ${error}`);
}
