<?php
session_start();

if(!($_SERVER["REQUEST_METHOD"]==="POST")){
    echo "NO POST REQUEST SENT";
    die();
}

require "config.php";

$path = "mysql:host=" . dbhost . ";dbname=" . dbname;

// connect to db
try {
    $conn = new PDO($path, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // exceptions occurs when there is error
    if (isset($_POST['submit'])) {
        if ($_POST["matricule"] && $_POST["password"]) {
            if(!ctype_digit($_POST["matricule"])){
                echo "matricule incorrect";
                die();
            }
            $sql = $conn->prepare("SELECT * FROM user_table WHERE matricule = ?");
            $sql->bindParam(1, $_POST["matricule"], PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                if ($_POST["password"] === $result["password"]) {
                    $_SESSION["matricule"] = $result["matricule"];
                    header("location:../index.php");
                } else {
                    echo "wrong password";
                }
            }
            else{
                echo "matricule doesn't exist";
            }
        } else {
            echo "please fill in all the informations";
        }
    } else {
        echo "Submit Button was not pressed";
    }
} catch (PDOException $error) {
    echo "ERROR<br>";
    print_r($error->errorInfo);
} finally {
    $conn = null;
}
