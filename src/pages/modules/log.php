<?php 
    $sql = "SELECT * FROM logloai_tb";
    $query = mysqli_query($mysqli, $sql);
    
?>
<div class="main">
    <div class="row mb-3" style="margin-top: 20px;">
        <h2>NHẬT KÝ HỆ THỐNG</h2>
    </div>
    <div class="row offset-2">
    <table>
        <tr>
            
            <th>STT</th>
            <th>THAO TÁC</th>
            <th>TÊN</th>
            <th>THỜI GIAN</th>
        </tr>
        
        <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query)){
                $i++;
            
        ?>
        
        <tr>
            <td><?php echo $i ?></td>

            <td><?php echo $row['thaotac'] ?></td>

            <td><?php echo $row['ten'] ?></td>

            <td><?php echo $row['thoigian'] ?></td>
        </tr>

        <?php
            }
        ?>

    </table>
    </div>
</div>