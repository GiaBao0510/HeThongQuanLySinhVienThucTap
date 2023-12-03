<?php
    //Kết Nối
    session_start();
    ob_start();
    include("../../TrangDungChung/KetNoi.php");
    include('../../TrangDungChung/CacHamXuLy.php');

    //Kiểm tra
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }

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
                TruyVan($chenMauTin_sv);
                TruyVan($chenMauTin_taiKhoan);
                
            //Tạo giấy phiếu cho sinh viên
            //Biến hỗ trợ
            $STT = ThongTinDotThucTap(date('Y'))['STT'];
            $phieuTiepNhanTT = mssv_PhieuTiepNhanSinhVien($mssv);
            //Lấy thông tin sinh viên vừa được tạo
            $ketqua = infSinhVien($mssv);
            
            //Kiểm tra xem có bảng giấy giới thiệu có mẫu tin nào không. Nếu không thì tạo ID mẫu tin giấy giới thiệu
            $DemSoLuong = "SELECT COUNT(*) dem FROM giaygioithieu";
            $ThucHien3 = mysqli_query($connect,$DemSoLuong) or die(mysqli_connect_error());
            $Dem = intval(mysqli_fetch_array($ThucHien3)['dem']);

            if($Dem < 1){
                $ThemMauTinDau = "INSERT INTO giaygioithieu VALUES('cv01','hv04','".$ketqua['MaNganh']."','".$ketqua['MSSV']."','','','','')";
                TruyVan($ThemMauTinDau);
            }else{
                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                $IDCV_Cuoi = "SELECT * FROM giaygioithieu ORDER BY IDCV DESC LIMIT 1";
                $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                $ketQua1 = mysqli_fetch_array($ThucHienLay);
                $newID = IncreaseIDIndex($ketQua1['IDCV']);
                $ThemMauTinCuoi = "INSERT INTO giaygioithieu VALUES('".$newID."','hv04','".$ketqua['MaNganh']."','".$ketqua['MSSV']."','','','','')";
                TruyVan($ThemMauTinCuoi);
            }
            

                //2. Tạo phiếu tiếp nhận sinh viên
            //2.1Kiểm tra xem bảng xác nhận sinh viên thực tập có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
            $DemSoLuongPXNSV = "SELECT COUNT(*) dem FROM phieutiepnhansinhvienthuctapthucte";
            $DemPXNSV = intval(mysqli_fetch_array(TruyVan($DemSoLuongPXNSV))['dem']);
            //2.2 Nếu không có phiếu nào thì tạo mới
            if($DemPXNSV < 1){
                $ThemMauTinDauPhieuTiepNhan = "INSERT INTO phieutiepnhansinhvienthuctapthucte(MSPXNTT,ngayHetHan,MSSV,STT) VALUES('pgt01','".date('Y')."-04-28','".$mssv."','".$STT."')";
                TruyVan($ThemMauTinDauPhieuTiepNhan);
            }else{
                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                $IDPXNSV_Cuoi = "SELECT * FROM phieutiepnhansinhvienthuctapthucte ORDER BY MSPXNTT DESC LIMIT 1";
                $LayIDpxnsvtt = mysqli_fetch_array(TruyVan($IDPXNSV_Cuoi));
                $newIDpxnsvtt = IncreaseIDIndex($LayIDpxnsvtt['MSPXNTT']);
                $ThemMauTinCuoi = "INSERT INTO phieutiepnhansinhvienthuctapthucte(MSPXNTT,ngayHetHan,MSSV,STT) VALUES('".$newIDpxnsvtt."','".date('Y')."-04-28','".$mssv."','".$STT."')";
                TruyVan($ThemMauTinCuoi);
            }

           

            //3.Kiểm tra xem bảng theo dõi có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
            $DemSoLuongTD = "SELECT COUNT(*) dem FROM phieutheodoisinhvienthuctap";
            $ThucHien3 = mysqli_query($connect,$DemSoLuongTD) or die(mysqli_connect_error());
            $DemTD = intval(mysqli_fetch_array($ThucHien3)['dem']);

            if($DemTD < 1){
                $ThemMauTinDau = "INSERT INTO phieutheodoisinhvienthuctap(MSPTDSV,MSSV,STT) VALUES('ptd01','".$mssv."','".$STT."')";
                TruyVan($ThemMauTinDau);
            }else{
                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                $IDCV_Cuoi = "SELECT * FROM phieutheodoisinhvienthuctap ORDER BY MSPTDSV DESC LIMIT 1";
                $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                $ketQua1 = mysqli_fetch_array($ThucHienLay);
                $newID = IncreaseIDIndex($ketQua1['MSPTDSV']);
                $ThemMauTinCuoi = "INSERT INTO phieutheodoisinhvienthuctap(MSPTDSV,MSSV,STT) VALUES('".$newID."','".$mssv."','".$STT."')";
                TruyVan($ThemMauTinCuoi);
            }

            //4.Kiểm tra xem bảng giao việc có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
            $DemSoLuongGV = "SELECT COUNT(*) dem FROM phieugiaoviecsinhvienthuctap";
            $ThucHien4 = mysqli_query($connect,$DemSoLuongGV) or die(mysqli_connect_error());
            $DemGV = intval(mysqli_fetch_array($ThucHien4)['dem']);

            if($DemGV < 1){
                $ThemMauTinDau = "INSERT INTO phieugiaoviecsinhvienthuctap(MSPGVSV,MSSV,STT) VALUES('ptd01','".$mssv."','".$STT."')";
                TruyVan($ThemMauTinDau);
            }else{
                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                $IDCV_Cuoi = "SELECT * FROM phieugiaoviecsinhvienthuctap ORDER BY MSPGVSV DESC LIMIT 1";
                $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                $ketQua1 = mysqli_fetch_array($ThucHienLay);
                $newID = IncreaseIDIndex($ketQua1['MSPGVSV']);
                $ThemMauTinCuoi = "INSERT INTO phieugiaoviecsinhvienthuctap(MSPGVSV,MSSV,STT) VALUES('".$newID."','".$mssv."','".$STT."')";
                TruyVan($ThemMauTinCuoi);
            }

            }else{
                // Thông báo thất bại
                echo "<p>Do một số trường không điển đầy đủ. => Thêm thất bại</p>";
            }
        }else{
            echo "<p>Mã số sinh viên bị trùng. => Thêm thất bại</p>";
        }
        //Thông báo thành công
        echo "<script>
                alert('Thêm thành công');
                history.back();
            </script>";
        
    }

?>