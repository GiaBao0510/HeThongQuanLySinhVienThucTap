<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
?>
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
            .TruongThongBaoXetDuyet,.TruongThongBaoDaNopPhieu{
                display: none;
                background-color: aquamarine;
                text-align: center;
                margin-bottom: 3vw;
                padding: 2vw;
                font-style: italic;
                font-size: 1.5em;
                font-weight: 550;
                color: #034200;
            }
            .TruongThongBaoDaNopPhieu{
                background-color: cornflowerblue;
                color: #0007dd;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>
        <!--PHP-->
        <?php
            if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
                include('../../TrangDungChung/DangNhapThatBai.php');
            }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
                include('../../TrangDungChung/DangNhapThatBai.php');
            }
            //Lấy thông tin Get
            $maSo = $_GET['ID'];
            //Kiểm tra đăng nhập

            $role = intval($_GET['Role']);
            $MaSoGiaoVien = "";
            $KiemTraXetDuyet = intval(KiemTraMSGV_PhieuTheoDoiDuaTrenSV($maSo) + KiemTraMSGV_PhieuGiaoViecDuaTrenSV($maSo));
            $KiemTraDK1 = mssv_PhieuTiepNhanSinhVien(trim($maSo));

            //Nếu là giáo viên thì không hiển thị nút nộp && Hiển thị nút xét duyệt hoặc nút hủy
            //Hoặc nếu giáo viên đã chấp nhận cho thực tập thì cũng không hiện phần này
            if($role == 2){
                if(KiemTraMSGV_PhieuTheoDoiDuaTrenSV($maSo)+KiemTraMSGV_PhieuGiaoViecDuaTrenSV($maSo) < 2){
                    $MaSoGiaoVien = $_GET['MSGV'];  //Gán lấy mã số
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
            }//Nếu là sinh viên mà giáo viên phê duyệt cho thực tập thì thông báo cho sinh viên
            else if($role == 1 AND $KiemTraXetDuyet == 2){
                echo "<style>
                        .TruongThongBaoXetDuyet{
                            display: block;
                        }
                        .TruongNopPhieuGioiThieu,.TruongThongBaoDaNopPhieu{
                            display: none;
                        }

                    </style>";
                if($maSo !== $_SESSION['user']){
                    include('../../TrangDungChung/DangNhapThatBai.php');
                }
            }//Nếu sinh viên đã nộp giấy tiếp nhận rồi thì không cần nộp nữa
            elseif(SoLuongPhieuTieGiaoViec_SV_GV($maSo,$KiemTraDK1['MSGV']) > 0){
                echo "<style>
                        .TruongNopPhieuGioiThieu{
                            display: none;
                        }
                        .TruongThongBaoDaNopPhieu{
                            display: block;
                        }
                    </style>";
            }
            
            //------- ĐK trở về trang trước ---------

            //1.Kiểm tra sinh viên có được đơn vị thực tập nào chấp nhận không. Nếu có thì được vào.
            //1.1Ngược lại thông báo không thành công và trở ra ngoài
            
            
            //>>>Lấy thông tin
            $ThongTinDonViThucTap = infDonViThucTap($KiemTraDK1['MaDVTT']);
            $ThongTinCanBoHuongDan = getCanBoHuongDan(($KiemTraDK1['MSCB']));
            $ThongTinSinhVien = getSinhVien($maSo);
 
            //Kiểm tra nếu là giáo viên vào xem mà sinh viên chưa được đơn vị thực tập chấp nhận thì cũng thoát ra
            if(!empty($MaSoGiaoVien) and empty($KiemTraDK1['MSCB'])){
                echo'<script>
                        alert("Sinh viên này chưa được đơn vị thực tập phê duyệt nên không thể xem.");
                        history.back();
                    </script>';
            }
            //Kiểm tra nếu sinh viên chưa được đơn vị thực tập cập nhật thì hiển thị thông báo sao
            else if(empty($KiemTraDK1['MSCB'])){
                // echo'<script>
                //         alert("Bạn vui lòng đăng ký thực tập tại đơn vị thực tập trước chờ đến khi đơn vị thực tập chấp nhận thì mới được sử dụng chức năng này.");
                //         history.back();
                //     </script>';
                    echo '<p>MSCB: '.$KiemTraDK1['MSCB'].'</p>';
            }else{
                
            
            

        ?>
    </head>
    
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <!--trang chu sinh vien-->
                <?php
                    if($_SESSION['role'] == 1){
                ?>
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
                <!--trang chu giao vien-->
                <?php
                    }elseif($_SESSION['role'] == 2){
                ?>
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
                        <a href="../../GiaoVienHuongDan/TrangChuGiaoVien.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                    </div>
                <?php
                    }elseif($_SESSION['role'] == 3){
                ?>
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
                        <a href="../../DonViThucTap/TrangChuDVTT.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                    </div>
                <?php
                    }elseif($_SESSION['role'] == 4){
                ?>
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
                        <a href="../../CanBoHuongDan/TrangChuCanBoHuongDan.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                    </div>
                <?php
                    }
                ?>
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
                                <th >Dự kiến số ngày SV sẽ có mặt tại nơi thực tập <br> Tối thiểu 24 giờ/ 1 tuần</th>
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
                        <div class="TruongThongBaoXetDuyet">
                            <p>Giáo viên đã duyệt</p>
                        </div>
                        <div class="TruongThongBaoDaNopPhieu">
                            <p>Đã nộp phiếu tiếp nhận thực tập</p>
                        </div>
                    </form>
                </div>
            </div>
<!--
    Điểm end
-->            
            <?php
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