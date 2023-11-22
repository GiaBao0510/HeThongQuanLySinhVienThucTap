<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../../DinhDangWebSite/Phieu/BangPhieu.css">
        <script defer src="../../../RangBuoc/Phieu/CauHinhBangPhieu.js"></script>
        
    </head>
    <body class="ThanTrang"> 
        <h1 class="BangLietKe">Bảng Phiếu đánh giá báo cáo kết quả sinh viên thực tập</h1>
    <table id="CanChinhBangPDGBCKQTT" class="table table-striped BangPhieu">
            <thead>
                <tr class="TieuDeBangPhieu">
                    <th>Mã số phiếu đánh giá báo cáo kết quả thực tập</th>
                    <th>Mã số sinh viên</th>
                    <th>Mã số giảng viên hướng dẫn</th>
                    <th>Điểm trừ</th>
                    <th>Tổng điểm</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $DS = ds_PhieuDanhGiaBaoCaoKetQua();
                    
                    while($row = mysqli_fetch_array($DS)){
                        //Kiểm tra các mã số cán bộ có rỗng không
                        if(empty($row['MSGV'])){
                            $mscb = '<span class="ThongSoNULL">null</span>';
                        }else{
                            $mscb = $row['MSGV'];
                        }

                        echo '<tr>';
                        echo    "<td>".$row['MSPDGBCKQTT']."</td>";
                        echo    "<td>".$row['MSSV']."</td>";
                        echo    "<td>".$row['MSGV']."</td>";
                        echo    "<td>".$row['DiemTru']."</td>";
                        echo    "<td>".(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']) - $row['DiemTru'])."</td>";
                        echo '</tr>';
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class="TieuDeBangPhieu">
                    <th>Mã số phiếu đánh giá báo cáo kết quả thực tập</th>
                    <th>Mã số sinh viên</th>
                    <th>Mã số giảng viên hướng dẫn</th>
                    <th>Điểm trừ</th>
                    <th>Tổng điểm</th>
                </tr>
            </tfoot>
        </table>
    </body> 
</html> 

    


