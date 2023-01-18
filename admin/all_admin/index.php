<?php
    include('../../function_lib.php');
        if (class_check($_COOKIE['class'],4.1)==false){
            echo '<script type="text/javascript">alert("哎呀！你的权限过低！");</script>';
            echo '<script type="text/javascript">window.location.href="..";</script>';
        }

        if ((isset($_GET['user_id']))and(isset($_GET['user_class']))){
            if (class_check($_COOKIE['class'],4.1)){
                $old_c=$_GET['user_class'];
                (float)$old_c;
                $new_c=number_format($old_c, 1, '.', '');
                (string)$new_c;
                $connID=con_mysql();
                $reslut=mysqli_query($connID,'USE flying');
                $reslut=mysqli_query($connID,'UPDATE flying.user_table SET class='.$new_c.' WHERE id ='.$_GET['user_id']);
                echo '<script type="text/javascript">window.location.href="..";</script>';
                mysqli_close($connID);
            }
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
        <form name="userkw" onsubmit="return check()"><input placeholder="用户名全称（不支持模糊搜索）" name="kw" size="50"><input type="submit" value="搜索"></form>
        <script>
            function check(){
                if (userkw.kw.value==""){
                    alert("请输入用户全称");
                    return false;
                }
            }
        </script>
        <?php
            if (isset($_GET['kw'])){
                $connID=con_mysql();
                $reslut=mysqli_query($connID,'USE flying');
                $reslut=mysqli_query($connID,'SELECT id,class FROM user_table WHERE username="'.$_GET['kw'].'"');
                $array=mysqli_fetch_array($reslut);
                if ((isset($array['id']))and(isset($array['class']))){
                    echo '<h1>用户名'.$_GET['kw'].'</h1>';
                    $c=$array['class'];
                    (float)$c;
                    $c=number_format($c, 1, '.', '');
                    if ($c==1){
                        $t='    用户';
                    }elseif (($c>1)and($c<=2)){
                        $t='    社区监督员';
                    }elseif (($c>2)and($c<=3)){
                        $t='    社区管理员';
                    }elseif (($c>3)and($c<=4)){
                        $t='    主管';
                    }elseif ($c=5){
                        $t='    超级管理员';
                    }else{
                        // no
                    }
                    echo '<h1>等级:'.$array['class'].$t.'</h1>';
                    if ($array['class']=='5.0'){
                        echo '<h1>超级管理员无法修改等级</h1>';
                    }else{
                        echo '
                        <form>
                        <p>用户id:<input type="text" name="user_id" value="'.$array['id'].'" readonly></p>
                        <p>用户等级:<input type="number" name="user_class" value="'.$array['class'].'" min="1.0" max="5.0" step="0.1"></p>
                        <p><input type="submit" value="修改"></p>
                        </form>
                        ';
                    }
                }else{
                    echo '<h1>未找到用户</h1>';
                }
            }
        ?>
    </div>
</body>
</html>