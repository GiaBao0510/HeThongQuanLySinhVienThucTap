<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

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
        echo'<scrmysqli_query($connect,$thucHien) ipt async>
                alert("Nộp giấy giới thiệu thành công.");
                history.back();
            </script>';
    }else{
        echo'<script async>
                alert("Bạn đã nộp giấy giới thiệu rồi.");
                history.back();
            </script>';
    }
?> 