<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm sinh viên</title>
        
        <!--Tự viết -->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="TaiKhoan/GiaoDienTaoTaiKhoan.css">

        <script src="../../../RangBuoc/TaiKhoan/bieuMauTaoTaiKhoan.js" async></script>
    </head>
    <body>
        <head></head>
        <main>
            <div class="KhungChua"> 
                <h1 class="TieuDeDangKy">Tài khoản</h1><!--onsubmit="return BieuMauDangKy_TKSV()"-->
                <form action="TaiKhoan/ThongTinTK.php" class="BangChinh" method="post" name="bieuMauDangKy_TK" id="BieuMauDangKySinhVien" autocomplete="off" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauDangKy_TK()">
                    <table class="Bang1">
                        <tr>
                            <td>
                                <p class="TieuDeDien">UserID:</p>
                                <input class="LayThongTin" name="UserID" id="UserID" type="text" size="50" maxlength="100" placeholder="UserID"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">User Role:</p>
                                <input class="LayThongTin" name="UserRole" id="UserRole" type="text" placeholder="Vai trò người dùng"/>
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
                                <p class="TieuDeDien">Mật khẩu:</p>
                                <input class="LayThongTin" name="MatKhau" id="MatKhau" type="password" placeholder="Mật khẩu" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Xác nhận Mật khẩu:</p>
                                <input class="LayThongTin" name="XacNhanMatKhau" id="XacNhanMatKhau" type="password" placeholder="Xác nhận Mật khẩu" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>