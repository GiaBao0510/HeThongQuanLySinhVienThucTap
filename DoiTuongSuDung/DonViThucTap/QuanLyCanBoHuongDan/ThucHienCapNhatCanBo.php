<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    /*echo "<p>Mã Số Giáo Viên:</p>".$_POST['MSCB'];
    echo "<p>Họ Tên: </p>".$_POST['HoTen'];
    echo "<p>Giới tính: </p>".$_POST['GioiTinh'];
    echo "<p>Ngày sinh: </p>".$_POST['NgaySinh'];
    echo "<p>SĐT: </p>".$_POST['SDT'];
    echo "<p>Gmail: </p>".$_POST['Email'];
    echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
    echo "<p>Địa chỉ: </p>".$_POST['DiaChi'];*/
    //Lệnh truy vấn
    $CapNhat_sv = "UPDATE canbohuongdan
                    SET MSCB = '".mysqli_real_escape_string($connect, trim($_POST['MSCB']))."',
                        HoTen = '".mysqli_real_escape_string($connect, trim($_POST['HoTen']))."',
                        DiaChi = '".mysqli_real_escape_string($connect, trim($_POST['DiaChi']))."',
                        SDT = '".mysqli_real_escape_string($connect, trim($_POST['SDT']))."',
                        Email = '".mysqli_real_escape_string($connect, trim($_POST['Email']))."',
                        NgaySinh = '".mysqli_real_escape_string($connect, trim($_POST['NgaySinh']))."',
                        GioiTinh = '".mysqli_real_escape_string($connect, trim($_POST['GioiTinh']))."'
                    WHERE MSCB = '".mysqli_real_escape_string($connect, trim($_POST['MSCB']))."' ";

    $CapNhat_tk = " UPDATE taikhoan
                    SET UserID = '".trim($_POST['MSCB'])."', MatKhau = '".trim($_POST['MatKhau'])."'
                    WHERE  UserID = '".trim($_POST['MSCB'])."' ";

    //Thực hiện
    $thucHien1 = mysqli_query($connect,$CapNhat_sv ) or die(mysqli_connect_error());
    $thucHien2 = mysqli_query($connect,$CapNhat_tk ) or die(mysqli_connect_error());

    //Đóng HQTCSDL
    mysqli_close($connect); 

    //Quay về
    echo '<script>
            history.back();
        </script>';
?>
