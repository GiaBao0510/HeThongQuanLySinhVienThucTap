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
        <link rel="stylesheet" href="../../../DinhDangWebSite/GiaoVienHuongDan/GVHD.css">
        <style>
            .VungDiemTru{
                color: aliceblue;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/GiaoVienHuongDan/RangBuocChamDiem.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--PHP-->
        <?php
            include('../../TrangDungChung/KetNoi.php');
            include('../../TrangDungChung/CacHamXuLy.php');

            $msgv = trim($_GET['MSGV']);
            $mssv = trim($_GET['MSSV']);
            
            //Lấy thông tin qua hàm
            $TTsinhVien = infSinhVien($mssv);
            $TTGiaoVien = infGiangVienHuongDan($msgv);
            $mscb = mssv_PhieuTiepNhanSinhVien($mssv)['MSCB'];
            $TTCanBo = infCanBoHuongDan(trim($mscb));

            $dotThucTap = ThongTinDotThucTap(date('Y'));
            $ThoiDiemThucTap = ThongTinDotThucTap(date('Y'));
            $STT = $ThoiDiemThucTap['STT'];
            $NienKhoa = infNienKhoa_NamBatDau(date('Y'));

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
            <div class="BangChinhThongTinPhieuTheoDoi">
                <div class="ThongTinPhieuTheoDoi">
                    <h1 class="TieuDePhieuTheoDoi">
                        PHIẾU ĐÁNH GIÁ BÁO CÁO KẾT QUẢ THỰC TẬP 
                        </br> HỌC KỲ 3 -- <?php echo '<span>'.$NienKhoa['TDBatDau'].' - '.$NienKhoa['TDKetThuc'].'</span>';?> 
                        </br>(Dùng cho giáo viên chấm báo cáo thực tập) <br>
                        <span class="TieuDeNganhKHMT">NGÀNH KHOA HỌC MÁY TÍNH   </span>
                    </h1>
                    <table class="BangThongTinPhieuTheoDoi BangThongTinPhieuDanhGia">
                        <tr>
                            <td colspan="2">
                                <p>Họ và tên cán bộ hướng dẫn thực tập: <span class="ThongTinLayDuoc"> <?php echo $TTCanBo['HoTen']; ?></span> </p>
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
                    </table>
                </div>
                <!--
                    Chưa đánh giá
                -->
                <div class="ThongTinDanhGia">
                    <?php
                        $NoiDungBaoCao = All_InfNoiDungBaoCao();
                        $i = intval(0);
                        //1.. Nếu cán bộ chưa chấm điểm sinh viên thì thoát
                        if(checkSinhVienDaDuoc_CanBoChamDiem($mssv) < 1){
                            echo "<script>
                                    alert('Sinh viên chưa được cán bộ hướng dẫn. Nên không thể chấm điểm');
                                    history.back();
                                </script>";
                        }
                        //2.Nếu sinh viên chưa được giáo viên hướng dẫn chấm điểm thì hiển thị vùng chấm điểm
                        if(checkSinhVienDaDuoc_GiangVienChamDiem($mssv) < 1){
                            
                    ?>
                    <form action="ThucHienLuuDiemSo.php?MSSV=<?php echo $mssv;?>&MSGV=<?php echo $msgv;?>" name="FchamDiemSinhVien"  method="post" enctype="application/x-www-form-urlencoded" onsubmit="return BieuMauChamDiem()">
                        <table class="BangThongTinDanhgia">
                            <tr class="DongTieuDe">
                                <th>STT</th>
                                <th>Nội dung đánh giá</th>
                                <th>Điểm tối đa</th>
                                <th>Điểm chấm</th>
                            </tr>
                            <?php
                                while($row = mysqli_fetch_array($NoiDungBaoCao)){

                                    echo '<tr>';
                                    if(trim($row['Idndbc']) == 'I' ||trim($row['Idndbc']) == 'II' ||trim($row['Idndbc']) == 'III' ){
                                        echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                        echo '
                                            <td>
                                                <b>'.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'</b>
                                            </td>';
                                        echo '
                                            <td>
                                                <b>'.$row['DiemToiDa'].'</b>
                                            </td>';
                                        echo'        
                                            <td>
                                                
                                            </td>';
                                    }else{
                                        if($i == 5){
                                            echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                            echo '
                                            <td>
                                                '.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'
                                            </td>';
                                            echo '
                                                <td>
                                                    '.$row['DiemToiDa'].'
                                                </td>';
                                            echo'        
                                                <td>
                                                    <input disabled name="DiemChamDaCham" type="text" ID="VungChamDiem" class="NoiNhanDiemSo ObiVoHieuHoa"  value='.(TongDiem_PhieuDanhGiaKetQua($mssv)*0.05).'>
                                                    <input name="DiemCham[]" type="hidden"  value='.(TongDiem_PhieuDanhGiaKetQua($mssv)*0.05).'>
                                                    <input type="hidden" name="IDnddgbc[]"  value='.$row['Idndbc'].'>
                                                </td>';
                                        }elseif($i == 4){
                                            echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                            echo '
                                            <td>
                                                '.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'
                                            </td>';
                                            echo '
                                                <td>
                                                    '.$row['DiemToiDa'].'
                                                </td>';
                                            echo'        
                                                <td>
                                                    <input name="DiemCham[]" type="text" ID="VungChamDiem" class="NoiNhanDiemSo" value="1"/>
                                                    <input type="hidden" name="IDnddgbc[]" value='.$row['Idndbc'].'>
                                                </td>';
                                        }
                                        else{
                                            echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                            echo '
                                            <td>
                                                '.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'
                                            </td>';
                                            echo '
                                                <td>
                                                    '.$row['DiemToiDa'].'
                                                </td>';
                                            echo'        
                                                <td>
                                                    <input name="DiemCham[]" type="text" ID="VungChamDiem" class="NoiNhanDiemSo" value="0.5"/>
                                                    <input type="hidden" name="IDnddgbc[]" value='.$row['Idndbc'].'>
                                                </td>';
                                        }
                                    }
                                    echo '</tr>';
                                    $i+=1;
                                }
                            ?>

                            <tr>
                                <td class="CotKetThuc cotKetThucChung" colspan="3">
                                    Điểm trừ
                                </td>
                                <td colspan="1" class="cotKetThucChung">
                                    <input name="DiemTru" type="text" ID="VungChamDiem"/>
                                </td>
                            </tr>
                        </table>
                        <div>
                            <button type="submit" class="NutNop">Lưu</button>
                            <button type="reset" class="NutReset">Hủy</button>
                        </div>
                    <!--
                        HIển thị đã chấm điểm rồi
                    -->
                    <?php 
                        }
                        else{
                            $mspdgkqtt = mssv_PhieuDanhGiaBaoKetQua($mssv)['MSPDGBCKQTT'];
                            $diemTru = mssv_PhieuDanhGiaBaoKetQua($mssv)['DiemTru'];
                    ?>
                            <table class="BangThongTinDanhgia">
                            <tr class="DongTieuDe">
                                <th>STT</th>
                                <th>Nội dung đánh giá</th>
                                <th>Điểm tối đa</th>
                                <th>Điểm chấm</th>
                            </tr>
                            <?php
                                while($row = mysqli_fetch_array($NoiDungBaoCao)){

                                    echo '<tr>';
                                    if(trim($row['Idndbc']) == 'I' ||trim($row['Idndbc']) == 'II' ||trim($row['Idndbc']) == 'III' ){
                                        echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                        echo '
                                            <td>
                                                <b>'.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'</b>
                                            </td>';
                                        echo '
                                            <td>
                                                <b>'.$row['DiemToiDa'].'</b>
                                            </td>';
                                        echo'        
                                            <td>
                                                
                                            </td>';
                                    }else{
                                        if($i == 5){
                                            echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                            echo '
                                            <td>
                                                '.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'
                                            </td>';
                                            echo '
                                                <td>
                                                    '.$row['DiemToiDa'].'
                                                </td>';
                                            echo'        
                                                <td>
                                                    <input disabled name="DiemChamDaCham" type="text" ID="VungChamDiem" class="NoiNhanDiemSo ObiVoHieuHoa"  value='.(TongDiem_PhieuDanhGiaKetQua($mssv)*0.05).'>
                                                    <input name="DiemCham[]" type="hidden"  value='.(TongDiem_PhieuDanhGiaKetQua($mssv)*0.05).'>
                                                    
                                                </td>';
                                        }else{
                                            $diemDuocCham = LayMotDiem_PhieuDAnhGiaBaoCaoKetQua($mspdgkqtt,$row['Idndbc']);
                                            echo '
                                            <td>
                                                <b>'.($i+1).'</b>
                                            </td>';
                                            echo '
                                            <td>
                                                '.$row['Idndbc'].'&nbsp;'.$row['NoiDung'].'
                                            </td>';
                                            echo '
                                                <td>
                                                    '.$row['DiemToiDa'].'
                                                </td>';
                                            echo'        
                                                <td>
                                                    <input type="text" disabled ID="VungChamDiem" class="NoiNhanDiemSo" value='.$diemDuocCham.'>
                                                </td>';
                                        }
                                    }
                                    echo '</tr>';
                                    $i+=1;
                                }
                            ?>
                            <tr>
                                <td class="CotKetThuc cotKetThucChung" colspan="2">
                                    Tổng cộng
                                </td>
                                <td colspan="1" class="cotKetThucChung">
                                    <input disabled type="text" ID="VungChamDiem" class="VungDiemTru" value="10">
                                </td>
                                <td colspan="1" class="cotKetThucChung">
                                    <input disabled type="text" ID="VungChamDiem" class="VungDiemTru" value="<?php echo (MSSV_TongBaoCaoKetQuaThucTapThucTe($mssv));?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="CotKetThuc cotKetThucChung" colspan="3">
                                    Điểm trừ
                                </td>
                                <td colspan="1" class="cotKetThucChung">
                                    <input disabled name="DiemTru" type="text" ID="VungChamDiem" class="VungDiemTru" value="<?php echo $diemTru;?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="CotKetThuc cotKetThucChung" colspan="3">
                                    Điểm còn lại
                                </td>
                                <td colspan="1" class="cotKetThucChung">
                                    <input disabled type="text" ID="VungChamDiem" class="VungDiemTru" value="<?php echo (MSSV_TongBaoCaoKetQuaThucTapThucTe($mssv) - $diemTru);?>">
                                </td>
                            </tr>
                        </table>
                    <?php
                        }
                    ?>
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