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

        <script defer src="../../../RangBuoc/CanBoHuongDan/CauHinhBangCanBo.js"></script>
        <script defer src="../../../RangBuoc/DonViThucTap/linhHoat_DVTT.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="CanBoHuongDan/ChuyenHuong.js"async></script>
    </head>
    <body> 
        <form action="" method="post">
            <table id="CauHinhBang1" class="table table-striped KhungBangChung">
                <thead>
                    <tr id="TieuDeBang">
                        <th>MSCB</th>
                        <th>Họ Tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Mã đơn vị <br> thực tập</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $dsCanBo = All_canBo();
                        while($row = mysqli_fetch_array($dsCanBo)){
                            echo '<tr>';
                            echo    '<td>'.$row['MSCB'].'</td>';
                            echo    '<td>'.$row['HoTen'].'</td>';
                            echo    '<td>'.$row['NgaySinh'].'</td>';
                            echo    '<td>'.$row['GioiTinh'].'</td>';
                            echo    '<td>'.$row['DiaChi'].'</td>';
                            echo    '<td>'.$row['SDT'].'</td>';
                            echo    '<td>'.$row['Email'].'</td>';
                            echo    '<td>'.$row['MaDVTT'].'</td>';
                    ?>        
                                        <td>
                                            <button type='button' onclick='ThongBaoXacNhanXoaCanBo(<?php echo json_encode($row["MSCB"]);?>,<?php echo json_encode($row["MaDVTT"]);?>)'>
                                                <i class='fa-solid fa-xmark'></i>
                                            </button>
                                        </td>
                        
                    <?php        
                            echo    "<td><a href='CanBoHuongDan/CapNhatMauTin_cbhd.php?MSCB=".$row['MSCB']."'> <i class='fa-solid fa-pen-to-square'></i> </a></td>";
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr id="TieuDeBang">
                        <th>MSCB</th>
                        <th>Họ Tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Mã đơn vị<br> thực tập</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </tfoot>
            </table>
        </form>
        
    </body> 

</html> 
    
