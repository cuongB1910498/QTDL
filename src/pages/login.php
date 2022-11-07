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
            $_SESSION['dntc'] = 1;
            $row = mysqli_fetch_array($query);
            $_SESSION['admin'] = $row['admin'];
			header("Location:../../index.php");
        }else{
            echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng,vui lòng nhập lại.");</script>';
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

    <style>
        .error{
            color:red;
        }

        #login-form{
            margin-top: 100px;
            margin-bottom: 100px;
            margin-left: 250px;
            margin-right: 250px;
        
        }

        img{
            margin-top: 100px;
        }

        a{
            text-decoration: none;
            color: blue;
        }
        h1{
            font-size: 3em;
            margin-top: 50px;
            text-align: center;
            color: blue;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <h1>ĐĂNG NHẬP</h2>
    <div class="row">
        <div class="col-5 mb-3">
            <img width="700px" height="500px" src="../img/login.jpg" alt="">
        </div>
        
        <div class="col">
            <form id="login-form" method="POST">
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
                </div>

                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>

                <div class="form-group row mb-3">
                    <label for="" class="col">Bạn chưa có tài khoảng?</label>
                    <label for="" class="col"><a href="register.php">Đăng ký tại đây</a></label>
                </div>
                
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            </form>
        </div>
    </div>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
		$(document).ready(function (){
			$("#login-form").validate({
				rules:{
					username: {required:true, },
					password: {required: true, minlength:4},
					
				},
				messages:{
					username: {required: "USERNAME không được bỏ trống"},
					password: {required: "MẬT KHẨU không được bỏ trống", minlength:"độ dài tối thiểu là 4"},
	
				}
			})
		});
   </script>
    
</body>
</html>