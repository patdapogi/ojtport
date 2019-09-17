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
    $session_flag_is_login     = ($session_is_login <= 0);
    $session_flag_id_user      = ($session_id_user > 0);
    $session_flag_id_user_type = ($session_id_user_type == 1);
    
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
                    <img src="../assets/images/ojt_offers.png" width="96px" height="96px" />
                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">OJT Requirements</p>
                </div>
                <div class="row" style="margin-top:16px">
                <?php

                    $menu_items = array(
                        array('Memorandum of Agreement',         'ojt_offers.png', 'moa'),
                        array('Company Details',   'ojt_offers.png',              'compdetails'),
                        array('Acceptance Form',     'ojt_offers.png',     'accptform'),
                        array('E-Manual',            'ojt_offers.png',         'emanual'),
                        array('EAF',            'ojt_offers.png',         'eaf'),
                        array('Facebook Group',            'ojt_offers.png',         'facebookgroup'),
                        array('Practicum Orientation',            'ojt_offers.png',         'practicum'),
                        array('Certificate of Completion',            'ojt_offers.png',         'certcompletion'),
                        array('SFT LogBook',            'ojt_offers.png',         'sftlogbook'),
                        array('Upload Resume',            'ojt_offers.png',         'resume'),
                        array('Student Rating',            'ojt_offers.png',         'student_rating'),
                        array('Daily Time Record',            'ojt_offers.png',         'dtr'),
                        array('Finay Essay',            'ojt_offers.png',         'final_essay'),
                        array('Index Card',            'ojt_offers.png',         'index_card'),
                        );

            


                    foreach ($menu_items as $item) {
                        $item_title = $item[0];
                        $item_image = $item[1];
                        $item_link  = $item[2];

                        $query1=mysqli_query($conn,"SELECT * FROM `list_requirements` where `student_id`=".$_GET['id']." and `code`='".$item_link."'");

                        $row1       =mysqli_fetch_array($query1);
                        $code       =$row1['code'];
                        $remarks    =$row1['remarks'];

                        print('<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3" style="margin-top:8px">');
                        print('    <a href="#'.$item_link.'" data-toggle="modal" >');
                        print('    <div class="row justify-content-center">');
                        print('        <img src="../assets/images/'.$item_image.'" width="56px" height="56px" />');
                        print('    </div>');
                        print('    <div class="row justify-content-center">');
                        print('        <p class="font-weight-plain text-center">'.$item_title.'</p></a>');
                        print('    </div>');
                        if($code!=$item_link){
                            print('        <p class="font-weight-plain text-center">No Upload File</p></a>');
                        }else{

                            if($remarks == 1){

                                print('        <p class="font-weight-plain text-center">Pending</p></a>');

                            }
                                               
                            if($remarks == 2){

                                print('        <p class="font-weight-plain text-center">Approved</p></a>');

                            }
                            
                            if($remarks == 3){

                                print('        <p class="font-weight-plain text-center">Disapproved</p></a>');

                            }
                        
                        }
                        print('    </a>');

                        print('</div>');
                    }
                ?>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="col-xs-6"><a class="btn btn-primary" href="./" data-toggle="modal" >Go Back</a></div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php include('function.php'); ?>