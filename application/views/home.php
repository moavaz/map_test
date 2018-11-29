<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('layouts/common_css'); ?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-4">
				<h1>
					maps and people
					<!-- HTML -->
					
				</h1>
			</div>
			<div class="col-md-6">
				<h1>
					<button type="button" id="ct-btn" class="btn btn-sm btn-primary" data-toggle="modal">Add new customer</button>
				</h1>
			</div>					
		</div>
		<div id="chartdiv"></div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel">Add customer</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="ct-form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
						<div class="form-group">
							<label for="ct_name">Customer Name</label>
							<input type="text" class="form-control" id="ct_name" aria-describedby="emailHelp" placeholder="Enter customer name"
							name="ct_name" required>
						</div>
						<div class="form-group">
							<label for="ct_monthly">Monthly charges</label>
							<input type="text" class="form-control" id="ct_monthly" aria-describedby="emailHelp" placeholder="Enter customer monthly charges" name="ct_monthly" required>
						</div><div class="form-group">
							<label for="ct_sms">Sms charges</label>
							<input type="text" class="form-control" id="ct_sms" aria-describedby="emailHelp" placeholder="Enter customer sms charges" name="ct_sms" required>
						</div><div class="form-group">
							<label for="ct_server">Server charges</label>
							<input type="text" class="form-control" id="ct_server" aria-describedby="emailHelp" placeholder="Enter customer server charges" name="ct_server" required>
						</div>
						<div class="form-group">
							<label for="name">
							Customer Picture</label>
							<input type="file"  id="image" name="ct_image"  required >
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('layouts/common_js'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#ct-btn').click(function(){
    $('#ct-form')[0].reset(); // reset form on modals
    $('#exampleModal').modal('show');
    $('#ct-form').attr('action', '<?php echo base_url();?>HomeController/createCustomer');
});
		});
	</script>
</body>
</html>