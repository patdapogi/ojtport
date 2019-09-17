<?php
    // Include database configuration script.
    include("../db_config.php");

    // Start session.
    session_start();
    
    // Get session data.
    $session_is_login     = isset($_SESSION['is_login'])     ? $_SESSION['is_login']     : 0;
    $session_id_user      = isset($_SESSION['id_user'])      ? $_SESSION['id_user']      : 0;
    $session_id_user_type = isset($_SESSION['id_user_type']) ? $_SESSION['id_user_type'] : 0;
       
    // Assess session flags.
    $session_flag_is_login     = ($session_is_login < 0);
    $session_flag_id_user      = ($session_id_user > 0);
    
    // Proceed if session flags are true.
    if ($session_flag_is_login) {
        header('Location:../');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
        include('../class/list.php');

        $list = new Listing;

        if($_POST['type']=='edit'){
            // Get post values.

                $id                     =$_GET['id'];
                $fname                  =$_POST['fname'];
                $lname                  =$_POST['lname'];
                $course                 =$_POST['course'];
                $section                =$_POST['section'];
                $year                   =$_POST['year'];
                $intern_type            =$_POST['intern_type'];
                $mobile_no              =$_POST['mobile_no'];
                $email_add              =$_POST['email_add'];
                $ojt_position           =$_POST['ojt_position'];
                $ojt_dept               =$_POST['ojt_dept'];
                $company_id             =$_POST['company_id'];
                $company_name           =$_POST['company_name'];
                $supervisor_mobile_no   =$_POST['supervisor_mobile_no'];
                $supervisor_name        =$_POST['supervisor_name'];
                $supervisor_position    =$_POST['supervisor_position'];
                $supervisor_email_add   =$_POST['supervisor_email_add'];
                $supervisor_dept        =$_POST['supervisor_dept'];
                $ojt_start_date         =$_POST['ojt_start_date'];
                $ojt_end_date           =$_POST['ojt_end_date'];
                // $image                  = $_FILES['image']['tmp_name'];
                // $imagecontent           = file_get_contents($image);


            if(empty($fname) || empty($lname) || empty($course) || empty($section) || empty($year) || empty($intern_type) || empty($mobile_no) || empty($email_add) || empty($ojt_position) || empty($ojt_dept)) {                
                $err_msg = $id;
                // $err_msg = "Something went wrong. Please check fields value";
            }else{

                // $user       = $_SESSION['auth_user'];

                //insert data to database   
                if($list->EditStudent($id,$fname,$lname,$course,$section,$year,$intern_type,$mobile_no,$email_add,$ojt_position,$ojt_dept,$ojt_start_date,$ojt_end_date,$company_id,$company_name,$supervisor_mobile_no,$supervisor_name,$supervisor_position,$supervisor_email_add,$supervisor_dept)){
                    header('location:./');
                }else{
                    $err_msg = "Something went wrong. Please try again later";
                
                }
            }
        }



    }

?>

<?php
    if (isset($err_msg) && !empty($err_msg)) {
        print('<script type="text/javascript">');
        print('alert("'.$err_msg.'");');
        print('document.location = "../"</script>');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LPU OJT PORTAL - Admin Home Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <script src="../assets/js/jquery-3.1.1.min.js"></script>
        <script src="../assets/js/tether.min.js"></script>

        <!-- <script src="./asset/js/jquery.min.js"></script> -->
        <link rel="stylesheet" href="./asset/css/bootstrap.min.css" />
        <script src="./asset/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="../assets/css/lpuojtportal.css">
        <script type="text/javascript">
            // $(document).ready(function() {
            //     $("#imgUploadAvatar").click(function() {
            //         $("#uploadAvatar").trigger("click");
            //     });
            // });
        </script>
        <style>
        .error {color: #FF0000;}
        </style>
    </head>
    <body background="../assets/images/portal_bg.png">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <a href="./index.php">
                <img class="navbar-brand" src="../assets/images/portal_logo.png" width="50px" height="58px"/>
            </a>
            <p class="title">LYCEUM OF THE PHILIPPINES UNIVERSITY</p>
        </nav>
        <div class="container-fluid">
            <div class="portal-content-large">
                <div class="row justify-content-center">
                    <input type="file" style="display:none" accept="image/*" id="uploadAvatar" />
                    <img src="../assets/images/form_logo.png" width="96px" height="96px" />
                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">OJT Student Form</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">

                            <?php
                                $edit=mysqli_query($conn,"select * from list_student where id='".$_GET['id']."'");
                                $row=mysqli_fetch_array($edit);
                                // header('content-type: image/jpeg');
                            ?>
                        
                             <form method="POST" enctype="multipart/form-data" class="form-text">
                            <input type="hidden" name="type" value="edit">

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="box-details-id">
                                        <?php
                                        if(empty($row['image'])){
                                        ?>
                                             <h5>No Photo</h5>
                                             <a class="btn btn-browse" href="#uploadimage<?php echo $row['id']; ?>" data-toggle="modal" >Upload image</a>
                                        <?php
                                        }else{
                                        ?>
                                            <image height='auto' src='<?php echo "http://localhost/lpuojtportal/list_student/loadImage.php?id=".$row['id']?>' />  
                                        <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="col box-details">
                                        <h4>OJT</h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="control-label form-label">Start Date :</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="date" class="form-control" name="ojt_start_date" value="<?php echo $row['ojt_start_date']; ?>" required>
                                            </div>
                                        </div>
                                        <div style="height:10px;"></div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="control-label form-label">End Date :</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="date" class="form-control" name="ojt_end_date" value="<?php echo $row['ojt_end_date']; ?>" required>
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
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="fname">First Name</label>
                                                <input type="fname" name="fname" class="form-control" id="fname" placeholder="Enter First Name" value="<?php echo $row['fname']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lname">Last Name</label>
                                                <input type="lname" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" value="<?php echo $row['lname']; ?>" required>
                                            </div>
                                        </div>
                                      </div>      

                                        <label for="course">Course</label>
                                        <input type="course" name="course" class="form-control" id="course" placeholder="Enter course" value="<?php echo $row['course']; ?>" required>

                                      <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <input type="section" name="section" class="form-control" id="section" placeholder="Enter Section" value="<?php echo $row['section']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <input type="year" name="year" class="form-control" id="year" placeholder="Enter year" value="<?php echo $row['year']; ?>" required>
                                            </div>
                                        </div>
                                      </div>  

                                        <label for="intern_type">Intern type</label>
                                        <input type="intern_type" name="intern_type" class="form-control" id="intern_type" placeholder="Enter Intern type required" value="<?php echo $row['intern_type']; ?>">

                                        <label for="mobile_no">Mobile no</label>
                                        <input type="mobile_no" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter mobile_no" value="<?php echo $row['mobile_no']; ?>">

                                        <label for="email_add">Email Add</label>
                                        <input type="email_add" name="email_add" class="form-control" id="email_add" placeholder="Enter email_add" value="<?php echo $row['email_add']; ?>">

                                        <label for="ojt_position">OJT position</label>
                                        <input type="ojt_position" name="ojt_position" class="form-control" id="ojt_position" placeholder="Enter OJT position"  value="<?php echo $row['ojt_position']; ?>" required>

                                        <label for="ojt_dept">OJT Department</label>
                                        <input type="ojt_dept" name="ojt_dept" class="form-control" id="ojt_dept" placeholder="Enter ojt_dept"  value="<?php echo $row['ojt_dept']; ?>" required>


                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="company_id">Company ID</label>
                                        <input type="company_id" name="company_id" class="form-control" id="company_id" placeholder="Enter company_id" value="<?php echo $row['company_id']; ?>">
                                        <label for="company_name">Company name</label>
                                        <input type="company_name" name="company_name" class="form-control" id="company_name" placeholder="Enter company_name" value="<?php echo $row['company_name']; ?>" required>
                                        <label for="company_address">Company address</label>
                                        <input type="company_address" name="company_address" class="form-control" id="company_address" placeholder="Enter company_address" ?>">
                                        <label for="supervisor_name">Supervisor name</label>
                                        <input type="supervisor_name" name="supervisor_name" class="form-control" id="supervisor_name" placeholder="Enter supervisor_name" value="<?php echo $row['supervisor_name']; ?>" required>
                                        <label for="supervisor_mobile_no">Mobile no</label>
                                        <input type="supervisor_mobile_no" name="supervisor_mobile_no" class="form-control" id="supervisor_mobile_no" placeholder="Enter Section" value="<?php echo $row['supervisor_mobile_no']; ?>">
                                        <label for="supervisor_position">Position</label>
                                        <input type="supervisor_position" name="supervisor_position" class="form-control" id="supervisor_position" placeholder="Enter supervisor_position" value="<?php echo $row['supervisor_position']; ?>">
                                        <label for="supervisor_email_add">Email address</label>
                                        <input type="supervisor_email_add" name="supervisor_email_add" class="form-control" id="supervisor_email_add" placeholder="email add Section" value="<?php echo $row['supervisor_email_add']; ?>">
                                        <label for="supervisor_dept">Department</label>
                                        <input type="supervisor_dept" name="supervisor_dept" class="form-control" id="supervisor_dept" placeholder="Enter Department" value="<?php echo $row['supervisor_dept']; ?>">
                                    </div>                                
                                </div>
                              </div>
                            </div>

                            <div class="row" style="margin-top: 20px;margin-left: 10px;">
                                <div class="col-xs-6">
                                    <?php
                                    if($_SESSION['id_user_type']=1){
                                    ?>
                                        <a class="btn btn-primary" href="../" data-toggle="modal" >
                                    <?php
                                    }else{
                                    ?>
                                        <a class="btn btn-primary" href="./" data-toggle="modal" >
                                    <?php
                                    }
                                    ?>
                                    Go Back
                                </a></div>
                                    <?php
                                    if($_SESSION['id_user_type']!=1){
                                    ?>
                                    <div class="col-xs-6">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                                    </div>                                    
                                    <?php
                                    }
                                    ?>
                            </div>

                        </form>   
                    </div>

                </div>

               
            </div>
        </div>
    </body>
</html>


<!-- Delete -->
    <div class="modal fade" id="uploadimage<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="POST" action="function.php" enctype="multipart/form-data" class="form-text">
        <div class="modal-dialog">
            <div class="modal-content">
                 <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Uploadasas Image</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                    <div class="box-details-uploadimage">
                    <input type='file' name='image' accept="image/*" required />
                    <input type="hidden" name="type" value="uploadimage">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> Save</a>
                     <!-- href="delete.php?id=<?php echo $row['id']; ?>" -->
                </div>
                
            </div>
        </div>
    </form>
    </div>
<!-- /.modal -->