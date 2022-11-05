<?php
    $stt_phong = $_GET['stt_phong'];
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $sql_get = "SELECT * FROM phong WHERE stt_phong = '".$stt_phong."' ";
        $query_get = mysqli_query($mysqli, $sql_get);
        $row_get = mysqli_fetch_array($query_get);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stt_phong = $_POST['stt_phong'];
        $cho = $_POST['cho'];
        $tinhtrang = $_POST['tinhtrang'];
        $sql ="UPDATE phong SET stt_phong = '".$stt_phong."', cho = $cho, tinh_trang = $tinhtrang WHERE stt_phong = '".$stt_phong."' ";
        $query = mysqli_query($mysqli,$sql);
        header("Location: index.php?quanly=themphong");
    }
    
    if(isset($_GET['xoa']) && $_GET['xoa'] == 1){
        $sql_xoa_p = "DELETE FROM phong WHERE stt_phong = '".$stt_phong."' ";
        $sql_xoa_tb = "DELETE FROM tb WHERE stt_phong = '".$stt_phong."' ";
        $query_xoa_p = mysqli_query($mysqli, $sql_xoa_p);
        $query_xoa_tb = mysqli_query($mysqli, $sql_xoa_tb);

        header("Location: index.php?quanly=themphong");
    }
?> 
<div class="main">
    <div class="row">
        <form method="post" id="suaphong">
            <div class="form-group row mb-3 offset-2">
                <label for="stt" class="col-2" >MÃ: </label>
                <div class="col-5"> <input id="stt" class="form-control" type="text" name="stt_phong" value="<?php echo $row_get['stt_phong'] ?>"></div>
            
            </div>

            <div class="form-group row mb-3 offset-2">
                <label for="succhua" class="col-2" >SỨC CHỨA: </label>
                <div class="col-5"> <input id="succhua" class="form-control" type="text" name="cho" value="<?php echo $row_get['cho'] ?>"></div>
                
            </div>

            <div class="form-group row mb-3 offset-2">
                <label for="tt" class="col-2" >TÌNH TRẠNG: </label>
                <div class="col-5"> <input id="tt" class="form-control" type="text" name="tinhtrang" value="<?php echo $row_get['tinh_trang'] ?>"></div>
                
            </div>

            <div class="form-group row">
                <div class="col offset-5">
                    <button class="btn btn-primary" type="submit">GỬI</button>
                </div>
            </div>
        
        </form>
    </div>
</div>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
	$(document).ready(function (){
		$("#suaphong").validate({
			rules:{
				stt_phong: {required:true},
				cho: {required: true, number: true},
                tinhtrang: {required: true}
					
			},
			messages:{
				stt_phong: {required: "Bạn chưa nhập số phòng kìa"},
				cho: {required: "Bạn chưa nhập chỗ kìa", number: "Bạn chỉ được nhập số thôi"},
                tinhtrang: {required: "Chưa nhập tình trạng kìa bạn êi"}
	
			}
		})
	});
</script>