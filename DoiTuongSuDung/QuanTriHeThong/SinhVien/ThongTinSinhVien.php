<?php
    //Kết Nối
    include("../../TrangDungChung/KetNoi.php");
    include('../../TrangDungChung/CacHamXuLy.php');

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
            
                
            //Tạo giấy phiếu cho sinh viên
            //Biến hỗ trợ
            $STT = ThongTinDotThucTap(date('Y'))['STT'];
            $phieuTiepNhanTT = mssv_PhieuTiepNhanSinhVien($mssv);
            //1.Kiểm tra xem mã số sinh viên có trong bảng giấy giới thiệu không.nếu không có thì chỉ thêm vài biễu mẫu
            $kiemTraMauTin = "SELECT COUNT(*) Co
                                FROM giaygioithieu 
                                WHERE MSSV = '$mssv'";
            $ThucHien2 = mysqli_query($connect,$kiemTraMauTin) or die(mysqli_connect_error());
            $Co = intval(mysqli_fetch_array($ThucHien2)['Co']) ;
            if($Co == 0){

                //Kiểm tra xem có bảng giấy giới thiệu có mẫu tin nào không. Nếu không thì tạo ID mẫu tin giấy giới thiệu
                $DemSoLuong = "SELECT COUNT(*) dem FROM giaygioithieu";
                $ThucHien3 = mysqli_query($connect,$DemSoLuong) or die(mysqli_connect_error());
                $Dem = intval(mysqli_fetch_array($ThucHien3)['dem']);

                if($Dem < 1){
                    $ThemMauTinDau = "INSERT INTO giaygioithieu VALUES('cv01','hv04','".$ketqua['MaNganh']."','".$ketqua['MSSV']."','','','','')";
                    $ThucHIenThemMauTinDau = mysqli_query($connect,$ThemMauTinDau) or die(mysqli_connect_error());
                }else{
                    //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                    $IDCV_Cuoi = "SELECT * FROM giaygioithieu ORDER BY IDCV DESC LIMIT 1";
                    $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                    $ketQua1 = mysqli_fetch_array($ThucHienLay);
                    $newID = IncreaseIDIndex($ketQua1['IDCV']);
                    $ThemMauTinCuoi = "INSERT INTO giaygioithieu VALUES('".$newID."','hv04','".$ketqua['MaNganh']."','".$ketqua['MSSV']."','','','','')";
                    $ThucHIenThemMauTinCuoi = mysqli_query($connect,$ThemMauTinCuoi) or die(mysqli_connect_error());
                }
            }

            //2.Kiểm tra xem mã số sinh viên có trong bảng phiếu theo dõi và giao việc không.nếu không có thì chỉ thêm vài biễu mẫu
            $kiemTraMauTinTDvGV = "SELECT COUNT(*) Co
                            FROM phieutheodoisinhvienthuctap td INNER JOIN phieugiaoviecsinhvienthuctap gv ON td.MSSV = gv.MSSV
                            WHERE td.MSSV = '$mssv'";
            $ThucHienKTgvVaTD = mysqli_query($connect,$kiemTraMauTinTDvGV) or die(mysqli_connect_error());
            $Co = intval(mysqli_fetch_array($ThucHienKTgvVaTD)['Co']) ;
            if($Co == 0){

                //Kiểm tra xem bảng theo dõi có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
                $DemSoLuongTD = "SELECT COUNT(*) dem FROM phieutheodoisinhvienthuctap";
                $ThucHien3 = mysqli_query($connect,$DemSoLuongTD) or die(mysqli_connect_error());
                $DemTD = intval(mysqli_fetch_array($ThucHien3)['dem']);

                if($DemTD < 1){
                    $ThemMauTinDau = "INSERT INTO phieutheodoisinhvienthuctap(MSPTDSV,MSSV,STT) VALUES('ptd01','".$mssv."','".$STT."')";
                    $ThucHIenThemMauTinDau = mysqli_query($connect,$ThemMauTinDau) or die(mysqli_connect_error());
                }else{
                    //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                    $IDCV_Cuoi = "SELECT * FROM phieutheodoisinhvienthuctap ORDER BY MSPTDSV DESC LIMIT 1";
                    $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                    $ketQua1 = mysqli_fetch_array($ThucHienLay);
                    $newID = IncreaseIDIndex($ketQua1['MSPTDSV']);
                    $ThemMauTinCuoi = "INSERT INTO phieutheodoisinhvienthuctap(MSPTDSV,MSSV,STT) VALUES('".$newID."','".$mssv."','".$STT."')";
                    $ThucHIenThemMauTinCuoi = mysqli_query($connect,$ThemMauTinCuoi) or die(mysqli_connect_error());
                }

                //Kiểm tra xem bảng giao việc có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
                $DemSoLuongGV = "SELECT COUNT(*) dem FROM phieugiaoviecsinhvienthuctap";
                $ThucHien4 = mysqli_query($connect,$DemSoLuongGV) or die(mysqli_connect_error());
                $DemGV = intval(mysqli_fetch_array($ThucHien4)['dem']);

                if($DemGV < 1){
                    $ThemMauTinDau = "INSERT INTO phieugiaoviecsinhvienthuctap(MSPGVSV,MSSV,STT) VALUES('ptd01','".$mssv."','".$STT."')";
                    $ThucHIenThemMauTinDau = mysqli_query($connect,$ThemMauTinDau) or die(mysqli_connect_error());
                }else{
                    //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                    $IDCV_Cuoi = "SELECT * FROM phieugiaoviecsinhvienthuctap ORDER BY MSPGVSV DESC LIMIT 1";
                    $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                    $ketQua1 = mysqli_fetch_array($ThucHienLay);
                    $newID = IncreaseIDIndex($ketQua1['MSPGVSV']);
                    $ThemMauTinCuoi = "INSERT INTO phieugiaoviecsinhvienthuctap(MSPGVSV,MSSV,STT) VALUES('".$newID."','".$mssv."','".$STT."')";
                    $ThucHIenThemMauTinCuoi = mysqli_query($connect,$ThemMauTinCuoi) or die(mysqli_connect_error());
                }

            }    
                //Thông báo thành công
                echo "<p>Thêm thành công</p>";
            }else{
                // Thông báo thất bại
                echo "<p>Do một số trường không điển đầy đủ. => Thêm thất bại</p>";
            }
        }else{
            echo "<p>Mã số sinh viên bị trùng. => Thêm thất bại</p>";
        }
        header("Location: ../../QuanTriHeThong/TrangChu.php");
        
    }

?>