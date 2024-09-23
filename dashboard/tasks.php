<?php 
require "sidebar.php";
?>
<!-- Working version of https://dribbble.com/shots/14552329--Exploration-Task-Management-Dashboard -->
<div class='app'>
  <main class='project'>
    <div class='project-info'>
      <h1>مهامك لهذا اليوم </h1>
    </div>
    <div class='project-tasks'>
      <div class='project-column'>
        <div class='project-column-heading'>
          <h2 class='project-column-heading__title'>المهام</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
        </div>
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
        $query = "SELECT * FROM $table WHERE state = 'do' AND DATE(end) = CURDATE()";
        $result_tasks = mysqli_query($conn, $query);

        // التحقق من وجود نتائج
        if(mysqli_num_rows($result_tasks) > 0){
            while($task = mysqli_fetch_assoc($result_tasks)){
                // استخراج البيانات لكل مهمة
                $task_name = $task['title'];
                $task_subject = $task['subject'];
                $task_time = $task['time'];
                $task_points = $task['points'];
                $task_date = date('Y-m-d', strtotime($task['end'])); // تحويل التاريخ إلى صيغة Y-m-d
?>
        <a href="">
        <div class='task' draggable='true'>
          <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $task_subject; ?></span><button class='task__options'><i class="fas fa-ellipsis-h"></i></button></div>
          <p><?php echo $task_name; ?></p>
          <div class='task__stats'>
            <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo $task_time; ?></time></span>
            <span><i class="fas fa-comment"></i><?php echo $task_points; ?></span>
          </div>
        </div>
        </a>
        <?php
            }
        } else {
            echo "لا توجد مهام يجب انجازها بتاريخ اليوم.";
        }
    }
}
?>
      </div>
      <div class='project-column'><div class='project-column-heading'>
          <h2 class='project-column-heading__title'>جاري العمل عليها</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
        </div>
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
        $query = "SELECT * FROM $table WHERE state = 'progress' AND DATE(end) = CURDATE()";
        $result_tasks = mysqli_query($conn, $query);

        // التحقق من وجود نتائج
        if(mysqli_num_rows($result_tasks) > 0){
            while($task = mysqli_fetch_assoc($result_tasks)){
                // استخراج البيانات لكل مهمة
                $task_name = $task['title'];
                $task_subject = $task['subject'];
                $task_time = $task['time'];
                $task_points = $task['points'];
                $task_date = date('Y-m-d', strtotime($task['end'])); // تحويل التاريخ إلى صيغة Y-m-d
?>
        <a href="">
        <div class='task' draggable='true'>
          <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $task_subject; ?></span><button class='task__options'><i class="fas fa-ellipsis-h"></i></button></div>
          <p><?php echo $task_name; ?></p>
          <div class='task__stats'>
            <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo $task_time; ?></time></span>
            <span><i class="fas fa-comment"></i><?php echo $task_points; ?></span>
          </div>
        </div>
        </a>
        <?php
            }
        } else {
            echo "لا توجد مهام جاري العمل عليها بتاريخ اليوم.";
        }
    }
}
?>

        </div>
      <div class='project-column'><div class='project-column-heading'>
          <h2 class='project-column-heading__title'>تحتاج للمراجعة</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
        </div>
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
        $query = "SELECT * FROM $table WHERE state = 'under review' AND DATE(end) = CURDATE()";
        $result_tasks = mysqli_query($conn, $query);

        // التحقق من وجود نتائج
        if(mysqli_num_rows($result_tasks) > 0){
            while($task = mysqli_fetch_assoc($result_tasks)){
                // استخراج البيانات لكل مهمة
                $task_name = $task['title'];
                $task_subject = $task['subject'];
                $task_time = $task['time'];
                $task_points = $task['points'];
                $task_date = date('Y-m-d', strtotime($task['end'])); // تحويل التاريخ إلى صيغة Y-m-d
?>
        <a href="">
        <div class='task' draggable='true'>
          <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $task_subject; ?></span><button class='task__options'><i class="fas fa-ellipsis-h"></i></button></div>
          <p><?php echo $task_name; ?></p>
          <div class='task__stats'>
            <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo $task_time; ?></time></span>
            <span><i class="fas fa-comment"></i><?php echo $task_points; ?></span>
          </div>
        </div>
        </a>
        <?php
            }
        } else {
            echo "لا توجد مهام تحتاج الى المراجعة بتاريخ اليوم.";
        }
    }
}
?>

        </div>
      <div class='project-column'><div class='project-column-heading'>
          <h2 class='project-column-heading__title'>انتهيت منه</h2><button class='project-column-heading__options'><i class="fas fa-ellipsis-h"></i></button>
        </div>
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
        $query = "SELECT * FROM $table WHERE state = 'done' AND DATE(end) = CURDATE()";
        $result_tasks = mysqli_query($conn, $query);

        // التحقق من وجود نتائج
        if(mysqli_num_rows($result_tasks) > 0){
            while($task = mysqli_fetch_assoc($result_tasks)){
                // استخراج البيانات لكل مهمة
                $task_name = $task['title'];
                $task_subject = $task['subject'];
                $task_time = $task['time'];
                $task_points = $task['points'];
                $task_date = date('Y-m-d', strtotime($task['end'])); // تحويل التاريخ إلى صيغة Y-m-d
?>
        <a href="">
        <div class='task' draggable='true'>
          <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $task_subject; ?></span><button class='task__options'><i class="fas fa-ellipsis-h"></i></button></div>
          <p><?php echo $task_name; ?></p>
          <div class='task__stats'>
            <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo $task_time; ?></time></span>
            <span><i class="fas fa-comment"></i><?php echo $task_points; ?></span>
          </div>
        </div>
        </a>
        <?php
            }
        } else {
            echo "لا توجد مهام انتهيت منها بتاريخ اليوم.";
        }
    }
}
?>
        </div>
      
    </div>
  </main>
</div>

<?php
require "footer.php";
?>