<?php
require_once("../db_connect_bark_bijou.php");

$sqlAll = "SELECT * FROM users WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$userCount = $resultAll->num_rows;

if (isset($_GET["q"])) {
    $q = $_GET["q"];
    $sql = "SELECT * FROM users WHERE name LIKE '%$q%'";
} else if (isset($_GET["p"]) && isset($_GET["order"])) {
    $p = $_GET["p"];
    $order = $_GET["order"];

    $orderClause = "";
    switch ($order) {
        case 1:
            $orderClause = "ORDER BY id ASC";
            break;
        case 2:
            $orderClause = "ORDER BY id DESC";
            break;
        case 3:
            $orderClause = "ORDER BY account ASC";
            break;
        case 4:
            $orderClause = "ORDER BY account DESC";
            break;
    }

    $perPage = 10;
    $startItem = ($p - 1) * $perPage;
    $totalPage = ceil($userCount / $perPage);
    $sql = "SELECT * FROM users WHERE valid=1 $orderClause LIMIT $startItem, $perPage";
} else {
    header("location: users.php?p=1&order=1");
}

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_GET["q"])) {
    $userCount = $result->num_rows;
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Bark & Bijou users</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include("../css.php") ?>
    <style>
        .primary {
            background-color: rgba(245, 160, 23, 0.919);
        }

        .list-btn a {
            background-color: transparent;
            color: rgb(215, 172, 41);
            border-color: transparent;
        }

        .list-btn a:hover {
            color: #b8860b;
        }

        .list-btn a:active {
            color: #b8860b;
            background-color: transparent;
        }

        .list-btn a.active {
            color: #b8860b;
            background-color: transparent;
        }

        .list-btn .btn {
            border: none;
            box-shadow: none;
            outline: none;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion primary" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bark & Bijou</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-user"></i>
                    <span>會員專區</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-user"></i>
                    <span>商品列表</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-user"></i>
                    <span>課程管理</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-user"></i>
                    <span>旅館管理</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-user"></i>
                    <span>文章管理</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-user"></i>
                    <span>優惠券管理</span></a>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Alerts -->
                        <!-- Nav Item - Messages -->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-0 text-gray-800">會員管理</h1>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="container">
                            <div class="py-2 row g-3 align-items-center">
                                <div class="col-md-6">
                                    <div class="hstack gap-2 align-item-center">
                                        <?php if (isset($_GET["q"])) : ?>
                                            <a class="btn btn-primary" href="users.php"><i class="fa-solid fa-arrow-left fa-fw"></i></a>
                                        <?php endif; ?>
                                        <div>共 <?= $userCount ?> 位使用者</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <form action="" method="get">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="q" <?php $q = "";
                                                                                                // if (isset($_GET["q"])) {
                                                                                                // $q = $_GET["q"];
                                                                                                // }
                                                                                                // $q=(isset($_GET["q"]))?
                                                                                                // $_GET["q"] : "";
                                                                                                $q = $_GET["q"] ?? ""; ?>
                                                value="<?= $q ?>">
                                            <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass fa-fw" type="submit"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="py-2 text-end">
                                <div class="btn-group">
                                    <a href="users.php?p=<?= $p ?>&order=3" class="btn btn-primary <?php if ($order == 3) echo "active" ?>"><i class="fa-solid fa-arrow-down-a-z fa-fw"></i></a>
                                    <a href="users.php?p=<?= $p ?>&order=4" class="btn btn-primary <?php if ($order == 4) echo "active" ?>"><i class="fa-solid fa-arrow-down-z-a fa-fw"></i></a>
                                </div>
                            </div>
                            <?php if ($userCount > 0): ?>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="row g-0 align-middle">
                                                <div class="d-flex align-items-center col-9">
                                                    id
                                                </div>
                                                <div class="col-3 list-btn">
                                                    <a href="users.php?p=<?= $p ?>&order=1" class="d-flex btn btn-sm p-0 <?php if ($order == 1) echo "active" ?>"><i class="fa-solid fa-caret-up "></i></a>
                                                    <a href="users.php?p=<?= $p ?>&order=2" class="d-flex btn btn-sm p-0 m-0 <?php if ($order == 2) echo "active" ?>"><i class="fa-solid fa-caret-down "></i></a>
                                                </div>
                                            </th>
                                            <th class="align-middle">account</th>
                                            <th class="align-middle">name</th>
                                            <th class="align-middle">phone</th>
                                            <th class="align-middle">email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows as $row): ?>
                                            <tr>
                                                <td class="align-middle"><?= $row["id"] ?></td>
                                                <td class="align-middle"><?= $row["account"] ?></td>
                                                <td class="align-middle"><?= $row["name"] ?></td>
                                                <td class="align-middle"><?= $row["phone"] ?></td>
                                                <td class="align-middle"><?= $row["email"] ?></td>
                                                <td class="align-middle">
                                                    <a class="btn btn-primary" href="user.php?id=<?= $row["id"] ?>"><i class="fa-regular fa-eye"></i></a>
                                                    <a class="btn btn-primary" href="user-edit.php?id=<?= $row["id"] ?>"><i class="fa-solid fa-fw fa-pen"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php if (isset($_GET["p"])): ?>
                                    <div>
                                        <nav aria-label="">
                                            <ul class="pagination">
                                                <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                                                    <?php
                                                    $active = ($i == $_GET["p"]) ? "active" : "";
                                                    ?>
                                                    <li class="page-item <?= $active ?>"><a class="page-link" href="users.php?p=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
                                                <?php endfor; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                <?php endif ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- End of Page Wrapper -->
                </div>
                <!-- Scroll to Top Button-->
            </div>
        </div>
    </div>
    <?php include("../js.php") ?>
    <script>

    </script>
</body>

</html>