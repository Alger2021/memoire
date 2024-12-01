<?php
session_start();

if(!($_SERVER["REQUEST_METHOD"]==="POST")){
    echo "NO POST REQUEST SENT";
    die();
}


require "config.php";
$path = "mysql:host=" . dbhost . ";dbname=" . dbname;

try{
    echo "welcome";
    $conn = new PDO($path,dbuser,dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["submit"]) && isset($_POST["typefichier"])){
        if(empty(trim($_POST["typefichier"]))){
            echo "Type of Dropdown is empty";
            die();
        }
        $date = date('Y-m-d');
        $statu = "inprocess";
        $query = $conn->prepare("INSERT INTO demandes(typefichier,addon,email,numerotlfn,descriptions,urgent,urgentdate,statu,foreign_key) VALUES (?,?,?,?,?,?,?,?,?);");
        $query->bindParam(1,$_POST["typefichier"],PDO::PARAM_STR);
        $query->bindParam(2,$date,PDO::PARAM_STR);
        $query->bindParam(3,$_POST["email"],PDO::PARAM_STR);
        $query->bindParam(4,$_POST["numerotlfn"],PDO::PARAM_STR);
        $query->bindParam(5,$_POST["descriptions"],PDO::PARAM_STR);
        $query->bindParam(6,$_POST["urgent"],PDO::PARAM_BOOL);
        $query->bindParam(7,$_POST["urgentdate"],PDO::PARAM_STR);
        $query->bindParam(8,$statu,PDO::PARAM_STR);
        $query->bindParam(9,$_SESSION["matricule"],PDO::PARAM_INT);
        $query->execute();
        header("location:../index.php");
    }
}
catch(PDOException $error){
    echo "bye";
    print_r($error->getMessage());
}
finally{
    $conn = null;
}

?>