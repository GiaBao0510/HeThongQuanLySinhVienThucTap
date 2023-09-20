//Khi tải tra sẽ phát sinh sự kiện
window.addEventListener("load",()=>{
    /*1. --- HIệu ứng chuyển trang bên trang đăng ký sinh viên hoặc đơn vị thực tập  ----*/  
    
    //Ban đầu cho biểu mẫu đăng ký đơn vị thực tập tắt
    let bieuMauDK_dvtt = document.getElementById('BieuMauDangKy_DVTT');
    bieuMauDK_dvtt.style.display = "none";

    //Định dạng chung cho biếu mẫu đăng ký sinh viên
    let bieuMauDK_sv = document.getElementById("BieuMauDangKy_SV");

    //Xác định nút đăng ký tài khoản cho sinh viên và đơn vị thự tập
    let nutDK_sv = document.getElementById("Chon_DKSV");
    let nutDK_dvtt = document.getElementById("Chon_DKDVTT");

    //Tô màu cho nút đăng ký sinh viên trước vì nó hiển thị trước
    nutDK_sv.style.backgroundImage = "linear-gradient(to left, rgb(43, 43, 251), rgb(43, 109, 251), rgb(43, 102, 251), rgb(43, 150, 251))";
    nutDK_sv.style.color="white";

    //Khi bấm vào nút sinh viên thì sự kiện sẽ xảy ra
    nutDK_sv.addEventListener("click", function(event){
        event.stopPropagation();    //Chỉ lan sự kiện đến chín nó không ảnh hưởng đến bất kỳ ai khác
 
        //Thêm màu cho nút sinh viên & hiển thị trang đăng ký sinh viên
        nutDK_sv.style.backgroundImage = "linear-gradient(to left, rgb(43, 43, 251), rgb(43, 109, 251), rgb(43, 102, 251), rgb(43, 150, 251))";
        nutDK_sv.style.color="white";
        bieuMauDK_sv.style.display = "block";

        //Xóa màu cho nút đơn vị thực tập & tắt trang đăng ký đơn vị thực tập
        nutDK_dvtt.style.backgroundImage = "none";
        nutDK_dvtt.style.color="black";
        bieuMauDK_dvtt.style.display= "none";
    });

    //Khi bấm vào nút đơn vị thực tập thì sự kiện sẽ xảy ra
    nutDK_dvtt.addEventListener("click", function(event){
        event.stopPropagation();    //Chỉ lan sự kiện đến chín nó không ảnh hưởng đến bất kỳ ai khác
 
        //Thêm màu cho nút sinh viên & tắt trang đăng ký sinh viên
        nutDK_sv.style.backgroundImage = "none";
        nutDK_sv.style.color="black";
        bieuMauDK_sv.style.display = "none";

        //Xóa màu cho nút đơn vị thực tập & hiển thị trang đăng ký đơn vị thực tập
        nutDK_dvtt.style.backgroundImage = "linear-gradient(to left, rgb(43, 43, 251), rgb(43, 109, 251), rgb(43, 102, 251), rgb(43, 150, 251))";
        nutDK_dvtt.style.color="white";
        bieuMauDK_dvtt.style.display= "block";
    });

    /*2. Hiệu ứng chuyển trang giữa trang đăng nhập */
    
    //Lấy ID khung cửa 1 và khung cửa 2
    let khung1 = document.getElementById("KhungCuaThuNhat"),
        khung2 = document.getElementById("KhungCuaThuHai");

    //Lấy ID nút đăng ký và nút đăng nhập
    let NutDK = document.getElementById("NutDangKy"),
        NutDN = document.getElementById("NutDangNhap");

    //Khi bấm vào nút đăng ký thì sẽ ẩn đi trang đăng nhập và hiện ra trang đăng ký
    NutDK.addEventListener('click',function(event){
        event.stopPropagation();
        khung1.style.display = "none";
        khung2.style.display = "flex";
    });

    //Khi bấm vào nút nhập thì sẽ ẩn đi trang đăng ký và hiện ra trang đăng nhập
    NutDN.addEventListener('click',function(event){
        event.stopPropagation();
        khung1.style.display = "flex";
        khung2.style.display = "none";
    });
})
