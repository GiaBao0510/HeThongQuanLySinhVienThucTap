<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Biến lưu trữ
    $mssv = trim($_POST['MSSV']);
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
    
?>
