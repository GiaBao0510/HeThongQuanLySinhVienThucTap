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
    <h1 class="BangLietKe">Bảng Phiếu theo dõi sinh viên thực tập thực tế</h1>
    <table id="CanChinhBangPDTSV" class="table table-striped BangPhieu">
            <thead>
                <tr class="TieuDeBangPhieu">
                    <th>Mã số phiếu theo dõi sinh viên</th>
                    <th>Mã số sinh viên</th>
                    <th>Mã số giảng viên</th>
                    <th>Mã số cán bộ</th>
                    <th>Số đợt thực tập</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $DS = ds_PhieuTheoDoiSinhVien();
                    
                    while($row = mysqli_fetch_array($DS)){
                        //Kiểm tra các mã số cán bộ có rỗng không
                        if(empty($row['MSCB'])){
                            $mscb = '<span class="ThongSoNULL">null</span>';
                        }else{
                            $mscb = $row['MSCB'];
                        }
                        //Kiểm tra các mã số giảng viên có rỗng không
                        if(empty($row['MSGV'])){
                            $msgv = '<span class="ThongSoNULL">null</span>';
                        }else{
                            $msgv = $row['MSGV'];
                        }

                        echo '<tr>';
                        echo    "<td>".$row['MSPTDSV']."</td>";
                        echo    "<td>".$row['MSSV']."</td>";
                        echo    "<td>".$msgv."</td>";
                        echo    "<td>".$mscb."</td>";
                        echo    "<td>".$row['STT']."</td>";
                        echo '</tr>';
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class="TieuDeBangPhieu">
                    <th>Mã số phiếu theo dõi sinh viên</th>
                    <th>Mã số sinh viên</th>
                    <th>Mã số giảng viên</th>
                    <th>Mã số cán bộ</th>
                    <th>Số đợt thực tập</th>
                </tr>
            </tfoot>
        </table>
    </body> 
</html> 

    


