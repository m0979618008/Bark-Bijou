<?php
if (!isset($_GET["id"])) {
    header("location: users.php");
}

$id = $_GET["id"];
require_once("../db_connect_bark_bijou.php");
$sql = "SELECT * FROM users WHERE id = $id AND valid=1";
// 之後要進入在網址後加 ?id=
$result = $conn->query($sql);
// $rows=$result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows[0]);
$row = $result->fetch_assoc();
$userCount = $result->num_rows;

// var_dump($row);
?>
<!doctype html>
<html lang="zn-TW">

<head>
    <title>user</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include("../css.php") ?>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">系統資訊</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除使用者?
                </div>
                <div class="modal-footer">
                    <a role="button" type="button" class="btn btn-danger" href="userDelete.php?id=<?= $row["id"] ?>">確認</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-primary" href="users.php?id=<?= $row["id"] ?>"><i class="fa-solid fa-arrow-left fa-fw"></i></a>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-9">
                <?php if ($userCount > 0): ?>
                    <form action="doUpdateUser.php" method="post">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <table class="table table-bordered">
                            <tr>
                                <td>id</td>
                                <td><?= $row["id"] ?></td>
                            </tr>
                            <tr>
                                <td>account</td>
                                <td><?= $row["account"] ?></td>
                            </tr>
                            <tr>
                                <td>name</td>
                                <td>
                                    <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>phone</td>
                                <td>
                                    <input type="tel" class="form-control" name="phone" value="<?= $row["phone"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td>
                                    <input type="email" class="form-control" name="email" value="<?= $row["email"] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>created at</td>
                                <td><?= $row["created_at"] ?></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk fa-fw"></i></button>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fa-solid fa-trash fa-fw"></i></a>
                        </div>
                    </form>
                <?php else: ?>
                    <h2>使用者不存在</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include("../js.php") ?>
    <script>

    </script>
</body>

</html>