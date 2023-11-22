<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ giảng viên hướng dẫn</title>
        <link rel="shortcut icon" href="../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuGiaoVien.php?ID=<?php echo strval($_GET['ID'])?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="KhungChot">
                <div class="KhungCaNhan">
                    <?php 
                        include('../TrangDungChung/KetNoi.php');
                        include('../TrangDungChung/CacHamXuLy.php');
                        //Lấy Mã số sih viên để hiển thị thông tin
                        $maSo = trim($_GET['ID']);
                        
                        //Thực hiện lấy thông tin
                        $layThongTin = "SELECT *
                                        FROM giangvienhuongdan gv INNER JOIN khoa ON gv.MaKhoa = khoa.MaKhoa
                                                                            INNER JOIN nganh n ON n.MaKhoa = khoa.MaKhoa
                                                                            INNER JOIN taikhoan tk ON tk.UserID = gv.MSGV
                                        WHERE gv.MSGV = '$maSo '";
                        $ThucHien = mysqli_query($connect,$layThongTin) or die(mysqli_connect_error());
                        $ketqua = mysqli_fetch_array($ThucHien) ;
                        
                        //Hiển thị
                        echo '<form name="HoSoGiaoVienVien" action="HoSo.php" class="BieuMauHoSo" action="HoSo.php" method="post" enctype="application/x-www-form-urlencoded">
                                <table class="BangHoSo">
                                    <tr>
                                        <td colspan="2" class="CotTieuDe">
                                        <p class="TieuDeHoSo">HỒ SƠ GIẢNG VIÊN HƯỚNG DẪN</p> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="CotTieuDe">
                                            <div>Ảnh</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Họ tên</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['HoTen'].'</p>
                                            <input name="HoTen" type="hidden" value="'.$ketqua['HoTen'].'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">MSGV</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['MSGV'].'</p>
                                            <input name="MSGV" type="hidden" value="'.$ketqua['MSGV'].'">
                                            <input name="MatKhau" type="hidden" value="'.$ketqua['MatKhau'].'"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Ngành</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['TenNganh'].'</p>
                                            <input name="MaNganh" type="hidden" value="'.$ketqua['MaNganh'].'">
                                            <input name="TenNganh" type="hidden" value="'.$ketqua['TenNganh'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Giới tính:</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['GioiTinh'].'</p>
                                            <input name="GioiTinh" type="hidden" value="'.$ketqua['GioiTinh'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Ngày sinh</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['NgaySinh'].'</p>
                                            <input name="NgaySinh" type="hidden" value="'.$ketqua['NgaySinh'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Số điện thoại</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['SDT'].'</p>
                                            <input name="SDT" type="hidden" value="'.$ketqua['SDT'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Căn cước</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['CCCD'].'</p>
                                            <input name="CCCD" type="hidden" value="'.$ketqua['CCCD'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Email</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['Email'].'</p>
                                            <input name="Email" type="hidden" value="'.$ketqua['Email'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Địa chỉ</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['DiaChi'].'</p>
                                            <input name="DiaChi" type="hidden" value="'.$ketqua['DiaChi'].'">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" class="NutDangNhap"> Chỉnh sửa hồ sơ</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>';
                    ?>
                    
                </div>
                <div class="KhungChonChucNang">
                    <table class="BangChucNang">
                        <tr>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="XemDanhSachSinhVienHuognDan.php?MSGV=<?php echo $maSo;?>">
                                    <div>
                                        <img class="AnhChucNang" src="../../Image/GiaoVien/Student list lo 0.png" alt="anh">
                                    </div>
                                    <p>Danh sách <br> sinh viên</p>
                                </a>
                            </td>
                            <td class="CotTieuDe">
                                <a class="OChucNang">
                                    <div></div>
                                    <p>Xem đề tài sinh viên thực tập</p>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="ThucHienChamDiem/DanhSachSinhVienHuongDan.php?MSGV=<?php echo $maSo;?>">
                                    <div>
                                        <img class="AnhChucNang" src="../../Image/GiaoVien/Student grading 1.png" alt="anh">
                                    </div>
                                    <p>Chấm điểm <br> thực tập</p>
                                </a>
                            </td>
                            <td class="CotTieuDe">
                                <a class="OChucNang">
                                    <div></div>
                                    <p>Xem tiến độ hoàn thành của sinh viên</p>
                                </a>
                            </td>
                        </tr>
                        
                    </table>
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