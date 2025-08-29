<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户注册</title>
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
        <h2 style="margin-bottom: 10px; text-align: center;">用户注册</h2>
        <form action="" id="submit_form" onsubmit="sunbmitForm(event)"> <!-- 根据提交拿到事件 -->
            <ul>
                <li class="line">
                    <span class="title">用户名：</span>
                    <input type="text"  name="username">
                </li>
                <li class="line">
                    <span class="title">密码：</span>
                    <input type="password" name="password" required>
                </li>
                <li class="line">
                    <span class="title">确认密码：</span>
                    <input type="password" name="re_password" required>

                </li>
                <li class="line submit_line" style="margin-top: 20px;">
                    <input type="submit" value="提交注册12" style="margin-left: 100px;">
                    <a href="./login.php">已有账号？去登录</a>
                </li>
            </ul>
        </form>
    </div>
    </div>
    <?php
    include "./common/footer.php";
    ?>
<script>
    function isEmpty(str){
        return str === undefined ||str ===null ||str.trim() ===''
    }
    function strlenMin(str){
        return str.length<6
    }
    function sunbmitForm(event){
        event.preventDefault()
        // 阻止默认行为
        console.log("点击了提交")
        var from = document.getElementById('submit_form')
        var fromData = new FormData(from)
        var datas = fromData.entries()
        var pass, re_pass
        for (const iterator of datas){
            console.log('iterator',iterator);

            if (isEmpty(iterator[1])){
                alert(iterator[0] + "不能为空")
                break;
            //     这里的提示框很难看，可以使用框架的来写liui里面的layer,就可以弹出更好看的
            }
            if (iterator[0].indexOf('password')>=0){
                if (iterator[0] === 'password'){
                    pass = iterator[1]
                }
                else{
                    re_pass =iterator[1]
                }
                if (strlenMin(iterator[1])){
                    alert(iterator[0] + "长度不能小于6")
                    return;
                }
            }
        }
        if (pass && re_pass && pass !== re_pass){
            alert('两次输入的密码不一致')
            return;
        }

        var url = "/api/register.php"
        //fetch 请求
        fetch(url,{
            method:'POST',
            body:fromData
        })
            .then(response => response.json())
            .then(data =>{
                console.log(data);
                if(data.code !== 0){
                    alert(data.msg)
                }else{
                    console.log("提交注册成功")
                }
            })
            .catch(error=>{
                console.log('error',error);
            })
    }
</script>
</body>
</html>