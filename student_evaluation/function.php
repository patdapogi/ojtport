<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
		// include('../class/list.php');
    	
    	if($_POST['type']=='add'){
			$student_id 	 =$_POST['student'];
			$date 	   	 =$_POST['date'];
			$remarks 	  	 =$_POST['remarks'];

			// checking empty fields
			if(empty($student_id) || empty($date) || empty($remarks)) {
				$err_msg = "Something went wrong. Please check fields value";
			// header('location:./');	
			}else{
				if($remarks=='absent'){
					$timein 	  	 =null;
					$timeout 	  	 =null;
					AddAttendance($student_id,$date,$remarks,$timein,$timeout);	
			
				}else{
					$timein 	  	 =$_POST['timein'];
					$timeout 	  	 =$_POST['timeout'];
					if(empty($timein) || empty($timeout)){
						$err_msg = "Something went wrong. Please check timein and timeout";
					}else{
						AddAttendance($student_id,$date,$remarks,$timein,$timeout);
					}
				}

			}

    
			if($_POST['type']=='delete'){
				if(isset($_POST['id'])){
					$id=$_POST['id'];

					$list->DeleteOffers($id);
					header('location:./');
					exit();
				}
			}

			if($_POST['type']=='edit'){

				$id 			 =$_POST['id'];		    
				$company_name 	 =$_POST['company_name'];
				$industry 	   	 =$_POST['industry'];
				$address 	  	 =$_POST['address'];
				$position 	  	 =$_POST['position'];
				$course 	  	 =$_POST['course'];
				
				// checking empty fields
				if(empty($company_name) || empty($industry) || empty($address) || empty($position) || empty($course)) {

		        	$err_msg = "Something went wrong. Please check fields value";
				}else{
					$list->UpdateOffers($id,$company_name,$industry,$address,$position,$course);
					header('location:./');
					exit();
				}

			}	
    	}
		}
    	function AddAttendance($student_id,$date,$remarks,$timein,$timeout){
		include('../class/list.php');
                foreach($list->getStudentName($student_id) as $row){
                    $student = $row['fname'].' '.$row['lname'];
                }

				//insert data to database	
				$list->AddAttendance($student_id,$student,$date,$remarks,$timein,$timeout);
				header('location:./list_attendance.php?id='.$student_id);
				// header('location:./');
				exit();

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
                    <center><h4 class="modal-title" id="myModalLabel">Delete Company</h4></center>
                </div>
                <div class="modal-body">
				<?php

					$del=mysqli_query($conn,"select * from list_offers where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Class: <strong><?php echo $drow['company_name']; ?></strong></center></h5> 
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
                    <center><h4 class="modal-title" id="myModalLabel">Edit Company</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"select * from list_offers where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
					<form method="POST" action="./function.php">
				<!-- <form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>"> -->
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Company name :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="company_name" class="form-control" value="<?php echo $erow['company_name']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Industry :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="industry" class="form-control" value="<?php echo $erow['industry']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Position Offer :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="position" class="form-control" value="<?php echo $erow['position']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Address :</label>
						</div>
						<div class="col-lg-7">
							<input type="text" name="address" class="form-control" value="<?php echo $erow['address']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="control-label form-label">Course:</label>
						</div>
						<div class="col-lg-7">
							<select name="course" class="slt"> 
							<?php

	                            $query2=mysqli_query($conn,"SELECT * FROM `types_courses` WHERE `name_code`='".$erow['course_required']."'");
	                            while($row2=mysqli_fetch_array($query2)){
							?>
								<option value="<?php echo $row2['name_code']; ?>"><?php echo $row2['name_type']; ?></option>

							<?php	                            	
	                            }
							?>
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
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Class Attendance</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="./function.php">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Student Name :</label>
						</div>
						<div class="col-lg-8">
						<select name="student" id="student" class="slt" required> 
							<option value="">Select Student</option>
							<?php
								$query1=mysqli_query($conn,"SELECT * FROM `list_student`");

                                while($row1=mysqli_fetch_array($query1)){
                                ?>
								<option value = "<?php echo($row1['id'])?>" >
								<?php echo($row1['fname']." ".$row1['lname']) ?>
								</option>
                                <?php
                                }
							?>
						</select>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Date:</label>
						</div>
						<div class="col-lg-8">
							<input type="date" class="form-control" name="date" required>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Remarks :</label>
						</div>
						<div class="col-lg-8">
						<select name="remarks" id="remarks" class="slt" required> 
							<option value="Present">Select Remark</option>
							<option value="present">Present</option>
							<option value="absent">Absent</option>
						</select>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Time In:</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="timein">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Time Out:</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="timeout">
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
