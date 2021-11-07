<?php

    function send_request($url, $params) {
        $ch = curl_init();
        $params['apiKey'] = trim(file_get_contents('api_key.txt'));
        curl_setopt($ch, CURLOPT_URL, $url . "?" . http_build_query($params)); 
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

?>