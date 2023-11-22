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
            .LuuY{
                margin: 2vw;
                color: red;
                font-size: 1.05em;
                font-family: Arial, Helvetica, sans-serif;
                font-style: italic;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/CanBoHuongDan/RangBuocBieuMau.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--PHP-->
        <?php
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');

            $mssv = trim($_GET['MSSV']);
            $mscb = trim($_GET['MSCB']);

            //Lấy thông tin qua hàm
            $TTsinhVien = infSinhVien($mssv);
            $TTcanBo = infCanBoHuongDan($mscb);
            $dotThucTap = ThongTinDotThucTap(date('Y'));
            $ThoiDiemThucTap = ThongTinDotThucTap(date('Y'));
            $TTdonViThucTap = infDonViThucTap($TTcanBo['MaDVTT']);
            $STT = $ThoiDiemThucTap['STT'];

            //Điều kiện tiên quyết . Kiểm tra xem sinh viên đã chấm điểm hay chưa nếu chưa thì thoát
            if(KiemTraSV_DaDuocCanBoNhanXetDanhGia($mssv) < 1){
                echo "<script>
                        alert('Vui lòng thực hiện đánh giá cho sinh viên trước. Sau đó mới quay lại chấm diểm');
                        history.back();
                    </script>";
            }

            //1. Kiểm tra xem có phiếu nào hay chưa. 
            $KT_CoPhieu = "SELECT COUNT(*) dem FROM phieudanhgiaketquathuctap";

            //2.Nếu không thì tạo mới phiếu mới.
            if( mysqli_fetch_array(TruyVan($KT_CoPhieu))['dem'] < 1){
                //echo"<p>Chưa tồn tại mẫu nào. Chuẩn bị tạo mới "."</p>";
                $taoPhieuMoi = "INSERT INTO phieudanhgiaketquathuctap(MSPDGKQTT,STT,MSSV,MSCB) 
                    VALUES('pdg01','".$STT."','".$mssv."','".$mscb."')";
                $thucHien1 = TruyVan($taoPhieuMoi);
            }
            //3. Ngược lại thì tạo phiếu kế tiếp.
            else{
                
                //Kiểm tra xem phiếu đánh giá kết quả có mã số sinh viên chưa. Nếu không có thì tạo
                $KT_sinhVienCoTonTai = "SELECT COUNT(*) dem 
                                    FROM phieudanhgiaketquathuctap
                                    WHERE mssv = '$mssv'";
                $thucHien2 = TruyVan($KT_sinhVienCoTonTai);
                //echo"<p>Đã tồn tại mẫu rồi . Tạo mẫu kế tiếp ".intval(mysqli_fetch_array($thucHien2)['dem'])."</p>";
                if(mysqli_fetch_array($thucHien2)['dem'] < 1){
                    //Lấy mã phiếu kết quả thực tập cuối cùng
                    $LayMaCuoiCung = "SELECT * 
                        FROM phieudanhgiaketquathuctap
                        ORDER BY(MSPDGKQTT) DESC LIMIT 1";
                    $thucHien3 = TruyVan($LayMaCuoiCung);
                    $maMoi = mysqli_fetch_array($thucHien3)['MSPDGKQTT'];
                    //echo"<p>Mã mới: ".$maMoi."</p>";
                    //Tạo mã mới
                    $maMoi = IncreaseIDIndex($maMoi);

                    //Thực hiện thêm vào
                    $taoPhieuKeTiep = "INSERT INTO phieudanhgiaketquathuctap(MSPDGKQTT,STT,MSSV,MSCB) 
                                VALUES('$maMoi','".$STT."','".$mssv."','".$mscb."')";
                    $thucHien1 = TruyVan($taoPhieuKeTiep);
                }else{
                    //echo"<p>Đã tồn tại mã số sinh viên này rồi "."</p>";
                } 
            }
            
            //Sau khi tạo phiếu đánh giá kết quả thực tập. Kiểm tra bên đây đã chấm điểm chưa. Nếu chấm rồi thì không lưu
            $mspdgkqtt = mscb_mssv_PhieuDanhGiaKetQuaThucTap($mssv,$mscb)['MSPDGKQTT'];
            $test_DaChamHayChua = "SELECT COUNT(*) dem 
                                    FROM chitietphieudanhgiaketquathuctap
                                    WHERE MSPDGKQTT = '$mspdgkqtt'";
            
            // echo "Phieu ".mscb_mssv_PhieuDanhGiaKetQuaThucTap($mssv,$mscb)['MSPDGKQTT'].".";
            // echo "Da du: ".mysqli_fetch_array($act_DaChamHayChua)['dem'];
            if(mysqli_fetch_array(TruyVan($test_DaChamHayChua))['dem'] == 10){
                echo '<style>
                        .ThongTinDaDanhGia{
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                        }
                        .ThongTinDanhGia{
                            display: none;
                        }
                    </style>';
            }else{
                echo '<style>
                        .ThongTinDaDanhGia{
                            display:none;
                        }
                        .ThongTinDanhGia{
                            display: flex;
                        }
                    </style>';
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
                    <a href="TrangChuCanBoHuongDan.php?ID=<?php echo $_GET['ID'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="BangChinhThongTinPhieuTheoDoi">
                <div class="ThongTinPhieuTheoDoi">
                    <h1 class="TieuDePhieuTheoDoi">PHIẾU ĐÁNH GIÁ KẾT QUẢ THỰC TẬP </br> (Dùng cho cán bộ hướng dẫn thực tập tại cơ quan)</h1>
                    <table class="BangThongTinPhieuTheoDoi BangThongTinPhieuDanhGia">
                        <tr>
                            <td colspan="2">
                                <p>Họ và tên cán bộ hướng dẫn thực tập: <span class="ThongTinLayDuoc"> <?php echo $TTcanBo['HoTen']; ?></span> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Điện thoại: <span class="ThongTinLayDuoc"> <?php echo $TTcanBo['SDT']; ?></span></p>
                            </td>
                            <td>
                                <p>Email: <span class="ThongTinLayDuoc"> <?php echo $TTcanBo['Email']; ?></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Cơ quan thực tập: <span class="ThongTinLayDuoc"><?php echo $TTdonViThucTap['TenDVTT']; ?></span></p>
                            </td>
                        </tr>
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
                                <p>Thời gian thực tập: <span class="ThongTinLayDuoc"><?php echo ngayThangNam_VN($ThoiDiemThucTap['ngayBatDau']); ?> </span> đến <span class="ThongTinLayDuoc"><?php echo ngayThangNam_VN($ThoiDiemThucTap['ngayKetThuc']); ?></span></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--
                    Chưa đánh giá
                -->
                <div class="ThongTinDanhGia">
                    <form action="ThucHienChamDiem.php?MSSV=<?php echo $mssv;?>&MSCB=<?php echo $mscb;?>" name="FchamDiemSinhVien"  method="post" enctype="application/x-www-form-urlencoded" onsubmit="return RangBuocChamDiem()">
                        <table class="BangThongTinDanhgia">
                            <tr class="DongTieuDe">
                                <th>Nội dung đánh giá</th>
                                <th>Điểm (từ 1 - 10) </th>
                            </tr>
                            <?php
                                $NoiDungDanhGia = All_InfNoiDungDanhGia();
                                while($row = mysqli_fetch_array($NoiDungDanhGia)){
                                   echo '<tr>';
                                    if(trim($row['ID']) == 'I' ||trim($row['ID']) == 'II' ||trim($row['ID']) == 'III' ){
                                        echo '
                                            <td>
                                                <b>'.$row['ID'].'&nbsp;'.$row['NoiDung'].'</b>
                                            </td>';
                                        echo'        
                                            <td>
                                                
                                            </td>';
                                    }else{
                                        echo '
                                            <td>
                                                '.$row['ID'].'&nbsp;'.$row['NoiDung'].'
                                            </td>';
                                        echo'        
                                            <td>
                                                <input name="DiemCham[]" type="text" ID="VungChamDiem"/>
                                                <input type="hidden" name="IDnddgkq[]" value='.$row['ID'].'>
                                            </td>';
                                    }
                                    echo '</tr>';
                                    
                                }
                            ?>
                        </table>
                        <div class="NhanXetKhac">
                            <p>1. Nhận xét khác về sinh viên: </p>
                            <div class="OYKien">
                                <textarea id="PhanNGhiNhanXet" name="NhanXetVeSinhVien" class="GhiNhanXetVeSinhVien" placeholder="Ghi nhận tại đây"></textarea>
                            </div>
                            
                            <p>2.Đánh giá của cơ quan về chương trình đào tạo (CTĐT):</p>
                            <div class="DanhGiaVeCTDT">
                                <?php
                                    $all_mucDoChuongTrinh = "SELECT * from mucdochuongtrinhdaotao";
                                    $Lay_ThongTinMucDoChuongTrinhDaoTao = TruyVan($all_mucDoChuongTrinh);
                                    while($row = mysqli_fetch_array($Lay_ThongTinMucDoChuongTrinhDaoTao)){
                                        echo'<div>
                                                <input type="checkbox" id="OnhanYKienCuaCanBo" name="DanhGia[]" class="OcheckDanhGia" value= '.$row['IDMucDoCT'].'>'.$row['DanhGia'].'
                                            </div>';
                                    }
                                ?>
                            </div>

                            <p>3. Đề xuất góp ý của cơ quan về CTĐT: </p>
                            <div class="OYKien">
                                <textarea name="DongGopYKien" class="GhiNhanXetVeSinhVien" id="LayYKienDongGop" placeholder="Ghi nhận tại đây"></textarea>
                            </div>
                            <p class="LuuY">
                                Lưu ý: Sau khi nhấn nút Lưu, mọi thay đổi về nội dung hoặc đánh giá sẽ không được chấp nhận.
                            </p>
                            <div>
                                <button type="submit" class="NutCapNhat">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--
                    Đã đánh giá
                -->
                <div class="ThongTinDaDanhGia">
                    <table class="BangThongTinDanhgia">
                        <tr class="DongTieuDe">
                            <th>Nội dung đánh giá</th>
                            <th>Điểm (từ 1 - 10) </th>
                        </tr>
                        <?php
                            $NoiDungDanhGia = All_InfNoiDungDanhGia();
                            while($row = mysqli_fetch_array($NoiDungDanhGia)){
                                $ttDiemSo = MSPDGKQTT_ID_chiTietPhieuDanhGiaKetQua($mspdgkqtt,$row['ID']);
                                echo '<tr>';
                                if(trim($row['ID']) == 'I' ||trim($row['ID']) == 'II' ||trim($row['ID']) == 'III' ){
                                    echo '
                                        <td>
                                            <b>'.$row['ID'].'&nbsp;'.$row['NoiDung'].'</b>
                                        </td>';
                                    echo'        
                                        <td>
                                            
                                        </td>';
                                }else{
                                    echo '
                                        <td>
                                            '.$row['ID'].'&nbsp;'.$row['NoiDung'].'
                                        </td>';
                                    echo'        
                                        <td>
                                            <input type="text" ID="VungChamDiem" value='.$ttDiemSo['Diem'].' disabled />
                                        </td>';
                                }
                                echo '</tr>';
                                }
                            ?>
                    </table>
                    <div class="NhanXetKhac">
                        <p>1. Nhận xét khác về sinh viên: </p>
                        <div class="OYKien">
                            <textarea id="PhanNGhiNhanXet" name="NhanXetVeSinhVien" class="GhiNhanXetVeSinhVien" placeholder="Ghi nhận tại đây" disabled><?php echo infPhieuDanhGiaKetQuaThucTap($mspdgkqtt)['NhanXet'];?></textarea>
                        </div>
                        
                        <p>2.Đánh giá của cơ quan về chương trình đào tạo (CTĐT):</p>
                        <div class="DanhGiaVeCTDT">
                            <?php
                                $LayThongTinMucDoDaDanhGia = MSPDGKQTT_MucDoChuongTrinhDaoTao($mspdgkqtt);
                                while($row = mysqli_fetch_array($LayThongTinMucDoDaDanhGia)){
                                    echo'
                                            <p>'.$row['DanhGia'].'</p>
                                        ';
                                }
                            ?>
                        </div>

                        <p>3. Đề xuất góp ý của cơ quan về CTĐT: </p>
                        <div class="OYKien">
                            <textarea name="DongGopYKien" class="GhiNhanXetVeSinhVien" id="LayYKienDongGop" placeholder="Trống" disabled><?php echo infPhieuDanhGiaKetQuaThucTap($mspdgkqtt)['DongGop'];?></textarea>
                        </div>
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

