<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
		include('../class/list.php');
    	
    	if($_POST['type']=='addnew'){
	        // Get post values.
			$year 	 	  =$_POST['year'];
			$course 	  =$_POST['course'];
			$dept_id 	  =$_POST['dept_id'];
			$date_created =date("Y-m-d");

			// checking empty fields
			if(empty($year) || empty($course)) {
	            $err_msg = "Something went wrong. Please check fields value";
				// header('location:./');	
			}else{

			    session_start();
				$user  	    = $_SESSION['auth_user'];

				//insert data to database	
				$list->AddClassList($dept_id,$year,$course,$date_created);
				header('location:./list_course.php?id='.$dept_id);
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

    	if($_POST['type']=='addsection'){
	        // Get post values.
			$section 	 	  =$_POST['section'];
			$class_id 	 	  =$_POST['class_id'];
			// checking empty fields
			if(empty($section)) {
	            $err_msg = "Something went wrong. Please check fields value";
				// header('location:./');	
			}else{

				//insert data to database	
				$list->AddClassSection($class_id,$section);
				header('location:./list_class.php?id='.$class_id);
			}    		
    	}

    	if($_POST['type']=='adddept'){
	        // Get post values.
			$name_type 	 	  =$_POST['name_type'];
			$name_code 	 	  =$_POST['name_code'];
			// checking empty fields
			if(empty($name_type)) {
	            $err_msg = "Something went wrong. Please check fields value";
				// header('location:./');	
			}else{

				//insert data to database	
				$list->AddDepartment($name_type,$name_code);
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
	<form method="POST" action="./function.php">
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
					<form method="POST" action="./function.php">
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


<!-- Add New Department-->
    <div class="modal fade" id="addnewdept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add Department</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="./function.php">
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Department name :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="name_type" class="form-control">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Department code :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="name_code" class="form-control"s>
						</div>
					</div>
                </div> 
				</div>
				<input type="hidden" name="type" value="adddept">
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


<!-- Add New -->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add Class</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="./function.php">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Year :</label>
						</div>
						<div class="col-lg-8">
						<select name="year" class="slt">
							<option value="1ST">First Year</option>
							<option value="2ND">Second Year</option>
							<option value="3RD">Third Year</option>
							<option value="4TH">Fourth Year</option>
						</select>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Course:</label>
						</div>
						<div class="col-lg-8">
						<select name="course" class="slt"> 
							<?php
								$query1=mysqli_query($conn,"SELECT * FROM `types_courses`");

                                while($row1=mysqli_fetch_array($query1)){
                                ?>
								<option value = "<?php echo($row1['name_code'])?>" >
								<?php echo($row1['name_type']) ?>
								</option>
                                <?php
                                }
							?>
						</select>
						</div>
					</div>
					<div style="height:10px;"></div>
                </div> 
				</div>
				<input type="hidden" name="type" value="addnew">
				<input type="hidden" name="dept_id" value="<?php echo $_GET['id']; ?>">
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


<!-- Add New -->
    <div class="modal fade" id="addnewsection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add Section</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="./function.php">
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Section code :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="section" class="form-control">
						</div>
					</div>
					<div class="row">
						<input type="hidden" name="class_id" class="form-control" value="<?php echo $_GET['id']; ?>">
					</div>
					<div style="height:10px;"></div>
                </div> 
				</div>
				<input type="hidden" name="type" value="addsection">
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
