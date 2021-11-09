let platform;
let defaultLayers;
let map ;
let behavior;
let ui;
let markerGroup;
let lineGroup;


function initMap(mainFunc) {
    console.log('Init map');
    fetch(`${getAPI_URL()}/key`)
        .then(response => { return response.text(); })
        .then(response => { intiMapWithAPIKey(response, mainFunc); })
        .catch(error => alert(error.message));
}


function intiMapWithAPIKey(api_key, mainFunc) {
    platform = new H.service.Platform({ apikey: api_key });
    defaultLayers = platform.createDefaultLayers();

    map = new H.Map(
        document.getElementById('map'),
        defaultLayers.vector.normal.map,
        { zoom: 13, pixelRatio: window.devicePixelRatio || 1 }
    );
    window.addEventListener('resize', () => map.getViewPort().resize());

    behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    ui = H.ui.UI.createDefault(map, defaultLayers);

    markerGroup = new H.map.Group();
    map.addObject(markerGroup);

    lineGroup = new H.map.Group();
    map.addObject(lineGroup);

    map.getViewPort().resize();

    mainFunc();
}


function addMarker(loc) {
    let marker = new H.map.Marker(loc);
    markerGroup.addObject(marker);
    map.getViewModel().setLookAtData({
        bounds: extendBoundingBox(markerGroup.getBoundingBox())
    });
}


function routeNormalVehicle(from ,to, vehicle, callBack, color) {
    console.log('Routing ' + vehicle)
    let router = platform.getRoutingService(null, 8);
    let routeRequestParams = {
        routingMode: 'fast',
        transportMode: vehicle,
        origin: `${from.lat},${from.lng}`,
        destination: `${to.lat},${to.lng}`,
        spans: 'speedLimit,length',
        return: 'polyline,travelSummary'
    };
    router.calculateRoute(routeRequestParams, result => {
        if (callBack(result)) {
            displayRoute(result, color);
        }
    },
        onRouteError
    );
}


function routePT(from ,to, callBack, color) {
    console.log('Routing Public Transport')
    let router = platform.getPublicTransitService();
    let routeRequestParams = {
        origin: `${fromLoc.lat},${fromLoc.lng}`,
        destination: `${toLoc.lat},${toLoc.lng}`,
        return: 'polyline,travelSummary'
    };
    router.getRoutes(routeRequestParams, result => {
        displayRoute(result, color);
        callBack(result);
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
        bounds: extendBoundingBox(lineGroup.getBoundingBox())
    });    
}


function onRouteError(error) {
    alert(`Can't reach the remote server: ${error}`);
}


function extendBoundingBox(box) {
    let maxLat = box.getTop();
    let minLat = box.getBottom();
    let minLng = box.getLeft();
    let maxLng = box.getRight();
    const expansion = 1.1;

    let latMiddle = (minLat + maxLat) / 2;
    let latDiff  = (latMiddle - minLat) * expansion;

    let lngMiddle = (minLng + maxLng) / 2;
    let lngDiff  = (lngMiddle - minLng) * expansion;

    return new H.geo.Rect(
        latMiddle + latDiff,
        lngMiddle - lngDiff,
        latMiddle - latDiff,
        lngMiddle + lngDiff,
    );
}
