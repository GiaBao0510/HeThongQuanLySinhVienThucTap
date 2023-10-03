<link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/SinhVien/GiaoDienTaoTaiKhoanSV.css">
<script src="../../../RangBuoc/QuanTriHeThong/trangchu.js"></script>
<?php
    //1. Hiển thị bảng thông tin
    function BangThongTinSinhVien(){
        //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
        include ('../../../web_site/DoiTuongSuDung/TrangDungChung/KetNoi.php');

        //Câu lệnh truy vấn và thực hiện
        $truyVan = "SELECT * FROM sinhvien";
        $thucHien = mysqli_query($connect,$truyVan);

        //IN bảng
        echo"<form action='SinhVien/XoaMauTinSV.php' method='post' class='BangHienThi_SV' onsubmit='ThongBaoXoaThanhCong()'>";
            echo'<table class="ThongTin_DVTT">';
                echo'<tr class="row_TTdvtt">';
                    echo'<th class="TieuDe_TTdvtt">MSSV</th>';
                    echo'<th class="TieuDe_TTdvtt">Họ Tên</th>';
                    echo'<th class="TieuDe_TTdvtt">Ngày sinh</th>';
                    echo'<th class="TieuDe_TTdvtt">Giới tính</th>';
                    echo'<th class="TieuDe_TTdvtt">Địa chỉ</th>';
                    echo'<th class="TieuDe_TTdvtt">Số điện thoại</th>';
                    echo'<th class="TieuDe_TTdvtt">Email</th>';
                    echo'<th class="TieuDe_TTdvtt">Số căn cước</th>';
                    echo'<th class="TieuDe_TTdvtt">Mã lớp</th>';
                    echo'<th class="TieuDe_TTdvtt">Delete</th>';
                    echo'<th class="TieuDe_TTdvtt">Edit</th>';
                echo'</tr>';
        //Vòng lặp
        while($row = mysqli_fetch_array($thucHien)){
                echo'<tr class="row_TTdvtt">';
                    echo'<td class="thongTinHang">'.$row['MSSV'].'</td>';
                    echo'<td class="thongTinHang">'.$row['HoTen'].'</td>';
                    echo'<td class="thongTinHang">'.$row['NgaySinh'].'</td>';
                    echo'<td class="thongTinHang">'.$row['GioiTinh'].'</td>';
                    echo'<td class="thongTinHang DicChiDVTT">'.$row['DiaChi'].'</td>';
                    echo'<td class="thongTinHang">'.$row['SDT'].'</td>';
                    echo'<td class="thongTinHang">'.$row['Email'].'</td>';
                    echo'<td class="thongTinHang">'.$row['CCCD'].'</td>';
                    echo'<td class="thongTinHang">'.$row['MaLop'].'</td>';
                    echo'<td class="thongTinHang"> <input class="DanhDau" type="checkbox" name="checkbox[]" value="'.$row['MSSV'].'"> </td>';
                    echo'<td class="thongTinHang">'."<a href='SinhVien/CapNhatMauTin_sv.php?MSSV=".$row['MSSV']."'> <i class='fa-solid fa-pen-to-square'></i> </a>".'</td>';
                echo'</tr>';
        }
                echo'<tr class="row_TTdvtt">';
                    echo'<td colspan="11"><input type="submit" value="Delete" id="delete" name="delete"/></td>';
                echo'</tr>';

            echo'</table>';    
        echo'</form>';
    }
    BangThongTinSinhVien();
?>