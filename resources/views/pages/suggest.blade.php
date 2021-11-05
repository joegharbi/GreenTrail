@extends('layouts.master')

@section('title', 'GreenTrail')

@section('content')
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
    <div class="row p-0">
        <div class="col-md-6 col-sm-12 p-0">
            <div class="rounded my-bg m-2">
                <div class="row m-2">
                    <div class="col-2 col-md-3 col-lg-2 p-2">From:</div>
                    <div class="col-10 col-md-9 col-lg-10 mt-1 mb-1 pt-1 pb-1 rounded bg-light">$API_Start_Place</div>
                </div>
                <div class="row m-2">
                    <div class="col-2 col-md-3 col-lg-2 p-2">To:</div>
                    <div class="col-10 col-md-9 col-lg-10 mt-1 mb-1 pt-1 pb-1 rounded bg-light">$API_Dest_Place</div>
                </div>
            </div>
            <div class="rounded my-bg m-2">
                <div class="row m-2 align-items-center">
                    <div class="col-2 p-0 m-0">
                        <img src="https://weather.api.here.com/static/weather/icon/1.png"/>
                    </div>
                    <div class="col-7 col-md-6 col-xl-7 p-0">
                        $API_Weather_Desc
                    </div>
                    <div class="col-3 col-md-4 col-xl-3 pt-0 pb-0 pl-0 pr-2 m-0 h4 text-end">
                        <b>-22 C°</b>
                    </div>
                </div>
            </div>
            <div class="rounded my-bg m-2">
                <div class="row m-2 align-items-center">
                    <div class="col-2 p-2 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-stoplights-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 0a2 2 0 0 0-2 2H2c.167.5.8 1.6 2 2v2H2c.167.5.8 1.6 2 2v2H2c.167.5.8 1.6 2 2v1a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-1c1.2-.4 1.833-1.5 2-2h-2V8c1.2-.4 1.833-1.5 2-2h-2V4c1.2-.4 1.833-1.5 2-2h-2a2 2 0 0 0-2-2H6zm3.5 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM8 13a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                        </svg>
                    </div>
                    <div class="col-4 p-2">Traffic state</div>
                    <div class="col-6 p-2">$API_Traffic_State</div>
                </div>
            </div>
            <div class="rounded my-bg m-2 p-1">
                <div class="row m-2"><div class="col-12 text-center h6 m-0 p-0">Top suggestion</div></div>
                <!-- WALK -->
                <div class="row m-2 align-items-center rounded walk-box">
                    <div class="col-1 col-md-2 col-lg-1 p-2 m-0">
                        <svg width="32px" height="32px" viewBox="-96 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M208 96c26.5 0 48-21.5 48-48S234.5 0 208 0s-48 21.5-48 48 21.5 48 48 48zm94.5 149.1l-23.3-11.8-9.7-29.4c-14.7-44.6-55.7-75.8-102.2-75.9-36-.1-55.9 10.1-93.3 25.2-21.6 8.7-39.3 25.2-49.7 46.2L17.6 213c-7.8 15.8-1.5 35 14.2 42.9 15.6 7.9 34.6 1.5 42.5-14.3L81 228c3.5-7 9.3-12.5 16.5-15.4l26.8-10.8-15.2 60.7c-5.2 20.8.4 42.9 14.9 58.8l59.9 65.4c7.2 7.9 12.3 17.4 14.9 27.7l18.3 73.3c4.3 17.1 21.7 27.6 38.8 23.3 17.1-4.3 27.6-21.7 23.3-38.8l-22.2-89c-2.6-10.3-7.7-19.9-14.9-27.7l-45.5-49.7 17.2-68.7 5.5 16.5c5.3 16.1 16.7 29.4 31.7 37l23.3 11.8c15.6 7.9 34.6 1.5 42.5-14.3 7.7-15.7 1.4-35.1-14.3-43zM73.6 385.8c-3.2 8.1-8 15.4-14.2 21.5l-50 50.1c-12.5 12.5-12.5 32.8 0 45.3s32.7 12.5 45.2 0l59.4-59.4c6.1-6.1 10.9-13.4 14.2-21.5l13.5-33.8c-55.3-60.3-38.7-41.8-47.4-53.7l-20.7 51.5z"/>
                        </svg>
                    </div>
                    <div class="col-7 col-md-6 col-lg-7 p-2 text-center">
                        <b>Walking</b><br>
                        <hr class="p-0 m-0">
                        01:23:45 42.69 km
                    </div>
                    <div class="col-4 p-2 d-grid gap-2"><button class="btn btn-success btn-sm"><b>Reduce emission by 500g</b></button></div>
                </div>

                <div class="row m-2"><div class="col-12 text-center h6 m-0 p-0">Alternatives</div></div>
                <!-- BIKE -->
                <div class="row m-2 align-items-center rounded bike-box">
                    <div class="col-1 col-md-2 col-lg-1 p-2 m-0">
                        <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                            <path d="M17.565 9.209c.454-.136.937-.209 1.435-.209 2.759 0 5 2.24 5 5s-2.241 5-5 5c-2.76 0-5-2.24-5-5 0-1.906 1.068-3.564 2.639-4.408l-.429-1.039-4.494 5.947h-1.741c-.251 2.525-2.385 4.5-4.975 4.5-2.76 0-5-2.24-5-5s2.24-5 5-5c.635 0 1.244.119 1.803.336l1.181-2.331-.462-1.005h-1.022c-.277 0-.5-.224-.5-.5 0-.239.189-.5.5-.5h2.491c.239 0 .5.189.5.5s-.26.5-.5.5h-.368l.47 1h6.484l-.421-1h-1.656c-.277 0-.5-.224-.5-.5 0-.311.259-.5.5-.5h2.33l1.735 4.209zm-11.217 1.024c-.421-.151-.875-.233-1.348-.233-2.208 0-4 1.792-4 4s1.792 4 4 4c2.038 0 3.722-1.528 3.969-3.5h-3.103c-.174.299-.497.5-.866.5-.552 0-1-.448-1-1 0-.533.419-.97.945-.998l1.403-2.769zm10.675.289c-1.208.689-2.023 1.989-2.023 3.478 0 2.208 1.792 4 4 4s4-1.792 4-4-1.792-4-4-4c-.364 0-.716.049-1.051.14l1.182 2.869c.491.064.869.484.869.991 0 .552-.449 1-1 1-.552 0-1-.448-1-1 0-.229.077-.44.207-.609l-1.184-2.869zm-9.783.165l-1.403 2.766.029.047h3.103c-.147-1.169-.798-2.183-1.729-2.813m.454-.898c1.254.804 2.126 2.152 2.281 3.711h.997l-2.454-5.336-.824 1.625zm7.683-1.789h-5.839l2.212 4.797 3.627-4.797z"/>
                        </svg>
                    </div>
                    <div class="col-7 col-md-6 col-lg-7 p-2 text-center">
                        <b>Bike</b><br>
                        <hr class="p-0 m-0">
                        01:23:45 42.69 km
                    </div>
                    <div class="col-4 p-2 d-grid gap-2"><button class="btn btn-success btn-sm"><b>Reduce emission by 500g</b></button></div>
                </div>

                <!-- PT -->
                <div class="row m-2 align-items-center rounded pt-box">
                    <div class="col-1 col-md-2 col-lg-1 p-2 m-0">
                        <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                            <path d="M6 24h-2c-.552 0-1-.448-1-1v-1c-.53 0-1.039-.211-1.414-.586s-.586-.884-.586-1.414v-8c-.552 0-1-.448-1-1v-3c0-.552.448-1 1-1v-4c0-1.657 1.343-3 3-3h16c1.657 0 3 1.343 3 3v4c.552 0 1 .448 1 1v3c0 .552-.448 1-1 1v8c0 .53-.211 1.039-.586 1.414s-.884.586-1.414.586v1c0 .552-.448 1-1 1h-2c-.552 0-1-.448-1-1v-1h-10v1c0 .552-.448 1-1 1zm-1.5-7c.828 0 1.5.672 1.5 1.5s-.672 1.5-1.5 1.5-1.5-.672-1.5-1.5.672-1.5 1.5-1.5zm15 0c.828 0 1.5.672 1.5 1.5s-.672 1.5-1.5 1.5-1.5-.672-1.5-1.5.672-1.5 1.5-1.5zm-5 1h-5c-.276 0-.5.224-.5.5s.224.5.5.5h5c.276 0 .5-.224.5-.5s-.224-.5-.5-.5zm6.5-12.5c0-.276-.224-.5-.5-.5h-17c-.276 0-.5.224-.5.5v8.5s3.098 1 9 1 9-1 9-1v-8.5zm-5-3.5h-8v1h8v-1z"/>
                        </svg>
                    </div>
                    <div class="col-7 col-md-6 col-lg-7 p-2 text-center">
                        <b>Public transport</b><br>
                        <hr class="p-0 m-0">
                        01:23:45 42.69 km
                    </div>
                    <div class="col-4 p-2 d-grid gap-2"><button class="btn btn-success btn-sm"><b>Reduce emission by 300g</b></button></div>
                </div>

                <!-- CAR -->
                <div class="row m-2 align-items-center rounded car-box">
                    <div class="col-1 col-md-2 col-lg-1 p-2 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path d="M23.5 7c.276 0 .5.224.5.5v.511c0 .793-.926.989-1.616.989l-1.086-2h2.202zm-1.441 3.506c.639 1.186.946 2.252.946 3.666 0 1.37-.397 2.533-1.005 3.981v1.847c0 .552-.448 1-1 1h-1.5c-.552 0-1-.448-1-1v-1h-13v1c0 .552-.448 1-1 1h-1.5c-.552 0-1-.448-1-1v-1.847c-.608-1.448-1.005-2.611-1.005-3.981 0-1.414.307-2.48.946-3.666.829-1.537 1.851-3.453 2.93-5.252.828-1.382 1.262-1.707 2.278-1.889 1.532-.275 2.918-.365 4.851-.365s3.319.09 4.851.365c1.016.182 1.45.507 2.278 1.889 1.079 1.799 2.101 3.715 2.93 5.252zm-16.059 2.994c0-.828-.672-1.5-1.5-1.5s-1.5.672-1.5 1.5.672 1.5 1.5 1.5 1.5-.672 1.5-1.5zm10 1c0-.276-.224-.5-.5-.5h-7c-.276 0-.5.224-.5.5s.224.5.5.5h7c.276 0 .5-.224.5-.5zm2.941-5.527s-.74-1.826-1.631-3.142c-.202-.298-.515-.502-.869-.566-1.511-.272-2.835-.359-4.441-.359s-2.93.087-4.441.359c-.354.063-.667.267-.869.566-.891 1.315-1.631 3.142-1.631 3.142 1.64.313 4.309.497 6.941.497s5.301-.184 6.941-.497zm2.059 4.527c0-.828-.672-1.5-1.5-1.5s-1.5.672-1.5 1.5.672 1.5 1.5 1.5 1.5-.672 1.5-1.5zm-18.298-6.5h-2.202c-.276 0-.5.224-.5.5v.511c0 .793.926.989 1.616.989l1.086-2z"/>
                        </svg>
                    </div>
                    <div class="col-7 col-md-6 col-lg-7 p-2 text-center">
                        <b>Car</b><br>
                        <hr class="p-0 m-0">
                        01:23:45 42.69 km
                    </div>
                    <div class="col-4 p-2 d-grid gap-2"><button class="btn btn-warning"><b>Use car</b></button></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 p-0">
            <div class="rounded my-bg m-2 h-100">
                <div id="map" class="h-100">
                    $API_Map
                </div>
            </div>
        </div>
    </div>
@stop
