<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");

    //Chấp nhân với phương thức post
    header('Access-Control-Allow-Methods: POST');
    
    $ma = trim($_POST['MaKhoa']);

    //Thực hiện tìm kiếm có lớp nào trùng không
    $timKiem = "SELECT * FROM khoa WHERE MaKhoa = '$ma'";
    $thucHienTimKiem= mysqli_query($connect,$timKiem);
    $maDuocTim = strval(mysqli_fetch_array($thucHienTimKiem)['MaKhoa']);
    /*echo "<p>Mã Số Giáo Viên:</p>".$_POST['MSGV'];
    echo "<p>Họ Tên: </p>".$_POST['HoTen'];
    echo "<p>Giới tính: </p>".$_POST['gioitinh'];
    echo "<p>Ngày sinh: </p>".$_POST['ngaySinh'];
    echo "<p>SĐT: </p>".$_POST['sdt_gv'];
    echo "<p>Gmail: </p>".$_POST['Email_gvhd'];
    echo "<p>Mật khẩu: </p>".$_POST['pw_gvhd'];
    echo "<p>Địa chỉ: </p>".$_POST['diaChi_gv'];
    echo "<p>Mã khoa: </p>".$ma;
    echo "<p>CCCD: </p>".$_POST['cccd'];*/

    //Nếu tìm thấy mã lớp cần tìm thì Thực hiện Kiểm tra thêm lần nữa
    
    if($ma === $maDuocTim){

        //Kiểm tra xem mã số Giáo viên có bị trùng không . nếu không trùng thì thêm dữ liệu
        $maso = trim($_POST["MSGV"]);
        $masoTrung = "SELECT * FROM giangvienhuongdan WHERE MSGV = '$maso' ";
        $thucHienTimMaSoTrung = mysqli_query($connect,$masoTrung);
        if(empty(mysqli_fetch_array($thucHienTimMaSoTrung))){
           //Lệnh dùng để xen mẫu tin
            $chenMauTin = "INSERT INTO giangvienhuongdan values ('".$_POST['MSGV']."','".$_POST['HoTen']."','".$_POST['ngaySinh']."','".$_POST['gioitinh']."','".$_POST['diaChi_gv']."','".$_POST['sdt_gv']."','".$_POST['Email_gvhd']."','".$_POST['cccd']."','".$ma."') ";
            $role = 2;
            $chenMauTin_taiKhoan = "INSERT INTO taikhoan VALUES('".$_POST['MSGV']."','".$_POST['pw_gvhd']."','".$role."') ";
            
            //Điều kiện trước khi xen nếu toàn bộ trường được điền thì xen
            if(!empty($_POST['HoTen']) and !empty($_POST['ngaySinh']) and !empty($_POST['gioitinh']) and
            !empty($_POST['diaChi_gv']) and !empty($_POST['MaKhoa']) and !empty($_POST['pw_gvhd']) and !empty($_POST['sdt_gv'])
            and !empty($_POST['cccd']) and !empty($_POST['Email_gvhd'])){
                //Thực hiện chuyển cơ sở dữ liệu
                $chuyen1 = mysqli_query($connect, $chenMauTin) or die(mysqli_connect_error());
                $chuyen2 = mysqli_query($connect,$chenMauTin_taiKhoan) or die(mysqli_connect_error());
                
                //Thông báo thành công
                echo "<script>
                        alert('Thêm thành công');
                        history.back();
                    </script>";
            }else{
                // Thông báo thất bại
                echo "<script>
                        alert('Do một số trường không điển đầy đủ. => Thêm thất bại');
                        history.back();
                    </script>";
            }
        }else{
            echo "<script>
                        alert('Mã số giáo viên hướng dẫn bị trùng. => Thêm thất bại');
                        history.back();
                    </script>";
        }
        
        
    }

?>
