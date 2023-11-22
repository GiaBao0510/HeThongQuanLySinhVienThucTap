<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Mảng
    $mssv = $_POST['MSSV'];
    $mscb_new = $_POST['MSCBnew'];
    //Biến
    $mscb_old = $_GET['MSCB'];

    echo '<p>MSCB old: '.$mscb_old.'</p>';

    //Nếu cán bộ này đã có tên trong phiếu đánh giá kết quả thì chỉ thực hiện chuyển đổi thôi
    if(KT_CanBoDaChamDiemChoSinhVien($mscb_old) < 1){
        //Cập nhật trên các phiếu
        for($i=0 ;$i < count($mssv); $i++){
            echo '<p>MSSV: '.$mssv[$i].' -- MSCB mới: '.$mscb_new[$i].'</p>';
            //Cập nhật
            $up_PhieuGiaoViec = "UPDATE phieugiaoviecsinhvienthuctap
                    SET MSCB = '$mscb_new[$i]'
                    WHERE MSSV = '$mssv[$i]'";
            $up_PhieuTheoDoi = "UPDATE phieutheodoisinhvienthuctap
                            SET MSCB = '$mscb_new[$i]'
                            WHERE MSSV = '$mssv[$i]'";
            $up_phieutiepnhan= "UPDATE phieutiepnhansinhvienthuctapthucte
                            SET MSCB = '$mscb_new[$i]'
                            WHERE MSSV = '$mssv[$i]'";
            
            TruyVan($up_PhieuGiaoViec);
            TruyVan($up_PhieuTheoDoi);
            TruyVan($up_phieutiepnhan);
        }
        //Thực hiện xóa
        $Delete_CanBo = "DELETE FROM canbohuongdan WHERE MSCB = '$mscb_old' ";
        $Delete_taiKhoan = "DELETE FROM taikhoan WHERE UserID = '$mscb_old' ";
        TruyVan($Delete_CanBo);
        TruyVan($Delete_taiKhoan);
    }else{//Ngược lại thì chỉ thực hiện cập nhật
        //Cập nhật trên các phiếu
        for($i=0 ;$i < count($mssv); $i++){
            echo '<p>MSSV: '.$mssv[$i].' -- MSCB mới: '.$mscb_new[$i].'</p>';
            //Cập nhật
            $up_PhieuGiaoViec = "UPDATE phieugiaoviecsinhvienthuctap
                    SET MSCB = '$mscb_new[$i]'
                    WHERE MSSV = '$mssv[$i]'";
            $up_PhieuTheoDoi = "UPDATE phieutheodoisinhvienthuctap
                            SET MSCB = '$mscb_new[$i]'
                            WHERE MSSV = '$mssv[$i]'";
            $up_phieutiepnhan= "UPDATE phieutiepnhansinhvienthuctapthucte
                            SET MSCB = '$mscb_new[$i]'
                            WHERE MSSV = '$mssv[$i]'";
            
            TruyVan($up_PhieuGiaoViec);
            TruyVan($up_PhieuTheoDoi);
            TruyVan($up_phieutiepnhan);
        }

    }
    

    echo "<script>
            alert('Đã cập nhật và xóa Thành công.');
            window.history.go(-2);
        </script>";

?>