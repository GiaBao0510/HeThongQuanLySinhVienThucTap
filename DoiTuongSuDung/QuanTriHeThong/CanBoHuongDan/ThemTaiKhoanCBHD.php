<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm tài khoản cán bộ</title>
        
        <!--Tự viết -->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="SinhVien/GiaoDienTaoTaiKhoanSV.css">

        <script src="../../../RangBuoc/CanBoHuongDan/RangBuocBieuMau.js" async></script>
    </head>
    <body>
        <header></header>
        <main>
            <div class="KhungChua"> 
                <h1 class="TieuDeDangKy">Cán bộ hướng dẫn</h1><!--onsubmit="return BieuMauDangKy_TKSV()"-->
                <form action="CanBoHuongDan/ThongTinCBHD.php" class="BangChinh" method="post" name="bieuMauDangKy_CBHD" id="BieuMauDangKySinhVien" autocomplete="off" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauDangKy_TKCBHD()">
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
                                <p class="TieuDeDien">Mã số cán bộ hướng dẫn:</p>
                                <input class="LayThongTin" name="MSCB" id="MSCB" type="text" placeholder="Mã số sinh viên"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mã đơn vị thực tập:</p>
                                <input class="LayThongTin" name="MaDVTT" id="MaDVTT" type="text"  placeholder="Mã lớp"/>
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
    </body>
</html>