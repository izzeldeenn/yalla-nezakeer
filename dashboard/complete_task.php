<?php
require "../php/config.php";

session_start();
include_once "../php/config.php";
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
}

// استلام معرف المهمة من الـ GET
if(isset($_GET['task_id'])){
    $task_id = $_GET['task_id'];
    $uni = $_SESSION['unique_id'];
    $query = "SELECT * FROM users WHERE unique_id = $uni";
    $result = mysqli_query($conn, $query);
    
    // التحقق من وجود نتائج
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $table = $user['user_table_name'];
        
        // استعلام لتحديث حالة المهمة إلى "done"
        $query = "UPDATE $table SET state = 'done' WHERE id = $task_id";
        if(mysqli_query($conn, $query)){
            // زيادة النقاط بمقدار 100
            $current_points = $user['points']; // افترض أن لديك عمود points في جدول المستخدمين
            $new_points = $current_points + 100;
            $update_points_query = "UPDATE users SET points = $new_points WHERE unique_id = $uni";
            if(mysqli_query($conn, $update_points_query)){
                header("location: tasks.php");
            } else {
                echo "حدث خطأ أثناء تحديث النقاط.";
            }
        } else {
            echo "حدث خطأ أثناء تحديث حالة المهمة.";
        }
    }
}
?>
