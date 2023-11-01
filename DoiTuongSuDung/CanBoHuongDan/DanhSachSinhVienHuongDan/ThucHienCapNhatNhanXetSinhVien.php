<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $mscb = trim($_GET['MSCB']);
    $msptdtt = ($_GET['MSPTDSV']);
    echo $mscb;
    echo $msptdtt;

    $NhanXet = $_POST['NhanXet'];
    $ID_CongViec = $_POST['IDcongViec'];
    $i=0;
    while($i < count($NhanXet)){
        //Nếu độ dài chuỗi > 0 thì cập nhật
        if(strlen($NhanXet[$i]) > 0){
            /*echo "<p>ID:".$ID_CongViec[$i]."</p>";
            echo "<p>".$NhanXet[$i]."</p>";*/
            $LenhThemNhanXet = "UPDATE chitietphieudanhgiavaphieutheodoi 
                                SET NhanXet = '$NhanXet[$i]' 
                                WHERE IDCongViec = '$ID_CongViec[$i]' AND MSPTDSV = '$msptdtt'";
            $truyvan = TruyVan($LenhThemNhanXet);
        }
        $i++;
    }
    echo"<script>
            alert('Cập nhật thành công');
            history.back();
        </script>";
?>
