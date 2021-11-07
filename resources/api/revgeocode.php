<?php
    // Allow CORS
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET"); 

    require_once('api_request.php');

    $response = send_request('https://revgeocode.search.hereapi.com/v1/revgeocode', $_GET);
    if ($response == false) {
        exit(400);
    }
    echo($response);
?>