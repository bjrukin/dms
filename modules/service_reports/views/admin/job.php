<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('jobcard'); ?>
			<!-- <small>Control panel</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			
			<li class="active"><?php echo lang('jobcard'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header" style="cursor: move;">
					<!-- <i class="fa fa-wrench"></i> -->
					<h3 class="box-title">Job Card Details</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-flat btn-link btn-sx pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"> <i class="fa fa-minus"></i> </button>
					</div>
				</div>
				<form method="post" action="<?php echo site_url('admin/job_cards/excel_dump')?>">
					<div class="box-body" style="line-height:200%">
							<label><?php echo lang("date_range"); ?></label>
									<!-- <div   class='date_box' id="date_wise" name="date_wise"></div> -->
									<td><div id='date_wise' name='date_wise'></div></td>
								
									
						
					</div>
				
				<div class="box-footer clearfix">
					<button type="submit" class="pull-left btn btn-default" >Excel <i class="fa fa-file-excel-o"></i> </button>
				</div>
				</form>
			</div>
		</div>
		
	

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
	$(function(){
		$("#date_wise").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true, formatString: "yyyy-MM-dd" });
		$('#date_wise').jqxDateTimeInput('setRange', null, null);
	})
</script>