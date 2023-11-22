new DataTable('#CanChinhBangGV');
new DataTable('#CanChinhSinhVienPheDuyet');
new DataTable('#CanChinhSinhVienChamDiem');
function ThongBaoXacNhanXoaGV(msgv){
    Swal.fire({
        title: 'Bạn có chắc rằng?',
        text: "Bạn muốn xóa thông tin giảng viên hướng dẫn này!",
        icon: 'Cảnh báo',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi chắc chắn'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = 'GiaoVienHuongDan/XoaMauTinGV.php?MSGV=' + msgv;
        }
      })
}