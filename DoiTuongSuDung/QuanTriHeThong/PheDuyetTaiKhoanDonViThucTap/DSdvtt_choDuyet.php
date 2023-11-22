<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../../DinhDangWebSite/Phieu/BangPhieu.css">
        <script defer src="../../../RangBuoc/DonViThucTap/CAuHinhBangDVTT_ChuaDuyet.js"></script>
        <style>
            .fa-marker{
                color: blue;
                border: 2px solid blue;
                padding: 0.5vh;
            }
            .fa-marker:hover{
                color: blueviolet;
                border: 2px solid blueviolet;
            }
        </style>
    </head>
    <body class="ThanTrang"> 
        <h1 class="BangLietKe">Phê duyệt tài khoản đơn vị thực tập</h1>
    <table id="CanChinhBangDVTTchuaDuyet" class="table table-striped BangPhieu">
            <thead>
                <tr class="TieuDeBangPhieu">
                    <th>Mã sso đơn vị thực tập? UserID</th>
                    <th>Tên đơn vị thực tập</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Duyệt</th>
                    <th>Không duyệt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $DS = DSdvtt_ChuaDuyet();
                    
                    while($row = mysqli_fetch_array($DS)){

                        echo '<tr>';
                        echo    "<td>".$row['MaDVTT']."</td>";
                        echo    "<td>".$row['TenDVTT']."</td>";
                        echo    "<td>".$row['DiaChi']."</td>";
                        echo    "<td>".$row['SDT']."</td>";
                        echo    "<td>".$row['Email']."</td>";
                        echo    "<td>".$row['MatKhau']."</td>";
                ?>
                        <td>
                            <form action="PheDuyetTaiKhoanDonViThucTap/ThucHienPheDuyet.php" method="post">
                                <input type="hidden" name="UserID" value="<?php echo $row['MaDVTT'];?>">
                                <button><i class='fa-solid fa-marker'></i></button>
                            </form>
                        </td>";
                <?php
                ?>
                        <td>
                            <form action="PheDuyetTaiKhoanDonViThucTap/ThucHienKhongPheDuyet.php" method="post">
                                <input type="hidden" name="UserID" value="<?php echo $row['MaDVTT'];?>">
                                <button><i class='fa-solid fa-xmark'></i></button>
                            </form>
                        </td>";
                <?php        

                        echo '</tr>';
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class="TieuDeBangPhieu">
                    <th>Mã sso đơn vị thực tập? UserID</th>
                    <th>Tên đơn vị thực tập</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Duyệt</th>
                    <th>Không duyệt</th>
                </tr>
            </tfoot>
        </table>
    </body> 
</html> 

    


