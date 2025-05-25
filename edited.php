<?php 
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>printing</title>
 <link rel="stylesheet" href="edited.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  <div class="printing">
   <div class="print-top">
    <h1>เอกสารของคุณได้รับการแก้ไข</h1>
   </div>
   <div class="print-mid">
    <i class="fa-solid fa-file-pen"></i>
   </div>
   <div class="print-bottom">
    <h3>เอกสารของคุณได้รับการแก้ไขเสร็จสิ้น<br>โปรดรอขั้นตอนถัดไป</h3>
   </div>
  </div>
 </section>
</body>
</html>