<?php
    $found = false;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stt_phong = $_POST['stt'];
        $cho =$_POST['cho'];

        $sql_check = "SELECT stt_phong FROM phong";
        $query_check = mysqli_query($mysqli,$sql_check);
        
        while ($row = mysqli_fetch_array($query_check)){
            if($row['stt_phong'] == $stt_phong){
                $found = true;
                break;
            }
        }

        if($found == false){
            $sql = "INSERT INTO phong(stt_phong, cho, tinh_trang) VALUES('".$stt_phong."', '".$cho."', 1)";
            //echo $sql;
            $query = mysqli_query($mysqli, $sql);
            $_SESSION['themphong'] = 1;
            header("Location: index.php?quanly=themphong");
        }
        
        
    }
?>
<h2>Thêm Phòng Mới</h2>
<div class="main">
<div class="row">
<form method="post" id="themphong">
    <div class="form-group row mb-3 offset-3">
        <label for="stt" class="col-2" >STT: </label>
        <div class="col-5"> 
            <input id="stt" class="form-control" type="text" name="stt">
            <?php
                if($found == true){
            ?>
            <label class="error">Phòng bị trùng rồi kìa, kiểm tra lại nhe bạn admin :))</label>
            <?php
                }
            ?>
        </div>
        
       
    </div>

    <div class="form-group row mb-3 offset-3">
        <label for="succhua" class="col-2" >SỨC CHỨA: </label>
        <div class="col-5"> <input id="succhua" class="form-control" type="text" name="cho"></div>
        
    </div>

    <div class="form-group row">
        <div class="col offset-5">
            <button class="btn btn-primary" type="submit">GỬI</button>
        </div>
    </div>
    

</form>
</div>

<h2>DANH SÁCH PHÒNG CŨ</h2>
<div class="row offset-2">
    <table border="1">
        <tr>
            <th>STT </th>
            <th>MÃ PHÒNG </th>
            <th>SỨC CHỨA</th>
            <th>TÌNH TRẠNG</th>
            <th>CHI TIẾT</th>
            <th>THAO TÁC</th>
        </tr>
        
        <?php
            $sql_p = "SELECT * FROM phong";
            $query_p = mysqli_query($mysqli, $sql_p);
            $i = 0;
            while ($rows = mysqli_fetch_array($query_p)){
                $i++;
        ?>
        
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rows['stt_phong'] ?></td>
            <td><?php echo $rows['cho'] ?></td>
            <td><?php if ($rows['tinh_trang'] == 1) echo "CÓ THỂ SỬ DỤNG" ?></td>
            <td><a href="index.php?quanly=chitiet&stt_phong=<?php echo $rows['stt_phong'] ?>" class="btn btn-info">CHI TIẾT</a></td>
            <td>
                <a href="index.php?quanly=suaphong&stt_phong=<?php echo $rows['stt_phong'] ?>" class="btn btn-warning" type="button">SỬA</a>
                <a href="index.php?quanly=suaphong&stt_phong=<?php echo $rows['stt_phong'] ?>&xoa=1" class="btn btn-danger" type="button">XÓA</a>
            </td>
        </tr>

        <?php
            }
        ?>
    </table>
</div>
</div>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
	$(document).ready(function (){
		$("#themphong").validate({
			rules:{
				stt: {required:true},
				cho: {required: true, number: true},
					
			},
			messages:{
				stt: {required: "Bạn chưa nhập số phòng kìa"},
				cho: {required: "Bạn chưa nhập chỗ kìa", number:"Bạn chỉ được nhập số thôi"},
	
			}
		})
	});
</script>