<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>登录</title>
</head>
<body>
    <div class="login" onsubmit="return mycheak()">
        <div class="title">
            <h1>登录</h1>
        </div>
        <form name="login" method="post">
        <div class="input">
            <p><input class="text" type="text" placeholder="用户名" name="username"></p>
            <p><input class="text" type="password" placeholder="密码" name="password"></p>
        </div>
        <p><input class="checkbox" type="checkbox" name="keep_log" value="1">保持登录状态</p>
        <p><input class="sub" type="submit" value="登录"></p>
        </form>
        <i>忘记密码或修改密码请和4级及以上管理员联系</i>
    </div>

    <script>
        function mycheak(){
            if (login.username.value==""){
                alert("用户名不可以为空(恼");login.username.focus();return false;
            }
            if (login.password.value==""){
                alert("密码不可以为空(恼");login.password.focus();return false;
            }
        }
    </script>

<?php
    include('../function_lib.php');
    if((isset($_POST['username']))and(isset($_POST['password']))){
        if(login($_POST['username'],$_POST['password'])){
            if (isset($_POST['keep_log'])){
                header("Location: /?doid=1&un=".$_POST['username']."&mode=".$_POST['keep_log']);
            }else{
                header("Location: /?doid=1&un=".$_POST['username']);
            }
        }else{
            echo '<script>alert("用户名或密码错误或账号未激活或被封禁");</script>';   
        }
    }
?>

</body>
</html>