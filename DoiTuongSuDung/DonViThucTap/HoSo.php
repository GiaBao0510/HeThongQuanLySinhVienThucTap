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
        <title>Hồ sơ sinh viên</title>

        <!--CSS-->
        <link rel="stylesheet" href="../../DinhDangWebSite/HoSo/KhungChinhSuaHoSo.css">
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
            <?php

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
                                    <p>Tên đơn vị thực tập</p>
                                </td>
                                <td>
                                    <input name="TenDVTT" type="text" class="ThongTinINPUT" value='.$_POST['TenDVTT'].'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Số điện thoại</p>
                                </td>
                                <td>
                                    <input name="SDT" type="text" class="ThongTinINPUT" value='.$_POST['SDT'].'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mật khẩu</p>
                                </td>
                                <td>
                                    <input name="MatKhau" type="text" class="ThongTinINPUT" value='.$_POST['MatKhau'].' >
                                </td>
                            </tr>
                        </table>
                        <!--
                            Bảng thứ 2
                        -->
                        <table class="ThongTin_phai">
                            <tr>
                                <td colspan="2"  class="CotBenTrai">
                                    <p class="TieuDeChinhSua">CHỈNH SỬA THÔNG TIN ĐƠN VỊ THỰC TẬP</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mã số đơn vị thực tập</p>
                                </td>
                                <td>
                                    <p class="ThongTinChinhSua">'.$_POST['MaDVTT'].'</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Email</p>
                                </td>
                                <td>
                                    <input name="Email" type="text" class="ThongTinINPUT" value='.$_POST['Email'].'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Địa chỉ</p>
                                </td>
                                <td>
                                    <textarea name="DiaChi" class="OLayThongTinPhai ThongTinINPUT">'.$_POST['DiaChi'].'</textarea>
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