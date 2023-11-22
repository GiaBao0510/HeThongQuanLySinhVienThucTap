<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--
            CSS
        -->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangBang.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <style>
            #TieuDeBang th{
                text-align: center;
                color: #eee;
                background-color: #1d1d1e;
                border: 1px solid #EEEEEE;
            }
        </style>
        <!--
            JS
        -->

        <script defer src="../../../RangBuoc/BangDiem/CauHinhBangDiem.js"></script>
        <script defer src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body> 
        <form action="" method="post">
            <table id="CauHinhBangDiemSo" class="table table-striped KhungBangChung">
                <thead>
                    <tr id="TieuDeBang">
                        <th>MSSV</th>
                        <th>Họ Tên</th>
                        <th>Giảng viên hướng dẫn</th>
                        <th>Cán bộ hướng dẫn</th>
                        <th>Đơn vị thực tập</th>
                        <th>Tổng điểm thực tập</th>
                        <th>Tổng điểm báo cáo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $dsSinhVien = DS_SinhVien();

                        while($row = mysqli_fetch_array($dsSinhVien)){
                            $tenGV = infGiangVienHuongDan($row['MSGV'])['HoTen'];
                            $tenDV = infDonViThucTap($row['MaDVTT'])['TenDVTT'];
                            
                            if(gettype($row['MSCB']) != 'NULL'){
                                $tenCB = getCanBoHuongDan($row['MSCB'])['HoTen'];
                            }else{
                                $tenCB = 'null';
                            }
                            
                            
                            //Kiểm tra tổng điểm kết quả thực tập có null hay không
                            if(TongDiem_PhieuDanhGiaKetQua($row['MSSV']) > 0){
                                $tongKQTT = TongDiem_PhieuDanhGiaKetQua($row['MSSV']);
                            }else{
                                $tongKQTT = 'null';
                            }

                            //Kiểm tra tổng điểm kết quả báo cáo thực tập có null hay không
                            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                                $tongKQBC = 'null';
                            }else{
                                $tongKQBC = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                            }
                            echo '<tr>';
                            echo    '<td>'.$row['MSSV'].'</td>';
                            echo    '<td>'.$row['HoTen'].'</td>';
                            echo    '<td>'.$tenGV.'</td>';
                            echo    '<td>'.$tenCB.'</td>';
                            echo    '<td>'.$tenDV.'</td>';
                            echo    '<td>'.$tongKQTT.'</td>';
                            echo    '<td>'.$tongKQBC.'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr id="TieuDeBang">
                        <th>MSSV</th>
                        <th>Họ Tên</th>
                        <th>Giảng viên hướng dẫn</th>
                        <th>Cán bộ hướng dẫn</th>
                        <th>Đơn vị thực tập</th>
                        <th>Tổng điểm thực tập</th>
                        <th>Tổng điểm báo cáo</th>
                    </tr>
                </tfoot>
            </table>
        </form>
        
    </body> 

</html> 
    
