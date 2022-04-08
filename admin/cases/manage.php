<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * from `cases` where id = '{$_GET['id']}' ");
	foreach($qry->fetch_array() as $k => $v){
		if(!is_numeric($k)){
			$$k = $v;
		}
	}
}
?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<h5 class="card-title"><?php echo isset($id) ? "Manage": "Create" ?> Case</h5>
		</div>
		<div class="card-body">
			<form id="case">
				<div class="row" class="details">
					<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="title" class="control-label">Title</label>
							<input name="title" class="form-control" value="<?php echo isset($title) ? $title : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="date" class="control-label">Date</label>
							<input name="date" class="form-control datepicker" autocomplete="off" value="<?php echo isset($date) ? $date : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="previous_date" class="control-label">Previous Date</label>
							<input name="previous_date" class="form-control datepicker" autocomplete="off" value="<?php echo isset($previous_date) ? $previous_date : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="next_date" class="control-label">Next Date</label>
							<input name="next_date" class="form-control datepicker" autocomplete="off" value="<?php echo isset($next_date) ? $next_date : '' ?>" />
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="institution" class="control-label">Institution</label>
							<input name="institution" class="form-control" value="<?php echo isset($institution) ? $institution : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="category" class="control-label">Category</label>
							<input name="category" class="form-control" value="<?php echo isset($category) ? $category : '' ?>" />
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="court_name" class="control-label">Court Name</label>
							<input name="court_name" class="form-control" value="<?php echo isset($court_name) ? $court_name : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="judge_name" class="control-label">Judge Name</label>
							<input name="judge_name" class="form-control" value="<?php echo isset($judge_name) ? $judge_name : '' ?>" />
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="case_number" class="control-label">Case Number</label>
							<input name="case_number" class="form-control" value="<?php echo isset($case_number) ? $case_number : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="plaintiff" class="control-label">Plaintiff</label>
							<input name="plaintiff" class="form-control" value="<?php echo isset($plaintiff) ? $plaintiff : '' ?>" />
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="respondant" class="control-label">Respondant</label>
							<input name="respondant" class="form-control" value="<?php echo isset($respondant) ? $respondant : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="details" class="control-label">Details</label>
							<input name="details" class="form-control" value="<?php echo isset($details) ? $details : '' ?>" />
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="current_stage" class="control-label">Current Stage</label>
							<input name="current_stage" class="form-control" value="<?php echo isset($current_stage) ? $current_stage : '' ?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="case_status" class="control-label">Case Status</label>
							<?php $selected = "filing"; if(isset($case_status)){
								$selected = $case_status;
							}?>
							<select name="case_status" class="form-control">
								<option value="filing" <?php if($selected == 'filing') { echo 'selected="selected"'; } ?>>Filing</option>
								<option value="hearing" <?php if($selected == 'hearing') { echo 'selected="selected"'; } ?>>Hearing</option>
								<option value="argument" <?php if($selected == 'argument') { echo 'selected="selected"'; } ?>>Argument</option>
								<option value="due" <?php if($selected == 'due') { echo 'selected="selected"'; } ?>>Due</option>
								<option value="closed" <?php if($selected == 'closed') { echo 'selected="selected"'; } ?>>Closed</option>
							</select>
						</div>
					</div>

				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary btn-sm" form="case"><?php echo isset($_GET['id']) ? "Update": "Save" ?></button>
			<a class="btn btn-primary btn-sm" href="./?page=cases">Cancel</a>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 30vh;
		width: 100%;
		object-fit:scale-down;
		object-position:center center;
	}
</style>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
<script>
function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).ready(function(){
		$('.select')
		$('#case').submit(function(e){
			e.preventDefault();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Content.php?f=case",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err=>{
					alert_toast("An error occured",'error')
					console.log(err);
					end_loader();
				},
				success:function(resp){
					if(resp != undefined){
						if(resp.status == 'success'){
							location.href=_base_url_+"admin/?page=cases";
						}else{
							alert_toast("An error occured",'error')
							console.log(resp);
						}
						end_loader();
					}
				}
			})
		})
		$('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'link','undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
	
</script>