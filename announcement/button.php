


<!-- Delete -->
    <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Delete Announcement</h4></center>
                </div>
                <div class="modal-body">
				<?php

					$del=mysqli_query($conn,"select * from list_announcement where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Title: <strong><?php echo $drow['title']; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">Edit Announcement</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"select * from list_announcement where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>">
					<div class="row">
						<div class="col-lg-3">
							<label class="form-label">Title :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="title" class="form-control" value="<?php echo $erow['title']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label class="form-label">Details :</label>
						</div>
						<div class="col-lg-8">
							<!-- <input type="text" name="details" class="form-control" value="<?php echo $erow['details']; ?>"> -->							
							<textarea rows="4" cols="100" name="details" class="form-control" >
								<?php echo $erow['details']; ?>
							</textarea>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Event Date:</label>
						</div>
						<div class="col-lg-6">
							<input type="date" name="event_date" class="form-control" value="<?php echo $erow['event_date']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Event Expiration Date:</label>
						</div>
						<div class="col-lg-6">
							<input type="date" name="exp_event_date" class="form-control" value="<?php echo $erow['exp_event_date']; ?>">
						</div>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
				</form>
            </div>
        </div>
	</div>

<!-- View -->

	<div class="modal fade" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <center><h4 class="modal-title" id="myModalLabel">View Announcement</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"select * from list_announcement where id='".$row['id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="edit.php?id=<?php echo $erow['id']; ?>">
					<div class="row">
						<div class="col-lg-3">
							<label class="form-label">Title :</label>
						</div>
						<div class="col-lg-8">
							<input type="text" name="title" disabled="true" class="form-control" value="<?php echo $erow['title']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label class="form-label">Details :</label>
						</div>
						<div class="col-md-10">				
							<textarea rows="4" disabled="true"  name="details" class="form-control" >
								<?= $erow['details']; ?>
							</textarea>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Event Date:</label>
						</div>
						<div class="col-sm-5">
							<input type="date" disabled="true" name="event_date" class="form-control" value="<?= $erow['event_date']; ?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-5">
							<label class="form-label">Event Expiration Date:</label>
						</div>
						<div class="col-sm-5">
							<input type="date" name="exp_event_date" disabled="true" class="form-control" value="<?= $erow['exp_event_date']; ?>">
						</div>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
                </div>
				</form>
            </div>
        </div>
    </div>







<!-- /.modal -->