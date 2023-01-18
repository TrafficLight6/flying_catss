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
    <link rel="stylesheet" type="text/css" href="/css/read.css">
    <script src="/live2d-widget/autoload.js"></script>
    <link href="https://unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">
    <style>
        #editor—wrapper {
        border: 1px solid #ccc;
        z-index: 100; /* 按需定义 */
        }
        #toolbar-container { border-bottom: 1px solid #ccc; }
        #editor-container { height: 500px; }
    </style>
    <script src="/live2d-widget/autoload.js"></script>
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>Flying Catss-处罚申诉</title>
</head>
<body>
    <div class="header">
        <div class="top"><h1><i>Flying Catss!!!</i></h1><p>一个冲浪者，开发人员和<del>沙雕</del>的贴吧社区</p><form name="search"><input type="text" placeholder="搜索帖子"><input class="sub" type="submit" value="搜索"></form></div>
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
            <h1>处罚申诉</h1>
            <p>书写申诉材料，是为了减轻或撤销处罚，懂？</p>
            <p>申诉材料内容一定要有：</p>
            <ul type="must">
                <li>目前的处罚结果</li>
                <li>证据，以证明某些事实，如截图等；</li>
                <li>事情的缘由；</li>
                <li>你希望的申诉结果</li>
            </ul>
            <p>以上缺一不可，否则申诉将不通过。</p>
            <h3>如果你是来找茬的将会当不服从和顶撞管理处理（见处罚条例B款第叁和第肆部分）。</h3>
            <strong>严禁抄袭、套作申诉文稿，违者的申诉将定为不通过，严重的将剥夺此次处罚的申诉权利</strong>
            <p>字数不限</p>
            <strong>如果申诉内容包含图片、视频等文件的请上传至第三方网盘处，并在文章中附上链接。在文章编辑器中的上传图片或视频文件是无效的（链接除外）</strong>
            <div id="editor—wrapper">
                <div id="toolbar-container"><!-- 工具栏 --></div>
                <div id="editor-container"><!-- 编辑器 --></div>
            </div>
            <form action="/" name="repeal" onsubmit="return mycheck()" method="POST">
                <textarea style="width:0px; height:0px; outline: none;" name="repeal_main" id="mmm" readonly></textarea>
                <p>申诉用户验证</p>
                <p><input type="text" placeholder="申诉用户名" name="repeal_username"></p>
                <p><input type="password" placeholder="申诉用户密码" name="repeal_password"></p>
                <input type="submit" value="提交">
            </form>
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
        document.getElementById('mmm').value = html
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
            if (repeal.repeal_main.value=="<p><br></p>"){
                alert("请输入内容");
                return false;
            }

            if (repeal.repeal_username.value==""){
                alert("请输入用户名");
                return false;
            }

            if (repeal.repeal_password.value==""){
                alert("请输入密码");
                return false;
            }
        }
    </script>
</body>
</html>