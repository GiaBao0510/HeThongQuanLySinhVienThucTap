<?php
    include('KetNoi.php');
    include('CacHamXuLy.php');
    echo "<p> Tài khoản: ".$_POST['MaDangNhap']."</p>";
    echo "<p> Mật khẩu: ".$_POST['MatKhauDangNhap']."</p>";

    $taiKhoan = trim($_POST['MaDangNhap']);
    $pw = trim($_POST['MatKhauDangNhap']);
    
    //Thực hiện tìm kiểm
    $lenhTim = "SELECT COUNT(*) AS thay FROM taikhoan WHERE UserID = '$taiKhoan' AND MatKhau = '$pw'" or die(mysqli_connect_error());
    $thucHien = mysqli_query($connect,$lenhTim) or die(mysqli_connect_error());
    $ketQua = intval(mysqli_fetch_array($thucHien)['thay']);
    $KhongThay = "";

    //Điều kiện nếu tìm thấy thì tìm kiếm xem thuộc về đối tượng nào
    if($ketQua > 0){
        //Lấy chữ cái đầu của tài khoản
        $chuCaiDau = LayChuoiChuCaiDau($taiKhoan);
        echo "<p> Chữ cái đầu:".$chuCaiDau."</p>";
        if($chuCaiDau === "B"){
            header('Location: ../SinhVien/TrangChuSinhVien.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "cbhd"){
            header('Location: ../CanBoHuongDan/TrangChuCanBoHuongDan.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "gvhd"){
            header('Location: ../GiaoVienHuongDan/TrangChuGiaoVien.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "dvtt"){
            header('Location: ../DonViThucTap/TrangChuDVTT.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "Admin"){
            header('Location: ../QuanTriHeThong/TrangChu.php?ID='.$taiKhoan.'');
        }
    }else{
        echo "<p> Không tìm thấy</p>";
        $KhongThay = "KhongThayTaiKhoan";
        header('Location: ThongBaoKhongTimThay.php');
    }
?>