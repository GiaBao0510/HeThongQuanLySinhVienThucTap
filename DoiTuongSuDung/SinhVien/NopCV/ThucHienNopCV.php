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
    }

    if(empty($_POST['MaDVTT'])){
        echo'<script async>
                alert("Vui lòng chọn đơn vị thực tập.");
                history.back();
            </script>';
    }else{
        $maDV =  trim(strval( $_POST['MaDVTT'] ));
        $massv = trim(strval($_POST['MaSSV']));
        //echo  $maDV;
        //Kiểm tra xen sinh veein có từng nộp CV cho đơn vị thực tập nào chưa nếu không thì thực hiện.Ngược lại thì hiện ra thông báo
        $DaNopCVChua = "SELECT COUNT(MaDVTT) dem
                        FROM phieutiepnhansinhvienthuctapthucte
                        WHERE MSSV = '$massv'";
        $ThucHienKT = mysqli_query($connect,$DaNopCVChua);
        $KetQuaKT = intval(mysqli_fetch_array($ThucHienKT)['dem']);
        
        if($KetQuaKT < 1){
            $thucHien = "UPDATE phieutiepnhansinhvienthuctapthucte SET MaDVTT = '$maDV ' WHERE MSSV = '$massv'";
            $chay = TruyVan($thucHien);
            echo'<script async>
                    alert("Nộp giấy giới thiệu thành công.");
                    history.back();
                </script>';
        }else{
            echo'<script async>
                    alert("Bạn đã nộp giấy giới thiệu rồi.");
                    history.back();
                </script>';
        }
    }
?> 