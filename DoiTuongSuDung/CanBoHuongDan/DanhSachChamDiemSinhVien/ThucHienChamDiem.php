<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $mssv = trim($_GET['MSSV']);
    $mscb = trim($_GET['MSCB']);
    $nhanXetSV =  trim($_POST['NhanXetVeSinhVien']); 
    $YKienDongGop = trim($_POST['DongGopYKien']);

    //Mảng
    $DiemSo = $_POST['DiemCham'];
    $DanhGiaCTDT = $_POST['DanhGia'];
    $IDNoiDungKQ = $_POST['IDnddgkq'];

    //echo "<p>Nhận xét về sinh viên: ".$nhanXetSV."</p>";
    //echo"<p>Đánh giá về chương chương trình đào tạo</p>";


    
    //Tìm kiếm phiếu đánh giá kết quả thực tập thông qua mssv và mscb
    $TT_PhieuDGKQ = mscb_mssv_PhieuDanhGiaKetQuaThucTap($mssv,$mscb);
    $MSPDGKQTT = trim($TT_PhieuDGKQ['MSPDGKQTT']);
    //echo "<p>Mã phiếu: ".$MSPDGKQTT."</p>";
    //1. Lưu nhận xét
    $saveNhanXet = "UPDATE phieudanhgiaketquathuctap 
                    SET NhanXet = '$nhanXetSV' 
                    WHERE MSSV = '$mssv'";
    $actNhanXet = TruyVan($saveNhanXet);

    //2.Nếu phần đóng góp ý kiến không rỗng thì lưu
    if(strlen($YKienDongGop) > 0){
        $saveDongGop = "UPDATE phieudanhgiaketquathuctap 
                    SET DongGop = '$YKienDongGop' 
                    WHERE MSSV = '$mssv'";
        $actDongGop = TruyVan($saveDongGop);
    }

    //3. Lưu điểm dựa trên nội dung đánh giá
    //echo "<p>Lưu điểm nội dung đánh giá</p>";
    $i=0;
    while($i< count($DiemSo)){
        $saveDiemSo = "INSERT INTO chitietphieudanhgiaketquathuctap(MSPDGKQTT,ID,Diem)
                        VALUES('".$MSPDGKQTT."','".$IDNoiDungKQ[$i]."','".$DiemSo[$i]."')";
        $actDiemSo = TruyVan($saveDiemSo);
        //echo "<p>".$IDNoiDungKQ[$i]." - ".$DiemSo[$i]."</p>";
        $i++;
    }

    //4.Lưu Chi tiết mức độ chương trình đào tạo
    //echo "<p>Lưu đánh giá chương trình đào tạo</p>";
    $i = 0;
    while($i < count($DanhGiaCTDT)){
        $saveDanhGiaCTDT = "INSERT INTO chitietmucdochuongtrinhdaotao(MSPDGKQTT,IDMucDoCT)
                            VALUES('".$MSPDGKQTT."','".$DanhGiaCTDT[$i]."')";
        $actDanhGiaCTDT = TruyVan($saveDanhGiaCTDT);
        //echo "<p>".$DanhGiaCTDT[$i]."</p>";
        $i++;
    }

    echo"<script>
            alert('Lưu thành công.');
            history.back();
        </script>";
?>
