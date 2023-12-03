<?php
    session_start();
    ob_start();
    //Thực hiện đăng xuất
    function ThucHienDangXuat($taikhoan,$matkhau,$role){
        unset($_SESSION[$taikhoan]);
        unset($_SESSION[$matkhau]);
        unset($_SESSION[$role]);
        session_destroy();
        $_SESSION["active"] = false;
    }

    //Xử lý nhận thông tin bằng cổng POST
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // echo '<h1>Trước</h1>';
        // echo '<p>'.$_SESSION['user'].'</p>';
        // echo '<p>'.$_SESSION['pw'].'</p>';
        // echo '<p>'.$_SESSION['role'].'</p>';
        // echo '<p>'.$_SESSION['active'].'</p>';
        ThucHienDangXuat($_POST['taikhoan'],$_POST['matkhau'],$_POST['vaitro']);
        // echo '<h1>Sau</h1>';
        // echo '<p>'.$_SESSION['user'].'</p>';
        // echo '<p>'.$_SESSION['pw'].'</p>';
        // echo '<p>'.$_SESSION['role'].'</p>';
        // echo '<p>'.$_SESSION['active'].'</p>';
        echo '<script>
                window.location.href= "'.$_POST['loithoat'].'";
            </script>';

    }
    
?>

