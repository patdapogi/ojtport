<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
		include('../class/list.php');
    	
        if($_POST['type']=='createaccount'){
            $student_id     =$_POST['ss_id'];         
            $name_first     =$_POST['name_first'];    
            $name_last      =$_POST['name_last'];
            $username       =$_POST['username'];
            $password       =$_POST['password'];
            $id_user_type   =3;

            // checking empty fields
            if(empty($username) || empty($password)) {
                $err_msg = "Something went wrong. Please check fields value";
            }else{
                $list->AddStudentAccount($student_id,$name_first,$name_last,$username,$password,$id_user_type);
                header('location:./');
                exit();
            }

        }


        if($_POST['type']=='changepass'){
            $student_id     =$_POST['student_id'];         
            $name           =$_POST['name'];      
            $username       =$_POST['username'];
            $password       =$_POST['password'];
            $password_new   =$_POST['password_new'];

            // checking empty fields
            if(empty($password_new) || empty($password) || empty($name)) {
                $err_msg = "Something went wrong. Please check fields value";
            }else{

                if($list->CheckStudentAccountCredentials($username,$password)){

                    $list->ChangeStudentPassword($student_id,$password_new);
                    header('location:./');
                    exit();

                }else{
                    $err_msg = "Username and Password does not match";
                }

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


<!-- createaccount -->
    <div class="modal fade" id="createadviser<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="POST" action="./button.php">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Create Account</h4></center>
                </div>
                <div class="modal-body">
                <?php
                    $edit=mysqli_query($conn,"select * from account_adviser where id='".$row['id']."'");
                    $erow=mysqli_fetch_array($edit);
                ?>

                <div class="container-fluid">
                    <form method="POST" action="./function.php">
                <!-- <form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>"> -->
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Adviser name :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" name="name" class="form-control" value="<?php echo $erow['fname'].' '.$erow['lname']; ?>">
                            <input type="hidden" name="ss_id" value="<?php echo $erow['id']; ?>">
                            <input type="hidden" name="name_first" value="<?php echo $erow['fname']; ?>"> 
                            <input type="hidden" name="name_last" value="<?php echo $erow['lname']; ?>"> 
                            <input type="hidden" name="type" value="createaccount"> 
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Username :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" name="username" class="form-control">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Password :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Save</a>
                     <!-- href="delete.php?id=<?php echo $row['id']; ?>" -->
                </div>
                
            </div>
        </div>
    </form>
    </div>
<!-- /.modal -->


<!-- Delete -->
    <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Delete Announcement</h4></center>
                </div>
                <div class="modal-body">
				<?php

					$del=mysqli_query($conn,"select * from account_adviser where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Title: <strong><?php echo $drow['fname'].' '.$drow['lname']; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Edit Announcement</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"select * from account_adviser where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>">
					<div class="row">
						<div class="col-lg-4">
							<label class="form-label">First Name :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="fname" class="form-control" value="<?php echo $erow['fname']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="form-label">Last Name :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="lname" class="form-control" value="<?php echo $erow['lname']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="form-label">Department :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="dept" class="form-control" value="<?php echo $erow['dept']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="form-label">Subject :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="subj" class="form-control" value="<?php echo $erow['subj']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
<!-- /.modal -->


<!-- Delete -->
    <div class="modal fade" id="changepass<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Change Password</h4></center>
                </div>
                <div class="modal-body">
                <?php
                    $edit=mysqli_query($conn,"select * from account_adviser where id='".$row['id']."'");
                    $erow=mysqli_fetch_array($edit);
                ?>

                <div class="container-fluid">
                    <form method="POST" action="./button.php">
                <!-- <form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>"> -->
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Student name :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" name="name" class="form-control" value="<?php echo $erow['fname'].' '.$erow['lname']; ?>">
                            <input type="hidden" name="student_id" value="<?php echo $erow['id']; ?>">
                            <input type="hidden" name="type" value="changepass"> 
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Username :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" name="username" class="form-control" value="<?php echo $erow['auth_user']; ?>">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Current Password :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">New Password :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="password" name="password_new" class="form-control">
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Save</a>
                     <!-- href="delete.php?id=<?php echo $row['id']; ?>" -->
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- /.modal -->
