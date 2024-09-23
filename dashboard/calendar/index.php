<?php 
  session_start();
  include_once "../../php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../../login.php");
  }
?>
<?php
require_once('bdd.php');
$uni = $_SESSION['unique_id'];
$query = "SELECT * FROM users WHERE unique_id = $uni";
$result = mysqli_query($conn, $query);

// التحقق من وجود نتائج
if(mysqli_num_rows($result) > 0){
    while($task = mysqli_fetch_assoc($result)){
        $table = $task['user_table_name'];

$sql = "SELECT id, title, start, end, color FROM $table";
    }
  }
$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>
<?php include_once "../../header.php"; ?>
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
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/app.css">
  <link rel="stylesheet" href="../assets/css/calendar.css">
  <!--icons css -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
  
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

</head>
<body>
  <div class="sidebar">

    <a class="logo" href="#">يلا نذاكر 💪🏻</a>

    <div class="side-nav">
    <div class="item active">
      <i class='bx bx-task'></i>
      <a href="../index.php">الرئيسية</a>
      </div>
      <div class="item">
      <i class='bx bx-task'></i>
      <a href="../tasks.php">المهام</a>
      </div>
      <div class="item">
      <i class='bx bx-calendar' ></i>
        <a href="index.php">التقويم</a>
      </div>
      <div class="item">
      <i class='bx bxs-user-detail'></i>
        <a href="../rank.php">المتصدرين</a>
      </div>
      <div class="item">
        <i class='bx bx-cog' ></i>
        <a href="../setings.php">الاعدادت</a>
      </div>
    </div>


  <div class="side-profile">
    <div class="info">
      <img src="../../php/images/<?php echo $row['img']; ?>" alt="">
      <a href="#"><?php echo $row['fname']. " " . $row['lname'] ?></a>
      <p><?php echo $row['status']; ?></p>
    </div>
    <button>ملفي الشخصي</button>
  </div>

  </div>


<div class="container">
<div class="nav">
  <button id="menutoggle"><i class='bx bx-menu'></i></button>
  <a class="logo-nav" href="#">يلا نذاكر 💪🏻</a>
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
  <i class='bx bx-bell' ></i>
  <div class="user-info">
    <img src="../../php/images/<?php echo $row['img']; ?>" alt="">
    <div>
      <a href="#"><?php echo $row['fname']. " " . $row['lname'] ?></a>
      <p>نقاطك : <?php echo $row['points']; ?></p>
    </div>
    <a href="../../php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>

  </div>
</div>
<div class="main">
  <div class="content">
<div class="row">
    <div class="col-lg-12 text-center">
        <div id="calendar" class="col-centered">
        </div>
    </div>
    
</div>
<!-- /.row -->

<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form class="form-horizontal" method="POST" action="addEvent.php">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">اضافة مهمة</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">العنوان</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
          </div>
          <div class="form-group">
            <label for="subject" class="col-sm-2 control-label">المادة</label>
            <div class="col-sm-10">
              <input type="text" name="subject" class="form-control" id="subject" placeholder="subject">
            </div>
          </div>
          <div class="form-group">
            <label for="color" class="col-sm-2 control-label">لون المهمة</label>
            <div class="col-sm-10">
              <select name="color" class="form-control" id="color">
                  <option value="">Choose</option>
                  <option style="color:#0071c5;" value="#0071c5">&#9724; ازرق غامق</option>
                  <option style="color:#40E0D0;" value="#40E0D0">&#9724; سماوي</option>
                  <option style="color:#008000;" value="#008000">&#9724; اخضر</option>						  
                  <option style="color:#FFD700;" value="#FFD700">&#9724; اصفر</option>
                  <option style="color:#FF8C00;" value="#FF8C00">&#9724; برتقالي</option>
                  <option style="color:#FF0000;" value="#FF0000">&#9724; احمر</option>
                  <option style="color:#000;" value="#000">&#9724; اسود</option>
                  
                </select>
            </div>
          </div>
          <div class="form-group">
            <label for="start" class="col-sm-2 control-label">اليوم </label>
            <div class="col-sm-10">
              <input type="text" name="start" class="form-control" id="start" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="end" class="col-sm-2 control-label">End date</label>
            <div class="col-sm-10">
              <input type="text" name="end" class="form-control" id="start" readonly>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form class="form-horizontal" method="POST" action="editEventTitle.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
          </div>
          <div class="form-group">
            <label for="color" class="col-sm-2 control-label">Color</label>
            <div class="col-sm-10">
              <select name="color" class="form-control" id="color">
                  <option value="">Choose</option>
                  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                  <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
                  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                  <option style="color:#000;" value="#000">&#9724; Black</option>
                  
                </select>
            </div>
          </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                  </div>
                </div>
            </div>
          
          <input type="hidden" name="id" class="form-control" id="id">
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

</div>
<!-- /.container -->
   

<!-- page content ends -->
</div>
  </div>

</body>
 <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	
	<script>

$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2024-09-19',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD');
			if(event.end){
				end = event.end.format('YYYY-MM-DD');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	});


</script>
<script src="../assets/js/script.js"></script>
</html>