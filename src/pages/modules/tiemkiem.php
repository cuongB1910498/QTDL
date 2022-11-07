<?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $tukhoa = $_POST['tukhoa'];
        //$sql = "SELECT * FROM phong WHERE stt_phong like '%".$tukhoa."%'";
        $sql = "call timphong('".$tukhoa."')";
        $query = mysqli_query($mysqli, $sql);
        //echo $sql;
        $count = mysqli_num_rows($query);
    }
    
?>
<div class="main">
   <?php 
   if(isset($count) && $count > 0){
   ?>
    <div class="row mb-3" style="margin-top: 20px;">
        <h2>KẾT QUẢ TÌM KIẾM</h2>
    </div>

    <div class="row offset-2">
        <table>
            <tr>
                <th>STT </th>
                <th>PHÒNG</th>
                <th>SỨC CHỨA</th>
                <th>TÌNH TRẠNG</th>
                
                <?php 
                    if(isset($_SESSION['dangnhap']) && $_SESSION['admin'] == 1){  
                ?>
                
                <th>QUẢN LÝ</th>

                <?php
                    }
                ?>
            </tr>
            
            <?php 
                $i = 0;
                while($row = mysqli_fetch_array($query)){
                    $i++;
                    
            ?>

            <tr>
                <td><?php  echo $i ?></td>
                
                <td><?php echo $row['stt_phong'] ?></td>
                
                <td><?php echo $row['cho'] ?></td>
                
                <td><?php  if($row['tinh_trang'] == 1) echo "CÓ THỂ SỬ DỤNG" ?></td>
                
                <?php 
                    if(isset($_SESSION['dangnhap']) && $_SESSION['admin'] == 1){  
                ?>
                
                <td>
                    <a href="index.php?quanly=suaphong&stt_phong=<?php echo $row['stt_phong'] ?>" class="btn btn-warning" type="button">SỬA</a>
                    <a href="index.php?quanly=suaphong&stt_phong=<?php echo $row['stt_phong'] ?>&xoa=1" class="btn btn-danger" type="button">XÓA</a>
                </td>

                <?php
                    }
                ?>
            </tr>

            <?php
                }
            ?>

        </table>
   </div>
   <?php 
    }else{
    ?>

    <div class="row mb-3" style="margin-top: 20px;">
        <h2>KHÔNG CÓ KẾT QUẢ CHO: <?php echo $_POST['tukhoa'] ?></h2>
    </div>
    <?php } ?>
</div>