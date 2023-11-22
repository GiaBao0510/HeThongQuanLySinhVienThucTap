<?php
    include('./KetNoi.php');
    include('./CacHamXuLy.php');

    //Lấy mã đơn vị thực tập mới
    $lenhLayMaCuoi = "SELECT MaDVTT FROM donvithuctap ORDER BY MaDVTT DESC LIMIT 1";
    $maCuoi = mysqli_fetch_array(TruyVan($lenhLayMaCuoi))['MaDVTT'];
    $maMoi = IncreaseIDIndex($maCuoi);

    //Đầu vào
    $tenDonVi = $_POST['tenDonViThucTap'];
    $email = $_POST['Email_DVTT'];
    $sdt = $_POST['sdt_dvtt'];
    $pw = $_POST['pw_dvtt'];
    $diaChi = $_POST['diaChi_dvtt'];

    // echo '<p>Mã đơn vị thực tập: '.$maMoi.'</p>';
    // echo '<p>Tên : '.$tenDonVi.'</p>';
    // echo '<p>email: '.$email.'</p>';
    // echo '<p>sdt: '.$sdt.'</p>';
    // echo '<p>PW đơn vị thực tập: '.$pw.'</p>';
    // echo '<p>địa chỉ: '.$diaChi.'</p>';

    if(KiemTraTrungSDT_DVTT($sdt) > 0){
        echo "<script>
                alert('Số điện thoại đã tồn tại. Vui lòng nhập số điện thoại khác.');
                history.back();
            </script>";
    }elseif(KiemTraTrungEmail_DVTT($sdt) > 0){
        echo "<script>
                alert('Email đã tồn tại. Vui lòng nhập Email khác.');
                history.back();
            </script>";
    }else{
        //Thêm mẫu tin
        $themMauTin = "INSERT INTO donvithuctap VALUES('".$maMoi."','".$tenDonVi."','".$diaChi."','".$sdt."','".$email."')";
        $themTaiKhoan = "INSERT INTO taikhoan VALUES('".$maMoi."','".$pw."','5')";
        TruyVan($themMauTin);
        TruyVan($themTaiKhoan);

        echo "<script>
                alert('Đăng ký thành công. Vui lòng chờ admin phê duyệt.');
                history.back();
            </script>";
    }

?>