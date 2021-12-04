@extends('layouts.master')

@section('title', 'Green Trail')

@section('content')
    <?php
 
    /*
    Try with:
    /bubi?lat=47.49632&lng=19.06963&n=5
    */

    function get_user_data($field, $default) {
        if (Auth::user() && isset(Auth::user()[$field])) {
            return Auth::user()[$field];
        }
        return $default;
    }
    

    function send_bubi_request() {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET',
                'https://private-anon-c358468a5c-bkkfutar.apiary-proxy.com/api/query/v1/ws/otp/api/where/bicycle-rental.json',
                ['query' => [
                    'key' => 'apaiary-test',
                    'version' => '3',
                    'appVersion' => 'apiary-1.0',
                    'includeReferences' => 'true'
                ]]
            );

            return ['code' => $response->getStatusCode(), 'body' => json_decode($response->getBody(), true)];
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            $response = $e->getResponse();
            return ['code' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()];
        }
    }


    function get_bubi_stations() {
        $result = send_bubi_request();

        if ($result["code"] == 200) {
            return $result["body"]["data"]["list"];
        }

        return null;
    }


    function evaluate_param(&$errorlist, $param, $min, $max, $name) {
        if (!isset($param)) {
            array_push($errorlist, $name . " is not set");
        } else {
            $floatvalue = floatval($param);
            if (strval($floatvalue) != $param) {
                array_push($errorlist, $name . " is not a number");
            } else if ($min >= $floatvalue || $max <= $floatvalue) {
                array_push($errorlist, $name . " is outside bounds [" . $min . " < " . $name . " < " . $max . "]");
            }
        }
    }


    $errorlist = array();
    evaluate_param($errorlist, $lat, -90, 90, "lat");
    evaluate_param($errorlist, $lng, -180, 180, "lng");
    evaluate_param($errorlist, $n, 0, 100, "n");

    $bubiStations = get_bubi_stations();
    if (empty($errorlist) && isset($bubiStations)) {
        $startLoc = [
            'lat' => $lat,
            'lon' => $lng
        ];
        usort($bubiStations, function($a, $b) use ($startLoc) {
            return geoLocDistance($startLoc, $a) - geoLocDistance($startLoc, $b);
        });
        $bubiStations = array_slice($bubiStations, 0, $n);
        $found = geoLocDistance($startLoc, $bubiStations[0]) <= floatval(get_user_data('maxBikeDistance', 4000));
    } else {
        array_push($errorlist, "Cannot locate MOL Bubi stations");
    }

    function geoLocDistance($loc1, $loc2) {
        $R = 6371e3; // metres
        $f1 = $loc1['lat'] * pi()/180;
        $f2 = $loc2['lat'] * pi()/180;
        $df = ($loc2['lat'] - $loc1['lat']) * pi()/180;
        $dl = ($loc2['lon'] - $loc1['lon']) * pi()/180;
    
        $a = sin($df/2) * sin($df/2) + cos($f1) * cos($f2) * sin($dl/2) * sin($dl/2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        return $R * $c; // in metres
    }

    ?>
    @if (empty($errorlist))
        <div class="row p-2">
            <div class="col-12 p-0 bg-light-gray rounded mt-2">
                <div class="h2 pt-2 text-center">Nearby MOL Bubi stations</div>
                <div class="m-2">
                    @if ($found)
                        <div id="map" class="p-2 w-100" style="height: 600px">
                        </div>
                    @else
                        <p class="text-danger">
                            No nearby MOL Bubi station found!
                        </p>
                    @endif
                </div>
                <div class="text-center mb-2">
                    <button type="button" class="btn btn-success" onclick="redirectHome()">Got it!</button>
                <div>
            </div>
        </div>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <script type="text/javascript">
            function getHome_URL() {
                return "{{ route('home') }}";
            }

            function getSVGFolder() {
                return "{{ asset('/svg') }}";
            }

            function getAPI_URL() {
                return "{{ route('api') }}";
            }

            const stations = <?php
                if ($found) {
                    echo json_encode($bubiStations);
                } else {
                    echo '[]';
                } ?>;
        </script>
        <script type="text/javascript" src="{{ asset('/js/map.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/bubi.js') }}"></script>
    @else
        <div class="row p-0">
            <div class="col-md-12 p-2 m-2 rounded bg-light-gray text-danger">
                <h1 class="text-center">Some error occured!</h1>
                <ul>
                    @foreach ($errorlist as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@stop
