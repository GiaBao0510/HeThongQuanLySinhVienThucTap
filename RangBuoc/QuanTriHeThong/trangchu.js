window.addEventListener('load', ()=>{
    
//1.Mở tắt giữa trang bảng tin và trang thêm thông tin

    //1.1 Nếu bấm nút chuyển trang thêm thông tin thì nút này cùng với trang bảng tin đều tắt và bên kia sẽ mở 
    $(".NutChuyenTrangThemMauTin").click(function () { 
        //Ẩn
        $(".NutChuyenTrangThemMauTin").hide();
        $(".BangThongTin").hide();
        //Hiện
        $(".NutChuyenTrangBangTin").show();;
        $(".BangThemThongTin").show();
    });
    
    //1.2 Nếu bấm nút chuyển trang Bảng tin thì trang thêm mẫu tin và nút đều tắt và bên kia sẽ mở
    $(".NutChuyenTrangBangTin").click(function () { 
        //hiện
        $(".NutChuyenTrangThemMauTin").show();
        $(".BangThongTin").show();
        //ẩn
        $(".NutChuyenTrangBangTin").hide();;
        $(".BangThemThongTin").hide();
    });


//2.Hiển thị danh sách phiếu
    $('.DanhSachMo').click(function (e) { 
        e.preventDefault();
        //Hiện
        $('.DanhSachDong').show();
        $('.DanhSachPhieu').show();
        //Ẩn
        
        $('.DanhSachMo').hide();

    });
    $('.DanhSachDong').click(function (e) { 
        e.preventDefault();
        //Hiện
        $('.DanhSachMo').show();
        //Ẩn
        $('.DanhSachPhieu').hide();
        $('.DanhSachDong').hide();
    });
});

//Thông Báo xóa thành công cho các mẫu tin vừa xóa
function ThongBaoXoaThanhCong(){
    alert("Xóa thành công.");
};

//Tải lại trang
function TaiLaiTrang(){
    window.location.reload();
    location.reload();
}