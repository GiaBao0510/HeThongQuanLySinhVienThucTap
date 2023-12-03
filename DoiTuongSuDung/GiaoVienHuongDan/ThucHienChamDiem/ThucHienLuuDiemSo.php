<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhập
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }
    
    //Biến thông thường
    $mssv = trim($_GET['MSSV']);
    $msgv = $_SESSION['user'];
    $diemTru = 0;
    if(!empty($_POST['DiemTru'])){
        $diemTru =$_POST['DiemTru'];
    }
    //1.Kiểm tra xem sinh viên này có mặt trong phiếu chưa. 
    //1.1 Nếu chưa có thì tạo phiếu cho sinh viên này
    if(mssv_CheckPhieuDanhGiaBaoCao($mssv) < 1){
        //1.1.1 Kiểm tra xem có mấu tin nào trong phiếu báo cáo không. Nếu không thì mẫu tin mới
        $KTcoMauTinKhong = "SELECT COUNT(*) dem
        FROM phieudanhgiabaocaoketqua";
        $act_KTcoMauTinKhong = mysqli_fetch_array(TruyVan($KTcoMauTinKhong))['dem'];
        
        if($act_KTcoMauTinKhong < 1){
            $ThemMauTinMoi = "INSERT INTO phieudanhgiabaocaoketqua(MSPDGBCKQTT,MSGV,MSSV,DiemTru) 
                            VALUES('dgbc01','".$msgv."','".$mssv."','".$diemTru."')";
            $act_ThemMauTinMoi = TruyVan($ThemMauTinMoi);
        }
        //1.1.2 Tạo mẫu tin kế tiếp
        else{
            $LayMaMoi ="SELECT * 
                        FROM phieudanhgiabaocaoketqua
                        ORDER BY MSPDGBCKQTT DESC LIMIT 1";
            $act_LayMaMoi = mysqli_fetch_array(TruyVan($LayMaMoi))['MSPDGBCKQTT'];
            $maMoi = IncreaseIDIndex($act_LayMaMoi);

            $ThemMauKeTiep = "INSERT INTO phieudanhgiabaocaoketqua(MSPDGBCKQTT,MSGV,MSSV,DiemTru) 
                            VALUES('".$maMoi."','".$msgv."','".$mssv."','".$diemTru."')";
            $act_ThemMauKeTiep = TruyVan($ThemMauKeTiep);
        }

    }
    //2. SAu khi thêm mẫu tin mới cho sinh viên thì lấy MSPDGBC dựa trên mssv
    $MSPDGBCKQTT = trim(mssv_PhieuDanhGiaBaoKetQua($mssv)['MSPDGBCKQTT']);
    //Mảng
    $mangDiemSo = $_POST['DiemCham'];
    $IDnoiDung = $_POST['IDnddgbc'];
    $KTDieuKien = 1;
    // echo '<p>MSSV:'.$mssv.' </p>';
    // echo '<p>MSGV:'.$msgv.' </p>';
    // echo '<p>Đã có phiếu đánh giá báo cáo: '.mssv_CheckPhieuDanhGiaBaoCao($mssv).'</p>';
    // echo '<p>>>Số điểm đã chấm:</p>';
    
    //Kiểm tra điều kiện
    $i =0;
    while($i < count($mangDiemSo) ){
        if(empty($mangDiemSo[$i])){
            $KTDieuKien = 0;
        }
        $i+=1;
    }
    if($KTDieuKien == 0){
        //EXIT
        echo'<script>
            alert("Ghi nhận thất bại vì tìm thấy ô trống chưa điền.");
            history.back();
        </script>';
    }else{
        //Thực thi chấm điểm
        $i =0;
        while($i < count($mangDiemSo) ){
            $GhiNhanDiemSo= "INSERT INTO chitietdanhgiabaocao(MSPDGBCKQTT,IDndbc,DiemSo)
            VALUES('".$MSPDGBCKQTT."','".$IDnoiDung[$i]."','".$mangDiemSo[$i]."')";
            $act_GhiNhanDiemSo = TruyVan($GhiNhanDiemSo);
            $i+=1;
        }
        //EXIT
        echo'<script>
            alert("Ghi nhận thành công.");
            history.back();
        </script>';
    }
    

    
?>