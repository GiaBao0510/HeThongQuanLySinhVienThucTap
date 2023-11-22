<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác nhận thêm đơn vị thực tập</title>

    </head>
    <body>
        <?php
            //header("Access-Control-Allow-Methods: GET, POST");
            header('Access-Control-Allow-Methods: POST');
            //Thêm phần kết nối
            include('../../TrangDungChung/KetNoi.php');
            //Thêm phần hàm xử lý
            include('../../TrangDungChung/CacHamXuLy.php');


            if(empty($_POST['tenDonViThucTap']) || empty($_POST['diaChi_dvtt']) ||
            empty($_POST['sdt_dvtt']) || empty($_POST['Email_DVTT']) ||
            empty($_POST['pw_dvtt']) ){
                echo '<script>
                        alert("Thêm thất bại vì một số trường bị bỏ trống hoặc không hợp lệ");
                        history.back();
                    </script>';
            }else{
                //Câu lệnh lấy mã định danh cuối cùng trong bảng
                $TruyXuatMaDinhDanh = "SELECT MaDVTT FROM donvithuctap ORDER BY MaDVTT DESC LIMIT 1;";
                $KetQuaThucThi1 = mysqli_query($connect,$TruyXuatMaDinhDanh);
                $MaDinhDanhCuoiBang = mysqli_fetch_array($KetQuaThucThi1);
                $new_id = IncreaseIDIndex($MaDinhDanhCuoiBang['MaDVTT']);

                //Câu lệnh thêm đơn vị thực tập
                $sql = "INSERT INTO donvithuctap VALUES('".$new_id." ',' ".$_POST['tenDonViThucTap']." ','".$_POST['diaChi_dvtt']."','".$_POST['sdt_dvtt']."','".$_POST['Email_DVTT']."') ";
                
                //Câu lệnh thêm tài khoản cho đơn vị thực tập
                $userRole = '3';
                $Account = "INSERT INTO taikhoan VALUES('".$new_id."','".$_POST['pw_dvtt']."','".$userRole."') ";

                //Điều kiện trước khi thêm mẫu tin vào bảng đơn vị thực tập và bảng tài khoản
                if(!empty($_POST['tenDonViThucTap']) and !empty($_POST['diaChi_dvtt']) and !empty($_POST['sdt_dvtt']) and !empty($_POST['Email_DVTT'])){
                    //Thực hiện thêm
                    $KetQuaThucThi2 = mysqli_query($connect,$sql) or die(mysqli_connect_error());
                    $KetQuaThucThi3 = mysqli_query($connect,$Account) or die(mysqli_connect_error());

                    echo "<script>
                            alert('Thêm tài khoản thành công');
                            history.back();
                            
                        </script>";
                }
            }
            //Đóng
            mysqli_close($connect);
        ?>

    </body>
</html>

