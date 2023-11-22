new DataTable('#CanChinhBangDVTT');
new DataTable('#CanChinhBangCanBo');
new DataTable('#CanChinhBangSinhVienTaiDVTT');
function ThongBaoXacNhanXoaDVTT(mdvtt){
    Swal.fire({
        title: 'Bạn có chắc rằng?',
        text: "Bạn muốn xóa thông tin đơn vị thực tập này!",
        icon: 'Cảnh báo',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi chắc chắn'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = 'DonViThucTap/XoaMauTin.php?MaDVTT=' + mdvtt;
        }
      })
}