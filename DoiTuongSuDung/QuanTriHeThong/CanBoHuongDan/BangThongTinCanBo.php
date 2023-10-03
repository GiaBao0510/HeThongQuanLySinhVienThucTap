<link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/CanBoHuongDan/GiaoDienTaoTaiKhoanCBHD.css">
<script src="../../../RangBuoc/QuanTriHeThong/trangchu.js"></script>
<?php
    //1. Hiển thị bảng thông tin
    function BangThongTinCanBo(){
        //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
        include ('../../../web_site/DoiTuongSuDung/TrangDungChung/KetNoi.php');

        //Câu lệnh truy vấn và thực hiện
        $truyVan = "SELECT * FROM canbohuongdan";
        $thucHien = mysqli_query($connect,$truyVan);

        //IN bảng
        echo"<form action='CanBoHuongDan/XoaMauTinCB.php' method='post' class='BangHienThi_SV' onsubmit='ThongBaoXoaThanhCong()'>";
            echo'<table class="ThongTin_DVTT">';
                echo'<tr class="row_TTdvtt">';
                    echo'<th class="TieuDe_TTdvtt">MSCB</th>';
                    echo'<th class="TieuDe_TTdvtt hoten">Họ Tên</th>';
                    echo'<th class="TieuDe_TTdvtt ngaysinh">Ngày sinh</th>';
                    echo'<th class="TieuDe_TTdvtt">Giới tính</th>';
                    echo'<th class="TieuDe_TTdvtt diachi">Địa chỉ</th>';
                    echo'<th class="TieuDe_TTdvtt">Số điện thoại</th>';
                    echo'<th class="TieuDe_TTdvtt">Email</th>';
                    echo'<th class="TieuDe_TTdvtt">Mã đơn vị thực tập</th>';
                    echo'<th class="TieuDe_TTdvtt">Delete</th>';
                    echo'<th class="TieuDe_TTdvtt">Edit</th>';
                echo'</tr>';
        //Vòng lặp
        while($row = mysqli_fetch_array($thucHien)){
                echo'<tr class="row_TTdvtt">';
                    echo'<td class="thongTinHang">'.$row['MSCB'].'</td>';
                    echo'<td class="thongTinHang hoten">'.$row['HoTen'].'</td>';
                    echo'<td class="thongTinHang ngaysinh">'.$row['NgaySinh'].'</td>';
                    echo'<td class="thongTinHang">'.$row['GioiTinh'].'</td>';
                    echo'<td class="thongTinHang DicChiDVTT diachi">'.$row['DiaChi'].'</td>';
                    echo'<td class="thongTinHang">'.$row['SDT'].'</td>';
                    echo'<td class="thongTinHang">'.$row['Email'].'</td>';
                    echo'<td class="thongTinHang">'.$row['MaDVTT'].'</td>';
                    echo'<td class="thongTinHang"> <input class="DanhDau" type="checkbox" name="checkbox[]" value="'.$row['MSCB'].'"> </td>';
                    echo'<td class="thongTinHang">'."<a href='CanBoHuongDan/CapNhatMauTin_cbhd.php?MSCB=".$row['MSCB']."'> <i class='fa-solid fa-pen-to-square'></i> </a>".'</td>';
                echo'</tr>';
        }
                echo'<tr class="thongTinHang">';
                    echo'<td colspan="10"><input type="submit" value="Delete" id="delete" name="delete"/></td>';
                echo'</tr>';

            echo'</table>';    
        echo'</form>';
    }
    BangThongTinCanBo();
?> 