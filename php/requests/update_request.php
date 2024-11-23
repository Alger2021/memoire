<?php 
session_start();
header("Content-Type: application/json");
// i have to Uncomment this section after i complete the admin authentificantion process.
// if(!isset($_SESSION['matricule'])){
//     $response = array(
//         "code"=>403,
//         "message"=>"You don't have rights to delete requests"
//     );
//     echo json_encode($response);
//     die();
// }
// else 

// PHP doesn't automatically parse JSON data into $_POST or other superglobals
// that why am going to use this line to read the raw data from the HTTP request body 

$jsonData = json_decode(file_get_contents('php://input'), true); 

if(!isset($jsonData["id"])){
    $response = array(
        "code"=>500,
        "message"=>"id is not set."
    );
    echo json_encode($response); 
    die();
}
switch ($jsonData["statu"]) {
    case 1:
        $statu = "ready";
        break;
    case 2:
        $statu = "inprocess";
        break;
    case 3:
        $statu = "refused";
        break;
    
    default:
        break;
}

include "../config.php";
$path = "mysql:host=" . dbhost . ";dbname=" . dbname;
$conn = new PDO($path, dbuser, dbpass);
$sql = $conn->prepare("UPDATE demandes SET observation=? , statu=? WHERE id=?");
$sql->bindParam(1,$jsonData['observation'],PDO::PARAM_STR);
$sql->bindParam(2,$statu,PDO::PARAM_STR);
$sql->bindParam(3,$jsonData['id'],PDO::PARAM_INT);
$sql->execute();
$rowCount = $sql->rowCount();
if(!$rowCount){
    $response = array(
        "code"=>200,
        "message"=>"No Rows Affected."
    );
}
else{
    $response = array(
        "code"=>200,
        "message"=>"User Updated successfully",
        "rowsAffected"=>$rowCount
    );
}


echo json_encode($response);
?>