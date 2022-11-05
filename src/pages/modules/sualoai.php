<?php
    $id_Loai = $_GET['id_loai'];
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        $sql_loai = "SELECT * FROM loai_tb WHERE id_Loai = '".$id_Loai."'";
        $query_loai = mysqli_query($mysqli, $sql_loai);
        $row_loai = mysqli_fetch_array($query_loai);
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $id = $_POST['id_Loai'];
        $tenloai_tb = $_POST['ten_tb']; 
        $sql = "UPDATE loai_tb SET id_Loai = '".$id."' , tenloai_tb = '".$tenloai_tb."' WHERE id_Loai = '".$id_Loai."' ";
        //echo $sql;
        $query = mysqli_query($mysqli, $sql);
        header("Location: index.php?quanly=themloaitb");

    }
    if(isset($_GET['xoa']) && $_GET['xoa'] ==1){
        $sql_xoa = "DELETE FROM loai_tb WHERE id_Loai = '".$id_Loai."' ";
        //echo $sql_xoa;
        $query_xoa = mysqli_query($mysqli, $sql_xoa);

        header("Location: index.php?quanly=themloaitb");
    }
?>

<h2>Sửa loại</h2>
<div class="row offset-2 mb-3">
<form method="post" id="sualoai">
    
    <div class="form-group row mb-3">
        <label for="ma" class="col-2" >Mã</label>
        <div class="col-5"> <input id="ma" class="form-control" type="text" name="id_Loai" value="<?php echo $row_loai['id_Loai'] ?>"></div>
    </div>

    <div class="form-group row mb-3">
        <label for="ten" class="col-2" >TÊN THIẾT BỊ:</label>
        <div class="col-5"> <input id="ten" class="form-control" type="text" name="ten_tb" value="<?php echo $row_loai['tenloai_tb'] ?>"></div>
    </div>
    <div class="row mb-3">
        <div class="col offset-3">
            <button class="btn btn-primary" type="submit">GỬI</button>
        </div>
    </div>
</form>
</div>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
	$(document).ready(function (){
		$("#sualoai").validate({
			rules:{
				id_Loai: {required: true},
				ten_tb: {required: true},
					
			},
			messages:{
				id_Loai: {required: "Bạn chưa nhập mã thiết bị kìa"},
				ten_tb: {required: "Bạn chưa nhập tên thiết bị kìa"},
	
			}
		})
	});
</script>