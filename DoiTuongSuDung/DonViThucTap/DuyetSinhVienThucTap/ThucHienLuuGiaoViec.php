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
    }
    
    //1.Các mảng cần lưu
    $MangCongViec=$_POST['congViec'];
    $gio = $_POST['Gio'];
    $buoi = $_POST['Buoi'];
    $coSoVatChat = $_POST['DieuKienTT'];
    $tuan = $_POST['Tuan'];

    //2.Thông tin chung cần lưu
    $MaCanboHD = $_POST['MSCB'];
    $MSSV = $_GET['MSSV'];
    $MaDVTT = $_SESSION['user'];

    //3.Lấy thông tin phiếu tiếp nhận,giao việc,theo dõi sinh viên thông qua mã số sinh viên
    $PhieuTiepNhanSinhVien = mssv_PhieuTiepNhanSinhVien($MSSV);
    $PhieuTheoDoiSinhVien = infPhieuTheoDoiSinhVien($MSSV);
    $PhieuGiaoViecNhanSinhVien = infPhieuGiaoViecSinhVien($MSSV);


    //Kiểm tra điều kiện trước khi lưu
    if(KiemTraDaGiaoViecChoSinhVienChua($MSSV) != 8 ){
        //Câu lênh cập nhật bảng phiếu tiếp nhận sinh viên ở cột cán bộ
        $ThemCanBo_PTNSVTT = "UPDATE phieutiepnhansinhvienthuctapthucte SET MSCB = '$MaCanboHD'
            WHERE MSSV = '$MSSV '";
        $ThucHienThem1 = TruyVan($ThemCanBo_PTNSVTT);

        //Câu lênh cập nhật bảng giao viêc sinh viên ở cột cán bộ
        $ThemCanBo_PGVSV = "UPDATE phieugiaoviecsinhvienthuctap SET MSCB = '$MaCanboHD'
            WHERE MSSV = '$MSSV '";
        $ThucHienThem2 = TruyVan($ThemCanBo_PGVSV);

        //Câu lênh cập nhật bảng theo dõi sinh viên ở cột cán bộ
        $ThemCanBo_PTDSV = "UPDATE phieutheodoisinhvienthuctap SET MSCB = '$MaCanboHD'
            WHERE MSSV = '$MSSV '";
        $ThucHienThem3 = TruyVan($ThemCanBo_PTDSV);

        //Vòng lặp thêm công việc được giao
        for($i = 0 ;$i<count($MangCongViec) ;$i+=1){
            // echo "<p>Công việc: ".$MangCongViec[$i]."</p>";
            // echo "<p>Giờ: ".$gio[$i]."</p>";
            // echo "<p>Buổi: ".$buoi[$i]."</p>";
            // echo "<p>Tuần: ".$tuan[$i]."</p>";
            //Thêm thông tin có bảng công việc
            HamThemCongViec($MangCongViec[$i],$gio[$i],$buoi[$i]);

            //4.Lấy ID công viêc cuối
            $truyVanID = "SELECT * FROM congviec
                        ORDER BY thuTu DESC LIMIT 1";

            $IDCongViecCuoiDong =  mysqli_fetch_array(TruyVan($truyVanID));

            //Thêm thông tin cho bảng chi tiết phiếu theo dõi và phiếu giao việc
            $ThemThongTinChiTiet = "INSERT INTO chitietphieudanhgiavaphieutheodoi(MSPXNTT,IDCongViec,MSPGVSV,MSPTDSV,tuan) VALUES('".trim($PhieuTiepNhanSinhVien['MSPXNTT'])."','".$IDCongViecCuoiDong['IDCongViec']."','".$PhieuGiaoViecNhanSinhVien['MSPGVSV']."','".$PhieuTheoDoiSinhVien['MSPTDSV']."','".$tuan[$i]."')";
            $ThucHienThem4 = TruyVan($ThemThongTinChiTiet);
        }

        //Vòng lặp thêm chi tiết phiếu tiếp nhận sinh viên thực tập
        for($i = 0 ;$i<count($coSoVatChat) ;$i+=1){
            $LenhThem = "INSERT INTO chitietphieutiepnhansinhvienthuctapthucte VALUES('".$PhieuTiepNhanSinhVien['MSPXNTT']."','".$coSoVatChat[$i]."')";
            $ThucHienThem5 = TruyVan($LenhThem);
        }
        echo'<script async>
        alert("Thực hiện giao việc thành công");
        history.back();
        </script>';
    }else{
        echo'<script async>
        alert("Sinh viên này đã được giao việc rồi");
        history.back();
        </script>';
    }
    

?>