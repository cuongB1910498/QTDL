<?php
    $stt_phong = $_GET['stt_phong'];
    $id_tb = $_GET['id_tb'];
    if($_SERVER['REQUEST_METHOD']==='GET'){
        $sql_get = "SELECT * FROM tb WHERE id_tb = $id_tb ";
        $query_get = mysqli_query($mysqli,$sql_get);
        $row_get= mysqli_fetch_array($query_get);
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $ten_tb = $_POST['ten_tb'];
        $sl = $_POST['sl'];
        $sl_hu = $_POST['sl_hu'];
        $sql = "UPDATE tb SET ten_tb = '".$ten_tb."' , sl = $sl, sl_hu = $sl_hu WHERE id_tb = $id_tb";
        $query = mysqli_query($mysqli,$sql);
        header("Location: index.php?quanly=chitiet&stt_phong=$stt_phong");

    }

    if(isset($_GET['xoa']) && $_GET['xoa'] == 1){
        $sql_xoa = "DELETE FROM tb WHERE id_tb = $id_tb";
        $query_Xoa = mysqli_query($mysqli, $sql_xoa);
        header("Location: index.php?quanly=chitiet&stt_phong=$stt_phong");
    }
?>

<div class="mb-3"></div>

<div class="main">
    <div class="row mb-3 offset-3">
        <form method="post">
            <div class="form-group row mb-3">
                <label for="ten" class="col-2">TÊN: </label>
                <div class="col-5">
                    <input id="ten" class="form-control" type="text" name="ten_tb" value="<?php echo $row_get['ten_tb'] ?>">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="sl" class="col-2">SỐ LƯỢNG: </label>
                <div class="col-5">
                    <input id="sl" class="form-control" type="text" name="sl" value="<?php echo $row_get['sl'] ?>">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="sl_hu" class="col-2">SỐ LƯỢNG HƯ: </label>
                <div class="col-5">
                    <input id="sl_hu" class="form-control" type="text" name="sl_hu" value="<?php echo $row_get['sl_hu'] ?>">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">CẬP NHẬT</button>
            </div>
        </form>
    </div>
</div>