<?php
    // Allow CORS
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET"); 

    echo(trim(file_get_contents('api_key.txt')));
?>