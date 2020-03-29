<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE);

header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if (isset($_REQUEST['q'])) {

    $endpoint = $_REQUEST['q'];

    $response = array(
        'status'=>'ERROR'
    );



    switch ($endpoint) {

        // Get

        case 'get-projects' :
            $data = file_get_contents('data/projects.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'get-assets' :
            $id = isset($_GET['sessionId']) ? $_GET['sessionId'] : false;
            if ($id) {
                $data = file_get_contents('data/assets.json');
                $response['result'] = json_decode($data);
                $response['status'] = 'OK';
            } else {
                $response['message'] = 'ID missing';
            }
            break;

        case 'get-markers' :
            $id = isset($_GET['sessionId']) ? $_GET['sessionId'] : false;
            if ($id) {
                $data = file_get_contents('data/markers.json');
                $response['result'] = json_decode($data);
                $response['status'] = 'OK';
            } else {
                $response['message'] = 'ID missing';
            }
            break;

        case 'get-arrangement' :
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            if ($id) {
                $data = file_get_contents('data/arrangement.json');
                $response['result'] = json_decode($data);
                $response['status'] = 'OK';
            } else {
                $response['message'] = 'ID missing';
            }
            break;

        // Create

        case 'create-marker' :
            $response['status'] = 'OK';
            $response['params'] = json_decode(file_get_contents('php://input'));
            break;

        case 'create-asset' :
            $response['status'] = 'OK';
            $response['request'] = json_decode(file_get_contents('php://input'));
            break;

        /**
         * Update Asset
         * 
         * @param id
         * @param title
         * @param description
         **/
        
        case 'update-asset' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Asset
         * 
         * @param id
         **/

        case 'delete-asset' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        default :
            $response['message'] = 'No endpoint found';
            break;

    }

    echo json_encode($response);

}