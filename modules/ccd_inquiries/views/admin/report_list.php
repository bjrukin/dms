<style type="text/css">
	.master-menu-box{
		width: 160px;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('ccd_report'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
			<li class="active"><?php echo lang('ccd_report'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-md-12 col-sm-6 col-xs-12">
	            <div class="box box-solid">
	                <div class="box-body">
	                    <table class="table table-responsive table-striped">
	                      	<tr>
		                        <td><label for='date_range'>Start Date</label></td>
		                        <td><div id='start_date' class="date_box"></div></td>
		                        <td><label for='date_range'>End Date</label></td>
		                        <td><div id='end_date' class="date_box"></div></td> 
	                    	</tr>
	                	</table>
	                	<br />                
	            	</div>
	        	</div>
	        </div>
			<div class="col-xs-12 connectedSortable">
				<div class="box box-solid">
					<div class="box-body" style="line-height:200%">
						<ul style="list">
							<li><a href='#' id="walkin" class="export_link" val="ccd_inquiries/report_export_walkin">CCD Inquiry(Walk In) </li>
							<li><a href='#' id="generated" class="export_link" val="ccd_inquiries/report_export_generated">CCD Inquiry(Generated) </li>
							<li><a href='#' id="three_days" class="export_link" val="ccd_threedays/report_export">CCD Retail Three Days </li>
							<li><a href='#' id="thirty_days" class="export_link" val="ccd_thirtydays/report_export">CCD Retail Thirty Days </li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">
	var start_date = "";
	var end_date = "";
	$(function()
    {
        $("#start_date").jqxDateTimeInput({ formatString: "yyyy-MM-dd" });
        $("#end_date").jqxDateTimeInput({ formatString: "yyyy-MM-dd" });
    })

	$('#start_date').change(function(){
		start_date = $(this).val();
	});

	$('#end_date').change(function(){
		end_date = $(this).val();
	});

    $('.export_link').click(function(){
    	var link = '<?php echo site_url()?>' + $(this).attr("val") + '?';

    	if(start_date){
    		link += 'start_date='+start_date;
    	}
    	if(end_date){
    		link += '&end_date='+end_date;
    	}
    	// alert(link);
    	window.open(link, '_blank');

    });
</script>

<!-- <script type="text/javascript">
	$(function()
    {
        $("#start_date").jqxDateTimeInput({ formatString: "yyyy-MM-dd" });
        $("#end_date").jqxDateTimeInput({ formatString: "yyyy-MM-dd" });
    })
    $('#start_date').change(function()
    {
        var walkin = '';
        var generated = '';
        var three_days = '';
        var thirty_days = '';

        var start_date = $(this).val();

        walkin = $('#walkin').attr('href');
        $("#walkin").attr("href", walkin+'/'+start_date);

        generated = $('#generated').attr('href');
        $("#generated").attr("href", generated+'/'+start_date);

        three_days = $('#three_days').attr('href');
        $("#three_days").attr("href", three_days+'/'+start_date);

        thirty_days = $('#thirty_days').attr('href');
        $("#thirty_days").attr("href", thirty_days+'/'+start_date);

    });
    $('#end_date').change(function()
    {
        var walkin = '';
        var generated = '';
        var three_days = '';
        var thirty_days = '';

        var end_date = $(this).val();

        walkin = $('#walkin').attr('href');
        $("#walkin").attr("href", walkin+'/'+end_date);

        generated = $('#generated').attr('href');
        $("#generated").attr("href", generated+'/'+end_date);

        three_days = $('#three_days').attr('href');
        $("#three_days").attr("href", three_days+'/'+end_date);

        thirty_days = $('#thirty_days').attr('href');
        $("#thirty_days").attr("href", thirty_days+'/'+end_date);
    });
</script> -->
