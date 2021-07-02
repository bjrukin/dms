
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
                    <?php 
                    if($type == "dealer_back_order")
                    {
                    ?>
                    <td><label for='group_criteria'>Dealer Name</label></td>
                    <td><div id='dealer_name' name='dealer_name'></div></td>  
                    <?php
                    }
                    ?>
                    <td><label for='date_range'>Date Range</label></td>
                    <td><div  id='date_range' name="date_range"></div></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                        <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonExcelExport">Export to Excel</button>
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
           var sparepart_dealerDataSource = {
            url : '<?php echo site_url("admin/sparepart_orders/get_spareparts_dealers_combo_json"); ?>',
            datatype: 'json',
            datafields: [
            { name: 'id', type: 'number' },
            { name: 'name', type: 'string' },
            ],
            async: false,
            cache: true
        }

        spareparts_dealerDataAdapter = new $.jqx.dataAdapter(sparepart_dealerDataSource);
        <?php 
            if($type == "dealer_back_order"){
        ?>
            $("#dealer_name").jqxComboBox({
                theme: theme,
                width: 195,
                height: 25,
                selectionMode: 'dropDownList',
                autoComplete: true,
                searchMode: 'containsignorecase',
                source: spareparts_dealerDataAdapter,
                displayMember: "name",
                valueMember: "id",
            });
        <?php }?>
	$("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true, formatString: 'yyyy-MM-dd'  });
	$('#date_range').jqxDateTimeInput('setRange', null, null);

    $('#jqxButtonCopyToClipboard').hide();
    
    $("#jqxSubmitButton").on('click', function () {
        generateReport();
    });

    $("#jqxButtonExcelExport").on('click', function () {
        exportExcel();
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
    var data = $("#form-crm_reports_generate").serialize();
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("admin/spareparts_report/get_report_json"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success && result.total >= 1) {
                $('#report-table-box').show();
                var report_data = result.data;
                var new_string = '';

                new_string += 'sparepartsDataSource = {datatype: "array", datafields: [';
                $.each(result.data[0],function(i,v){
                    new_string += '{ name: "'+i+'", type: \'string\' },';

                });           
                new_string += ' ], localdata: report_data }; var jqxspareparts_data_Adapter = new $.jqx.dataAdapter(sparepartsDataSource);';

                new_string += "$('#report-table').jqxGrid({ "+
                "theme: theme, "+
                "width: '100%',"+
                "height: gridHeight, "+
                "source: jqxspareparts_data_Adapter, "+
                "pageable: true, "+
                "sortable: true, "+
                "rowsheight: 30, "+
                "columnsheight:30, "+
                "showfilterrow: true, "+
                "filterable: true, "+
                "columnsresize: true, "+
                "autoshowfiltericon: true, "+     
                "selectionmode: 'multiplecellsadvanced', "+           
                "pagesizeoptions: pagesizeoptions, "+
                "columns: [ "+
                "{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: "+
                "rownumberRenderer, filterable: false}, ";
                $.each(result.data[0],function(i,v){
                    new_string +="{ text: '"+result.lang_array[i]+"',datafield: '"+i+"',width: 220,filterable: true, cellsalign: 'left', renderer: gridColumnsRenderer }, ";
                });
                new_string += " ], "+
                "rendergridrows: function (result) { "+
                "return result.data; "+
                "} "+
                "}); ";

                eval(new_string);
            }else{
                alert('No data found or error occured. Please change date and try again. Thank you.');
            }
        }
    });
}

function exportExcel() {
    $('#export').val('export');
    <?php
        if($type == "partwise_sales")
        {
    ?>
        $("#form-crm_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export_partwise_sales"); ?>');
    <?php
    }
    else if($type == "dealer_partwise_sales")
    {
    ?>
        $("#form-crm_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export_dealer_partwise_sales"); ?>');
    <?php
    }
    else if($type == "dealer_valuewise_sales")
    {
    ?>
    $("#form-crm_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export_dealer_valuewise_sales"); ?>');
    <?php
    }
    else if($type == "dealer_back_order")
    {
    ?>
    $("#form-crm_reports_generate").attr('action', '<?php echo site_url("admin/crm-reports/excel_export_dealer_back_order"); ?>');
    <?php
    }
    ?>
    $("#form-crm_reports_generate").submit();

}
</script>