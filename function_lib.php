<?php
    function con_mysql(){
        $host       =     '127.0.0.1';
        $post       =     3306;
        $dbname     =     'flying';
        $username   =     'flying';
        $password   =     'flying';
        $connID=mysqli_connect($host,$username,$password,$dbname,$post);
        if ($connID==false){
            return false;
        }else{
            return $connID;
        }
    }

    function login($username,$password){
        $password=md5($password);
        $connID=con_mysql();
        mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'SELECT username,password,ban,activate FROM user_table WHERE username="'.$username.'" AND password="'.$password.'"');
        $array=mysqli_fetch_array($result);
        if ((isset($array['username'])) and (isset($array['password'])) and ($array['activate']=='true') and ($array['ban']=='false')){
            mysqli_close($connID);
            return true;
        }else{
            mysqli_close($connID);
            return false;
        }
    }

    function check_login(){
        if ((isset($_COOKIE['username']))and(isset($_COOKIE['class']))){
            return true;
        }else{
            return false;
        }
    }

    function check_ban($username,$password){        //被ban，返回true
        $password=md5($password);
        $connID=con_mysql();
        mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'SELECT ban FROM user_table WHERE username="'.$username.'" AND password="'.$password.'"');
        $array=mysqli_fetch_array($result);
        if (isset($array['ban'])){
            if ($array['ban']=='true'){
                mysqli_close($connID);
                return true;
            }else{
                mysqli_close($connID);
                return false;
            }
        }else{
            mysqli_close($connID);
            return false;
        }
    }

    function make_cookie($username,$mode){
        $connID=con_mysql();
        mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'SELECT class FROM user_table WHERE username="'.$username.'"');
        $array=mysqli_fetch_array($result);
        $class=$array['class'];
        mysqli_close($connID);
        if ($mode=='1'){
        setcookie('username',$username,time()+3600*24*30,'/');
        setcookie('class',$class,time()+3600*24*30,'/');
        echo '<script language="javascript" type="text/javascript">window.location.href="/"</script>';
        }else{
            setcookie('username',$username,time()+3600,'/');
            setcookie('class',$class,time()+3600,'/');  
            echo '<script language="javascript" type="text/javascript">window.location.href="/"</script>';
        }
    }

    function aboutme(){
        if ((isset($_COOKIE['username']))and(isset($_COOKIE['username']))){
            echo '<h2>用户信息</h2><hr><h3>&nbsp&nbsp'.$_COOKIE['username'].'</h3><p>&nbsp等级：'.$_COOKIE['class'].'（';
            $c=$_COOKIE['class'];
            (float)$c;
            $c=number_format($c, 1, '.', '');
            if ($c==1){
                echo '用户）';
            }elseif (($c>1)and($c<=2)){
                echo '社区监督员）';
            }elseif (($c>2)and($c<=3)){
                echo '社区管理员）';
            }elseif (($c>3)and($c<=4)){
                echo '主管）';
            }elseif ($c=5){
                echo '超级管理员）';
            }else{
                // no
            }    
            echo '</p><a href="/?doid=2">&nbsp&nbsp&nbsp退出登录</a>';
        }else{
            echo '<h2>登录/加入我们</h2><hr><p><a href="/login">登录</a></p><p><a href="/signup">加入我们</a></p>';
        }
    }

    function logout(){
        setcookie('username','',time()-114,'/');
        setcookie('class','',time()-114,'/');  
        echo '<script language="javascript" type="text/javascript">window.location.href="/"</script>';
    }

    function rename_check($username){
        $connID=con_mysql();
        mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'SELECT id FROM user_table WHERE username="'.$username.'"');
        $array=mysqli_fetch_array($result);
        if (isset($array['id'])){
            mysqli_close($connID);
            return false;
        }else{
            mysqli_close($connID);
            return true;
        }
    }

    function signup(){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $qa=$_POST['qa'];
        $qb=$_POST['qb'];
        $qc=$_POST['qc'];
        $qd=$_POST['qd'];
        $qe=$_POST['qe'];

        $fopen=fopen('signup/text/total.fcdb','r');
        $num=fgets($fopen);
        fclose($fopen);

        (integer)$num;
        $num=$num+1;
        (string)$num;

        $fopen=fopen('signup/text/total.fcdb','w');
        fwrite($fopen,$num);
        fclose($fopen);

        $path='signup/text/'.$num;
        mkdir($path);
        copy('demo/signup/qa.fcr',$path.'/qa.fcr');
        copy('demo/signup/qb.fcr',$path.'/qb.fcr');
        copy('demo/signup/qc.fcr',$path.'/qc.fcr');
        copy('demo/signup/qd.fcr',$path.'/qd.fcr');
        copy('demo/signup/qe.fcr',$path.'/qe.fcr');
        copy('demo/signup/username.fcr',$path.'/username.fcr');
        copy('demo/signup/password.fcr',$path.'/password.fcr');
        copy('demo/signup/email.fcr',$path.'/email.fcr');

        $fopen=fopen($path.'/username.fcr','w');
        fwrite($fopen,$username);
        fclose($fopen);

        $fopen=fopen($path.'/password.fcr','w');
        fwrite($fopen,$password);
        fclose($fopen);

        $fopen=fopen($path.'/email.fcr','w');
        fwrite($fopen,$email);
        fclose($fopen);

        $fopen=fopen($path.'/qa.fcr','w');
        fwrite($fopen,$qa);
        fclose($fopen);

        $fopen=fopen($path.'/qb.fcr','w');
        fwrite($fopen,$qb);
        fclose($fopen);

        $fopen=fopen($path.'/qc.fcr','w');
        fwrite($fopen,$qc);
        fclose($fopen);

        $fopen=fopen($path.'/qd.fcr','w');
        fwrite($fopen,$qd);
        fclose($fopen);

        $fopen=fopen($path.'/qe.fcr','w');
        fwrite($fopen,$qe);
        fclose($fopen);

        echo '<script language="javascript" type="text/javascript">window.location.href="/"</script>';
    }

    function signup_result($result,$signup_id,$adminname){
        if ($result==true){
            $fopen=fopen('../signup/text/'.$signup_id.'/email.fcr','r');
            $email=fgets($fopen);
            fclose($fopen);

            $fopen=fopen('../signup/text/'.$signup_id.'/username.fcr','r');
            $username=fgets($fopen);
            fclose($fopen);

            $fopen=fopen('../signup/text/'.$signup_id.'/password.fcr','r');
            $password=fgets($fopen);
            fclose($fopen);

            $connID=con_mysql();
            $date=date("Y-m-d");
            mysqli_query($connID,"USE flying");
            $r=mysqli_query($connID,"INSERT INTO flying.user_table VALUES (DEFAULT,'".$username."','".$password."','".$email."','".$date."',DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT)");
            mysqli_query($connID,"USE flying;");
            $result=mysqli_query($connID,"SELECT id FROM flying.user_table WHERE username ='".$username."'");
            $array=mysqli_fetch_array($result);
            $userid=$array['id'];

            include('phpmailer/function.php');
            pass_email($username,$email,$userid,$adminname);

            $dir=scandir('../signup/text/'.$signup_id);
            foreach ($dir as $value) {
                if (($value=='..')or($value=='.')) {
                    //no
                }else{
                    unlink('../signup/text/'.$signup_id.'/'.$value);
                }
            }
            rmdir('../signup/text/'.$signup_id);
            echo '<script language="javascript" type="text/javascript">window.location.href="/"</script>';
        }else {
            $fopen=fopen('../signup/text/'.$signup_id.'/email.fcr','r');
            $email=fgets($fopen);
            fclose($fopen);

            $fopen=fopen('../signup/text/'.$signup_id.'/username.fcr','r');
            $username=fgets($fopen);
            fclose($fopen);

            include('phpmailer/function.php');
            fail_email($username,$email,$adminname);

            $dir=scandir('../signup/text/'.$signup_id);
            foreach ($dir as $value) {
                if (($value=='..')or($value=='.')) {
                    //no
                }else{
                    unlink('../signup/text/'.$signup_id.'/'.$value);
                }
            }
            rmdir('../signup/text/'.$signup_id);
            echo '<script language="javascript" type="text/javascript">window.location.href="?id=1"</script>';
        }
    }

    function activate($sql_userid){
        $connID=con_mysql();
        mysqli_query($connID,"USE flying");
        $result=mysqli_query($connID,'SELECT activate FROM user_table WHERE id='.$sql_userid);
        if ($result!=false){
            $array=mysqli_fetch_array($result);
            $aornot=$array['activate'];
            if ($aornot=='true'){
                echo '<script type="text/javascript">alert("账号曾被激活，无法多次激活");</script>';
                echo '<script type="text/javascript">window.location.href="/";</script>';
                return false;
            }elseif($aornot=='false'){
                mysqli_query($connID,"UPDATE flying.user_table SET activate='true' WHERE id=".$sql_userid);
                sleep(0.5);
                echo '<script type="text/javascript">alert("账号激活成功");</script>';
                echo '<script type="text/javascript">window.location.href="/";</script>';
                return true;
            }else{
                echo '<script type="text/javascript">alert("账号不存在");</script>';
                
                echo '<script type="text/javascript">window.location.href="/";</script>';
                return false;
            }
        }else{
                echo '<script type="text/javascript">alert("账号不存在");</script>';
                echo '<script type="text/javascript">window.location.href="/";</script>';
                return false;
            }

    }

    function class_check($class,$min_class){
        (float)$class;
        $c=number_format($class, 1, '.', '');
        if ($c>=$min_class){
            return true;
        }else{
            return false;
        }
    }

    function write_notice($main){
        $fopen=fopen('../notice/notice.fcr','w');
        fwrite($fopen,$main);
        fclose($fopen);
    }

    function write_normal_review($title,$main){
        $header=date('Y-m-d H-i-s');

        $fopen=fopen('review/lib/normal/total.fcdb','r');
        $number=fgets($fopen);
        fclose($fopen);

        (integer)$number;
        $number=$number+1;
        (string)$number;

        $fopen=fopen('review/lib/normal/total.fcdb','w');
        fwrite($fopen,$number);
        fclose($fopen);

        mkdir('review/lib/normal/'.$number);
        mkdir('review/lib/normal/'.$number.'/more');
        copy('demo/review_n/title.fcr','review/lib/normal/'.$number.'/title.fcr');
        copy('demo/review_n/username.fcr','review/lib/normal/'.$number.'/username.fcr');
        copy('demo/review_n/header.fcr','review/lib/normal/'.$number.'/header.fcr');
        copy('demo/review_n/main.fcr','review/lib/normal/'.$number.'/main.fcr');
        copy('demo/review_n/more/total.fcdb','review/lib/normal/'.$number.'/more/total.fcdb');

        $fopen=fopen('review/lib/normal/'.$number.'/title.fcr','w');
        fwrite($fopen,$title);
        fclose($fopen);

        $fopen=fopen('review/lib/normal/'.$number.'/header.fcr','w');
        fwrite($fopen,$header);
        fclose($fopen);

        $fopen=fopen('review/lib/normal/'.$number.'/username.fcr','w');
        fwrite($fopen,$_COOKIE['username']);
        fclose($fopen);

        $fopen=fopen('review/lib/normal/'.$number.'/main.fcr','w');
        fwrite($fopen,$main);
        fclose($fopen);

        header("Location: /");
        return 0;
    }

    function write_normal_more($rid,$main){
        $fopen=fopen('review/lib/normal/'.$rid.'/more/total.fcdb','r');
        $num=fgets($fopen);
        fclose($fopen);

        (integer)$num;
        $num++;
        (string)$num;

        $fopen=fopen('review/lib/normal/'.$rid.'/more/total.fcdb','w');
        fwrite($fopen,$num);
        fclose($fopen);

        mkdir('review/lib/normal/'.$rid.'/more/'.$num);
        copy('demo/review_n/more/number/main.fcr','review/lib/normal/'.$rid.'/more/'.$num.'/main.fcr');

        $wmain='<h2>'.$_COOKIE['username'].'</h2><p>'.date('Y-m-d H-i-s').'</p>'.$main;

        $fopen=fopen('review/lib/normal/'.$rid.'/more/'.$num.'/main.fcr','w');
        fwrite($fopen,$wmain);
        fclose($fopen);

        return 0;
    }

    function write_admin_review($title,$main){
        $header=date('Y-m-d H-i-s');

        $fopen=fopen('review/lib/admin/total.fcdb','r');
        $number=fgets($fopen);
        fclose($fopen);

        (integer)$number;
        $number=$number+1;
        (string)$number;

        $fopen=fopen('review/lib/admin/total.fcdb','w');
        fwrite($fopen,$number);
        fclose($fopen);

        mkdir('review/lib/admin/'.$number);
        copy('demo/review_a/title.fcr','review/lib/admin/'.$number.'/title.fcr');
        copy('demo/review_a/username.fcr','review/lib/admin/'.$number.'/username.fcr');
        copy('demo/review_a/header.fcr','review/lib/admin/'.$number.'/header.fcr');
        copy('demo/review_a/main.fcr','review/lib/admin/'.$number.'/main.fcr');

        $fopen=fopen('review/lib/admin/'.$number.'/title.fcr','w');
        fwrite($fopen,$title);
        fclose($fopen);

        $fopen=fopen('review/lib/admin/'.$number.'/header.fcr','w');
        fwrite($fopen,$header);
        fclose($fopen);

        $fopen=fopen('review/lib/admin/'.$number.'/username.fcr','w');
        fwrite($fopen,$_COOKIE['username']);
        fclose($fopen);

        $fopen=fopen('review/lib/admin/'.$number.'/main.fcr','w');
        fwrite($fopen,$main);
        fclose($fopen);

        header("Location: /");
        return 0;
    }

    function write_repeal_report($name,$main){
        $fopen=fopen('page/repeal/report/total.fcdb','r');
        $total=fgets($fopen);
        fclose($fopen);

        (string)$total;
        $total++;
        (integer)$total;

        $fopen=fopen('page/repeal/report/total.fcdb','w');
        fwrite($fopen,$total);
        fclose($fopen);

        mkdir('page/repeal/report/'.$total);

        $fopen=fopen('page/repeal/report/'.$total.'/username.fcr','w');
        fwrite($fopen,$name);
        fclose($fopen);

        $fopen=fopen('page/repeal/report/'.$total.'/main.fcr','w');
        fwrite($fopen,$main);
        fclose($fopen);

        return 0;
    }

    function del_normal_review($rid){
        $dir=scandir('review/lib/normal/'.$rid.'/more');
        foreach($dir as $value){
            if (($value=='..')or($value=='.')){
                // no
            }else{
                unlink('review/lib/normal/'.$rid.'/more/'.$value);
            }
        }
        rmdir('review/lib/normal/'.$rid.'/more');

        $dir=scandir('review/lib/normal/'.$rid);
        foreach($dir as $value){
            if (($value=='..')or($value=='.')){
                // no
            }else{
                unlink('review/lib/normal/'.$rid.'/'.$value);
            }
        }
        rmdir('review/lib/normal/'.$rid);
        return 0;
    }

    function del_more($rid,$mid){
        unlink('review/lib/normal/'.$rid.'/more/'.$mid.'/main.fcr');
        rmdir('review/lib/normal/'.$rid.'/more/'.$mid);
        return 0;
    }

    function search_user($name){
        $connID=con_mysql();
        $result=mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'SELECT id,email,join_date,ban,class FROM user_table WHERE username="'.$name.'"');
        $array=mysqli_fetch_array($result);
        if (isset($array['id'])){
            if ($array['ban']=='true'){
                $rrrr=true;
            }else{
                $rrrr=false;
            }
            $return_array=array('id'=>$array['id'],'email'=>$array['email'],'join_date'=>$array['join_date'],'ban'=>$rrrr,'class'=>$array['class']);
            mysqli_close($connID);
            return $return_array;
        }else{
            return false;
        }
    }

    function ban($id,$day){
        $time=time()+24*3600*$day;
        $date=date('Y-m-d',$time);
        $connID=con_mysql();
        $result=mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'SELECT class FROM user_table WHERE id='.$id);
        $array=mysqli_fetch_array($result);
        $class=$array['class'];
        if (class_check($class,4.1)==false){
            $result=mysqli_query($connID,'UPDATE flying.user_table SET ban="true" WHERE id ='.$id);
            $result=mysqli_query($connID,'UPDATE flying.user_table SET ban_date="'.$date.'" WHERE id ='.$id);
            mysqli_close($connID);
            return true;
        }else{
            mysqli_close($connID);
            return false;
        }
    }

    function deban($id){
        $connID=con_mysql();
        $result=mysqli_query($connID,'USE flying');
        $result=mysqli_query($connID,'UPDATE flying.user_table SET ban="false" WHERE id ='.$id);
        $result=mysqli_query($connID,'UPDATE flying.user_table SET ban_date=null WHERE id ='.$id);
        mysqli_close($connID);
        return 0;
    }
?>