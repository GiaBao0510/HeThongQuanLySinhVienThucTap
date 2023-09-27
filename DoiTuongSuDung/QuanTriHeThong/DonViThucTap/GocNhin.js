window.addEventListener('load',()=>{
    let bangChinh = document.getElementById('BieuMauDangKyDonViThucTap');
    //Nếu độ rộng màn hình mà nhỏ hơn 800px thì trở về 1 cột 
    if(window.innerWidth < 800){
        bangChinh.style.display = none;
        bangChinh.style.gridTemplateAreas = none;
    }
});