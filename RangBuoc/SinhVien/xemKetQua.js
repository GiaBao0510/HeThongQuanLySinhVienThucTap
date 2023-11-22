$('.oXemKetQua').click(function (e) { 
    e.preventDefault();
    //Hiện
    $('.oXemKetQua').css({"background-image":"linear-gradient(to right,#a6c0fe,#f68084)"});
    $('.KhungKetQuaThucTap').addClass("XuatHien");
    $('.KhungKetQuaThucTap').removeClass("BienMat");
    //Ẩn
    $('.oXemKetQuaBaoCao').css({"background-image":"linear-gradient(to right,#eee,#eee)"});
    $('.KhungKetQuaBaoCao').addClass("BienMat");
    $('.KhungKetQuaBaoCao').removeClass("XuatHien");

});
$('.oXemKetQuaBaoCao').click(function (e) { 
    e.preventDefault();
    //Hiện
    $('.oXemKetQuaBaoCao').css({"background-image":"linear-gradient(to right,#a6c0fe,#f68084)"});
    $('.KhungKetQuaBaoCao').addClass("XuatHien");
    $('.KhungKetQuaBaoCao').removeClass("BienMat");
    //Ẩn
    $('.oXemKetQua').css({"background-image":"linear-gradient(to right,#eee,#eee)"});
    $('.KhungKetQuaThucTap').addClass("BienMat");
    $('.KhungKetQuaThucTap').removeClass("XuatHien");

});
