<?php
    include("../db_config.php");

    $query = "SELECT * FROM list_requirements WHERE student_id = 1 AND remarks = 1";
    $query1 = mysqli_query($conn,$query);
    $row    = mysqli_fetch_all($query1);
    // var_dump($row);die;

    
    // Proceed if server request is post otherwise show default page.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
		include('../class/list.php');

    	if($_POST['type']=='moa' || $_POST['type']=='compdetails' || $_POST['type']=='accptform' || $_POST['type']=='emanual' || $_POST['type']=='eaf' || $_POST['type']=='facebookgroup' || $_POST['type']=='practicum' || $_POST['type']=='certcompletion' || $_POST['type']=='sftlogbook' || $_POST['type']=='resume' || $_POST['type']=='student_rating' || $_POST['type']=='dtr' || $_POST['type']=='final_essay' || $_POST['type']=='index_card'){

				$name=md5($_FILES['file']['name']);
				$size=$_FILES['file']['size'];
				$type=$_FILES['file']['type'];
				$temp=$_FILES['file']['tmp_name'];
				$date_created = date('Y-m-d');
                
				move_uploaded_file($temp,"../files/".$name);

                $code = $_POST['code'];
                $student_id = $_POST['student_id'];

                //insert data to database   
				if($list->UploadMoa($student_id,$code,$name,$date_created)){
                    $err_msg = "Upload File Success";
                    // header('location:./');          
                }else{
                    $err_msg = "Something went wrong. Please check fields value";                    
                }
    	}


    }

?>

<?php
    if (isset($err_msg) && !empty($err_msg)) {
        print('<script type="text/javascript">');
        print('alert("'.$err_msg.'");');
        print('document.location = "./"</script>');
    }
?>
<!-- Add Moa-->
    <div class="modal fade" id="moa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Memorandum of Agreement</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :
                            
                                <?php 
                                
                                    foreach($row as $rows){
                                        if(!in_array("moa",$rows)){
                                        // var_dump($rows);
                                        echo $rows[3];    
                                }

                            }
                                                                                       
                                ?>
                            
                            
                            
                            </label>
                            

                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="moa">
                <input type="hidden" name="code" value="moa">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>        
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>


<!-- Add compdetails-->
    <div class="modal fade" id="compdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Company Details</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="compdetails">
                <input type="hidden" name="code" value="compdetails">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>
    
<!-- Add accptform-->
    <div class="modal fade" id="accptform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Acceptance Form</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="accptform">
                <input type="hidden" name="code" value="accptform">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a>
                    </div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="emanual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">E-Manual</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="emanual">
                <input type="hidden" name="code" value="emanual">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="eaf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">EAF</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="eaf">
                <input type="hidden" name="code" value="eaf">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="facebookgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">facebook group</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="facebookgroup">
                <input type="hidden" name="code" value="facebookgroup">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="practicum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Practicum Orientation</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="practicum">
                <input type="hidden" name="code" value="practicum">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a>
                    </div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="certcompletion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">certcompletion</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="certcompletion">
                <input type="hidden" name="code" value="certcompletion">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="sftlogbook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">sftlogbook</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="sftlogbook">
                <input type="hidden" name="code" value="sftlogbook">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="resume" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">resume</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="resume">
                <input type="hidden" name="code" value="resume">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="student_rating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Student Rating</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="student_rating">
                <input type="hidden" name="code" value="student_rating">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="dtr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Date Time Record</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="dtr">
                <input type="hidden" name="code" value="dtr">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="final_essay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Final Essay</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="final_essay">
                <input type="hidden" name="code" value="final_essay">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>

<!-- Add emanual-->
    <div class="modal fade" id="index_card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Index Card</h4></center>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <form enctype="multipart/form-data" method="POST" action="./function.php">
                    <div style="height:10px;"></div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="form-label">File :</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" name="file" id="file"  required="required">
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div> 
                </div>
                <input type="hidden" name="type" value="index_card">
                <input type="hidden" name="code" value="index_card">
                <input type="hidden" name="student_id" value="<?php echo $_GET['id']; ?>">
                <div class="modal-footer">
                    <div class="row">
                    <div class="col-xs-5"><button type="submit" class="btn btn-success">Upload</button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-danger"  data-dismiss="modal" >Cancel</a></div>  
                    </div>
                    </a>
                </form>
                </div>
            </div>
        </div>
    </div>
