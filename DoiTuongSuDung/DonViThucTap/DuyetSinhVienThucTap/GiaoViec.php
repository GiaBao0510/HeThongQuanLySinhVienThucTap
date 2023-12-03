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
        <title>Trang chủ đơn vị thực tập</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/DonViThucTap/RangBuocGiaoViec.js" async></script>
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>

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
            <div class="KhungVienBenNgoai">
                <form action="ThucHienLuuGiaoViec.php?MSPXNTT=<?php echo$_GET['MSPXNTT'];?>&MSSV=<?php echo$_GET['MSSV'];?>" method="post" enctype="application/x-www-form-urlencoded" class="BieuMauGiaoViec" name="bieuMauGiaoViec" onsubmit="return BieuMauGiaoViec()">
                    <div class="ThongTinPhieuTiepNhan">
                        <h1>
                            Phiếu giao việc cho sinh viên thực tập thực tế <br>
                            Thời gian thực tập thực: 8 tuần từ <?php  echo date('d-m-Y',strtotime( ThongTinDotThucTap('2023')['ngayBatDau']))." đến ".date('d-m-Y',strtotime( ThongTinDotThucTap('2023')['ngayKetThuc']));?>
                        </h1>
                    </div>
                    <table>
                        <tr class="NoiDungTieuDeGiaoViec">
                            <td class="TieuDeBangXetDuyet_GV">Tuần</td>
                            <td class="TieuDeBangXetDuyet_GV">Nội dung công việc được giao <br>(Phù hợp với đề cương)</td>
                            <td class="TieuDeBangXetDuyet_GV GioLamViec">Số buổi hoặc giờ sinh viên làm việc tại cơ quan trong 1 tuần (Phải >= 6 buổi tương đương 24 giờ)</td>
                        </tr>
                        <!--
                            PHP
                        -->
                        <?php
                            //Lấy tuần thực tập
                            $TruyVanTuanThucTap = "SELECT *
                                                    FROM tuanthuctap
                                                    WHERE NgayKetThuc LIKE '".date('Y')."%'";
                            $LayTuanThucTap = TruyVan($TruyVanTuanThucTap);

                            //Lấy số lượng các bộ hướng dẫn dựa trên mã dvtt
                            $maDVTT = $_SESSION['user'];
                            $truyVanSoLuongCanBo = "SELECT *
                                                    FROM canbohuongdan
                                                    WHERE MaDVTT = '$maDVTT'";
                            $LaySL_CanBo = TruyVan($truyVanSoLuongCanBo);

                            $i = 1;
                            while($row = mysqli_fetch_array($LayTuanThucTap)){
                                    echo '<tr>
                                    <td>
                                        <div class="TuanLamViec">
                                            <p>'.$i.' <input type="hidden" name="Tuan[]" value="'.$i.'"/> </p>
                                            <p>Từ ngày</p>
                                            <p>'.date('d-m-Y',strtotime( $row['NgayBatDau'])).'</p>
                                            <p>đến ngày</p>
                                            <p>'.date('d-m-Y',strtotime( $row['NgayKetThuc'])).'</p>
                                        </div>
                                    </td>
                                    <td class="CotNoiDungCongViec">
                                        <textarea name="congViec[]" class="TruongDiaChi"></textarea>
                                    </td>
                                    <td>
                                        <div class="CotDienThoiGianLam">
                                            <div>
                                                <input name="Gio[]" type="number" class="DienThoiGianLam" value="7">
                                                <span class="PhanGiaoViec">giờ/buổi</span>
                                            </div>
                                            <div>
                                                <input name="Buoi[]" type="number" class="DienThoiGianLam" value="6">
                                                <span class="PhanGiaoViec">buổi/tuần</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                                $i+=1;
                            }
                        
                        echo'<tr>
                                <td colspan="1">
                                    <p class="ChonCanBo">Chọn cán bộ hướng dẫn</p>
                                </td>
                                <td colspan="2">
                                    <select class="ChonCanBoHuongDanSV" name="MSCB">';
                                    while($row = mysqli_fetch_array($LaySL_CanBo)){
                                        echo'<option value='.$row['MSCB'].'>'.$row['HoTen'].'</option>';
                                    }    
                        echo'       </select>
                                </td>
                            </tr>';
                        ?>
                        <!--
                            PHP
                        -->
                            <tr>
                                <td colspan="2">
                                    <p class="ChonCanBo">Cơ quan có đủ điều cho sinh viên thực tập gồm</p>
                                </td>
                                <td colspan="1">
                                    <?php 
                                        //lấy thông tin điều kiện thực tập
                                        $DKTT = "SELECT * FROM dieukiencosothuctap";
                                        $kqCSVC = TruyVan($DKTT);
                                        //Vòng lặp điền thông tin cơ sở vật chất
                                        while($row = mysqli_fetch_array($kqCSVC)){
                                            echo '<div>
                                                    <input class="DieuKienCoSoVatChat" type="checkbox" name="DieuKienTT[]" value='.$row['ID_DK'].'> <span>'.$row['VatChat'].'</span>
                                                </div>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <!--
                            PHP
                        -->
                        <tr> 
                            <td colspan="3">
                                <button type="reset" class="NutHuy">Hủy</button>
                                <button type="submit" class="NutDangNhap">Cập nhật</button>
                            </td>
                        </tr>
                    </table>
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