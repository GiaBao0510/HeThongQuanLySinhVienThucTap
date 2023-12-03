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
        <link rel="stylesheet" href="SinhVien/GiaoDienTaoTaiKhoanSV.css">

        <script src="../../../RangBuoc/SinhVien/RangBuocBieuMau.js" async></script>
    </head>
    <body>
        <head></head>
        <main>
            <div class="KhungChua">
                <h1 class="TieuDeDangKy">Sinh viên</h1><!--onsubmit="return BieuMauDangKy_TKSV()"-->
                <form action="SinhVien/ThongTinSinhVien.php" class="BangChinh" method="post" name="bieuMauDangKy_SinhVien" id="BieuMauDangKySinhVien" autocomplete="off" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauDangKy_TKSV()">
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
                                <input class="LayThongTin" name="ngaySinh" id="ngaySinh" type="date" placeholder="Ngày sinh" value="2000-01-01">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mã số sinh viên:</p>
                                <input class="LayThongTin" name="MSSV" id="MSSV" type="text" placeholder="Mã số sinh viên"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mã lớp:</p>
                                <select name="maLop" class="LayThongTin">
                                    <?php
                                        $All_lop = ds_LopHoc();
                                        while($row = mysqli_fetch_array($All_lop)){
                                            echo '<option value='.$row['MaLop'].'>'.$row['MaLop'].'</option>';
                                        }
                                    ?>
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Mật khẩu:</p>
                                <input class="LayThongTin" type="password" name="pw_sv" id="pw_sv" placeholder="Mật khẩu"/>
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
                                        <span>Nam</span><input name="gioitinh" id="gioitinh" type="radio" value="M" checked/><span>Nữ</span><input name="gioitinh" id="gioitinh" type="radio" value="F"/>
                                    </div>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Email:</p>
                                <input class="LayThongTin" name="Email_sv" id="Email_sv" type="email" placeholder="Email" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Số điện thoại:</p>
                                <input class="LayThongTin" name="sdt_sv" id="sdt_sv" type="text" placeholder="Số điện thoại"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Căn cước công dân:</p>
                                <input class="LayThongTin" name="cccd" id="cccd" type="text" placeholder="Căn cước công dân"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="TieuDeDien">Địa chỉ:</p>
                                <textarea class="DiaChiSV" name="diaChi_sv" id="diaChi_sv"  placeholder="Địa chỉ cư trú"></textarea>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>