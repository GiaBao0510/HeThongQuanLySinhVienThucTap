<link rel="stylesheet" href="../../../DinhDangWebSite/DonViThucTap/DVTT.css">
<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $MSCB = $_GET['MSCB'];
    $MaDVTT = $_GET['DVTT'];

    //$MSCB = mysqli_real_escape_string($connect,$MSCB);
    echo $MSCB;
    echo $MaDVTT;
    /*1. Nếu số lượng sinh viên hướng dẫn > 0 thì hiển thị bảng chuyển 
    sinh viên cho  cán bộ khác hướng dẫn*/
    if(SoLuongSinhVien_CanBoHuognDan($MSCB) > 0){
?>
        <div class="KhungDieuPhoiSinhVien">
            <form action="ThucHienDieuPhoiSinhVien.php?MSCB=<?php echo $MSCB;?>" method="post" enctype="application/x-www-form-urlencoded">
                <table>
                    <tr class="TieuDeBangDanhSachSV">
                        <th colspan="6">Số lượng sinh viên hướng dẫn</th>
                    </tr>
                    <tr class="TieuDeBangDanhSachSV">
                        <th>Mã số sinh viên</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngành</th>
                        <th>Khoa</th>
                        <th>Điều phối</th>
                    </tr>
                    <?php
                        
                        $LietKeSV = LietKeSinhVien_CanBoHuognDan($MSCB);
                        while($row = mysqli_fetch_array($LietKeSV)){
                            $ttSinhVien = infSinhVien($row['MSSV']);
                            echo '<tr class="MauTinSV">';
                                echo '<td>'.
                                        $ttSinhVien['MSSV'].
                                        '<input type="hidden" name="MSSV[]" value='.$ttSinhVien['MSSV'].'>
                                    </td>';
                                echo '<td>'.$ttSinhVien['HoTen'].'</td>';
                                echo '<td>'.$ttSinhVien['GioiTinh'].'</td>';
                                echo '<td>'.NganhHocCuaSinhVien($ttSinhVien['MaLop'])['TenNganh'].'</td>';
                                echo '<td>'.NganhThuocKhoa(NganhHocCuaSinhVien($ttSinhVien['MaLop'])['MaNganh'])['tenKhoa'].'</td>';
                                echo '<td>';
                                    echo '<select name="MSCBnew[]">';
                                        $DScanBo = DScanBoHuongDan_MaDVTT($MaDVTT);
                                        while($hang = mysqli_fetch_array($DScanBo)){
                                            if($hang['MSCB'] !== $MSCB){
                                                echo '<option value='.$hang['MSCB'].' >'.$hang['HoTen'].'</option>';
                                            }
                                            
                                        }
                                    echo '</select>'; 
                                echo'</td>';
                            echo '</tr>';
                        }
                    ?>
                    <tr>
                        <td colspan="6">
                            <button type="submit" class="NutGui"> Cập nhật</button>
                        </td>
                    </tr>
                </table>
            </form>

        </div> 
<?php    
    }else{
        if(KT_CanBoDaChamDiemChoSinhVien($MSCB) < 1){
            $Null_PhieuGiaoViec = "UPDATE phieugiaoviecsinhvienthuctap
                                SET MSCB = NULL
                                WHERE MSCB = '$MSCB'";
        $Null_PhieuTheoDoi = "UPDATE phieutheodoisinhvienthuctap
                                SET MSCB  = NULL
                                WHERE MSCB = '$MSCB'";
        $Null_PhieuTiepNhan = "UPDATE phieutiepnhansinhvienthuctapthucte
                                SET MSCB  = NULL
                                WHERE MSCB = '$MSCB'";
        $Delete_CanBo = "DELETE FROM canbohuongdan WHERE MSCB = '$MSCB' ";
        $Delete_taiKhoan = "DELETE FROM taikhoan WHERE UserID = '$MSCB' ";
        //Xóa
        TruyVan($Null_PhieuGiaoViec);
        TruyVan($Null_PhieuTheoDoi);
        TruyVan($Null_PhieuTiepNhan);
        TruyVan($Delete_CanBo);
        TruyVan($Delete_taiKhoan);
        //Thoát
        echo "<script>
                alert('Xóa Thành công.');
                history.back();
            </script>";
        }
    }
    //Thoát
    echo "<script>
            alert('Không thể xóa vì cán bộ này đã thực hiện chấm điểm.');
            history.back();
        </script>";
?>
