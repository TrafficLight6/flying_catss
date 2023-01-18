<?php
    include('../../../function_lib.php');
    if (check_login()==false){
        header("Location: /login");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/new_review_nor.css">
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
    <title>Flying Catss-发布新帖</title>
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
            <form name="newr" onsubmit="return mycheck()" method="post" action="/">
            <p>标题（无需在正文中再写标题）<input type="text" name="nor_title"></p>
            <div id="editor—wrapper">
                <div id="toolbar-container"><!-- 工具栏 --></div>
                <div id="editor-container"><!-- 编辑器 --></div>
            </div>
            <textarea style="width:0px; height:0px; outline: none;" id="new_r_text" name="nor_main"></textarea><input type="submit" value="发一条友善的帖子"></form>


            <script>
                function mycheck(){
                    if (newr.nor_title.value==""){
                        alert("标题捏？");
                        return false;
                    }
                    if (newr.nor_main.value=="<p><br></p>"){
                        alert("内容捏？");
                        return false;
                    }
                    if (newr.nor_main.value==""){
                        alert("内容捏？");
                        return false;
                    }
                }
            </script>


        </div>
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
          document.getElementById('new_r_text').value = html
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
</body>
</html>