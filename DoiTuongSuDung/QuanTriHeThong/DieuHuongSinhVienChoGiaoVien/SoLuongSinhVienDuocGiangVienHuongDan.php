<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="../../../DinhDangWebSite/DieuHuongSinhVienThucTap/DieuHuongSinhVien.css">
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script defer src="../../../RangBuoc/DieuHuongSinhVienTHucTap/CauHinhBangDieuHuong.js"></script>
    </head>
    <body>
        <div>
            <table id="CanChinhBangDieuHuongSinhVienThucTap" class="table table-striped">
                <thead>
                    <tr class="DongTieuDe">
                        <th>Mã số giảng viên</th>
                        <th>Họ tên</th>
                        <th>Số sinh viên hướng dẫn</th>
                        <th>Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ThongTinGiangVienHuongDan = DS_GiangVienHuongDan();
                        while($row = mysqli_fetch_array($ThongTinGiangVienHuongDan)){
                            echo '<tr>
                                    <td>'.$row ["MSGV"].'</td>
                                    <td>'.$row ["HoTen"].'</td>';
                                    //Điều kiện hiển thị nếu giáo viên không có sinh viên nào được hướng dẫn thực tập thì in
                                    if(SoLuongSinhVienDuocGiaoVienHuognDan($row["MSGV"])['soLuong'] < 1){
                                        echo"<td>Chưa nhận hướng dẫn </br> sinh viên nào.</td>";
                                    }else{//Ngược lại thì in con số
                                        echo '<td>'.SoLuongSinhVienDuocGiaoVienHuognDan($row ["MSGV"])['soLuong'].'</td>';
                                    }
                            echo'        <td><a class="button-79" href="../QuanTriHeThong/DieuHuongSinhVienChoGiaoVien/ChuanBiCapNhatSoLuong.php?MSGV='.$row ["MSGV"].'">Cập nhật</a></td>
                                </tr>';
                        } 
                    ?>
                </tbody>
                <tfoot>
                    <tr class="DongTieuDe">
                        <th>Mã số giảng viên</th>
                        <th>Họ tên</th>
                        <th>Số sinh viên hướng dẫn</th>
                        <th>Cập nhật</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>