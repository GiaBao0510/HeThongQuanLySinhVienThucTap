<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách sinh viên nhận hướng dẫn thực tập</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/CanBoHuongDan/CBHD.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <!--PHP-->
        <?php
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');
            $mscb = $_GET['MSCB'];
            $ThongTinPhieuTheoDoi = mscb_PhieuTheoDoiThucTap($mscb);
        ?>
    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuCanBoHuongDan.php?ID=<?php echo $_GET['ID'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="DinhDangViTriBang">
                <table class="BangNhanXetSinhVien">
                    <tr class="DongTieuDe">
                        <th>Mã số sinh viên</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Khoa</th>
                        <th>Ngành</th>
                        <th>Nhận xét</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($ThongTinPhieuTheoDoi)){
                            $ThongTinSV = infSinhVien($row['MSSV']);
                            $MaNganh = trim(NganhHocCuaSinhVien(trim($ThongTinSV['MaLop']))['MaNganh']);
                            $TenNganh = trim(NganhHocCuaSinhVien(trim($ThongTinSV['MaLop']))['TenNganh']);
                            $TenKhoa = NganhThuocKhoa($MaNganh)['tenKhoa'];
                            echo '<tr class="DongTieuDe">
                                        <td>'.$ThongTinSV['MSSV'].'</td>
                                        <td>'.$ThongTinSV['HoTen'].'</td>
                                        <td>'.$ThongTinSV['GioiTinh'].'</td>
                                        <td>'.$ThongTinSV['NgaySinh'].'</td>
                                        <td>'.$TenKhoa.'</td>
                                        <td>'.$TenNganh.'</td>
                                        <td>
                                        <a href="NhanXetSinhVien.php?MSCB='.$mscb.'&MSSV='.$ThongTinSV['MSSV'].'" class="NutNhanXet">Nhận xét</a>
                                        </td>
                                    </tr>';
                        }
                    ?>
                </table>
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