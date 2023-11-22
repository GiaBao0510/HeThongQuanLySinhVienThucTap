<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách sinh viên hướng dẫn</title>

        <link rel="shortcut icon" href="../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../DinhDangWebSite/GiaoVienHuongDan/GVHD.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script defer src="../../RangBuoc/GiaoVienHuongDan/CauHinhBangGV.js"></script>
        <!--PHP-->
        <?php
            include('../TrangDungChung/KetNoi.php');
            include('../TrangDungChung/CacHamXuLy.php');
            //Lấy Mã số sih viên để hiển thị thông tin
            $maSo = trim($_GET['MSGV']);
            //Lấy số sinh viên hướng dẫn dựa trên mã giáo viên từ phiếu tiếp nhận sinh viên
            $ThongTinPhieuTiepNhanTT = msgv_PhieuTiepNhanSinhVien($maSo);
            $role = mysqli_fetch_array(infTaiKhoan($maSo));
        ?>
    </head>
    <body>
    <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuGiaoVien.php?ID=<?php echo strval($_GET['MSGV'])?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <table id="CanChinhSinhVienPheDuyet" class="banhDanhSachSinhVien">
                <thead>
                    <tr class="TruongTieuDeSinhVienDuocNhan">
                        <th>Mã số sinh viên</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Giấy giới thiệu</th>
                        <th>Phiếu tiếp nhận thực tập</th>
                        <th>Xét duyệt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($ThongTinPhieuTiepNhanTT)){
                            $thongTinSinhVien = mssv_ThongTinSinhVien($row['MSSV']);
                            echo '<tr>
                                    <td>'.$thongTinSinhVien['MSSV'].'</td>
                                    <td>'.$thongTinSinhVien['HoTen'].'</td>
                                    <td>'.$thongTinSinhVien['NgaySinh'].'</td>
                                    <td>'.$thongTinSinhVien['GioiTinh'].'</td>
                                    <td>'.$thongTinSinhVien['Email'].'</td>
                                    <td>'.$thongTinSinhVien['SDT'].'</td>
                                    <td><a class="NutXemGiayGioiThieu" href="../SinhVien/NopCV/GiayGioiThieu.php?ID='.$thongTinSinhVien['MSSV'].'">Xem</a></td>';
                                    echo '<td>';
                                        if(KiemTraSV_DuocNhanThucTapTaiDonVi($thongTinSinhVien['MSSV']) == 1){
                                            echo '<a class="NutXemThongTinTiepNhanThucTap" href="../SinhVien/NopPhieuTiepNhanChoGVHD/ChuanBiNopPhieu.php?ID='.$thongTinSinhVien['MSSV'].'&Role='.$role['UserRole'].'&MSGV='.$maSo.'">Xem công việc được <br>giao cho sinh viên.</a>';
                                        }else{
                                            echo'<div>Sinh viên chưa tìm<br> được đơn vị thực tập</div>';
                                        }
                                    echo '</td>';
                                    echo '<td>';
                                        $KiemTraXetDuyet = intval(KiemTraMSGV_PhieuTheoDoiDuaTrenSV($thongTinSinhVien['MSSV']) + KiemTraMSGV_PhieuGiaoViecDuaTrenSV($thongTinSinhVien['MSSV']));
                                        // echo "<p>MSSV: ".$thongTinSinhVien['MSSV']."</p>";
                                        // echo "<p>Kiểm tra trên phiếu theo dõi: ". intval(KiemTraMSGV_PhieuTheoDoiDuaTrenSV($row['MSSV']))."</p>";
                                        // echo "<p>Kiểm tra trên phiếu giao việc: ". intval(KiemTraMSGV_PhieuGiaoViecDuaTrenSV($row['MSSV']))."</p>";
                                        // echo "<p>Kiểm tra xét duyệt: ".$KiemTraXetDuyet."</p>";
                                        if($KiemTraXetDuyet == 1){
                                            echo '<div>Chưa xét duyệt<br> sinh viên</div>';
                                        }else if($KiemTraXetDuyet == 0){
                                            echo'<div><i class="fa-solid fa-circle-xmark"></i></div>';
                                        }else if($KiemTraXetDuyet == 2){
                                            echo'<div><i class="fa-solid fa-circle-check"></i></div>';
                                        }
                                    echo '</td>';
                            echo'</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="TruongTieuDeSinhVienDuocNhan">
                        <th>Mã số sinh viên</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Giấy giới thiệu</th>
                        <th>Phiếu tiếp nhận thực tập</th>
                        <th>Xét duyệt</th>
                    </tr>
                </tfoot>
            </table>
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