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
        global$connect;
        $layThongTin = "SELECT * 
        FROM giangvienhuongdan gv INNER JOIN taikhoan tk ON gv.MSGV =tk.UserID
                                INNER JOIN khoa ON gv.MaKhoa = khoa.MaKhoa
        WHERE gv.MSGV= '$Ma' AND tk.UserRole='2'";
        $ThucHanh = mysqli_query($connect,$layThongTin ) or die(mysqli_connect_error());
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
        global $connect;
        $sql ="SELECT * 
            FROM phieutiepnhansinhvienthuctapthucte
            WHERE MSSV = '$mssv'";
        $Chay = mysqli_query($connect,$sql) or die(mysqli_connect_error());
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
                        ORDER BY  IDCongViec DESC
                        LIMIT 1";
            $IDCV_cuoi = mysqli_fetch_array(TruyVan($TruyVanID_CVcuoi));
            $IDnew = IncreaseIDIndex($IDCV_cuoi['IDCongViec']);
            $themCongViec = "INSERT INTO congviec VALUES('$IDnew','$moTaCongViec','$gioLamViec','$buoiLamViec')";
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
        }else{
            return 0;
        }
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
        return  mysqli_fetch_array($truyvan)['NhanXet'];
    }
?>