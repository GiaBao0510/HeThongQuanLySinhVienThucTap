<?php
    session_start();
    ob_start();
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');
    //Kiểm tra đăng nhập
    if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
        include('../../TrangDungChung/DangNhapThatBai.php');
    }
?>
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
                    <form action="../../TrangDungChung/ThucHienDangXuat.php" method="post" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="taikhoan" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" name="matkhau" value="<?php echo $_SESSION['pw'];?>">
                        <input type="hidden" name="vaitro" value="<?php echo $_SESSION['role'];?>">
                        <input type="hidden" name="loithoat" value="../TrangDungChung/index.php">
                        <button type="submit" class="NutThoat">
                            <i class="fa-solid fa-door-open"></i>Thoát
                        </button>
                    </form>
                    <a href="../TrangChuDVTT.php" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
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
                            $maSo = $_SESSION['user'];
                            $ThongTinDVTT = DS_ChoPheDuyet_DVTT($maSo);
                            //Kiểm tra có rỗng không Nếu rỗng thì không tin ra gì hết
                            if(!empty($ThongTinDVTT)){
                                while($row =mysqli_fetch_array($ThongTinDVTT)){
                                    $ThongTinSV = getSinhVien($row['MSSV']);
                                    $nganhHoc = NganhHocCuaSinhVien($ThongTinSV['MaLop']);
                                    $khoa = infKhoa($nganhHoc['MaKhoa'])['tenKhoa'];
                                    //MSSV
                                    if(empty($ThongTinSV['MSSV'])){
                                        $mssv = 'null';
                                    }else{
                                        $mssv = $ThongTinSV['MSSV'];
                                    }
                                    //Họ tên
                                    if(empty($ThongTinSV['HoTen'])){
                                        $hoTen = 'null';
                                    }else{
                                        $hoTen = $ThongTinSV['HoTen'];
                                    }
                                    if(empty($ThucHienKiemTra_CBHD)){
                                        echo'<tr>
                                            <td>'.$khoa.'</td>
                                            <td>'.$nganhHoc['TenNganh'].'</td>
                                            <td> <input type="hidden" name="MSSV" value="'.$mssv.'"/>'.$mssv.'</td>
                                            <td>'.$hoTen.'</td>
                                            <td>
                                                <a href="../../SinhVien/NopCV/GiayGioiThieu.php?ID='.$mssv.' ">Xem giấy giới thiệu</a>
                                            </td>
                                            <td> 
                                                <a href="GiaoViec.php?MSPXNTT='.$row['MSPXNTT'].'&MSSV='.$mssv.'" ><i class="fa-solid fa-check"></i></a>
                                            </td>
                                            <td> <a href="ThucHienKhongNhanSV.php?ID='.$maSo.'&MSPXNTT='.$row['MSPXNTT'].'&MSSV='.$mssv.'" > <i class="fa-solid fa-x"></i> </a> </td>
                                        </tr>';
                                    }
                                }

                            }else{
                                echo'<tr>
                                        <td colspan="6"> Không có thông tin sinh viên</td>
                                    </tr>';
                            }

                        ?> <a href=""></a>
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