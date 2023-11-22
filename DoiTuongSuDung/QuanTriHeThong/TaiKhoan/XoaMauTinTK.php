<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $userID = $_GET['UserID'];
    
    $sql = "DELETE FROM taikhoan WHERE UserID = '$userID'";
    TruyVan($sql);

    //Thoát
    echo"<script>
            alert('Xóa thành công.');
            history.back();
        </script>";
?>