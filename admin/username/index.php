<?php
    include('../../function_lib.php');
        if (class_check($_COOKIE['class'],3.1)==false){
            echo '<script type="text/javascript">alert("哎呀！你的权限过低！");</script>';
            echo '<script type="text/javascript">window.location.href="..";</script>';
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>Flying Catss后台</title>
</head>
<body>
    <div class="left">
        <h5>Flying catss后台管理</h5>
        <br>
        <br>
        <p><a href="../..">返回主页</a></p>
        <hr>
        <p><a href="../?id=1">加入申请</a></p>
        <hr>
        <p><a href="../?id=2">处罚申诉</a></p>
        <hr>
        <p><a href="../?id=3">账号管理</a></p>
        <hr>
        <p><a href="../?id=4">管理员管理</a></p>
        <hr>
        <p><a href="../?id=5">通知管理</a></p>
        
    </div>
    <div class="right">
        <?php
            $result=search_user($_GET['unkw']);
            if ($result==false){
                echo '<h1>未找到用户</h1>';
            }else{
                echo '<h1>用户ID：'.$result['id'].'</h1>';
                echo '<h1>用户邮箱：'.$result['email'].'</h1>';
                echo '<h1>用户名：'.$_GET['unkw'].'</h1>';
                echo '<h1>用户加入日期：'.$result['join_date'].'</h1>';
                echo '<h1>用户等级：'.$result['class'].'</h1>';
                if (($result['ban']==false)and(class_check($result['class'],4.1)==false)){
                    echo '<h1>状态:<span style="color:#00ff00;">正常</span></h1>';
                    echo '<p>封禁此人</p>
                        <form name="bantime" action="../">
                        <input name="ban_id" type="text" value="'.$result['id'].'" readonly style="height:0px;width:0px;">
                        <p>封禁天数<input name="day" type="number" placeholder="封禁天数" min="1" value="1"></p>
                        <input value="封禁" type="submit">
                        </form>';
                }elseif (($result['ban']==true)){
                    echo '<h1>状态:<span style="color:#ff0000;">封禁</span></h1>';
                    echo '<a href="../?deban_id='.$result['id'].'" style="color:#000000;">解封此人</h1>';
                }elseif (($result['ban']==false)and(class_check($result['class'],4.1))){
                    echo '<h1><em><span style="color:#d800ff;">超管！！！</span></em></h1>';
                }
            }
        ?>
    </div>
</body>
</html>