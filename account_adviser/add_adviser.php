<!-- Add New -->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Add Adviser Account</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnew.php">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">First Name :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="fname">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Last Name :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="lname">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Department :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="dept">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Subject :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="subj">
						</div>
					</div>
					<!-- <div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Username :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control" name="username">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label form-label">Password :</label>
						</div>
						<div class="col-lg-8">
							<input type="password" class="form-control" name="password">
						</div>
					</div> -->
					<div style="height:10px;"></div>
                </div> 
				</div>

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
