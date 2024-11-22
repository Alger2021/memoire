<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="libs/bootstrapv5/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link rel="stylesheet" href="libs/datatable/dataTables.css">
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/requests.css">
</head>
<body class="d-flex">
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
                <a  href="analytics.html">
                    <li>
                        <i class="fa-solid fa-chart-pie"></i><span>Analytics</span>
                    </li>
                </a>
                <a class="extend active" data-val="requests">
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
                        <?php 
                            require "php/config.php";
                        ?>
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
            <span>Requests</span>
            <i class="fa-solid fa-sun"></i>
        </div>
        <div class="all">
            <table id="tablerequest">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Type</th>
                        <th>Added</th>
                        <th>Urgent Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require "php/requests.php";
                    ?>
                </tbody>
            </table>
            <!-- Delete Request Modal -->
            <div class="modal fade" id="deleteRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header text-danger">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-trash"></i>Delete Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        Are you sure you want to delete the request made by : 
                        <p id="modal-row-fullname"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modalclosebtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="modaldeletebtn"  class="btn btn-danger">Delete</button>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="libs/bootstrapv5/bootstrap.bundle.min.js"></script>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <script src="libs/datatable/dataTables.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="js/requests.js"></script>
</body>

</html>