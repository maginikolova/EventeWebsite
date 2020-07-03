<?php

include_once('../includes/connection.php');
include_once('../includes/event.php');
include_once('../includes/image.php');


//$sql = "SELECT id, image, event FROM images ";

$req = $pdo->prepare($sql);
$req->execute();

$images = $req->fetchAll();

$event = new Event();
$image = new Image();

//has the user speicified an id?
if(isset($_GET['id'])){
	//display artcle
	$id = $_GET['id'];
	$eventData = $event->fetch_data($id);
  $imageData = $image->fetch_all();

?>

	<html>
		<?php
			include_once('../partials/head.html');
		?>
		<body>
			<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
	  			<a class="navbar-brand" href="../index.php">Auto Nexus</a>
	 			<form class="form-inline">
	    			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	    			<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">GO</button> -->
	  		</form>
			</nav>
			<div class="container">
				<br><br>
				<div class="overall">
					<div class="jumbotron">
						<h1> nz </h1>

						<p><small class="article-date">date here </small></p>
						<br><br>
						<p> <?php echo"Event Description Here:"; ?>
              <?php echo $eventData['title']; ?>




              <?php
                // Create database connection
                $db = mysqli_connect("localhost", "root", "", "image_upload");

                // Initialize message variable
                $msg = "";

                // If upload button is clicked ...
                if (isset($_POST['upload'])) {
                	// Get image name
                	$image = $_FILES['image']['name'];
                	// Get text
                	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

                	// image file directory
                	$target = "images/".basename($image);

                	$sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
                	// execute query
                	mysqli_query($db, $sql);

                	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                		$msg = "Image uploaded successfully";
                	}else{
                		$msg = "Failed to upload image";
                	}
                }
                $result = mysqli_query($db, "SELECT * FROM images");
              ?>
              <!DOCTYPE html>
              <html>
              <head>
              <title>Image Upload</title>
              <style type="text/css">
                 #content{
                 	width: 50%;
                 	margin: 20px auto;
                 	border: 1px solid #cbcbcb;
                 }
                 form{
                 	width: 50%;
                 	margin: 20px auto;
                 }
                 form div{
                 	margin-top: 5px;
                 }
                 #img_div{
                 	width: 80%;
                 	padding: 5px;
                 	margin: 15px auto;
                 	border: 1px solid #cbcbcb;
                 }
                 #img_div:after{
                 	content: "";
                 	display: block;
                 	clear: both;
                 }
                 img{
                 	float: left;
                 	margin: 5px;
                 	width: 300px;
                 	height: 140px;
                 }
              </style>
              </head>
              <body>
              <div id="content">
                <?php
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<div id='img_div'>";
                    	echo "<img src='images/".$row['image']."' >";
                    	echo "<p>".$row['image_text']."</p>";
                    echo "</div>";
                  }
                ?>
                <form method="POST" action="index.php" enctype="multipart/form-data">
                	<input type="hidden" name="size" value="1000000">
                	<div>
                	  <input type="file" name="image">
                	</div>
                	<div>
                    <textarea
                    	id="text"
                    	cols="40"
                    	rows="4"
                    	name="image_text"
                    	placeholder="Say something about this image..."></textarea>
                	</div>
                	<div>
                		<button type="submit" name="upload">POST</button>
                	</div>
                </form>
              </div>
              </body>
              </html>
















            </p>
						<br><br>
						<a class="btn btn-light" href="../index.php">&larr; Go Back</a>

					</div>
				</div>
			</div>
			<?php
				include_once('../partials/dependencies.html');
			?>
		</body>
	</html>

	<?php
}else{
	//get back to home page
	header('Location: index.php');
	exit();
}


?>



<script>
$(document).ready(function() {

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },
    defaultDate: '2020-05-12',
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,
    select: function(start, end) {

      $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
      $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
      $('#ModalAdd').modal('show');
    },
    eventRender: function(event, element) {
      element.bind('dblclick', function() {
        $('#ModalEdit #id').val(event.id);
        $('#ModalEdit #title').val(event.title);
        $('#ModalEdit #color').val(event.color);
        $('#ModalEdit #start').val((event.start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalEdit #end').val((event.start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalEdit').modal('show');
      });
    },
    eventDrop: function(event, delta, revertFunc) { // for changed position

      edit(event);

    },
    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // for changed length

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
    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if(event.end){
      end = event.end.format('YYYY-MM-DD HH:mm:ss');
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