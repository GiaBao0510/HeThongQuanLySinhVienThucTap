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
    
    //Lấy các biến cần thiết
    $mssv = $_GET['MSSV'];
    $msgv = $_SESSION['user'];
    $PhieuXNSVTT = mssv_PhieuTiepNhanSinhVien($mssv);
    $PhieuTheoDoi = infPhieuTheoDoiSinhVien($mssv);
    $PhieuGiaoViec = infPhieuGiaoViecSinhVien($mssv);
    $MSPXNTT = trim($PhieuXNSVTT['MSPXNTT']);
    $LayCongViecDuaTrenMaPhieuXNSVTT = "SELECT * FROM chitietphieudanhgiavaphieutheodoi WHERE MSPXNTT = '$MSPXNTT'";
    echo $MSPXNTT;
    //Thực hiện lấy công việc - chưa xong
    $MangCongViec = TruyVan($LayCongViecDuaTrenMaPhieuXNSVTT);
    
    
    // //1.Thực hiện xóa mẫu tin tại bảng chi tiết phiếu theo dõi và giao việc dựa trên MSPXNTT
    $sql_XoaCV = "DELETE FROM chitietphieudanhgiavaphieutheodoi WHERE MSPXNTT = '$MSPXNTT'";
    $ThucHienXoa1 = TruyVan($sql_XoaCV);
   
    //2.Thực hiện xóa mẫu tin tại bảng công việc dựa trên ID_CongViec
    while($row = mysqli_fetch_array($MangCongViec)){
        $IDCV = trim($row["IDCongViec"]);
        echo $IDCV; 
        $sql_XoaCV1 = "DELETE congviec WHERE IDCongViec = '$IDCV'";
        $ThucHienXoa2 = TruyVan($sql_XoaCV1);
        
    }

    // //3.Thực hiện đặt lại MSGV tại bảng theo dõi và giao việc là NULL
    $sql_DatLaiBang_TD = "UPDATE phieutheodoisinhvienthuctap SET MSGV = NULL WHERE MSSV = '$mssv'";
    $sql_DatLaiBang_GV = "UPDATE phieugiaoviecsinhvienthuctap SET MSGV = NULL WHERE MSSV = '$mssv'";
    $ThucHienXoa3 = TruyVan($sql_DatLaiBang_TD);
    $ThucHienXoa4 = TruyVan($sql_DatLaiBang_GV);

    // //4. Thực hiện đặt lại MDVTT và MSCB tại bảng tiếp nhận sinh viên thực tập là NULL .Và đặt lại MSCB tại bảng theo dõi&giao việc là NULL
    $sql_DatNull_PXNSVTT = "UPDATE phieutiepnhansinhvienthuctapthucte 
                        SET MaDVTT = NULL, MSCB = NULL 
                        WHERE MSSV = '$mssv'";
    $sql_DatNull_PTD = "UPDATE phieutheodoisinhvienthuctap 
                        SET MSCB = NULL WHERE MSSV = '$mssv'";
    $sql_DatNull_PGV = "UPDATE phieugiaoviecsinhvienthuctap 
                        SET MSCB = NULL WHERE MSSV = '$mssv'";
    $ThucHienXoa6 = TruyVan($sql_DatNull_PXNSVTT);           
    $ThucHienXoa7 = TruyVan($sql_DatNull_PTD);           
    $ThucHienXoa8 = TruyVan($sql_DatNull_PGV);

    // //5. Xóa bảng chi tiết phiếu tiếp nhận thực tập dựa tên MSPXNTT
    $sql_XoaChiTietPTNSVTT = "DELETE FROM chitietphieutiepnhansinhvienthuctapthucte WHERE MSPXNTT = '$MSPXNTT'";
    $ThucHienXoa9 = TruyVan($sql_XoaChiTietPTNSVTT);

    // //Thoát
    echo"<script>
            alert('Yêu cầu không chấp nhận sinh viên được thực hiện.');
            history.back();
        </script>";
?>