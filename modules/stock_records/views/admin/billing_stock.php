
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
                    <table class="table">
                        <tr>
                            <td><label for='date_range'>Filters</label></td>
                            <?php if($type == 'cg_stock_position'): ?>
                                <td><div id='date' class='date_box' name='date'></div></td>
                            <?php else: ?> 
                                <td><button type="button" class="btn btn-success btn-xs btn-flat" id="jqxFilterButton"><?php echo lang('open_filter'); ?></button></td>
                            <?php endif; ?>
                            <td>
                                <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                                <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonCopyToClipboard"><?php echo lang('general_copy_clipboard'); ?></button>
                            </td>
                        </tr>
                    </table>    
                   <!--  <?php //echo form_open('', array('id' =>'form-crm_reports_generate')); ?>
                    <input type="hidden" id="report_criteria" name="report_criteria" value="<?php echo $type;?>" />
                    <input type="hidden" id="export" name="export" />
                    <table class="table">
                      <tr>
                        <td><label for='date_range'>Date Range</label></td>
                        <td><div id='date_range' class="date_box" name='date_range'></div></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php //echo lang('general_generate'); ?></button>
                            <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonCopyToClipboard"><?php //echo lang('general_copy_clipboard'); ?></button>
                        </td>
                    </tr>
                </table>
                <?php //echo form_close(); ?> -->
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

<div id="jqxPopupWindowFilters">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-crm_reports_generate')); ?>
            <input type="hidden" id="report_criteria" name="report_criteria" value="<?php echo $type;?>" />
            <input type="hidden" id="export" name="export" />
            <table class="form-table">
                <tr>
                    <td>
                        <label for='nepali_start_date'>Date From (Nepali)</label>
                    </td>
                    <td><input type="text" class='text_input' data-arg1="bs_to_ad" data-arg2="stock_records" data-arg3="jqxPopupWindowFiscal_year" data-arg4="nepali_start_date" data-arg5="english_start_date" name="nepali_start_date" id="nepali_start_date" placeholder="YYYY-MM-DD" /></td>
               
                    <td>
                        <label for='nepali_end_date'>Date To (Nepali)</label>
                    </td>
                    <td><input type="text" class='text_input'  data-arg1="bs_to_ad" data-arg2="stock_records" data-arg3="jqxPopupWindowFiscal_year" data-arg4="nepali_end_date" data-arg5="english_end_date" name="nepali_end_date" id="nepali_end_date" placeholder="YYYY-MM-DD" /></td>
                </tr>
                <tr style="height: 20px"></tr>
                <tr>
                    <td valign="top">
                        <label for='english_start_date'>Date From (Engish)<span class='mandatory'>*</span></label>
                        <a href="javascript:void(0)" class='convert-date'  data-arg1="ad_to_bs" data-arg2="stock_records" data-arg3="jqxPopupWindowFiscal_year" data-arg4="english_start_date" data-arg5="nepali_start_date"> <?php echo lang('general_ad_to_bs')?></a>
                    </td>
                    <td valign="top">
                        <div id='english_start_date' class='date_box' name='english_start_date'></div>
                    </td>
                
                    <td valign="top">
                        <label for='english_end_date'>Date To (English)<span class='mandatory'>*</span></label>
                        <a href="javascript:void(0)" class='convert-date'  data-arg1="ad_to_bs" data-arg2="stock_records" data-arg3="jqxPopupWindowFiscal_year" data-arg4="english_end_date" data-arg5="nepali_end_date"> <?php echo lang('general_ad_to_bs')?></a>
                    </td>
                    <td valign="top">
                        <div id='english_end_date' class='date_box' name='english_end_date'></div>
                    </td>
                </tr>
                <tfoot>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButtonFilter"><?php echo lang('general_generate'); ?></button>
                       
                    </td>
                </tfoot>                              
          </table>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
//google.load("visualization", "1", {packages:["corechart", "charteditor"]});
$(function(){
    // $("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true });
    // $('#date_range').jqxDateTimeInput('setRange', null, null);
    $('#nepali_start_date').jqxInput({ placeHolder: 'YYYY-MM-DD'});
    $('#nepali_end_date').jqxInput({ placeHolder: 'YYYY-MM-DD'});
    $("#english_end_date").jqxDateTimeInput({ value: null });
    $("#english_start_date").jqxDateTimeInput({ value: null });

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
        var english_end_date = $('#english_end_date').val();    
        var english_start_date = $('#english_start_date').val(); 
        if(english_start_date == '' || english_end_date == ''){
            alert('* marked fields are required');
            return false;
        }   
        generateReport();
        reset_form_filter();

        $('#jqxPopupWindowFilters').jqxWindow('close');
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

    $(document).on('click','#jqxFilterButton', function () { 
        openPopupWindow('jqxPopupWindowFilters', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

    $("#jqxPopupWindowFilters").jqxWindow({ 
        theme: theme,
        width: '60%',
        maxWidth: '75%',
        height: '40%',  
        maxHeight: '75%',  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowFilters").on('close', function () {
        reset_form_filter();
    });

    $("#jqxAccessoryCancelButton").on('click', function () {
        reset_form_filter();
        $('#jqxPopupWindowFilters').jqxWindow('close');
    });
});

function reset_form_crm_reports_generate() {
    $('#group_criteria').jqxComboBox('selectIndex', 0);
    $('#date_range').jqxDateTimeInput('setRange', null, null);
}

function generateReport() {
    $('#export').val('');
    var data = $("#form-crm_reports_generate").serialize();
     <?php if($type == 'cg_stock_position'){ ?>
        var date = $('#date').val();
        data = data+'&date='+date;
    <?php } ?>
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
    url: '<?php echo site_url("admin/stock_records/generate_billing_stock"); ?>',
    data: data,
    success: function (result) {
        console.log(result);
        var result = eval('('+result+')');
        if (result.success && result.total >= 1) {
           $("#report-table").pivotUI(result.data, {
            aggregatorName: "Count",
            rendererName: "Table",           
            rows: ["<?php echo ($default_row != '') ? $default_row: 'Month';?>"],
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

function reset_form_filter(){
    // $('#form-crm_reports_generate')[0].reset();
    $('#nepali_start_date').jqxInput({ placeHolder: 'YYYY-MM-DD', value: null});
    $('#nepali_end_date').jqxInput({ placeHolder: 'YYYY-MM-DD', value: null});
    $("#english_end_date").jqxDateTimeInput({ value: null });
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