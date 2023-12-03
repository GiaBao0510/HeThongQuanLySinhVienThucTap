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
    }else{
        //Biến lưu trữ
        $mssv = $_POST['MSSV'];
        //Xác thực xem hợp lệ hay không
        if($_SESSION['user'] !== $mssv){
            include('../../TrangDungChung/DangNhapThatBai.php');
        }else{
            $TT_PhieuTNTT = mssv_PhieuTiepNhanSinhVien($mssv);
            $msgv = $TT_PhieuTNTT['MSGV'];
            //Kiểm tra xem sinh viên đã nộp giấy hay chưa nếu chưa thì thực hiện
            if(SoLuongPhieuTieGiaoViec_SV_GV($mssv,$msgv) < 1){
                //Thực hiện cập nhật trên phiếu giao việc sinh viên.
                $sql = "UPDATE phieugiaoviecsinhvienthuctap SET MSGV = '$msgv' WHERE MSSV = '$mssv'";
                $ThucHien = TruyVan($sql);
                echo"<script>
                    alert('Nộp thành công chờ ngày giáo viên hướng dẫn xem xét.');
                    history.back();
                </script>";
            }else{
                echo"<script>
                    alert('Đã nộp phiếu tiếp nhận thực tập rồi. Vui lòng chờ giáo viên xem xét.');
                    history.back();
                </script>";
            }
        }
    }
?>
