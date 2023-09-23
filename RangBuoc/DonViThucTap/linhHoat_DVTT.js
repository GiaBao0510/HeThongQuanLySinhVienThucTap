function DangKyTaiKhoanDVTT(){

    let BieuMau_dvtt = document.forms['BieuMauDangKyDonViThucTap'];

    //kiểm tra tên đơn vị thực tập không được rỗng
    let ten_dvtt =  BieuMau_dvtt['tenDonViThucTap'];
    if(ten_dvtt.value.length == 0){
        alert("Tên đơn vị thực tập không được rỗng.");
        return false;
    }

    //Kiểm tra email
    let email = BieuMau_dvtt['Email_DVTT'];
    if(email.value.length == 0){
        alert("Phần điền email không được rỗng.");
        return false;
    }

    //Kiểm tra số điện thoại
    let regSDT = /((09|08|07|03|05)+([0-9]{8})\b)/g;
    let sdt = BieuMau_dvtt['sdt_dvtt'].value;
    if(regSDT.test(sdt) == false){
        alert("Số điện thoại không hợp lệ.");
        return false;
    }

    //Kiểm tra mật khẩu đâu vào
    let regPW = /^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[!@#$%^&*-+<>?;:])[A-Za-z0-9!@#$%^&*-+<>?;:]{12,}$/;
    let mk1 = BieuMau_dvtt['pw_dvtt'].value;
    if(regPW.test(mk1) == false){
        alert("Mật khẩu ít nhất phải 12 ký tự và trong đó có ít nhất có chữ cái hoa, chữ số và ký tự đặt biệt.");
        return false;
    }
    let xacNhanPW = BieuMau_dvtt['xacNhanPW_dvtt'].value;
    if(mk1 !== xacNhanPW){
        alert("Xác minh mật không khớp.",xacNhanPW);
        return false;
    }

    //Kiểm tra địa chỉ
    let diachi_dvtt = BieuMau_dvtt['diaChi_dvtt'].value.length;
    if(diachi_dvtt < 10  || diachi_dvtt == 0){
        alert("Số ký tự trong địa chỉ phải lớn hơn 10 ký tự.");
        return false;
    }

    //Nếu các ràng buộc được đáp ứng thì mới thêm dữ liệu vào CSDL
    if(true){
        alert("Thêm thành công.");
        return true;
    }
}
