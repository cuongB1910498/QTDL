<?php
    session_start();
    include("src/conect/conect.php");
    // if(!isset($_SESSION['dangnhap']))
    // {
    //     header("Location:src/login.php");
    // }
    //echo $_SESSION['dangnhap'];
    //echo $_SESSION['admin'];
    if(isset($_SESSION['dangky'])){
        echo '<script>alert("Đăng Ký thành công");</script>';
        unset($_SESSION['dangky']);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ PHÒNG HỌC</title>
    <!-- bootrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- font anwsome -->
    <script src="https://kit.fontawesome.com/5644bf12f0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>

<div class="container">
   <!--  -->
   <div class="header row mb-3">
        <!-- logo công ti -->
        <div class="logo col-4">
            <a href="index.php"><img src="src/img/Untitled.png" alt="error" width="150px"></a>
        </div>
        
        <!-- thanh tìm kiếm -->
        <div class="search col">
            <form action="index.php?quanly=tiemkiem" method="POST">
                <input type="text" placeholder="TÌM KIẾM..." width="300px" name="tukhoa">
                <button class="btn btn-primary" type="submit" name="tiemkiem">TÌM KIẾM</button>
            </form>
        </div>

        <!-- nút đăng nhập/đăng ký -->
        <?php
            if(!isset($_SESSION['dangnhap'])){

        ?>
        
        <div class="login col-3">
            <a href="src/pages/login.php" class="btn btn-info">ĐĂNG NHẬP</a>
            <a href="src/pages/register.php" class="btn btn-warning">ĐĂNG KÝ</a>
        </div>

        <?php 
            }else{
        ?>
        <div class="logout col-3">
            <a href="src/pages/logout.php" class="btn btn-danger"> ĐĂNG XUẤT</a>
        </div>

        <?php 
            }
        ?>
    </div>
    
    <!-- thân chính -->
    <div class="main">
    
    <?php 
        if((isset($_SESSION['dangnhap'])) && ($_SESSION['admin'] == 1)){

    ?>
    
    <div class="quanly row">
        <div class="col offset-4">
        <a href="index.php?quanly=themphong" class="btn btn-info" >THÊM PHÒNG</a>
        <a href="index.php?quanly=themloaitb" class="btn btn-dark">THÊM LOẠI TB</a>
        <a href="index.php?quanly=log" class="btn btn-warning">NHẬT KÝ HỆ THỐNG</a>
        
    </div>
    
    <?php
        }
    ?>

    <div class="row">
        <?php
        
        if(isset($_GET['quanly'])){
            $tam = $_GET['quanly'];
        }else{
            $tam = '';
        }

        if($tam == 'themloaitb'){
            include("src/pages/modules/themloaitb.php");
        }elseif($tam == 'themphong'){
            include("src/pages/modules/themphong.php");
        }elseif($tam == 'sualoai'){
            include("src/pages/modules/sualoai.php");
        }elseif($tam == 'themphong'){
            include("src/pages/modules/themphong.php");
        }elseif($tam == 'chitiet'){
            include("src/pages/modules/chitietphong.php");
        }elseif($tam == 'suachitiet'){
            include("src/pages/modules/suachitietphong.php");
        }elseif($tam == 'suaphong'){
            include("src/pages/modules/suaphong.php");
        }elseif($tam == 'log'){
            include("src/pages/modules/log.php");
        }elseif($tam == 'tiemkiem'){
            include("src/pages/modules/tiemkiem.php");
        }


        else{
            include("src/pages/main.php");
        }
        ?>
    </div>

    </div>
    
    <!-- bản quyền trang web -->
    <div class="footer row">
        <div class="col d-flex justify-content-center">CHỊU TRÁCH NHIỆM CHÍNH: CÔNG TY THYN</div>
        <?php
            // $sql_pro = "call find_usn('ad')";
            // $query_pro = mysqli_query($mysqli, $sql_pro);
            // $count = mysqli_num_rows($query_pro);
            // if($count > 0){
            //     echo "ok";
            // }
        ?>
    </div> 
</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
</body>
</html>