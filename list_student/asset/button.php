<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
		include('../class/list.php');
    	
    	if($_POST['type']=='add'){
	        // Get post values.
			$year 	 	  =$_POST['year'];
			$course 	  =$_POST['course'];
			$date_created =date("Y-m-d");

			// checking empty fields
			if(empty($year) || empty($course)) {
	            $err_msg = "Something went wrong. Please check fields value";
				// header('location:./');	
			}else{

			    session_start();
				$user  	    = $_SESSION['auth_user'];

				//insert data to database	
				$list->AddClassList($year,$course,$date_created);
				header('location:./');
			}    		
    	}

    	if($_POST['type']=='delete'){
			if(isset($_POST['id'])){
				$id=$_POST['id'];

				$list->DeleteClass($id);
				header('location:./');
			}
    	}

    	if($_POST['type']=='edit'){
			$id=$_POST['id'];
		    
			$year 		=$_POST['year'];
			$course 	=$_POST['course'];
			
			// checking empty fields
			if(empty($year) || empty($course)) {
            	$err_msg = "Something went wrong. Please check fields value";
			}else{
				$list->UpdateClass($id,$year,$course);
				header('location:./');
			}

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

<!-- Delete -->
    <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="POST" action="./button.php">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Delete Class</h4></center>
                </div>
                <div class="modal-body">
				<?php

					$del=mysqli_query($conn,"select * from list_class where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Class: <strong><?php echo $drow['year'].' '.$drow['course']; ?></strong></center></h5> 
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					<input type="hidden" name="type" value="delete">
                </div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                     <!-- href="delete.php?id=<?php echo $row['id']; ?>" -->
                </div>
				
            </div>
        </div>
	</form>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Edit Class</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"select * from list_class where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
					<form method="POST" action="./button.php">
				<!-- <form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>"> -->
					<div class="row">
						<div class="col-lg-4">
							<label class="form-label">Year :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="year" class="form-control" value="<?php echo $erow['year']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="form-label">Course :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="course" class="form-control" value="<?php echo $erow['course']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
                </div>

				<input type="hidden" name="id" value="<?php echo $erow['id']; ?>">
				<input type="hidden" name="type" value="edit"> 

				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</a>
                    <!-- <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button> -->
                </div>
				</form>
            </div>
        </div>
<!--         <form> -->
    </div>
<!-- /.modal -->


<!-- Add New -->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-large">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add Student</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="./button.php">

					<div class="container">
						<div class="row">
							<div class="col">
								1 of 2
							</div>
							<div class="col">
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Start Date :</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="start_date">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">End Date :</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="end_date">
									</div>
								</div>
								<div style="height:10px;"></div>



							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col">

								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">First Name :</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="fname">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Last Name:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="lname">
									</div>
								</div>	
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Course:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="course">
									</div>
								</div>	
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Section:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="section">
									</div>
								</div>	
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Year:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="year">
									</div>
								</div>	
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Intern type:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="intern_type">
									</div>
								</div>	
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">Mobile no:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="mobile_no">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">OJT position:</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="ojt_position">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-4">
										<label class="control-label form-label">OJT Dept. :</label>
									</div>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="ojt_dept">
									</div>
								</div>
								<div style="height:10px;"></div>							
							</div>

							<div class="col">
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Company name:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="company_name">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Company address:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="company_address">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Supervisor name:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="supervisor_name">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Mobile no:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="supervisor_mobile_no">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Position:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="supervisor_position">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Email address:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="supervisor_email_add">
									</div>
								</div>
								<div style="height:10px;"></div>
								<div class="row">
									<div class="col-lg-5">
										<label class="control-label form-label">Department:</label>
									</div>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="supervisor_dept">
									</div>
								</div>
								<div style="height:10px;"></div>

							</div>
						</div>
					</div>

					<div style="height:10px;"></div>
                </div> 
				</div>
				<input type="hidden" name="type" value="add">
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
