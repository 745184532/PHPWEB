<?php 
    $title = "猫叔的博客2023";
    $bgColor = "#777";
?>
<!DOCTYPE html>
<html lang="zh">
    <?php
    $navbarArray= [
        [
            "href" => "home",
            "title" => "首页"
        ],
        [
            "href" => "about",
            "title" => "关于我"
        ],
        [
            "href" => "posts",
            "title" => "博客"
        ],
        [
            "href" => "contact",
            "title" => "联系我"
        ],
        [
            "href" => "test",
            "title" => "测试"
        ],
    ]
    ?>
    <?php
    $coutentArray = [
        [
            "content"=>'这里是您的博客内容。您可以使用HTML和CSS编写自己的网页。',
            "createDay" =>'2023.09.21',
        ],
        [
            "content" => '测试数据博客',
            "createDay" => '2023.10.21',
        ],
        [
            "content" => '文章列表',
            "createDay"  => '2023.11.21',
        ],
        [
            "content" => '联系方式',
            "createDay"  => '2023.11.21',
        ],
    ];

?>
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
        .navbar a.active {
            background-color: #ddd;
            color: red;
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
        .number{
            width: 50px;
            height: 50px;
            display: inline-block;
            background: #000;
            color: #fff;
            text-align: center;
            line-height: 50px;
            border-radius: 50%;
        }
        .text-area .active{
            background-color: red;
        }
        <?php
        foreach ($coutentArray as $key => $value){
            echo '
            .number'.$key.'{
                font-size: '.(12+$key*3).'px;
            }
            ';

        }
        ?>
    </style>
</head>

<body>

    <div class="navbar">
        <?php
        foreach ($navbarArray as $key => $value) {
            if($key == 0){
                echo '<a href="#' . $value["href"] . '" class="active">' . $value["title"] . '</a>';

            }else{
                echo '<a href="#' . $value["href"] . '">' . $value["title"] . '</a>';
            }

        }
        ?>
    </div>
    <div class="container">
        <h1 class="title">欢迎来到我的博客</h1>
            <?php
                foreach ($coutentArray as $key =>$value) {


            ?>
                <div class="text-area">
                    <?php
                        if($key == 0){
                           echo '<span class="number number'.$key.' active" >';

                        }else{
                            echo '<span class="number number'.$key.'">';
                        }
                    ?>
                    <?php echo $key+1 ?></span>
                    <span class="create-day"><?php echo $value["createDay"];?></span>
                    <?php echo $value["content"];?>
                </div>
        <?php
            }
        ?>
    </div>
</body>

</html>