<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $mssv= $_GET['MSSV'];
    $mspxntt= $_GET['MSPXNTT'];
    $maDVTT= $_GET['ID'];

    echo '<p>'.$mssv.'</p>';
    echo '<p>'.$mspxntt.'</p>';
    echo '<p>'.$maDVTT.'</p>';

    $sql = "UPDATE phieutiepnhansinhvienthuctapthucte
            SET MaDVTT = NULL
            WHERE MSPXNTT ='$mspxntt' 
            AND MSSV = '$mssv'";
    TruyVan($sql);

    //Thoát
    echo "<script>
            alert('Thực hiện từ chối sinh viên đến thực tập thành công.');
            history.back();
        </script>";
?>
