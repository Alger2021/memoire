<!-- SELECT count(*) FROM `demandes` -->
<!-- SELECT count(*) FROM `demandes`WHERE demandes.statu!="inprocess"; -->
<!-- SELECT count(*) FROM `demandes`WHERE demandes.statu="inprocess" AND demandes.urgent=1; -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/analytics.css">
</head>
<body class="d-flex">
    <?php
        require "php/config.php";
        try{
            $path = "mysql:hostname=". dbhost .";dbname=". dbname;
            $conn = new PDO($path,dbuser,dbpass);
            $sql1 = $conn->query("SELECT count(*) AS total FROM `demandes`;");
            $sql2 = $conn->query("SELECT count(*) AS total FROM `demandes`WHERE demandes.statu!=\"inprocess\";");
            $sql3 = $conn->query("SELECT count(*) AS total FROM `demandes`WHERE demandes.statu=\"inprocess\" AND demandes.urgent=1;");
            $total_requests = $sql1->fetch(PDO::FETCH_ASSOC)["total"];
            $total_f_requests = $sql2->fetch(PDO::FETCH_ASSOC)["total"];
            $total_unf_requests = $total_requests - $total_f_requests;
            $total_unf_urgent_requests = $sql3->fetch(PDO::FETCH_ASSOC)["total"];
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        finally{
            $conn = null;
        }
    ?>
    <div class="side-menu" id="side-menu">
        <div class="header">
            <div class="logo">
                <a href=""><img src="picts/newlogo.svg" alt=""></a>
                <span>ZED</span>
            </div>
            <div class="minimize" id="minimize">
                <i class="fa-solid fa-angle-left"></i>
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
        <nav>
            <ul class="nav-header">
                <a class="active" href="analytics.php">
                    <li>
                        <i class="fa-solid fa-chart-pie"></i><span>Analytics</span>
                    </li>
                </a>
                <a class="extend" data-val="requests">
                    <li>
                        <i class="fa-solid fa-inbox"></i><span>Requests</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </li>
                </a>
                <ul class="submenu" id="requests">
                        <div class="LXV">
                            <a href="requests.php?level=0"><li class="active">All</li></a>
                            <a href="requests.php?level=1"><li>L1</li></a>
                            <a href="requests.php?level=2"><li>L2</li></a>
                            <a href="requests.php?level=3"><li>L3</li></a>
                            <a href="requests.php?level=4"><li>M1</li></a>
                            <a href="requests.php?level=5"><li>M2</li></a>
                    </div>
                </ul>
                <a href="users.html"><li><i class="fa-solid fa-user"></i><span>Users</span></li></a>
            </ul>

            <div class="nav-footer">
                <span class="hr"></span>
                <div id="admin" class="admin">
                    <img src="picts/user.png" alt="">
                    <div class="coords">
                        <span>Yahiaten</span>
                        <span>Admin</span>
                    </div>
                </div>
                
                <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </nav>
    </div>
    <main>
        <div class="header">
            <span>Analytics</span>
            <i class="fa-solid fa-sun"></i>
        </div>
        <div class="stats">
            <div class="card total">
                <div class="card-header">
                    <div class="title">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Total Requests</span>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <span><?php echo $total_requests;?></span>
            </div>
            <div class="card finished">
                <div class="card-header">
                    <div class="title">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        <span>Finished Requests</span>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <span><?php echo $total_f_requests;?></span>
            </div>
            <div class="card unfinished">
                <div class="card-header">
                    <div class="title">
                        <i class="fa-brands fa-square-x-twitter"></i>
                        <span>Unfinished Requests</span>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <span><?php echo "$total_unf_requests <span>$total_unf_urgent_requests Urgent</span>";?></span>
            </div>
        </div>
        <div class="chartscontainer">
            <div class="card pie">
                <div class="charts">
                    <div class="chart-btns">
                        <button class="active" onclick="destroyChart(this); fetchCreateChart('myChart',1,'pie')">By Year</button>
                        <button onclick="destroyChart(this); fetchCreateChart('myChart',2,'pie')">By Type</button>
                        <button onclick="destroyChart(this); fetchCreateChart('myChart',3,'pie')">By Statu</button>
                    </div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="card line">
                <div class="charts">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="js/analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
</body>

</html>