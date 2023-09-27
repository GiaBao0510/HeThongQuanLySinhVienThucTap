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
        <script src="../../RangBuoc/TrangDungChung/DungChung.js"></script>
        <script src="../../RangBuoc/QuanTriHeThong/trangchu.js" async></script>
        <!--
            php
        -->
    </head>
    <body>
        <header></header>
        <main>
            <div class="Khung_chinh">
                <!--
                    ### Thanh bên trái ###
                -->
                <div class="ThanhQuanLy">
                    <p class="BoTriMuc">Trang chủ</p>
                    <p class="BoTriMuc">Sinh viên</p>
                    <p class="BoTriMuc">Giáo viên hướng dẫn</p>
                    <p class="BoTriMuc">Đơn vị thực tập</p>
                    <p class="BoTriMuc">Cán bộ hướng dẫn</p>
                    <p class="BoTriMuc">Tài khoản</p>
                    <p class="BoTriMuc">Báo cáo</p>
                    <div class="DanhSachBaoCao">
                        <p class="BoTriMuc_ds">Báo cáo danh sách sinh viên theo đợt thực tập</p>
                        <p class="BoTriMuc_ds">Báo cáo danh sách giảng viên theo đợt thực tập</p>
                        <p class="BoTriMuc_ds">Báo cáo danh sách đề tài theo đợt thực tập</p>
                        <p class="BoTriMuc_ds">Báo cáo điểm số theo đợt thực tập</p>
                        <p class="BoTriMuc_ds">Báo cáo sinh viên thực hiện lại thực tập</p>
                    </div>
                </div>
                <!--
                    ### Bản tin ###
                -->
                <div class="ThanhThongTin">
                    <div class="ThongTinThongKe">
                        <h1>Thống kê</h1>
                    </div>
                    <div id="ThongTinSinhVien">
                        <div id="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/SinhVien/ThemTaiKhoanSinhVien.php');
                            ?>
                            <button id="NutChuyenTrangThemMauTin"  class="NutDangNhap">Thêm tài khoản Sinh viên</button>
                        </div>
                        <div id="BangThemThongTin">
                            <button id="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/SinhVien/ThemTaiKhoanSinhVien.php');
                            ?>
                        </div>
                    </div>
                    <div id="ThongTinGiaoVienHuongDan"></div>
                    <div id="ThongTinDonViThucTap">
                        <div id="BangThongTin">
                            <?php
                                include('../QuanTriHeThong/DonViThucTap/BangThongTinDonVi.php');
                            ?>
                            <button id="NutChuyenTrangThemMauTin"  class="NutDangNhap">Thêm đơn vị thực tập</button>
                        </div>
                        <div id="BangThemThongTin">
                            <button id="NutChuyenTrangBangTin"><i class="fa-solid fa-backward"></i></button>
                            <?php
                                include('../QuanTriHeThong/DonViThucTap/ThemDonViThucTap.php');
                            ?>
                        </div>
                    </div>
                    <div id="ThongTinCanBoHuongDan"></div>
                    <div id="BaoCaoDS_dvtt"></div>
                    <div id="BaoCaoDS_GVHD"></div>
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