<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hồ sơ sinh viên</title>

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/HoSo/KhungChinhSuaHoSo.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuSinhVien.php?ID=<?php echo $_GET['ID'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main> 
            <?php
                include('../TrangDungChung/CacHamXuLy.php');
                include('../TrangDungChung/KetNoi.php');
                $MaSSV = trim($_GET['ID']);
                $infSV = infSinhVien($MaSSV);
                $thongTinGiayGioiThieu = infGiayGioiThieu($MaSSV);
                echo '
                <div class="KhungHoSoChinh">
                    <form name="BieuMauHoSo" class="HoSo" action="" method="post">
                        <table class="ThongTin_trai">
                            <tr>
                                <td>
                                    <p>Ảnh</p>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Họ tên</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.trim($infSV['HoTen']).'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Giới tính</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.$infSV['GioiTinh'].'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Ngày sinh</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.$infSV['NgaySinh'].'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Số điện thoại</p>
                                </td>
                                <td>
                                    <input name="SDT" type="text" class="ThongTinINPUT" value='.$infSV['SDT'].'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Số Căn cước</p>
                                </td>
                                <td>
                                    <input name="CCCD" type="text" class="ThongTinINPUT" value='.$infSV['CCCD'].'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mật khẩu</p>
                                </td>
                                <td>
                                    <input name="MatKhau" type="text" class="ThongTinINPUT" value='.$infSV['MatKhau'].' >
                                </td>
                            </tr>
                        </table>
                        <!--
                            Bảng thứ 2
                        -->
                        <table class="ThongTin_phai">
                            <tr>
                                <td colspan="2"  class="CotBenTrai">
                                    <p class="TieuDeChinhSua">CHỈNH SỬA HỒ SƠ SINH VIÊN</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mã số sinh viên</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.$infSV['MSSV'].'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mã lớp</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.$infSV['MaLop'].'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Ngành</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.$infSV['TenNganh'].'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Email</p>
                                </td>
                                <td>
                                    <input name="Email" type="text" class="ThongTinINPUT" value='.$infSV['Email'].'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Địa chỉ</p>
                                </td>
                                <td>
                                    <textarea name="DiaChi" class="OLayThongTinPhai ThongTinINPUT">'.$infSV['DiaChi'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Trình độ</p>
                                </td>
                                <td>
                                    <select required name="TrinhDo" id="TrinhDoHocVan" class="ThongTinINPUT" aria-valuenow='.TenHocVan($thongTinGiayGioiThieu['IDHocVan']).'>
                                        <option value="Defalt"> -- select -- </option>
                                        <option value="hv01">trung học cơ sở</option>
                                        <option value="hv02">trung học phổ thông</option>
                                        <option value="hv03">cao đẳng</option>
                                        <option value="hv04">đại học</option>
                                        <option value="hv05">Cử Nhân</option>
                                        <option value="hv06">Kỹ Sư</option>
                                        <option value="hv07">Thạc Sĩ</option>
                                        <option value="hv08">Tiến Sĩ</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Kinh nghiệm</p>
                                </td>
                                <td>
                                    <textarea name="KinhNghiem" class="OLayThongTinPhai ThongTinINPUT">'.$thongTinGiayGioiThieu['KinhNghiem'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Chứng chỉ</p>
                                </td>
                                <td>
                                    <textarea name="ChungChi" class="OLayThongTinPhai ThongTinINPUT">'.$thongTinGiayGioiThieu['ChungChi'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Kỹ năng</p>
                                </td>
                                <td>
                                    <textarea name="KyNang" class="OLayThongTinPhai ThongTinINPUT">'.$thongTinGiayGioiThieu['KyNang'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Ngoại ngữ</p>
                                </td>
                                <td>
                                    <textarea name="NgoaiNgu" class="OLayThongTinPhai ThongTinINPUT">'.$thongTinGiayGioiThieu['NgoaiNgu'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="NutCapNhat NutDangNhap">Cập nhật thông tin</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    
                </div>';
            ?>
            
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