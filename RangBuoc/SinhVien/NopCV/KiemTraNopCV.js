//Biểu mẫu kiểm tra điều điện đăng ký tìa khoản
function BieuMauKiemTraChonDVTT(){
    let BieuMau = document.forms['BangChon_DVTT'];
    
    //Kiểm tra có chọn đơn vị thực tập hay chưa
    let ChonDVTT = BieuMau['TenDVTT'];
    if(ChonDVTT.value.length == 0){
        alert("Vui lòng chọn đơn vị thực tập");
        return false;
    }

    if(true){
        return true;
    }
}