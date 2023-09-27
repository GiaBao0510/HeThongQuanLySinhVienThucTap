<?php
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
        return strval( LayChuoiChuCaiDau($Ma).IndexIncrease(LayChuoiSoCuoiChuoi($Ma)) );
    }
?>