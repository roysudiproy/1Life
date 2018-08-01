<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Credentials: true');
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    require $_SERVER['DOCUMENT_ROOT'] . "/1Life-Passport/wp-blog-header.php";
} elseif ($_SERVER['SERVER_NAME'] == 'mydevfactory.com') {
    require_once ("../../../../wp-blog-header.php");
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/wp-blog-header.php";
}


switch (isset($_GET['type'])) {
    case "get_organisation_data":
        echo get_organisation_data();
        return;
        break;
    default:
        echo json_encode(array(
        "status" => "error",
        "msg" => "Function not defined"
            ));
        break;
}

function get_organisation_data(){
    global $wpdb;    
    $table_organization=$wpdb->prefix.'organisations';
    $get_Org="";
    $org_id="";
    $status="fail";
    if(!isset($_GET['org_id'])){
        
        $status="fail";
    }else{
        $org_id=$_GET['org_id'];
        
        $get_Org = $wpdb->get_row( "SELECT * FROM $table_organization WHERE organisation_id = $org_id",'OBJECT' );
        
        if (empty($get_Org)) {
            $status="fail";
        }else {
            $status="ok";
        }
        
    }
   
    
    
    
    echo json_encode(array(
        "status" => $status,
        "org" => $get_Org
    ));
}