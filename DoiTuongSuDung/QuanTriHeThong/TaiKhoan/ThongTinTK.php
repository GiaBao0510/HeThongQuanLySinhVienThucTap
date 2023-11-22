<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");
    include('../../TrangDungChung/CacHamXuLy.php');

    //Chấp nhân với phương thức post
    header('Access-Control-Allow-Methods: POST');
    /*
    echo "<p>UserID:</p>".$_POST['UserID'];
    echo "<p>UserRole: </p>".$_POST['UserRole'];
    echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
    echo "<p>Xác nhận: </p>".$_POST['XacNhanMatKhau'];*/

    //Thực hiện thêm 1 tài khoản
    $addUser = "INSERT INTO taikhoan VALUES('".$_POST['UserID']." ',' ".$_POST['MatKhau']." ',' ".$_POST['UserRole']." ')";
    $chay = TruyVan($addUser);

    //Đóng
    mysqli_close($connect);
    
    header("Location: ../../QuanTriHeThong/TrangChu.php");
        
    
?>