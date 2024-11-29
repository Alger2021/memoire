<?php 
session_start();
header("Content-Type: application/json");

if(!isset($_GET['request_id'])){
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
if(isset($_SESSION['email'])){
    $sql = $conn->prepare("DELETE FROM demandes WHERE id= ?");
}
else{
    $sql = $conn->prepare("DELETE FROM demandes WHERE id= ? and  foreign_key = ?");
    $sql->bindParam(2,$_SESSION["matricule"],PDO::PARAM_INT);
}
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
        "message"=>"Request deleted successfully",
        "rowsAffected"=>$rowCount
    );
}


echo json_encode($response);
?>