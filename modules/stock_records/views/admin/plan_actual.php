
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui.min.js');?>"></script>

<!-- PivotTable.js libs from ../dist -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/pivot/pivot.css');?>">
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/pivot.js');?>"></script>

<style type="text/css">
    .data-table{
        width:100%;
        border-collapse:collapse;
        table-layout:fixed; 
    }
    .data-table th, .data-table td{
        text-align: center;
        vertical-align: middle;
        font-weight: normal!important;       
    }
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
        					<table class="table">
        						<tr>
                                    <td><label for='date_range'>Date Range</label></td>
                                    <td><div id='date_range' class="date_box" name='date_range'></div></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                                        <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonCopyToClipboard"><?php echo lang('general_copy_clipboard'); ?></button>
                                    </td>
        					   </tr>
        				    </table>
                		<?php echo form_close(); ?>
                    </div>
                </div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
        <div class="row" id='report-table-box' style="display:none">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div id ="report-table"></div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">
//google.load("visualization", "1", {packages:["corechart", "charteditor"]});
$(function(){
	$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true });
	$('#date_range').jqxDateTimeInput('setRange', null, null);
    $('#jqxButtonCopyToClipboard').hide();
    
    $("#jqxSubmitButton").on('click', function () {
        generateReport();
    });

    $("#jqxButtonCopyToClipboard").on('click', function() {

        // creating new textarea element and giveing it id 't'
        var t = document.createElement('textarea')
        t.id = 't'
        // Optional step to make less noise in the page, if any!
        t.style.height = 0
        // You have to append it to your page somewhere, I chose <body>
        document.body.appendChild(t)
        // Copy whatever is in your div to our new textarea
        t.value = $('.data-table').parent().html();
        // Now copy whatever inside the textarea to clipboard
        var selector = document.querySelector('#t')
        selector.select()
        document.execCommand('copy')
        // Remove the textarea
        document.body.removeChild(t);
      });
    // });
});

function reset_form_crm_reports_generate() {
    $('#group_criteria').jqxComboBox('selectIndex', 0);
	$('#date_range').jqxDateTimeInput('setRange', null, null);
}

function generateReport() {
    $('#export').val('');
    var data = $("#form-crm_reports_generate").serialize();

	// $('.content-wrapper').block({ 
 //        message: '<span>Processing your request. Please be patient.</span>',
 //        css: { 
 //            width                   : '75%',
 //            border                  : 'none', 
 //            padding                 : '50px', 
 //            backgroundColor         : '#000', 
 //            '-webkit-border-radius' : '10px', 
 //            '-moz-border-radius'    : '10px', 
 //            opacity                 : .7, 
 //            color                   : '#fff',
 //            cursor                  : 'wait' 
 //        }, 
 //    });

    $.ajax({
        type: "POST",
        url: '<?php echo site_url("admin/stock_records/get_daily_report"); ?>',
        data: data,
        success: function (result) {
            console.log(result);
            var result = eval('('+result+')');
            if (result.success && result.total >= 1) {
                 $("#report-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",
                    rows: ["<?php echo ($default_row != '') ? $default_row: 'Month (BS)';?>"],
                    cols: ["<?php echo $default_col;?>"],
                });
                $('#report-table-box').show();
                $('#jqxButtonCopyToClipboard').show();
            } else {
                $('#report-table-box').hide();
                $('#jqxButtonCopyToClipboard').hide();
            	alert('No Records for generating Reports');
            }
            //$('.content-wrapper').unblock();
        }
    });
}

function exportExcel() {
    $('#export').val('export');

    $("#form-crm_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export"); ?>');
    $("#form-crm_reports_generate").attr('target', '_blank');
    $("#form-crm_reports_generate").submit();

}

// $('#report-table').on('click', 'li span.pvtAttr .pvtTriangle', function() {
//     var elemOffset = $(this).offset();
//     var elemTop = elemOffset.top;
//     var winHeight = $(window).height();
//     var heightBaki = winHeight - elemTop - 331;
//     if(heightBaki < 0) { //offset
//         alert('mathi dekhaune');
//     }
// });


</script>