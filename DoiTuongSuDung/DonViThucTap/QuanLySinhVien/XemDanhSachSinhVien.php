<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách chờ phê duyệt</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <style>
            .TieuDeBangDanhSachCBHD th{
                background-color: #1b1a1a;
                color: #eee;
            }   
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>
        <script src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" async></script>
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script defer src="../../../RangBuoc/DonViThucTap/CauHinhBangDVTT.js"></script>
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

            $mdvtt = $_SESSION['user'];
            $role = mysqli_fetch_array(infTaiKhoan($mdvtt))['UserRole'];
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
                    <a href="../TrangChuDVTT.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div>
                <h2 class="TieuDeDanhSach">Danh sách sinh viên</h2>
                <table id="CanChinhBangSinhVienTaiDVTT" class="BangDanhSachSinhVien table table-striped">
                    <thead>
                        <tr class="TieuDeBangDanhSachCBHD">
                            <th>Mã số sinh viên</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Khoa</th>
                            <th>Ngành</th>
                            <th>Phiếu giao việc</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //Lấy thông tin sinh viên đã có trên phiếu tiếp nhận thực tập
                            $sinhVienTaiDVTT = SinhVienTai_DonViThucTap($mdvtt);
                            while($row = mysqli_fetch_array($sinhVienTaiDVTT)){
                                
                                //Kiểm tra nếu trên bảng theo dõi và bảng giao việc tại các bộ hướng dẫn thì hiển thị
                                $mssv = trim($row['MSSV']);
                                $kt_mssv_GVTD = "SELECT td.MSCB 
                                                FROM phieugiaoviecsinhvienthuctap gv 
                                                INNER JOIN phieutheodoisinhvienthuctap td ON gv.MSSV = td.MSSV
                                                WHERE gv.MSSV = '$mssv'";
                                if(!empty(mysqli_fetch_array(TruyVan($kt_mssv_GVTD)))){
                                    $macb = trim(mysqli_fetch_array(TruyVan($kt_mssv_GVTD))['MSCB']);
                                    $infor_svtt = getSinhVien($mssv);
                                    $nganhHoc = NganhHocCuaSinhVien($infor_svtt['MaLop']);
                                    $khoa = infKhoa($nganhHoc['MaKhoa'])['tenKhoa'];
                                    echo"<tr>
                                        <td>".$infor_svtt['MSSV']."</td>
                                        <td>".$infor_svtt['HoTen']."</td>
                                        <td>".$infor_svtt['GioiTinh']."</td>
                                        <td>".$infor_svtt['NgaySinh']."</td>
                                        <td>".$khoa."</td>
                                        <td>".$nganhHoc['TenNganh'] ."</td>
                                        <td><a class='NutXemChiTietPGV' href='../../SinhVien/NopPhieuTiepNhanChoGVHD/ChuanBiNopPhieu.php?ID=".$mssv."&Role=".$role."'>Xem</a></td>";
                        ?>
                        <?php     
                                    echo"</tr>";
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="TieuDeBangDanhSachCBHD">
                            <th>Mã số sinh viên</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Khoa</th>
                            <th>Ngành</th>
                            <th>Phiếu giao việc</th>
                        </tr>
                    </tfoot>
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