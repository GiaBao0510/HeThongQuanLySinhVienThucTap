<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");

    //Chấp nhân với phương thức post
    header('Access-Control-Allow-Methods: POST');
    
    $malop = trim($_POST['maLop']);

    //Thực hiện tìm kiếm có lớp nào trùng không
    $timLop = "SELECT MaLop FROM lop WHERE MaLop = '$malop'";
    $thucHienTimLop = mysqli_query($connect,$timLop);
    $maDuocTim = strval(mysqli_fetch_array($thucHienTimLop)['MaLop']);

    //Nếu tìm thấy mã lớp cần tìm thì Thực hiện Kiểm tra thêm lần nữa
    
    if($malop === $maDuocTim){

        //Kiểm tra xem mã số sinh viên có bị trùng không . nếu không trùng thì thêm dữ liệu
        $mssv = trim($_POST["MSSV"]);
        $mssvTrung = "SELECT * FROM sinhvien WHERE MSSV = '$mssv' ";
        $thucHienTimMSSVTrung = mysqli_query($connect,$mssvTrung);
        if(empty(mysqli_fetch_array($thucHienTimMSSVTrung))){
           //Lệnh dùng để xen mẫu tin
            $chenMauTin_sv = "INSERT INTO sinhvien values ('".$_POST['MSSV']."','".$_POST['HoTen']."','".$_POST['ngaySinh']."','".$_POST['gioitinh']."','".$_POST['diaChi_sv']."','".$_POST['sdt_sv']."','".$_POST['Email_sv']."','".$_POST['cccd']."','".$malop."') ";
            $role = 1;
            $chenMauTin_taiKhoan = "INSERT INTO taikhoan VALUES('".$_POST['MSSV']."','".$_POST['pw_sv']."','".$role."') ";
            
            //Điều kiện trước khi xen nếu toàn bộ trường được điền thì xen
            if(!empty($_POST['HoTen']) and !empty($_POST['ngaySinh']) and !empty($_POST['gioitinh']) and
            !empty($_POST['diaChi_sv']) and !empty($_POST['maLop']) and !empty($_POST['pw_sv']) and !empty($_POST['sdt_sv'])
            and !empty($_POST['cccd']) and !empty($_POST['Email_sv'])){
                //Thực hiện chuyển cơ sở dữ liệu
                $chuyen1 = mysqli_query($connect, $chenMauTin_sv) or die(mysqli_connect_error());
                $chuyen2 = mysqli_query($connect,$chenMauTin_taiKhoan) or die(mysqli_connect_error());
                
                //Thông báo thành công
                header("../../TrangDungChung/index.html?status=success");

            }else{
                // Thông báo thất bại
                header("../../TrangDungChung/index.html?status=error");
            }
        }else{
            header("../../TrangDungChung/index.html?status=error");
        }
    }
?> 