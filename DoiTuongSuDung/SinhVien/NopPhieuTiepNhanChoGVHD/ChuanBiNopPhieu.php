<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ sinh viên thực tập</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/SinhVien/SinhVien.css">
        <style>
            .TruongXetDuyetSinhVien{
                display: none;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>
        <!--PHP-->
        <?php 
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');
            //Lấy thông tin Get
            $maSo = trim($_GET['ID']);
            $role = intval($_GET['Role']);
            $MaSoGiaoVien = "";
            //Nếu là giáo viên thì không hiển thị nút nộp && Hiển thị nút xét duyệt hoặc nút hủy
            //Hoặc nếu giáo viên đã chấp nhận cho thực tập thì cũng không hiện phần này
            if($role == 2){
                if(KiemTraMSGV_PhieuTheoDoiDuaTrenSV($maSo)+KiemTraMSGV_PhieuGiaoViecDuaTrenSV($maSo) < 2){
                    $MaSoGiaoVien = $role;  //Gán lấy mã số
                    echo "<style>
                            .TruongNopPhieuGioiThieu{
                                display: none;
                            }
                        </style>";
                    echo "<style>
                        .TruongXetDuyetSinhVien{
                            display: flex;
                        }
                    </style>";
                }
                echo "<style>
                        .TruongNopPhieuGioiThieu{
                            display: none;
                        }
                    </style>";
            }//Nếu là đơn vị thực tập vào xem thì cũng xóa phần nộp
            else if($role == 3){
                echo "<style>
                        .TruongNopPhieuGioiThieu{
                            display: none;
                        }
                    </style>";
            }
            
            //------- ĐK trở về trang trước ---------

            //1.Kiểm tra sinh viên có được đơn vị thực tập nào chấp nhận không. Nếu có thì được vào.
            //1.1Ngược lại thông báo không thành công và trở ra ngoài
            $KiemTraDK1 = mssv_PhieuTiepNhanSinhVien(trim($maSo));
            
            //>>>Lấy thông tin
            $ThongTinDonViThucTap = infDonViThucTap($KiemTraDK1['MaDVTT']);
            $ThongTinCanBoHuongDan = infCanBoHuongDan(($KiemTraDK1['MSCB']));
            $ThongTinSinhVien = infSinhVien($maSo);
 
            //Kiểm tra nếu là giáo viên vào xem mà sinh viên chưa được đơn vị thực tập chấp nhận thì cũng thoát ra
            if(!empty($MaSoGiaoVien) and empty($KiemTraDK1['MSCB'])){
                echo'<script>
                        alert("Sinh viên này chưa được đơn vị thực tập phê duyệt nên không thể xem.");
                        history.back();
                    </script>';
            }
            //Kiểm tra nếu sinh viên chưa được đơn vị thực tập cahaaps nhậ thì hiển thị thông báo sao
            else if(empty($KiemTraDK1['MSCB'])){
                echo'<script>
                        alert("Bạn vui lòng đăng ký thực tập tại đơn vị thực tập trước chờ đến khi đơn vị thực tập chấp nhận thì mới được sử dụng chức năng này.");
                        history.back();
                    </script>';
                    echo '<p>MSCB: '.$KiemTraDK1['MSCB'].'</p>';
            }else{
                //2.Kiểm tra xem sinh viên có được giáo viên hướng dẫn chấp nhận không. Nếu đã được chấp nhận thì chỉ được quyền xem
                //2.Ngược lại thì nộp
            }
            

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
                    <a href="../TrangChuSinhVien.php?ID=<?php echo $_GET['ID'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main class="Main_ChuanBiNopPhieu">
            <div class="TongQuanPhieuNopThucTap">
                <table class="BangThongTin">
                    <tr>
                        <th colspan="2">
                            <h2 class="TieuDePhieuTiepNhanSinhVienThucTap">
                                PHIẾU TIẾP NHẬN SINH VIÊN THỰC TẬP THỰC TẾ <br>
                                Thời gian thực tập: 8 tuần từ 
                                <?php
                                    $ThoiHanThucTap = ThongTinDotThucTap('2023');
                                    echo ngayThangNam_VN($ThoiHanThucTap['ngayBatDau'])." đến ".ngayThangNam_VN($ThoiHanThucTap['ngayKetThuc']);
                                ?>
                            </h2>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <p>Tên cơ quan: <?php echo $ThongTinDonViThucTap['TenDVTT'];?></p>
                            <p>Số điện thoại (đề nghị ghi rõ để tiện liên hệ): <?php echo $ThongTinDonViThucTap['SDT'];?></p>
                            <p>Ðịa chỉ: <?php echo $ThongTinDonViThucTap['DiaChi'];?></p>
                        </td>
                        <td>
                            <p>Họ tên cán bộ phụ trách : <?php echo $ThongTinCanBoHuongDan['HoTen'];?></p>
                            <p>Điện thoại: <?php echo $ThongTinCanBoHuongDan['SDT'];?></p>
                            <p>Email cán bộ phụ trách: <?php echo $ThongTinCanBoHuongDan['Email'];?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Cơ quan có điều kiện cho SV thực tập gồm: 
                                <?php
                                    //Lấy cơ sở vật chất thực tập
                                    $LayDKTT = "SELECT *
                                    FROM chitietphieutiepnhansinhvienthuctapthucte ct INNER JOIN dieukiencosothuctap dk ON ct.ID_DK = dk.ID_DK
                                                                                    INNER JOIN phieutiepnhansinhvienthuctapthucte p ON ct.MSPXNTT = p.MSPXNTT
                                                                                    INNER JOIN sinhvien sv ON sv.MSSV = p.MSSV
                                    WHERE sv.mssv= '$maSo'";
                                    $ThucHienLayDKTT = TruyVan($LayDKTT);
                                    while($row = mysqli_fetch_array($ThucHienLayDKTT)){
                                        echo"<span>".$row['VatChat'].". </span>";
                                    }
                                ?> 
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Đồng ý nhận sinh viên: </p>
                            <p>Họ tên: <?php echo $ThongTinSinhVien['HoTen'];?></p>
                            <p>MASV: <?php echo $ThongTinSinhVien['MSSV'];?></p>
                        </td>
                        <td>
                            <p>Mã Lớp: <?php echo $ThongTinSinhVien['MaLop'];?></p>
                            <p>Ngành: <?php echo NganhHocCuaSinhVien($ThongTinSinhVien['MaLop'])['TenNganh'];?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Dự kiến các công việc sẽ giao cho sinh viên thực hiện, chỉ ghi nội dung chính (chưa cần
                            phải ghi chi tiết) để Khoa xét duyệt xem có phù hợp với đề cương và sinh viên có thể thực hiện
                            được không</p>
                       </td>
                    </tr>
                </table>
                <div class="KhungNoiDungCongViec">
                    <form action="ThucHienNopGiayTiepNhan.php" method="post" enctype="application/x-www-form-urlencoded" autocomplete="off">
                        <table class="BangNoiDungCongViec">
                            <tr class="TieuDeNoiDung">
                                <th >Tuần</th>
                                <th >Nội dung công việc – bắt buộc phải có <h3>Lưu ý: Công việc được thực hiện trong 8 tuần</h3></th>
                                <th >Dự kiến số ngày SV sẽ có mặt tại nơi thực tập Tối thiểu 24 giờ/ 1 tuần</th>
                            </tr>
                            <?php
                                $LayNoiDungCV = "SELECT *
                                FROM phieutiepnhansinhvienthuctapthucte ptn INNER JOIN chitietphieudanhgiavaphieutheodoi ct ON ptn.MSPXNTT = ct.MSPXNTT
                                WHERE ptn.MSSV = '$maSo'";
                                $thucHien1 = TruyVan($LayNoiDungCV);
                                while($row = mysqli_fetch_array($thucHien1)){
                                    echo"<tr>";
                                        echo"<td>".$row['tuan']."</td>";
                                        echo"<td>".infCongViec($row['IDCongViec'])['NoiDung']."</td>";
                                        echo"<td>
                                                <div><span>".infCongViec($row['IDCongViec'])['GioLamViec']." giờ/buổi</span></div>
                                                <div><span>".infCongViec($row['IDCongViec'])['BuoiLamViec']." buổi/tuần</span></div>
                                            </td>";
                                    echo"</tr>";
                                }
                                //Những thông tin cần gửi:
                                echo"<input type='hidden' name='MSSV' value=".$KiemTraDK1['MSSV'].">";
                                echo"<input type='hidden' name='MSGV' value=".$KiemTraDK1['MSGV'].">";
                            ?>
                            <tr class="TruongNopPhieuGioiThieu">
                                <td colspan="3">
                                    <button type="submit" class="NutDangNhap"> Nộp</button>
                                </td>
                            </tr>
                        </table>
                        <div class="TruongXetDuyetSinhVien">
                            <a class="NutDuyetSV" href="../../GiaoVienHuongDan/ThucHienXemXet/ThucHienDuyet.php?MSSV=<?php echo $maSo;?>&MSGV=<?php echo $MaSoGiaoVien;?>">Duyệt</a>
                            <a class="NutKhongDuyetSV" href="../../GiaoVienHuongDan/ThucHienXemXet/ThucHIenKhongPheDuyet.php?MSSV=<?php echo $maSo;?>&MSGV=<?php echo $MaSoGiaoVien;?>">Không phê duyệt</a>
                        </div>
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