<?php
    
    function ThucHienDangXuat(){
        session_start();

        if(isset($_SESSION['user']))
            unset($_SESSION['user']);
        if(isset($_SESSION['pw']))
            unset($_SESSION['pw']);
        if(isset($_SESSION['role']))
            unset($_SESSION['role']);
        //Hủy phiên làm việc
        session_destroy();
    }
    ThucHienDangXuat();
    echo '<script defer>
            window.location.href = "../TrangDungChung/index.html";
        </script>';
?>
