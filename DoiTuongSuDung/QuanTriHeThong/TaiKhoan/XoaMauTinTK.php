<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xóa mẫu tin sinh viên được chọn</title>
    </head>
    <body>
        
        <?php
            //2.Xóa mẫu tin
            function XoaMauTin(){
                //Áp dụng đường dẫn tương đối đến tệp tin ketNoi.php
                include ('../../../DoiTuongSuDung/TrangDungChung/KetNoi.php');
            
                //Kiểm tra xem nếu mảng checkbox này nếu không rỗng thì thực hiện công việc sau
                if(!empty($_POST['checkbox'])){
                    $checkbox = $_POST['checkbox'];
                    //Kiểm tra xem đối tượng checkbox nayf có phải là mảng không
                    if(is_array($checkbox)){
                        //Thực hiện vòng lặp xóa những mẫu tin đã chọn
                        foreach($checkbox as $key => $value ){
                            //Câu lệnh
                            $truyvan1 = "DELETE FROM canbohuongdan WHERE MSCB = '$value' ";
                            $truyvan2 = "DELETE FROM taikhoan WHERE UserID = '$value' ";
                            //Thực hiện xóa
                            $thucHien1 = mysqli_query($connect,$truyvan1) or die(mysqli_connect_error());
                            $thucHien1 = mysqli_query($connect,$truyvan2) or die(mysqli_connect_error());
                        }
                        echo'<p>Xóa thành công</p>';
                    }
                }else{
                    echo'<p>Xóa thất bại</p>';
                }
                header("Location: ../../../DoiTuongSuDung/QuanTriHeThong/TrangChu.php");
            }
            XoaMauTin()
        ?>
    </body>
</html>