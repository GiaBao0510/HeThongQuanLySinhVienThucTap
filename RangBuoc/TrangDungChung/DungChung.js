/* Trích xuất năm hiện tại */
window.addEventListener("load", ()=>{
    let namhientai = new Date();
    let hienThiNam = document.getElementById("NamHienTai");
    hienThiNam.innerHTML = namhientai.getFullYear();
});