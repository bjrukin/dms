<div class="content-wrapper">

	<section class="content">

		<div class="col-md-4">
			
			<div class="box">

				<div class="box-header">
					<h3>Upload Master Price List</h3>
				</div>

				<div class="box-body">
					<?php echo form_open_multipart("admin/spareparts/uploading_file_select"); ?>
					File (10 MB Max)

					<input type="file" name="userfile" class="form-control">
					<button class="btn btn-primary">Submit</button>
					<?php echo form_close(); ?>

				</div>
			</div>
		</div>
	</section>
</div>