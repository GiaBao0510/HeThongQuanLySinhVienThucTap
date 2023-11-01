window.addEventListener('load',()=>{
    $('#NutHienThiBangSinhVienChuaNhanHuongDan').click(function (e) { 
        e.preventDefault();
        $('.KhungChuyenSinhVienChoGiangVien').css("display","block");
    });
    $('.NutTat').click(function (e) { 
        e.preventDefault();
        $('.KhungChuyenSinhVienChoGiangVien').css("display","none");
    });
});