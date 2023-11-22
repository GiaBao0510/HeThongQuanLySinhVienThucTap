// Swal.fire({
//     icon: "error",
//     title: "Oops...",
//     text: "Something went wrong!",
//  });
function BieuMauChamDiem(){
    let bieuMau = document.forms['FchamDiemSinhVien'];
    //Kiểm tra điều kiện thông thường
    let DiemSo = bieuMau['DiemCham[]'];
    for(i=0; i<DiemSo.length; i++){
        if(DiemSo[i].value.trim() === '' && i != 3){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Hãy kiểm tra lại không được bỏ trống ô chấm điểm.",
             });
             return false;
        }
        if(DiemSo[i].value < 0){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Hãy kiểm tra lại không được để các ô chấm điểm < 0.",
             });
             return false;
        }

        //
        if(DiemSo[i].value > 0.5 && (i == 0 || i== 1 || i == 4 || i == 5 || i ==6 || i == 7 || i == 8 || i == 9)){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ô thứ "+(i+1)+" nhận giá trị không hợp lệ. Vui lòng xem lại.",
             });
             return false;
        }

        if(DiemSo[i].value > 1 && (i == 2)){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ô thứ "+(i+1)+" nhận giá trị không hợp lệ. Vui lòng xem lại.",
             });
             return false;
        }
    }

    if(true){
        return true;
    }
}