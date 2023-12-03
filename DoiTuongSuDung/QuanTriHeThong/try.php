<!DOCTYPE html>
<html lang="en">
<head>
  <title>Vẽ sơ đồ dạng cột với Chart.js</title>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> -->
</head>
<body>
  <?php
    include('../TrangDungChung/CacHamXuLy.php');
    $dssv = DS_SinhVien();
    $ds = array(DemSoLuongSinhVienKem(),DemSoLuongSinhVienYeu(), DemSoLuongSinhVienTrungBinhYeu(), DemSoLuongSinhVienTrungBinh(), DemSoLuongSinhVienKha(), DemSoLuongSinhVienGioi(), DemSoLuongSinhVienGioi(), DemSoLuongSinhVienXuatSat());
    //   while($row = mysqli_fetch_array($dssv)){
    //       $ds[] = $row['MSSV'];
    //   }
    foreach($ds as $i){
      echo '<p>'.$i.'</p>';
    }
    
  ?>
  <!-- <canvas id="myChart" width="400" height="400"></canvas>

  <script>
    var ctx = document.getElementById("myChart").getContext("2d");

    var data = {
      labels: ["Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy", "Chủ Nhật"],
      datasets: [{
        data: [, 20, 30, 40, 50, 60, 70],
        backgroundColor: ["#FF0000", "#00FF00", "#0000FF", "#FFFF00", "#FF00FF", "#00FFFF", "#FFFFFF"]
      }]
    };

    var myChart = new Chart(ctx, {
      type: "bar",
      data: data,
      options: {
        title: {
          text: "Doanh thu theo ngày"
        }
      }
    });
  </script> -->
  
</body>
</html>
