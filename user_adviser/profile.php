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
    
    function print_nick() {
        global $db_server, $db_username, $db_password, $db_name;
        global $query_select_name_first;
        global $session_id_user;
        
        $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
        if ($conn) {
            $stmt = $conn->prepare($query_select_name_first);
            $stmt->bind_param("i", $session_id_user);
            $stmt->execute();
            $stmt->bind_result($out_name_first);
            $stmt->store_result();
            $stmt->fetch();
            $rows = $stmt->num_rows;
            $stmt->close();
            
            if ($rows > 0) {
                for ($i = 0; $i < strlen($out_name_first); $i++) {
                    $letter = substr($out_name_first, $i, 1);
                    if (!ctype_alpha($letter)) break;
                    print($letter);
                }
            }
            mysqli_close($conn);
        }
    }

    if(isset($_POST['type'])){
        include('../class/list.php');
        
        if($_POST['type']=='addchecklist'){
            $student_id      = $_POST['student_id'];
            $checklist       = $_POST['checklist'];
            $date_created    =date("Y-m-d");

            // checking empty fields
            if(empty($checklist)) {
                $err_msg = "Something went wrong. Please check fields value";
            // header('location:./');   
            }else{

                foreach($list->getStudentName($student_id) as $row){
                    $student_name = $row['fname'].' '.$row['lname'];
                }

                $list->AddChecklist($student_id,$checklist,$student_name,$date_created);
                header('location:./list_checklist.php?id='.$student_id);
                exit();
            }           
        }
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
        </script>
    </head>

    <body background="../assets/images/portal_bg.png">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <a href="./index.php">
            <img class="navbar-logo" src="../assets/images/portal_logo.png"/>
        </a>
            <p class="title">LYCEUM OF THE PHILIPPINES UNIVERSITY</p>
        </nav>


        <div class="container-fluid">
            <div class="portal-content">
                <div class="row justify-content-center">
                    <img src="../assets/images/adviser_logo.png" width="96px" height="96px" />
                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">Adviser Information</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">
                    <!--  <h5><strong>Student name :</strong>
                     <?php
                        include('../class/list.php');
                        foreach($list->getAdviserDetails($_SESSION['id_user']) as $row){
                            $adviser_name = $row['fname'].' '.$row['lname'];
                            $subj         = $row['subj'];
                            $dept         = $row['dept'];
                            echo $adviser_name;
                     ?>
                     <div style="height:10px;"></div>
                    <strong>Subject : </strong>
                    <?php echo $subj; ?>
                     <div style="height:10px;"></div>
                    <strong>Department : </strong>
                    <?php echo $dept; ?>
                     <div style="height:10px;"></div>
                    <strong>Time Availability : </strong>
                     </h5>
                     <?php 
                        }
                    ?> -->


                    <table class="table table-striped table-bordered table-hover tbl-list">
                        <tbody>
                        <?php
                                foreach($list->getAdviserDetails($_SESSION['id_user']) as $row){
                                    $adviser_name = $row['fname'].' '.$row['lname'];
                                    $subj         = $row['subj'];
                                    $dept         = $row['dept'];
                                ?>
                                    <tr><td class="col-5"><strong>Adviser name  </td><td><?php echo $adviser_name ?></td></tr>
                                    <tr><td class="col-5"><strong>Subject  </td><td><?php echo $subj; ?></td></tr>
                                    <tr><td class="col-5"><strong>Department   </td><td><?php echo $dept; ?></td></tr>
                                    <tr><td class="col-5"><strong>Time Availability   </td><td></td></tr>
                                <?php
                            }
                        
                        ?>
                        </tbody>
                    </table>                        

                    </div>

                     <div style="height:10px;"></div>
                </div>
            <div class="row">
                <div class="col-xs-6"><a class="btn btn-primary" href="./" data-toggle="modal" >Go Back</a></div>
            </div>

            </div>
        </div>
    <!-- <?php include('add_class.php'); ?> -->
    </body>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    
</html>


<!-- Add New -->
    <div class="modal fade" id="addnewchecklist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add checklist</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form method="POST" action="./list_checklist.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label form-label">Checklist :</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="checklist" required>
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="addchecklist">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
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
