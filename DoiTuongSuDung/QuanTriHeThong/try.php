<?php
    //Thêm phần kết nối
    include('../TrangDungChung/KetNoi.php');
    //Câu lệnh lấy mã định danh cuối cùng trong bảng
    $TaoMaDinhDanh = "SELECT MaDVTT FROM donvithuctap ORDER BY MaDVTT DESC LIMIT 1;";
    $ketQuaThucThi = mysqli_query($connect,$TaoMaDinhDanh);
    $temp = mysqli_fetch_array($ketQuaThucThi);
    $kq = $temp['MaDVTT'];
    $kq = trim($kq);
    echo "<p>Lấy chữ số cuối chuỗi:". LayChuoiSoCuoiChuoi($kq) ."</p>";
    echo "<p>Tăng giá trị cuối chuỗi:". IndexIncrease(LayChuoiSoCuoiChuoi($kq)) ."</p>";
    echo "<p>Lấy chữ cái đầu chuỗi:". LayChuoiChuCaiDau($kq) ."</p>";
    echo "<p>Làm mới đinh danh:". IncreaseIDIndex($kq) ."</p>"; 
    
?>