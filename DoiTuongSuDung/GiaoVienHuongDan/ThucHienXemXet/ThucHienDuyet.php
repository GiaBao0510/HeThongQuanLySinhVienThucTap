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

    $mssv = trim($_GET['MSSV']);
    $msgv = $_SESSION['user'];

    //Kiểm tra mã sô giáo viên có trong phiếu này hay chưa nếu có rồi thì không cập nhật
    $kiemTra = "SELECT COUNT(*) dem FROM phieutheodoisinhvienthuctap td
                INNER JOIN phieugiaoviecsinhvienthuctap gv
                ON td.MSSV = gv.MSSV
                WHERE gv.MSGV = '$mssv'";
    $ThucHienKT = TruyVan($kiemTra); 
    if(mysqli_fetch_array($ThucHienKT)['dem'] < 1){ 
        $ThucHienCapNhatMSGV_TheoDoi = "UPDATE phieutheodoisinhvienthuctap SET MSGV = '$msgv' WHERE MSSV = '$mssv'";
        $ThucHienCapNhatMSGV_GiaoViec = "UPDATE phieugiaoviecsinhvienthuctap SET MSGV = '$msgv' WHERE MSSV = '$mssv'";
        $ThucHienCapNhat1 = TruyVan($ThucHienCapNhatMSGV_TheoDoi);
        $ThucHienCapNhat2 = TruyVan($ThucHienCapNhatMSGV_GiaoViec);
        echo '<script>
                alert("Duyệt thành công");
                window.location.href="../XemDanhSachSinhVienHuognDan.php?MSGV='.$msgv.'";
            </script>';
    }else{
        echo '<script>
                alert("Đã duyệt rồi");
                window.location.href="../XemDanhSachSinhVienHuognDan.php?MSGV='.$msgv.'";
            </script>';
    }
?>