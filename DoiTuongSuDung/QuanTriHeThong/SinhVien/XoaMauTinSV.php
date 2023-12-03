<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhâp
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }
    
    /*
        - Đk: không được xóa thông tin sinh viên
            Nếu sinh viên đã được chấm điểm thực tập hoặc 
        được đơn vị thực tập chấp nhận cho thực tập hoặc 
        được giáo viên chấp nhận thực tập, thì không được xóa.

            Ngược lại thì xóa.
    */
    $mssv = $_GET['MSSV'];
    
    $dieuKien1 = checkSinhVienDaDuoc_GiangVienNhanThucTap($mssv);
    $dieuKien2 = checkSinhVienDaDuoc_CanBoChamDiem($mssv);
    $dieuKien3 = checkSinhVienDaDuoc_GiangVienChamDiem($mssv);
    $dieuKien4 = SinhVienCo_PhieuDanhGiaKetQuaTT($mssv);

    if($dieuKien1 > 0){
        echo '<script>
                alert("Sinh viên này đã được giáo viên chấp nhận thực tập. Nên không thể xóa");
                history.back();
            </script>';
    }else if($dieuKien2 > 0){
        echo '<script>
                alert("Sinh viên này đã được cán bộ chấm điểm thực tập. Nên không thể xóa");
                history.back();
            </script>';
    }else if($dieuKien3 > 0){
        echo '<script>
                alert("Sinh viên này đã được giảng viên chấm điểm thực tập. Nên không thể xóa");
                history.back();
            </script>';
    }else if($dieuKien4 > 0){
        echo '<script>
                alert("Sinh viên này đã được ghi vài phiếu đánh giá kết quả thực tập. Nên không thể xóa");
                history.back();
            </script>';
    }else{
        $sql = "DELETE FROM sinhvien WHERE MSSV = '$mssv'";
        TruyVan($sql);
        echo '<script>
                alert("Xóa thành công");
                history.back();
            </script>';
    }
?>