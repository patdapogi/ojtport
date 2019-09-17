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
    $session_flag_is_login     = ($session_is_login > 0);
    $session_flag_id_user      = ($session_id_user > 0);
    $session_flag_id_user_type = ($session_id_user_type == 4);
    
    // Proceed if request method is get otherwise go to else.
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Proceed if one of the session flags is false.
        if (!($session_flag_is_login && $session_flag_id_user && $session_flag_id_user_type)) {
            // Destroy session.
            session_destroy();
            
            // Redirect to login page and exit script.
            // header('Location:../login.php');
            header('Location:../');
            exit();
        }
    } else {
        // Forbid this page to be previewed then exit script.
        header('HTTP/1.1 403 Forbidden');
        exit();
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

<?php
  $errmsg = isset($_SESSION['index_error']) ? $_SESSION['index_error'] : "";
 
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
        </nav>
        <div class="container-fluid">
            <div class="portal-content">
                <div class="row justify-content-center">
                    <input type="file" style="display:none" accept="image/*" id="uploadAvatar" />
                    <img src="../assets/images/announcements_logo.png" width="96px" height="96px" />
                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">Add Announcement</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">
                        <p>The .table-hover class enables a hover state on table rows:</p>    
                        <!-- // <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-text">   -->
                        <form action="../announcement/add_announcement.php" method="post" class="form-text">  
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="title" name="title" class="form-control" placeholder="Enter title">
                                <small id="emailHelp" class="form-text text-small">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="details">Details</label>
                                <input type="details" name="details" class="form-control" id="details" placeholder="Enter details">
                            </div>
                            <div class='form-group date'>
                                <label for="event_date">Date</label>
                                <input type="date" name="event_date" class="form-control" />
                            </div>
                            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                        </form>   
                        <p class="h3"><?php echo $errmsg; if(!empty($errmsg)){echo "<script type=\"text/javascript\">alert('$errmsg')</script>";} ?></p>                       
              
                    </div>

                </div>

               
                <div class="form-row row" style="margin-top:16px;">
                    <div class="col-6">
                        <a class="btn btn-primary" href="announcement.php">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

