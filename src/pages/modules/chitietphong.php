<?php
    $stt_phong = $_GET['stt_phong'];
    //echo $stt_phong;
   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $ten_tb = $_POST['ten'];
        $sl = $_POST['sl'];
        //
        $tenloai_tb = $_POST['ten_loai'];
        $sql_idl = "SELECT * FROM loai_tb WHERE tenloai_tb = '".$tenloai_tb."'";
        //echo $sql_idl.'<br>';
        $query_idl = mysqli_query($mysqli, $sql_idl);
        $row_idl = mysqli_fetch_array($query_idl);
        $id_Loai = $row_idl['id_Loai'];
        $sql = "INSERT INTO tb(stt_phong, id_Loai, ten_tb, sl, sl_hu) 
        VALUES ('".$stt_phong."', '".$id_Loai."', '".$ten_tb."', $sl , 0)";
        //echo $sql;
        $query = mysqli_query($mysqli, $sql);
        header("Location: index.php?quanly=chitiet&stt_phong=$stt_phong");
    }
    
?>

<?php
    if($_SESSION['admin'] == 1){
?>
<h2>Thêm Thiết Bị vào Phòng: <?php echo $stt_phong ?></h2>
<div class="row offset-2">
    <form method="POST">
    <div class="form-group row mb-3">
        <label class="col-2">LOẠI THIẾT BỊ:</label>
        <div class="col">
        
        <select name="ten_loai">
            <?php
                $sql_l = "SELECT * FROM loai_tb";
                $query_l = mysqli_query($mysqli, $sql_l);
                while($row_l = mysqli_fetch_array($query_l)){

            
            ?>
            <option><?php echo $row_l['tenloai_tb'] ?></option>
            <?php
                }
            ?>
        </select>
        
    </div>
    </div>

    <div class="form-group row mb-3">
        <label for="my-input" class="col-2">TÊN THIẾT BỊ: </label>
        <div class="col-5">
            <input id="my-input" class="form-control" type="text" name="ten">
        </div>
    </div>

    <div class="form-group row mb-3">
        <label for="my-input" class="col-2">SỐ LƯỢNG: </label>
        <div class="col-5">
            <input id="my-input" class="form-control" type="text" name="sl">
        </div>
    </div>

    <div class="form-group row">
        <div class="col offset-3">
            <button class="btn btn-primary" type="submit">THÊM</button>
        </div>
    </div>
    </form>
</div>

<?php
    }
?>
<h2>CƠ SỞ VẬT CHẤT CỦA PHÒNG: <?php echo $stt_phong ?></h2>
<div class="row offset-1">
    <table>
            <tr>
                <td>STT</td>
                <td>MÃ</td>
                <td>TÊN</td>
                <td>LOẠI</td>
                <td>SỐ LƯỢNG</td>
                <td>TÌNH TRẠNG</td>
                
                <?php
                    if($_SESSION['admin'] == 1){
                ?>
                <td>THAO TÁC</td>

                <?php
                    }
                ?>
            </tr>
            
            <?php
                $sql_csvc = "SELECT * FROM tb as a, loai_tb as b 
                WHERE a.id_Loai = b.id_Loai AND stt_phong = '".$stt_phong."'";
                echo $sql_csvc;
                $query_csvc = mysqli_query($mysqli, $sql_csvc);
                $i = 0;
                while($row = mysqli_fetch_array($query_csvc)){
                    $i ++;
                

            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['id_Loai'] ?></td>
                <td><?php echo $row['ten_tb'] ?></td>
                <td><?php echo $row['tenloai_tb'] ?></td>
                <td><?php echo $row['sl'] ?></td>
                <td><?php if ($row['sl_hu'] == 0) echo "TỐT"; else echo "Hư Hỏng: ".$row['sl_hu'] ?></td>
                
                <?php
                    if($_SESSION['admin'] == 1){
                ?>
                <td>
                    <a href="index.php?quanly=suachitiet&stt_phong=<?php echo $stt_phong ?>&id_tb=<?php echo $row['id_tb'] ?>" class="btn btn-warning" type="button">SỬA</a>
                    <a href="index.php?quanly=suachitiet&stt_phong=<?php echo $stt_phong ?>&id_tb=<?php echo $row['id_tb'] ?>&xoa=1" 
                    class="btn btn-danger" type="button">XÓA</a>
                </td>
                <?php } ?>
            </tr>

            <?php 
                }
            ?>
    </table>
</div>
