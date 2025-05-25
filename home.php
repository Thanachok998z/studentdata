<?php 
session_start();
include "connect.php";
if($_SESSION['status'] === 0){
 $disable = "";
}elseif($_SESSION['status'] > 0) {
 $disable = "disabled";
}
if($_SESSION['status'] === "0"){
 if(isset($_POST['PP1']) || isset($_POST['PP7'])){
  if($_POST['PP1'] === "on"){
   $pp1 = 1;
  }else{
   $pp1 = 0;
  }
  if($_POST['PP7'] === "on"){
   $pp7 = 1;
  }else{
   $pp7 = 0;
  }
  $sql = "INSERT INTO `requestdata`(`st_id`, `st_name`, `st_grade`, `st_peopleid`, `rq_pp1`, `rq_pp2`) VALUES ('".$_SESSION['studentid']."','".$_SESSION['name']."','".$_SESSION['grade']."','".$_SESSION['peopleid']."',$pp1,$pp7) ";
  if($conn->query($sql) === TRUE){
   $_SESSION['pp1'] = $pp1;
   $_SESSION['pp7'] = $pp7;
   $alertMessage = "การขอเอกสารสำเร็จ กำลังพาคุณไปขั้นตอนถัดไป";
   $alertIcon = "success";
   $sql2 = "UPDATE `studentandteacherdata` SET `st_status`= 1  WHERE `st_id` = '".$_SESSION['studentid']."'";
  }else{
   $alertMessage = "ไม่สามารถใช้งานได้ โปรดลองใหม่อีกครั้ง";
   $alertIcon = "warning";
  }
  

  
 }else{
 }
}elseif(($_SESSION['status'] != 0)){
 $alertMessage = "ไม่สามารถใช้งานได้ เนื่องจากคุณกำลังติดการขอเอกสารอื่นอยู่";
 $alertIcon = "error";
}else{
 echo "here 2";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>ร้องข้อ</title>
 <link rel="stylesheet" href="home.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
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
  


  <form action="" method="POST">
   <h3>แบบคำร้องขอเอกสาร</h3>
   <h2>กรุณาเลือกเอกสารที่ท่านต้องการ</h2>
   <label for="" class="checkbox">
    <h1>ปพ.1</h1>
    <input type="checkbox" name="PP1" id="PP1" <?php echo $disable ;?>>
   </label>
   <label for="" class="checkbox">
    <h1>ปพ.7</h1>
    <input type="checkbox" name="PP7" id="PP7" <?php echo $disable ;?>>
   </label>
   <input type="submit" value="ส่งคำร้อง">
  </form>
 </section>
 <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $alertMessage !== ''): ?>
<script>
  Swal.fire({
    title: <?= json_encode($alertIcon === 'success' ? 'สำเร็จ' : 'แจ้งเตือน') ?>,
    text: <?= json_encode($alertMessage) ?>,
    icon: <?= json_encode($alertIcon) ?>,
    confirmButtonText: 'ตกลง'
  }).then((result) => {
    if (result.isConfirmed && <?= json_encode($alertIcon === 'success') ?>) {
      // กรณีสำเร็จ redirect
      window.location.href = "dropphoto.php"; // แก้เป็น URL ที่ต้องการ
    }
    // กรณีอื่นไม่ทำอะไร แค่ปิด alert
  });
</script>
<?php endif; ?>
</body>
</html>