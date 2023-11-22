new DataTable('#CanChinhBangTaiKhoan');
function ThongBaoXacNhanXoa(userid){
    Swal.fire({
        title: 'Bạn có chắc rằng?',
        text: "Bạn muốn xóa tài khoản này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi chắc chắn'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = 'TaiKhoan/XoaMauTinTK.php?UserID=' + userid;
        }
      })
}