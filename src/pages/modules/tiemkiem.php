<?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $tukhoa = $_POST['tukhoa'];
        //$sql = "SELECT * FROM phong WHERE stt_phong like '%".$tukhoa."%'";
        $sql = "call tiemphong('".$tukhoa."')";
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
        <h2>KẾT QUẢ TIỀM KIẾM</h2>
    </div>

    <div class="row offset-2">
        <table>
            <tr>
                <th>STT </th>
                <th>PHÒNG</th>
                <th>SỨC CHỨA</th>
                <th>TÌNH TRẠNG</th>
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
                
                <td><?php echo $row['tinh_trang'] ?></td>
                
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