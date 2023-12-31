<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhập
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nộp file báo cáo</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/SinhVien/SinhVien.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/SinhVien/NopCV/KiemTraNopCV.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--
            PHP
        -->
        <?php
            $mssv = $_SESSION['user'];
            $ttSinhVien = infSinhVien($mssv);
        ?>
    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <form action="../../TrangDungChung/ThucHienDangXuat.php" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="taikhoan" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" name="matkhau" value="<?php echo $_SESSION['pw'];?>">
                        <input type="hidden" name="vaitro" value="<?php echo $_SESSION['role'];?>">
                        <input type="hidden" name="loithoat" value="../TrangDungChung/index.php">
                        <button type="submit" class="NutThoat">
                            <i class="fa-solid fa-door-open"></i>Thoát
                        </button>
                    </form>
                    <a href="../TrangChuSinhVien.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main> 
            <div>
                <form action="ThucHienNopDetai.php" method="post" enctype="multipart/form-data">
                    <table class="BangNopFileBaoCao">
                        <tr>
                            <td colspan="2">
                                <h1 class="tieuNopBaoCao">BÁO CÁO KẾT QUẢ THỰC TẬP</h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="CotThongTinNopFile">
                                Mã số sinh viên: <?php echo $ttSinhVien['MSSV'];?>
                            </td>
                            <td class="CotThongTinNopFile">
                                Mã lớp: <?php echo $ttSinhVien['MaLop'];?>
                            </td>
                        </tr>
                        <tr>
                            <td class="CotThongTinNopFile">
                                Họ tên: <?php echo $ttSinhVien['HoTen'];?>
                            </td>
                            <td class="CotThongTinNopFile">
                                Ngành: <?php echo NganhHocCuaSinhVien($ttSinhVien['MaLop'])['TenNganh'];?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="CotThongTinNopFile">
                                <p>Nộp file báo cáo thực tập tại đây:</p>
                                <input id="oNopBaoCao" name="fileToUpload" type="file"/>
                            </td>
                        </tr>
                    </table>
                    <div>
                        <button type="submit" class="NutNopFile" name="submit">Submit</button>
                    </div>
                </form>
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