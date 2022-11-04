<?php
    session_start();
    unset($_SESSION['dangnhap']);
    unset($_SESSION['admin']);
    header("Location:../../index.php")
?>