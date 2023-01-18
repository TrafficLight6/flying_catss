<?php
    include('../../function_lib.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/help.css">
    <script src="/live2d-widget/autoload.js"></script>
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>Flying Catss-如何发帖</title>
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
        <h1 style="text-align: center;">如何发布帖子</h1>
        <p>要满足下述要求：</p>
        <ol>
            <li>是本站成员</li>
            <li>账号未被封禁</li>
        </ol>
        <p>之后再主页“最近新发帖”或所有帖子有发新帖按钮，点击进入，写贴发布</p>
        </div>
    </div>
    <div class="footter"><a href="#">备案号：**********</a></div>
</body>
</html>