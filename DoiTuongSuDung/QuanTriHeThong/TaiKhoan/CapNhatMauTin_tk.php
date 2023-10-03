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
        <link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/TaiKhoan/GiaoDienTaoTaiKhoan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/QuanTriHeThong/GiaoDienQuanTri.css">
    </head>
    <body>
        <head></head>
        <main>
            <div class="QuayVe">
                <a href="../../QuanTriHeThong/TrangChu.php" ><i class="fa-solid fa-backward"></i></a>
            </div>
            <?php 
                //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
                include ('../../TrangDungChung/KetNoi.php');
                //Áp dụng vài hàm
                include('../../TrangDungChung/CacHamXuLy.php');

                $maSo = trim($_GET['UserID']);
                //Tìm kiếm thông tin của mã đơn vị thực tập vừa được tìm
                $LenhTimThongTin = "SELECT * 
                                    FROM taikhoan
                                    WHERE UserID = '$maSo'";
                $truyVan = mysqli_query($connect,$LenhTimThongTin) or die(mysqli_connect_error());

                //In thông tin tìm được
                $row = mysqli_fetch_array($truyVan) or die(mysqli_connect_error());

                //Nếu chữ cái đầu là B Thì lấy thông tin -- sinh viên
                if(LayChuoiChuCaiDau($maSo) == "B"){
                    $timKiem = "SELECT * From sinhvien sv INNER JOIN taikhoan tk on tk.UserID = sv.MSSV
                                WHERE sv.MSSV = '$maSo'";
                    $thucHien = mysqli_query($connect,$timKiem) or die(mysqli_connect_error());
                    $row = mysqli_fetch_array($thucHien );
                    echo'
                        <form action="../../QuanTriHeThong/SinhVien/ThucHienCapNhat_sv.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                            <div class="KhungTongQuat">
                            <div class="KhungDau">
                                <div class="Dau1">
                                    <img src="https://beebom.com/wp-content/uploads/2023/04/featured-new.jpg?w=290&h=290&crop=1&quality=75" alt="">
                                </div>
                                <div class="Dau2">
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
                            <div class="KhungDuoi">
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
                }
                //Nếu chữ cái đầu là cbhd Thì lấy thông tin -- Cán bộ hướng dẫn
                if(LayChuoiChuCaiDau($maSo) == "cbhd"){
                    $timKiem = "SELECT * From canbohuongdan cb INNER JOIN taikhoan tk on tk.UserID = cb.MSCB
                                WHERE cb.MSCB = '$maSo'";
                    $thucHien = mysqli_query($connect,$timKiem) or die(mysqli_connect_error());
                    $row = mysqli_fetch_array($thucHien );
                    echo'
                <form action="../../QuanTriHeThong/CanBoHuongDan/ThucHienCapNhat_cb.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                    <div class="KhungTongQuat">
                    <div class="KhungDau">
                        <div class="Dau1">
                            <img src="https://beebom.com/wp-content/uploads/2023/04/featured-new.jpg?w=290&h=290&crop=1&quality=75" alt="">
                        </div>
                        <div class="Dau2">
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
                                    <p>Mã số cán bộ hướng dẫn:</p>
                                </td>
                                <td>
                                    <input name="MSCB" type="text" value="'.$row['MSCB'].'"/>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <p>Mã đơn vị thực tập:</p>
                                </td>
                                <td>
                                    <input name="MaDVTT" type="text" value="'.$row['MaDVTT'].'"/>
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
                    <div class="KhungDuoi">
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
                }
                //Nếu chữ cái đầu là gvhd Thì lấy thông tin -- Giảng viên
                if(LayChuoiChuCaiDau($maSo) == "gvhd"){
                    $timKiem = "SELECT * From giangvienhuongdan gv INNER JOIN taikhoan tk on tk.UserID = gv.MSGV
                                WHERE gv.MSGV = '$maSo'";
                    $thucHien = mysqli_query($connect,$timKiem) or die(mysqli_connect_error());
                    $row = mysqli_fetch_array($thucHien );
                    echo'
                        <form action="../../QuanTriHeThong/GiaoVienHuongDan/ThucHienCapNhat_gv.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                            <div class="KhungTongQuat">
                            <div class="KhungDau">
                                <div class="Dau1">
                                    <img src="https://beebom.com/wp-content/uploads/2023/04/featured-new.jpg?w=290&h=290&crop=1&quality=75" alt="">
                                </div>
                                <div class="Dau2">
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
                                            <p>Mã số giáo viên hướng dẫn:</p>
                                        </td>
                                        <td>
                                            <input name="MSGV" type="text" value="'.$row['MSGV'].'"/>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                            <p>Mã lớp:</p>
                                        </td>
                                        <td>
                                            <input name="MaKhoa" type="text" value="'.$row['MaKhoa'].'"/>
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
                            <div class="KhungDuoi">
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
                }
                //Nếu chữ cái đầu là dvtt Thì lấy thông tin -- Đơn vị thực tập
                if(LayChuoiChuCaiDau($maSo) == "dvtt"){
                    $timKiem = "SELECT * From donvithuctap dvtt INNER JOIN taikhoan tk on tk.UserID = dvtt.MaDVTT
                                WHERE dvtt.MaDVTT = '$maSo'";
                    $thucHien = mysqli_query($connect,$timKiem) or die(mysqli_connect_error());
                    $row = mysqli_fetch_array($thucHien );
                    echo'
                        <form name="BieuMauCapNhat_dvtt" action="../../QuanTriHeThong/DonViThucTap/ThucHienCapNhat.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                            <div class="KhungThongNhat">
                            <div class="KhungDau">
                                <div class="Dau1">
                                <img src="https://beebom.com/wp-content/uploads/2023/04/featured-new.jpg?w=290&h=290&crop=1&quality=75" alt="">
                                </div>
                                <div class="Dau2">
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
                            <div class="KhungDuoi">
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
                }
                //Nếu chữ cái đầu là quantri Thì lấy thông tin -- Quản trị viên
                if(LayChuoiChuCaiDau($maSo) == "quantri"){
                    echo'
                        <form action="../../QuanTriHeThong/CanBoHuongDan/ThucHienCapNhat_cb.php" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauCapNhat">
                            <div class="KhungCapNhatTaiKhoan">
                                    <table>
                                        <tr>
                                            <td>
                                                <p>UserID:</p>
                                            </td>
                                            <td>
                                                <input name="UserID" type="text" value="'.$row['UserID'].'"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>User role:</p>
                                            </td>
                                            <td>
                                                <input name="UserRole" type="text" value="'.$row['UserRole'].'"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>Mật khẩu:</p>
                                            </td>
                                            <td>
                                                <input name="MatKhau" type="text" value="'.$row['MatKhau'].'"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button type="submit" class="NutDangNhap">Cập nhật</button>
                                            </td>
                                        </tr>
                                    </table>
                            </div>
                        </form>
                        ';   
                }
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
