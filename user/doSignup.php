<?php

require_once("../db_connect_bark_bijou.php");

if (!isset($_POST["account"])) {
    die("請循正常管道進入此頁");
}

$account = $_POST["account"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$email = $_POST["email"];

$patternAccount = "/^.{4,12}$/";

// echo strlen($account);
// if (strlen($account) < 4 || strlen($account) > 20) {
//     die("請輸入4~20字元的帳號");
// }
if (!preg_match($patternAccount, $account)) {
    die("請輸入4~20字元的帳號");
}

$sql = "SELECT *FROM users WHERE account='$account'";
$result = $conn->query($sql);
$userCount = $result->num_rows;
// echo $userCount;
if ($userCount == 1) {
    die("該帳號已經存在");
}

if (strlen($password) < 4 || strlen($password) > 20) {
    die("請輸入4~20字元的密碼");
}

if ($password != $repassword) {
    die("密碼不一致");
}
// 加密
$password = md5($password);

$now = date("Y-m-d H:i:s");
$sql = "INSERT INTO users (account, password, email, created_at, valid)
	VALUES ('$account', '$password', '$email', '$now', 1)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("location: users.php");
