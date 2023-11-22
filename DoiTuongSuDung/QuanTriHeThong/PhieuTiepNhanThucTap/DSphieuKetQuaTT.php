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
        <h1 class="BangLietKe">Bảng Phiếu đánh giá kết quả sinh viên thực tập</h1>
    <table id="CanChinhBangPKQTT" class="table table-striped BangPhieu">
            <thead>
                <tr class="TieuDeBangPhieu">
                    <th>Mã số phiếu kết quả thực tập</th>
                    <th>Mã số sinh viên</th>
                    <th>Mã số cán bộ hướng dẫn</th>
                    <th>Nhận xét</th>
                    <th>Đóng góp</th>
                    <th>Tổng điểm thực tập</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $DS = ds_PhieuDanhGiaKetQua();
                    
                    while($row = mysqli_fetch_array($DS)){
                        //Kiểm tra các mã số cán bộ có rỗng không
                        if(empty($row['MSCB'])){
                            $mscb = '<span class="ThongSoNULL">null</span>';
                        }else{
                            $mscb = $row['MSCB'];
                        }

                        echo '<tr>';
                        echo    "<td>".$row['MSPDGKQTT']."</td>";
                        echo    "<td>".$row['MSSV']."</td>";
                        echo    "<td>".$mscb."</td>";
                        echo    "<td>".$row['NhanXet']."</td>";
                        echo    "<td>".$row['DongGop']."</td>";
                        echo    "<td>".TongDiem_PhieuDanhGiaKetQua($row['MSSV'])."</td>";
                        echo '</tr>';
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class="TieuDeBangPhieu">
                    <th>Mã số phiếu kết quả thực tập</th>
                    <th>Mã số sinh viên</th>
                    <th>Mã số cán bộ hướng dẫn</th>
                    <th>Nhận xét</th>
                    <th>Đóng góp</th>
                    <th>Tổng điểm thực tập</th>
                </tr>
            </tfoot>
        </table>
    </body> 
</html> 

    


