<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        

        // Get post values.
		$title 		=$_POST['title'];
		$details 	=$_POST['details'];
		$event_date =$_POST['event_date'];
		$exp_event_date = $_POST['exp_event_date'];

		// checking empty fields
		if(empty($title) || empty($details) || empty($event_date) || empty($exp_event_date)) {
            $err_msg = "Something went wrong. Please check fields value";
			// header('location:./');	
		}else{

			include('../class/list.php');
		    session_start();
			$user  	    = $_SESSION['auth_user'];

			//insert data to database	
			$list->AddAnnouncement($title,$details,$event_date,$exp_event_date,$user);
			header('location:./');
		}

    }

?>
<?php
    if (isset($err_msg) && !empty($err_msg)) {
        print('<script type="text/javascript">');
        print('alert("'.$err_msg.'");');
        print('document.location = "./"</script>');
    }
?>
<!-- Add New -->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add New Announcement</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="./add_announcement.php">
					<div class="row">
						<div class="col-lg-3">
							<label class="control-label form-label">Title :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="title">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label class="control-label form-label">Details:</label>
						</div>
						<div class="col-lg-8">
							<textarea rows="4" cols="100" name="details" class="form-control"></textarea>
							<!-- <input type="text" class="form-control" name="details"> -->
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="control-label form-label">Event Date:</label>
						</div>
						<div class="col-lg-6">
							<input type="date" class="form-control" name="event_date">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="control-label form-label">Event Expiration Date:</label>
						</div>
						<div class="col-lg-6">
							<input type="date" class="form-control" name="exp_event_date">
						</div>
					</div>
                </div> 
				</div>

                <div class="modal-footer">
					<div class="row">
					    <div class="col-xs-6"><button type="button" class="btn btn-primary"  data-dismiss="modal" >Cancel</a></div>
					    <div class="col-xs-6"><button type="submit" class="btn btn-primary">Save</button></div>
					</div>

					</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>
