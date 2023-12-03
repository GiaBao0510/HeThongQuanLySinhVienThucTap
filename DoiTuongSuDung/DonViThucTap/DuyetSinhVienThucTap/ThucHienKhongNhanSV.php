<?php
        session_start();
        ob_start();
        include('../../TrangDungChung/KetNoi.php');
        include('../../TrangDungChung/CacHamXuLy.php');
        //Kiểm tra đăng nhập
        if(empty($_SESSION['user']) || empty($_SESSION['pw'])|| $_SESSION['active']== false){
                include('../../TrangDungChung/DangNhapThatBai.php');
        }elseif(KiemTraTaiKhoanDangNhap($_SESSION['user'],$_SESSION['pw']) < 1){
                include('../../TrangDungChung/DangNhapThatBai.php');
        }else{
                $mssv= $_GET['MSSV'];
                $mspxntt= $_GET['MSPXNTT'];
                $maDVTT=$_SESSION['user'];
            
                echo '<p>'.$mssv.'</p>';
                echo '<p>'.$mspxntt.'</p>';
                echo '<p>'.$maDVTT.'</p>';
            
                $sql = "UPDATE phieutiepnhansinhvienthuctapthucte
                        SET MaDVTT = NULL
                        WHERE MSPXNTT ='$mspxntt' 
                        AND MSSV = '$mssv'";
                TruyVan($sql);
            
                //Thoát
                echo "<script>
                        alert('Thực hiện từ chối sinh viên đến thực tập thành công.');
                        history.back();
                    </script>";
        }
?>
