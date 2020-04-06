<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_NOTICE);

header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$response = array(
    'status'=>'ERROR'
);

if (isset($_REQUEST['q'])) {

    $endpoint = $_REQUEST['q'];

    switch ($endpoint) {

        /**
         * Get projects
         * 
         * @param sessionId
         **/

        case 'get-projects' :
            $data = file_get_contents('data/projects.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'get-assets' :
            $data = file_get_contents('data/assets.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'get-markers' :
            $data = file_get_contents('data/markers.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'get-arrangement' :
            $data = file_get_contents('data/arrangement.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
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
         * @param content
         * @param tags
         * @param rank
         * @param file
         **/
        
        case 'update-asset' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Update Marker
         * 
         * @param id
         * @param title
         * @param time
         * @param assets
         **/

        case 'update-marker' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Marker 
         * 
         * @param id
        */

        case 'delete-marker' :
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