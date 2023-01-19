<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/signup.css">
    <link rel="icon" href="/awcxk-o1250-001.ico">
    <title>加入我们</title>
</head>
<body>
    <div class="main">
        <h1>加入申请</h1>
            <div class="text">
                <h2>加入必读</h2>
                <p><a href="/page/rule">本站站规</a></p>
                <p><a href="/help/how_join">如何加入本站</a></p>
                <br>
                <br>
                <br>
                <form name="signup" onsubmit="return mycheak()" method="post" action="/?doid=3">
                    <p>用户名（除特殊情况外，加入本站后不得改名）<input name="username" type="text" size="30" maxlength="30" autocomplete="off">(上限为30个字符)</p>
                    <p>邮箱<input name="email" type="email" size="30" autocomplete="off">(上限为255个字符)</p>    
                    <p>密码<input name="password" type="password" size="30"></p>
                    <p>确认密码<input name="mspassword" type="password" size="30"></p>
                    <p><em>关于密码的小声比比</em></p>
                    <p><em>（你的密码是啥，我们不会限制【我指的是限制简单密码】，因为我代码技术太菜了）</em></p>
                    <ol>
                        <li><em>建议8位密码</em></li>
                        <li><em>建议数字字母组合，字母包含大小写</em></li>
                        <li><em>如果可以，建议加上特殊符号如：%$^*_+()#!:"{}|\/&gt;&lt; 空格</em></li>
                        <li><em>如果可以，建议不要用个人信息组密码</em></li>
                        <li><em>如果可以，建议密码不要有重复内容</em></li>
                    </ol>
                    <h2>问答</h2>
                    <p>1、请不带书名号，打出本站站规全称<input name="qa" type="text" autocomplete="off"></p>
                    <p>2、如果有人在你的帖子下说：“这写的什么玩意？我写的都比你好”你会回答：<input name="qb" type="text" size="60" autocomplete="off"></p>
                    <p>3、如果有人在你的帖子下说：“兄弟，我想把这帖子转载到某某某站上”，你<u>  拒绝  </u>，你会回答：<input name="qc" type="text" size="60" autocomplete="off"></p>
                    <p>4、如果管理员在帖子下方警告你请用词文明，否则将会封号，你会回答：<input name="qd" type="text" size="60" autocomplete="off"></p>
                    <p>5、关于你的一篇<u>  简单的,无标题的  </u>自我介绍。（800字以内）</p>
                    <textarea name="qe" cols="100" rows="20" wrap="soft"></textarea>
                    <br>
                    <h3>登录状态时，本站将在客户端设置两个cookie，服务端数据本站将尽义务，但如果数据是通过客户端泄漏，本站不对其负责。</h3>
                    <p><input class="sub" type="submit" value="提交且同意本站站规"></p>

                </form>
            </div>
    </div>

    <script>
        function mycheak(){
            if (signup.username.value==""){
                alert("用户名不可以为空(恼");signup.username.focus();return false;
            }
            if (signup.email.value==""){
                alert("邮箱不可以为空(恼");signup.email.focus();return false;
            }
            if (signup.password.value==""){
                alert("密码不可以为空(恼");signup.password.focus();return false;
            }
            if (signup.password.value!=signup.mspassword.value){
                alert("密码错力(悲");return false;
            }
        }
    </script>

</body>
</html>