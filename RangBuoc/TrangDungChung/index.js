
//Biểu mẫu kiểm tra điều điện đăng ký tìa khoản
function KiemTraDangNhap(){
    let BieuMau = document.forms['FromDangNhap'];
    
    //Kiểm tra tài khoản không được bỏ trống
    let taikhoan = BieuMau['MaDangNhap'];
    if(taikhoan.value.length == 0){
        alert('Tài khoản không được để trống!');
        $('.NhapMaDangNhap').css("border","2px solid red");
        $('.NhapMaDangNhap') = setTimeout(()=>{
            $('.NhapMaDangNhap').css("border","2px solid rgb(119, 118, 118)");
        },5000);
        return false;
    }

    //Kiểm tra mật khẩu không được bỏ trống
    let PW = BieuMau['MatKhauDangNhap'];
    if(PW.value.length == 0){
        alert('Mật khẩu không được để trống!');
        $('.MatKhauDangNhap').css("border","2px solid red");
        $('.MatKhauDangNhap') = setTimeout(()=>{
            $('.MatKhauDangNhap').css("border","2px solid rgb(119, 118, 118)");
        },5000);
        return false;
    }
    if(true){
        return true;
    }
}