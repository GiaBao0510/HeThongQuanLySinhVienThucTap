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
            #TieuDeThongTin th{
                color: #eee;
                background-color: #1d1d1e;
                border: 1px solid #EEEEEE;
            }
        </style>
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="../../../RangBuoc/SinhVien/CauHinhBangSinhVien.js"></script>
        
    </head>
    <body class="ThanTrang"> 
    <table id="CanChinhBangSinhVien" class="table table-striped KhungBangChung">
            <thead>
                <tr id="TieuDeThongTin">
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>CCCD</th>
                    <th>Mã lớp</th>
                    <th>Delete</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $DStk = DS_SinhVien();
                    
                    while($row = mysqli_fetch_array($DStk)){
                        echo '<tr>';
                        echo    "<td>".$row['MSSV']."</td>";
                        echo    "<td>".$row['HoTen']."</td>";
                        echo    "<td>".$row['NgaySinh']."</td>";
                        echo    "<td>".$row['GioiTinh']."</td>";
                        echo    "<td>".$row['DiaChi']."</td>";
                        echo    "<td>".$row['SDT']."</td>";
                        echo    "<td>".$row['Email']."</td>";
                        echo    "<td>".$row['CCCD']."</td>";
                        echo    "<td>".$row['MaLop']."</td>";
                ?>
                        <td>
                            <button type="button"  onclick='ThongBaoXacNhanXoaSinhVien(<?php echo json_encode($row["MSSV"]);?>)'>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </td>
                <?php        
                        echo    '<td>
                                    <a href="SinhVien/CapNhatMauTin_sv.php?MSSV='.$row['MSSV'].'"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
            <tfoot>
                <tr id="TieuDeThongTin">
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>CCCD</th>
                    <th>Mã lớp</th>
                    <th>Delete</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </tfoot>
        </table>
    </body> 
</html> 

    


