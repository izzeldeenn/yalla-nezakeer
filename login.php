<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: dashboard/");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>تسجيل الدخول الى المنصة</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>البريد الالكتروني </label>
          <input type="text" name="email" placeholder="ادخل البريد الالكتروني الخاص بك" required>
        </div>
        <div class="field input">
          <label>كلمة المرور</label>
          <input type="password" name="password" placeholder="ادخل كلمة المرور الخاصة بك" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="الدخول الى حسابي">
        </div>
      </form>
      <div class="link">لم اقم بعمل حساب حتى الان? <a href="signup.php">انشئ حساب</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
