<div class="col-md-12">
	<fieldset>
		<legend>Document Information</legend>
		<div class="row">
			<div class="col-md-4">
				<?php if($file['uploadeddocument']): ?>
					<?php				 
						if (@exif_imagetype(base_url('uploads/bookingdocument/'.$file['uploadeddocument'])) == IMAGETYPE_GIF ||@exif_imagetype(base_url('uploads/bookingdocument/'.$file['uploadeddocument'])) == IMAGETYPE_JPEG || @exif_imagetype(base_url('uploads/bookingdocument/'.$file['uploadeddocument'])) == IMAGETYPE_PNG ) :?>
							<img src="<?php echo base_url('uploads/bookingdocument/'.$file['uploadeddocument']) ?>"> 
					<?php else: ?>

						<a href="<?php echo base_url('uploads/bookingdocument/'.$file['uploadeddocument']) ?>" class="btn btn-lg btn-primary" target="blank"><span class="glyphicon glyphicon-cloud-download" download></span> Download File</a>
					<?php endif;?>
				<?php else: ?>
					<h4>No Document Uploaded</h4>
				<?php endif; ?>
			</div>					
		</div>
	</fieldset>
</div>