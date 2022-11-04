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
    
        
        #register-form{
            margin-top: 100px;
            margin-bottom: 100px;
            margin-left: 250px;
            margin-right: 250px;
        }
        img{
            margin-top: 100px;
        }
        h1{
            font-size: 3em;
            margin-top: 50px;
            text-align: center;
            color: blue;
            font-weight: bold;
        }

        a{
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    
    <h1>ĐĂNG KÝ TÀI KHOẢN</h1>
    <div class="row">
        <div class="col-5 mb-3">
            <img width="700px" height="500px" src="../img/login.jpg" alt="">
        </div>
        
        <div class="col">
            <form id="register-form" method="POST">
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
                    
                    <?php
                    if(isset($_POST['dk']) && $found = 1){
                    ?>
                    
                    <label class="error">ĐÃ có người sử dụng tk này. Vui lòng chọn tên tk khác</label>

                    <?php
                        }
                    ?>

                </div>

                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>

                <div class="mb-3">
                    <label for="ten" class="form-label">Tên:</label>
                    <input type="text" class="form-control" id="ten" placeholder="Enter your name" name="ten">
                </div>

                <div class="mb-3">
                    <label for="diachi" class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" id="diachi" placeholder="Enter your address" name="diachi">
                </div>

                <div class="mb-3">
                    <label for="sdt" class="form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" id="sdt" placeholder="Enter your phone number" name="sdt">
                </div>
                
                <div class="form-check mb-3">
                    <label class="form-check-label">ACCEPT ALL OUR POLICY</label>
                    <input class="form-check-input" type="checkbox" name="agree">
                </div>

                <div class="form-group row mb-3">
                    <label class="col">ĐÃ CÓ TÀI KHOẢNG?</label>
                    <label class="col"><a href="login.php">ĐĂNG NHẬP TẠI ĐÂY</a></label>
                </div>

                <button type="submit" class="btn btn-primary" name="dk">Đăng ký</button>
            </form>
        </div>
    </div>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
		$(document).ready(function (){
			$("#register-form").validate({
				rules:{
					username: {required:true, minlength:6},
					password: {required: true, minlength:6},
					ten: {required:true, minlength:4},
					diachi: {required: true, minlength:6},
                    sdt: {required: true, number: true, minlength:10, maxlength:10},
					agree: {required:true}
				},
				messages:{
					username: {required: "USERNAME không được bỏ trống", minlength:"Ít nhất 6 ký tự"},
					password: {required: "MẬT KHẨU không được bỏ trống", minlength:"độ dài tối thiểu là 6"},
					ten: {required:"TÊN không được bỏ trống", minlength:"TÊN QUÁ NGẮN"},
					diachi: {required: "ĐỊA CHỈ không được bỏ trống", minlength:"ĐỊA CHỈ quá ngắn"},
                    sdt: {required: "SỐ ĐIỆN THOẠI không được trống", number: "BẠN CHỈ ĐƯỢC NHẬP SỐ", minlength:"SỐ DIỆN THOẠI phải có 10 số", maxlength:"SỐ DIỆN THOẠI phải có 10 số"},
					agree: {required: "BẠN PHẢI CHẤP NHẬN QUY ĐỊNH CỦA CHÚNG TÔI"}
				}
			})
		});
   </script>
</body>
</html>