<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ sinh viên thực tập</title>
        <link rel="shortcut icon" href="../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <style>
            .NutDangNhap{
                display: block;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <form action="../TrangDungChung/ThucHienDangXuat.php" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="taikhoan" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" name="matkhau" value="<?php echo $_SESSION['pw'];?>">
                        <input type="hidden" name="vaitro" value="<?php echo $_SESSION['role'];?>">
                        <input type="hidden" name="loithoat" value="../TrangDungChung/index.php">
                        <button type="submit" class="NutThoat">
                            <i class="fa-solid fa-door-open"></i>Thoát
                        </button>
                    </form>
                    <a href="./TrangChuSinhVien.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="KhungChot">
                <div class="KhungCaNhan">
                    <?php 
                        include('../TrangDungChung/KetNoi.php');
                        include('../TrangDungChung/CacHamXuLy.php');
                        //Kiểm tra đăng nhập
                        if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
                            include('../TrangDungChung/DangNhapThatBai.php');
                        }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
                            include('../TrangDungChung/DangNhapThatBai.php');
                        }
                        //Lấy Mã số sih viên để hiển thị thông tin
                        $maSo = $_SESSION['user'];
                        
                        
                        $taiKhoan = mysqli_fetch_array(infTaiKhoan($maSo)); 
                        //Thực hiện lấy thông tin
                        $layThongTin = "SELECT *
                                        FROM sinhvien sv INNER JOIN lop ON sv.MaLop = lop.MaLop
                                                        INNER JOIN nganh N ON N.MaNganh = lop.MaNganh
                                                        INNER JOIN taikhoan tk ON tk.UserID =  sv.MSSV
                                        WHERE MSSV = '$maSo '";
                        $ThucHien = mysqli_query($connect,$layThongTin) or die(mysqli_connect_error());
                        $ketqua = mysqli_fetch_array($ThucHien) ;
                
                        /*
                            Chỉ có ở sinh viên
                        */
                        //Biến hỗ trợ
                        $STT = ThongTinDotThucTap(date('Y'))['STT'];
                        $phieuTiepNhanTT = mssv_PhieuTiepNhanSinhVien($maSo);
                        //1.Kiểm tra xem mã số sinh viên có trong bảng giấy giới thiệu không.nếu không có thì chỉ thêm vài biễu mẫu
                        $kiemTraMauTin = "SELECT COUNT(*) Co
                                            FROM giaygioithieu 
                                            WHERE MSSV = '$maSo'";
                        $ThucHien2 = mysqli_query($connect,$kiemTraMauTin) or die(mysqli_connect_error());
                        $Co = intval(mysqli_fetch_array($ThucHien2)['Co']) ;
                        if($Co == 0){

                            //Kiểm tra xem có bảng giấy giới thiệu có mẫu tin nào không. Nếu không thì tạo ID mẫu tin giấy giới thiệu
                            $DemSoLuong = "SELECT COUNT(*) dem FROM giaygioithieu";
                            $ThucHien3 = mysqli_query($connect,$DemSoLuong) or die(mysqli_connect_error());
                            $Dem = intval(mysqli_fetch_array($ThucHien3)['dem']);

                            if($Dem < 1){
                                $ThemMauTinDau = "INSERT INTO giaygioithieu VALUES('cv01','hv04','".$ketqua['MaNganh']."','".$ketqua['MSSV']."','','','','')";
                                $ThucHIenThemMauTinDau = mysqli_query($connect,$ThemMauTinDau) or die(mysqli_connect_error());
                            }else{
                                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                                $IDCV_Cuoi = "SELECT * FROM giaygioithieu ORDER BY IDCV DESC LIMIT 1";
                                $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                                $ketQua1 = mysqli_fetch_array($ThucHienLay);
                                $newID = IncreaseIDIndex($ketQua1['IDCV']);
                                $ThemMauTinCuoi = "INSERT INTO giaygioithieu VALUES('".$newID."','hv04','".$ketqua['MaNganh']."','".$ketqua['MSSV']."','','','','')";
                                $ThucHIenThemMauTinCuoi = mysqli_query($connect,$ThemMauTinCuoi) or die(mysqli_connect_error());
                            }
                        }

                        //2.Kiểm tra xem mã số sinh viên có trong bảng phiếu theo dõi và giao việc không.nếu không có thì chỉ thêm vài biễu mẫu
                        $kiemTraMauTinTDvGV = "SELECT COUNT(*) Co
                                        FROM phieutheodoisinhvienthuctap td INNER JOIN phieugiaoviecsinhvienthuctap gv ON td.MSSV = gv.MSSV
                                        WHERE td.MSSV = '$maSo'";
                        $ThucHienKTgvVaTD = mysqli_query($connect,$kiemTraMauTinTDvGV) or die(mysqli_connect_error());
                        $Co = intval(mysqli_fetch_array($ThucHienKTgvVaTD)['Co']) ;
                        if($Co == 0){

                            //Kiểm tra xem bảng theo dõi có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
                            $DemSoLuongTD = "SELECT COUNT(*) dem FROM phieutheodoisinhvienthuctap";
                            $ThucHien3 = mysqli_query($connect,$DemSoLuongTD) or die(mysqli_connect_error());
                            $DemTD = intval(mysqli_fetch_array($ThucHien3)['dem']);

                            if($DemTD < 1){
                                $ThemMauTinDau = "INSERT INTO phieutheodoisinhvienthuctap(MSPTDSV,MSSV,STT) VALUES('ptd01','".$maSo."','".$STT."')";
                                $ThucHIenThemMauTinDau = mysqli_query($connect,$ThemMauTinDau) or die(mysqli_connect_error());
                            }else{
                                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                                $IDCV_Cuoi = "SELECT * FROM phieutheodoisinhvienthuctap ORDER BY MSPTDSV DESC LIMIT 1";
                                $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                                $ketQua1 = mysqli_fetch_array($ThucHienLay);
                                $newID = IncreaseIDIndex($ketQua1['MSPTDSV']);
                                $ThemMauTinCuoi = "INSERT INTO phieutheodoisinhvienthuctap(MSPTDSV,MSSV,STT) VALUES('".$newID."','".$maSo."','".$STT."')";
                                $ThucHIenThemMauTinCuoi = mysqli_query($connect,$ThemMauTinCuoi) or die(mysqli_connect_error());
                            }

                            //Kiểm tra xem bảng giao việc có mẫu tin nào không. Nếu không thì tạo ID mẫu tin bảng theo dõi và bảng giao việc
                            $DemSoLuongGV = "SELECT COUNT(*) dem FROM phieugiaoviecsinhvienthuctap";
                            $ThucHien4 = mysqli_query($connect,$DemSoLuongGV) or die(mysqli_connect_error());
                            $DemGV = intval(mysqli_fetch_array($ThucHien4)['dem']);

                            if($DemGV < 1){
                                $ThemMauTinDau = "INSERT INTO phieugiaoviecsinhvienthuctap(MSPGVSV,MSSV,STT) VALUES('ptd01','".$maSo."','".$STT."')";
                                $ThucHIenThemMauTinDau = mysqli_query($connect,$ThemMauTinDau) or die(mysqli_connect_error());
                            }else{
                                //Ngược lại thì ta lấy Chữ cái đầu và tăng số cuối chuỗi
                                $IDCV_Cuoi = "SELECT * FROM phieugiaoviecsinhvienthuctap ORDER BY MSPGVSV DESC LIMIT 1";
                                $ThucHienLay = mysqli_query($connect,$IDCV_Cuoi) or die(mysqli_connect_error());
                                $ketQua1 = mysqli_fetch_array($ThucHienLay);
                                $newID = IncreaseIDIndex($ketQua1['MSPGVSV']);
                                $ThemMauTinCuoi = "INSERT INTO phieugiaoviecsinhvienthuctap(MSPGVSV,MSSV,STT) VALUES('".$newID."','".$maSo."','".$STT."')";
                                $ThucHIenThemMauTinCuoi = mysqli_query($connect,$ThemMauTinCuoi) or die(mysqli_connect_error());
                            }

                        }
                        
                        //Thực hiện lấy thông tin dựa trên mã số sinh viên trong giấy giới thiệu
                        $CV_SV = "SELECT *
                                FROM giaygioithieu gt INNER JOIN trinhdohocvan td ON gt.IDHocVan = td.IDHocVan
                                WHERE gt.MSSV = '$maSo'";
                        $TimThongTinCV = mysqli_query($connect,$CV_SV)  or die(mysqli_connect_error());
                        $kqCV = mysqli_fetch_array($TimThongTinCV);
                        
                        //Thực hiện tạo phiếu tiếp nhận sinh viên thực tập
                        TaoPhieuTiepNhanSinhVien($maSo);

                        //Hiển thị
                        echo '<form name="HoSoSinhVien" action="HoSo.php" class="BieuMauHoSo" action="HoSo.php" method="post" enctype="application/x-www-form-urlencoded">
                                <table class="BangHoSo">
                                    <tr>
                                        <td colspan="2" class="CotTieuDe">
                                        <p class="TieuDeHoSo">HỒ SƠ SINH VIÊN</p> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="CotTieuDe">
                                            <div>Ảnh</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Họ tên</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['HoTen'].'</p>
                                            <input name="HoTen" type="hidden" value="'.$ketqua['HoTen'].'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">MSSV</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['MSSV'].'</p>
                                            <input name="MSSV" type="hidden" value="'.$ketqua['MSSV'].'">
                                            <input name="MatKhau" type="hidden" value="'.$ketqua['MatKhau'].'"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Mã lớp</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['MaLop'].'</p>
                                            <input name="MaLop" type="hidden" value="'.$ketqua['MaLop'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Ngành</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['TenNganh'].'</p>
                                            <input name="MaNganh" type="hidden" value="'.$ketqua['MaNganh'].'">
                                            <input name="TenNganh" type="hidden" value="'.$ketqua['TenNganh'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Giới tính:</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['GioiTinh'].'</p>
                                            <input name="GioiTinh" type="hidden" value="'.$ketqua['GioiTinh'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Ngày sinh</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['NgaySinh'].'</p>
                                            <input name="NgaySinh" type="hidden" value="'.$ketqua['NgaySinh'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Số điện thoại</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['SDT'].'</p>
                                            <input name="SDT" type="hidden" value="'.$ketqua['SDT'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Căn cước</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['CCCD'].'</p>
                                            <input name="CCCD" type="hidden" value="'.$ketqua['CCCD'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Email</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['Email'].'</p>
                                            <input name="Email" type="hidden" value="'.$ketqua['Email'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Địa chỉ</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['DiaChi'].'</p>
                                            <input name="DiaChi" type="hidden" value="'.$ketqua['DiaChi'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Trình độ</p>
                                        </td>
                                        <td>
                                            <p>'.$kqCV['TenHocVan'].'</p>
                                            <input name="IDHocVan" type="hidden" value="'.$kqCV['IDHocVan'].'">
                                            <input name="TenHocVan" type="hidden" value="'.$kqCV['TenHocVan'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Kinh nghiệm</p>
                                        </td>
                                        <td>
                                            <p>'.$kqCV['KinhNghiem'].'</p>
                                            <input name="KinhNghiem" type="hidden" value="'.$kqCV['KinhNghiem'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Chứng chỉ</p>
                                        </td>
                                        <td>
                                            <p>'.$kqCV['ChungChi'].'</p>
                                            <input name="ChungChi" type="hidden" value="'.$kqCV['ChungChi'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Kỹ năng</p>

                                        </td>
                                        <td>
                                            <p>'.$kqCV['KyNang'].'</p>
                                            <input name="KyNang" type="hidden" value="'.$kqCV['KyNang'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Ngoại ngữ</p>
                                        </td>
                                        <td>
                                            <p>'.$kqCV['NgoaiNgu'].'</p>
                                            <input name="NgoaiNgu" type="hidden" value="'.$kqCV['NgoaiNgu'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="NopCV/GiayGioiThieu.php?ID='.$maSo.'" class="NutDangNhap" >Xem giấy giới thiệu</a>
                                        </td>
                                        <td>
                                            <button type="submit" class="NutDangNhap"> Chỉnh sửa hồ sơ</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>';
                    ?>
                    
                </div>
                <div class="KhungChonChucNang"> 
                    <table class="BangChucNang">
                        <tr>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="NopCV/ChuanBiNopCV.php">
                                    <div>
                                        <img src="../../Image/SinhVien/submission.png" class="AnhChucNang"/>
                                    </div>
                                    <p>Nộp CV cá nhân đến đơn vị thực tập</p>
                                </a>
                            </td>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="NopPhieuTiepNhanChoGVHD/ChuanBiNopPhieu.php?ID=<?php echo $_SESSION['user'];?>&Role=1">
                                    <div>
                                        <img src="../../Image/SinhVien/transfer.png" alt="" class="AnhChucNang">
                                    </div>
                                    <p>Nộp phiếu tiếp nhận thực tập đến <br> giảng viên hướng dẫn phê duyệt</p>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="NopBaoCaoThucTap/ChuanBiNopBaoCao.php">
                                    <div>
                                        <img src="../../Image/SinhVien/upload.png" alt="" class="AnhChucNang">
                                    </div>
                                    <p>Nộp báo cáo kết quả thực tập</p>
                                </a>
                            </td>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="KetQua/BangKetQua.php">
                                    <div>
                                        <img src="../../Image/SinhVien/score.png" alt="" class="AnhChucNang">
                                    </div>
                                    <p>Kết quả thực tập</p>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>
        <footer>
            <div class="ChanBenPhai">
                <p>&copy; <span id="NamHienTai"></span></p>
                <p>
                    Khoa Khoa Học Máy Tính - Trường Công Nghệ Thông Tin & Truyền Thông, Đại Học Cần Thơ 
                </p>                
            </div>
            <div class="ChanBenTrai">
                <div class="ChanTrai1">
                    <p>Địa chỉ: phường Xuân Khánh,đường 3/2, Quận Ninh Kiều, TP Cần Thơ</p>
                    <span>&phone; : </span>
                </div>
                <div class="ChanTrai2">
                    <p>Email: abcd123@gmail.com</p>
                    <p>Website: </p>
                </div>
            </div>
        </footer>
    </body> 
</html>