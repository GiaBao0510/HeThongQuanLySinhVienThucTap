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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tạo tài khoản cán bộ hướng dẫn</title>
        
        <!--Tự viết -->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../QuanTriHeThong/SinhVien/GiaoDienTaoTaiKhoanSV.css">

        <script src="../../../RangBuoc/CanBoHuongDan/RangBuocBieuMau.js" async></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>
        <script src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" async></script>
        <!--PHP-->
        <?php
            $mdvtt = $_SESSION['user'];
            $ThongTinDonViTT = infDonViThucTap($mdvtt);
        ?>
    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <form action="../../TrangDungChung/ThucHienDangXuat.php" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="taikhoan" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" name="matkhau" value="<?php echo $_SESSION['pw'];?>">
                        <input type="hidden" name="vaitro" value="<?php echo $_SESSION['role'];?>">
                        <input type="hidden" name="loithoat" value="../TrangDungChung/index.php">
                        <button type="submit" class="NutThoat">
                            <i class="fa-solid fa-door-open"></i>Thoát
                        </button>
                    </form>
                    <a href="../TrangChuDVTT.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="KhungChua"> 
                <h1 class="TieuDeDangKy">Cán bộ hướng dẫn</h1><!--onsubmit="return BieuMauDangKy_TKSV()"-->
                <form action="ThucHienThemCanBo.php" class="BangChinh" method="post" name="bieuMauDangKy_CBHD" id="BieuMauDangKySinhVien" autocomplete="off" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauTao_TKCBHD()">
                    <table class="Bang1">
                        <tr>
                            <td>
                                <p class="TieuDeDien">Họ tên</p>
                                <input class="LayThongTin" name="HoTen" id="HoTen" type="text" size="50" maxlength="100" placeholder="Họ tên"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Ngày sinh:</p>
                                <input class="LayThongTin" name="NgaySinh" id="NgaySinh" type="date" placeholder="Ngày sinh" value="Ngày sinh"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Tên Tài khoản:</p>
                                <input class="LayThongTin HienThiMaDonViThucTap" value='<?php echo IncreaseIDIndex(MSCB_current());?>' type="text" placeholder="Tài khoản" disabled/>
                                <input type="hidden" name="MSCB" value='<?php echo IncreaseIDIndex(MSCB_current());?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mã đơn vị thực tập:</p>
                                <input class="LayThongTin HienThiMaDonViThucTap" value="<?php echo $ThongTinDonViTT['MaDVTT'];?>" type="text"  placeholder="Mã  đơn vị thực tập" disabled/>
                                <input type="hidden" name="MaDVTT" value="<?php echo $ThongTinDonViTT['MaDVTT'];?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mật khẩu:</p>
                                <input class="LayThongTin" type="password" name="MatKhau" id="MatKhau" placeholder="Mật khẩu"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="NutDangky">Tạo Tài Khoản</button>
                                <button class="NutHuy"> Hủy</button>  
                            </th>
                        </tr>
                    </table>
                    <table class="Bang2">
                        <tr>
                            <td>
                                <p class="TieuDeDien">
                                    <p> Giới tính:</p>
                                    <div class="ChinhKhungGioiTinh">
                                        <span>Nam</span><input name="GioiTinh" id="gioitinh" type="radio" value="M" checked/><span>Nữ</span><input name="GioiTinh" id="gioitinh" type="radio" value="F"/>
                                    </div>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Email:</p>
                                <input class="LayThongTin" name="Email" id="Email" type="email" placeholder="Email" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Số điện thoại:</p>
                                <input class="LayThongTin" name="SDT" id="SDT" type="text" placeholder="Số điện thoại"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Địa chỉ:</p>
                                <textarea class="DiaChiSV" name="DiaChi" id="DiaChi"  placeholder="Địa chỉ cư trú"></textarea>
                            </td>
                        </tr>
                    </table>
                </form>
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