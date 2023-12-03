<?php
    include('KetNoi.php');
    
    //Tạo các session với các giá trị mặc định
    function update_value_session($key,$value){
        echo"<p>".$key."</p>";
        echo"<p>".$value."</p>";
        $_SESSION[$key]=$value;
    }

    //0.Hàm thực hiện truy xuất dựa trên câu truy vấn
    function TruyVan($truyvan){
        global $connect;
        $truyvan = trim(strval($truyvan));
        $ThucHien = mysqli_query($connect,$truyvan);
        return $ThucHien;
    }

    //1.Hàm dùng để kiểm tra xem câu truy vẫn có trống hay không (Chỉ in kết quả kiểm tra)
    function KiemTraTruyVan_in($cauTV){
        if(!empty($cauTV)){
            echo "\nCâu truy vấn OK.";
        }else{
            echo "\nCâu truy vấn rỗng.";
        }
    }

    //2.Hàm dùng để kiểm tra xem câu truy vẫn có trống hay không (Chỉ in kết quả kiểm tra rỗng)
    function KiemTraCauTruyVan($cauTV){
        if(!empty($cauTV)){
            $cauTV = $cauTV;
        }else{
            echo "\nCâu truy vấn rỗng.";
        }
    }

    //3. Hàm này kiểm tra xem dữ liệu có trả về hay không sau khi thực hiện truy vấn (print Yes/No)
    function KiemTraThucThucTruyVan_in($result){
        if($result){
            echo "\nOK có kết quả rồi. In ra thôi";
        }else{
            echo "\nKhông có dữ liệu nào được trả về";
        }
    }

    //4.Hàm lấy chuỗi chữ số sau cùng của mã định danh và hàm này trả về chữ số
    function LayChuoiSoCuoiChuoi($string){
        //4.1 Lấy độ dài chuỗi
        $length = strlen($string)-1;
        $ketQua = "";
        
        //4.2 Lặp kiểm tra - nếu gặp ký tự chữ cái thì hủy
        while($length >= 0){
            $temp = $string[$length];

            //Kiểm tra ký tự lấy ra có phải số hay không
            if(is_numeric($temp)){
                $ketQua = $temp.$ketQua;
            }else{  //Hủy
                break;
            }
            $length -=1;
        }
        return $ketQua;
    }

    //5.Hàm làm tăng giá trị số cuối chuỗi
    function IndexIncrease($chuoi){
        //1.Ép chuỗi về dạng số nguyên
        $soNguyen = intval($chuoi);
        //2. Tăng lên 1 đơn vị
        $soNguyen +=1;
        //3.Kiểm tra nếu để ép về dạng chuỗi, nếu nhỏ hơn 10 thì chèn thêm ký tự 0
        $ketqua = '';
        if($soNguyen < 10){
            $ketqua = "0".strval($soNguyen);
        }else{
            $ketqua = strval($soNguyen);
        }
        return $ketqua;
    } 

    //6. Hàm lấy ký tự chữ cái của 1 chuỗi nào đó. Không lấy chữ số
    function LayChuoiChuCaiDau($chuoi){
        //4.1 Lấy độ dài chuỗi
        $length = strlen($chuoi)-1;
        $ketQua = "";
        //4.2 Lặp kiểm tra - nếu gặp ký tự chữ cái thì hủy
        $i = intval(0);
        while($i <= $length){
            $temp = $chuoi[$i]; 
            //Kiểm tra ký tự lấy ra có phải số hay không
            if(is_numeric($temp)!=true){
                $ketQua = $ketQua.$temp;
            }else{  //Hủy
                break;
            }
            $i +=1;
        }
        return $ketQua;
    }

    //7. Hàm tăng chỉ số ID của một chuỗi
    function IncreaseIDIndex($Ma){
        $Ma = trim($Ma);
        /*echo "<p> chữ cái: ".LayChuoiChuCaiDau($Ma)."</p>";
        echo "<p> Chữ số cuối chuỗi: ".LayChuoiSoCuoiChuoi($Ma)."</p>";
        echo "<p>Tăng Chữ số cuối chuỗi: ".IndexIncrease(LayChuoiSoCuoiChuoi($Ma))."</p>";*/
        return strval( LayChuoiChuCaiDau($Ma).IndexIncrease(LayChuoiSoCuoiChuoi($Ma)) );
    }

    /*1.Sinh viên */
    function infSinhVien($Ma){
        global $connect;
        $layThongTin = "SELECT * 
        FROM sinhvien sv INNER JOIN taikhoan tk ON sv.MSSV =tk.UserID
                                INNER JOIN lop ON lop.MaLop = sv.MaLop
                                INNER JOIN nganh ON nganh.MaNganh = lop.MaNganh
                                INNER JOIN khoa ON nganh.MaKhoa = khoa.MaKhoa
        WHERE sv.MSSV = '$Ma'";
        $ThucHanh = mysqli_query($connect,$layThongTin ) or die(mysqli_connect_error());
        $ketQua = mysqli_fetch_array($ThucHanh);
        return $ketQua;
    }

    /*2.Giảng viên hướng dẫn */
    function infGiangVienHuongDan($Ma){
        $layThongTin = "SELECT * 
        FROM giangvienhuongdan gv INNER JOIN taikhoan tk ON gv.MSGV =tk.UserID
                                INNER JOIN khoa ON gv.MaKhoa = khoa.MaKhoa
        WHERE gv.MSGV= '$Ma' AND tk.UserRole='2'";
        $ThucHanh = TruyVan($layThongTin);
        $ketQua = mysqli_fetch_array($ThucHanh);
        return $ketQua;
    }

    /*3.Danh sách đơn vị thực tập */
    function DS_donViThucTap(){
        global$connect;
        $layThongTin = "SELECT * FROM donvithuctap";
        $ThucHanh = mysqli_query($connect,$layThongTin ) or die(mysqli_connect_error());
        return $ThucHanh;
    }

    /*4.Lấy thông tin phiếu xác nhận thực tập dựa trên mssv */
    function infPhieuTiepNhanThucTap($Ma){
        global$connect;
        $sql = "SELECT * FROM phieutiepnhansinhvienthuctapthucte WHERE MSSV = '$Ma' ";
        $ThucHien = mysqli_query($connect,$sql) or die(mysqli_connect_error());
        $ThongTin = mysqli_fetch_array($ThucHien);
        return $ThongTin;
    }

    /*5. Lấy Thông tin đợt thực tập dựa trên năm*/
    function ThongTinDotThucTap($Nam){
        global $connect;
        $truyVan = "SELECT * FROM dotthuctap WHERE ngayBatDau like '".$Nam."%' ";
        $Chay = mysqli_query($connect,$truyVan) or die(mysqli_connect_error());
        $ketQua = mysqli_fetch_array($Chay);
        return $ketQua; 
    }

    /*6.Hàm tạo phiếu tiếp nhận sinh viên thực tập (Chỉ thêm ID phiếu, ngày hết hạn,MSSV, STT) */
    function TaoPhieuTiepNhanSinhVien($mssv){
        global $connect;
        //6.1 Kiểm tra xem mã số sinh viên có săn trong csdl không?Nếu có thì không làm gì,Ngược lại thì lam công việc tiếp them
        $ktSV ="SELECT *,COUNT(*) tonTai
            FROM phieutiepnhansinhvienthuctapthucte
            WHERE MSSV ='$mssv' ";
        $thucHienKT = mysqli_query($connect,$ktSV) or die(mysqli_connect_error());
        $ThongTinPhieu = mysqli_fetch_array($thucHienKT);
        $ketQuaKTSV = intval( $ThongTinPhieu['tonTai'] );

        //6.2Nếu chưa tồn tại ta thực hiện công việc tạo phiếu mới
        #Ngược lại dựa vào giá trị cũ tạo phiếu tiếp theo
        if($ketQuaKTSV != 1){
            //echo "Chưa tồn tại";
            $SoLuongPhieu = "SELECT COUNT(*) SoLuongPhieu FROM phieutiepnhansinhvienthuctapthucte";
            $LaySoLuong = mysqli_query($connect,$SoLuongPhieu) or die(mysqli_connect_error());
            $soLuong = intval( mysqli_fetch_array($LaySoLuong)['SoLuongPhieu']);
            //Nếu chưa có phiếu nào thì tạo phiếu mới.
            if($soLuong < 1){
                //echo "Chưa có phiếu nào";
                $ThongTinDotTT= ThongTinDotThucTap(date('Y'));
                $ThemPhieuMoi = "INSERT INTO phieutiepnhansinhvienthuctapthucte (MSPXNTT,ngayHetHan,MSSV,STT) 
                                VALUES('pgt01','".$ThongTinDotTT['ngayBatDau']."','$mssv','".$ThongTinDotTT['STT']."')";
                $ThucHienThemPhieuMoi = mysqli_query($connect,$ThemPhieuMoi) or die(mysqli_connect_error());
            }else{
                //echo "Đã có phiếu";
                //Lấy mã phiếu cuối cùng trong danh sách
                $SoPhieuCuoi = "SELECT *
                                FROM phieutiepnhansinhvienthuctapthucte
                                ORDER BY MSPXNTT DESC
                                LIMIT 1";
                $getSoPhieuCuoi = mysqli_query($connect,$SoPhieuCuoi) or die(mysqli_connect_error());
                $kqSoPhieuCuoi = mysqli_fetch_array($getSoPhieuCuoi)['MSPXNTT'];
                $NewPXT = IncreaseIDIndex($kqSoPhieuCuoi);
                
                //Thêm Thôi
                $Them = "INSERT INTO phieutiepnhansinhvienthuctapthucte (MSPXNTT,ngayHetHan,MSSV,STT) 
                VALUES('".$NewPXT."','".date('Y')."-04-28','$mssv','".ThongTinDotThucTap(date('Y'))['STT']."')";
                $AddPhieuThucTap = mysqli_query($connect,$Them) or die(mysqli_connect_error());
            }
        }
    }

    /*7. Lấy thông tin phiếu tiếp nhận sinh viên thực tập thông qua mã số sinh viên */
    function mssv_PhieuTiepNhanSinhVien($mssv){
        $sql ="SELECT * 
            FROM phieutiepnhansinhvienthuctapthucte
            WHERE MSSV = '$mssv'";
        $Chay = TruyVan($sql);
        $ketQua = mysqli_fetch_array($Chay);
        return $ketQua;
    }

    /*8. Lấy thông tin phiếu tiếp nhận sinh viên thực tập thông qua mã số đơn vị thực tập */
    function madvtt_PhieuTiepNhanSinhVien($maDVTT){
        global $connect;
        $sql ="SELECT * 
            FROM phieutiepnhansinhvienthuctapthucte
            WHERE MaDVTT = '$maDVTT'";
        $Chay = mysqli_query($connect,$sql) or die(mysqli_connect_error());
        return $Chay;
    }

    /*9. Lấy thông tin đơn vị thực tập dựa trên mã đơn vị thực tập*/
    function infDonViThucTap($maDVTT){
        $truyvan = "SELECT * 
                    FROM donvithuctap
                    WHERE MaDVTT = '$maDVTT '";
        $kq = TruyVan($truyvan);
        return mysqli_fetch_array($kq);
    }

    /*10.Hàm tạo phiếu giao việc tự động dựa trên MSSV */
    function taoPhieuGiaoViec($mssv){
        global $connect;
        //6.1 Kiểm tra xem mã số sinh viên có săn trong csdl không?Nếu có thì không làm gì,Ngược lại thì lam công việc tiếp them
        $ktSV ="SELECT *,COUNT(*) tonTai
                FROM phieugiaoviecsinhvienthuctap
                WHERE MSSV ='$mssv' ";
        $thucHienKT = mysqli_query($connect,$ktSV) or die(mysqli_connect_error());
        $ThongTinPhieu = mysqli_fetch_array($thucHienKT);
        $ketQuaKTSV = intval( $ThongTinPhieu['tonTai'] );

        //6.2Nếu chưa tồn tại ta thực hiện công việc tạo phiếu mới
        #Ngược lại dựa vào giá trị cũ tạo phiếu tiếp theo
        if($ketQuaKTSV != 1){
            //echo "Chưa tồn tại";
            $SoLuongPhieu = "SELECT COUNT(*) SoLuongPhieu FROM phieugiaoviecsinhvienthuctap";
            $LaySoLuong = mysqli_query($connect,$SoLuongPhieu) or die(mysqli_connect_error());
            $soLuong = intval( mysqli_fetch_array($LaySoLuong)['SoLuongPhieu']);
            //Nếu chưa có phiếu nào thì tạo phiếu mới.
            if($soLuong < 1){
                //echo "Chưa có phiếu nào";
                $ThongTinDotTT= ThongTinDotThucTap(date('Y'));
                $ThemPhieuMoi = "INSERT INTO phieugiaoviecsinhvienthuctap (MSPGVSV,MSSV,STT) 
                                VALUES('pgv01','$mssv','".$ThongTinDotTT['STT']."')";
                $ThucHienThemPhieuMoi = mysqli_query($connect,$ThemPhieuMoi) or die(mysqli_connect_error());
            }else{
                //echo "Đã có phiếu";
                //Lấy mã phiếu cuối cùng trong danh sách
                $SoPhieuCuoi = "SELECT *
                                FROM phieugiaoviecsinhvienthuctap
                                ORDER BY MSPGVSV DESC
                                LIMIT 1";
                $getSoPhieuCuoi = mysqli_query($connect,$SoPhieuCuoi) or die(mysqli_connect_error());
                $kqSoPhieuCuoi = mysqli_fetch_array($getSoPhieuCuoi)['MSPGVSV'];
                $NewPXT = IncreaseIDIndex($kqSoPhieuCuoi);
                
                //Thêm Thôi
                $Them = "INSERT INTO phieugiaoviecsinhvienthuctap (MSPGVSV,MSSV,STT) 
                VALUES('".$NewPXT."','$mssv','".ThongTinDotThucTap(date('Y'))['STT']."')";
                $AddPhieuThucTap = mysqli_query($connect,$Them) or die(mysqli_connect_error());
            }
        }
    }

    /*11.Hàm tạo phiếu theo dõi công việctự động */
    function taoPhieuTheoDoiSinhVien($mssv){
        global $connect;
        //6.1 Kiểm tra xem mã số sinh viên có săn trong csdl không?Nếu có thì không làm gì,Ngược lại thì lam công việc tiếp them
        $ktSV ="SELECT *,COUNT(*) tonTai
                FROM phieutheodoisinhvienthuctap
                WHERE MSSV ='$mssv' ";
        $thucHienKT = mysqli_query($connect,$ktSV) or die(mysqli_connect_error());
        $ThongTinPhieu = mysqli_fetch_array($thucHienKT);
        $ketQuaKTSV = intval( $ThongTinPhieu['tonTai'] );

        //6.2Nếu chưa tồn tại ta thực hiện công việc tạo phiếu mới
        #Ngược lại dựa vào giá trị cũ tạo phiếu tiếp theo
        if($ketQuaKTSV != 1){
            //echo "Chưa tồn tại";
            $SoLuongPhieu = "SELECT COUNT(*) SoLuongPhieu FROM phieutheodoisinhvienthuctap";
            $LaySoLuong = mysqli_query($connect,$SoLuongPhieu) or die(mysqli_connect_error());
            $soLuong = intval( mysqli_fetch_array($LaySoLuong)['SoLuongPhieu']);
            //Nếu chưa có phiếu nào thì tạo phiếu mới.
            if($soLuong < 1){
                //echo "Chưa có phiếu nào";
                $ThongTinDotTT= ThongTinDotThucTap(date('Y'));
                $ThemPhieuMoi = "INSERT INTO phieutheodoisinhvienthuctap (MSPTDSV,MSSV,STT) 
                                VALUES('ptd01','$mssv','".$ThongTinDotTT['STT']."')";
                $ThucHienThemPhieuMoi = mysqli_query($connect,$ThemPhieuMoi) or die(mysqli_connect_error());
            }else{
                //echo "Đã có phiếu";
                //Lấy mã phiếu cuối cùng trong danh sách
                $SoPhieuCuoi = "SELECT *
                                FROM phieutheodoisinhvienthuctap
                                ORDER BY MSPTDSV DESC
                                LIMIT 1";
                $getSoPhieuCuoi = mysqli_query($connect,$SoPhieuCuoi) or die(mysqli_connect_error());
                $kqSoPhieuCuoi = mysqli_fetch_array($getSoPhieuCuoi)['MSPTDSV'];
                $NewPXT = IncreaseIDIndex($kqSoPhieuCuoi);
                
                //Thêm Thôi
                $Them = "INSERT INTO phieutheodoisinhvienthuctap (MSPTDSV,MSSV,STT) 
                VALUES('".$NewPXT."','$mssv','".ThongTinDotThucTap(date('Y'))['STT']."')";
                $AddPhieuThucTap = mysqli_query($connect,$Them) or die(mysqli_connect_error());
            }
        }
    }

    /*12. Lấy thông tin tuần làm việc dựa trên số tuần */
    function ThongTinTuan($sotuan){
        $truyvan = "SELECT *
                    FROM tuanthuctap
                    WHERE tuan = '$sotuan'";
        return mysqli_fetch_array(TruyVan($truyvan));
    }

    /*13. Hàm thêm mẫu tin vào bảng công việc*/
    function HamThemCongViec($moTaCongViec,$gioLamViec,$buoiLamViec){
        //Đặt lại kiểu dữ liệu
        $moTaCongViec = strval($moTaCongViec);
        $gioLamViec = intval($gioLamViec);
        $buoiLamViec = intval($buoiLamViec);

        //1.Kiểm tra xem có công việc nào không. Nếu không thì tạo mới ID công việc
        $DemCV = "SELECT COUNT(IDCongViec) demCongViec FROM congviec";
        $SoLuongCV = mysqli_fetch_array( TruyVan($DemCV))['demCongViec']; 
        
        if($SoLuongCV < 1){
            $TaoVaThemCongViec = "INSERT INTO congviec VALUES('cv01','$moTaCongViec','$gioLamViec','$buoiLamViec')";
            $truyvan1 = TruyVan($TaoVaThemCongViec);
        }else{
            //Lấy ID công việc ở dòng cuối
            $TruyVanID_CVcuoi = "SELECT * FROM congviec
                                ORDER BY thuTu DESC LIMIT 1";

            $IDCV_cuoi = mysqli_fetch_array(TruyVan($TruyVanID_CVcuoi));
            $IDnew = IncreaseIDIndex($IDCV_cuoi['IDCongViec']);
            $thuTuMoi = intval($IDCV_cuoi['thuTu'] + 1);
            $themCongViec = "INSERT INTO congviec VALUES('$IDnew','$moTaCongViec','$gioLamViec','$buoiLamViec','$thuTuMoi')";
            $truyvan2 = TruyVan($themCongViec);
        }
    }

    /*14. Hàm lấy thông tin phiếu theo dõi sinh viên thực tập dựa trên MSSV*/
    function infPhieuTheoDoiSinhVien($mssv){
        $sql = "SELECT * FROM phieutheodoisinhvienthuctap
                WHERE MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*15. Hàm lấy thông tin phiếu giao việc sinh viên thực tập dựa trên MSSV*/
    function infPhieuGiaoViecSinhVien($mssv){
        $sql = "SELECT * FROM phieugiaoviecsinhvienthuctap
                WHERE MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*16.Lấy thông tin cán bộ hướng dẫn dựa trên mã số cán bộ */
    function infCanBoHuongDan($mscb){
        $sql = "SELECT * FROM canbohuongdan cb 
                INNER JOIN taikhoan tk ON cb.MSCB=tk.UserID
                WHERE MSCB = '$mscb' AND tk.UserRole= 4";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*17. Trả về thông tin ngành học dựa trên mã lớp của sinh viên*/
    function NganhHocCuaSinhVien($malop){
        $sql = "SELECT *
                FROM sinhvien sv INNER JOIN lop ON sv.MaLop = lop.MaLop
                                INNER JOIN nganh N ON N.MaNganh = lop.MaNganh
                WHERE sv.MaLop = '$malop'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*18. Lấy thông tin công việc dự trên mã số*/
    function infCongViec($idcongViec){
        $sql = "SELECT * FROM congviec WHERE IDCongViec = '$idcongViec';";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*19.Hàm trả lại ngày tháng năm theo VietNam */
    function ngayThangNam_VN($date){
        return date('d-m-Y',strtotime($date));
    }

    /*20.Danh sach giảng viên hướng dẫn */
    function DS_GiangVienHuongDan(){
        $sql = "SELECT * FROM giangvienhuongdan";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*21. Số lượng sinh viên được giáo viên hướng dẫn*/
    function SoLuongSinhVienDuocGiaoVienHuognDan($msgv){
        $sql = "SELECT COUNT(*) soLuong 
                FROM phieutiepnhansinhvienthuctapthucte
                WHERE MSGV = '$msgv'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*22. Thông tin khoa */
    function infKhoa($makhoa){
        $sql = "SELECT * FROM khoa WHERE MaKhoa = '$makhoa'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan);
    }

    /*23.Lấy thông tin sinh viên chưa được giáo viên nhận hướng dẫn */
    function SinhVienChuaDuocGVNhanHuongDan(){
        $sql = "SELECT * FROM phieutiepnhansinhvienthuctapthucte
                WHERE MSGV IS NULL";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*23.Lấy thông tin sinh viên được giáo viên nhận hướng dẫn */
    function SinhVienDuocGVNhanHuongDan($mgvhd){
        $sql = "SELECT * FROM phieutiepnhansinhvienthuctapthucte
                WHERE MSGV ='$mgvhd'";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*24. Lấy số lượng phiếu giao việc dựa trên mã giảng viên và sinh viên*/
    function SoLuongPhieuTieGiaoViec_SV_GV($mssv,$msgv){
        $sql = "SELECT COUNT(*) dem 
            FROM phieugiaoviecsinhvienthuctap 
            WHERE MSGV = '$msgv' AND MSSV = '$mssv'";
        $truyvan = mysqli_fetch_array(TruyVan($sql))['dem'];
        return  intval($truyvan);  
    }

    /*25. Lấy thông tin phiếu tiếp nhận sinh viên thực tập thông qua mã số giảng viên */
    function msgv_PhieuTiepNhanSinhVien($msgv){
        global $connect;
        $sql ="SELECT * 
            FROM phieutiepnhansinhvienthuctapthucte
            WHERE MSGV = '$msgv'";
        $Chay = mysqli_query($connect,$sql) or die(mysqli_connect_error());
        return $Chay;
    }

    /*26.Hàm kiểm tra xem sinh viên có được đơn vị thực tập nhận hay chưa */
    function KiemTraSV_DuocNhanThucTapTaiDonVi($mssv){
        $sql = "SELECT tn.MSCB
        FROM phieutiepnhansinhvienthuctapthucte tn 
            INNER JOIN phieutheodoisinhvienthuctap td ON td.MSCB = tn.MSCB
            INNER JOIN phieugiaoviecsinhvienthuctap gv ON gv.MSCB = tn.MSCB
        WHERE tn.MSSV = '$mssv'";
        $Chay = TruyVan($sql);
        
        //Có thì trả về 1
        if(!empty( mysqli_fetch_array($Chay)['MSCB'] )){  //Ngược lại trả về 0
            return 1;
        }
        return 0;
        
    }

    /*26.Hàm kiểm tra xem phiếu theo giao việc có mã số giảng viên hay không */
    function KiemTraMSGV_PhieuGiaoViecDuaTrenSV($mssv){
        $sql = "SELECT COUNT(gv.MSGV) Dem
        FROM phieutiepnhansinhvienthuctapthucte tn 
        INNER JOIN phieugiaoviecsinhvienthuctap gv ON gv.MSSV = tn.MSSV
        WHERE tn.MSSV = '$mssv'";
        $Chay = TruyVan($sql);
        //echo "<p>MSSV:".$mssv."</p>";
        //Có thì trả về 1
        if( intval(mysqli_fetch_array($Chay)['Dem']) < 1){  //Ngược lại trả về 0
            //echo "<p>Đếm:".mysqli_fetch_array($Chay)['Dem']."</p>";
            return 0;
        }else{
            return 1;
        }
    }

    /*26.Hàm kiểm tra xem sinh viên có được chấp thuận cho phép thực tập chính thức hay chưa */
    function KiemTraMSGV_PhieuTheoDoiDuaTrenSV($mssv){
        $sql = "SELECT COUNT(td.MSGV) Dem
        FROM phieutiepnhansinhvienthuctapthucte tn  
        INNER JOIN phieutheodoisinhvienthuctap td ON td.MSSV = tn.MSSV
        WHERE tn.MSSV = '$mssv'";
        $Chay = TruyVan($sql);
        //echo "<p>MSSV:".$mssv."</p>";
        //Có thì trả về 1
        if(intval(mysqli_fetch_array($Chay)['Dem']) < 1){  //Ngược lại trả về 0
            //echo "<p>Đếm:".mysqli_fetch_array($Chay)['Dem']."</p>";
            return 0;
        }else{
            return 1;
        }
    }

    /*27. Lấy thông tin tài khoảng dựa trên mã*/
    function infTaiKhoan($maso){
        $sql = "SELECT UserID, UserRole FROM taikhoan
        WHERE UserID = '$maso'";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*28. Lấy thông tin Khoa dựa trên mã ngành học */
    function NganhThuocKhoa($maNganh){
        $sql = "SELECT * FROM khoa k 
                INNER JOIN nganh n ON k.MaKhoa = n.MaKhoa
                WHERE n.MaNganh = '$maNganh'";
        $truyvan = mysqli_fetch_array(TruyVan($sql));
        return $truyvan;
    }

    /*29. Lấy danh sách cán bộ hướng dẫn dựa trên mã đơn vị thực tập*/
    function DScanBoHuongDan_MaDVTT($mdvtt){
        $sql = "SELECT * 
                FROM donvithuctap dv 
                INNER JOIN canbohuongdan cb ON cb.MaDVTT = dv.MaDVTT
                WHERE dv.MaDVTT = '$mdvtt'";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*30. Lấy số luongj sinh viên hướng dẫn dựa trên mã cán bộ trong phiếu giao việc*/
    function SoLuongSinhVien_CanBoHuognDan($mscb){
        $sql = "SELECT COUNT(*) Dem
                FROM phieugiaoviecsinhvienthuctap
                WHERE MSCB = '$mscb'";
        $truyvan = mysqli_fetch_array(TruyVan($sql));
        return  $truyvan['Dem'];
    }

    /*31. Lấy thông tin từ giấy giới thiệu*/
    function infGiayGioiThieu($mssv){
        $sql = " SELECT * FROM giaygioithieu WHERE MSSV = '$mssv'";
        $truyvan = mysqli_fetch_array(TruyVan($sql));
        return  $truyvan;
    }

    /*32. Hàm lấy tên học vấn dựa trên ID học vấn*/
    function TenHocVan($IDhocVan){
        $sql ="SELECT * FROM trinhdohocvan WHERE IDHocVan = '$IDhocVan'";
        $truyvan = mysqli_fetch_array(TruyVan($sql));
        return  $truyvan['TenHocVan'];
    }

    /*34. Hàm lấy thông tin phiếu theo dõi dựa trên mã số cán bộ*/
    function mscb_PhieuTheoDoiThucTap($mscb){
        $sql = " SELECT * FROM phieutheodoisinhvienthuctap WHERE MSCB = '$mscb'";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*35. Hàm lấy phiếu thoe dõi thông qua mã số sinh viên và mã số cán bộ*/
    function mscb_mssv_PhieuThoeDoiThucTap($mscb,$mssv){
        $sql = "SELECT * 
                FROM phieutheodoisinhvienthuctap 
                WHERE MSCB = '$mscb' AND MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*36.Tìm chi tiết phiếu theo dõi và phiếu giao việc thông qua mã phiếu theo dõi */
    function msptd_ChiTietPhieuTheoDoiVaPhieuDanhGia($msptd){
        $sql = " SELECT * 
                FROM chitietphieudanhgiavaphieutheodoi
                WHERE MSPTDSV = '$msptd'";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*37. Lấy nhận xét từ bảng chi tiết đánh giá và theo dõi*/
    function LayNhanXetTuBangChiTietDanhGiaVaTheoDoi($IDcongViec,$msptdtt){
        $sql = " SELECT NhanXet 
            FROM chitietphieudanhgiavaphieutheodoi
            WHERE MSPTDSV = '$msptdtt' AND IDCongViec = '$IDcongViec'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*38. Lấy thông tin về niên khóa dựa trên thời điểm bắt đầu */
    function infNienKhoa_NamBatDau($nam){
        $sql = "SELECT * FROM nienkhoa
                    WHERE TDBatDau LIKE '$nam'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*39. HIển thị toàn bộ thông tin nội dung đánh giá  */
    function All_InfNoiDungDanhGia(){
        $sql = "SELECT * FROM noidungdanhgia";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*40 Lấy phiếu đánh giá báo cáo kết quả thực tập thông qua mã số sinh viên và mã số cán bộ*/
    function mscb_mssv_PhieuDanhGiaKetQuaThucTap($mssv,$mscb){
        $sql ="SELECT * 
            FROM phieudanhgiaketquathuctap 
            WHERE MSCB = '$mscb' AND MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*41. Lấy thông tin chi tiết đánh giá kết qur thực tập thông qua ID và mã phiếu đánh giá*/
    function MSPDGKQTT_ID_chiTietPhieuDanhGiaKetQua($mspdgkqtt,$ID){
        $sql = "SELECT * 
                FROM chitietphieudanhgiaketquathuctap
                WHERE MSPDGKQTT = '$mspdgkqtt' AND ID = '$ID'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }
    
    /*42. Lấy thông tin phiếu đánh giá kết quả thực tập thông qua mã*/
    function infPhieuDanhGiaKetQuaThucTap($mspdgkqtt){
        $sql = "SELECT * 
                FROM phieudanhgiaketquathuctap
                WHERE MSPDGKQTT = '$mspdgkqtt'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*43. Lấy thông tin cụ thể về chi tiết mức độ chương trình đào tạo thông qua mã phiếu đánh giá kết quả*/
    function MSPDGKQTT_MucDoChuongTrinhDaoTao($mspdkqtt){
        $sql= "SELECT * 
                FROM chitietmucdochuongtrinhdaotao ct 
                INNER JOIN mucdochuongtrinhdaotao  md ON ct.IDMucDoCT = md.IDMucDoCT
                WHERE ct.MSPDGKQTT = '$mspdkqtt'";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*44. Hàm kiểm tra tệp tin có tồn tại hay chưa dựa trên đường dẫn*/
    function KiemTraFileTonTai($path){
        $path = trim($path); 
        if(file_exists($path)){
            return 1;
        }
        return 0;
    }

    /*47. Kiểm tra đuôi file có hợp lệ không*/
    function KiemTraDuoiFileHopLe($file){
        if($file != "doc" && $file != "docx" && $file != "otd" ){
            return 1;
        }
        return 0;
    }

    /*50. Lấy tổng điểm phiếu đánh giá kết quả thực tập thông qua MSPDGKQTT trong bảng chi tiết phiếu đánh giá kết quả thực tập*/
    function DanhGiaKetQuaThucTap($mspdgkqtt){
        $sql = "SELECT ROUND(SUM(Diem),3) TongDiem 
                FROM chitietphieudanhgiaketquathuctap
                WHERE MSPDGKQTT = '$mspdgkqtt'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan)['TongDiem'];
    }

    /*51. Kiểm tra trong bảng chi tiết phiếu đánh giá kết quả có MSPDGKQTT hay chưa*/
    function KTmspdgkqtt_ChiTietPhieuDanhGiaKetQuaTT($mspdgkqtt){
        $sql = "SELECT COUNT(*)Dem 
                from chitietphieudanhgiaketquathuctap
                WHERE MSPDGKQTT = '$mspdgkqtt'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan)['Dem'];
    }

    /*52. Kiểm tra xem sinh viên đã có phiếu đánh giá kết quả thực tập hay chưa thông qua mssv*/
    function SinhVienCo_PhieuDanhGiaKetQuaTT($mssv){
        $sql = "SELECT COUNT(*)Dem 
                from phieudanhgiaketquathuctap
                WHERE MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan)['Dem'];
    }

    /*53 Lấy phiếu đánh giá báo cáo kết quả thực tập thông qua mã số sinh viên*/
    function mssv_PhieuDanhGiaKetQuaThucTap($mssv){
        $sql ="SELECT * 
            FROM phieudanhgiaketquathuctap 
            WHERE MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*54. Kiểm tra sinh viên có được giáo viên chấp nhận cho thực tập hay chưa*/
    function checkSinhVienDaDuoc_GiangVienNhanThucTap($mssv){
        $sql ="SELECT COUNT(td.MSGV) dem
            FROM phieutheodoisinhvienthuctap td
            INNER JOIN phieugiaoviecsinhvienthuctap gv ON gv.MSGV = td.MSGV
            WHERE gv.MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        $dem = mysqli_fetch_array($truyvan)['dem'];
        if($dem < 1){
            return 0;
        }
        return  1;
    }

    /*55. Kiểm tra sinh viên có được cán bộ chấm điểm thực tập hay chưa*/
    function checkSinhVienDaDuoc_CanBoChamDiem($mssv){
        $sql ="SELECT COUNT(ct.Diem) DemSoDiem
        FROM phieudanhgiaketquathuctap dg 
        INNER JOIN chitietphieudanhgiaketquathuctap ct ON ct.MSPDGKQTT = dg.MSPDGKQTT
        INNER JOIN sinhvien sv ON sv.MSSV = dg.MSSV
        WHERE sv.MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        $dem = mysqli_fetch_array($truyvan)['DemSoDiem'];
        if($dem < 10){
            return 0;
        }
        return  1;
    }


    /*57. Kiểm tra sinh viên đã nộp báo cáo hay chưa*/
    /*58. Lấy thông tin phiếu theo dõi và phiếu giao việc dựa trên mã sinh viên*/
    function MSGV_PhieuGiaoViec($msgv){
        $sql = "SELECT *
                FROM phieutheodoisinhvienthuctap td 
                WHERE td.MSGV = '$msgv'";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*59. Lấy thông tin tất cả nội dung báo cáo*/
    function All_InfNoiDungBaoCao(){
        $sql = "SELECT * FROM noidungbaocao";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*60. Kiểm tra sinh viên có trong phiếu đánh giá báo cáo hay chưa*/
    function mssv_CheckPhieuDanhGiaBaoCao($mssv){
        $sql = "SELECT COUNT(*) dem
        FROM phieudanhgiabaocaoketqua
        WHERE MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*61. Hàm tính tổng điểm của sinh viên khi được cán bộ hướng dẫn chấm*/
    function TongDiem_PhieuDanhGiaKetQua($mssv){
        if(checkSinhVienDaDuoc_CanBoChamDiem($mssv) == 0){
            return -1;
        }else{
            $sql ="SELECT ROUND(SUM(ct.Diem),3) TongSoDiem
                FROM phieudanhgiaketquathuctap dg 
                    INNER JOIN chitietphieudanhgiaketquathuctap ct 
                ON ct.MSPDGKQTT = dg.MSPDGKQTT
                    INNER JOIN sinhvien sv 
                ON sv.MSSV = dg.MSSV
                WHERE sv.MSSV = '$mssv'";
            $truyvan = TruyVan($sql);
            return  mysqli_fetch_array($truyvan)['TongSoDiem'];
        }
    }

    /*62.Lấy Phiếu đánh giá báo cáo dựa trên MSSV*/
    function mssv_PhieuDanhGiaBaoKetQua($mssv){
        $sql = "SELECT * FROM phieudanhgiabaocaoketqua
                WHERE MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan);
    }

    /*63. Lấy điểm số phiếu đánh giá kết qẩu dựa trên MSSV*/
    function LayDiemSoDanhGiaKetQua_mssv($mssv){
        $sql = "SELECT *
                FROM phieudanhgiaketquathuctap dg 
                INNER JOIN chitietphieudanhgiaketquathuctap ct
                ON dg.MSPDGKQTT = ct.MSPDGKQTT
                WHERE dg.MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*62. Lấy điểm số kết quả thực tập cụ thể dựa trên mã phiếu và ID nội dung*/
    function LayMotDiem_PhieuDAnhGiaKetQua($mspdkqtt,$ID){
        $sql = "SELECT *
                FROM phieudanhgiaketquathuctap dg 
                INNER JOIN chitietphieudanhgiaketquathuctap ct
                ON dg.MSPDGKQTT = ct.MSPDGKQTT
                WHERE dg.MSPDGKQTT = '$mspdkqtt' AND ct.ID = '$ID'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['Diem'];
    }
    
    //63. Kiểm tra xem sinh viên đã được giáo viên đánh giá báo cáo hay chưa
    function checkSinhVienDaDuoc_GiangVienChamDiem($mssv){
        $sql = "SELECT COUNT(*) dem 
                FROM phieudanhgiabaocaoketqua p 
                INNER JOIN chitietdanhgiabaocao ct ON ct.MSPDGBCKQTT = p.MSPDGBCKQTT
                INNER JOIN sinhvien sv ON sv.MSSV = p.MSSV
                WHERE sv.MSSV = '$mssv'";
        $truyVan = mysqli_fetch_array(TruyVan($sql))['dem'];
        if($truyVan < 10){
            return 0;
        }
        return 1;
    }

    /*62. Lấy điểm số kết quả đánh giá báo cáo thực tập cụ thể dựa trên mã phiếu và ID nội dung*/
    function LayMotDiem_PhieuDAnhGiaBaoCaoKetQua($MSPDGBCKQTT,$ID){
        $sql = "SELECT *
            FROM phieudanhgiabaocaoketqua dg 
            INNER JOIN chitietdanhgiabaocao ct
            ON dg.MSPDGBCKQTT = ct.MSPDGBCKQTT
            WHERE dg.MSPDGBCKQTT = '$MSPDGBCKQTT' AND ct.IDndbc = '$ID'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['DiemSo'];
    }

    /*63. Hàm lấy sô lượng sinh viên*/
    function SoLuongSinhVien(){
        $sql = "SELECT COUNT(*) dem FROM sinhvien sv 
                INNER JOIN phieutiepnhansinhvienthuctapthucte p 
                ON sv.MSSV = p.MSSV
                WHERE p.STT = (SELECT STT
                            FROM dotthuctap
                            WHERE year(ngayBatDau) = YEAR(CURRENT_DATE()) )";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*64. Hàm lấy sô lượng sinh viên*/
    function SoLuongGiangVien(){
        $sql = "SELECT COUNT(*) dem FROM giangvienhuongdan";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*65. Hàm lấy sô lượng sinh viên*/
    function SoLuongDonViThucTap(){
        $sql = "SELECT COUNT(*) dem FROM donvithuctap";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*65. Hàm lấy sô lượng sinh viên*/
    function SoLuongCanBoHuongDan(){
        $sql = "SELECT COUNT(*) dem FROM canbohuongdan";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*66. Kiểm tra xem sinh viên có được đơn vị thực tập giao việc hay chưa*/
    function KiemTraDaGiaoViecChoSinhVienChua($mssv){
        $sql = "SELECT COUNT(*) dem 
            FROM chitietphieudanhgiavaphieutheodoi ct 
            INNER JOIN phieutiepnhansinhvienthuctapthucte p ON ct.MSPXNTT = p.MSPXNTT
            INNER JOIN sinhvien sv ON sv.MSSV = p.MSSV
            WHERE sv.MSSV = '$mssv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    //67. Lấy hết thông tin cán bộ
    function All_canBo(){
        $sql = "SELECT * FROM canbohuongdan";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*69. Liệt kê sinh viên hướng dẫn dựa trên mã cán bộ trong phiếu giao việc*/
    function LietKeSinhVien_CanBoHuognDan($mscb){
        $sql = "SELECT *
                FROM phieugiaoviecsinhvienthuctap
                WHERE MSCB = '$mscb'";
        $truyvan = TruyVan($sql);
        return  $truyvan;
    }

    /*70. Kiểm tra xem cán bộ hướng dẫn đã có mặt trong phiếu đánh giá kết quả hay chưa*/
    function KT_CanBoDaChamDiemChoSinhVien($mscb){
        $sql = "SELECT COUNT(*) dem
        FROM phieudanhgiaketquathuctap
        WHERE MSCB = '$mscb'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*71. Hàm lấy sô lượng sinh viên*/
    function SoLuongLopHoc(){
        $sql = "SELECT COUNT(*) dem FROM lop";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*72. Hàm lấy sô lượng Tài khoản*/
    function SoLuongTaiKhoan(){
        $sql = "SELECT COUNT(*) dem FROM taikhoan";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*73. Lây dah sách tài khoản*/
    function DS_TaiKhoan(){
        $sql = "SELECT * FROM taikhoan";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*74. Lây dah sách sinh viên*/
    function DS_SinhVien(){
        $sql = "SELECT * FROM sinhvien sv 
                INNER JOIN phieutiepnhansinhvienthuctapthucte p 
                ON sv.MSSV = p.MSSV
                WHERE p.STT = (SELECT STT
                                FROM dotthuctap
                                WHERE year(ngayBatDau) = YEAR(CURRENT_DATE()) )";
        $truyvan = TruyVan($sql);
        return $truyvan;
    }

    /*75. Lấy số lượng sinh viên tại đơn vị thực tập*/
    function SoLuongSinhVien_DonViThucTap($madvtt){
        $sql = "SELECT COUNT(*) dem
            FROM phieutheodoisinhvienthuctap td 
            INNER JOIN canbohuongdan cb ON td.MSCB = cb.MSCB
            INNER JOIN donvithuctap dv ON dv.MaDVTT = cb.MaDVTT
            WHERE dv.MaDVTT ='$madvtt'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan)['dem'];
    }

    /*76. Kiểm tra xem cán bộ tại đơn vị thực tập này có từng chấm điểm cho sinh viên hay chưa*/
    function KiemTraCanBoTaiDonViThucTapDaChamDiemHayChua($maDVTT){
        $sql = "SELECT COUNT(*) dem
            FROM phieudanhgiaketquathuctap p 
            INNER JOIN canbohuongdan cb ON p.MSCB = cb.MSCB
            INNER JOIN donvithuctap dv ON dv.MaDVTT = cb.MaDVTT
            WHERE dv.MaDVTT ='$maDVTT'";
        $truyvan = TruyVan($sql);
        return mysqli_fetch_array($truyvan)['dem'];
    }

    /*77. Kiểm tra xem cán bộ hướng dẫn đã có mặt trong phiếu đánh giá kết quả hay chưa*/
    function KT_GiangVienDaChamDiemChoSinhVien($msgv){
        $sql = "SELECT COUNT(*) dem
                    FROM phieudanhgiabaocaoketqua
                    WHERE MSGV = '$msgv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*77. Kiểm tra xem giảng viên hướng dẫn có mặt trong phiếu giao việc và theo doi hay chua*/
    function MSGV_PhieuGiaoViecVaPhieuTheoDoi($msgv){
        $sql = "SELECT COUNT(*) dem
            FROM phieugiaoviecsinhvienthuctap gv 
            INNER JOIN phieutheodoisinhvienthuctap td ON gv.MSGV = td.MSGV
            WHERE gv.MSGV = '$msgv'";
        $truyvan = TruyVan($sql);
        return  mysqli_fetch_array($truyvan)['dem'];
    }

    /*78. Kiểm tra xem sinh viên đã đăng ký đơn vị thực tập hay chưa*/
    function KiemTraSinhVien_DangKyThucTapHayChua($mssv){
        $sql = "SELECT COUNT(*) dem
                FROM phieutiepnhansinhvienthuctapthucte
                WHERE MSSV = '$mssv'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['dem'];
    }

    /*79. Lấy thông tin sinh viên dựa trên mã số*/
    function mssv_ThongTinSinhVien($mssv){
        $sql = "SELECT * 
                FROM sinhvien 
                WHERE MSSV = '$mssv'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien);
    }

    /*80. Lấy tổng điểm số kết quả thực tập của một sinh viên*/
    function MSSV_TongKetQuaThucTapThucTe($mssv){
        $sql = "SELECT ROUND(diem,3) AS diemso
                FROM(
                    SELECT SUM(Diem) diem
                    FROM phieudanhgiaketquathuctap pkq 
                    INNER JOIN
                    chitietphieudanhgiaketquathuctap ct ON ct.MSPDGKQTT = pkq.MSPDGKQTT
                    WHERE pkq.MSSV = '$mssv'
                ) AS t";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['diemso'];
    }

    /*80. Lấy tổng điểm số kết quả báo cáo thực tập của một sinh viên*/
    function MSSV_TongBaoCaoKetQuaThucTapThucTe($mssv){
        $sql = "SELECT ROUND(diem,3) diemso
                FROM (
                    SELECT SUM(DiemSo) diem
                    FROM phieudanhgiabaocaoketqua pbc 
                    INNER JOIN
                    chitietdanhgiabaocao ct ON ct.MSPDGBCKQTT = pbc.MSPDGBCKQTT
                    WHERE pbc.MSSV = '$mssv'
                ) AS t";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['diemso'];
    }

    /*81. Lấy mã số các bộ thực tập cuối cùng*/
    function LayMaCuoi_CanBoHuongDan(){
        $sql = "SELECT * FROM canbohuongdan
            ORDER BY MSCB DESC LIMIT 1";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['MSCB'];
    }

    /*82. Lấy mã số các bộ thực tập cuối cùng*/
    function LayMaCuoi_DonViThuvTap(){
        $sql = "SELECT * FROM donvithuctap
                ORDER BY MaDVTT DESC LIMIT 1";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['MaDVTT'];
    }

    /*83. Đếm số lượng sinh viên chưa được giáo viên hướng dẫn chấp nhạn thực tập*/
    function SoLuong_SinhVienChuaDuocGVNhanHuongDan(){
        $sql = "SELECT COUNT(*) dem
                FROM phieutiepnhansinhvienthuctapthucte
                WHERE MSGV IS NULL";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['dem'];    
    }

    /*84. Lấy danh sách lớp học*/
    function ds_LopHoc(){
        $sql = "SELECT * FROM lop";
        $thucHien = TruyVan($sql);
        return $thucHien;    
    }

    /*85. Kiểm tra sinh viên có được cán bộ hướng dẫn nhận xét đánh giá hay chưa*/
    function KiemTraSV_DaDuocCanBoNhanXetDanhGia($mssv){
        $sql = "SELECT COUNT(*) dem
                FROM chitietphieudanhgiavaphieutheodoi ct
                INNER JOIN phieutiepnhansinhvienthuctapthucte p ON ct.MSPXNTT = p.MSPXNTT
                INNER JOIN sinhvien sv ON sv.MSSV = p.MSSV
                WHERE sv.MSSV = '$mssv' AND ct.NhanXet IS NOT NULL";
        $thucHien = TruyVan($sql);
        if(mysqli_fetch_array($thucHien)['dem'] == 8){
            return 1;
        } 
        return 0;
    }

    /*86. Lấy mẫu tin của bảng chi tiết phiếu đánh giá và theo dõi dựa trên mã số phiếu theo dõi và tuần thực tập*/
    function LayMauTin_ChiTietPhieuDanhGiaVaTheoDoi($msptd,$tuan){
        $sql = "SELECT *
                FROM chitietphieudanhgiavaphieutheodoi
                WHERE MSPTDSV = '$msptd' AND tuan= '$tuan'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien);  
    }

    /*87. Lấy số luongj sinh viên được nhận vào đơn vị thực tập*/
    function SinhVienTai_DonViThucTap($maDVTT){
        $sql = "SELECT *
                FROM phieutiepnhansinhvienthuctapthucte
                WHERE MaDVTT = '$maDVTT' AND MSCB IS NOT NULL";
        $thucHien = TruyVan($sql);
        return $thucHien; 
    }

    /*88. Lấy số đợt thực tập theo năm*/
    function STT_TheoNamHienTai(){
        $sql = "SELECT STT
                FROM dotthuctap 
                WHERE year(ngayBatDau) = YEAR(CURRENT_DATE() )";
        return mysqli_fetch_array(TruyVan($sql))['STT'];
    }

    /*89. Lấy danh sách phiếu tiếp nhận sinh viên thực tập theo đợt thực tập*/
    function ds_PhieuTiepNhanSinhVien(){
        $sql = "SELECT * 
        FROM phieutiepnhansinhvienthuctapthucte
        WHERE STT = ".STT_TheoNamHienTai()." ";
        $thucHien = TruyVan($sql);
        return $thucHien;
    }

    /*90.MSCB _ thông tin cán bộ*/
    function getCanBoHuongDan($mscb){
        $sql = " SELECT * FROM canbohuongdan 
        WHERE MSCB = '$mscb' ";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien);
    }

    /*91 .MSSV _ thông tin sinh viên*/
    function getSinhVien($mssv){
        $sql = " SELECT * FROM sinhvien 
        WHERE MSSV = '$mssv' ";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien);
    }

    /*92. Lấy danh sách phiếu theo dõi sinh viên thực tập theo đợt thực tập*/
    function ds_PhieuTheoDoiSinhVien(){
        $sql = "SELECT * 
        FROM phieutheodoisinhvienthuctap
        WHERE STT = ".STT_TheoNamHienTai()." ";
        $thucHien = TruyVan($sql);
        return $thucHien;
    }

    /*92. Lấy danh sách phiếu theo dõi sinh viên thực tập theo đợt thực tập*/
    function ds_PhieuGiaoViecSinhVien(){
        $sql = "SELECT * 
        FROM phieugiaoviecsinhvienthuctap
        WHERE STT = ".STT_TheoNamHienTai()." ";
        $thucHien = TruyVan($sql);
        return $thucHien;
    }

    /*93. Lấy danh sách phiếu đánh giá kết quả thực tập dựa trên đợt thực tập*/
    function ds_PhieuDanhGiaKetQua(){
        $sql = "SELECT dg.MSPDGKQTT, dg.MSSV, dg.MSCB, dg.NhanXet, dg.DongGop
            FROM phieutiepnhansinhvienthuctapthucte tn 
            INNER JOIN phieudanhgiaketquathuctap dg ON tn.MSSV = dg.MSSV
            WHERE dg.STT = (SELECT STT
                            FROM dotthuctap 
                            WHERE year(ngayBatDau) = YEAR(CURRENT_DATE()))";
        $thucHien = TruyVan($sql);
        return $thucHien;
    }

    /*94. Lấy danh sách phiếu đánh giá báo cáo kết quả thực tập dựa trên đợt thực tập*/
    function ds_PhieuDanhGiaBaoCaoKetQua(){
        $sql = "SELECT bc.MSPDGBCKQTT, bc.MSSV, bc.MSGV , bc.DiemTru
                FROM phieudanhgiabaocaoketqua bc INNER JOIN phieutiepnhansinhvienthuctapthucte p ON p.MSSV = bc.MSSV
                WHERE p.STT = (SELECT STT
                                FROM dotthuctap 
                                WHERE year(ngayBatDau) = YEAR(CURRENT_DATE()))";
        $thucHien = TruyVan($sql);
        return $thucHien;
    }

    /*95. Kiểm tra số điệm thoại trong đơn vị thực tập có bị tringf hay không*/
    function KiemTraTrungSDT_DVTT($sdt){
        $sql = "SELECT COUNT(*) dem 
                FROM donvithuctap
                WHERE SDT = '$sdt'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['dem'];
    }

    /*95. Kiểm tra email trong đơn vị thực tập có bị tringf hay không*/
    function KiemTraTrungEmail_DVTT($email){
        $sql = "SELECT COUNT(*) dem 
                FROM donvithuctap
                WHERE Email = '$email'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['dem'];
    }

    /*96. Lấy danh sách đơn vị thực tập chưa phê duyệt*/
    function DSdvtt_ChuaDuyet(){
        $sql = "SELECT dv.MaDVTT, dv.TenDVTT, dv.DiaChi, dv.SDT, dv.Email ,tk.MatKhau 
                FROM taikhoan tk 
                INNER JOIN donvithuctap dv ON dv.MaDVTT = tk.UserID
                WHERE tk.UserRole = '5'";
        $thucHien = TruyVan($sql);
        return $thucHien;
    }

    /*97. Đếm có bao nhiêu đơn vị thực tập chưa phê duyệt*/
    function DemDVTT_ChuaDuyet(){
        $sql = "SELECT COUNT(*) dem
                FROM taikhoan tk 
                INNER JOIN donvithuctap dv ON dv.MaDVTT = tk.UserID
                WHERE tk.UserRole = '5'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['dem'];
    }

    /*99. Kiểm tra xem mật khẩu có hợp lệ hay không*/
    function KiemTraTaiKhoanDangNhap($taiKhoan,$pw){
        $sql = "SELECT COUNT(*) dem 
                FROM taikhoan
                WHERE UserID = '$taiKhoan' AND MatKhau = '$pw'";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien)['dem'];
    }

    /*100. Danh sách chờ phê duyệt theo mã số đơn vị thực tập*/
    function DS_ChoPheDuyet_DVTT($maDVTT){
        $sql ="SELECT * 
        FROM phieutiepnhansinhvienthuctapthucte
        WHERE MaDVTT = '$maDVTT' AND MSCB IS NULL ";
        $Chay = TruyVan($sql);
        return $Chay;
    }

    /*101. Lấy mã số cán bộ gần nhất*/
    function MSCB_current(){
        $sql ="SELECT *
        FROM canbohuongdan
        ORDER BY MSCB DESC LIMIT 1  ";
        $Chay = mysqli_fetch_array(TruyVan($sql))['MSCB'];
        return $Chay;
    }

    /*102.MSCB _ thông tin giảng viên hướng dẫn*/
    function getGiangVienHuongDan($MSGV){
        $sql = " SELECT * FROM giangvienhuongdan 
        WHERE MSGV = '$MSGV' ";
        $thucHien = TruyVan($sql);
        return mysqli_fetch_array($thucHien);
    }

    /*103. Đếm số lượng sinh viên xuất sắc*/
    function DemSoLuongSinhVienXuatSat(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo >= 9){
                    $dem++;
                }
            }
        }
        return $dem;
    }

    /*104. Đếm số lượng sinh viên giỏi*/
    function DemSoLuongSinhVienGioi(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo >= 8 and $diemSo <= 8.9){
                    $dem++;
                }
            }
        }
        return $dem;
    }

    /*105. Đếm số lượng sinh viên khá*/
    function DemSoLuongSinhVienKha(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo >= 6.5 and $diemSo <= 7.9){
                    $dem++;
                }
            }
        }
        return $dem;
    }

    /*106. Đếm số lượng sinh viên trung bình*/
    function DemSoLuongSinhVienTrungBinh(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo >= 5.5 and $diemSo <= 6.4){
                    $dem++;
                }
            }
        }
        return $dem;
    }

    /*107. Đếm số lượng sinh viên trung bình yếu*/
    function DemSoLuongSinhVienTrungBinhYeu(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo >= 5.5 and $diemSo <= 6.4){
                    $dem++;
                }
            }
        }
        return $dem;
    }

    /*107. Đếm số lượng sinh viên  yếu*/
    function DemSoLuongSinhVienYeu(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo >= 4.0 and $diemSo <= 5.4){
                    $dem++;
                }
            }
        }
        return $dem;
    }

    /*108. Đếm số lượng sinh viên  Kém*/
    function DemSoLuongSinhVienKem(){
        $dem = 0;
        $dssv = DS_SinhVien();
        while($row = mysqli_fetch_array($dssv)){
            $diemSo = 0;
            if(empty(MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV'])) ){
                $diemSo = 0;
            }else{
                $diemSo = MSSV_TongBaoCaoKetQuaThucTapThucTe($row['MSSV']);
                if($diemSo < 4){
                    $dem++;
                }
            }
        }
        return $dem;
    }

?>