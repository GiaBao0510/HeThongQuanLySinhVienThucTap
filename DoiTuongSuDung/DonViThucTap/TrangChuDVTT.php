<?php
    session_start();
    ob_start();
    include('../TrangDungChung/KetNoi.php');
    include('../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhập
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../TrangDungChung/DangNhapThatBai.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ đơn vị thực tập</title>
        <link rel="shortcut icon" href="../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../RangBuoc/TrangDungChung/DungChung.js" async></script>

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <form action="../TrangDungChung/ThucHienDangXuat.php" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="taikhoan" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" name="matkhau" value="<?php echo $_SESSION['pw'];?>">
                        <input type="hidden" name="vaitro" value="<?php echo $_SESSION['role'];?>">
                        <input type="hidden" name="loithoat" value="../TrangDungChung/index.php">
                        <button type="submit" class="NutThoat">
                            <i class="fa-solid fa-door-open"></i>Thoát
                        </button>
                    </form>
                    <a href="TrangChuDVTT.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="KhungChot">
                <div class="KhungCaNhan">
                    <?php 
                        //Lấy Mã số đơn vị để hiển thị thông tin
                        $maSo = $_SESSION['user'];
                        
                        //Thực hiện lấy thông tin
                        $layThongTin = "SELECT *
                                        FROM donvithuctap dv INNER JOIN taikhoan tk ON tk.UserID = dv.MaDVTT
                                        WHERE dv.MaDVTT = '$maSo '";
                        $ThucHien = mysqli_query($connect,$layThongTin) or die(mysqli_connect_error());
                        $ketqua = mysqli_fetch_array($ThucHien) ;
                        
                        //Hiển thị
                        echo '<form name="HoSoDonViThucTap" action="HoSo.php" class="BieuMauHoSo" action="HoSo.php" method="post" enctype="application/x-www-form-urlencoded">
                                <table class="BangHoSo">
                                    <tr>
                                        <td colspan="2" class="CotTieuDe">
                                        <p class="TieuDeHoSo">THÔNG TIN ĐƠN VỊ THỰC TẬP</p> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="CotTieuDe">
                                            <div>Ảnh</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Tên đơn vị thực tập</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['TenDVTT'].'</p>
                                            <input name="TenDVTT" type="hidden" value="'.$ketqua['TenDVTT'].'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="tieuDeThongTin">Mã số đơn vị thực tập</p>
                                        </td>
                                        <td>
                                            <p>'.$ketqua['MaDVTT'].'</p>
                                            <input name="MaDVTT" type="hidden" value="'.$ketqua['MaDVTT'].'">
                                            <input name="MatKhau" type="hidden" value="'.$ketqua['MatKhau'].'"/>
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
                                            <button type="submit" class="NutDangNhap"> Chỉnh sửa thông tin</button>
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
                                <a class="OChucNang">
                                    <div></div>
                                    <p>Đăng ký tuyển sinh</p>
                                </a>
                            </td>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="DuyetSinhVienThucTap/DS_choPheDuyet.php">
                                    <div>
                                        <img src="../../Image/DonViThucTap/verified.png" class="AnhChucNang" alt="">
                                    </div>
                                    <p>Phê duyệt sinh viên <br> thực tập tại cơ sở</p>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="QuanLyCanBoHuongDan/DanhSachCanBoHuongDan.php">
                                    <div>
                                        <img src="../../Image/DonViThucTap/employee.png" class="AnhChucNang" alt="">
                                    </div>
                                    <p>Quản lý cán bộ hướng dẫn</p>
                                </a>
                            </td>
                            <td class="CotTieuDe">
                                <a class="OChucNang" href="QuanLySinhVien/XemDanhSachSinhVien.php">
                                    <div>
                                        <img src="../../Image/DonViThucTap/student.png" class="AnhChucNang" alt="">
                                    </div>
                                    <p>Quản lý sinh viên thực tập</p>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="CotTieuDe" colspan="2">
                                <a class="OChucNang">
                                    <div></div>
                                    <p>Quản lý đề tài</p>
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