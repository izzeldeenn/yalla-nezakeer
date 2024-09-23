<?php 
require "sidebar.php";
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة المهام</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="task-list">
        <?php
require "../php/config.php";
$uni = $_SESSION['unique_id'];
$query = "SELECT * FROM users WHERE unique_id = $uni";
$result = mysqli_query($conn, $query);

// التحقق من وجود نتائج
if(mysqli_num_rows($result) > 0){
    while($task = mysqli_fetch_assoc($result)){
        $table = $task['user_table_name'];

        // استعلام لجلب المهام التي حالتها "do" وتاريخها هو تاريخ اليوم
        $query = "SELECT * FROM $table WHERE state IN ('do', 'progress') AND DATE(end) = CURDATE()";
        $result_tasks = mysqli_query($conn, $query);

        // التحقق من وجود نتائج
        if(mysqli_num_rows($result_tasks) > 0){
            while($task = mysqli_fetch_assoc($result_tasks)){
                // استخراج البيانات لكل مهمة
                $task_name = $task['title'];
                $task_id = $task['id']; // استخراج معرف المهمة
                $task_date = date('Y-m-d', strtotime($task['end'])); // تحويل التاريخ إلى صيغة Y-m-d
?>
                <div class="task">
                    <div class="task-name"><?php echo $task_name; ?></div>
                    <div class="task-actions">
                        <div class="task-date">تاريخ الإنجاز: <?php echo $task_date; ?></div>
                        <!-- نموذج يحتوي على زر يبدأ التايمر -->
                        <form action="timer.php" method="GET">
                            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                            <button type="submit" class="start-btn">ابدأ</button>
                        </form>
                    </div>
                </div>
<?php
            }
        } else {
            echo "لا توجد مهام بتاريخ اليوم.";
        }
    }
}
?>


            <!-- يمكنك إضافة المزيد من المهام هنا -->
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<style>
body {
    background-color: #f0f0f0;
}
.task-list {
    display: flex;
    flex-direction: column;
}

.task {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.task-name {
    font-size: 16px;
    color: #333;
}

.task-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.task-date {
    font-size: 14px;
    color: #888;
}

.start-btn {
    padding: 8px 15px;
    font-size: 14px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.start-btn:hover {
    background-color: #0056b3;
}

@media (max-width: 600px) {
    .task {
        flex-direction: column;
        align-items: flex-start;
    }

    .task-actions {
        justify-content: space-between;
        width: 100%;
        margin-top: 10px;
    }

    .start-btn {
        width: 100%;
    }
}

</style>
<?php
require "footer.php";
?>
