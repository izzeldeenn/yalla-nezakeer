<?php
require "sidebar.php";
?>
 <main class="table" id="customers_table">
        <section class="table__header">
            <h1>ترتيب الطلاب</h1>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> الترتيب <span class="icon-arrow">&UpArrow;</span></th>
                        <th> الطالب <span class="icon-arrow">&UpArrow;</span></th>
                        <th> النقاط <span class="icon-arrow">&UpArrow;</span></th>
                        <th> الحالة <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php
require "../php/config.php";

// استعلام لجلب المستخدمين مع ترتيبهم حسب عدد النقاط من الأكثر إلى الأقل
$query = "SELECT * FROM users ORDER BY points DESC";
$result = mysqli_query($conn, $query);

// للتحكم في الترتيب (الرقم المتزايد)
$rank = 1;

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        // تحويل التاريخ إلى صيغة Y-m-d
?>
    <tr>
        <!-- الرقم المتزايد بناءً على الترتيب -->
        <td> <?php echo $rank; ?> </td>
        <td> <img src="../php/images/<?php echo $row['img']; ?>" alt=""><?php echo $row['fname'] . " " . $row['lname'] ?></td>
        <td> <?php echo $row['points']; ?></td>
        <td> <?php echo $row['status']; ?></td>
    </tr>
<?php
        // زيادة الرقم المتزايد في كل مرة
        $rank++;
    }
} else {
    echo "لا يوجد طلاب على المنصة حتى الان";
}
?>

                
                </tbody>
            </table>
        </section>
    </main>
    <script src="assets/js/calendar.js"></script>

<?php
require "footer.php";
?>