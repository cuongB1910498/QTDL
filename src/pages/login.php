<?php
    session_start();
    include ('../conect/conect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."' ";
        $query= mysqli_query($mysqli,$sql);
        $count = mysqli_num_rows($query);
        if($count>0){
			$_SESSION['dangnhap'] = $username;
            $row = mysqli_fetch_array($query);
            $_SESSION['admin'] = $row['admin'];
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
    <title>LOGIN</title>
    <!-- bootrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
     <!-- font anwsome -->
     <script src="https://kit.fontawesome.com/5644bf12f0.js" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
        <label for="">USERNAME: </label>
        <input type="text" name="username" id="">
        <label for="">PASSWORD: </label>
        <input type="password" name="password">
        <button class="btn btn-primary" type="submit">Text</button>
    </form>

    <a href="register.php">đăng ký</a>
</body>
</html>