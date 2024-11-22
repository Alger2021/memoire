<?php 

$path = "mysql:host=" . dbhost . ";dbname=" . dbname;
$conn = new PDO($path,dbuser,dbpass);
$sql = $conn->prepare("SELECT typefichier,addon,urgent,observation,statu FROM demandes WHERE foreign_key = ?;");
$sql->bindParam(1,$_SESSION["matricule"],PDO::PARAM_INT);
$sql->execute();
$result = $sql->fetchAll();
foreach ($result as $key => $value) {
    echo "<tr>
    <td>$value[0]</td>
    <td>$value[1]</td>";
    if($value[2]===1){
        echo "<td>YES</td>";
    }
    else{
        echo "<td>NO</td>";
    }
    echo "<td>$value[3]</td>";
    if($value[4]==="ready"){
        echo "<td><i class=\"fa-solid fa-circle-check\"></i>$value[4]</td>";
    }
    elseif($value[4]==="inprocess"){
        echo "<td><i class=\"fa-solid fa-arrows-rotate\"></i>In process</td>";
    }
    elseif($value[4]==="refused")
    {
        echo "<td><i class=\"fa-solid fa-circle-xmark\"></i>Refused</td>";
    }
    else{
        echo "<td>$value[4]</td>";
    }
    echo "<td><a href=\"\"><i class=\"fa-solid fa-trash-can\"></i></a></td></tr>";

}

?>