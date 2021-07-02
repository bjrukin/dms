
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
		<h1>PDI REPORT</h1>
		<ol class="breadcrumb">
           <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
           <li><a href="<?php echo site_url('admin/crm-reports');?>"><?php echo lang('crm_reports');?></a></li>
           <li class="active">PDI REPORT</li>
       </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td><label for='date_range'>Filters</label></td>
                            <td><div id='date' class='date_box' name='date'></div></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                                <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonCopyToClipboard"><?php echo lang('general_copy_clipboard'); ?></button>
                            </td>
                        </tr>
                    </table>    
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

    $('#nepali_start_date').on('keyup', function () { 
    // $('.convert-date').on('keyup', function(){
        var value = $('#nepali_start_date').val();
        if(isValidDate(value)){
            var arg1 = this.getAttribute("data-arg1"),
                arg2 = this.getAttribute("data-arg2"),
                arg3 = this.getAttribute("data-arg3"),
                arg4 = this.getAttribute("data-arg4"),
                arg5 = this.getAttribute("data-arg5");

                window[arg1](arg2,arg3,arg4,arg5);
        }
    });
    $('#nepali_end_date').on('keyup', function () { 
    // $('.convert-date').on('keyup', function(){
        var value = $('#nepali_end_date').val();
        if(isValidDate(value)){
            var arg1 = this.getAttribute("data-arg1"),
                arg2 = this.getAttribute("data-arg2"),
                arg3 = this.getAttribute("data-arg3"),
                arg4 = this.getAttribute("data-arg4"),
                arg5 = this.getAttribute("data-arg5");

                window[arg1](arg2,arg3,arg4,arg5);
        }
    });

    $('.convert-date').on('click', function(){
        var arg1 = this.getAttribute("data-arg1"),
            arg2 = this.getAttribute("data-arg2"),
            arg3 = this.getAttribute("data-arg3"),
            arg4 = this.getAttribute("data-arg4"),
            arg5 = this.getAttribute("data-arg5");

            window[arg1](arg2,arg3,arg4,arg5);
    });

    $('#jqxButtonCopyToClipboard').hide();


    
    $("#jqxSubmitButton").on('click', function () {
        generateReport();
    });

    $("#jqxSubmitButtonFilter").on('click', function () {
        var nepali_start_date = $('#nepali_start_date').val();    
        var nepali_end_date = $('#nepali_end_date').val();    
       
        generateReport();
        reset_form_filter();

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
    <?php if ($this->input->get('generate') && $this->input->get('generate') == 1 ):?>
    generateReport();
    <?php endif;?>

});

function reset_form_crm_reports_generate() {
    $('#group_criteria').jqxComboBox('selectIndex', 0);
    $('#date_range').jqxDateTimeInput('setRange', null, null);
}

function generateReport() {
    $('#export').val('');
    var data = $("#date").val();
    // var data = $("#form-pdi_reports_generate").serialize();
console.log(data);
 $.ajax({
    type: "POST",
    url: '<?php echo site_url("admin/stock_records/generate_pdi_report"); ?>',
    data: {pdi_date : data},
    success: function (result) {
        var result = eval('('+result+')');
        if (result.success && result.total >= 1) {
           $("#report-table").pivotUI(result.data, {
            aggregatorName: "Count",
            rendererName: "Table",           
            rows: ["<?php echo ($default_row != '') ? $default_row: 'Model';?>"],
            cols: ["<?php echo $default_col;?>"]

            
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

    $("#form-pdi_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export"); ?>');
    $("#form-pdi_reports_generate").attr('target', '_blank');
    $("#form-pdi_reports_generate").submit();

}

function reset_form_filter(){
    // $('#form-pdi_reports_generate')[0].reset();
    $('#nepali_start_date').jqxInput({ placeHolder: 'YYYY-MM-DD', value: null});
    $('#nepali_end_date').jqxInput({ placeHolder: 'YYYY-MM-DD', value: null});
    $("#english_start_date").jqxDateTimeInput({ value: null });
}

function isValidDate(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    if(!dateString.match(regEx)) return false;  // Invalid format
    var d = new Date(dateString);
    if(Number.isNaN(d.getTime())) return false; // Invalid date
    return d.toISOString().slice(0,10) === dateString;
}
</script>