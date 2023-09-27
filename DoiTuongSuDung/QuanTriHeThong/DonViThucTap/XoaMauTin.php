<?php
    //2. Thực hiện xóa mẫu tin trong bảng đơn vị thực tập
    function XoaMauTin_dvtt(){
        
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
                    $truyvan1 = "DELETE FROM donvithuctap WHERE MaDVTT = '$value' ";
                    $truyvan2 = "DELETE FROM taikhoan WHERE UserID = '$value' ";
                    //Thực hiện xóa
                    $thucHien1 = mysqli_query($connect,$truyvan1) or die(mysqli_connect_error());
                    $thucHien1 = mysqli_query($connect,$truyvan2) or die(mysqli_connect_error());
                }
                //header("");
            }
        }
        header("Location: ../../../DoiTuongSuDung/QuanTriHeThong/TrangChu.php");
    }
    XoaMauTin_dvtt();
    
?>
<a href="../../../DoiTuongSuDung/TrangDungChung/KetNoi.php"></a>