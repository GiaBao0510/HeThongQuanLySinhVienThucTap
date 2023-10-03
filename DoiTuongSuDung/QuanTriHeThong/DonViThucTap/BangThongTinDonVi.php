<link rel="stylesheet" href="../../../DoiTuongSuDung/QuanTriHeThong/DonViThucTap/GiaoDienBieuMau_DVTT.css">
<script src="../../../RangBuoc/QuanTriHeThong/trangchu.js"></script>
<?php
//1.Hiển thị thông tin bảng đơn vị thực tập
    function BangDonViThucTap(){
        //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
        include ('../../../web_site/DoiTuongSuDung/TrangDungChung/KetNoi.php');

        //------
        $TV_bangDVTT = "SELECT * FROM donvithuctap";
        $kqtv = mysqli_query($connect,$TV_bangDVTT);
        //In bảng
        echo"<form action='DonViThucTap/XoaMauTin.php' method='post' onsubmit='ThongBaoXoaThanhCong()'>";
            echo'<table class="ThongTin_DVTT">';
                echo'<tr class="row_TTdvtt">';
                    echo'<th class="TieuDe_TTdvtt">MaDVTT</th>';
                    echo'<th class="TieuDe_TTdvtt">Tên đơn vị thực tập</th>';
                    echo'<th class="TieuDe_TTdvtt">Địa chỉ</th>';
                    echo'<th class="TieuDe_TTdvtt">Số điện thoại</th>';
                    echo'<th class="TieuDe_TTdvtt">Email</th>';
                    echo'<th class="TieuDe_TTdvtt">Delete</th>';
                    echo'<th class="TieuDe_TTdvtt">Edit</th>';
                echo'</tr>';
        //Vòng lặp
        while($row = mysqli_fetch_array($kqtv)){
                echo'<tr class="row_TTdvtt">';
                    echo'<td class="thongTinHang">'.$row['MaDVTT'].'</td>';
                    echo'<td class="thongTinHang">'.$row['TenDVTT'].'</td>';
                    echo'<td class="thongTinHang DicChiDVTT">'.$row['DiaChi'].'</td>';
                    echo'<td class="thongTinHang">'.$row['SDT'].'</td>';
                    echo'<td class="thongTinHang">'.$row['Email'].'</td>';
                    echo'<td class="thongTinHang"> <input class="DanhDau" type="checkbox" name="checkbox[]" value="'.$row['MaDVTT'].'"> </td>';
                    echo'<td class="thongTinHang">'."<a href='DonViThucTap/CapNhatMauTin_dvtt.php?MaDVTT=".$row['MaDVTT']."'> <i class='fa-solid fa-pen-to-square'></i> </a>".'</td>';
                echo'</tr>';
        }
                echo'<tr class="row_TTdvtt">';
                    echo'<td colspan="4"><input type="submit" value="Delete" id="delete" name="delete"/></td>';
                    echo'<td colspan="3"><input type="submit" value="Edit" id="update" name="update"/></td>';
                echo'</tr>';

            echo'</table>';    
        echo'</form>';
    }
    BangDonViThucTap();
?> 