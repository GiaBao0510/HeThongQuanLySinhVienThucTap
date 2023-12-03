<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhâp
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }
    
    $userID = $_GET['UserID'];
    
    $sql = "DELETE FROM taikhoan WHERE UserID = '$userID'";
    TruyVan($sql);

    //Thoát
    echo"<script>
            alert('Xóa thành công.');
            history.back();
        </script>";
?>