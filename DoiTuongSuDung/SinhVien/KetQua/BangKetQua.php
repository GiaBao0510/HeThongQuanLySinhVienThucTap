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
        <title>Trang chủ sinh viên thực tập</title>
        <link rel="shortcut icon" href="../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/SinhVien/SinhVien.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/SinhVien/XemKetQua.css">
        <style>
            .DongTongDiem .CotTongDiem{
                color: #eee;
                background-color: #2D2929;
                font-size: 1.25em;
                text-align: right;
            }
            .BangKetQuaBaoCao{
                margin: 5vw 0 5vw 5vw;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../../RangBuoc/SinhVien/xemKetQua.js" async></script>
        <!--
            PHP
        -->
        <?php
            $mssv = $_SESSION['user'];
            $MSPDGKQTT = "";
            if(!empty(mssv_PhieuDanhGiaKetQuaThucTap($mssv)['MSPDGKQTT']) ){
                $MSPDGKQTT = mssv_PhieuDanhGiaKetQuaThucTap($mssv)['MSPDGKQTT'];
            }
            $MSPDGKQTT = trim($MSPDGKQTT);
            $MSPDGBCKQTT ="";
            if(!empty( mssv_PhieuDanhGiaBaoKetQua($mssv)['MSPDGBCKQTT'])){
                $MSPDGBCKQTT =mssv_PhieuDanhGiaBaoKetQua($mssv)['MSPDGBCKQTT'];
            }
            $MSPDGBCKQTT = trim($MSPDGBCKQTT);
            // echo $MSPDGKQTT;
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
            <div class="KhungXemKetQuaChinh">
                <div class="KhungBamXemKetQua">
                    <button type="button" class="oXemKetQua">
                        <img src="../../../Image/SinhVien/content.png" alt="" class="AnhChucNang">
                        <p>Xem kết quả thực tập</p>
                    </button>
                    <button type="button" class="oXemKetQuaBaoCao">
                        <img src="../../../Image/SinhVien/research.png" alt="" class="AnhChucNang">
                        <p>Xem kết quả báo cáo <br> thực tập</p>
                    </button>
                </div>
                <div class="KhungHienThiKetQua">
                    <div class="KhungKetQuaThucTap  BienMat">
                        <?php
                            //1.Kiểm tra xem sinh viên đã được cán bộ thực tập chấm điểm chưa
                            //2. Nếu chưa thì hiển thị báo cáo
                            if(checkSinhVienDaDuoc_CanBoChamDiem($mssv) == 0){ ?>
                                
                                <div class="ThongBao">
                                    Hiện chưa có điểm số
                                </div>
                            <?php
                            }else{  //3. NGược lại thì in
                            ?>
                                <table class="BangKetQuaThucTap">
                                    <tr class="TieuDe">
                                        <th>STT</th>
                                        <th>Nội dung đánh giá</th>
                                        <th>Điểm số</th>
                                    </tr>
                                    <?php
                                        $noiDungKetQua = All_InfNoiDungDanhGia();
                                        while($row = mysqli_fetch_array($noiDungKetQua)){
                                            if($row['ID'] == 'I' || $row['ID'] == 'II' ||$row['ID'] == 'III'){
                                                echo '<tr>';
                                                    echo'<td><b>'.$row['ID'].'</b></td>';
                                                    echo'<td><b>'.$row['NoiDung'].'</b></td>';
                                                    echo'<td>'.'</td>';
                                                echo '</tr>';
                                            }else{
                                                echo '<tr>';
                                                    echo'<td>'.$row['ID'].'</td>';
                                                    echo'<td>'.$row['NoiDung'].'</td>';
                                                    echo'<td>'.LayMotDiem_PhieuDAnhGiaKetQua($MSPDGKQTT,trim($row['ID'])).'</td>';
                                                echo '</tr>';
                                            }
                                            
                                        }
                                    ?>
                                   <tr class="DongTongDiem">
                                        <td colspan="2" class="CotTongDiem">Tổng điểm:</td>
                                        <td>
                                            <?php echo MSSV_TongKetQuaThucTapThucTe($_SESSION['user']);?>
                                        </td>
                                    </tr>
                                </table>

                            <?php
                            }
                            
                        ?>
                    </div>
                    <div class="KhungKetQuaBaoCao BienMat">
                        <?php
                            //Nếu sinh viên chưa được giáo viên đánh giá báo cáo thì hiển thị
                            if(checkSinhVienDaDuoc_GiangVienChamDiem($mssv) == 0){?>
                                <div class="ThongBao">
                                    Hiện chưa có điểm số
                                </div>
                        <?php
                            }else{
                        ?>
                                <table class="BangKetQuaBaoCao">
                                    <tr class="TieuDe">
                                        <th>STT</th>
                                        <th>Nội dung đánh giá</th>
                                        <th>Điểm số tối đa</th>
                                        <th>Điểm chấm</th>
                                    </tr>
                                    <?php
                                        $noiDungBaoCao = All_InfNoiDungBaoCao();
                                        while($row = mysqli_fetch_array($noiDungBaoCao)){
                                            if($row['Idndbc'] =='I' ||$row['Idndbc'] =='II'||$row['Idndbc'] =='III'){
                                                echo '<tr>';
                                                    echo'<td><b>'.$row['Idndbc'].'</b></td>';
                                                    echo'<td><b>'.$row['NoiDung'].'</b></td>';
                                                    echo'<td><b>'.$row['DiemToiDa'].'</b></td>';
                                                    echo'<td>'.'</td>';
                                                echo '</tr>';
                                            }else{
                                                echo '<tr>';
                                                    echo'<td>'.$row['Idndbc'].'</td>';
                                                    echo'<td>'.$row['NoiDung'].'</td>';
                                                    echo'<td>'.$row['DiemToiDa'].'</td>';
                                                    echo'<td>'.LayMotDiem_PhieuDAnhGiaBaoCaoKetQua($MSPDGBCKQTT,$row['Idndbc']).'</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                    <tr class="DongTongDiem">
                                        <td colspan="3" class="CotTongDiem">Tổng điểm:</td>
                                        <td>
                                            <?php echo MSSV_TongBaoCaoKetQuaThucTapThucTe($_SESSION['user']);?>
                                        </td>
                                    </tr>
                                </table>
                        <?php
                            }
                        ?>
                        
                    </div>
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