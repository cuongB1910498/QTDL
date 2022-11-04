<?php
    $sql_ds = "SELECT * FROM phong";
    $query_ds = mysqli_query($mysqli, $sql_ds);
?>
<div class="main">
<h2>DANH SÁCH PHÒNG</h2>
<div class="row offset-1">
    <table border="1">
        <tr>
            <th>STT </th>
            <th>MÃ PHÒNG </th>
            <th>SỨC CHỨA</th>
            <th>TÌNH TRẠNG</th>
            <?php
                if (isset($_SESSION['dangnhap']) && $_SESSION['admin'] != 1){

                
            ?>
            <th>CHI TIẾT</th>
            
            <?php
                }
            ?>
            
        </tr>
        
        <?php
            $i = 0;
            while ($rows = mysqli_fetch_array($query_ds)){
                $i++;
        ?>
        
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rows['stt_phong'] ?></td>
            <td><?php echo $rows['cho'] ?></td>
            <td><?php if ($rows['tinh_trang'] == 1) echo "CÓ THỂ SỬ DỤNG" ?></td>
            
            <?php
                if (isset($_SESSION['dangnhap']) && $_SESSION['admin'] != 1){

                
            ?>
            <td><a href="index.php?quanly=chitiet&stt_phong=<?php echo $rows['stt_phong'] ?>" class="btn btn-info">CHI TIẾT</a></td>

            <?php
                }
            ?>
            
        </tr>

        <?php
            }
        ?>
    </table>
</div>