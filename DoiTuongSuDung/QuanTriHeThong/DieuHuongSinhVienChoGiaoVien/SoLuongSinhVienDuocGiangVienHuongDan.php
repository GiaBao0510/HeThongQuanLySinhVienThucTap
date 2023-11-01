<link rel="stylesheet" href="style.css">
    <!--PHP-->
    <?php
        include ('../../../web_site/DoiTuongSuDung/TrangDungChung/KetNoi.php');
        include ('../../../web_site/DoiTuongSuDung/TrangDungChung/CacHamXuLy.php');
        /*1.HIển thị số lượng các giảng viên hướng dẫn kèm theo số lượng sinh viên hướng dẫn
        được chỉ định sẵn và thêm nút cập nhật số lượng*/
        $ThongTinGiangVienHuongDan = DS_GiangVienHuongDan();
    ?>

    <table class="ThongTin_DVTT">
        <tr class="row_TTdvtt">
            <th class="TieuDe_TTdvtt">Mã số giảng viên</th>
            <th class="TieuDe_TTdvtt">Họ tên</th>
            <th class="TieuDe_TTdvtt">Số sinh viên hướng dẫn</th>
            <th class="TieuDe_TTdvtt">Cập nhật</th>
        </tr>

        <?php
            while($row = mysqli_fetch_array($ThongTinGiangVienHuongDan)){
                echo '<tr class="row_TTdvtt">
                        <td class="thongTinHang">'.$row ["MSGV"].'</td>
                        <td class="thongTinHang">'.$row ["HoTen"].'</td>';
                        //Điều kiện hiển thị nếu giáo viên không có sinh viên nào được hướng dẫn thực tập thì in
                        if(SoLuongSinhVienDuocGiaoVienHuognDan($row["MSGV"])['soLuong'] < 1){
                            echo"<td class='thongTinHang'>Chưa nhận hướng dẫn sinh viên nào.</td>";
                        }else{//Ngược lại thì in con số
                            echo '<td class="thongTinHang">'.SoLuongSinhVienDuocGiaoVienHuognDan($row ["MSGV"])['soLuong'].'</td>';
                        }
                echo'        <td class="thongTinHang"><a href="../QuanTriHeThong/DieuHuongSinhVienChoGiaoVien/ChuanBiCapNhatSoLuong.php?MSGV='.$row ["MSGV"].'">Cập nhật</a></td>
                    </tr>';
            }
        ?>
    </table>
