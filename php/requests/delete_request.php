<?php 
session_start();
header("Content-Type: application/json");
// i have to Uncomment this section after i complete the admin authentificantion process.
if(!isset($_SESSION['matricule'])){
    $response = array(
        "code"=>403,
        "message"=>"You don't have rights to delete requests"
    );
    echo json_encode($response);
    die();
}
else if(!isset($_GET['request_id'])){
    $response = array(
        "code"=>400,
        "message"=>"Request Id isn't provided."
    );
    echo json_encode($response);
    die();
}
include "../config.php";
$path = "mysql:host=" . dbhost . ";dbname=" . dbname;
$conn = new PDO($path, dbuser, dbpass);
$sql = $conn->prepare("DELETE FROM demandes WHERE id= ?");
$sql->bindParam(1,$_GET['request_id'],PDO::PARAM_INT);
$sql->execute();
$rowCount = $sql->rowCount();
if(!$rowCount){
    $response = array(
        "code"=>500,
        "message"=>"Something went Wrong."
    );
}
else{
    $response = array(
        "code"=>200,
        "message"=>"User deleted successfully",
        "rowsAffected"=>$rowCount
    );
}


echo json_encode($response);
?>