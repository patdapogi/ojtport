<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
		include('../class/list.php');
    	
    	if($_POST['type']=='add'){
    		$student_id 	 = $_POST['student_id'];
    		$checklist 	 	 = $_POST['checklist'];
			$date_created 	 =date("Y-m-d");

			// checking empty fields
			if(empty($student_id) || empty($checklist)) {
				$err_msg = "Something went wrong. Please check fields value";
			// header('location:./');	
			}else{

                foreach($list->getStudentName($student_id) as $row){
                    $student_name = $row['fname'].' '.$row['lname'];
                }

    //             $check =[];
    //             $checklist_c->data=$checklist_d;
    //             $checklist_c->data = $checklist_d;
				// $checklist = json_encode($checklist_c);

				$list->AddChecklist($student_id,$checklist,$student_name,$date_created);
				header('location:./');
				exit();
			}     		
    	}

    
        if($_POST['type']=='addnew'){
            $student_id      = $_POST['id'];
            $checklist       = 1;
            
            $list->AddStudentChecklist($checklist,$student_id);
            header('location:./');            
        }

    
        if($_POST['type']=='approvechecklist'){
            $student_id      = $_POST['id'];
            $code            = $_POST['code'];
            $checked            = $_POST['approve'];
            // $checked         = 1;
            
            $list->ApproveChecklist($student_id,$code,$checked);
            header('location:./list_checklist.php?id='.$student_id);            
        }

        if($_POST['type']=='disapprovedchecklist'){
            $student_id      = $_POST['id'];
            $code            = $_POST['code'];
            $checked         = 0;
            
			$err_msg = $student_id;
            $list->ApproveChecklist($student_id,$code,$checked);
            header('location:../');
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
                    <center><h4 class="modal-title" id="myModalLabel">Add Student checklist</h4></center>
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
                </div> 
				</div>
				<input type="hidden" name="type" value="addnew">
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

<!-- Edit -->
    <div class="modal fade" id="approvechecklist<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Student Checklist</h4></center>
                </div>
                <div class="modal-body">
                <?php

                    $edit=mysqli_query($conn,"select * from list_checklist where student_id='".$row['id']."'");
                    $erow=mysqli_fetch_array($edit);
                ?>
                <div class="container-fluid">
				<form method="POST" action="./function.php">
                    <div class="row">
                        <div class="col-lg-10">
                            <label class="form-label">Click approve button to approve student checklist</label>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="code" value="<?php echo $erow['code']; ?>">
                <input type="hidden" name="id" value="<?php echo $erow['id']; ?>">
                <input type="hidden" name="type" value="approvechecklist">
                <input type="hidden" name="approve" id="approve">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning btn-approve"><span class="glyphicon glyphicon-check"></span> Approve</a>
                    <button class="btn btn-warning btn-disapprove"><span class="glyphicon glyphicon-check"></span> Disapprove</a>
                </div>
                </form>
            </div>
        </div>
<!--         <form> -->
    </div>
<script type="text/javascript">
    $('.btn-approve').click(function(){
        $('#approve').val(1);
    });

    $('.btn-disapprove').click(function(){
        $('#approve').val(0);
    });

</script>
<!-- disapproved -->
    <div class="modal fade" id="disapprovedchecklist<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Student Checklist</h4></center>
                </div>
                <div class="modal-body">
                <?php

                    $edit=mysqli_query($conn,"select * from list_checklist where student_id='".$row['id']."'");
                    $erow=mysqli_fetch_array($edit);
                ?>
                <div class="container-fluid">
				<form method="POST" action="./function.php">
                    <div class="row">
                        <div class="col-lg-10">
                            <label class="form-label">Are you sure you want to disapprove student checklist?</label>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="code" value="<?php echo $erow['code']; ?>">
                <input type="hidden" name="id" value="<?php echo $erow['id']; ?>">
                <input type="hidden" name="type" value="disapprovedchecklist">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Yes</a>
                </div>
                </form>
            </div>
        </div>
<!--         <form> -->
    </div>