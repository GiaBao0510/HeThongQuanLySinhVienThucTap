new DataTable('#CanChinhBangSinhVien');
function ThongBaoXacNhanXoaSinhVien(mssv){
    Swal.fire({
        title: 'Bạn có chắc rằng?',
        text: "Bạn muốn xóa thông tin sinh viên này!",
        icon: 'Cảnh báo',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi chắc chắn'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = 'SinhVien/XoaMauTinSV.php?MSSV=' + mssv;
        }
      })
}