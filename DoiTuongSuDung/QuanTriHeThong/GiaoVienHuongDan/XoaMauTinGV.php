<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhâp
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }
    
    $msgv = $_GET['MSGV'];
    $dk1 = KT_GiangVienDaChamDiemChoSinhVien($msgv);
    $dk2 = MSGV_PhieuGiaoViecVaPhieuTheoDoi($msgv);
    //Nếu giảng viên hướng dẫn đã chấm điểm thì không thể xóa
    if($dk1 > 0){
        echo "<script>
                alert('Không thể xóa tài khoản giảng viên. Vì giảng viên này đã chấm điểm cho sinh viên.');
                history.back();
            </script>";
    }
    //Nếu giảng viên hướng dẫn đang hướng dẫn thì không thể xóa
    elseif($dk2 > 0){
        echo "<script>
                alert('Không thể xóa tài khoản giảng viên. Vì giảng viên này đang hướng dẫn sinh viên.');
                history.back();
            </script>";
    }else{
        $lenhXoa1 = "DELETE FROM giangvienhuongdan WHERE MSGV = '$msgv'";
        $lenhXoa2 = "DELETE FROM taikhoan WHERE UserID = '$msgv'";
        TruyVan($lenhXoa1);
        TruyVan($lenhXoa2);
        echo "<script>
                alert('Xóa thành công');
                history.back();
            </script>";
    }
?>