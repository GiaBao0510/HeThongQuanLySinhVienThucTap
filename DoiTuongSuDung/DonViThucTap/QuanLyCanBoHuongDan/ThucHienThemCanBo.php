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
        $mdvtt = $_SESSION['user'];
        $mscb = trim($_POST['MSCB']);
        //Thực hiện tìm kiếm có lớp nào trùng không

        // echo "<p>Mã Số cán bộ:</p>".$_POST['MSCB'];
        // echo "<p>Mã Số đơn vị thực tập:</p>".$_POST['MaDVTT'];
        // echo "<p>Họ Tên: </p>".$_POST['HoTen'];
        // echo "<p>Giới tính: </p>".$_POST['GioiTinh'];
        // echo "<p>Ngày sinh: </p>".$_POST['NgaySinh'];
        // echo "<p>SĐT: </p>".$_POST['SDT'];
        // echo "<p>Gmail: </p>".$_POST['Email'];
        // echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
        // echo "<p>Địa chỉ: </p>".$_POST['DiaChi'];
        if(empty($_POST['MSCB']) || empty($_POST['HoTen']) || empty($_POST['GioiTinh']) ||
        empty($_POST['NgaySinh']) || empty($_POST['SDT']) || empty($_POST['Email']) || 
        empty($_POST['MatKhau']) || empty($_POST['DiaChi']) ){
            echo "<script>
                        alert('Tạo tài khoản thất bại');
                        history.back();
                    </script>";
        }else{
            //Lệnh dùng để xen mẫu tin
            $chenMauTin = "INSERT INTO canbohuongdan values ('".$_POST['MSCB']."','".$_POST['HoTen']."','".$_POST['NgaySinh']."','".$_POST['GioiTinh']."','".$_POST['DiaChi']."','".$_POST['SDT']."','".$_POST['Email']."','".$mdvtt."') ";
            $role = 4;
            $chenMauTin_taiKhoan = "INSERT INTO taikhoan VALUES('".$_POST['MSCB']."','".$_POST['MatKhau']."','".$role."') ";

            //Chuyển 
            $chuyen1 = TruyVan($chenMauTin);
            $chuyen2 = TruyVan($chenMauTin_taiKhoan);

            echo "<script>
                    alert('Tạo tài khoản thành công');
                    history.back();
                </script>";
        }
    }
?>

