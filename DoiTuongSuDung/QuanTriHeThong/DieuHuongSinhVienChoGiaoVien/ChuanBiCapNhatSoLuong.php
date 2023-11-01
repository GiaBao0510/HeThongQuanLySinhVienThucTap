<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cập nhật số lượng thực tập</title> 
        <!--Css-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/GiaoVienHuongDan/GiaoDienTaoTaiKhoanGVHD.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/QuanTriHeThong/GiaoDienQuanTri.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/DieuHuongSinhVienThucTap/DieuHuongSinhVien.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/QuanTriHeThong/DieuHuongSinhVienThucTap.js"></script>
        <?php
            include ('../../TrangDungChung/KetNoi.php');
            include ('../../TrangDungChung/CacHamXuLy.php');

            //Lấy mã giảng viên hướng dẫn
            $mgvhd = trim($_GET['MSGV']);
            echo "<p>".$mgvhd."</p>";
            $GiangVienHD = infGiangVienHuongDan($mgvhd );
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
                    <a href="TrangChuDVTT.php?ID=<?php echo $_GET['ID']; ?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div>
                <table class="BangThongTinCuaGiangVien">
                    <tr>
                        <td colspan="5">
                            <h2>Thông tin giáo viên hướng dẫn</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">Mã số giảng viên: <?php echo $GiangVienHD['MSGV'];?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Họ tên: <?php echo $GiangVienHD['HoTen'];?></td>
                        <td colspan="3">Email: <?php echo $GiangVienHD['Email'];?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Giới tính: <?php echo $GiangVienHD['GioiTinh'];?></td>
                        <td colspan="3">Khoa: <?php echo infKhoa($GiangVienHD['MaKhoa'])['tenKhoa'];?></td>
                    </tr>
                    <!--Kiểm tra xem giảng viên náy có hướng dẫn sinh viên nào hay chưa nếu chưa thì in chưa có sinh viên hướng dẫn-->
                    <?php
                        if(SoLuongSinhVienDuocGiaoVienHuognDan($mgvhd)['soLuong'] < 1){
                            echo'<tr>
                                    <td colspan="5" class="KhungChuaCoSinhVienHuongDan">Chưa có sinh viên để hướng dẫn thực tập</td>
                                </tr>';
                        }else{//Ngược lại thì in ra bảng
                    ?>
                    <!--In ra bảng sinh viên đã được giáo viên nhạn  thực tập-->
                    <tr>
                        <th colspan="5" class="TieuDeThongTinSinhVienDuocGiaoVienNhan">
                            Thông Tin Sinh Viên Hướng Dẫn
                        </th>
                    </tr>
                    <tr>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV cotTieuDeSinhVinhDuocGiaoVienHuongDan">Mã số sinh viên</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV cotTieuDeSinhVinhDuocGiaoVienHuongDan">Họ tên</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV cotTieuDeSinhVinhDuocGiaoVienHuongDan">Lớp</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV cotTieuDeSinhVinhDuocGiaoVienHuongDan">Ngành</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV cotTieuDeSinhVinhDuocGiaoVienHuongDan">Chỉ định</th>
                    </tr>
                    <tr>

                    </tr>
                    <?php
                                $SVDuocNhanHuongDan = SinhVienDuocGVNhanHuongDan($mgvhd);
                                while($row = mysqli_fetch_array($SVDuocNhanHuongDan)){
                                    echo'<tr>
                                            <td class=" cotThemSinhVienChoGV">'.$row['MSSV'].'</td>
                                            <td class=" cotThemSinhVienChoGV">'.infSinhVien($row['MSSV'])['HoTen'].'</td>
                                            <td class=" cotThemSinhVienChoGV">'.infSinhVien($row['MSSV'])['MaLop'].'</td>
                                            <td class=" cotThemSinhVienChoGV">'.NganhHocCuaSinhVien(infSinhVien($row['MSSV'])['MaLop'])['TenNganh'].'</td>
                                            <td class=" cotThemSinhVienChoGV">
                                                <form method="post"> 
                                                    <button name="ThucHienXoaSinhVienKhoiGVHD" value="'.$row['MSSV'].'" type="submit" class="NutXoaSinhVienTuGiangVien">X</button>
                                                </form>
                                            </td>
                                        </tr>';
                                }
                            }
                    ?>
                    <tr>
                        <td colspan="5">
                            <button class="NutDangNhap" id="NutHienThiBangSinhVienChuaNhanHuongDan">Thêm sinh viên</button>
                        </td>
                    </tr>
                </table>
            </div>
            <!--Bảng sinh viên chưa nhận hướng dẫn-->
            <div class="KhungChuyenSinhVienChoGiangVien">
                <div class="NutTat"><i class="fa-regular fa-circle-xmark"></i></div>
                <table class="BangThongTinSinhVienChuanBiThem">
                    <tr>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV">Mã số sinh viên</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV">Họ tên</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV">Lớp</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV">Ngành</th>
                        <th class="CotTieuDeThemSinhVienChoGV cotThemSinhVienChoGV">Chỉ định</th>
                    </tr>
                    <?php
                        $SVChuaNhanHuongDan = SinhVienChuaDuocGVNhanHuongDan();
                        while($row = mysqli_fetch_array($SVChuaNhanHuongDan)){
                            echo'<tr>
                                    <td class=" cotThemSinhVienChoGV">'.$row['MSSV'].'</td>
                                    <td class=" cotThemSinhVienChoGV">'.infSinhVien($row['MSSV'])['HoTen'].'</td>
                                    <td class=" cotThemSinhVienChoGV">'.infSinhVien($row['MSSV'])['MaLop'].'</td>
                                    <td class=" cotThemSinhVienChoGV">'.NganhHocCuaSinhVien(infSinhVien($row['MSSV'])['MaLop'])['TenNganh'].'</td>
                                    <td class=" cotThemSinhVienChoGV">
                                        <form method="post"> 
                                            <button name="ThucHienGhiNhanSinhVien" value="'.$row['MSSV'].'" type="submit" class="NutChuyenSinhVienChoGiangVien">Add </button>
                                        </form>
                                    </td>
                                </tr>';
                        }
                    ?> 
                    <!--Thực hiện ghi nhận sinh viên cho giáo viên hướng dẫn-->
                    <?php
                        //Lệnh sql để ghi nhận
                        if(array_key_exists('ThucHienGhiNhanSinhVien',$_POST)){
                            //echo "<p> Mã số giảng viên: ".$mgvhd." Mã số sinh viên: ".$_POST['ThucHienGhiNhanSinhVien']."</p>";
                            $maSoSinhVien = trim($_POST['ThucHienGhiNhanSinhVien']);
                            $LenhGhiNhan = "UPDATE phieutiepnhansinhvienthuctapthucte SET MSGV = '$mgvhd' WHERE MSSV = '$maSoSinhVien'";
                            $ThucHien = TruyVan($LenhGhiNhan);
                            setcookie('reload','1',time()+1);
                        }
                        //Lệnh xác nhận xóa sinh viên khỏi giáo viên hướng dẫn
                        if(array_key_exists('ThucHienXoaSinhVienKhoiGVHD',$_POST)){
                            //echo "<p> Mã số giảng viên: ".$mgvhd." Mã số sinh viên: ".$_POST['ThucHienGhiNhanSinhVien']."</p>";
                            $maSoSinhVien = trim($_POST['ThucHienXoaSinhVienKhoiGVHD']);
                            $LenhGhiNhan = "UPDATE phieutiepnhansinhvienthuctapthucte SET MSGV = NULL WHERE MSSV = '$maSoSinhVien'";
                            $ThucHien = TruyVan($LenhGhiNhan);
                            setcookie('reload','1',time()+1);
                        }
                        else{
                            echo"<p>Không thấy</p>";
                        }
                    ?>
                </table><a href="../"></a>
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
