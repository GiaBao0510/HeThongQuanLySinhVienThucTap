/* Trích xuất năm hiện tại */
window.addEventListener("load", ()=>{
    let namhientai = new Date();
    let hienThiNam = document.getElementById("NamHienTai");
    hienThiNam.innerHTML = namhientai.getFullYear();
});
//1. Hàm này dùng để quay lại trang trước đó
function quayLai(){
    history.back();
}

//2.Tạo thông báo qua lại giữa sinh viên và đơn vị thực tập
var localStorage = window.localStorage;
//Lưu giá trị 
var ThongBaoGuiCV = localStorage.getItem('GuiCV')||0;
var ThongBaoXetDuyetCV = localStorage.getItem('XetDuyetCV')||0;

//2.1 Tạo hàm hiển thị thông báo nếu có sinh viên mới