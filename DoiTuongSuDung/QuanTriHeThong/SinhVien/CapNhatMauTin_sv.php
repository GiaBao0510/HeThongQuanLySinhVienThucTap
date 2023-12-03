<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thông tin Đơn vị thực tập</title>
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/DonViThucTap/GiaoDienBieuMau_DVTT.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/QuanTriHeThong/GiaoDienCapNhat.css">
        
        <?php
            session_start();
            ob_start();
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');
            
            //Kiểm tra đăng nhâp
            if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
                include('../../TrangDungChung/DangNhapThatBai.php');
            }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
                include('../../TrangDungChung/DangNhapThatBai.php');
            }
        ?>
    </head>
    <body>
        <header>
            <div class="DauTrangChu">
                <div class="Logo">
                   <img src="../../../Image/QuanTriHeThong/protection.png" class="anhAdmin">
                </div>
                <div class="CacNutDauTrang">
                    <form action="../../TrangDungChung/ThucHienDangXuat.php" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="taikhoan" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" name="matkhau" value="<?php echo $_SESSION['pw'];?>">
                        <input type="hidden" name="vaitro" value="<?php echo $_SESSION['role'];?>">
                        <input type="hidden" name="loithoat" value="../TrangDungChung/index.php">
                        <button type="submit" class="NutDangXuat">
                            <i class="fa-solid fa-door-open"></i>Thoát
                        </button>
                    </form>
                    <a href="../TrangChu.php" class="NutVeTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <?php 

                $maSSV = trim($_GET['MSSV']);
                //Tìm kiếm thông tin của mã đơn vị thực tập vừa được tìm
                $LenhTimThongTin = "SELECT * 
                                    FROM sinhvien sv INNER JOIN taikhoan tk ON tk.UserID = sv.MSSV
                                    WHERE sv.MSSV = '$maSSV'";
                $truyVan = mysqli_query($connect,$LenhTimThongTin) or die(mysqli_connect_error());

                //In thông tin tìm được
                $row = mysqli_fetch_array($truyVan) or die(mysqli_connect_error());
                
                echo'
                <form action="../../QuanTriHeThong/SinhVien/ThucHienCapNhat_sv.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                    <div class="KhungHienThiChinh">
                    <div class="KhungHienThiDau">
                        <div class="DauThu1">
                        <img src="../../../Image/QuanTriHeThong/graduate.png" class="AnhDaiDien" alt="">
                        </div>
                        <div class="DauThu2">
                            <table>
                                <tr>
                                <td>
                                    <p>Họ và tên:</p>
                                </td>
                                <td>
                                    <input name="HoTen" type="text" value="'.$row['HoTen'].'"/>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <p>Ngày sinh:</p>
                                </td>
                                <td>
                                    <input name="NgaySinh" type="date" value="'.$row['NgaySinh'].'"/>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <p>Giới tính:</p>
                                </td>
                                <td>
                                    <input name="GioiTinh" type="text" value="'.$row['GioiTinh'].'"/>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <p>Mã số sinh viên:</p>
                                </td>
                                <td>
                                    <input name="MSSV" type="text" value="'.$row['MSSV'].'"/>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <p>Mã lớp:</p>
                                </td>
                                <td>
                                    <input name="MaLop" type="text" value="'.$row['MaLop'].'"/>
                                </td>
                                </tr>
                                <tr>
                                <td>Số vai trò:</td>
                                <td>
                                    <input name="UserRole" type="text" value="'.$row['UserRole'].'"/>
                                </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="KhungHienThiDuoi">
                        <table>
                        <tr>
                            <td>
                                <p>Số điện thoại:</p>
                            </td>
                            <td>
                                <input name="SDT" type="text" value="'.$row['SDT'].'"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Số căn cước:</p>
                            </td>
                            <td>
                                <input name="CCCD"  type="text" value="'.$row['CCCD'].'"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Email:</p>
                            </td>
                            <td>
                                <input name="Email"  type="text" value="'.$row['Email'].'"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Mật khẩu:</p>
                            </td>
                            <td>
                                <input name="MatKhau"  type="text" value="'.$row['MatKhau'].'"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Địa chỉ:</p>
                            </td>
                            <td>
                                <textarea class="TruongDiaChi" name="DiaChi">'.$row['DiaChi'].' </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="NutDangNhap">Cập nhật</button>
                            </td>
                        </tr>
                        </table>
                    </div>
                    </div>
                </form>
                ';
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
