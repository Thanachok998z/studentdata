<?php 
session_start();
include "connect.php";

$showSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm2']) && $_POST['confirm2'] === '2') {
        // อัปเดตฐานข้อมูล
        $sql1 = "UPDATE studentandteacherdata SET st_status = 0 WHERE st_id = '".$_SESSION['studentid']."'";
        $sql2 = "UPDATE requestdata SET status = 1 WHERE st_id = '".$_SESSION['studentid']."'";

        if ($conn->query($sql1) && $conn->query($sql2)) {
            $showSuccess = true; // เพื่อให้ไปแสดง SweetAlert ทีหลัง
        } else {
            echo "อัปเดตล้มเหลว: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>printing</title>
 <link rel="stylesheet" href="successfullys.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
 <div class="topic-head">
  <div class="head-top">
   <div class="head-top-img">
    <img src="img/logo.png" alt="">
   </div>
   <div class="head-top-text">
    <div class="head-top-text">
    <h2>โรงเรียนประจักษ์ศิลปาคาร</h2>
    <h3>Prachaksilapakarn School</h3>
   </div>
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
    <h1>เอกสารของคุณพร้อมใช้งาน</h1>
   </div>
   <div class="print-mid">
    <i class="fa-solid fa-circle-check"></i>
   </div>
   <div class="print-bottom">
    <h3>คุณสามารถรับเอกสารได้ ณ ห้องวิชาการ<br>โปรดรอท่านผู้อำนวยการเซ็นรับรอง</h3>
   </div>
   <!-- เอาปุ่ม submit ออกไป เปลี่ยนมาใช้ปุ่มธรรมดา -->
   <button id="confirmBtn">รับเอกสารเสร็จสิ้น</button>
  </div>
 </section>

<script>
document.getElementById('confirmBtn').addEventListener('click', function(e){
    e.preventDefault(); // ป้องกันการ submit form ปกติ

    Swal.fire({
        title: "คุณรับเอกสารแล้วใช่หรือไม่?",
        text: "คุณได้รับเอกสารและตรวจสอบความถูกต้องแล้วใช่หรือไม่",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "ใช่",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            // สร้าง form ส่ง confirm2=2 แบบ POST
            const form = document.createElement("form");
            form.method = "POST";
            form.style.display = "none";

            const input = document.createElement("input");
            input.name = "confirm2";
            input.value = "2";
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        } else {
            // ถ้ายกเลิก ไม่ทำอะไร
            console.log("ผู้ใช้ยกเลิก");
        }
    });
});
</script>

<?php if ($showSuccess): ?>
<script>
Swal.fire({
    icon: "success",
    title: "คุณรับเอกสารเรียบร้อยแล้ว",
    confirmButtonText: "ตกลง"
}).then(() => {
    window.location.href = "home.php";
});
</script>
<?php endif; ?>

</body>
</html>
