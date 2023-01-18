<?php
    include('function_lib.php');
    if (isset($_GET['doid'])){
        if ($_GET['doid']=='1'){
            if (isset($_GET['un'])){
                if (isset($_GET['mode'])){
                    make_cookie($_GET['un'],'1');
                }else{
                    make_cookie($_GET['un'],'0');
                }
            }
        }elseif ($_GET['doid']=='2'){
            logout();
        }elseif ($_GET['doid']=='3'){
            if (rename_check($_POST['username'])){
               signup();
            }else{
                echo '<script>alert("用户名已被占用")</script>';
                echo '<script language="javascript" type="text/javascript">window.location.href="/signup"</script>';
            }
        }
    }

    if (isset($_GET['userid'])){
        activate($_GET['userid']);
    }

    if ((isset($_POST['nor_title']))and(isset($_POST['nor_main']))){
        write_normal_review($_POST['nor_title'],$_POST['nor_main']);
    }

    if ((isset($_POST['mod_m']))and($_POST['mod_m']=='n')and($_POST['rid_m'])and($_POST['nor_more'])){
        write_normal_more($_POST['rid_m'],$_POST['nor_more']);
        header("Location: /review/read?mod=n&rid=".$_POST['rid_m']);
    }

    if (isset($_GET['delrid'])){
        del_normal_review($_GET['delrid']);
        header("Location: /");
    }

    if ((isset($_GET['drid']))and(isset($_GET['drmid']))){
        del_more($_GET['drid'],$_GET['drmid']);
    }

    if ((isset($_POST['noa_main']))and(isset($_POST['noa_title']))){
        write_admin_review($_POST['noa_title'],$_POST['noa_main']);
        header("Location: /");
    }

    if ((isset($_POST['repeal_main']))and(isset($_POST['repeal_username']))and(isset($_POST['repeal_password']))){
        if (check_ban($_POST['repeal_username'],$_POST['repeal_password'])){
            write_repeal_report($_POST['repeal_username'],$_POST['repeal_main']);
        }else{
            echo '<script>alert("申诉提交失败，可能是因为账号未被封禁或输入密码用户名错误")</script>';
            echo '<script language="javascript" type="text/javascript">window.location.href="/page/repeal/"</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
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
            <h2 Style="text-align:center">如果内容发生错位，调节网页缩放度即可</h2>
            <h2 Style="text-align:center">本站暂不支持上传图片视频，若要上传，请使用网络连接（URL）</h2>
            <p Style="text-align:center">左下角的看板娘若无法显示（极大可能）可将其忽略，如果有一劳永逸的解决方案清点贡献源码。<del>你不闲蛋疼可以加速器加速github即可显示</del></p>
            <div class="notice">
                <?php
                    $fopen=fopen('notice/notice.fcr','r');
                    $notice_main=fgets($fopen);
                    fclose($fopen);
                    if ($notice_main!=null) {
                        echo $notice_main;
                    }
                ?>
            </div>
            <div class="n_review">                
                <h3>&nbsp;&nbsp;最近新发帖</h3>
                <p><a href="review/new/normal">&nbsp;&nbsp;发布帖子</a></p>
                <br>
                <hr>
                <br>
                <?php
                    $fopen=fopen('review/lib/normal/total.fcdb','r');
                    $total=fgets($fopen);
                    fclose($fopen);

                    $t=$total;
                    (integer)$t;
                    $link_total=0;
                    for ($i=$t;$i>=1;$i--) { 
                        
                        (string)$i;
                        if (is_dir('review/lib/normal/'.$i)){
                            $fopen=fopen('review/lib/normal/'.$i.'/title.fcr','r');
                            $title=fgets($fopen);
                            fclose($fopen);
                            echo '<p><a href="review/read?mod=n&rid='.$i.'">'.$title.'</a></p>';
                            $link_total++;
                        }

                        if ($link_total==5){
                            break;
                        }

                        if (($t<5)and($link_total==$t)){
                            break;
                        }
                    }

                    if ($link_total==0){
                        echo '没有任何帖子！';
                    }
                ?>
                <br>
                <br>
            </div>
            <div class="a_review">
                <h3>&nbsp;&nbsp;最近新发管理帖</h3>
                <br>
                <br>
                <hr>
                <br>
                <?php
                    $fopen=fopen('review/lib/admin/total.fcdb','r');
                    $total=fgets($fopen);
                    fclose($fopen);

                    $t=$total;
                    (integer)$t;
                    $link_total=0;
                    for ($i=$t;$i>=1;$i--) { 
                        
                        (string)$i;
                        if (is_dir('review/lib/admin/'.$i)){
                            $fopen=fopen('review/lib/admin/'.$i.'/title.fcr','r');
                            $title=fgets($fopen);
                            fclose($fopen);
                            echo '<p><a href="review/read?mod=a&rid='.$i.'">'.$title.'</a></p>';
                            $link_total++;
                        }

                        if ($link_total==5){
                            break;
                        }

                        if (($t<5)and($link_total==$t)){
                            break;
                        }
                    }

                    if ($link_total==0){
                        echo '没有任何帖子！';
                    }
                ?>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="footter"><a href="#">备案号：**********</a></div>
</body>
</html>