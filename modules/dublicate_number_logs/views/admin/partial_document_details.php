<div class="col-md-12">
	<fieldset>
		<legend>Document Information</legend>
				<!-- <div class="row">
					<div class="col-md-4"><img src="<?php echo base_url('uploads/bookingdocument/thumb/'.$file['uploadeddocument']) ?>"></div>
					
				</div> -->

				<?php if($file['uploadeddocument']): ?>
					<?php				 
						if (@exif_imagetype(base_url('uploads/bookingdocument/'.$file['uploadeddocument'])) == IMAGETYPE_GIF ||@exif_imagetype(base_url('uploads/bookingdocument/'.$file['uploadeddocument'])) == IMAGETYPE_JPEG || @exif_imagetype(base_url('uploads/bookingdocument/'.$file['uploadeddocument'])) == IMAGETYPE_PNG ) :?>
							<button id="zoom-in-img">Zoom In</button>
							<button id="zoom-out-img">Zoom out</button>
							<div id="print_div">
								<img src="<?php echo base_url('uploads/bookingdocument/'.$file['uploadeddocument']) ?>">
							</div>
							<input type="hidden" name="id" id="print_doc_id" value="<?php echo $id; ?>">
							<span class="pull-right">
								<button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print" onclick="printDiv('print_div')"><span <i="" class="fa fa-file-pdf-o"></span></button>
							</span>
					<?php else: ?>

						<a href="<?php echo base_url('uploads/bookingdocument/'.$file['uploadeddocument']) ?>" class="btn btn-lg btn-primary" target="blank"><span class="glyphicon glyphicon-cloud-download" download></span> Download File</a>
					<?php endif;?>
				<?php else: ?>
					<h4>No Document Uploaded</h4>
				<?php endif; ?>
				
		
		</table>
	</fieldset>
</div>

<style>
 #print_div{
 	overflow: hidden;
 }
</style>
<script type="text/javascript">
	var wClick = 1;
	var Max = 2;
	var Min = 0.5;

	function printDiv(divName) {
		var id = $('#print_doc_id').val();
        window.open('<?php echo site_url("dublicate_number_logs/print_docs")?>/'+id, '_blank');
	}

	$(document).on('click','#zoom-in-img',function(){
		if(Max != wClick){
	        wClick = wClick + 0.2;
			$('#print_div img').css({
	           	 'transform'         : 'scale(' + wClick + ')'
	        });
			
		}

	});
	$(document).on('click','#zoom-out-img',function(){
		if(Min != wClick){
	        wClick = wClick - 0.2;
			$('#print_div img').css({
	           	 'transform'         : 'scale(' + wClick + ')'
	        });
			
		}

	})		
</script>
<!-- ./Customer Basic Information -->
