<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chấm điểm sinh viên thực tập</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/CanBoHuongDan/CBHD.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/GiaoVienHuongDan/GVHD.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script defer src="../../../RangBuoc/GiaoVienHuongDan/CauHinhBangGV.js"></script>
        <!--PHP-->
        <?php
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');
            $msgv = $_GET['MSGV'];
            $ThongTinPhieuTheoDoi = MSGV_PhieuGiaoViec($msgv);
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
                    <a href="../TrangChuGiaoVien.php?ID=<?php echo $_GET['MSGV'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="DinhDangViTriBang">
                <table id="CanChinhSinhVienChamDiem" class="BangNhanXetSinhVien">
                    <thead>
                        <tr class="DongTieuDe">
                            <th>Mã số sinh viên</th>
                            <th>Họ tên</th>
                            <th>Khoa</th>
                            <th>Ngành</th>
                            <th>Kết quả thực tập</th>
                            <th>Điểm số</th>
                            <th>Chấm điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            //HIển thị
                            while($row = mysqli_fetch_array($ThongTinPhieuTheoDoi)){
                                
                                $ThongTinSV = infSinhVien($row['MSSV']);
                                $MaNganh = trim(NganhHocCuaSinhVien(trim($ThongTinSV['MaLop']))['MaNganh']);
                                $TenNganh = trim(NganhHocCuaSinhVien(trim($ThongTinSV['MaLop']))['TenNganh']);
                                $TenKhoa = NganhThuocKhoa($MaNganh)['tenKhoa'];
                                $SinhVienDaThcTapHayChua = checkSinhVienDaDuoc_CanBoChamDiem($ThongTinSV['MSSV']);
                                $sinhVienDaDuocGiangVienChamDiem = checkSinhVienDaDuoc_GiangVienChamDiem($ThongTinSV['MSSV']);
                                // $tongDiem = "Chưa chấm điểm";
                                // //Kiểm tra sinh viên đã có phiếu đánh giá kết quả hay chưa
                                // $KTsvCoPhieuDGKQTT = SinhVienCo_PhieuDanhGiaKetQuaTT(trim($ThongTinSV['MSSV']));
                                // if($KTsvCoPhieuDGKQTT > 0){
                                //     //Kiểm tra xem sinh viên đã được chấm điểm hay chưa
                                //     $TT_PhieuDanhGiaKQ = mssv_PhieuDanhGiaKetQuaThucTap(trim($ThongTinSV['MSSV']));
                                //     $MSPDGKQTT = $TT_PhieuDanhGiaKQ['MSPDGKQTT'];
                                //     $tongDiem = TongDiem_PhieuDanhGiaKetQuaThucTap($MSPDGKQTT);
                                // }

                                echo '<tr class="DongTieuDe">
                                            <td>'.$ThongTinSV['MSSV'].'</td>
                                            <td>'.$ThongTinSV['HoTen'].'</td>
                                            <td>'.$TenKhoa.'</td>
                                            <td>'.$TenNganh.'</td>
                                            ';
                                //Kiểm tra xem sinh viên đã được cán bộ hướng dẫn chấm diemrd hay chưa
                                if($SinhVienDaThcTapHayChua == 1){
                                        echo'
                                            <td>'.MSSV_TongKetQuaThucTapThucTe($ThongTinSV['MSSV']).'</td>';
                                        
                                }else{
                                        echo'<td>Chưa có</td>';
                                }            
                                //Kiểm tra xem sinh viên đã được giảng viên hướng dẫn chấm diemrd hay chưa        
                                if($sinhVienDaDuocGiangVienChamDiem > 0){
                                    echo'   <td>'.MSSV_TongBaoCaoKetQuaThucTapThucTe($ThongTinSV['MSSV']).'</td>
                                            <td>
                                            <a href="ChamDiemSinhVien.php?MSGV='.$msgv.'&MSSV='.$ThongTinSV['MSSV'].'" class="NutXemDiemSinhVien">Xem kết quả</a>
                                            </td>';
                                }else{
                                    echo'   <td>Chưa được chấm điểm</td>
                                            <td>
                                                <a href="ChamDiemSinhVien.php?MSGV='.$msgv.'&MSSV='.$ThongTinSV['MSSV'].'" class="NutNhanXet">Thực hiện chấm điểm</a>
                                            </td>';
                                }
                                echo    '</tr>';
                            }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr class="DongTieuDe">
                            <th>Mã số sinh viên</th>
                            <th>Họ tên</th>
                            <th>Khoa</th>
                            <th>Ngành</th>
                            <th>Kết quả thực tập</th>
                            <th>Điểm số</th>
                            <th>Chấm điểm</th>
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