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
    <title>Flying Catss-如何加入管理</title>
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
            <h1>如何加入管理</h1>
            <ul>
                <li>1级升2级</li>
                <li>2级升3级</li>
                <li>3级升4级</li>
                <li>4级升5级</li>
            </ul>
            <p>A,1级升2级</p>
            <p>权限：</p>
            <p>可以发评论警告帖、删评论</p>
            <p>要满足以下条件：</p>
            <ul>
                <li>加入本站3个月</li>
                <li>申请之日起3个月内未有任何处罚记录（不包括申诉撤销）</li>
                <li>官方有招募需求</li>
            </ul>
            <p>提交申请后如果通过，就可升为1.1级（观察期1，时长3个月，之后正升为2级，其中若违反站规将降为1级，并按站规处罚）</p>
            <p>B，2级升3级</p>
            <p>权限：</p>
            <p>可以管理员发管理帖、删除违规帖子，后台：加入申请管理</p>
            <p>要满足以下条件：</p>
            <ul>
                <li>加入本站5个月</li>
                <li>成为2.0（不包括1.1级）1个月及以上</li>
                <li>申请之日起3个月内未有任何处罚记录（不包括申诉撤销）</li>
            </ul>
            <p>提交申请后如果通过，就可升为2.1级（观察期1，时长3个月，之后正升为3级，其中若违反站规将降为1级，并按站规处罚）</p>
            <p>C，3级升4级</p>
            <p>权限：</p>
            <p>可以操作除外管理员管理外的网站页面内的一切操作</p>
            <p>要满足以下条件：</p>
            <ul>
                <li>加入本站10个月</li>
                <li>成为3.0（不包括2.1级）3个月及以上</li>
                <li>申请之日起9个月内未有任何处罚记录（不包括申诉撤销）</li>
            </ul>
            <p>
                <em>ps：4级申请将十分严格</em>
            </p>
            <p>提交申请后如果通过，就可升为3.1级（观察期1，时长3个月，之后正升为4级，其中若违反站规将降为1级，并按站规处罚）</p>
            <p>D，4级升5级</p>
            <p>权限：</p>
            <p>所有</p>
            <p>要满足以下条件：</p>
            <ul>
                <li>加入本站10个月</li>
                <li>成为4.0（不包括3.1级）1个月及以上</li>
                <li>申请之日起13个月内未有任何处罚记录（不包括申诉撤销）</li>
                <li>你和站长是铁哥们或技术人员（无视前三条，有此条件将优先考虑）</li>
            </ul>
        </div>
    </div>
    <div class="footter"><a href="#">备案号：**********</a></div>
</body>
</html>