<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exists!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $encrypt_pass = md5($password);
                                
                                // تحديد اسم الجدول الخاص بالمستخدم
                                $user_table_name = "user_".$ran_id;

                                // إدخال بيانات المستخدم في جدول المستخدمين مع اسم الجدول
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, user_table_name)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}', '{$user_table_name}')");

                                if($insert_query){
                                    // جلب ID المستخدم الذي تم إنشاؤه للتو
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];

                                        // كود إنشاء جدول خاص بالمستخدم الجديد
                                        $user_id = $result['unique_id'];
                                        $user_table = "CREATE TABLE user_$user_id (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `color` varchar(7) DEFAULT NULL,
    `start` datetime NOT NULL,
    `end` datetime NOT NULL,
    `time` int(11) NOT NULL,
    `subject` varchar(255) NOT NULL,
    `state` varchar(255) DEFAULT NULL,
    `points` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
";

                                        if ($conn->query($user_table) === TRUE) {
                                            echo "success";
                                        } else {
                                            echo "حدث خطأ أثناء إنشاء الجدول: " . $conn->error;
                                        }

                                    }else{
                                        echo "This email address does not exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
