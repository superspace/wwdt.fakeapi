<?php

header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if (isset($_REQUEST['q'])) {

    $endpoint = $_REQUEST['q'];

    $response = array(
        'status'=>'ERROR'
    );

    switch ($endpoint) {

        case 'list-projects' :
            $data = file_get_contents('data/projects.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'list-markers' :
            $data = file_get_contents('data/markers.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'add-marker' :
            $response['status'] = 'OK';
            $response['params'] = json_decode(file_get_contents('php://input'));
            break;

        case 'add-asset' :
            $response['status'] = 'OK';
            $response['params'] = json_decode(file_get_contents('php://input'));
            break;

        default :
            $response['message'] = 'No endpoint found';
            break;

    }

    echo json_encode($response);

}