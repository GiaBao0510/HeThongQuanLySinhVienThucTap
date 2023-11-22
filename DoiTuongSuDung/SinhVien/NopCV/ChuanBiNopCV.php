<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng ký thực tập</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/SinhVien/SinhVien.css">
        <style>
            tr th{
                border: 1px solid snow;
            }
            tr td{
                border: 1px solid gray;
            }
            .nutChonDVTT{
                width: 2vw;
                height: 2vw;
            } 
            .nutChonDVTT:hover{
                color: aqua;
                background-color: blueviolet;
                border: 2px solid blueviolet;
                width: 2.5vw;
                height: 2.5vw;
                transition: 0.25s;
            }
        </style>
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/SinhVien/NopCV/KiemTraNopCV.js"></script>

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="../../TrangChuSinhVien.php?ID=<?php echo $_GET['ID'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main> 
            <div class="ChonDonViDeDangKyThucTap">
                <?php
                    include('../../TrangDungChung/KetNoi.php');
                    include('../../TrangDungChung/CacHamXuLy.php');
                    $MaSSV = strval(trim($_GET['ID']));
                    // Trả về danh sách đơn vị thực tập
                    echo'<form action="ThucHienNopCV.php" method="post" class="BangChonDVTT" name="BangChon_DVTT" enctype="application/x-www-form-urlencoded"  onsubmit="return BieuMauKiemTraChonDVTT()">';
                    echo'  <table>';
                    echo '      <tr>';
                    echo '              <th colspan="3" class="TieuDeBangChonDVTT">Chọn đơn vị thực tập</th>';
                    echo '      </tr>';
                    echo '      <tr>';
                    echo '              <th colspan="" class="TieuDeBangChonDVTT">Tên đơn vị thực tập</th>';
                    echo '              <th colspan="" class="TieuDeBangChonDVTT">Địa đơn vị thực tập</th>';
                    echo '              <th colspan="" class="TieuDeBangChonDVTT">Chọn</th>';
                    echo '       </tr>';

                    $DS_DVTT = DS_donViThucTap();

                    while($row = mysqli_fetch_array($DS_DVTT)){
                        echo '<tr>';
                            echo    '<td> 
                                        <input type="hidden" name="MaSSV" value="'.$MaSSV.'" />'.
                                        $row['TenDVTT'].
                                    '</td>';
                            echo    '<td> 
                                        '.$row['DiaChi'].
                                    '</td>';
                            echo    '<td class="CotChonDVTT"> <input type="radio" name="MaDVTT" class="nutChonDVTT" value="'.$row['MaDVTT'].'" /></td>';
                        echo '</tr>';
                    }
                    echo '<tr class="HangCuoiChonDVTT"> 
                            <td colspan="2">
                                <div>
                                    <a href="../NopCV/GiayGioiThieu.php?ID='.$MaSSV.'" class="NutChuyenTrangCV"> Xem Giấy giới thiệu </a> 
                                </div>
                            </td> 
                            <td colspan="1">
                                <div>
                                    <button type="submit" class="NutDangNhap">Nộp giấy giới thiệu</button> 
                                </div>
                            </td>
                        </tr>';
                    echo '        </table>';
                    echo '    </form>';
                ?> 
            </div> <a href="../NopCV/HoSo.php"></a>
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