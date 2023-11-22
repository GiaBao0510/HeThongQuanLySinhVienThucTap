<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Phiếu theo dõi sinh viên thực tập</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/CanBoHuongDan/CBHD.css">
        <style>
            body{
                background-color: lightsteelblue;
            }
            .BangChinhThongTinPhieuTheoDoi{
                background-color: #fff;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <!--PHP-->
        <?php
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');

            $mssv = trim($_GET['MSSV']);
            $mscb = trim($_GET['MSCB']);

            //Lấy thông tin qua hàm
            $TTsinhVien = infSinhVien($mssv);
            $TTcanBo = infCanBoHuongDan($mscb);
            $TTphieuTheoDoi = mysqli_fetch_array(mscb_PhieuTheoDoiThucTap($mscb));
            $ThoiDiemThucTap = ThongTinDotThucTap(date('Y'));
            $TTdonViThucTap = infDonViThucTap($TTcanBo['MaDVTT']);

            /*echo "<p>Mã số cán bộ: ".$mscb."</p>";
                    echo "<p>Mã số sinh viên: ".$mssv."</p>";
                    echo "<p>Mã số phiếu Theo dõi: ".$ThongTinPhieuTheoDoi['MSPTDSV']."</p>";*/
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
            <div class="BangChinhThongTinPhieuTheoDoi">
                <div class="ThongTinPhieuTheoDoi">
                    <h1 class="TieuDePhieuTheoDoi">PHIẾU THEO DÕI SINH VIÊN THỰC TẬP THỰC TẾ</h1>
                    <table class="BangThongTinPhieuTheoDoi">
                        <tr>
                            <td>
                                <p>Họ tên sinh viên: <span class="ThongTinLayDuoc"> <?php echo $TTsinhVien['HoTen']; ?></span> </p>
                            </td>
                            <td>
                                <p>Mã số sinh viên:  <span class="ThongTinLayDuoc"><?php echo $TTsinhVien['MSSV']; ?></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Cơ quan thực tập: <span class="ThongTinLayDuoc"><?php echo $TTdonViThucTap['TenDVTT']; ?></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Họ và tên cán bộ hướng dẫn: <span class="ThongTinLayDuoc"> <?php echo $TTcanBo['HoTen']; ?></span> </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Thời gian thực tập: <span class="ThongTinLayDuoc"><?php echo ngayThangNam_VN($ThoiDiemThucTap['ngayBatDau']); ?> </span> đến <span class="ThongTinLayDuoc"><?php echo ngayThangNam_VN($ThoiDiemThucTap['ngayKetThuc']); ?></span></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="ThongTinDanhGia">
                    <form action="ThucHienCapNhatNhanXetSinhVien.php?MSCB=<?php echo $mscb;?>&MSPTDSV=<?php echo $TTphieuTheoDoi['MSPTDSV'];?>" method="post" enctype="application/x-www-form-urlencoded">
                        <table class="BangThongTinDanhgia">
                            <tr class="DongTieuDe">
                                <th>Tuần</th>
                                <th>Nội dung công việc được giao</th>
                                <th>Nhận xét của cán bộ hướng dẫn</th>
                                <th>Số buổi</th>
                            </tr>
                            
                            <?php
                                $ttPhieuTheoDoi_SV_CB = mscb_mssv_PhieuThoeDoiThucTap($mscb,$mssv);
                                $msptdsv = trim($ttPhieuTheoDoi_SV_CB['MSPTDSV']);
                                $TTchiTietPhieuDanhGiaVaTheoDoi = msptd_ChiTietPhieuTheoDoiVaPhieuDanhGia($msptdsv);
                                $NhanXetCoSan = "";
                                while($row = mysqli_fetch_array($TTchiTietPhieuDanhGiaVaTheoDoi)){
                                    //Kiểm tra xem nhận xết có rồng không nếu rồng thì đặt là ô khoảng trắng
                                    $NhanXetCoSan = strval(LayNhanXetTuBangChiTietDanhGiaVaTheoDoi($row['IDCongViec'],$msptdsv)['NhanXet']);
                                    if(strlen($NhanXetCoSan) <1){
                                        $NhanXetCoSan = "";
                                    }
                                    echo '<tr>
                                            <td>'.$row['tuan'].'</td>
                                            <td>'.infCongViec($row['IDCongViec'])['NoiDung'].'</td>
                                            <td class="CotGhiNhanXet">
                                                <input type="hidden" name="IDcongViec[]" value='.$row['IDCongViec'].'>
                                                <textarea  name="NhanXet[]" type="text" class="OghiNhanXet" placeholder="Đánh giá tiến độ công việc">'.$NhanXetCoSan.'</textarea>
                                            </td>
                                            <td>'.infCongViec($row['IDCongViec'])['BuoiLamViec'].'</td>
                                        </tr>';
                                }
                            ?>
                            <tr>
                                <td colspan="5">
                                    <input type="hidden" name="MSSV" value='<?php echo $mssv; ?>'>
                                    <button type="submit" class="NutCapNhat">Cập nhật</button>
                                </td>
                            </tr>
                        </table>
                    </form>
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