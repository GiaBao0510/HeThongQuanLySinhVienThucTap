//Biểu mẫu kiểm tra điều điện đăng ký tìa khoản
function BieuMauDangKy_TKCBHD(){
    let BieuMau = document.forms['bieuMauDangKy_CBHD'];
    
    //Kiểm tra họ tên
    let hoten = BieuMau['HoTen'];
    if(hoten.value.length < 4){
        alert('Phần điền Họ&Tên phải trên 4 ký tự.');
        return false;
    }

    //Kiểm tra mã số giáo viên
    let MSSV = BieuMau['MSCB'].value;
    let regMSSV = /^cbhd[0-9]{3}$/;
    if(regMSSV.test(MSSV) == false){
        alert('Mã số cán bộ không hợp lệ.');
        return false;
    }
    
    //Kiểm tra mã khoa
    let malop = BieuMau['MaDVTT'];
    if(malop.value.length < 4){
        alert('Mã đơn vị thực tập không hợp lệ.');
        return false;
    }

    //Kiểm tra mật khẩu
    let password = BieuMau['MatKhau'];
    if(password.value.length == 0){
        alert('Phần điền Mật khẩu không được bỏ trống.');
        return false;
    }

    //Kiểm tra ngày sinh
    let NgaySinh = BieuMau['NgaySinh'];
    if(NgaySinh.value == ""){
        alert('Vui lòng điền ngày sinh không được bỏ trống.');
        return false;
    }

    //Kiểm tra email
    let Email = BieuMau['Email'];
    if(Email.value.length == 0){
        alert('Phần điền email không được bỏ trống.');
        return false;
    }

    //Kiểm tra số điện thoại
    let regSDT = /((09|08|07|03|05)+([0-9]{8})\b)/g;
    let sdt = BieuMau['SDT'].value;
    if(regSDT.test(sdt) == false){
        alert("Số điện thoại không hợp lệ.");
        return false;
    }

    //Kiểm tra địa chỉ
    let diachi = BieuMau['DiaChi'];
    if(diachi.value.length < 10){
        alert('Phần điền địa chỉ phải lớn hơn 10 ký tự.');
        return false;
    }

    if(true){
        alert("Đăng ký thành công");
        return true;
    }
}
/*Biểu mẫu kiểm tra điều kiện cập nhật */
function BieuMauCapNhat_TKCBHD(){
    let BieuMau = document.forms['BieuMauCapNhatCanBo'];
    
    //Kiểm tra họ tên
    let hoten = BieuMau['HoTen'];
    if(hoten.value.length < 4){
        alert('Phần điền Họ&Tên phải trên 4 ký tự.');
        return false;
    }

    //Kiểm tra mã số cán bộ
    let MSSV = BieuMau['MSCB'].value;
    let regMSSV = /^cbhd[0-9]{3}$/;
    if(regMSSV.test(MSSV) == false){
        alert('Mã số cán bộ không hợp lệ.');
        return false;
    }

    //Kiểm tra mật khẩu
    let password = BieuMau['MatKhau'];
    if(password.value.length == 0){
        alert('Phần điền Mật khẩu không được bỏ trống.');
        return false;
    }

    //Kiểm tra ngày sinh
    let NgaySinh = BieuMau['NgaySinh'];
    if(NgaySinh.value == ""){
        alert('Vui lòng điền ngày sinh không được bỏ trống.');
        return false;
    }

    //Kiểm tra email
    let Email = BieuMau['Email'];
    if(Email.value.length == 0){
        alert('Phần điền email không được bỏ trống.');
        return false;
    }

    //Kiểm tra số điện thoại
    let regSDT = /((09|08|07|03|05)+([0-9]{8})\b)/g;
    let sdt = BieuMau['SDT'].value;
    if(regSDT.test(sdt) == false || sdt.length < 10){
        alert("Số điện thoại không hợp lệ.");
        return false;
    }

    //Kiểm tra giới tính cán bộ
    let regSex = /^(M|F){1}$/;
    let gioiTinh =  BieuMau['GioiTinh'].value;
    if(regSex.test(gioiTinh) == false || gioiTinh == ''){
        alert("Phần điền giới tính không hợp lệ. Chỉ chọn M: Nam, F: Nữ");
        return false;
    }

    //Kiểm tra địa chỉ
    let diachi = BieuMau['DiaChi'];
    if(diachi.value.length < 10){
        alert('Phần điền địa chỉ phải lớn hơn 10 ký tự.');
        return false;
    }

    if(true){
        alert("Cập nhật thành công");
        return true;
    }
}
//Biểu mẫu kiểm tra điều điện thêm tài khoản
function BieuMauTao_TKCBHD(){
    let BieuMau = document.forms['bieuMauDangKy_CBHD'];
    
    //Kiểm tra họ tên
    let hoten = BieuMau['HoTen'];
    if(hoten.value.length < 4){
        alert('Phần điền Họ&Tên phải trên 4 ký tự.');
        return false;
    }

    //Kiểm tra mã số cán bộ
    let MSSV = BieuMau['MSCB'].value.length;
    if(MSSV < 4){
        alert('Tài khoản cán bộ phải có ít nhất 5 ký tự.');
        return false;
    }
    
    //Kiểm tra mã khoa
    let malop = BieuMau['MaDVTT'];
    if(malop.value.length < 4){
        alert('Mã đơn vị thực tập không hợp lệ.');
        return false;
    }

    //Kiểm tra mật khẩu
    let password = BieuMau['MatKhau'];
    if(password.value.length == 0){
        alert('Phần điền Mật khẩu không được bỏ trống.');
        return false;
    }

    //Kiểm tra ngày sinh
    let NgaySinh = BieuMau['NgaySinh'];
    if(NgaySinh.value == ""){
        alert('Vui lòng điền ngày sinh không được bỏ trống.');
        return false;
    }

    //Kiểm tra email
    let Email = BieuMau['Email'];
    if(Email.value.length == 0){
        alert('Phần điền email không được bỏ trống.');
        return false;
    }

    //Kiểm tra số điện thoại
    let regSDT = /((09|08|07|03|05)+([0-9]{8})\b)/g;
    let sdt = BieuMau['SDT'].value;
    if(regSDT.test(sdt) == false){
        alert("Số điện thoại không hợp lệ.");
        return false;
    }

    //Kiểm tra địa chỉ
    let diachi = BieuMau['DiaChi'];
    if(diachi.value.length < 10){
        alert('Phần điền địa chỉ phải lớn hơn 10 ký tự.');
        return false;
    }

    if(true){
        return true;
    }
}

//Biểu mẫu kiểm tra số điểm được chấm
function RangBuocChamDiem(){
    let BieuMau = document.forms['FchamDiemSinhVien'];
    
    //Kiểm tra chữ số
    let diemSo = BieuMau['DiemCham[]'];

    for(i=0 ; i<diemSo.length ; i++){
        if(diemSo[i].value.trim() === ''){
            Swal.fire('Không được bỏ trống ô điểm số.');
            return false;
        }
        if(diemSo[i].value < 0 || diemSo[i].value > 10){
            Swal.fire('Ô này cần điền chữ số có giá trị từ 0 - 10.');
            return false;
        }
    }
    
    //Kiểm tra ô nhận xét
    let DienNhanXet = document.forms['FchamDiemSinhVien']['NhanXetVeSinhVien'];
    if(DienNhanXet.value.length == 0){
        Swal.fire('Vui lòng ghi nhận xét về sinh viên trong suốt quá trình thực tập.');
        return false;
    }

    //Kiểm tra ô đánh giá
    let DemKT = 0;
    let ONhanXet = document.querySelectorAll('input[type="checkbox"][name="DanhGia[]"][class="OcheckDanhGia"]');
    for(const check of ONhanXet){
        if(check.checked ){
            DemKT = 1;
        }
    }
    if(DemKT < 1){
        Swal.fire('Vui lòng Chọn ít nhất 1 ô đánh giá về sinh viên..');
        return false;
    }

    if(true){
        return true;
    }
}