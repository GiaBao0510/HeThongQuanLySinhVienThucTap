<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách chờ phê duyệt</title>
        <link rel="shortcut icon" href="../../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->
        <script src="../../../RangBuoc/TrangDungChung/DungChung.js" async></script>

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="TrangChuDVTT.php?ID=<?php echo $_GET['ID']; ?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <div class="BangXetDuyetSV">
                    <table>
                        <tr>
                            <th colspan="7" class="TieuDeBangXetDuyet">
                                Danh sách sinh viên yêu cầu thực tập
                            </th>
                        </tr>
                        <tr>
                            <th class="TieuDeBangXetDuyet">Khoa</th>
                            <th class="TieuDeBangXetDuyet">Ngành</th>
                            <th class="TieuDeBangXetDuyet">Mã số sinh viên</th>
                            <th class="TieuDeBangXetDuyet">Họ tên</th>
                            <th class="TieuDeBangXetDuyet">Chi tiết</th>
                            <th class="TieuDeBangXetDuyet">Nhận</th>
                            <th class="TieuDeBangXetDuyet">Không nhận</th>
                        </tr> 
                        <?php
                            include('../../TrangDungChung/KetNoi.php');
                            include('../../TrangDungChung/CacHamXuLy.php');
                            
                            $maSo = $_GET['ID'];
                            $ThongTinDVTT = madvtt_PhieuTiepNhanSinhVien($maSo);
                            //Kiểm tra có rỗng không Nếu rỗng thì không tin ra gì hết
                            if(!empty($ThongTinDVTT)){
                                while($row =mysqli_fetch_array($ThongTinDVTT)){
                                    $ThongTinSV = infSinhVien($row['MSSV']);

                                    //Kiểm tra xem trên phiếu xác nhạn thực tập có cán bộ hướng dẫn chưa nếu có thì không hiển thị
                                    $KiemTraCo_CBHD = "SELECT MSCB FROM phieutiepnhansinhvienthuctapthucte
                                                WHERE MSSV = '".$row['MSSV']."'";
                                    $ThucHienKiemTra_CBHD = mysqli_fetch_array(TruyVan($KiemTraCo_CBHD))['MSCB'];
                                    if(empty($ThucHienKiemTra_CBHD)){
                                        echo'<tr>
                                            <td>'.$ThongTinSV['tenKhoa'].'</td>
                                            <td>'.$ThongTinSV['TenNganh'].'</td>
                                            <td> <input type="hidden" name="MSSV" value="'.$ThongTinSV['MSSV'].'"/>'.$ThongTinSV['MSSV'].'</td>
                                            <td>'.$ThongTinSV['HoTen'].'</td>
                                            <td>
                                                <a href="../../SinhVien/NopCV/GiayGioiThieu.php?ID='.$ThongTinSV['MSSV'].' ">Xem giấy giới thiệu</a>
                                            </td>
                                            <td> 
                                                <a href="GiaoViec.php?ID='.$maSo.'&MSPXNTT='.$row['MSPXNTT'].'&MSSV='.$ThongTinSV['MSSV'].'" ><i class="fa-solid fa-check"></i></a>
                                            </td>
                                            <td> <a href="" > <i class="fa-solid fa-x"></i> </a> </td>
                                        </tr>';
                                    }
                                }

                            }else{
                                echo'<tr>
                                        <td colspan="6"> Không có thông tin sinh viên</td>
                                    </tr>';
                            }

                        ?> 
                    </table>  
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