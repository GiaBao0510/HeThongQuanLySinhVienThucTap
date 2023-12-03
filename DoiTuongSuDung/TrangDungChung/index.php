<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>

        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../RangBuoc/TrangDungChung/TrangChu.js" async></script>
        <script src="../../RangBuoc/SinhVien/RangBuocBieuMau.js" async></script>
        <script src="../../RangBuoc/TrangDungChung/index.js" async></script>
        <script src="../../RangBuoc/TrangDungChung/DungChung.js"></script>
        <!--
            PHP
        -->
        
    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="index.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main >
            <div class="KhungChinh">
                <!--
                Bên trang đăng nhập
                -->
                <div class="KhungCuaThuNhat" id="KhungCuaThuNhat">
                    <div class="CuaSo1">
                        <form name="FromDangNhap" class="BieuMauDangNhap" action="KiemTraDangNhap.php" autocomplete="off" method="post" enctype="application/x-www-form-urlencoded" onsubmit="return KiemTraDangNhap()">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <h1 class="TieuDeDangNhap">Đăng Nhập</h1>
                                    </td>
                                </tr>
                                <!--Hàng tài khoản-->
                                <tr>
                                    <td>
                                        <label for="IDDangNhap"><i class="fa-solid fa-user"></i></label>
                                    </td>
                                    <td>
                                        <input name="MaDangNhap" id="IDDangNhap" class="NhapMaDangNhap" type="text" size="30" maxlength="8" title="Nhập mã đăng nhập" placeholder="Mã đăng nhập"/>
                                    </td>
                                </tr>
                                <!--Hàng mật khẩu-->
                                <tr>
                                    <td>
                                        <label for="IDMatKhauDangNhap"><i class="fa-solid fa-lock"></i></label>
                                    </td>
                                    <td>
                                        <input name="MatKhauDangNhap" id="IDMatKhauDangNhap" class="NhapMatKhauDangNhap" type="password" size="30" title="Nhập mật khẩu đăng nhập" placeholder="Mật khẩu"/>
                                        <input type="hidden" name="status" id="status"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button type="submit" class="NutDangNhap"> Đăng nhập </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <!--Thông tin cạnh bên-->
                    <div class="CuaSo2">
                            <div class=" ChuyenTrangDangKy">
                                <h1>Hệ thống quản lý sinh viên thực tập thực tế</h1>
                                <p class="ThongTinDangKy">Sinh viên và đơn vị thực tập có thể đăng ký trực tiếp trên hệ thống.<br>Giảng viên hướng dẫn liên hệ với khoa để được cấp tài khoản đăng nhập. <br>Đơn vị/ công ty thực tập sẽ được nhà trường cấp cho tài khoản hoặc có thể tự đăng ký tài khoản(Sau khi tạo tài khoản thành công thì phải chờ nhà trường duyệt thì tài khoản sẽ có hiệu lực)  <br>Cán bộ hướng dẫn liên hệ với đơn vị thực tập để được cấp tài khoản. </p>
                            </div>
                            <button class="NutChuyenTrang" id="NutDangKy">Đăng ký tài khoản</button>
                    </div>
                </div>
                <!--
                    Bên trang đăng ký
                -->
                <div class="KhungCuaThuHai" id="KhungCuaThuHai">
                    <!--Thông tin cạnh bên-->
                    <div class="CuaSo1Khung2">
                        <div class=" ChuyenTrangDangKy">
                            <h1>Hệ thống quản lý sinh viên thực tập thực tế</h1>
                            <p class="ThongTinDangKy">Sinh viên và đơn vị thực tập có thể đăng ký trực tiếp trên hệ thống.<br>Giảng viên hướng dẫn liên hệ với khoa để được cấp tài khoản đăng nhập. <br>Cán bộ hướng dẫn liên hệ với đơn vị thực tập để được cấp tài khoản. </p>
                        </div>
                        <button class="NutChuyenTrang" id="NutDangNhap">Đăng nhập</button>
                    </div> 
                    <!--Thông tin đăng ký-->
                    <div class="CuaSo2Khung2">
                        <!--Sinh viên-->
                        <div>
                            <h1>Đăng ký tài khoản</h1>
                        </div>
                        <div id="ChonTaiKhoan">
                            <div id="Chon_DKSV"><p>Sinh viên</p></div>
                            <div id="Chon_DKDVTT"><p>Đơn vị thực tập</p></div>
                        </div>
                        <div class="BieuMauDangKy_SV" id="BieuMauDangKy_SV">
                            <form action="../QuanTriHeThong/SinhVien/DangKyTuTrangIndex.php" name="bieuMauDangKy_SinhVien" method="post" id="BieuMauDangKySinhVien" autocomplete="off" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauDangKy_TKSV()">
                                <table>
                                    <tr> 
                                        <td>
                                            <h1 class="TieuDeDangKy">Sinh viên</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Họ tên</p>
                                            <input class="inputDangNhap" name="HoTen" id="HoTen" type="text" size="50" maxlength="100" placeholder="Họ tên"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Giới tính:
                                                <span>Nam</span><input name="gioitinh" id="gioitinh" type="radio" value="1" checked/><span>Nữ</span><input name="gioitinh" id="gioitinh" type="radio" value="0"/>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Mã số sinh viên:</p>
                                            <input class="inputDangNhap" name="MSSV" id="MSSV" type="text" placeholder="Mã số sinh viên"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Mã lớp:</p>
                                            <input class="inputDangNhap" name="maLop" id="maLop" type="text"  placeholder="Mã lớp"/>
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
                                            <p class="TieuDeDien">Ngày sinh:</p>
                                            <input class="inputDangNhap" name="ngaySinh" id="ngaySinh" type="date" placeholder="Ngày sinh" value="Ngày sinh"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Email:</p>
                                            <input class="inputDangNhap" name="Email_sv" id="Email_sv" type="email" placeholder="Email" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Số điện thoại:</p>
                                            <input class="inputDangNhap" name="sdt_sv" id="sdt_sv" type="text" placeholder="Số điện thoại"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Căn cước công dân:</p>
                                            <input class="inputDangNhap" name="cccd" id="cccd" type="text" placeholder="Căn cước công dân"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="TieuDeDien">Địa chỉ:</p>
                                            <textarea class="TruongDiaChi" name="diaChi_sv" id="diaChi_sv"  placeholder="Địa chỉ cư trú"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <button class="NutDangky">Đăng ký</button>  
                                        </th>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!--Đơn vị thực tập-->
                        <div class="BieuMauDangKy_DVTT" id="BieuMauDangKy_DVTT">
                            <form action="ThucHienDangKyDVTT.php" method="post" enctype="application/x-www-form-urlencoded" id="BieuMauDangKyDonViThucTap" name="FormDangKyDonViThucTap" onsubmit="return DangKyTaiKhoanDVTT()">
                                <table>
                                    <tr>
                                        <th>
                                            <h1 class="TieuDeDangKy">Đơn vị thực tập</h1>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p class="TieuDeDien">Tên đơn vị nhận sinh viên thực tập</p>
                                            <input class="inputDangNhap" name="tenDonViThucTap" id="tenDonViThucTap" type="text" placeholder="Đơn vị thực tập"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p class="TieuDeDien">Email:</p>
                                            <input class="inputDangNhap" name="Email_DVTT" id="Email_DVTT" type="email" placeholder="Email"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p class="TieuDeDien">Số điện thoại liên lạc:</p>
                                            <input class="inputDangNhap" name="sdt_dvtt" id="sdt_dvtt" type="text" placeholder="Số điện thoại"/>
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
                                            <p class="TieuDeDien">Địa chỉ</p>
                                            <textarea class="TruongDiaChi" name="diaChi_dvtt" id="DiaChi_Dvtt" placeholder="Địa chỉ"></textarea>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <button class="NutDangky">Đăng ký</button>  
                                        </th>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    
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
        <script src="../../RangBuoc/DonViThucTap/linhHoat_DVTT.js" async></script>
        <!--Hiển thị thông báo khi không thấy tài khoản-->
        <script>
            var status = "<?php echo $KhongThay; ?>";
            if(status == "KhongThayTaiKhoan"){
                alert('Tài khoản không tồn tại');
            }
        </script>
    </body>
</html>