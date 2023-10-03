<?php
    //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
    include ('../../TrangDungChung/KetNoi.php');
    /*echo "<p>Mã Số Giáo Viên:</p>".$_POST['MSGV'];
    echo "<p>Họ Tên: </p>".$_POST['HoTen'];
    echo "<p>Giới tính: </p>".$_POST['GioiTinh'];
    echo "<p>Ngày sinh: </p>".$_POST['NgaySinh'];
    echo "<p>SĐT: </p>".$_POST['SDT'];
    echo "<p>Gmail: </p>".$_POST['Email'];
    echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
    echo "<p>Địa chỉ: </p>".$_POST['DiaChi'];
    echo "<p>Mã khoa: </p>".$_POST['MaKhoa'];
    echo "<p>CCCD: </p>".$_POST['CCCD'];
    echo "<p>Vai trò: </p>".$_POST['UserRole'];*/
    //Lệnh truy vấn
    $CapNhat_sv = "UPDATE giangvienhuongdan
                    SET MSGV = '".mysqli_real_escape_string($connect, trim($_POST['MSGV']))."',
                        HoTen = '".mysqli_real_escape_string($connect, trim($_POST['HoTen']))."',
                        DiaChi = '".mysqli_real_escape_string($connect, trim($_POST['DiaChi']))."',
                        SDT = '".mysqli_real_escape_string($connect, trim($_POST['SDT']))."',
                        Email = '".mysqli_real_escape_string($connect, trim($_POST['Email']))."',
                        NgaySinh = '".mysqli_real_escape_string($connect, trim($_POST['NgaySinh']))."',
                        GioiTinh = '".mysqli_real_escape_string($connect, trim($_POST['GioiTinh']))."',
                        CCCD = '".mysqli_real_escape_string($connect, trim($_POST['CCCD']))."',
                        MaKhoa = '".mysqli_real_escape_string($connect, trim($_POST['MaKhoa']))."'
                    WHERE MSGV = '".mysqli_real_escape_string($connect, trim($_POST['MSGV']))."' ";

    $CapNhat_tk = " UPDATE taikhoan
                    SET UserID = '".trim($_POST['MSGV'])."', MatKhau = '".trim($_POST['MatKhau'])."', UserRole = '".trim($_POST['UserRole'])."'
                    WHERE  UserID = '".trim($_POST['MSGV'])."' ";
    //Thực hiện
    $thucHien1 = mysqli_query($connect,$CapNhat_sv ) or die(mysqli_connect_error());
    $thucHien2 = mysqli_query($connect,$CapNhat_tk ) or die(mysqli_connect_error());

    //Đóng HQTCSDL
    mysqli_close($connect); 
    //Quay về
    header("Location: ../TrangChu.php?status=success")
?>