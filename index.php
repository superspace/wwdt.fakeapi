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
         * List projects
         * 
         * @param sessionId
         **/

        case 'project/list' :
            $data = file_get_contents('data/projects.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'asset/list' :
            $data = file_get_contents('data/assets.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'marker/list' :
            $data = file_get_contents('data/markers.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        case 'arrangement/1' :
            $data = file_get_contents('data/arrangement.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        // Create

        case 'marker/create' :
            $marker = $_POST;
            $marker['id'] = rand(100,1000);
            $response['result'] = $marker;
            $response['status'] = 'OK';
            break;

        case 'asset/create' :
            $asset = $_POST;
            $asset['id'] = rand(100,1000);
            $asset['creationdate'] = Date("Y-m-d H:i:s");
            $asset['modificationdate'] = "";
            $asset['author'] = "User A";
            $asset['tags'] = explode(',', $_POST['tags']);
            $asset['related'] = [];
            $response['result'] = $asset;
            $response['status'] = 'OK';
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
        
        case 'asset/update' :
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

        case 'marker/update' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Marker 
         * 
         * @param id
        */

        case 'marker/delete' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Asset
         * 
         * @param id
         **/

        case 'asset/delete' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        default :
            $response['message'] = 'No endpoint found';
            break;

    }

    echo json_encode($response);

}