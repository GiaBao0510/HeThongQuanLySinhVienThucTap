<?php
    //Khởi tạo session
    session_start();

    include('KetNoi.php');
    include('CacHamXuLy.php');
    // echo "<p> Tài khoản: ".$_POST['MaDangNhap']."</p>";
    // echo "<p> Mật khẩu: ".$_POST['MatKhauDangNhap']."</p>";

    $taiKhoan = trim($_POST['MaDangNhap']);
    $pw = trim($_POST['MatKhauDangNhap']);
    
    //Thực hiện tìm kiểm
    $lenhTim = "SELECT COUNT(*) AS thay FROM taikhoan WHERE UserID = '$taiKhoan' AND MatKhau = '$pw'" or die(mysqli_connect_error());
    $thucHien = mysqli_query($connect,$lenhTim) or die(mysqli_connect_error());
    $ketQua = intval(mysqli_fetch_array($thucHien)['thay']);
    $KhongThay = "";

    //Điều kiện nếu tìm thấy thì tìm kiếm xem thuộc về đối tượng nào
    if($ketQua > 0){
        $TimTaiKhoan = "SELECT * 
                FROM taikhoan 
                WHERE UserID = '$taiKhoan' AND MatKhau = '$pw'";
        $get_TaiKhoan = mysqli_fetch_array(TruyVan($TimTaiKhoan));
        //Lưu giá trị vào các biến session
        $_SESSION['user'] = $get_TaiKhoan['UserID'];
        $_SESSION['pw'] = $get_TaiKhoan['MatKhau'];
        $_SESSION['role'] = $get_TaiKhoan['UserRole'];

         //Lấy chữ cái đầu của tài khoản
        $chuCaiDau = LayChuoiChuCaiDau($taiKhoan);
        
        echo "<p> Chữ cái đầu:".$chuCaiDau."</p>";
        if($chuCaiDau === "B" && $get_TaiKhoan['UserRole'] == 1){
            header('Location: ../SinhVien/TrangChuSinhVien.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "cbhd" && $get_TaiKhoan['UserRole'] == 4){
            header('Location: ../CanBoHuongDan/TrangChuCanBoHuongDan.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "gvhd" && $get_TaiKhoan['UserRole'] == 2){
            header('Location: ../GiaoVienHuongDan/TrangChuGiaoVien.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "dvtt" && $get_TaiKhoan['UserRole'] == 3){
            header('Location: ../DonViThucTap/TrangChuDVTT.php?ID='.$taiKhoan.'');
        }elseif($chuCaiDau === "Admin" && $get_TaiKhoan['UserRole'] == 0){
            header('Location: ../QuanTriHeThong/TrangChu.php?ID='.$taiKhoan.'');
        }
    }else{
        echo "<p> Không tìm thấy</p>";
        $KhongThay = "KhongThayTaiKhoan";
        header('Location: ThongBaoKhongTimThay.php');
    }
?>