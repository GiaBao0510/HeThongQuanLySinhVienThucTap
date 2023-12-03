<?php
    //Hủy hết phiên
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tài khoản không hợp lệ</title>
        <style>
            #AnManHinh{
                position: fixed;
                width: 100vw;
                height: 100vh;
                background-color: black;
                z-index: 10;
            }
        </style>
        <script defer>
            alert("Tài khoản không hợp lệ");
            window.location.href="/DoiTuongSuDung/TrangDungChung/index.php";
        </script>
    </head>
    <body>
        <div id="AnManHinh"></div>
    </body>
</html>