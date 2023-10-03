<?php
    //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
    include ('../../TrangDungChung/KetNoi.php');

    //Lệnh truy vấn
    $CapNhat_dvtt = "UPDATE donvithuctap
                    SET MaDVTT = '".trim($_POST['MaDVTT'])."', TenDVTT = '".trim($_POST['TenDVTT'])."', DiaChi = '".trim($_POST['DiaChi'])."', SDT = '".trim($_POST['SDT'])."', Email = '".trim($_POST['Email'])."'
                    WHERE MaDVTT = '".trim($_POST['MaDVTT'])."' ";
    $CapNhat_tk = " UPDATE taikhoan
                    SET UserID = '".trim($_POST['MaDVTT'])."', MatKhau = '".trim($_POST['MatKhau'])."', UserRole = '".trim($_POST['UserRole'])."'
                    WHERE  UserID = '".trim($_POST['MaDVTT'])."' ";
    //Thực hiện
    $thucHien1 = mysqli_query($connect,$CapNhat_dvtt ) or die(mysqli_connect_error());
    $thucHien2 = mysqli_query($connect,$CapNhat_tk ) or die(mysqli_connect_error());
    //Đóng HQTCSDL
    mysqli_close($connect); 
    //Quay về
    header("Location: ../TrangChu.php?status=success")
?>