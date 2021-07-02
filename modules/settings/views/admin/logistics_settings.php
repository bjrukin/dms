<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('settings'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('settings'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<div class="box">
					<div class="box-body">
						<?php foreach ($rows as $key => $value) {?>
							<div class="col-xs-3">
								<label>
									<input class="option" type="checkbox" name="<?php echo $value->key?>" value="<?php echo $value->id?>" <?php echo ($value->value != '0')?'checked':'';?> >
									<?php echo $value->key?>
								</label>
							</div>
						<?php }?>
					</div>
				</div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

	$('.option').click(function(){
		var value = 0;
		var id = $(this).val();
		var checked = $(this).is(':checked');
		
		if(checked){
			value = 1;
		}
		$.post('<?php echo site_url('admin/settings/custom_save')?>',{id:id, value:value},function(result){
			if(!result.success){
				alert(result.msg);
			}
		},'json');
	});

</script>