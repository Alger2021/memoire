<?php
session_start();

if(!($_SERVER["REQUEST_METHOD"]==="POST")){
    echo "NO POST REQUEST SENT";
    die();
}

require 'models.php';
require 'users.php';
require 'admins.php';
require 'demandes.php';

try {
    $db = new Database();
    $dbconn = $db->connect();
    $user = new User($dbconn);
    $demand = new Demandes($dbconn);
    $admin = new Admins($dbconn);
    $target = $_POST['target'] ?? '';

    switch ($target) {
        case 'login':
            if (isset($_POST['submit'])) {
                if ($_POST["matricule"] && $_POST["password"]) {
                    if(!ctype_digit($_POST["matricule"])){
                        echo "matricule incorrect";
                        die();
                    }
        
                    $result = $user->user_data($_POST["matricule"]);  // check if user exists, and fetch all the data
        
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
            break;

        case 'demand':
            if(isset($_POST["submit"]) && isset($_POST["typefichier"])){
                if(empty(trim($_POST["typefichier"]))){
                    echo "Type of Dropdown is empty";
                    die();
                }
                if(!ctype_digit($_POST["numerotlfn"])){
                    die("Try a valid phone number!");
                }
                $date = date('Y-m-d');
                $statu = "inprocess";
                
                if((int)$_POST["urgent"]===1){
                    $p = $_POST["urgentdate"];
                }
                else{
                    $p = null;
                }
                $result = $demand->insert_demand($_POST["typefichier"],$date,$_POST["email"],$_POST["numerotlfn"],$_POST["descriptions"],$_POST["urgent"],$p,$statu,$_SESSION["matricule"]);
                if($result>0){
                    // successfully inserted
                }
                else{
                    // err
                }
            }
            header("location:../index.php");
            
            break;
        case 'addAdmin':
            $fullname = trim($_POST["fullname"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $confirmpassword = $_POST["confirm-pass"];
            
            if(isset($_POST["submit"]) && isset($fullname) && isset($email) && isset($password) && isset($confirmpassword)){
                if (empty($fullname) || empty($email) || empty($password) || empty($confirmpassword)) {
                    die("All fields are required.");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    die("Invalid email format.");
                }
                if ($password !== $confirmpassword) {
                    die("Passwords do not match.");
                }
                // check if email exists
                $result = $admin->admin_data($email);
                if(count($result)>0){
                    die("Email already Exists!");
                }
                $result2 = $admin->add_admin($fullname,$email,$password);
                if($result2 == 0){
                    echo $result2;
                    die("something went wrong and the admin wasn't added!");
                }
                header("location:../analytics.php");
            }
            break;
        case 'loginAsAdmin':
            if (isset($_POST['submit'])) {
                if ($_POST["email"] && $_POST["password"]) {
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        die("Invalid email format.");
                    }
        
                    $result = $admin->admin_data($_POST["email"]);  // check if admin exists, and fetch all the data
        
                    if ($result) {
                        if ($_POST["password"] === $result["password"]) {
                            $_SESSION["email"] = $result["email"];
                            header("location:../analytics.php");
                        } else {
                            die("wrong password") ;
                        }
                    }
                    else{
                        die("Email doesn't exist") ;
                    }
                } else {
                    die("please fill in all the informations");
                }
            } else {
                die("Submit Button was not pressed");
            }
            break;
        default:
            die("No action.");
    }

} catch (PDOException $error) {
    echo "ERROR<br>";
    print_r($error->errorInfo);
} finally {
    $dbconn = null;
}
