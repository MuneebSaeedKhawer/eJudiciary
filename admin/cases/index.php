<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_case" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered table-compact" id="list">
				<colgroup>
					<col width="10%">
					<col width="20%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Case Title</th>
						<th>Case Date</th>
						<th>Case Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM `cases` order by `id` asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><?php echo ucfirst($row['title']) ?></td>
						<td><?php echo $row['date'] ?></td>
						<td><?php echo ucfirst($row['case_status']) ?></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat btn-sm manage_case">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-sm btn-flat delete_case" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>

	$(document).ready(function(){
		$('.new_case').click(function(){
			location.href = _base_url_+"admin/?page=cases/manage";
		})
		$('.manage_case').click(function(){
			location.href = _base_url_+"admin/?page=cases/manage&id="+$(this).attr('data-id')
		})
		$('.delete_case').click(function(){
		_conf("Are you sure to delete this case?","delete_case",[$(this).attr('data-id')])
		})
		$('#list').dataTable()
	})
	function delete_case($id){
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Content.php?f=case_delete',
			method:'POST',
			data:{id:$id},
			dataType:'json',
			success:function(resp){
				if(resp.status == 'success'){
					location.reload()
				}else{
					alert_toast(resp.err_msg,'error')
				}
				end_loader();
			}
		})
	}
</script>