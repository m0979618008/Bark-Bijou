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
    // echo "total page: $totalPage";
    // if ($order == 1) {
    //     $sql = "SELECT * FROM users WHERE valid=1 ORDER BY id ASC LIMIT $startItem, $perPage";
    // } else if ($order == 2) {
    //     $sql = "SELECT * FROM users WHERE valid=1 ORDER BY id DESC LIMIT $startItem, $perPage";
    // }
} else {
    // $sql = "SELECT * FROM users WHERE valid=1";
    header("location: users.php?p=1&order=1");
}

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_GET["q"])) {
    $userCount = $result->num_rows;
}

// var_dump($rows);
?>
<!doctype html>
<html lang="en">

<head>
    <title>users</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include("../css.php") ?>
</head>

<body>
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
                <a href="users.php?p=<?= $p ?>&order=1" class="btn btn-primary <?php if ($order == 1) echo "active" ?>"><i class="fa-solid fa-arrow-down-1-9 fa-fw"></i></a>
                <a href="users.php?p=<?= $p ?>&order=2" class="btn btn-primary <?php if ($order == 2) echo "active" ?>"><i class="fa-solid fa-arrow-down-9-1 fa-fw"></i></a>
                <a href="users.php?p=<?= $p ?>&order=3" class="btn btn-primary <?php if ($order == 3) echo "active" ?>"><i class="fa-solid fa-arrow-down-a-z fa-fw"></i></a>
                <a href="users.php?p=<?= $p ?>&order=4" class="btn btn-primary <?php if ($order == 4) echo "active" ?>"><i class="fa-solid fa-arrow-down-z-a fa-fw"></i></a>
            </div>
        </div>
        <?php if ($userCount > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>account</th>
                        <th>name</th>
                        <th>phone</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["account"] ?></td>
                            <td><?= $row["name"] ?></td>
                            <td><?= $row["phone"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td>
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
    <?php include("../js.php") ?>
    <script>

    </script>
</body>

</html>