<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css"/>
    <script src="/js/autoload.js"></script>
    <title>test</title>
</head>
<body>
    <?php
    include('function_lib.php');
    $connID=con_mysql();
    $result=mysqli_query($connID,'SELECT username,class FROM user_table WHERE id=5');
    $array=mysqli_fetch_array($result);
    print_r($array)
    ?>
</body>
</html>