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
                    <img src="../assets/images/ojt_offers.png" width="96px" height="96px" />
                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">Course Section</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">
                      <div class="table-responsive">   

                        <table class="table table-striped table-bordered table-hover tbl-list">
                            <thead>
                                <!-- <th>ID</th> -->
                                <th>Section</th>
                                <th>Course</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php
                                include('../conn.php');
                                $query=mysqli_query($conn,"select * from `list_section` where `class_id`='".$_GET['id']."'");
                                while($row=mysqli_fetch_array($query)){

                                    ?>
                                    <tr>
                                        <!-- <td><?php echo $row['id']; ?></td> -->
                                        <td><?php echo $row['section']; ?></td>
                                        <td><?php 
                                        $query1=mysqli_query($conn,"select * from `list_class` where `id`='".$row['class_id']."'");
                                        while($row1=mysqli_fetch_array($query1)){

                                            echo $row1['course'];
                                        }
                                         ?></td>
                                        <td>
                                            <a href="../list_student/index.php?sec=<?php echo $row['section']; ?>" data-toggle="modal" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> Check Section</a> 
                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                            
                            ?>
                            </tbody>
                        </table>                        

                        </div>                  
                    </div>

                </div>
            <div class="row">
                <div class="col-xs-6"><a class="btn btn-primary" href="./list_course.php?id=<?php echo $_GET['id']; ?>" data-toggle="modal" >Go Back</a></div>
                <div class="col-xs-6"><a class="btn btn-primary" href="#addnewsection" data-toggle="modal" >Add New</a></div>
            </div>
<?php include('function.php'); ?>
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


     <!--            <div class="form-row row" style="margin-top:16px">
                    <div class="col-4">
                        <a class="btn btn-primary" href="AddAnnouncement.php">Add</a>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Delete</button>
                    </div>
                </div> -->