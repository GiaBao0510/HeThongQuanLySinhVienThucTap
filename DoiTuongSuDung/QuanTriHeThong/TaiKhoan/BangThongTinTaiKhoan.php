<link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/CanBoHuongDan/GiaoDienTaoTaiKhoanCBHD.css">
<script src="../../../RangBuoc/QuanTriHeThong/trangchu.js"></script>
<?php
    //1. Hiển thị bảng thông tin
    function BangThongTinTaiKhoan(){
        //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
        include ('../../../web_site/DoiTuongSuDung/TrangDungChung/KetNoi.php');

        //Câu lệnh truy vấn và thực hiện
        $truyVan = "SELECT * FROM taikhoan";
        $thucHien = mysqli_query($connect,$truyVan);

        //IN bảng
        echo"<form action='TaiKhoan/XoaMauTinTK.php' method='post' class='BangHienThi_SV' onsubmit='ThongBaoXoaThanhCong()'>";
            echo'<table class="ThongTin_DVTT">';
                echo'<tr class="row_TTdvtt">';
                    echo'<th class="TieuDe_TTdvtt">UserID</th>';
                    echo'<th class="TieuDe_TTdvtt hoten">Mật khẩu</th>';
                    echo'<th class="TieuDe_TTdvtt ngaysinh">UserRole</th>';
                    echo'<th class="TieuDe_TTdvtt">Delete</th>';
                    echo'<th class="TieuDe_TTdvtt">Edit</th>';
                echo'</tr>';
        //Vòng lặp
        while($row = mysqli_fetch_array($thucHien)){
                echo'<tr class="row_TTdvtt">';
                    echo'<td class="thongTinHang">'.$row['UserID'].'</td>';
                    echo'<td class="thongTinHang hoten">'.$row['MatKhau'].'</td>';
                    echo'<td class="thongTinHang ngaysinh">'.$row['UserRole'].'</td>';
                    echo'<td class="thongTinHang"> <input class="DanhDau" type="checkbox" name="checkbox[]" value="'.$row['UserID'].'"> </td>';
                    echo'<td class="thongTinHang">'."<a href='TaiKhoan/CapNhatMauTin_tk.php?UserID=".$row['UserID']."'> <i class='fa-solid fa-pen-to-square'></i> </a>".'</td>';
                echo'</tr>';
        }
                echo'<tr class="thongTinHang">';
                    echo'<td colspan="5"><input type="submit" value="Delete" id="delete" name="delete"/></td>';
                echo'</tr>';

            echo'</table>';    
        echo'</form>';
    }
    BangThongTinTaiKhoan();
?> 