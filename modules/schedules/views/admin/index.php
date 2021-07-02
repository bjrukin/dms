<style type="text/css">
	table.form-table td:nth-child(odd){
		width:13%;
	}
	table.form-table td:nth-child(even){
		width:20%;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('schedules'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li class="active"><?php echo lang('menu_schedules'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				 <div id="scheduler"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->



<script language="javascript" type="text/javascript">

$(function(){

	var dataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },
			{ name: 'customer_id', type: 'number' },
			{ name: 'executive_id', type: 'number' },
			{ name: 'status_id', type: 'number' },
			{ name: 'followup_date_en', type: 'date' },
			{ name: 'followup_date_np', type: 'string' },
			{ name: 'followup_mode', type: 'string' },
			{ name: 'followup_status', type: 'string' },
			{ name: 'followup_notes', type: 'string' },
			{ name: 'next_followup', type: 'bool' },
			{ name: 'next_followup_date_en', type: 'date' },
			{ name: 'next_followup_date_np', type: 'string' },
			{ name: 'status_name', type: 'string'},
			{ name: 'executive_name', type: 'string'},
			
        ],
		url: '<?php echo site_url("admin/schedules/json"); ?>',
	},

	dataAdapter = new $.jqx.dataAdapter(dataSource);

	$("#scheduler").jqxScheduler({
		theme: theme,
        //date: new $.jqx.date(2016, 11, 23),
        width: '100%',
        height: gridHeight,
        source: dataAdapter,
        showLegend: true,
        ready: function () {
       
        },
        appointmentDataFields:
        {
            from: "followup_date_en",
            to: "followup_date_en",
            id: "id",
            description: "about",
            location: "address",
            subject: "name",
            style: "style",
            status: "status"
        },
        view: 'monthView',
        views:
        [
            'dayView',
            'weekView',
            'monthView'
        ]
    });
});
</script>