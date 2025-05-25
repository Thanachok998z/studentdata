
<?php 
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>dropphoto</title>
 <link rel="stylesheet" href="dropphoto.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีการยืนยันจาก SweetAlert หรือยัง
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        // อัพเดตฐานข้อมูลจริง
        $sql = "UPDATE studentandteacherdata SET st_status = st_status+1 WHERE st_id = '".$_SESSION['studentid']."'";
        if ($conn->query($sql) === TRUE) {
            // อัพเดตสำเร็จ แสดงแจ้งเตือน success หรือ redirect
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "อัพเดตข้อมูลเรียบร้อยแล้ว",
                    confirmButtonText: "ตกลง"
                }).then(() => {
                    window.location.href = "print.php";
                });
            </script>
            ';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // ยังไม่มี confirm ให้แสดง SweetAlert confirm
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "ยืนยันการส่งข้อมูล?",
                    text: "คุณส่งรูปภาพ ณ ห้องวิชาการ และทำตามขั้นตอนถูกต้องใช่หรือไม่",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ส่งแบบ POST พร้อม confirm=yes
                        const form = document.createElement("form");
                        form.method = "POST";
                        form.style.display = "none";

                        const inputConfirm = document.createElement("input");
                        inputConfirm.name = "confirm";
                        inputConfirm.value = "yes";
                        form.appendChild(inputConfirm);

                        document.body.appendChild(form);
                        form.submit();
                    } else {
                        console.log("ผู้ใช้ยกเลิก");
                    }
                });
            });
        </script>
        ';
    }
}
?>


</head>
<body>
 <div class="topic-head">
  <div class="head-top">
   <div class="head-top-img">
    <img src="img/logo.png" alt="">
   </div>
   <div class="head-top-text">
    <h2>โรงเรียนประจักษ์ศิลปาคาร</h2>
    <h3>Prachaksilapakarn School</h3>
   </div>
  </div>
  <div class="head-bottom">
   <div class="student-card">
    <div class="student-img">
     <img src="img/boy.png" alt="">
    </div>
    <div class="student-text">
     <h2><?php echo $_SESSION['name']; ?></h2>
     <h3>ชั้น: ม.<?php echo $_SESSION['grade']; ?> รหัสนักเรียน: <?php echo $_SESSION['studentid']; ?></h3>
    </div>
   </div>
  </div>
 </div>
 <section class="request">
  <div class="boxq-top">
    <h1>ส่งรูปภาพ</h1>
   </div>
  <div class="boxQ">
   <div class="idphotos-front">
    <div class="boxq-img">
     <img src="img/boy.png" alt="">
    </div>
    <h3>รูปขนาด 1.5 นิ้ว</h3>
   </div>
   <div class="q">
    <h1><?php 
      echo ($conn->query("SELECT Q FROM requestdata WHERE st_id = '".$_SESSION['studentid']."' ORDER BY Q DESC LIMIT 1")->fetch_assoc())['Q'];

    ?></h1>
    <h2>หมายเลข</h2>
   </div>
  </div>
  <div class="sol">
   <h3>จำนวน <?php 
   $pp1 = $_SESSION['pp1'];
   $pp7 = $_SESSION['pp7'];
   $photo = $pp1 + $pp7;
   echo $photo;
   ?> รูป</h3>
   <h2>กรุณาเขียนหมายเลขต้านบน<br>ที่ด้านหลังรูปภาพขนาด 1.5 นิ้ว<br>พร้อมนำไปส่ง ณ ห้องวิชาการ</h2>
  </div>
  <form action="" method="POST">
   <input type="submit" value="ส่งรูปภาพเสร็จสิ้น">
  </form>
 </section>
</body>
</html>