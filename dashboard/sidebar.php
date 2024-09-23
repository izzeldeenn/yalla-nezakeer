<?php 
  session_start();
  include_once "../php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
?>
<?php include_once "../header.php"; ?>
<?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>يلا نذاكر 💪🏻</title>
  <!--css files -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/timer.css">
  <link rel="stylesheet" href="assets/css/calendar.css">
  <link rel="stylesheet" href="assets/css/settings.css">
  <!--icons css -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="sidebar">

    <h1 class="logo">يلا نذاكر 💪🏻</h1>

    <div class="side-nav">
    <div class="item active">
      <i class='bx bx-task'></i>
      <a href="index.php">الرئيسية</a>
      </div>
      <div class="item">
      <i class='bx bx-task'></i>
      <a href="tasks.php">المهام</a>
      </div>
      <div class="item">
      <i class='bx bx-calendar' ></i>
        <a href="calendar/">التقويم</a>
      </div>
      <div class="item">
      <i class='bx bxs-user-detail'></i>
        <a href="rank.php">المتصدرين</a>
      </div>
      <div class="item">
        <i class='bx bx-cog' ></i>
        <a href="setings.php">الاعدادت</a>
      </div>
    </div>


  <div class="side-profile">
    <div class="info">
      <img src="../php/images/<?php echo $row['img']; ?>" alt="">
      <p style="font-size: 20px; color:black;" href="#"><?php echo $row['fname']. " " . $row['lname'] ?></p>
      <p><?php echo $row['status']; ?></p>
    </div>
    <button>نقاطك : <?php echo $row['points']; ?></button>
  </div>

  </div>


<div class="container">
<div class="nav">
  <button id="menutoggle"><i class='bx bx-menu'></i></button>
  <h1 class="logo-nav" href="#">يلا نذاكر 💪🏻</h1>
  <div class="search">
    <input type="hidden" name="search" id="search">
  </div>
   <!--
 
  <div class="topic">
    <i class='bx bx-search-alt-2' ></i>
    <input type="text" name="topic" id="topic" placeholder="موضوع سري">
  </div>
  -->
  <button>دعوة صديق</button>
  <!--
  <i class='bx bx-bell' ></i>
          -->
  <div class="user-info">
    <img src="../php/images/<?php echo $row['img']; ?>" alt="">
    <div>
      <p
      style="
      margin-bottom: -16px;
" 
      ><?php echo $row['fname']. " " . $row['lname'] ?></p>
      <a 
      style="
      margin-top: 16px;
width: 100%;
border: none;
padding: 5px;
background: #111;
font-size:10px;
color: #fafafa;
border-radius: 5px;
" 
href="../php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">تسجيل الخروج</a>
    </div>
    

  </div>
</div>

<div class="main">
  <div class="content">