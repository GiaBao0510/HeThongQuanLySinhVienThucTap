new DataTable('#CauHinhBang1');//o
new DataTable('#CauHinhBangSVChamDiem');//o
new DataTable('#CauHinhBangSVNhanXet');//o
/*Hàm xác nhận rằng có muốn xóa cán bộ này ra khỏi đơn vị  */
function ThongBaoXacNhanXoaCanBo(mscb,mdvtt){
    Swal.fire({
        title: 'Bạn có chắc rằng?',
        text: "Bạn muốn xóa tài khoản cán bộ này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi chắc chắn'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = 'CanBoHuongDan/ThucHienXoaCanBo.php?MSCB=' + mscb + '&DVTT=' + mdvtt;
        }
      })
}
