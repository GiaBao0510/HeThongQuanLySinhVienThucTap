<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $mssv = $_POST['MSSV'];
    $msptntt = mssv_PhieuTiepNhanSinhVien($mssv)['MSPXNTT'];
    // echo $mssv;
    // echo $msptntt;

    $NhanXet = $_POST['NhanXet'];
    $ID_CongViec = $_POST['IDcongViec'];
    $i=0;
    $tuan = intval(1);
    while($i < count($NhanXet)){
        //Nếu độ dài chuỗi > 0 thì cập nhật
        if(strlen($NhanXet[$i]) > 0){
            /*echo "<p>ID:".$ID_CongViec[$i]."</p>";
            echo "<p>".$NhanXet[$i]."</p>";*/
            $LenhThemNhanXet = "UPDATE chitietphieudanhgiavaphieutheodoi 
                                SET NhanXet = '$NhanXet[$i]' 
                                WHERE tuan = '$tuan' AND MSPXNTT = '$msptntt'";
            $truyvan = TruyVan($LenhThemNhanXet);
        }
        $i++;
        $tuan++;
    }
    echo"<script>
            alert('Cập nhật thành công');
            history.back();
        </script>";
?>
