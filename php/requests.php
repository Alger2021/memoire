<?php
$path = "mysql:host=" . dbhost . ";dbname=" . dbname;

$conn = new PDO($path, dbuser, dbpass);
if(!isset($_GET["level"]) || empty($_GET["level"])){
    $_GET["level"] = 0;
}
if($_GET["level"] === 0){
    $sql = $conn->prepare("SELECT user_table.matricule,
    user_table.name,
    user_table.surname,
    demandes.id,
    demandes.typefichier,
    demandes.addon,
    demandes.email,
    demandes.numerotlfn,
    demandes.observation,
    demandes.urgentdate,
    demandes.statu
    FROM user_table JOIN demandes
    ON user_table.matricule = demandes.foreign_key;");
}
else{
    $sql = $conn->prepare("SELECT user_table.matricule,
                            user_table.name,
                            user_table.surname,
                            demandes.id,
                            demandes.typefichier,
                            demandes.addon,
                            demandes.email,
                            demandes.numerotlfn,
                            demandes.observation,
                            demandes.urgentdate,
                            demandes.statu
                            FROM user_table JOIN demandes
                            ON user_table.matricule = demandes.foreign_key WHERE user_table.styear = ?;");
    $sql->bindParam(1,$_GET["level"],PDO::PARAM_INT);
    
}

$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $key=>$value){
    echo "<tr data-request-id='$value[id]'>";
    foreach($value as $k=>$val){
        if($k==="id"){
            continue;
        }
        else if($k==="statu"){
            switch ($val) {
                case 'ready':
                    echo "<td class='text-success'><i class=' fa-solid fa-circle-check'></i><span>ready</span></td>";
                    break;
                case 'refused':
                    echo '<td class=\'text-danger\'><i class=" fa-solid fa-circle-xmark"></i></i><span>refused</span></td>';
                    break;
                default:
                    echo '<td ><i class=" fa-solid fa-arrows-rotate"></i><span>in process</span></td>';
                    break;
            }
        }
        else{
            echo "<td>$val</td>";
        }
    };
    echo "<td>
            <div class=\"options\">
                <i data-bs-toggle=\"modal\" data-bs-target=\"#editRequest\" class=\"fa-solid text-primary fa-pen-to-square\"></i>
                <i data-bs-toggle=\"modal\" data-bs-target=\"#deleteRequest\" class=\"fa-solid fa-trash-can\"></i>
            </div>
        </td>";
    echo "</tr>";
}

?>