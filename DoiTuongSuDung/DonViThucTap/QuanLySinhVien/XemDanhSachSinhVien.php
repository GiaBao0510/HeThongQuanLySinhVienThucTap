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
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>
        <script src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" async></script>
    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuDVTT.php?ID=<?php echo $_GET['ID']; ?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <!--
                lấy Mã số đơn vị thực tập
            -->
            <?php
                include('../../TrangDungChung/CacHamXuLy.php');
                include('../../TrangDungChung/KetNoi.php');
                $mdvtt = trim($_GET['MDVTT']);
                $role = mysqli_fetch_array(infTaiKhoan($mdvtt))['UserRole'];
            ?>
            <div>
                <table class="BangDanhSachSinhVien">
                    <tr class="TieuDeBangDanhSachSV">
                        <th colspan="8">
                            <h2>Danh sách sinh viên</h2>
                        </th>
                    </tr>
                    <tr class="TieuDeBangDanhSachSV">
                        <th>Mã số sinh viên</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Khoa</th>
                        <th>Ngành</th>
                        <th>Xem phiếu giao việc</th>
                    </tr>
                    <?php
                        //Lấy thông tin sinh viên đã có trên phiếu tiếp nhận thực tập
                        $sinhVienTaiDVTT = madvtt_PhieuTiepNhanSinhVien($mdvtt);
                        while($row = mysqli_fetch_array($sinhVienTaiDVTT)){
                            
                            //Kiểm tra nếu trên bảng theo dõi và bảng giao việc tại các bộ hướng dẫn thì hiển thị
                            $mssv = trim($row['MSSV']);
                            $kt_mssv_GVTD = "SELECT td.MSCB 
                                            FROM phieugiaoviecsinhvienthuctap gv 
                                            INNER JOIN phieutheodoisinhvienthuctap td ON gv.MSSV = td.MSSV
                                            WHERE gv.MSSV = '$mssv'";
                            if(!empty(mysqli_fetch_array(TruyVan($kt_mssv_GVTD)))){
                                $macb = trim(mysqli_fetch_array(TruyVan($kt_mssv_GVTD))['MSCB']);
                                $infor_svtt = infSinhVien($mssv);
                                $MaNganh = trim(NganhHocCuaSinhVien(trim($infor_svtt['MaLop']))['MaNganh']);
                                $TenNganh = trim(NganhHocCuaSinhVien(trim($infor_svtt['MaLop']))['TenNganh']);
                                $TenKhoa = NganhThuocKhoa($MaNganh)['tenKhoa'];
                                echo"<tr>
                                    <td>".$infor_svtt['MSSV']."</td>
                                    <td>".$infor_svtt['HoTen']."</td>
                                    <td>".$infor_svtt['GioiTinh']."</td>
                                    <td>".$infor_svtt['NgaySinh']."</td>
                                    <td>".$TenKhoa."</td>
                                    <td>".$TenNganh ."</td>
                                    <td><a class='CT_PhieuTiepNhanTHucTap' href='../../SinhVien/NopPhieuTiepNhanChoGVHD/ChuanBiNopPhieu.php?ID=".$mssv."&Role=".$role."'>Chi tiết phiếu <br>tiếp nhận sinh viên</a></td>";
                    ?>
                    <?php     
                                echo"</tr>";
                            }
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