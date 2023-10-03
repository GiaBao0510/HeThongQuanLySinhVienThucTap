<?php
    //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
    include ('../../TrangDungChung/KetNoi.php');

    //Lệnh truy vấn
    $CapNhat_sv = "UPDATE sinhvien
                    SET MSSV = '".mysqli_real_escape_string($connect, trim($_POST['MSSV']))."',
                        HoTen = '".mysqli_real_escape_string($connect, trim($_POST['HoTen']))."',
                        DiaChi = '".mysqli_real_escape_string($connect, trim($_POST['DiaChi']))."',
                        SDT = '".mysqli_real_escape_string($connect, trim($_POST['SDT']))."',
                        Email = '".mysqli_real_escape_string($connect, trim($_POST['Email']))."',
                        NgaySinh = '".mysqli_real_escape_string($connect, trim($_POST['NgaySinh']))."',
                        GioiTinh = '".mysqli_real_escape_string($connect, trim($_POST['GioiTinh']))."',
                        CCCD = '".mysqli_real_escape_string($connect, trim($_POST['CCCD']))."',
                        MaLop = '".mysqli_real_escape_string($connect, trim($_POST['MaLop']))."'
                    WHERE MSSV = '".mysqli_real_escape_string($connect, trim($_POST['MSSV']))."' ";

    $CapNhat_tk = " UPDATE taikhoan
                    SET UserID = '".trim($_POST['MSSV'])."', MatKhau = '".trim($_POST['MatKhau'])."', UserRole = '".trim($_POST['UserRole'])."'
                    WHERE  UserID = '".trim($_POST['MSSV'])."' ";
    //Thực hiện
    $thucHien1 = mysqli_query($connect,$CapNhat_sv ) or die(mysqli_connect_error());
    $thucHien2 = mysqli_query($connect,$CapNhat_tk ) or die(mysqli_connect_error());
    //Đóng HQTCSDL
    mysqli_close($connect); 
    //Quay về
    header("Location: ../TrangChu.php?status=success")
?>