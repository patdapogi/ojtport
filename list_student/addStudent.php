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

        if($_POST['type']=='add'){
            // Get post values.
                // $course                 =$_POST['course'];
                // $year                   =$_POST['year'];

                $fname                  =$_POST['fname'];
                $lname                  =$_POST['lname'];
                $class_code             =$_POST['class_code'];
                $section                =$_POST['section'];
                $intern_type            =$_POST['intern_type'];
                $mobile_no              =$_POST['mobile_no'];
                $email_add              =$_POST['email_add'];
                $ojt_position           =$_POST['ojt_position'];
                $ojt_dept               =$_POST['ojt_dept'];
                $company_id             =$_POST['company_id'];
                $supervisor_mobile_no   =$_POST['supervisor_mobile_no'];
                $supervisor_name        =$_POST['supervisor_name'];
                $supervisor_position    =$_POST['supervisor_position'];
                $supervisor_position    =$_POST['supervisor_position'];
                $supervisor_email_add   =$_POST['supervisor_email_add'];
                $supervisor_dept        =$_POST['supervisor_dept'];
                $ojt_start_date         =$_POST['ojt_start_date'];
                $ojt_end_date           =$_POST['ojt_end_date'];
                $image                  =$_FILES['image']['tmp_name'];
                $imagecontent           =file_get_contents($image);


            if(empty($fname) || empty($lname) || empty($section)|| empty($intern_type) || empty($mobile_no) || empty($email_add) || empty($ojt_position) || empty($ojt_dept) || empty($company_id) || empty($supervisor_mobile_no) || empty($supervisor_name) || empty($supervisor_position) || empty($supervisor_email_add) || empty($supervisor_dept) || empty($ojt_start_date) || empty($ojt_end_date)) {                
                $err_msg = "Something went wrong. Please check fields value";
            }else{

                // $user       = $_SESSION['auth_user'];
                //insert data to database   
                foreach($list->getYearStudent($class_code) as $row){
                    $year = $row['year'];
                    $course_code = $row['course'];
                }
                foreach($list->getCourseStudent($course_code) as $row){
                    $course = $row['name_type'];
                }
                foreach($list->getCompanyAddress($company_id) as $row){
                    $company_name = $row['company_name'];
                }

                $adviser_id                  =$_SESSION['id_user'];

                if($list->AddStudent($adviser_id,$fname,$lname,$course,$class_code,$section,$year,$intern_type,$mobile_no,$email_add,$ojt_position,$ojt_dept,$ojt_start_date,$ojt_end_date,$company_id,$company_name,$supervisor_mobile_no,$supervisor_name,$supervisor_position,$supervisor_email_add,$supervisor_dept,$imagecontent)){
                    header('location:./');
                }else{
                    $err_msg = "Something went wrong. Please try again later";
                
                }
                $err_msg = $course;
            }
        }


    }

?>

<?php
    if (isset($err_msg) && !empty($err_msg)) {
        print('<script type="text/javascript">');
        print('alert("'.$err_msg.'");');
        print('document.location = "./addStudent.php"</script>');
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
                    <p class="h3">OJT Student form</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">

                        <!-- // <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-text">   -->
                        
                             <form method="POST" enctype="multipart/form-data" class="form-text">
                            <input type="hidden" name="type" value="add">

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="box-details-id">
                                        <h5>No Photo</h5>
                                       <input type='file' name='image' accept="image/*" required />
                                        </div>
                                    </div>
                                    <div class="col box-details">
                                        <h4>OJT</h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="control-label form-label">Start Date :</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="date" class="form-control" name="ojt_start_date" required>
                                            </div>
                                        </div>
                                        <div style="height:10px;"></div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="control-label form-label">End Date :</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="date" class="form-control" name="ojt_end_date" required>
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
                                                <input type="fname" name="fname" class="form-control" id="fname" placeholder="Enter First Name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lname">Last Name</label>
                                                <input type="lname" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" required>
                                            </div>
                                        </div>
                                      </div>      

                                        <label for="course">Year/Course</label>

                                        <select name="class_code" id="class_code" class="slt"> 
                                            <?php

                                                $query1=mysqli_query($conn,"SELECT * FROM `list_class`");

                                                while($row1=mysqli_fetch_array($query1)){

                                                $query2=mysqli_query($conn,"SELECT * FROM `types_courses` WHERE `name_code`='".$row1['course']."'");
                                                while($row2=mysqli_fetch_array($query2)){

                                                ?>
                                                <option value = "<?php echo($row1['id'])?>" >
                                                <?php echo($row1['year'].' | '.$row2['name_type']) ?>
                                                </option>                                                
                                                <?php
                                                }
                                                }
                                            ?>
                                        </select>
                                        <!-- <input type="course" name="course" class="form-control" id="course" placeholder="Enter course" required> -->

                                      <!-- <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <input type="section" name="section" class="form-control" id="section" placeholder="Enter Section" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <input type="year" name="year" class="form-control" id="year" placeholder="Enter year" required>
                                            </div>
                                        </div>
                                      </div> -->  

                                        <label for="section">Section</label>

                                        <select name="section" id="slt-section" class="slt" required> 
                                        <?php
                                            $query1=mysqli_query($conn,"SELECT * FROM `list_section`");

                                            while($row1=mysqli_fetch_array($query1)){
                                            ?>
                                            <option value = "<?php echo($row1['section'])?>" >
                                            <?php echo($row1['section']) ?>
                                            </option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                        <!-- <input type="section" name="section" class="form-control" id="section" placeholder="Enter Section" required> -->

                                        <label for="intern_type">Intern type</label>
                                        <input type="intern_type" name="intern_type" class="form-control" id="intern_type" placeholder="Enter Intern type required">

                                        <label for="mobile_no">Mobile no</label>
                                        <input type="mobile_no" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter mobile_no">

                                        <label for="email_add">Email Add</label>
                                        <input type="email_add" name="email_add" class="form-control" id="email_add" placeholder="Enter email_add">

                                        <label for="ojt_position">OJT position</label>
                                        <input type="ojt_position" name="ojt_position" class="form-control" id="ojt_position" placeholder="Enter OJT position" required>

                                        <label for="ojt_dept">OJT Department</label>
                                        <input type="ojt_dept" name="ojt_dept" class="form-control" id="ojt_dept" placeholder="Enter ojt_dept" required>


                                </div>
                                <div class="col">
                                    <div class="form-group">
<!--                                         <label for="company_id">Company ID</label>
                                        <input type="company_id" name="company_id" class="form-control" id="company_id" placeholder="Enter company_id"> -->
                                        <label for="company_id">Company name</label>  
                                        <select name="company_id" class="slt" required> 
                                            <?php
                                                $query1=mysqli_query($conn,"SELECT * FROM `list_offers`");

                                                while($row1=mysqli_fetch_array($query1)){
                                                ?>
                                                <option value = "<?php echo($row1['id'])?>" >
                                                <?php echo($row1['company_name']) ?>
                                                </option>
                                                <?php
                                                }
                                            ?>
                                        </select>

                                        <!-- <input type="company_name" name="company_name" class="form-control" id="company_name" placeholder="Enter company_name" required> -->
<!--                                         <label for="company_address">Company address</label>
                                        <input type="company_address" name="company_address" class="form-control" id="company_address" placeholder="Enter company_address"> -->
                                        <label for="supervisor_name">Supervisor name</label>
                                        <input type="supervisor_name" name="supervisor_name" class="form-control" id="supervisor_name" placeholder="Enter supervisor_name" required>
                                        <label for="supervisor_mobile_no">Mobile no</label>
                                        <input type="supervisor_mobile_no" name="supervisor_mobile_no" class="form-control" id="supervisor_mobile_no" placeholder="Enter Section">
                                        <label for="supervisor_position">Position</label>
                                        <input type="supervisor_position" name="supervisor_position" class="form-control" id="supervisor_position" placeholder="Enter supervisor_position">
                                        <label for="supervisor_email_add">Email address</label>
                                        <input type="supervisor_email_add" name="supervisor_email_add" class="form-control" id="supervisor_email_add" placeholder="email add Section">
                                        <label for="supervisor_dept">Department</label>
                                        <input type="supervisor_dept" name="supervisor_dept" class="form-control" id="supervisor_dept" placeholder="Enter Department">
                                    </div>                                
                                </div>
                              </div>
                            </div>

                            <div class="row" style="margin-top: 20px;margin-left: 10px;">
                                <div class="col-xs-6"><a class="btn btn-primary" href="./" data-toggle="modal" >Go Back</a></div>

                                <div class="col-xs-6"><button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button></div>
                            </div>

                        </form>   
                    </div>

                </div>

               
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    $("#class_code").change(function () {

    });

    function changeselect(){
        $('#slt-section').empty();
        var class_code =$('#class_code :selected').attr('value');
        // alert(class_code);

        var x = document.getElementById("slt-section");
        var option = document.createElement("option");
       

          <?php
            $data = "class_code";
            echo "alert(".$data.")";
            $query1=mysqli_query($conn,"SELECT * FROM `list_section` WHERE `class_id`='".$data."'");

            while($row1=mysqli_fetch_array($query1)){
                echo "option.text = '".$row1['section']."';";
                echo "option.value = '".$row1['section']."';";
            }
            ?>

        x.add(option);        

    }

</script>