<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $uid = $_POST['UserID'];

    $lenhXoaTaiKhoan = "DELETE FROM taikhoan 
                        WHERE UserID = '$uid'";
    $lenhXoaThongTin = "DELETE FROM donvithuctap 
                        WHERE MaDVTT = '$uid'";

    TruyVan($lenhXoaTaiKhoan);
    TruyVan($lenhXoaThongTin);
    //Thoat
    echo "<script>
            alert('Thực hiện không phê duyệt thành công.');
            history.back();
        </script>";
?>