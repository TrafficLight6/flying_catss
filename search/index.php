<?php
    include('../function_lib.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/read.css">
    <script src="/live2d-widget/autoload.js"></script>
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>Flying Catss</title>
</head>
<body>
    <div class="header">
        <div class="top"><h1><i>Flying Catss!!!</i></h1><p>一个冲浪者，开发人员和<del>沙雕</del>的贴吧社区</p><form name="search" action="/search"><input type="text" name="kw" placeholder="搜索帖子"><input class="sub" type="submit" value="搜索"></form></div>
        <div class="link"><span class="l"><a href="/">主页</a>|<a href="/review">所有帖子</a>|<a href="/page">永久页面</a>|<a href="/mycode">贡献源码</a></span></div>
    </div>
    <div class="main">
        <div class="left">
            <div class="user"><?php aboutme()?></div>
            <div class="help">
                <h2>帮助</h2><hr>
                <p><a href="/help/how_join">如何加入本站</a></p>
                <p><a href="/help/how_white">如何发布帖子</a></p>
                <p><a href="/help/how_admin">如何加入管理</a></p></div>
            <div class="admin">
                <h2>管理专用</h2><hr>
                <p><a href="/admin">后台管理</a></p>
                <p><a href="/review/new/admin">新发管理贴</a></p>
            </div>
            <div class="friend_link">
                <h2>快速连接</h2><hr>
                <p><a href="https://bilibili.com">哔哩哔哩</a></p>
                <p><a href="https://github.com">Github</a></p>
                <p><a href="https://cn.bing.com">必应搜索</a></p>
                <p><a href="https://baidu.com">百度搜索</a></p>
            </div>
        </div>
        <div class="right">
            <?php
                if((isset($_GET['kw'])==false)or(@$_GET['kw']=='')){
                    echo '<h1>关键词呢？</h1>';
                }else{
                    $adminlinknum=0;
                    $normallinknum=0;
                    echo '<h1>关键词'.$_GET['kw'].'的搜索结果（不区分大小写）</h1><hr>';
                    echo '<h1>管理贴</h1>';
                    $dir=scandir('../review/lib/admin');
                    foreach($dir as $value){
                        if (($value=='..')or($value=='.')){
                            // no
                        }else{
                            if (is_dir('../review/lib/admin/'.$value)){
                                $fopen=fopen('../review/lib/admin/'.$value.'/title.fcr','r');
                                $title=fgets($fopen);
                                fclose($fopen);

                                if (strstr($title,$_GET['kw'])!=false){
                                    echo '<a href="/review/read?mod=a&rid='.$value.'">'.$title.'</a><br><br>';
                                    $adminlinknum++;
                                }
                            }
                        }
                    }
                    if ($adminlinknum==0){
                        echo '<h1>无</h1>';
                    }



                    
                    echo '<hr>';



                    echo '<h1>普通贴</h1>';
                    $dir=scandir('../review/lib/normal');
                    foreach($dir as $value){
                        if (($value=='..')or($value=='.')){
                            // no
                        }else{
                            if (is_dir('../review/lib/normal/'.$value)){
                                $fopen=fopen('../review/lib/normal/'.$value.'/title.fcr','r');
                                $title=fgets($fopen);
                                fclose($fopen);

                                if (strstr($title,$_GET['kw'])!=false){
                                    echo '<a href="/review/read?mod=n&rid='.$value.'">'.$title.'</a><br><br>';
                                    $normallinknum++;
                                }
                            }
                        }
                    }
                    if ($normallinknum==0){
                        echo '<h1>无</h1>';
                    }

                    
                }
            ?>
        </div>
    </div>
    <div class="footter"><a href="#">备案号：**********</a></div>
</body>
</html>