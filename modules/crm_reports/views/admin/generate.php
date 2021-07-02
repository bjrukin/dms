<style type="text/css">
    #data-table{
        width:100%;
        border-collapse:collapse;
        table-layout:fixed; 
    }
    #data-table th, #data-table td{
        text-align: center;
        vertical-align: middle;
    }
    #data-table td:first-child {
        width: 300px!important;
        font-size: 105%
    }
    .box.box-solid>.box-header .btn:hover, .box.box-solid>.box-header a:hover {
        background-color: #367fa9;
    }
    .report-cell {min-width: 100px;max-width: 350px}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('crm_reports'); ?><small><?php echo $report_type; ?></small></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li><a href="<?php echo site_url('admin/crm-reports');?>"><?php echo lang('crm_reports');?></a></li>
	        <li class="active"><?php echo $report_type; ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
        				<?php echo form_open('', array('id' =>'form-crm_reports_generate')); ?>
                        <input type="hidden" id="report_criteria" name="report_criteria" value="<?php echo $type;?>" />
                        <input type="hidden" id="export" name="export" />
        					<table class="table table-responsive table-striped">
        						<tr>
                                    <td><label for='group_criteria'>Parameter 1</label></td>
                                    <td><div id='group_criteria' name='group_criteria'></div></td>	
                                    <?php if ($show == true) :?>
                                    <td><label for='group_criteria'>Parameter 2</label></td>
                                    <td><div id='column_name' name='column_name'></div></td>  
                                    <?php endif;?>
                                    <td><label for='date_range'>Date Range</label></td>
                                    <td><div id='date_range' class="date_box" name='date_range'></div></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                                        <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonExcelExport"><?php echo lang('general_export_excel'); ?></button>
                                    </td>
        					   </tr>
        				    </table>
                		<?php echo form_close(); ?>
                        <br />
                        <div id ="report-table" style="overflow-x:scroll;overflow-y: hidden;"></div>
                    </div>
                </div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">
$(function(){

	$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true });
	$('#date_range').jqxDateTimeInput('setRange', null, null);
    
    //group_criteriass
    var group_criteriasDataSource = {
        url : '<?php echo site_url("admin/crm_reports/get_grouping_criteria_json"); ?>',
        datatype: 'json',
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'value', type: 'string' },
        ],
        data: { 'key' : '<?php echo $type;?>'},
        async: true,
        cache: true
    }

    group_criteriasDataAdapter = new $.jqx.dataAdapter(group_criteriasDataSource, {autoBind: false});

    $("#group_criteria").jqxComboBox({
        theme: theme,
        width: 200,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: group_criteriasDataAdapter,
        displayMember: "name",
        valueMember: "value",
        selectedIndex: 0
    });

    <?php if ($show==true): ?>
    group_criteriasDataSource.data = { 'key' : '<?php echo $type;?>', 'exclude' : 'inquiry_monthly'};
    group_criteriasDataAdapter = new $.jqx.dataAdapter(group_criteriasDataSource, {autoBind: false});

     $("#column_name").jqxComboBox({
        theme: theme,
        width: 200,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: group_criteriasDataAdapter,
        displayMember: "name",
        valueMember: "value",
        selectedIndex: 0
    });
    <?php endif;?>
     

    $("#jqxResetButton").on('click', function () {
        reset_form_crm_reports_generate();
    });

    $("#jqxSubmitButton").on('click', function () {
        generateReport();
    });

    $("#jqxButtonExcelExport").on('click', function () {
        exportExcel();
    });
});

function reset_form_crm_reports_generate() {
    $('#group_criteria').jqxComboBox('selectIndex', 0);
	$('#date_range').jqxDateTimeInput('setRange', null, null);
}

function generateReport() {
    $('#export').val('');
    var data = $("#form-crm_reports_generate").serialize();

	$('.content-wrapper').block({ 
        message: '<span>Processing your request. Please be patient.</span>',
        css: { 
            width                   : '75%',
            border                  : 'none', 
            padding                 : '50px', 
            backgroundColor         : '#000', 
            '-webkit-border-radius' : '10px', 
            '-moz-border-radius'    : '10px', 
            opacity                 : .7, 
            color                   : '#fff',
            cursor                  : 'wait' 
        }, 
    });

    $.ajax({
        type: "POST",
        url: '<?php echo site_url("admin/crm-reports/get_report_json"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success && result.total > 1) {
                $('#report-table').html("<table class='table table-bordered table-condensed table-striped dataTable' style='table-layout:auto;width:150%' id='data-table'></table>");
            	buildHtmlTable(result.data,'data-table',true);
                $('#reports').show();
            } else {
                $('#reports').hide();
            	alert('No Records for generating Reports');
            }
            $('.content-wrapper').unblock();
        }
    });
}

function exportExcel() {
    $('#export').val('export');

    $("#form-crm_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export"); ?>');
    $("#form-crm_reports_generate").attr('target', '_blank');
    $("#form-crm_reports_generate").submit();

}
</script>