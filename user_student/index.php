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
    $session_flag_id_user_type = ($session_id_user_type == 1);
    
    // Proceed if request method is get otherwise go to else.
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Proceed if one of the session flags is false.
        if (!($session_flag_is_login && $session_flag_id_user && $session_flag_id_user_type)) {
            // Destroy session.
            session_destroy();
            
            // Redirect to login page and exit script.
            header('Location:../login_student.php');
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

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LPU OJT PORTAL - Student Home Page</title>
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
            $(document).ready(function() {
                $("#imgUploadAvatar").click(function() {
                    $("#uploadAvatar").trigger("click");
                });
            });
        </script>
    </head>
    <body background="../assets/images/portal_bg.png">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <a href="./index.php">
                <img class="navbar-brand" src="../assets/images/portal_logo.png" width="50px" height="58px"/>
            </a>
            <p class="title">LYCEUM OF THE PHILIPPINES UNIVERSITY</p>
        </nav>
        <div class="container-fluid">
            <div class="portal-content">
                <div class="row justify-content-center">
                    <a class="btn" href="../list_student/editStudent.php?id=<?php echo $_SESSION['id_user'] ?>">

                    <?php
                        $edit=mysqli_query($conn,"select * from list_student where id='".$_SESSION['id_user']."'");
                        $row=mysqli_fetch_array($edit);
                        // header('content-type: image/jpeg');
                    ?>
                    <?php
                    if(empty($row['image'])){
                    ?>                    
                        <img src="../assets/images/profile.png" id="imgUploadAvatar" width="96px" height="96px" />
                    <?php
                    }else{
                    ?>
                        <img src='<?php echo "http://localhost/lpuojtportal/list_student/loadImage.php?id=".$row['id']?>' class="photo-circle" width="96px" height="96px" />

                    <?php
                    }
                    ?>
                    </a>

                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">
                        <?php
                        include('../class/list.php');

                        // var_dump($list->getStudentName($_SESSION['id_user']));die;

                        foreach($list->getStudentName($_SESSION['id_user']) as $row){
                            
                            $student_id   = $row['id'];
                            $student_name = $row['name_first'].' '.$row['name_last'];
                        ?>
                        Welcome <?= $student_name ?> !
                        <?php
                        
                        }
                        ?>

                    </p>
                </div>
                <div class="row" style="margin-top:16px">
                <?php
                    $menu_items = array(
                        array('Announcements',         'announcements_logo.png', '../announcement/'),
                        array('List of OJT Offerings',            'ojt_offers.png',         '../list_offers/'),
                        array('OJT Attendance',        'student_logo.png',              '../list_attendance/list_attendance.php?id='.$_SESSION['id_user']),
                        array('OJT Requirements',      'company_logo.png',       '../list_requirements/'),
                        array('Student Checklist',     'checklist_logo.png',     '../list_checklist/'),
                        array('Adviser Information',   'adviser_logo.png',       '../account_adviser/profile.php?id='.$student_id),
                        array('Internship Evaluation',    'evaluation_logo.png',   '../student_evaluation/evaluation_view.php?id='.$_SESSION['id_user']),
                        array('FAQS',        'student_logo.png',              '../faqs/'),
                        array('Password',              'password_logo.png',             '#studenchangepass'),
                        array('Logout',               'logout_logo.png',            '../logout.php'));
                        
                    foreach ($menu_items as $item) {
                        $item_title = $item[0];
                        $item_image = $item[1];
                        $item_link  = $item[2];
                        
                        if($item_title=='Password'){
                            print('<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3" style="margin-top:8px">');
                            print('    <a href="'.$item_link.'" data-toggle="modal" >');
                            print('    <div class="row justify-content-center">');
                            print('        <img src="../assets/images/'.$item_image.'" width="56px" height="56px" />');
                            print('    </div>');
                            print('    <div class="row justify-content-center">');
                            print('        <p class="font-weight-plain text-center">'.$item_title.'</p></a>');
                            print('    </div>');
                            print('    </a>');
                            print('</div>');
                        }else{
                            print('<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3" style="margin-top:8px">');
                            print('    <a href="'.$item_link.'">');
                            print('    <div class="row justify-content-center">');
                            print('        <img src="../assets/images/'.$item_image.'" width="56px" height="56px" />');
                            print('    </div>');
                            print('    <div class="row justify-content-center">');
                            print('        <p class="font-weight-plain text-center">'.$item_title.'</p></a>');
                            print('    </div>');
                            print('    </a>');
                            print('</div>');
                        }
                    }
                        include('function.php');
                ?>
                </div>
            </div>
        </div>
    </body>
</html>