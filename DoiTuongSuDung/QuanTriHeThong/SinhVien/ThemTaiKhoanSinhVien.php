<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm sinh viên</title>

        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="GiaoDienTaoTaiKhoanSV.css">
    </head>
    <body>
        <head></head>
        <main>
            <div class="KhungChua">
                <form action="" method="post" id="BieuMauDangKySinhVien" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <table>
                        <tr> 
                            <td>
                                <h1 class="TieuDeDangKy">Tạo tài khoản Sinh viên</h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mã số sinh viên:</p>
                                <input class="inputDangNhap" name="MSSV" id="MSSV" type="text" placeholder="Mã số sinh viên" value="B2"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mật khẩu:</p>
                                <input class="inputDangNhap" type="password" name="pw_sv" id="pw_sv" placeholder="Mật khẩu"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Xác nhận Mật khẩu:</p>
                                <input class="inputDangNhap" name="xacNhanPW" id="xacNhanPW" type="password" placeholder="Xác nhận mật khẩu"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <button class="NutDangky" type="submit">Tạo tài khoản</button>
                              <button class="NutDangky NutHuy" type="reset">Hủy</button>  
                            </th>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>