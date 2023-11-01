<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ sinh viên thực tập</title>
        <link rel="shortcut icon" href="../../Image/logo.ico" />

        <!--CSS-->
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChu.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/DinhDangDungChungChoTatCa.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/TrangDungChung/TrangChuCaNhan.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/SinhVien/SinhVien.css">
        <!--JS-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!--JQuery-->

    </head>
    <body>
        <header>
            <div class="DauTrang">
                <div class="logo">
                    <img src="../../../Image/logo2.png" class="AnhLogo"/>
                </div>
                <div class="CacNut">
                    <a href="../../TrangDungChung/index.html" class="NutThoat"><i class="fa-solid fa-door-open"></i>Thoát</a>
                    <a href="../TrangChuSinhVien.php?ID=<?php echo $_GET['ID'] ;?>" class="NutTrangChu"><i class="fa-solid fa-house"></i>Trang chủ</a>
                </div>
            </div>
        </header>
        <main>
            <?php
                include('../../TrangDungChung/KetNoi.php');
                include('../../TrangDungChung/CacHamXuLy.php');
                
                $MaSSV = strval(trim($_GET['ID']));
                $LayTT = infSinhVien($MaSSV);
                
                //Lấy thông tin đợt thưc tập dựa trên năm hiện tại
                $namHienTai = date('Y');
                $Lay_infDTT = "SELECT * FROM dotthuctap WHERE ngayBatDau LIKE '".$namHienTai."%' ";
                $ThucHien = mysqli_query($connect,$Lay_infDTT) or die(mysqli_connect_error());
                $ttDTT = mysqli_fetch_array($ThucHien);

                //Lấy thông tin giấy tiếp nhậ thực tập dựa trên MSSV
                $TTgiayTiepNhan = mssv_PhieuTiepNhanSinhVien($MaSSV);

                //Kiểm tra xem giấy giới thiệu này đã nộp cho đơn vị thực tập nào hay chưa dựa trên MSSV
                $KtDaDangKyDVTT = "SELECT COUNT(MaDVTT) Dem
                                FROM phieutiepnhansinhvienthuctapthucte
                                WHERE MSSV = '$MaSSV'";
                $ketQuaKT_DVTT = intval( mysqli_fetch_array(TruyVan($KtDaDangKyDVTT))['Dem'] );
                $TenDVTT ="";
                //Nếu > 1 thì in  thông tin của đơn vị thực tập. Ngược lại thì không
                if($ketQuaKT_DVTT > 0){
                    $getThongTinDVTT = infDonViThucTap($TTgiayTiepNhan['MaDVTT']);
                    $TenDVTT = $getThongTinDVTT['TenDVTT'];
                }
                echo '<div class="KhungGiayGioiThieu">
                    <div class="KhungGiayGioiThieuTongQuat">
                        <div class="KhungDauDe">
                            <div class="ThongTinDauDeTrai">
                                <h1>BỘ GIÁO DỤC VÀ ĐÀO TẠO</h1>
                                <h1>Trường Công Nghệ Thông Tin và Truyền Thông</h1>
                            </div>
                            <div class="ThongTinDauDePhai">
                                <h1>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h1>
                                <h1>Độc lập – Tự do – Hạnh phúc</h1>
                                <p class="NgayThangLapPhieuGT"> '.date('l').', ngày '.date('d').' .tháng '.date('m').' .năm '.date('Y').'</p>
                            </div>
                        </div>
                        <h1 class="TieuDeGT">GIẤY GIỚI THIỆU</h1>
                        <div class="ThanThongTinGioiThieu">
                                <p class="DeMucGT">Kính gửi: '.$TenDVTT.' </p>
                                <p class="DeMucGT">TRƯỜNG Công Nghệ Thông Tin và Truyền Thông</p>
                                <p class="DeMucGT">trân trọng giới thiệu:</p>
                                <p>Sinh viên: '.$LayTT['HoTen'].' </p>
                                <p>MSSV: '.$LayTT['MSSV'].' &nbsp;&nbsp;,Lớp: '.$LayTT['MaLop'].'</p>
                                <p>Là sinh viên của Khoa '.$LayTT['tenKhoa'].'</p>
                                <p>Đến liên hệ địa điểm thực tập tại Quý đơn vị. Thời gian thực tập là 8 tuần, bắt đầu từ ngày '.date('d-m-Y',strtotime($ttDTT['ngayBatDau']) ).' .đến ngày '.date('d-m-Y',strtotime($ttDTT['ngayKetThuc']) ).'.</p>
                                <p class="ThongTinCamOn_GGT">Kính gửi Quý đơn vị, <br>Nhà trường chúng tôi trân trọng gửi lời cảm ơn chân thành tới Quý đơn vị đã tạo điều kiện và hỗ trợ cho sinh viên của trường trong quá trình thực tập tại công ty.<br>Sự giúp đỡ và hướng dẫn tận tình của Quý đơn vị đã góp phần quan trọng giúp các sinh viên của trường học hỏi được nhiều kinh nghiệm thực tiễn bổ ích, nâng cao kỹ năng nghề nghiệp và đạt được kết quả tốt trong quá trình thực tập.<br>Thay mặt Nhà trường, tôi xin chân thành cảm ơn Quý đơn vị đã đồng hành, ủng hộ và đóng góp cho sự nghiệp giáo dục đào tạo của nhà trường. Mong rằng sự hợp tác này sẽ tiếp tục được duy trì và phát triển trong thời gian tới.<br>Trân trọng cám ơn!</p>
                        </div>
                        <div class="ChanThongTinGioiThieu">
                            <div class="ChanThongTin1">
                                <p>
                                    Giấy này có giá trị đến hết ngày <br>
                                    '.date('d-m-y',strtotime($TTgiayTiepNhan['ngayHetHan'])).'
                                </p>
                            </div>
                            <div class="ChanThongTin2">
                                <p>TL.HIệu Trưởng <br> Trường Công Nghệ Thông Tin và Truyền Thông</p>
                            </div>
                        </div>
                    </div>
                </div>';
            ?>
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