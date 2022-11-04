<?php
    session_start();
    include ("../conect/conect.php");
    if(isset($_POST['dk'])){
        $username = $_POST['username'];
        

        // check usn
        $sql_pro = "SELECT username FROM user";
        $query_pro = mysqli_query($mysqli, $sql_pro);
        while($row = mysqli_fetch_array($query_pro)){
            if($row['username'] == $username){
                $found = true;
                break;
            }else{
                $found = false;
            }
        }
        
        $password = md5($_POST['password']);
        $ten = $_POST['ten'];
        $diachi = $_POST['diachi'];
        $std = $_POST['sdt'];

        
       
        if($found == 0){
            $sql = "INSERT INTO user(username, password, ten, diachi, sdt, admin) 
            VALUE ('".$username."', '".$password."', '".$ten."', '".$diachi."', '".$std."', 0)";
            //echo $sql;
            $query= mysqli_query($mysqli, $sql);
            $_SESSION['dangky'] = $username;
            header("Location:../../index.php");
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐĂNG KÝ</title>
    <!-- bootrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
     <!-- font anwsome -->
     <script src="https://kit.fontawesome.com/5644bf12f0.js" crossorigin="anonymous"></script>

     <style>
        .error{
            color:red;
        }
     </style>
</head>
<body>
    
    <form action="" method="post">
    <label for="">username: </label>
    <input type="text" name="username">
    <?php
        if(isset($_POST['dk']) && $found = 1){
        
    ?>
    <label class="error">đẫ có người sử dụng tk này</label>
    <?php
        }
    ?>
    
    <label for="">password</label>
    <input type="password" name="password">

    <label for="">TÊN: </label>
    <input type="text" name="ten">

    <label for="">ĐỊA CHỈ</label>
    <input type="text" name="diachi">

    <label for="">sdt</label>
    <input type="text" name="sdt">

    <button class="btn btn-primary" type="submit" name="dk">ĐK</button>
    </form>

    
    
</body>
</html>