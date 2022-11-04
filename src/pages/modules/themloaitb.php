<?php
    
    echo "<h2>Thêm loại thiết bị</h2>";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id_Loai = $_POST['id_Loai'];
        $tenloai_tb = $_POST['ten_tb'];
        $sql = "INSERT INTO loai_tb(id_Loai, tenloai_tb) VALUES ('".$id_Loai."', '".$tenloai_tb."') ";
        
        
        $query = mysqli_query($mysqli, $sql);
        header("Location: index.php?quanly=themloaitb");
    }

?>

<div class="row offset-2">
<form method="post">
    <div class="form-group row mb-3">
        <label for="ma" class="col-2" >Mã</label>
        <div class="col-5"> <input id="ma" class="form-control" type="text" name="id_Loai"></div>
    </div>

    <div class="form-group row mb-3">
        <label for="" class="col-2" >TÊN THIẾT BỊ:</label>
        <div class="col-5"> <input id="ma" class="form-control" type="text" name="ten_tb"></div>
    </div>
    <div class="row mb-3">
        <div class="col offset-3">
            <button class="btn btn-primary" type="submit">GỬI</button>
        </div>
    </div>
</form>
</div>

<h3>loại thiết bị có sẵn</h3>
<?php
    $sql_lk = "SELECT * FROM loai_tb";
    $query_lk = mysqli_query($mysqli, $sql_lk);
?>
<div class="row offset-1">
<table border="1">
    <tr>
        <th>STT</th>
        <th>MÃ</th>
        <th>TÊN THIẾT BỊ</th>
        <th>QUẢN LÝ</th>
    </tr>
    
    <?php
        $i = 1;
        while($row_lk = mysqli_fetch_array($query_lk)){   
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row_lk['id_Loai'] ?></td>
        <td><?php echo $row_lk['tenloai_tb'] ?></td>
        <td width = 200px>
            <a href="index.php?quanly=sualoai&id_loai=<?php echo$row_lk['id_Loai'] ?>" class="btn btn-warning">SỬA</a>
            <a href="index.php?quanly=sualoai&id_loai=<?php echo$row_lk['id_Loai'] ?>&xoa=1" class="btn btn-danger">XÓA</a>
        </td>
    </tr>

    <?php
        $i++;
        }
    ?>
</table>
</div>