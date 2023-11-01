<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");
    include("../../TrangDungChung/CacHamXuLy.php");

    //Chấp nhân với phương thức post
    header('Access-Control-Allow-Methods: POST');
    
    $ma = trim($_POST['MaDVTT']);

    //Thực hiện tìm kiếm có lớp nào trùng không
    $maDuocTim = infDonViThucTap($ma)['MaDVTT'];

    /*echo "<p>Mã Số Giáo Viên:</p>".$_POST['MSCB'];
    echo "<p>Họ Tên: </p>".$_POST['HoTen'];
    echo "<p>Giới tính: </p>".$_POST['GioiTinh'];
    echo "<p>Ngày sinh: </p>".$_POST['NgaySinh'];
    echo "<p>SĐT: </p>".$_POST['SDT'];
    echo "<p>Gmail: </p>".$_POST['Email'];
    echo "<p>Mật khẩu: </p>".$_POST['MatKhau'];
    echo "<p>Địa chỉ: </p>".$_POST['DiaChi'];
    echo "<p>Mã đơn vị thực tập: </p>".$ma;
    echo "<p>Mã đơn vị thực tập vừa tìm đươc: ".$maDuocTim."</p>";*/

    //Nếu tìm thấy mã lớp cần tìm thì Thực hiện Kiểm tra thêm lần nữa
    
    if(!empty($maDuocTim)){
        echo "<p>Tìm thấy mã đơn vị thực tập </p>";
        //Kiểm tra xem mã số Giáo viên có bị trùng không . nếu không trùng thì thêm dữ liệu
        $maso = trim($_POST["MSCB"]);
        $masoTrung = "SELECT * FROM canbohuongdan WHERE MSCB = '$maso' ";
        $thucHienTimMaSoTrung = mysqli_query($connect,$masoTrung);
        if(empty(mysqli_fetch_array($thucHienTimMaSoTrung))){
           //Lệnh dùng để xen mẫu tin
            $chenMauTin = "INSERT INTO canbohuongdan values ('".$_POST['MSCB']."','".$_POST['HoTen']."','".$_POST['NgaySinh']."','".$_POST['GioiTinh']."','".$_POST['DiaChi']."','".$_POST['SDT']."','".$_POST['Email']."','".$ma."') ";
            $role = 4;
            $chenMauTin_taiKhoan = "INSERT INTO taikhoan VALUES('".$_POST['MSCB']."','".$_POST['MatKhau']."','".$role."') ";
            
            //Điều kiện trước khi xen nếu toàn bộ trường được điền thì xen
            if(!empty($_POST['HoTen']) and !empty($_POST['NgaySinh']) and !empty($_POST['GioiTinh']) and
            !empty($_POST['DiaChi']) and !empty($_POST['MaDVTT']) and !empty($_POST['MatKhau']) and !empty($_POST['SDT'])
            and !empty($_POST['Email'])){
                //Thực hiện chuyển cơ sở dữ liệu
                $chuyen1 = mysqli_query($connect, $chenMauTin) or die(mysqli_connect_error());
                $chuyen2 = mysqli_query($connect,$chenMauTin_taiKhoan) or die(mysqli_connect_error());
                
                //Thông báo thành công
                echo "<p>Thêm thành công</p>";
            }else{
                // Thông báo thất bại
                echo "<p>Do một số trường không điển đầy đủ. => Thêm thất bại</p>";
            }
        }else{
            echo "<p>Mã số giáo viên hướng dẫn bị trùng. => Thêm thất bại</p>";
            
        }   
    }else{
        echo "<p>Khong tìm thấy mã đơn vị thực tập </p>";
    }
    header("Location: ../../QuanTriHeThong/TrangChu.php");
?>