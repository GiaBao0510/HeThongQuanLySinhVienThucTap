<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách chờ phê duyệt</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>
        <script src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js" async></script>
        <script src="../../../RangBuoc/CanBoHuongDan/RangBuocBieuMau.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" async></script>
        <!--
            PHP
        -->
        <?php
            include('../../TrangDungChung/CacHamXuLy.php');
            include('../../TrangDungChung/KetNoi.php');
            $mdvtt = trim($_GET['MaDVTT']);
            $role = mysqli_fetch_array(infTaiKhoan($mdvtt))['UserRole'];
            $mscb = trim($_GET['MSCB']);
            $ThongTinCanBo = infCanBoHuongDan($mscb);
        ?>
</head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="../TrangChuDVTT.php?ID=<?php echo $_GET['MaDVTT']; ?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="KhungHoSoCanBo">
                <div class="AnhCanBo">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3MJicYeZVBKWnndKPljOQ4Uqr8EbXmgsgkQ&usqp=CAU" alt="">
                </div>
                <div class="BangThongTin">
                    <form name="BieuMauCapNhatCanBo" action="ThucHienCapNhatCanBo.php?MSCB=<?php echo $mscb;?>" method="post" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauCapNhat_TKCBHD()">
                        <table>
                            <tr>
                                <td>
                                    <p>Tài khoản:</p>
                                    <input name="MSCB" type="text" value="<?php echo $ThongTinCanBo['MSCB'];?>">
                                </td>
                                <td>
                                    <p>Mật khẩu:</p>
                                    <input name="MatKhau" type="text" value="<?php echo $ThongTinCanBo['MatKhau'];?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Họ tên:</p>
                                    <input name="HoTen" type="text" value="<?php echo $ThongTinCanBo['HoTen'];?>">
                                </td>
                                <td>
                                    <p>Giới tính:</p>
                                    <input name="GioiTinh" type="text" size="1" maxlength="1" value="<?php echo $ThongTinCanBo['GioiTinh'];?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p>Ngày sinh:</p>
                                    <input class="OthongTin" name="NgaySinh" type="date" value="<?php echo $ThongTinCanBo['NgaySinh'];?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Số điện thoại:</p>
                                    <input name="SDT" type="text" value="<?php echo $ThongTinCanBo['SDT'];?>">
                                </td>
                                <td>
                                    <p>Email:</p>
                                    <input name="Email" type="text" value="<?php echo $ThongTinCanBo['Email'];?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p>Địa chỉ:</p>
                                    <input class="oDiaChi" name="DiaChi" type="text" value="<?php echo $ThongTinCanBo['DiaChi'];?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="NutGui">Lưu thông tin</button>
                                </td>
                            </tr>
                        </table>
                    </form>
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
</html><button type="button" ></button>
