<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhập
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }else{
        // echo "<p>Mã Số Giáo Viên:</p>".$_POST['MSCB'];
        // echo "<p>Họ Tên: </p>".$_POST['HoTen'];
        // echo "<p>Giới tính: </p>".$_POST['GioiTinh'];
        // echo "<p>Ngày sinh: </p>".$_POST['NgaySinh'];
        // echo "<p>SĐT: </p>".$_POST['SDT'];
        // echo "<p>Gmail: </p>".$_POST['Email'];
        // echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
        // echo "<p>Địa chỉ: </p>".$_POST['DiaChi'];

        $mscb = $_POST['MSCB'];
        $hoten = $_POST['HoTen'];
        $gioiTinh = $_POST['GioiTinh'];
        $ngaySinh = $_POST['NgaySinh'];
        $sdt = $_POST['SDT'];
        $email = $_POST['Email'];
        $pw = $_POST['MatKhau'];
        $diaChi = $_POST['DiaChi'];
        //Lệnh truy vấn
        $CapNhat_sv = "UPDATE canbohuongdan
                    SET MSCB = '".$mscb."', HoTen = '".$hoten."', NgaySinh = '".$ngaySinh."',
                        GioiTinh = '".$gioiTinh."', DiaChi = '".$diaChi."', SDT = '".$sdt."',
                        Email = '".$email."'
                    WHERE MSCB = '$mscb' ";

        $CapNhat_tk = " UPDATE taikhoan
                        SET UserID = '".$mscb."', MatKhau = '".$pw."'
                        WHERE  UserID = '$mscb' ";

        //Thực hiện
        $thucHien1 = TruyVan($CapNhat_sv);
        $thucHien2 = TruyVan($CapNhat_tk);

        //Đóng HQTCSDL
        mysqli_close($connect); 

        //Quay về
        echo '<script>
                history.back();
            </script>';
    }

?>
