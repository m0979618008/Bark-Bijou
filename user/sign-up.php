<!doctype html>
<html lang="en">

<head>
    <title>sign up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php include("../css.php") ?>
</head>

<body>
    <div class="container">
        <div class="row justify-content-start align-items-center vh-100">
            <div class="col-lg-4 col-md-6">
                <h3>帳號註冊</h3>
                <div class="mt-3">
                    <form action="doSignup.php" method="post">
                        <div class="mb-2">
                            <label for="" class="form-label">帳號</label>
                            <input type="text" class="form-control" name="account" id="account" required minlength="4" maxlength="20">
                            <div class="form-text">請輸入4~20字元的帳號</div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">密碼</label>
                            <input type="password" class="form-control" name="password" id="password" required minlength="4" maxlength="20">
                            <div class="form-text">請輸入4~20字元的密碼</div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">確認密碼</label>
                            <input type="password" class="form-control" name="repassword" id="repassword" required>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">輸入電子信箱</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <button class="btn btn-primary" type="submit">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>