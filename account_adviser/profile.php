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
                    <table class="table table-striped table-bordered table-hover tbl-list">
                        <tbody>
                        <?php
                                include('../class/list.php');
             
                                foreach($list->getAdviserDetails($session_id_user) as $row){
                                    $adviser_name = $row['name_first'].' '.$row['name_last'];
                                    $subj         = $row['name_code'];
                                    $dept         = $row['name_type'];
                                ?>
                                    <td><strong>Adviser name  </td><td><?= $adviser_name ?></td></tr>
                                    <td><strong>Subject  </td><td><?= $subj; ?></td></tr>
                                    <td><strong>Department   </td><td><?= $dept; ?></td></tr>
                                    <tr><td><strong>Time Availability   </td><td></td></tr>
                                <?php
                            }
                        
                        ?>
                        </tbody>
                    </table>                        

                    </div>

                     <div style="height:10px;"></div>
                </div>
            <div class="row">
                <div class="col-xs-6"><a class="btn btn-primary" href="../" data-toggle="modal" >Go Back</a></div>
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

