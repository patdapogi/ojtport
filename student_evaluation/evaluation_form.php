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

    include('../class/list.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
        if($_POST['type']=='add'){
            // Get post values.


                $student_id              = $_POST['student_id'];
                $name                    = $_POST['name'];
                $course                  = $_POST['course'];
                $data = array();

            if(empty($_POST)) {
                $err_msg = "Something went wrong. Please check fields value";
            }else{
                if($_POST['category0']){

                    $category = $_POST['category0'];
                    $remarks = $_POST['remarks0'];
                    $category_id = $_POST['category_id0'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category1']) {

                    $category = $_POST['category1'];
                    $remarks = $_POST['remarks1'];
                    $category_id = $_POST['category_id1'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category2']) {

                    $category = $_POST['category2'];
                    $remarks = $_POST['remarks2'];
                    $category_id = $_POST['category_id2'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category3']) {

                    $category = $_POST['category3'];
                    $remarks = $_POST['remarks3'];
                    $category_id = $_POST['category_id3'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category4']) {

                    $category = $_POST['category4'];
                    $remarks = $_POST['remarks4'];
                    $category_id = $_POST['category_id4'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category5']) {

                    $category = $_POST['category5'];
                    $remarks = $_POST['remarks5'];
                    $category_id = $_POST['category_id5'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category6']) {

                    $category = $_POST['category6'];
                    $remarks = $_POST['remarks6'];
                    $category_id = $_POST['category_id6'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

                }

                if ($_POST['category7']) {

                    $category = $_POST['category7'];
                    $remarks = $_POST['remarks7'];
                    $category_id = $_POST['category_id7'];
                    $list->AddEvaluation($student_id,$name,$course,$category_id,$category,$remarks);

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
        // print('document.location = "./evaluation_form.php?id=1"</script>');
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
                    <p class="h3">Evaluation Form</p>
                </div>
                <div class="row" style="margin-top:16px">
                    <div class="container">
                        <p><strong>Student name :</strong>
                        <?php
                        foreach($list->getStudentName($_GET['id']) as $row){
                            $student_name = $row['fname'].' '.$row['lname'];
                        }
                        echo $student_name;
                        ?>

                        </p>  
                            <form method="POST" lass="form-text">
                            <input type="hidden" name="type" value="add">

                            <?php
                            foreach($list->getStudentName($_GET['id']) as $row){
                                $student_id   = $row['id'];
                                $student_name = $row['fname'].' '.$row['lname'];
                                $course       = $row['course'];
                            ?>
                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                            <input type="hidden" name="name" value="<?php echo $student_name; ?>">
                            <input type="hidden" name="course" value="<?php echo $course; ?>">
                            <?php
                            }
                            ?>


                            <div class="container">
                              <div class="row">
                    <?php
                        $menu_items = array(
                        array(0,'Does the content adequately cover requirements?'),
                        array(1,'Are topics/concepts presented in sufficient details'),
                        array(2,'Does the sequencing of topics in the text match that of the syllabus?'),
                        array(3,'Do exercises and activities help to reinforce skills and attitudes taught?'),
                        array(4,'Do exercises and activities help to extend and evaluate knowledge'),
                        array(5,'Are there sufficient pratices exercises, activities and evaluation assignments'),
                        array(6,'The questions make connections between the learned content, allow the reader to reflect on main ideas and extend critical thinking about the past and future events'),
                        array(7,'Questions are multi-leveledm i.e. there are questions that the reader can answer by looking in a specific place in the text, some that require the reader to look in several places to find the answer, and others that require the reader to look for clues in what they have read and combine these with their prior knowledge')
                        );                    
                    ?>

                <table class="table table-striped table-bordered table-hover tbl-list">
                    <thead>
                        <th>Category</th>
                       <th>Performance</th>
                    </thead>
                    <tbody>
                    <?php
                        $i =0;
                       
                        foreach ($menu_items as $item) {

                            $category_id = $item[0];
                            $category    = $item[1];
                    ?>
                            <tr>
                                <td>
                                <input type="hidden" name="category_id<?php echo $i; ?>" value="<?php echo $category_id; ?>">
                                <input type="text" class="form-control" name="category<?php echo $i; ?>" value="<?php echo $category; ?>" readonly>
                                </td>
                                <td>                                 
                                <select name="remarks<?php echo $i; ?>" id="remarks" class="slt" required> 
                                    <option value="Present">Select</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    
                    ?>
                    </tbody>
                </table>  
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


</script>