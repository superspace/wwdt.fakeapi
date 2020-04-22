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
         **/

        case 'project/list' :
            $data = file_get_contents('data/projects.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        /**
         * List assets
         * 
         * @param sessionId int
         **/

        case 'asset/list' :
            $data = file_get_contents('data/assets.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        /**
         * List markers
         * 
         * @param sessionId int
         **/

        case 'marker/list' :
            $data = file_get_contents('data/markers.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        /**
         * Get arrangement by id
         * 
         **/

        case 'arrangement/1' :
            $data = file_get_contents('data/arrangement.json');
            $response['result'] = json_decode($data);
            $response['status'] = 'OK';
            break;

        /**
         * Create marker
         * 
         * @param title string
         * @param time int
         * @param sessionId int
         **/

        case 'marker/create' :
            $marker = $_POST;
            $marker['id'] = rand(100,1000);
            $marker['assets'] = [];
            $response['result'] = $marker;
            $response['status'] = 'OK';
            break;


        /**
         * Create asset
         * 
         * @param type string
         * @param title string
         * @param description string
         * @param tags string
         * @param rank int
         * @param content string
         * @param file file
         * @param sessionId int
         **/

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
         * Create keyframe
         * 
         * @param title string
         * @param time int
         * @param arrangementId int
         **/

        case 'keyframe/create' :
            $keyframe = $_POST;
            $keyframe['id'] = rand(100,1000);
            $response['result'] = $keyframe;
            $response['status'] = 'OK';
            break;

        /**
         * Update Asset
         * 
         * @param id int
         * @param type string
         * @param title string
         * @param description string
         * @param tags string
         * @param rank int
         * @param content string
         * @param file file
         **/
        
        case 'asset/update' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Update Marker
         * 
         * @param id int
         * @param title string
         * @param time int
         * @param assets array
         **/

        case 'marker/update' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Update Keyframe
         * 
         * @param id int
         * @param title string
         * @param time int
         **/

        case 'keyframe/update' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Update asset in keyframe
         * 
         * @param keyframeId int
         * @param assetId int
         * @param x int
         * @param y int
         * @param z int
         * @param scale float
         **/

        case 'keyframe/properties/update' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Add asset to keyframe
         * 
         * @param keyframeId int
         * @param assetId int
         **/

        case 'keyframe/properties/add' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Remove asset from keyframe
         * 
         * @param keyframeId int
         * @param assetId int
         **/

        case 'keyframe/properties/remove' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Marker 
         * 
         * @param id int
        */

        case 'marker/delete' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Keyframe
         * 
         * @param id int
        */

        case 'keyframe/delete' :
            $response['status'] = 'OK';
            $response['request'] = $_POST;            
            break;

        /**
         * Delete Asset
         * 
         * @param id int
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