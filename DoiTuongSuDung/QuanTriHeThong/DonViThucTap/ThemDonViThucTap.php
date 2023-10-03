<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm nhân viên</title>
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="GiaoDienBieuMau_DVTT.css">

        <script src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js" async></script>
        
    </head>
    <body>
        <head></head>
        <main>
            <div class="KhungChua">
                <h1 class="TieuDeDangKy">Đơn vị thực tập</h1>
                <form name="FormDangKyDonViThucTap" action="../QuanTriHeThong/DonViThucTap/ThongTinDonViThucTap.php" method="post" enctype="application/x-www-form-urlencoded" id="BieuMauDangKyDonViThucTap" class="BangChinh" onsubmit="DangKyTaiKhoanDVTT()">
                    <!--
                        Bảng trái
                    -->
                    <table class="BangTrai">
                        <tr>
                            <th>
                                <p class="TieuDeDien">Tên đơn vị nhận sinh viên thực tập</p>
                                <input class="inputDangNhap" name="tenDonViThucTap" id="tenDonViThucTap" type="text" placeholder="Đơn vị thực tập"/>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p class="TieuDeDien">Mật khẩu:</p>
                                <input class="inputDangNhap" name="pw_dvtt" id="pw_dvtt" type="password" placeholder="Đặt mật khẩu"/>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p class="TieuDeDien">Mật khẩu:</p>
                                <input class="inputDangNhap" name="xacNhanPW_dvtt" id="xacNhanPW_dvtt" type="password" placeholder="Xác nhận lại mật khẩu"/>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="KhoChuaNut">
                                    <button type="submit" class="NutDangky">Thêm đơn vị thực tập</button>
                                    <button type="reset" class="NutHuy" id="Huy">Hủy</button> 
                                </div>
                            </th>
                        </tr>
                    </table>
                    <!--
                        Bảng phải
                    -->
                    <table class="BangPhai">
                        <tr>
                            <th>
                                <p class="TieuDeDien">Email:</p>
                                <input class="inputDangNhap" name="Email_DVTT" id="Email_DVTT" type="email" placeholder="Email"/>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p class="TieuDeDien">Số điện thoại liên lạc:</p>
                                <input class="inputDangNhap" name="sdt_dvtt" id="sdt_dvtt" type="tel" placeholder="Số điện thoại"/>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p class="TieuDeDien">Địa chỉ</p>
                                <textarea class="TruongDiaChi" name="diaChi_dvtt" id="diaChi_dvtt" placeholder="Địa chỉ"></textarea>
                            </th>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
        <script src="GocNhin.js" async></script>
    </body>
</html>