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
    </head>
    <body>
        <head>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuDVTT.php?ID=<?php echo $_GET['ID']; ?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </head>
        <main>
            <?php 
                //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
                include ('../../TrangDungChung/KetNoi.php');

                $maDVTT = trim($_GET['MaDVTT']);
                //Tìm kiếm thông tin của mã đơn vị thực tập vừa được tìm
                $LenhTimThongTin = "SELECT * 
                                    FROM donvithuctap dv INNER JOIN taikhoan tk ON tk.UserID = dv.MaDVTT 
                                    WHERE dv.MaDVTT = '$maDVTT'";
                $truyVan = mysqli_query($connect,$LenhTimThongTin);

                //In thông tin tìm được
                $row = mysqli_fetch_array($truyVan) or die(mysqli_connect_error());
                
                echo'
                <form name="BieuMauCapNhat_dvtt" action="../../QuanTriHeThong/DonViThucTap/ThucHienCapNhat.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                    <div class="KhungHienThiChinh">
                    <div class="KhungHienThiDau">
                        <div class="DauThu1">
                        <img src="../../../Image/QuanTriHeThong/buildings.png" class="AnhDaiDien" alt="">
                        </div>
                        <div class="DauThu2">
                        <table>
                            <tr>
                            <td>
                                <p>Đơn vị thực tập:</p>
                            </td>
                            <td>
                                <input name="TenDVTT" type="text" value="'.$row['TenDVTT'].' "/>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <p>Mã Đơn vị thực tập:</p>
                            </td>
                            <td>
                                <input name="MaDVTT" type="text" value="'.$row['MaDVTT'].' "/>
                            </td>
                            </tr>
                            <tr>
                            <td>Số vai trò:</td>
                            <td>
                                <input name="UserRole" type="text" value="'.$row['UserRole'].' "/>
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
                                    <input name="SDT" type="text" value="'.$row['SDT'].' "/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Email:</p>
                                </td>
                                <td>
                                    <input name="Email" type="text"value="'.$row['Email'].' "/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mật khẩu:</p>
                                </td>
                                <td>
                                    <input name="MatKhau" type="text" value="'.$row['MatKhau'].' "/>
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
