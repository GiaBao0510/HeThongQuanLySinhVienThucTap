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

    $uid = $_POST['UserID'];
    $lenhCapNhat = "UPDATE taikhoan 
                    SET UserRole = '3'
                    WHERE UserID = '$uid'";
    TruyVan($lenhCapNhat);
    //Thoat
    echo "<script>
            alert('Cập nhật thành công');
            history.back();
        </script>";
?>
