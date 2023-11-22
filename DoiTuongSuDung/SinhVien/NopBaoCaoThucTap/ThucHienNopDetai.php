<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include('../../TrangDungChung/KetNoi.php');
    include('../../TrangDungChung/CacHamXuLy.php');

    $upLoad = 1;
    $NoiLuuTru ="../../DeTai/";
    $TepTepTinDuocNop = $_FILES['fileToUpload']['name'];
    //Lấy thông tin sinh viên
    $mssv = $_GET['MSSV'];
    $mscb = "";
    $msgv = "";
    $MaKH = infNienKhoa_NamBatDau(date('Y'))['MaKH'];
    $STT = ThongTinDotThucTap(date('Y'))['STT'];
    $DuongDanDeLuu = $NoiLuuTru.$TepTepTinDuocNop;

    //  >>> Kiểm tra điều bình thường
    // //Ải 1: Kiểm tra xem sinh viên đã được đơn vị thực tập nhận hay chưa
    if(KiemTraSV_DuocNhanThucTapTaiDonVi($mssv) < 1){
        echo "<script>
                alert('Sinh Viên chưa có đơn vị thực tập nhận. Nên không thể nộp.');
                history.back();
            </script>";
        $upLoad = 0 ;
    }else{
        $mscb = infPhieuTheoDoiSinhVien($mssv)['MSCB'];
    }

    // //Ải 2: kiểm tra xem sinh viên đã được giáo viên 
    if(checkSinhVienDaDuoc_GiangVienNhanThucTap($mssv) <1 ){
        echo "<script>
                alert('Sinh Viên chưa được giảng viên phê nhận thực tập. Nên không thể nộp.');
                history.back();
            </script>";
            $upLoad = 0;
    }elseif(empty(infPhieuTheoDoiSinhVien($mssv)['MSGV'])){
        echo "<script>
                alert('Sinh Viên chưa được giảng viên phê nhận thực tập. Nên không thể nộp.');
                history.back();
            </script>";
            $upLoad = 0;
    }else{
        $msgv = infPhieuTheoDoiSinhVien($mssv)['MSGV'];
    }

    //Ải 3: Kiểm tra sinh viên đẫ được cán bộ chấm điểm hay chưa
    if(checkSinhVienDaDuoc_CanBoChamDiem($mssv) < 1){
        echo "<script>
                alert('Sinh Viên chưa được cán bộ hướng dẫn chấm điểm. Nên không thể nộp.');
                history.back();
            </script>";
        $upLoad = 0;
    }
    

    //Thư mục dùng để lưu trữ tập tin
    //0. Kiểm tra xem đường dẫn tồn tại hay không
    if(!is_dir($NoiLuuTru)){
        mkdir($NoiLuuTru);
    }

    //Chỉ định đường dẫn của tệp tin được tải lên
    $TepTin = $NoiLuuTru . basename($_FILES['fileToUpload']['name']);   
    
    //Biến này dùng để kiểm tra nếu tải lên thành công thì là 1 , ngược lại là 0
    

    //1.Kiểm tra đuôi tệp tin 
    $allowedExtentions = array('doc','docx','otd');
    $fileName = $_FILES['fileToUpload']['name'];
    
    //Sử dụng hàm pathinfo dùng để lấy phần mở rộng của file
    $fileExtention = pathinfo($fileName, PATHINFO_EXTENSION);
    if(!in_array($fileExtention,$allowedExtentions)){
        $upLoad = 0;
    }
    echo "<p>Điều kiện 1: ".$upLoad."</p>";

    //2.Kiểm tra tệp tin này có tồn tại trong thư mục hay chưa
    if(KiemTraFileTonTai($NoiLuuTru) == 0){
        $upLoad = 0;
    }
    echo "<p>Điều kiện 2: ".$upLoad."</p>";
    
    //3.Kiểm tra xem biến upload nếu có giá trị là không thì thông báo rằng không thể lưu
    if($upLoad == 0){
        echo "<script>
                alert('Sorry, your file was not uploaded');
                history.back();
            </script>";
    }else{
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $TepTin)){
            //1.Kiểm tra xem có đề tài nào được tạo hay chưa
            $KT_TonTaiDeTai = "SELECT COUNT(*) dem FROM detai";
            $ThucHien_KT_TonTaiDeTai = mysqli_fetch_array(TruyVan($KT_TonTaiDeTai))['dem'];
            //2.Nếu chưa có tạo để tài mới & lưu:
            if($ThucHien_KT_TonTaiDeTai < 1){
                $DeTaiDauTien = "INSERT INTO detai(MaDeTai,MSSV,MSGV,MSCB,MaKH,STT,NoiLuuTru) 
                    VALUES('dt01','".$mssv."','".$msgv."','".$mscb."','".$MaKH."','".$STT."','".$DuongDanDeLuu."')";
                $act_DeTaiDauTien = TruyVan($DeTaiDauTien);
            }
            //3.Nếu có rồi tạo đề tài tiếp thao & lưu:
            else {
                $LayMaCuoi = "SELECT MaDeTai FROM detai ORDER BY MaDeTai LIMIT 1";
                $MaDeTaiCuoi = mysqli_fetch_array(TruyVan($LayMaCuoi))['MaDeTai'];
                $maMoi = IncreaseIDIndex($MaDeTaiCuoi);
                $DeTaiTiepTheo = "INSERT INTO detai(MaDeTai,MSSV,MSGV,MSCB,MaKH,STT,NoiLuuTru) 
                    VALUES('".$maMoi."','".$mssv."','".$msgv."','".$mscb."','".$MaKH."','".$STT."','".$DuongDanDeLuu."')";
                $act_DeTaiTiepTheo = TruyVan($DeTaiTiepTheo);
            }
            echo "<script>
                    
                    alert('Your file upload was successful.');
                    history.back();
                </script>";
        }else{
            echo "<script>
                    
                    alert('Sorry, there was an error uploading  your file.');
                    history.back();
                </script>";
        }
    }
?> 
