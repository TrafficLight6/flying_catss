<?php

    //不用管以下错误：（有时候不报错）
    //Undefined type 'PHPMailer\PHPMailer\PHPMailer'.
    //Undefined type 'PHPMailer\PHPMailer\Exception'.
    //反正能用
    //这得PHP Debug背锅，反正我不背（doge ——STL
    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';


    function pass_email($username,$useremail,$userid,$adminname){
        $mail = new PHPMailer(true);                                     // Passing `true` enables exceptions
        try {

            //服务器配置
            $mail->CharSet ="UTF-8";                                    //设定邮件编码
                $mail->SMTPDebug = 0;                                       // 调试模式输出
            $mail->isSMTP();                                            // 使用SMTP
            $mail->Host = '邮箱供应商的smtp服务器域名';                               // SMTP服务器
            $mail->SMTPAuth = true;                                     // 允许 SMTP 认证
            $mail->Username = '你的邮箱';                  // SMTP 用户名  即邮箱的用户名
            $mail->Password = '你的邮箱SMTP密码';                       // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                                  // 允许 TLS 或者ssl协议
            $mail->Port = 465;                                          // 服务器端口 25 或者465 126.com为465

            $mail->setFrom('你的邮箱', 'Flying catss官方');    //发件人
            $mail->addAddress($useremail, $username);              //收件人
            //$mail->addAddress('ellen@example.com');                   // 可添加多个收件人
            $mail->addReplyTo('你的邮箱', 'Flying catss官方'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                           //抄送
            //$mail->addBCC('bcc@example.com');                         //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');                       // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');       // 发送附件并且重命名

            //Content
            $mail->isHTML(true);                                                                // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = '这里是邮件标题（时间戳：' . time().'）';                            //邮件标题
                                                                                                //正文
            $mail->Body    = '<h1>恭喜，你加入Flying catss社区的申请已被通过！</h1><p>审批管理员：'.$adminname.'</p><p>你以成为我们之中的一员。现在只剩最后一步， <a href="localhost/function_lib/activate.php?userid='.$userid.' target="_blank">点击链接激活账户：localhost?userid='.$userid.'</a> </p><p><br></p><br>' . date('Y-m-d H:i:s');
            $mail->AltBody = '恭喜，你加入Flying catss社区的申请已被通过！你以成为我们之中的一员。现在只剩最后一步，访问链接激活账户localhost?userid='.$userid.'时间：'.date('Y-m-d H:i:s');

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
            echo '邮件发送失败: ', $mail->ErrorInfo;
        }
    }






    function fail_email($username,$useremail,$adminname){
        $mail = new PHPMailer(true);                                     // Passing `true` enables exceptions
        try {

            //服务器配置
            $mail->CharSet ="UTF-8";                                    //设定邮件编码
            $mail->SMTPDebug = 0;                                       // 调试模式输出
            $mail->isSMTP();                                            // 使用SMTP
            $mail->Host = '邮箱供应商的smtp服务器域名';                               // SMTP服务器
            $mail->SMTPAuth = true;                                     // 允许 SMTP 认证
            $mail->Username = '你的邮箱';                  // SMTP 用户名  即邮箱的用户名
            $mail->Password = '你的邮箱SMTP密码';                       // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                                  // 允许 TLS 或者ssl协议
            $mail->Port = 465;                                          // 服务器端口 25 或者465 126.com为465

            $mail->setFrom('你的邮箱', 'Flying catss官方');    //发件人
            $mail->addAddress($useremail, $username);              //收件人
            //$mail->addAddress('ellen@example.com');                   // 可添加多个收件人
            $mail->addReplyTo('你的邮箱', 'Flying catss官方'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                           //抄送
            //$mail->addBCC('bcc@example.com');                         //密送

            //发送附件
            // $mail->addAttachment('path');                       // 添加附件
            // $mail->addAttachment('path', 'newname');       // 发送附件并且重命名

            //Content
            $mail->isHTML(true);                                                                // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = '这里是邮件标题（时间戳：' . time().'）';                            //邮件标题
                                                                                                //正文
            $mail->Body    = '<h1>对不起，你加入Flying catss社区的申请已被拒绝！</h1><p>审批管理员：'.$adminname.'</p><p>但是你可以再次提交投申请。</p><br>' . date('Y-m-d H:i:s');
            $mail->AltBody = '对不起，你加入Flying catss社区的申请已被拒绝！但是你可以再次提交申请。时间：'.date('Y-m-d H:i:s').'审批管理员：'.$adminname;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
            echo '邮件发送失败: ', $mail->ErrorInfo;
        }
    }

    function pass_repeal($useremail){
        $mail = new PHPMailer(true);                                     // Passing `true` enables exceptions
        try {

            //服务器配置
            $mail->CharSet ="UTF-8";                                    //设定邮件编码
                $mail->SMTPDebug = 0;                                       // 调试模式输出
            $mail->isSMTP();                                            // 使用SMTP
            $mail->Host = '邮箱供应商的smtp服务器域名';                               // SMTP服务器
            $mail->SMTPAuth = true;                                     // 允许 SMTP 认证
            $mail->Username = '你的邮箱';                  // SMTP 用户名  即邮箱的用户名
            $mail->Password = '你的邮箱SMTP密码';                       // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                                  // 允许 TLS 或者ssl协议
            $mail->Port = 465;                                          // 服务器端口 25 或者465 126.com为465

            $mail->setFrom('你的邮箱', 'Flying catss官方');    //发件人
            $mail->addAddress($useremail);              //收件人
            //$mail->addAddress('ellen@example.com');                   // 可添加多个收件人
            $mail->addReplyTo('你的邮箱', 'Flying catss官方'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                           //抄送
            //$mail->addBCC('bcc@example.com');                         //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');                       // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');       // 发送附件并且重命名

            //Content
            $mail->isHTML(true);                                                                // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = '这里是邮件标题（时间戳：' . time().'）';                            //邮件标题
                                                                                                //正文
            $mail->Body    = '<h1>你在Flying catss社区的申诉已被通过！</h1>' . date('Y-m-d H:i:s');
            $mail->AltBody = '你在Flying catss社区的申诉已被通过！时间：'.date('Y-m-d H:i:s');

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
            echo '邮件发送失败: ', $mail->ErrorInfo;
        }

    }

    function fail_repeal($useremail){
        $mail = new PHPMailer(true);                                     // Passing `true` enables exceptions
        try {

            //服务器配置
            $mail->CharSet ="UTF-8";                                    //设定邮件编码
                $mail->SMTPDebug = 0;                                       // 调试模式输出
            $mail->isSMTP();                                            // 使用SMTP
            $mail->Host = '邮箱供应商的smtp服务器域名';                               // SMTP服务器
            $mail->SMTPAuth = true;                                     // 允许 SMTP 认证
            $mail->Username = '你的邮箱';                  // SMTP 用户名  即邮箱的用户名
            $mail->Password = '你的邮箱SMTP密码';                       // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                                  // 允许 TLS 或者ssl协议
            $mail->Port = 465;                                          // 服务器端口 25 或者465 126.com为465

            $mail->setFrom('你的邮箱', 'Flying catss官方');    //发件人
            $mail->addAddress($useremail);              //收件人
            //$mail->addAddress('ellen@example.com');                   // 可添加多个收件人
            $mail->addReplyTo('你的邮箱', 'Flying catss官方'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                           //抄送
            //$mail->addBCC('bcc@example.com');                         //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');                       // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');       // 发送附件并且重命名

            //Content
            $mail->isHTML(true);                                                                // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = '这里是邮件标题（时间戳：' . time().'）';                            //邮件标题
                                                                                                //正文
            $mail->Body    = '<h1>你在Flying catss社区的申诉已被驳回！</h1>' . date('Y-m-d H:i:s');
            $mail->AltBody = '你在Flying catss社区的申诉已被驳回！时间：'.date('Y-m-d H:i:s');

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
            echo '邮件发送失败: ', $mail->ErrorInfo;
        }
    }
?>