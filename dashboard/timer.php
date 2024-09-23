<?php 
session_start();
include_once "../php/config.php";
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="assets/css/timer.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css">
</head>
<body>
<audio id="tickSound" src="clock.mp3" preload="auto"></audio>
<div class="clock"></div>
<form action="" method="get">
    <button type="submit" name="done">انتهيت من المذاكرة</button>
    <input type="hidden" name="task_id" value="<?php echo isset($_GET['task_id']) ? $_GET['task_id'] : ''; ?>">
</form>
<?php
require "../php/config.php";

// استلام معرف المهمة من الـ GET
if(isset($_GET['task_id'])){
    $task_id = $_GET['task_id'];
    $uni = $_SESSION['unique_id'];
    $query = "SELECT * FROM users WHERE unique_id = $uni";
    $result = mysqli_query($conn, $query);
    
    // التحقق من وجود نتائج
    if(mysqli_num_rows($result) > 0){
        while($task = mysqli_fetch_assoc($result)){
            $table = $task['user_table_name'];

            // استعلام لتحديث حالة المهمة إلى "progress"
            $query = "UPDATE $table SET state = 'progress' WHERE id = $task_id";
            mysqli_query($conn, $query);
        }
    }
}

// التحقق من زر "انتهيت من المذاكرة"
if(isset($_GET['done'])){
    header("location: complete_task.php?task_id=$task_id");
    exit(); // تأكد من الخروج بعد إعادة التوجيه
}
?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
<script src="assets/js/timer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.js"></script>
</html>
