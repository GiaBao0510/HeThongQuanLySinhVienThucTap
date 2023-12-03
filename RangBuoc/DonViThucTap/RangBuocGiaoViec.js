function BieuMauGiaoViec(){
    let bieuMau = document.forms['bieuMauGiaoViec'];
    
    //Kiểm tra xem các ô nội dung công việc có điền đầy đủ hay chưa
    let noiDung = bieuMau['congViec[]'];
    for(i=0 ;i<noiDung.length ;i++){
        if(noiDung[i].value.trim() === ''){
            alert("Nôi dung công việc của các tuần thực tập không được bỏ trống. Vui lòng kiểm tra lại");
            return false;
        }
    }

    //Kiểm tra xem có ô giờ có điền đầy đủ hay chưa và không âm
    let gio = bieuMau['Gio[]'];
    for(i=0 ;i<gio.length ;i++){
        if(gio[i].value.trim() === ''){
            alert("Giờ làm việc của các tuần thực tập không được bỏ trống. Vui lòng kiểm tra lại");
            return false;
        }
        if(gio[i].value < 0  || gio[i].value > 8){
            alert("Giờ làm việc của các tuần thực tập không âm và không vượt quá 8 giờ làm việc. Vui lòng kiểm tra lại");
            return false;
        }
    }

    //Kiểm tra xem có ô buổi có điền đầy đủ hay chưa và không âm
    let buoi = bieuMau['Buoi[]'];
    for(i=0 ;i<buoi.length ;i++){
        if(buoi[i].value.trim() === ''){
            alert("Buổi làm việc của các tuần thực tập không được bỏ trống. Vui lòng kiểm tra lại");
            return false;
        }
        if(buoi[i].value < 0  || buoi[i].value > 8){
            alert("Buổi làm việc của các tuần thực tập không âm và không vượt quá 7 buổi đi làm. Vui lòng kiểm tra lại");
            return false;
        }
    }

    //Kiểm tra xem có tích vào điều kiện thực tập hay không
    let dkthuctap = bieuMau['DieuKienTT[]'];
    let datich = 1;
    for(i=0 ;i<buoi.length ;i++){
        if(dkthuctap[i].value.trim() === ''){
            datich =0;
        }
    }
    if(datich < 1){
        alert("Vui lòng tích vào chỗ điều kiện thực tập.");
            return false;
    }

    //Nếu các ràng buộc được đáp ứng thì mới thêm dữ liệu vào CSDL
    if(true){
        alert("Cập nhật thành công.");
        return true;
    }
}