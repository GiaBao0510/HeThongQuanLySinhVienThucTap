<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");

    //Chấp nhân với phương thức post
    header('Access-Control-Allow-Methods: POST');
    /*
    echo "<p>UserID:</p>".$_POST['UserID'];
    echo "<p>UserRole: </p>".$_POST['UserRole'];
    echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
    echo "<p>Xác nhận: </p>".$_POST['XacNhanMatKhau'];*/

    //Thực hiện thêm 1 tài khoản
    $addUser = "INSERT INTO taikhoan VALUES('".$_POST['UserID']." ',' ".$_POST['MatKhau']." ',' ".$_POST['UserRole']." ')";
    $chay = mysqli_query($connect,$addUser) or die(mysqli_connect_error());

    //Đóng
    mysqli_close($connect);
    
    header("Location: ../../QuanTriHeThong/TrangChu.php");
        
    
?>