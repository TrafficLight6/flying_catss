<?php
    include('../function_lib.php');
    if((isset($_GET['r']))and(isset($_GET['signup_id']))){
        if ($_GET['r']=='1'){
            $r=true;
        }else{
            $r=false;
        }
        signup_result($r,$_GET['signup_id'],$_COOKIE['username']);
    }

    if ((class_check($_COOKIE['class'],2.1))==false){
        echo '<script type="text/javascript">alert("哎呀！你的权限过低！");</script>';
        echo '<script type="text/javascript">window.location.href="/";</script>';
    }
    if (isset($_GET['id'])){
        if (($_GET['id']=='5')and(class_check($_COOKIE['class'],3.1)==false)){
            echo '<script type="text/javascript">alert("哎呀！你的权限过低！");</script>';
            echo '<script type="text/javascript">window.location.href="/";</script>';
        }
    }
    if (isset($_POST['notice_main'])){
        write_notice($_POST['notice_main']);
    }

    if ((isset($_GET['report_id']))and(isset($_GET['res']))){
        unlink('../page/repeal/report/'.$_GET['report_id'].'/username.fcr');
        unlink('../page/repeal/report/'.$_GET['report_id'].'/main.fcr');
        rmdir('../page/repeal/report/'.$_GET['report_id']);
        echo '<script type="text/javascript">window.location.href="./id=2";</script>';
    }

    if ((isset($_GET['ban_id']))and(isset($_GET['day']))and(class_check($_COOKIE['class'],3.1))){
        $day=$_GET['day'];
        (integer)$day;
        ban($_GET['ban_id'],$day);
        echo '<script type="text/javascript">window.location.href=".";</script>';
    }else{
        if ((isset($_GET['ban_id']))and(isset($_GET['day']))and(class_check($_COOKIE['class'],3.1)==false)){
            echo '<script type="text/javascript">window.location.href=".";</script>';
        }
    }

    if ((isset($_GET['deban_id']))and(class_check($_COOKIE['class'],3.1))){
        deban($_GET['deban_id']);
        echo '<script type="text/javascript">window.location.href=".";</script>';
    }else{
        if ((isset($_GET['deban_id']))and(class_check($_COOKIE['class'],3.1)==false)){
            echo '<script type="text/javascript">window.location.href=".";</script>';
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
    <?php
        if ((isset($_GET['id']))and($_GET['id']=='5')) {
            echo '<link href="https://unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">
            <style>
              #editor—wrapper {
                border: 1px solid #ccc;
                z-index: 100; /* 按需定义 */
              }
              #toolbar-container { border-bottom: 1px solid #ccc; }
              #editor-container { height: 500px; }
            </style>';
        }
    ?>
    <title>Flying Catss后台</title>
</head>
<body>
    <div class="left">
        <h5>Flying catss后台管理</h5>
        <br>
        <br>
        <p><a href="..">返回主页</a></p>
        <hr>
        <p><a href="?id=1">加入申请</a></p>
        <hr>
        <p><a href="?id=2">处罚申诉</a></p>
        <hr>
        <p><a href="?id=3">账号管理</a></p>
        <hr>
        <p><a href="?id=4">管理员管理</a></p>
        <hr>
        <p><a href="?id=5">通知管理</a></p>
        
    </div>
    <div class="right">
        <?php
            if (isset($_GET['id'])){        //id==1
                if (($_GET['id']=='1')and(isset($_GET['srid'])==false)){
                    $dir=scandir('../signup/text');
                    foreach ($dir as $value){
                        if (($value=='.')or($value=='..')or($value=='total.fcdb')){       //srid全称sign-up review ID
                        }else{
                            if ((isset($_GET['srid'])==false)and(is_dir('../signup/text/'.$value))){
                                $fopen=fopen('../signup/text/'.$value.'/username.fcr','r');
                                $name=fgets($fopen);
                                fclose($fopen);
    
                                echo '<p><a href="?id=1&srid='.$value.'">'.$name.'的加入申请</a></p>';
                                }
                        }
                    }
                }else{
                    if (($_GET['id']=='1')and(isset($_GET['srid'])==true)){
                        $fopen=fopen('../signup/text/'.$_GET['srid'].'/username.fcr','r');
                        $username=fgets($fopen);
                        fclose($fopen);
                        echo '<h2>申请人：'.$username.'</h2>';

                        $fopen=fopen('../signup/text/'.$_GET['srid'].'/qa.fcr','r');
                        $qa=fgets($fopen);
                        fclose($fopen);
                        echo '<h4>问题一回答：<br>'.$qa.'</h4>';

                        $fopen=fopen('../signup/text/'.$_GET['srid'].'/qb.fcr','r');
                        $qb=fgets($fopen);
                        fclose($fopen);
                        echo '<h4>问题二回答：<br>'.$qb.'</h4>';

                        $fopen=fopen('../signup/text/'.$_GET['srid'].'/qc.fcr','r');
                        $qc=fgets($fopen);
                        fclose($fopen);
                        echo '<h4>问题三回答：<br>'.$qc.'</h4>';

                        $fopen=fopen('../signup/text/'.$_GET['srid'].'/qd.fcr','r');
                        $qd=fgets($fopen);
                        fclose($fopen);
                        echo '<h4>问题四回答：<br>'.$qd.'</h4>';

                        $fopen=fopen('../signup/text/'.$_GET['srid'].'/qe.fcr','r');
                        $qe=fgets($fopen);
                        fclose($fopen);
                        echo '<h4>自我介绍：<br>'.$qe.'</h4>';

                        echo '<form name=join_r onsubmit="return mycheck()"><p>申请文章ID<input type="text" name="signup_id" value="'.$_GET['srid'].'"readonly ></p>通过<input name="r" type="radio" value="1">不通过<input name="r" type="radio" value="0"><P><input type="submit" value="提交结果"></p></fore>';
                        echo '<script>function mycheck(){if (join_r.r.value==""){alert("请选择结果");return false;}}</script>';
                    }
                }
            }

            if (isset($_GET['id'])){        //id==2
                if ($_GET['id']=='2'){
                    if (isset($_GET['rrid'])){
                        $fopen=fopen('../page/repeal/report/'.$_GET['rrid'].'/main.fcr','r');
                        echo fgets($fopen);
                        fclose($fopen);

                        echo '<p>你的处理结果</p>
                        <form name="result" onsubmit="return mycheak()">
                            <p>申诉文章号<input name="report_id" type="text" value="'.$_GET['rrid'].'" readonly></p>
                            <input name="res" type="radio" value="1">通过
                            <input name="res" type="radio" value="0">不通过
                            <h4>如果通过，请管理员立即<i>手动</i>减轻或撤销处罚</h4>
                            <h3>如果结果超出权限之外请和相应的管理员联系</h3>
                            <p><input type="submit" value="提交结果"></p>
                        </form>
                    
                        <script>
                            function mycheak(){
                                if (result.res.value==""){
                                    alert("请选择处理结果");result.focus();return false;
                                }
                    
                            }
                        </script>
                        ';
                    }else{
                        $dir=scandir('../page/repeal/report');
                        foreach ($dir as $value){
                            if (($value=='total.fcdb')or($value=='.')or($value=='..')){
                                //no
                            }else{
                                $fopen=fopen('../page/repeal/report/'.$value.'/username.fcr','r');
                                $name=fgets($fopen);
                                fclose($fopen);

                                echo '<a href="?id=2&rrid='.$value.'">'.$name.'的申诉</a>';
                            }
                        }
                    }
                }
            }

            if (isset($_GET['id'])){        //id==3
                if ($_GET['id']=='3'){
                    if (class_check($_COOKIE['class'],3.1)==false){
                        echo '<script type="text/javascript">alert("哎呀！你的权限过低！");</script>';
                        echo '<script type="text/javascript">window.location.href=".";</script>';
                    }

                    if (isset($_GET['unkw'])){

                    }else{
                        echo '
                        <form onsubmit="return search()" name="unk" action="username">
                        <input type="text" name="unkw" placeholder="用户的完整全称（不支持模糊搜索）" size="30">
                        <input type="submit" value="搜索">
                        </form>
                        <script>
                        function search(){
                            if (unk.unkw.value==""){
                                alert("请输入用户全称");
                                return false
                            }
                        }
                        </script>
                        ';
                    }
                }
            }

            if (isset($_GET['id'])){        //id==4
                if ($_GET['id']=='4'){
                    if (class_check($_COOKIE['class'],4.1)){
                        echo '<script type="text/javascript">window.location.href="all_admin";</script>';
                    }else{
                        echo '<script type="text/javascript">alert("哎呀！你的权限过低！");</script>';
                        echo '<script type="text/javascript">window.location.href=".";</script>';
                    }
                }
            }

            if (isset($_GET['id'])){        //id==5

                if ($_GET['id']=='5'){
                    echo '<div id="editor—wrapper">
                    <div id="toolbar-container"><!-- 工具栏 --></div>
                    <div id="editor-container"><!-- 编辑器 --></div>
                    </div>';
                    echo '<form method="post" action="."><textarea style="width:0px; height:0px; outline: none;" id="editor-content-textarea" style="width: 100%; height: 100px; outline: none;" readonly name="notice_main"></textarea><input type="submit" value="修改通知栏"></form>';
                    echo '<script src="https://unpkg.com/@wangeditor/editor@latest/dist/index.js"></script>';
                    echo '<script>const { createEditor, createToolbar } = window.wangEditor

                        const editorConfig = {
                            placeholder: "Type here...",
                            onChange(editor) {
                              const html = editor.getHtml()
                              console.log("editor content", html)
                              document.getElementById("editor-content-textarea").value = html
                              // 也可以同步到 <textarea>
                            }
                        }

                        
                    
                        const editor = createEditor({
                            selector: "#editor-container",
                            html: "",
                            config: editorConfig,
                            mode: "default", // or "simple"
                        })
                    
                        const toolbarConfig = {}
                    
                        const toolbar = createToolbar({
                            editor,
                            selector: "#toolbar-container",
                            config: toolbarConfig,
                            mode: "default", // or "simple"
                        })</script>';
                }
            }
        ?>
    </div>
</body>
</html>