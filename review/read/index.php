<?php
    include('../../function_lib.php');
    if (($_GET['mod']=='n')or($_GET['mod']=='a')){
        $mod_bool=true;
        if(($_GET['mod']=='n')and(isset($_GET['rid']))){
            if(is_dir('../lib/normal/'.$_GET['rid'])){
                $rid_bool=true;
            }else{
                $rid_bool=false;
            }
        }

        if(($_GET['mod']=='a')and(isset($_GET['rid']))){
            if(is_dir('../lib/admin/'.$_GET['rid'])){
                $rid_bool=true;
            }else{
                $rid_bool=false;
            }
        }

    }else{
        $mod_bool=false;
    }
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
    <link href="https://unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">
    <style>
        #editor—wrapper {
            border: 1px solid #ccc;
            z-index: 100; /* 按需定义 */
        }
        #toolbar-container { border-bottom: 1px solid #ccc; }
        #editor-container { height: 420px; }
    </style>
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>
        Flying Catss
        <?php
            if($mod_bool){
                if($rid_bool){
                    if ($_GET['mod']=='n'){
                        $fopen=fopen('../lib/normal/'.$_GET['rid'].'/title.fcr','r');
                        $title=fgets($fopen);
                        fclose($fopen);
                    }else{
                        if ($_GET['mod']=='a'){
                            $fopen=fopen('../lib/admin/'.$_GET['rid'].'/title.fcr','r');
                            $title='管理贴：'.fgets($fopen);
                            fclose($fopen);
                        }    
                    }
                }else{
                    $title='defind';
                }
            }  
            echo '--帖子--'.$title;  
        ?>
    </title>
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
                if($mod_bool){
                    if($rid_bool){
                        if ($_GET['mod']=='n'){
                            echo '<h1>'.$title.'</h1>';

                            $fopen=fopen('../lib/normal/'.$_GET['rid'].'/username.fcr','r');
                            $username=fgets($fopen);
                            echo $username.'-';
                            fclose($fopen);

                            $fopen=fopen('../lib/normal/'.$_GET['rid'].'/header.fcr','r');
                            echo fgets($fopen).'<hr>';
                            fclose($fopen);

                            if(($_COOKIE['username']==$username)or(class_check($_COOKIE['class'],2.1))){
                                echo '<a href="/?delrid='.$_GET['rid'].'">删帖</a><br><br>';
                            }

                            $fopen=fopen('../lib/normal/'.$_GET['rid'].'/main.fcr','r');
                            echo fgets($fopen).'<br><hr><h2>跟帖</h2>';
                            fclose($fopen);

                            if (check_login()){
                                echo '
                                <div id="editor—wrapper">
                                <div id="toolbar-container"><!-- 工具栏 --></div>
                                <div id="editor-container"><!-- 编辑器 --></div>
                                </div>
                                <form name="newrm" onsubmit="return mycheck()" method="post" action="/">
                                <input type="text" style="width:0px; height:0px; outline: none;" name="mod_m" value="'.$_GET['mod'].'" readonly>
                                <input type="text" style="width:0px; height:0px; outline: none;" name="rid_m" value="'.$_GET['rid'].'" readonly>
                                <textarea style="width:0px; height:0px; outline: none;" id="new_mr_text" name="nor_more">
                                </textarea>
                                <input type="submit" value="发一条友善的跟帖">
                                </form><br><hr>';
                            }

                            $fopen=fopen('../lib/normal/'.$_GET['rid'].'/more/total.fcdb','r');
                            $more_total=fgets($fopen);
                            fclose($fopen);

                            if ($more_total=='0'){
                                echo '<h2>没有人跟帖（恼</h2>';
                            }else{
                                (integer)$more_total;
                                for ($i=$more_total;$i>=1;$i--) { 
                                    (string)$i;
                                    if (is_dir('../lib/normal/'.$_GET['rid'].'/more/'.$i)){
                                        $fopen=fopen('../lib/normal/'.$_GET['rid'].'/more/'.$i.'/main.fcr','r');
                                        echo '<h1>'.$i.'楼</h1>';
                                        $mmain=fgets($fopen);
                                        echo $mmain.'<br><br>';

                                        if ((strstr($mmain,'<h2>'.$_COOKIE['username'].'</h2>')!=false)or(class_check($_COOKIE['class'],2.1))){
                                            echo '<a href="/?drid='.$_GET['rid'].'&drmid='.$i.'">删帖</a><hrq>';
                                        }else{
                                            echo '<hr>';
                                        }
                                    }else{
                                        echo '<h1>'.$i.'楼被吃掉了</h1><hr>';
                                    }
                                    (integer)$i;
                                }
                            }

                        }else{
                            if ($_GET['mod']=='a'){
                                echo '<h1>'.$title.'</h1>';

                                $fopen=fopen('../lib/admin/'.$_GET['rid'].'/username.fcr','r');
                                $username=fgets($fopen);
                                echo $username.'-';
                                fclose($fopen);
    
                                $fopen=fopen('../lib/admin/'.$_GET['rid'].'/header.fcr','r');
                                echo fgets($fopen).'<hr>';
                                fclose($fopen);
    
                                $fopen=fopen('../lib/admin/'.$_GET['rid'].'/main.fcr','r');
                                echo fgets($fopen);
                                fclose($fopen);
                                }
                        }
                        
                    }else{
                        echo '<h1>文章id不存在</h1>';
                    }
                }else{
                    echo '<h1>文章种类不存在</h1>';
                }
            ?>
        </div>
    </div>
    <div class="footter"><a href="#">备案号：**********</a></div>
    <script src="https://unpkg.com/@wangeditor/editor@latest/dist/index.js"></script>
    <script>
    const { createEditor, createToolbar } = window.wangEditor

    const editorConfig = {
        placeholder: 'Type here...',
        onChange(editor) {
          const html = editor.getHtml()
          console.log('editor content', html)
          document.getElementById('new_mr_text').value = html
          // 也可以同步到 <textarea>
        }
    }

    const editor = createEditor({
        selector: '#editor-container',
        html: '<p><br></p>',
        config: editorConfig,
        mode: 'default', // or 'simple'
    })

    const toolbarConfig = {}

    const toolbar = createToolbar({
        editor,
        selector: '#toolbar-container',
        config: toolbarConfig,
        mode: 'default', // or 'simple'
    })
    </script>

    <script>
        function mycheck(){
            if (newrm.nor_more.value==""){
                alert("内容？哪呢？");
                return false
            }
            if (newrm.nor_more.value=="<p><br></p>"){
                alert("内容？哪呢？");
                return false
            }
        }
    </script>
</body>
</html>