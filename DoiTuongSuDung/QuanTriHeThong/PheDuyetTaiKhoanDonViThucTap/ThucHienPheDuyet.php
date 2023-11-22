<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $uid = $_POST['UserID'];
    $lenhCapNhat = "UPDATE taikhoan 
                    SET UserRole = '3'
                    WHERE UserID = '$uid'";
    TruyVan($lenhCapNhat);
    //Thoat
    echo "<script>
            alert('Cập nhật thành công');
            history.back();
        </script>";
?>
