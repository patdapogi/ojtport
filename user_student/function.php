<?php

    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
	
        include('../class/list.php');
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



<!-- Delete -->
    <div class="modal fade" id="studenchangepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Change Password</h4></center>
                </div>
                <div class="modal-body">
                <?php
                    $edit=mysqli_query($conn,"select * from list_student where id='".$row['id']."'");
                    $erow=mysqli_fetch_array($edit);
                ?>

                <div class="container-fluid">
                    <form method="POST" action="function.php"><div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">Student name :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" name="name" class="form-control" value="<?php echo $erow['fname'].' '.$erow['lname']; ?>">
                            <input type="hidden" name="student_id" value="<?php echo $erow['id']; ?>">
                            <input type="hidden" name="type" value="studenchangepass"> 
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
                    <div style="height:10px;"></div>
                    <div style="height:10px;"></div>
                <input type="hidden" name="type" value="changepass">
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