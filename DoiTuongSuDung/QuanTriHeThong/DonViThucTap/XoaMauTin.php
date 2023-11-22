<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    $mdvtt = $_GET['MaDVTT'];

    $dk1 = SoLuongSinhVien_DonViThucTap($mdvtt);
    $dk2 = KiemTraCanBoTaiDonViThucTapDaChamDiemHayChua($mdvtt);
    //1. Nếu Số lượng sinh viên hướng dẫn > 0 thì không được xóa tài khoản này
    if($dk1 > 0){
        echo "<script>
                alert('Không thể xóa tài khoản đơn vị thực tập .Vì sinh viên thực tập tại nơi này > 0.');
                history.back();
            </script>";
    }else if($dk1){
        echo "<script>
                alert('Không thể xóa tài khoản đơn vị thực tập .Vì Cán bộ đơn vị thực tập này đã chấm điểm cho sinh viên rồi.');
                history.back();
            </script>";
    }else{
        $lenhXoa1 = "DELETE FROM donvithuctap WHERE MaDVTT= '$mdvtt'";
        $lenhXoa2 = "DELETE FROM taikhoan WHERE UserID = '$mdvtt'";
        TruyVan($lenhXoa1);
        TruyVan($lenhXoa2);
        echo "<script>
                alert('Xóa thành công');
                history.back();
            </script>";
    } 
     
?>