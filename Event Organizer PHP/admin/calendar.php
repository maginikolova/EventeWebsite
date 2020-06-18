<?php
require_once('../includes/connection.php');


$sql = "SELECT id, title, start, end, color, organizer, eventType, foodType, people FROM events ";

$req = $pdo->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calendar</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />


    <!-- Custom CSS -->
    <style>
    #calendar {
		max-width: 600px;
		margin-bottom: 20px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
 			<ul class="nav">
			  <li class="nav-item">
			    <a class="nav-link " href="admin.php">Log In</a>
				<a class="nav-link " href="calendar.php">Calendar</a>
			  </li>
			</ul>
  			<a class="navbar-brand" href="../index.php">Event Organizer</a>
 			<form class="form-inline">
    			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    			<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">GO</button> -->
  			</form>
	</nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Event Calendar</h1>
                <p class="lead">Don't miss to check all events!</p>
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
				<h4 class="modal-title" id="myModalLabel">Add Event</h4>
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
					<label for="organizer" class="col-sm-2 control-label">Oganizer</label>
					<div class="col-sm-10">
					  <select name="organizer" class="form-control" id="organizer">
						  <option value="">Choose</option>
						  <option> Oganizer 1 </option>
						  <option> Oganizer 2 </option>
						  <option> Oganizer 3 </option>						  
						  <option> Oganizer 4 </option>
						  <option> Oganizer 5 </option>
						  <option> Oganizer 6 </option>
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="eventType" class="col-sm-2 control-label">Type of event</label>
					<div class="col-sm-10">
					  <select name="eventType" class="form-control" id="eventType">
						  <option value="">Choose</option>
						  <option> Private Party </option>
						  <option> Birthday party</option>
						  <option> Team building </option>						  
						  <option> Conference </option>
						  <option> Wedding </option>
						  <option> Private Party </option>
						  <option> Other </option>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="people" class="col-sm-2 control-label">Number of people</label>
					<div class="col-sm-10">
					  <input type="number" name="people" class="form-control" id="people">
					</div>
				  </div>
				  <div class="form-group">
					<label for="foodType" class="col-sm-2 control-label">Type of food</label>
					<div class="col-sm-10">
					  <select name="foodType" class="form-control" id="foodType">
						  <option value="">Choose</option>
						  <option> Menu </option>
						  <option> Catering </option>
					  </select>
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
					<label for="organizer" class="col-sm-2 control-label">Oganizer</label>
					<div class="col-sm-10">
					  <select name="organizer" class="form-control" id="organizer">
						  <option> Oganizer 1 </option>
						  <option> Oganizer 2 </option>
						  <option> Oganizer 3 </option>						  
						  <option> Oganizer 4 </option>
						  <option> Oganizer 5 </option>
						  <option> Oganizer 6 </option>
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start">
					</div>
				  </div>
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label"> End date </label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end">
					</div>
				  </div>
				  <div class="form-group">
					<label for="eventType" class="col-sm-2 control-label">Type of event</label>
					<div class="col-sm-10">
					  <select name="eventType" class="form-control" id="eventType">
						  <option> Private Party </option>
						  <option> Birthday party</option>
						  <option> Team building </option>						  
						  <option> Conference </option>
						  <option> Wedding </option>
						  <option> Private Party </option>
						  <option> Other </option>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="people" class="col-sm-2 control-label">Number of people</label>
					<div class="col-sm-10">
					  <input type="number" name="people" class="form-control" id="people">
					</div>
				  </div>
				  <div class="form-group">
					<label for="foodType" class="col-sm-2 control-label">Type of food</label>
					<div class="col-sm-10">
					  <select name="foodType" class="form-control" id="foodType">
						  <option> Menu </option>
						  <option> Catering </option>
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
			defaultDate: '2020-06-10',
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
					$('#ModalEdit').modal('show');
					$('#ModalEdit #start').val((event.start).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalEdit #end').val((event.end).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalEdit #organizer').val(event.organizer);
					$('#ModalEdit #eventType').val(event.eventType);
					$('#ModalEdit #foodType').val(event.foodType);
					$('#ModalEdit #people').val(event.people);
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
					organizer: '<?php echo $event['organizer']; ?>',
					eventType: '<?php echo $event['eventType']; ?>',				
					people: '<?php echo $event['people']; ?>',
					foodType: '<?php echo $event['foodType']; ?>',
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
			Event[3] = organizer;
			Event[4] = eventType;
			Event[5] = people;
			Event[6] = foodType;
			
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

</body>

</html>
