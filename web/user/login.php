<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <?php
    include "./common/head.php";
    ?>
</head>
<body>
<?php
include "./common/header.php";
?>
<div class="main">
<div class="container">
    <h2 style="margin-bottom: 10px; text-align: center;">用户登录</h2>
    <form action="" id="submit_form" method="post">
        <ul>
            <li class="line">
                <span class="title">用户名：</span>
                <input type="text"  name="username">
            </li>
            <li class="line">
                <span class="title">密码：</span>
                <input type="password" name="password" required>
            </li>
            <li class="line submit_line" style="margin-top: 20px;">
                <input type="submit" value="提交登录" style="margin-left: 100px;">
                <a href="./register.php">没有账号？去注册</a>
            </li>
        </ul>
    </form>
</div>
</div>
<?php
include "./common/footer.php";
?>
</body>
</html>