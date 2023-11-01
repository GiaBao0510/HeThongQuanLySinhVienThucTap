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
        <!--
            Java script
        -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../RangBuoc/TrangDungChung/DungChung.js"></script>
        <script src="../../RangBuoc/QuanTriHeThong/trangchu.js" async></script>
        
        
    </head>
    <body>
        <header></header>
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
                    <p class="BoTriMuc">Báo cáo</p>
                    <div class="DanhSachBaoCao">
                        <p class="BoTriMuc_ds" id="bs_dssv">Báo cáo danh sách sinh viên theo đợt thực tập</p>
                        <p class="BoTriMuc_ds" id="bs_dsgv">Báo cáo danh sách giảng viên theo đợt thực tập</p>
                        <p class="BoTriMuc_ds" id="bs_dsdetai">Báo cáo danh sách đề tài theo đợt thực tập</p>
                        <p class="BoTriMuc_ds" id="bs_diemso">Báo cáo điểm số theo đợt thực tập</p>
                        <p class="BoTriMuc_ds" id="bs_sinhvienrot">Báo cáo sinh viên thực hiện lại thực tập</p>
                    </div>
                </div>
                <!--
                    ### Bản tin ###
                -->
                <div class="ThanhThongTin">
                    <div id="ThongTinThongKe">
                        <h1>Thống kê</h1>
                    </div>
                    <!--Sinhvien-->
                    <div id="ThongTinSinhVien">
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
                    <div id="ThongTinGiaoVienHuongDan">
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
                    <div id="ThongTinDonViThucTap">
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
                    <div id="ThongTinCanBoHuongDan">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/CanBoHuongDan/BangThongTinCanBo.php');
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
                    <div id="ThongTinTaiKhoan">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/TaiKhoan/BangThongTinTaiKhoan.php');
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
                    <div id="ThongTinDieuHuongSinhVien">
                        <div class="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/DieuHuongSinhVienChoGiaoVien/SoLuongSinhVienDuocGiangVienHuongDan.php');
                            ?>
                        </div>
                    </div>
                    <!--Báo cáo danh sách sinh viên-->
                    <div id="BaoCaoDS_dvtt"></div>
                    <div id="BaoCaoDS_GVHD"></div>
                    <div id="BaoCaoDS_CBHD"></div>
                    <div id="BaoCaoDS_deTai"></div>
                    <div id="BaoCaoDiemSoThucTap"></div>
                    <div id="BaoCaoSVThucHienLai"></div>
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