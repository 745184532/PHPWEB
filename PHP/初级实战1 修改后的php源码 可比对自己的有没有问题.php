<?php 
    $title = "猫叔的博客2023";
    $bgColor = "#777";
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: <?php echo $bgColor;?>;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .text-area {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="#home">首页</a>
        <a href="#about">关于我</a>
        <a href="#posts">博客</a>
        <a href="#contact">联系我</a>
    </div>
    
    <?php 
        // 博客内容 1条
        /* $content = '这里是您的博客内容。您可以使用HTML和CSS编写自己的网页。';
        
        $createDay = '2023.09.21'; */

        $content = '这里是您的博客内容。您可以使用HTML和CSS编写自己的网页。';
        
        $createDay = '2023.09.21';
    ?>
    <div class="container">
        <h1 class="title">欢迎来到我的博客</h1>
        <div class="text-area">
            <span class="create-day"><?php echo $createDay;?></span>
            <?php echo $content;?>
        </div>

        <?php 
            // 博客内容 1条
            /* $content = '这里是您的博客内容。您可以使用HTML和CSS编写自己的网页。';
            
            $createDay = '2023.09.21'; */

            $content = '测试数据博客';
            
            $createDay = '2023.10.21';
        ?>

        <div class="text-area">
            <span class="create-day"><?php echo $createDay;?></span>
            <?php echo $content;?>
        </div>

        <?php 
            $createDay = '2023.11.21';
            echo '
            
            <div class="text-area">
                <span class="create-day">'.$createDay.'</span>
                文章列表
            </div>

            ';
        ?>

        
        <div class="text-area">
            <span class="create-day">2023.09.21</span>
            联系方式等
        </div>
        <div class="text-area">
            <span class="create-day">2023.09.20</span>
            这里是您的博客内容。您可以使用HTML和CSS编写自己的网页。
        </div>
    </div>
</body>

</html>