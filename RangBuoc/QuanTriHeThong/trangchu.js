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

//2. Hiển thị thông số giữa các trang
    //Lấy ID các nút
    let nutTrangChu = document.getElementById('ThongKe'),
        nutSinhVien = document.getElementById('SinhVien'),
        nutGiaoVien = document.getElementById('GiaoVienHuongDan'),
        nutCanBo = document.getElementById('CanBoHuongDan'),
        nutDonViThucTap= document.getElementById('DonViThucTap'),
        nutTaiKhoan = document.getElementById('TaiKhoan'),
    //Lấy ID các bảng thông tin    
        nutdssv = document.getElementById('bs_dssv'),
        nutdsgv = document.getElementById('bs_dsgv'),
        nutdscbhd = document.getElementById('bs_dscbhd'),
        nutdiemso = document.getElementById('bs_diemso'),
        nutsinhvienrot = document.getElementById('bs_sinhvienrot'),
        nutdsdetai = document.getElementById('bs_dsdetai');
    //Lấy ID thông tin bảng
        bangThongKe = document.getElementById('ThongTinThongKe'),
        bangSinhVien = document.getElementById('ThongTinSinhVien'),
        bangGiaoVien = document.getElementById('ThongTinGiaoVienHuongDan'),
        bangCanBo = document.getElementById('ThongTinCanBoHuongDan'),
        bangDSDeTai = document.getElementById('BaoCaoDS_deTai'),
        bangDVTT = document.getElementById('ThongTinDonViThucTap'),
        bangTaiKhoan = document.getElementById('ThongTinTaiKhoan'),
        bangDSSV = document.getElementById('BaoCaoDS_dvtt'),
        bangDSGV = document.getElementById('BaoCaoDS_GVHD'),
        bangDSCBHD = document.getElementById('BaoCaoDS_CBHD'),
        bangDiemSO = document.getElementById('BaoCaoDiemSoThucTap'),
        bangSinhVienRot = document.getElementById('BaoCaoSVThucHienLai');


    //Thực hiện bấm nút rồi hiển thị thông tin
    
    //1.Trang chủ
    nutTrangChu.addEventListener('click',function(){
        //Hiện
        bangThongKe.style.display = "block";
        //Đóng
        bangSinhVien.style.display = bangGiaoVien.style.display = bangCanBo.style.display = 
        bangDVTT.style.display = bangDSSV.style.display = bangTaiKhoan.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDSDeTai.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#ThongKe').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //2.Sinh viên
    nutSinhVien.addEventListener('click',function(){
        //Hiện
        bangSinhVien.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangGiaoVien.style.display = bangCanBo.style.display = 
        bangDVTT.style.display = bangDSSV.style.display = bangTaiKhoan.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDSDeTai.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#SinhVien').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //3.Giáo viên
    nutGiaoVien.addEventListener('click',function(){
        //Hiện
        bangGiaoVien.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangCanBo.style.display = 
        bangDVTT.style.display = bangDSSV.style.display = bangTaiKhoan.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDSDeTai.style.display = bangTaiKhoan.style.display = bangSinhVienRot.style.display = 'none';

         //Tô màu
         $('#GiaoVienHuongDan').addClass('MauMucThongTinKhiChon');
         //Không màu
         $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
         $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
         $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
         $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
         $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
         $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
         $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
         $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
         $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
         $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
         $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //4.Cán bộ hướng dẫn
    nutCanBo.addEventListener('click',function(){
        //Hiện
        bangCanBo.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDVTT.style.display = bangDSSV.style.display = bangTaiKhoan.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDSDeTai.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#CanBoHuongDan').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //5. Đơn vị thực tập
    nutDonViThucTap.addEventListener('click',function(){
        //Hiện
        bangDVTT.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangCanBo.style.display = bangDSSV.style.display = bangTaiKhoan.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDSDeTai.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#DonViThucTap').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //6.Tài khoản
    nutTaiKhoan.addEventListener('click',function(){
        //Hiện
        bangTaiKhoan.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDSDeTai.style.display = bangCanBo.style.display = bangDSSV.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDVTT.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#TaiKhoan').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //7. Danh sách sinh viên
    nutdssv.addEventListener('click',function(){
        //Hiện
        bangDSSV.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDSDeTai.style.display = bangCanBo.style.display =  bangTaiKhoan.style.display =
        bangDSGV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDVTT.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#bs_dssv').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //8. Danh sách giảng viên
    nutdsgv.addEventListener('click',function(){
        //Hiện
        bangDSGV.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDSDeTai.style.display = bangCanBo.style.display =  bangTaiKhoan.style.display =
        bangDSSV.style.display = bangDSCBHD.style.display = bangDiemSO.style.display = 
        bangDVTT.style.display = bangSinhVienRot.style.display = 'none';
        //Tô màu
        $('#bs_dsgv').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //9. Danh sách cán bộ
    nutdscbhd.addEventListener('click',function(){
        //Hiện
        bangDSCBHD.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDSDeTai.style.display = bangCanBo.style.display =  bangTaiKhoan.style.display =
        bangDSSV.style.display = bangDSGV.style.display = bangDiemSO.style.display = 
        bangDVTT.style.display = bangSinhVienRot.style.display = 'none';
        //Tô màu
        $('#bs_dscbhd').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //10. danh sách bảng điểm số
    nutdiemso.addEventListener('click',function(){
        //Hiện
        bangDiemSO.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDSDeTai.style.display = bangCanBo.style.display =  bangTaiKhoan.style.display =
        bangDSSV.style.display = bangDSGV.style.display = bangDSCBHD.style.display = 
        bangDVTT.style.display = bangSinhVienRot.style.display = 'none';

        //Tô màu
        $('#bs_diemso').addClass('MauMucThongTinKhiChon');
        //Không màu 
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //11. Bảng sinh viên rớt
    nutsinhvienrot.addEventListener('click',function(){
        //Hiện
        bangSinhVienRot.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangDSDeTai.style.display = bangCanBo.style.display =  bangTaiKhoan.style.display =
        bangDSSV.style.display = bangDSGV.style.display = bangDSCBHD.style.display = 
        bangDVTT.style.display = bangDiemSO.style.display = 'none';

        //Tô màu
        $('#bs_sinhvienrot').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsdetai').removeClass('MauMucThongTinKhiChon'); 
    });

    //12.Bảng báo cáo đề tài
    nutdsdetai.addEventListener('click',function(){
        //Hiện
        bangDSDeTai.style.display = "block";
        //Đóng
        bangThongKe.style.display = bangSinhVien.style.display = bangGiaoVien.style.display = 
        bangSinhVienRot.style.display = bangCanBo.style.display =  bangTaiKhoan.style.display =
        bangDSSV.style.display = bangDSGV.style.display = bangDSCBHD.style.display = 
        bangDVTT.style.display = bangDiemSO.style.display = 'none';

        //Tô màu
        $('#bs_dsdetai').addClass('MauMucThongTinKhiChon');
        //Không màu
        $('#ThongKe').removeClass('MauMucThongTinKhiChon'); 
        $('#SinhVien').removeClass('MauMucThongTinKhiChon'); 
        $('#GiaoVienHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#CanBoHuongDan').removeClass('MauMucThongTinKhiChon'); 
        $('#DonViThucTap').removeClass('MauMucThongTinKhiChon'); 
        $('#TaiKhoan').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dssv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dsgv').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_dscbhd').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_diemso').removeClass('MauMucThongTinKhiChon'); 
        $('#bs_sinhvienrot').removeClass('MauMucThongTinKhiChon'); 
    });
});

//Thông Báo xóa thành công cho các mẫu tin vừa xóa
function ThongBaoXoaThanhCong(){
    alert("Xóa thành công.");
};