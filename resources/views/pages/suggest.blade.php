@extends('layouts.master')

@section('title', 'GreenTrail')

@section('content')
    <?php
 
    /*
    Try with:
    /suggest?from_lat=47.49632&from_lng=19.06963&to_lat=47.49736&to_lng=19.05445
    */
    function send_request($endpoint, $params) {
        $client = new \GuzzleHttp\Client();
        try {
            $params['apiKey'] = trim(File::get(resource_path('api/api_key.txt')));
            $response = $client->request('GET', $endpoint, ['query' => $params]);

            return ['code' => $response->getStatusCode(), 'body' => json_decode($response->getBody(), true)];
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            $response = $e->getResponse();
            return ['code' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()];
        }
    }


    function send_weather_request($lat, $lng) {
        $result = send_request("https://weather.cc.api.here.com/weather/1.0/report.json", [ 
            'product' => 'observation',
            'latitude' => $lat,
            'longitude' => $lng
        ]);

        if ($result["code"] == 200) {
            return $result["body"]["observations"]["location"][0]["observation"][0];
        }

        return null;
    }


    function send_revgeoloc_request($lat, $lng) {
        $result = send_request("https://revgeocode.search.hereapi.com/v1/revgeocode", [
            'at' => $lat . "," . $lng,
            'lang' => 'en-US'
        ]);

        if ($result["code"] == 200) {
            return $result["body"]["items"][0]["address"]["label"];
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


    function check_response(&$errorlist, $reponse, $errormsg) {
        if (!isset($reponse)) {
            array_push($errorlist, $errormsg);
        }
        return $reponse;
    }

    $errorlist = array();
    evaluate_param($errorlist, $from_lat, -90, 90, "from_lat");
    evaluate_param($errorlist, $from_lng, -180, 180, "from_lng");
    evaluate_param($errorlist, $to_lat, -90, 90, "to_lat");
    evaluate_param($errorlist, $to_lng, -180, 180, "to_lng");

    if (empty($errorlist)) {
        $weatherData = check_response($errorlist, send_weather_request($from_lat, $from_lng), "Cannot get weather data");
        $fromPlaceName = check_response($errorlist, send_revgeoloc_request($from_lat, $from_lng), "Cannot get source location");
        $toPlaceName = check_response($errorlist, send_revgeoloc_request($to_lat, $to_lng), "Cannot get destination location");
    }
    ?>
    <style>
        .my-bg {
            background: #EEEEEE;
        }

        .car-box {
            border: 3px solid #D94452;
            background: #F76D82;
        }

        .pt-box {
            border: 3px solid #35BB9B;
            background: #62DDBD;
        }

        .bike-box {
            border: 3px solid #4B89DA;
            background: #73B1F4;
        }

        .walk-box {
            border: 3px solid #967ADA;
            background: #B3A5EF;
        }
    </style>
    @if (empty($errorlist))
        <div class="row p-0">
            <div class="col-md-6 col-sm-12 p-0">
                <div class="rounded my-bg m-2">
                    <div class="row m-2">
                        <div class="col-2 col-md-3 col-lg-2 p-2">From:</div>
                        <div class="col-10 col-md-9 col-lg-10 mt-1 mb-1 pt-1 pb-1 rounded bg-light"><?=$fromPlaceName?></div>
                    </div>
                    <div class="row m-2">
                        <div class="col-2 col-md-3 col-lg-2 p-2">To:</div>
                        <div class="col-10 col-md-9 col-lg-10 mt-1 mb-1 pt-1 pb-1 rounded bg-light"><?=$toPlaceName?></div>
                    </div>
                </div>
                <div class="rounded my-bg m-2">
                    <div class="row m-2 align-items-center">
                        <div class="col-2 p-0 m-0">
                            <img src="{{ $weatherData['iconLink'] }}"/>
                        </div>
                        <div class="col-7 col-md-6 col-xl-7 p-0">
                            {{ $weatherData["description"] }}
                        </div>
                        <div class="col-3 col-md-4 col-xl-3 pt-0 pb-0 pl-0 pr-2 m-0 h4 text-end">
                            <b>{{ intval($weatherData["temperature"]) }} C°</b>
                        </div>
                    </div>
                </div>
                <div class="rounded my-bg m-2">
                    <div class="row m-2 align-items-center">
                        <div class="col-2 p-2 m-0">
                            <img src="{{ asset('/svg/traffic.svg') }}" />
                        </div>
                        <div class="col-4 p-2">Traffic state</div>
                        <div class="col-6 p-2"><b id="trafficState"></b></div>
                    </div>
                </div>
                <div class="rounded my-bg m-2 p-1" id="suggestionTable">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 p-0">
                <div class="rounded my-bg m-2 h-100">
                    <div id="map" class="p-2 w-100" style="height: 600px">
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <script type="text/javascript">
            function getAPI_URL() {
                return "{{ route('api') }}";
            }

            function getSVGFolder() {
                return "{{ asset('/svg') }}";
            }

            function getWeatherType() {
                return "{{ $weatherData['iconName'] }}";
            }
        </script>
        <script type="text/javascript" src="{{ asset('/js/map.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/suggest.js') }}"></script>
    @else
        <div class="row p-0">
            <div class="col-md-12 p-2 m-2 rounded my-bg text-danger">
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
