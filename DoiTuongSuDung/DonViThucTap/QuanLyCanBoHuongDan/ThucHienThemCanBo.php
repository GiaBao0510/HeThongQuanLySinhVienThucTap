<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");
    include("../../TrangDungChung/CacHamXuLy.php");
    
    $mdvtt = trim($_GET['MaDVTT']);
    $mscb = trim($_POST['MSCB']);
    //Thực hiện tìm kiếm có lớp nào trùng không

    echo "<p>Mã Số cán bộ:</p>".$_POST['MSCB'];
    echo "<p>Họ Tên: </p>".$_POST['HoTen'];
    echo "<p>Giới tính: </p>".$_POST['GioiTinh'];
    echo "<p>Ngày sinh: </p>".$_POST['NgaySinh'];
    echo "<p>SĐT: </p>".$_POST['SDT'];
    echo "<p>Gmail: </p>".$_POST['Email'];
    echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
    echo "<p>Địa chỉ: </p>".$_POST['DiaChi'];

    //Kiểm tra xem tài khoản đã tồn tại chưa nếu tồn tại rồi thì thông báo
    $lenhKT = "SELECT COUNT(*) dem FROM canbohuongdan WHERE MSCB = '$mscb'";
    $ThucHienKT = TruyVan($lenhKT);
    if(mysqli_fetch_array($ThucHienKT)['dem'] > 0){
        echo "<script>
                alert('Tài khoản này đã tồn tại');
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

?>

