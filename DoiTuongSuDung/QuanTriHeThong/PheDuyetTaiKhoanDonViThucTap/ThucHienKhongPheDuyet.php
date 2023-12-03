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

    $lenhXoaTaiKhoan = "DELETE FROM taikhoan 
                        WHERE UserID = '$uid'";
    $lenhXoaThongTin = "DELETE FROM donvithuctap 
                        WHERE MaDVTT = '$uid'";

    TruyVan($lenhXoaTaiKhoan);
    TruyVan($lenhXoaThongTin);
    //Thoat
    echo "<script>
            alert('Thực hiện không phê duyệt thành công.');
            history.back();
        </script>";
?>