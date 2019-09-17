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
        <title>LPU OJT PORTAL</title>
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
    
    <style>
        .accordion {
            background-color: rgba(204, 163, 0, 0.8);
            color: #fff;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .active, .accordion:hover {
            background-color: rgba(179, 143, 0, 0.8);
        }

        .panel {
            padding: 0 18px;
            display: none;
            background-color: transparent;
            overflow: hidden;
        }
    </style>

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
                    <img src="../assets/images/student_logo.png" width="96px" height="96px" />
                </div>
                <div class="row justify-content-center" style="margin-top:16px">
                    <p class="h3">FAQS</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">
                      <div class="table-responsive">   
                        <button class="accordion">CCSIR</button>
                        <div class="panel">
                        <br>
                        <p class="h2">About CCSIR</p>
                        <p class="h3">Evolution of Center for Career Services and Industry Relations</p>
                          <p>From the very start, students who had to do their Internship, as required in their curriculum, were left on their own to look for companies willing to take them in. The college where the students belong to, would be involved in the process only when the student has already been recruited by the company. This is when the faculty member assigned to the students visit them at their workplace to check on their working conditions and on their performance.
                          </p>

                          <p>June 2014, LPU-Manila decided to streamline this Internship process by creating the Center for Career Services and Industry Relations. This unit is staffed by a team of Internship Coordinators whose main task is to enlist partner establishments willing to take in our students for Internship and/or eventual employment. Once the Memoranda of Agreement with these companies are signed, “want ads” from these companies are posted in Social Media (created by the unit) for the students and graduates to respond accordingly.
                          </p>

                          <p>Also, the Internship Coordinators check on the Interns’ welfare and performance, following the approved guidelines of the university, as stated in the Internship Manuals distributed to the students.
                          </p>

                          <p>Not only has the recruitment and hiring process been made easier for our students and graduates, the relationship between the university and these partner establishments has been further strengthened through the frequent visits made by the Internship Coordinators assigned to them. This has resulted to our students and graduates being given by these establishments priority over those from the other universities.
                          </p>

                          <p>With CCSIR in operation, students and graduates now feel that LPU-Manila looks after their welfare even after they have earned their respective degrees.
                          </p>

                          <p>With CCSIR in operation, students and graduates now feel that LPU-Manila looks after their welfare even after they have earned their respective degrees.
                          </p>

                          <p class="h2">VISION</p>
                          <p>CCSIR will be the formidable bridge between academic training and employment opportunities for local and international, where our students can showcase their skills and talent, towards further strengthening LPU - Manila’s contribution to national development.
                          </p>

                          <p class="h2">MISSION</p>
                          <p>
                            As a service unit of a leading University in the Asia Pacific Region, the CCSIR is committed to:
                           </p><p> Enlist the support of top enterprises in the country by profiling them and signing Memoranda of Agreement towards filling up their internship and employment vacancies with our students and graduate
                           </p><p> Ensure that our students’ and graduates' competencies match those required by the various industries where they plan to establish their respective careers
                           </p><p> Make our students and graduates be the top priority of these A-list enterprises when they recruit Interns or hire new employees                            
                          </p>

                        </div>

                        <button class="accordion">Syllabus of Practicum</button>
                        <div class="panel" style="margin-top:16px">
                          <p>Note: Click below to download file</p>
                          <br>
                          <p><a href="files/IPPE03C SYLLABUS.pdf">IPPE03C SYLLABUS</a></p>
                          <p><a href="files/PCN50E SYLLABUS.pdf">PCN50E SYLLABUS</a></p>
                          <p><a href="files/PECN50E SYLLABUS.pdf">PECN50E SYLLABUS</a></p>
                          <a href="files/PEEN50E SYLLABUS.pdf">PEEN50E SYLLABUS</a>
                        </div>

                        <button class="accordion">LPU OJT Portal</button>
                        <div class="panel">
                            <p class="h3">What is LPUT OJJT PORTAL</p>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                   
                        <button class="accordion">Technical Support</button>
                        <div class="panel">                            
                          <br>
                          <p> Is there a customer service or technical support number that I can call?.</p>
                          <br>
                          <p> You can send your email to jerainee11@gmail.com with the "Subject" on the subject line or you can call up the 09971777153.</p>
                        </div>
                   

                        </div>                  
                    </div>

                </div>

            <div class="row" style="margin-top:16px">
                <div class="col-xs-6"><a class="btn btn-primary" href="../" data-toggle="modal" >Go Back</a></div>
            </div>
            </div>
        </div>
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

<script type="text/javascript">

    $("#student").change(function () {
     // alert($('#student_id :selected').attr('value'))
     $("#student_id").val($('#student :selected').attr('value'))
    });
        
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>

