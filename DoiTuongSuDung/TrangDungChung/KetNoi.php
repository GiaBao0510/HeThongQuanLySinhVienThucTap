<?php
    $_SESSION["ThuNha"] = 0;
?>
<?php
    //Kết nối đến máy chủ
    $connect = mysqli_connect('localhost','root','')  or die(mysqli_connect_error());

    //Kết nối đến cơ sở dữ liệu 
    $db = mysqli_select_db($connect, 'quanlysinhvienthuctap');
?>
