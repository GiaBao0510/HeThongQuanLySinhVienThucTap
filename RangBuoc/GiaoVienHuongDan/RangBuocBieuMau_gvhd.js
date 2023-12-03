//Biểu mẫu kiểm tra điều điện đăng ký tìa khoản
function BieuMauDangKy_TKGVHD(){
    let BieuMau = document.forms['bieuMauDangKy_GVHD'];
    
    //Kiểm tra họ tên
    let hoten = BieuMau['HoTen'];
    if(hoten.value.length < 4){
        alert('Phần điền Họ&Tên phải trên 4 ký tự.');
        return false;
    }

    //Kiểm tra mã số giáo viên
    let MSSV = BieuMau['MSGV'].value;
    let regMSSV = /^gvhd[0-9]{3}$/;
    if(regMSSV.test(MSSV) == false){
        alert('Mã số giáo viên không hợp lệ.');
        return false;
    }
    
    //Kiểm tra mã khoa
    let malop = BieuMau['MaKhoa'];
    if(malop.value.length < 4){
        alert('Mã khoa không hợp lệ.');
        return false;
    }

    //Kiểm tra mật khẩu
    let password = BieuMau['pw_gvhd'];
    if(password.value.length == 0){
        alert('Phần điền Mật khẩu không được bỏ trống.');
        return false;
    }

    //Kiểm tra ngày sinh
    let NgaySinh = BieuMau['ngaySinh'];
    if(NgaySinh.value == ""){
        alert('Vui lòng điền ngày sinh không được bỏ trống.');
        return false;
    }

    //Kiểm tra email
    let Email = BieuMau['Email_gvhd'];
    if(Email.value.length == 0){
        alert('Phần điền email không được bỏ trống.');
        return false;
    }

    // //Kiểm tra số điện thoại
    // let regSDT = /((09|08|07|03|05)+([0-9]{8})\b)/g;
    // let sdt = BieuMau['sdt_gv'].value;
    // if(regSDT.test(sdt) == false){
    //     alert("Số điện thoại không hợp lệ.");
    //     return false;
    // }

    // //Kiểm tra căn cước công dân
    // let cccd = BieuMau['cccd'].value;
    // let regCCCD = /^[0-9]{12}$/;
    // if(regCCCD.test(cccd) == false){
    //     alert('Căn cước công dân không hợp lệ.');
    //     return false;
    // }

    // //Kiểm tra địa chỉ
    // let diachi = BieuMau['diaChi_gv'];
    // if(diachi.value.length < 10){
    //     alert('Phần điền địa chỉ phải lớn hơn 10 ký tự.');
    //     return false;
    // }

    if(true){
        alert("Đăng ký thành công");
        return true;
    }
}