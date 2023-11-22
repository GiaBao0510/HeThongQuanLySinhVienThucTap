<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration</title>
        <!--
            CSS
        -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/QuanTriHeThong/GiaoDienQuanTri.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--
            Java script
        -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../RangBuoc/TrangDungChung/DungChung.js"></script>
        <script src="../../RangBuoc/QuanTriHeThong/trangchu.js" async></script>
        <script src="../../RangBuoc/QuanTriHeThong/ChuyenQuaLai.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <!--
            PHP
        -->
        <?php
            include('../TrangDungChung/KetNoi.php');
            include('../TrangDungChung/CacHamXuLy.php');

            session_start();
            if(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
                include('../TrangDungChung/DangNhapThatBai.php');
            }
            //Kiểm tra năm bắt đầu thực tập có nhỏ hơn năm hiện tại hay không
            //Nếu nhỏ hơn thì tạo đợt thực tập mới
            $DotThucTapGanDay = "SELECT * ,year(ngayBatDau) nam 
                                FROM dotthuctap 
                                ORDER BY STT DESC LIMIT 1";
            $nam = mysqli_fetch_array(TruyVan($DotThucTapGanDay))['nam'];
            $STT = mysqli_fetch_array(TruyVan($DotThucTapGanDay))['STT'];
            $ngayBatDau = mysqli_fetch_array(TruyVan($DotThucTapGanDay))['ngayBatDau'];
            $ngayKetThuc = mysqli_fetch_array(TruyVan($DotThucTapGanDay))['ngayKetThuc'];

            //Niên khóa
            $nienKhoaGanDay = "SELECT * FROM nienkhoa ORDER BY MaKH DESC LIMIT 1";
            $soNienKhoa = mysqli_fetch_array(TruyVan($nienKhoaGanDay))['MaKH'];
            $soNienKhoa = IncreaseIDIndex($soNienKhoa); //Mã niên khóa mới
            $namBatDau = mysqli_fetch_array(TruyVan($nienKhoaGanDay))['TDBatDau'];
            $namKetThuc = mysqli_fetch_array(TruyVan($nienKhoaGanDay))['TDKetThuc'];
            //echo $nam;
            if($nam < date('Y')){
                $chenNienKhoa = "INSERT INTO nienkhoa VALUES('".$soNienKhoa."','".($namBatDau+1)."','".($namKetThuc+1)."')";
                $chenDotThucTap = "INSERT INTO `dotthuctap` (`STT`, `ngayBatDau`, `ngayKetThuc`, `MaKH`) VALUES
                    (".($STT+1).", '".date('Y')."-05-15', '".date('Y')."-07-08', '".$soNienKhoa."')";
                TruyVan($chenNienKhoa);
                TruyVan($chenDotThucTap);
            }
            
        ?>
        
    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                <a href="../TrangDungChung/ThucHienDangXuat.php" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuDVTT.php?ID=<?php echo $_GET['ID']; ?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="Khung_chinh">
                <!--
                    ### Thanh bên trái ###
                -->
                <div class="ThanhQuanLy">
                    <p class="BoTriMuc" id="ThongKe">Trang chủ</p>
                    <p class="BoTriMuc" id="SinhVien">Sinh viên</p>
                    <p class="BoTriMuc" id="GiaoVienHuongDan">Giáo viên hướng dẫn</p>
                    <p class="BoTriMuc" id="DonViThucTap">Đơn vị thực tập</p>
                    <p class="BoTriMuc" id="CanBoHuongDan">Cán bộ hướng dẫn</p>
                    <p class="BoTriMuc" id="TaiKhoan">Tài khoản</p>
                    <p class="BoTriMuc" id="DieuHuongSinhVienTT">Điều hướng sinh viên thực tập</p>
                    <p class="BoTriMuc" id="DuyetDonViThucTap">Duyệt tài khoản đơn vị thực tập</p>
                    <p class="BoTriMuc" id="BangDiemSo">Bảng điểm số sinh viên</p>
                    <p class ="BoTriMuc DanhSachMo"><i class="fa-solid fa-caret-up"></i> Phiếu</p>
                    <p class ="BoTriMuc DanhSachDong"><i class="fa-sharp fa-solid fa-caret-down"></i> Phiếu</p>
                    <div class="DanhSachPhieu">
                        <p class="BoTriMuc" id="PXNSVTT">Phiếu tiếp nhận sinh viên thực tập</p>
                        <p class="BoTriMuc" id="PTDSVTT">Phiếu theo dõi sinh viên thực tập</p>
                        <p class="BoTriMuc" id="PGVSVTT">Phiếu giao việc sinh viên thực tập</p>
                        <p class="BoTriMuc" id="PDGKQTT">Phiếu giao đánh giá kết quả thực tập</p>
                        <p class="BoTriMuc" id="PDGBCKQTT">Phiếu giao đánh giá báo cáo kết quả thực tập</p>
                    </div>
                    <!-- <p class="BoTriMuc" id="PtiepNhanSinhVienThucTap"> Phiếu tiếp nhận sinh viên thực tập</p> -->
                </div>
                <!--
                    ### Bản tin ###
                -->
                <div class="ThanhThongTin">
                <h1>Thống kê đợt thực tập <?php echo ngayThangNam_VN($ngayBatDau);?> - <?php echo ngayThangNam_VN($ngayKetThuc);?></h1>
                    <div class="ThongTinThongKe">
                        <div class="ChiTietThongKe">
                            
                            <div class="BangNhoXemThongKe">
                                <div class="ThongKeSoLuongChung DocMau1">
                                    <p>
                                        Số lượng sinh viên:
                                        <?php echo SoLuongSinhVien() ;?>
                                    </p>
                                </div>
                                <div class="ThongKeSoLuongChung DocMau2">
                                    <p>
                                        Số lượng giảng viên hướng dẫn:
                                        <?php echo SoLuongGiangVien() ;?>
                                    </p>
                                </div>
                                <div class="ThongKeSoLuongChung DocMau3">
                                    <p>
                                        Số lượng lớp học:
                                        <?php echo SoLuongLopHoc() ;?>
                                    </p>
                                </div>
                                <div class="ThongKeSoLuongChung DocMau4">
                                    <p>
                                        Số lượng đơn vị thực tập:
                                        <?php echo SoLuongDonViThucTap() ;?>
                                    </p>
                                </div>
                            </div> 
                            <div class="BangNhoXemThongKe">
                                <div class="ThongKeSoLuongChung DocMau5">
                                    <p>
                                        Số lượng cán bộ hướng dẫn:
                                        <?php echo SoLuongCanBoHuongDan() ;?>
                                    </p>
                                </div>
                                <div class="ThongKeSoLuongChung DocMau6">
                                    <p>
                                        Số lượng tài khoản:
                                        <?php echo SoLuongTaiKhoan() ;?>
                                    </p>
                                </div>
                                <div class="ThongKeSoLuongChung DocMau8">
                                    <p>
                                        Số lượng sinh viên đậu trong kỳ thực tập 2023:
                                    </p>
                                </div>
                                <div class="ThongKeSoLuongChung DocMau7">
                                    <p>
                                        Số lượng sinh viên rớt:
                                    </p>
                                </div>
                            </div> 
                        </div>
                        
                    </div>
                    <!--Sinhvien-->
                    <div class="ThongTinSinhVien">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/SinhVien/BangThongTinSinhVien.php');
                            ?>
                            <button class="NutChuyenTrangThemMauTin NutDangNhap" >Thêm tài khoản Sinh viên</button>
                        </div>
                        <div class="BangThemThongTin">
                            <button class="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/SinhVien/ThemTaiKhoanSinhVien.php');
                            ?>
                        </div>
                    </div>
                    <!--Giao vien-->
                    <div class="ThongTinGiaoVienHuongDan">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/GiaoVienHuongDan/BangThongTinGiaoVien.php');
                            ?>
                            <button class="NutChuyenTrangThemMauTin NutDangNhap">Thêm Giáo viên hướng dẫn</button>
                        </div>
                        <div class="BangThemThongTin">
                            <button class="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/GiaoVienHuongDan/ThemTaiKhoanGVHD.php');
                            ?>
                        </div>
                    </div>
                    <!--Đơn vị thực tập-->
                    <div class="ThongTinDonViThucTap">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/DonViThucTap/BangThongTinDonVi.php');
                            ?>
                            <button class="NutChuyenTrangThemMauTin NutDangNhap">Thêm đơn vị thực tập</button>
                        </div>
                        <div class="BangThemThongTin">
                            <button class="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/DonViThucTap/ThemDonViThucTap.php');
                            ?>
                        </div>
                    </div>
                    <!--Cán bộ-->
                    <div class="ThongTinCanBoHuongDan">
                       
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/CanBoHuongDan/LietKeCanBo.php');
                            ?>
                            <button class="NutChuyenTrangThemMauTin NutDangNhap">Thêm đơn vị thực tập</button>
                        </div>
                        <div class="BangThemThongTin">
                            <button class="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/CanBoHuongDan/ThemTaiKhoanCBHD.php');
                            ?>
                        </div>
                    </div>
                    <!--Tài khoản-->
                    <div class="ThongTinTaiKhoan">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/TaiKhoan/LietKeTaiKhoan.php');
                            ?>
                            <button class="NutChuyenTrangThemMauTin NutDangNhap">Tạo tài khoản</button>
                        </div>
                        <div class="BangThemThongTin">
                            <button class="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/TaiKhoan/ThemTaiKhoanTK.php');
                            ?>
                        </div>
                    </div>
                    <!--Điều hướng sinh viên-->
                    <div class="ThongTinDieuHuongSinhVien">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/DieuHuongSinhVienChoGiaoVien/SoLuongSinhVienDuocGiangVienHuongDan.php');
                            ?>
                        </div>
                    </div>
                    <!--Bảng điểm sinh viên-->
                    <div class="BangDiemSoSinhVien">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/BangDiemSinhVienTheoDotThucTap/BangDiemSinhVien.php');
                            ?>
                        </div>
                    </div>

                    <!--Duyệt tài khoản đơn vị thực tập-->
                    <div class="DSchoPheDuyetDonViThucTap">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/PheDuyetTaiKhoanDonViThucTap/DSdvtt_choDuyet.php');
                            ?>
                        </div>
                    </div>

                    <!--Các phiếu xác nhận thực tập-->
                    <div class="ThongTinPhieuTiepNhan">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/PhieuTiepNhanThucTap/DSphieuTiepNhan.php');
                            ?>
                        </div>
                    </div>

                    <!--Các phiếu theo dõi thực tập-->
                    <div class="ThongTinPhieuTheoDoi">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/PhieuTiepNhanThucTap/DSphieuTheoDoi.php');
                            ?>
                        </div>
                    </div>

                    <!--Các phiếu giao việc thực tập-->
                    <div class="ThongTinPhieuGiaoViec">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/PhieuTiepNhanThucTap/DSphieuGiaoViec.php');
                            ?>
                        </div>
                    </div>

                    <!--Các phiếu đánh giá kết quả  thực tập-->
                    <div class="ThongTinPhieuDanhGiaKetQua">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/PhieuTiepNhanThucTap/DSphieuKetQuaTT.php');
                            ?>
                        </div>
                    </div>

                    <!-- phiếu đánh giá báo cáo kết quả  thực tậpp-->
                    <div class="ThongTinPhieuDanhGiaBaoCaoKetQua">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/PhieuTiepNhanThucTap/DSphieuDanhGiaBaoCaoKetQuaTT.php');
                            ?>
                        </div>
                    </div>
                    <!--Báo cáo danh sách sinh viên-->
                    
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
<a href="../../DoiTuongSuDung/DonViThucTap/QuanLyCanBoHuongDan/ThucHienXoaCanBo.php"></a>