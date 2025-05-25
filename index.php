<?php
session_start();
include "connect.php";
 if(isset($_POST['studentid']) && isset($_POST['peopleid'])){
  if($_POST['studentid'] and $_POST['peopleid'] != ''){
    $studentid = $_POST['studentid'];
    $peopleid = $_POST['peopleid'];
    $sql = "SELECT * FROM studentandteacherdata where st_id = '".$studentid."' and st_peopleid = '".$peopleid."'";
    $result = $conn->query($sql);
    if($result && $result->num_rows === 1){
      $row = $result->fetch_assoc();
      $alertMessage = "เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ $username";
      $alertIcon = "success";
      $_SESSION['studentid'] = $studentid;
      $_SESSION['peopleid'] = $peopleid;
      $_SESSION['name'] = $row['st_name'];
      $_SESSION['grade'] = $row['st_grade'];
      $_SESSION['status'] = $row['st_status'];
      switch($_SESSION['status']){
        case 0:
          $page = "home";
          break;
        case 1:
          $page = "dropphoto";
          break;
        case 2:
          $page = "print";
          break;
        case 3:
          $page = "prove";
          break;
        case 4:
          $page = "successfully";
          break;
        case 5:
          $page = "waitaccept";
          break;
        case 6:
          $page = "fail";
          break;
        case 7:
          $page = "edited";
          break;
        case 8:
          $page = "t-home";
          break;
      }
    }else{
      $alertMessage = "ไม่พบผู้ใช้งาน กรุณาลองอีกครั้ง";
      $alertIcon = "error";
    }
  }else{
    $alertMessage = "กรุณากรอกข้อมูลให้ครบ กรุณาลองอีกครั้ง";
    $alertIcon = "warning";
  }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>งานทะเบียน</title>
 <link rel="stylesheet" href="style.css">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
</head>
<body>
 <section id="login-page">
  <form action="" method="POST">
    <h2>กรุณาเข้าสู่ระบบ</h2>
   <div class="input">
    <input type="text" name="studentid" id="" placeholder="รหัสนักเรียน">
    <input type="text" name="peopleid" id="" placeholder="เลขประจำตัวประชาชน">
    <input type="submit" value="เข้าสู่ระบบ">
   </div>
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
      window.location.href = "<?php echo $page ?>.php"; // แก้เป็น URL ที่ต้องการ
    }
    // กรณีอื่นไม่ทำอะไร แค่ปิด alert
  });
</script>
<?php endif; ?>


</body>
</html>