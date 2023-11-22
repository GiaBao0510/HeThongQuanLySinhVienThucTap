<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangBang.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TaiKhoan/TaiKhoan.css">
        <style>
            #TieuDeBang th{
                text-align: center;
                color: #eee;
                background-color: #1d1d1e;
                border: 1px solid #EEEEEE;
            }
        </style>
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="../../../RangBuoc/DonViThucTap/CauHinhBangDVTT.js"></script>
        
    </head>
    <body class="ThanTrang"> 
    <table id="CanChinhBangDVTT" class="table table-striped KhungBangChung">
            <thead>
                <tr id="TieuDeBang">
                    <th>Mã đơn vị thực tập</th>
                    <th>Tên đơn vị thực tập</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Delete</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $DStk = DS_donViThucTap();
                    
                    while($row = mysqli_fetch_array($DStk)){
                        echo '<tr>';
                        echo    "<td>".$row['MaDVTT']."</td>";
                        echo    "<td>".$row['TenDVTT']."</td>";
                        echo    "<td>".$row['DiaChi']."</td>";
                        echo    "<td>".$row['SDT']."</td>";
                        echo    "<td>".$row['Email']."</td>";
                ?>
                        <td>
                            <button type="button"  onclick='ThongBaoXacNhanXoaDVTT(<?php echo json_encode($row["MaDVTT"]);?>)'>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </td>
                <?php        
                        echo    '<td>
                                    <a href="DonViThucTap/CapNhatMauTin_dvtt.php?MaDVTT='.$row['MaDVTT'].'"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
            <tfoot>
                <tr id="TieuDeBang">
                    <th>Mã đơn vị thực tập</th>
                    <th>Tên đơn vị thực tập</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Delete</th>
                    <th>Cập nhật</th>
                </tr>
            </tfoot>
        </table>
    </body> 
</html> 

    

