<?php 
session_start() ;

if(!isset($_SESSION["matricule"])){
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="container">
            <a href="#"><img src="picts/logo2.svg" alt=""></a>
            <div class="userCard">
                <i class="fa-solid fa-user-graduate"></i>
                <div class="userCords">
                    <p>Welcome</p>
                    <?php 
                        require "php/config.php";
                        try{
                            $path = "mysql:hostname=". dbhost .";dbname=". dbname;
                            $conn = new PDO($path,dbuser,dbpass);
                            $sql = $conn->prepare("SELECT * FROM user_table WHERE matricule = ? LIMIT 1;");
                            $sql->bindParam(1,$_SESSION["matricule"],PDO::PARAM_INT);
                            $sql->execute();
                            $result = $sql->fetch();
                            echo "<span>$result[name] $result[surname]</span>";
                        }
                        catch(PDOException $e){
                            echo $e->getMessage();
                        }
                        finally{
                            $conn = null;
                        }
                    ?>
                    
                </div>
                <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="tabs">
                <button class="tab active" data-tab="page1" >Add a request</button>
                <button class="tab" data-tab="page2" >Show Requests</button>
            </div>
            <div id="page1" class="page page1 active">
                <form action="php/request.php" method="post">
                    <span class="kite">Demande d'un fichier :</span>
                    <div class="data">
                        <input type="hidden" name="typefichier" id="dropdownval">
                        <div class="dropdown">
                            <div class="select">
                                <span>certificat</span>
                                <div class="arrow"></div>
                            </div>
                            <ul class="">
                                <li class="active" data-val="certificat">certificat</li>
                                <li data-val="attestation" >attestation</li>
                                <li data-val="releve">releve</li>
                            </ul>
                        </div>

                        <div class="matriculedata">
                            <input type="text" name ="email" id="email" placeholder="Email">
                            <label for="matricule">Email:</label>
                        </div>
                        <div class="matriculedata">
                            <input type="text" name ="numerotlfn" id="numerotlfn" placeholder="Numero telephone">
                            <label for="matricule">Numero telephone:</label>
                        </div>

                        
                    </div>
                    <textarea  placeholder="Description Here..." name="descriptions" id="" maxlength="1000"></textarea>
                    
                    <div class="remember">
                        <span class="on"><span class="yes">ON</span><span class="no">OFF</span><span class="off"></span></span>
                        <input type="hidden" name="urgent" value="1" id="urgent">
                        <label for="urgent">Demande urgent ?</label>
                    </div>
                    <input type="date" value="2024-01-01" name="urgentdate" id="urgentdate">
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Submit">
                    
                </form>
            </div>
            <div id="page2" class="page page2">
                <table>
                    <thead>
                        <th>Type</th>
                        <th>Add on</th>
                        <th>Urgent</th>
                        <th>Observation</th>
                        <th>status</th>
                        <th>Cancel</th>
                    </thead>
                    <tbody>
                        <?php include "php/demandes.php";?>


                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="js/index.js"></script>
</body>
</html>