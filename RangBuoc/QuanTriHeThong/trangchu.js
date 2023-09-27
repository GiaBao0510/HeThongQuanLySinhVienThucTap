window.addEventListener('load', ()=>{
    
//1.Mở tắt giữa trang bảng tin và trang thêm thông tin
    //1.1 Lấy ID
    let BangTin = document.getElementById('BangThongTin');
    let ThemMauTin = document.getElementById('BangThemThongTin');
    let NutChuyen_BT = document.getElementById('NutChuyenTrangBangTin');
    let NutChuyen_TMT = document.getElementById('NutChuyenTrangThemMauTin');

    //1.2 Nếu bấm nút chuyển trang thêm thông tin thì nút này cùng với trang bảng tin đều tắt và bên kia sẽ mở
    NutChuyen_TMT.addEventListener('click',function(){
        //Tắt
        NutChuyen_TMT.style.display = 'none';
        BangTin.style.display = 'none';
        //Mở
        ThemMauTin.style.display = 'block';
        NutChuyen_BT.style.display = 'block';
    });

    //1.3 Nếu bấm nút chuyển trang Bảng tin thì trang thêm mẫu tin và nút đều tắt và bên kia sẽ mở
    NutChuyen_BT.addEventListener('click',function(){
        //Tắt
        NutChuyen_TMT.style.display = 'block';
        BangTin.style.display = 'block';
        //Mở
        ThemMauTin.style.display = 'none';
        NutChuyen_BT.style.display = 'none';
    });
});