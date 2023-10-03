//Biểu mẫu kiểm tra điều điện đăng ký tìa khoản
function BieuMauDangKy_TK(){
    let BieuMau = document.forms['bieuMauDangKy_TK'];
    
    //Kiểm tra họ tên
    let userID = BieuMau['UserID'];
    if(userID.value.length < 4){
        alert('Phần điền UserID phải trên 4 ký tự.');
        return false;
    }
    
    //Kiểm tra mã khoa
    let userRole = BieuMau['UserRole'];
    if(userRole.value.length == 0){
        alert('Phần điền UserRole không được bỏ trống.');
        return false;
    }

    //Kiểm tra mật khẩu
    let password = BieuMau['MatKhau'].value;
    let regPW =  /^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[!@#$%^&*-+<>?;:])[A-Za-z0-9!@#$%^&*-+<>?;:]{12,}$/;
    if(regPW.test(password) == false){
        alert("Mật khẩu ít nhất phải 12 ký tự và trong đó có ít nhất có chữ cái hoa, chữ số và ký tự đặt biệt.");
        return false;
    }

    //Kiểm tra xác nhận
    let xacNhanPW = BieuMau['XacNhanMatKhau'].value;
    if(password !== password ){
        alert('Xác minh mật không khớp.',xacNhanPW);
        return false;
    }

    if(true){
        alert("Tạo tài khoản thành công");
        return true;
    }
}