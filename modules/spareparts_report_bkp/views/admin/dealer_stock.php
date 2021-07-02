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
.dataTables_wrapper .dataTables_paginate .paginate_button{
    padding: .2em !important;
    background: transparent;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo lang('crm_reports'); ?><small><?php echo $report_type; ?></small></h1>
        <ol class="breadcrumb">
           <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
           <li><a href="<?php echo site_url('admin/crm-reports');?>"><?php echo lang('spareparts_report');?></a></li>
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
                        <td> <div id="dealer_id"></div> </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                            <button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxButtonExcelExport"><?php echo lang('general_export_excel'); ?></button>
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
                <br />
                <div id ="report-table" style="overflow-x:scroll;overflow-y: hidden;">
                </div>
            </div>
        </div>
    </div><!-- /.col -->
</div>
<!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function(){

       var dealerDataSource  = {
        url : '<?php echo site_url("admin/spareparts_report/get_spareparts_dealers_combo_json"); ?>',
        datatype: 'json',
        datafields: [
        { name: 'id', type: 'number' },
        { name: 'name', type: 'string' },
        ],
        async: false,
        cache: true
    }

    dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource, {autoBind: false});

    $("#dealer_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: dealerDataAdapter,
        displayMember: "name",
        valueMember: "id",
    });
    
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
        $('#order_no').jqxComboBox('selectIndex', 0);
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
            type: "POST",
            url: '<?php echo site_url("admin/spareparts_report/get_dealer_stock_json"); ?>',
            data: data,
            success: function (result) {
                var result = eval('('+result+')');                
                if (result.success && result.total >= 1) {                   
                    $('#report-table').html("<table class='table table-bordered table-condensed table-striped dataTable' style='table-layout:auto;width:150%' id='data-table'></table>");
                    buildHtmlTable(result.data,'data-table',false);
                    var table =  $('#data-table').DataTable({
                        dom: '<"top"f>t<"bottom"lp><"clear">',
                        "bLengthChange": false,
                        "iDisplayLength" : 500,
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;  
                            var intVal = function ( i ) {
                                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ?  i : 0;
                            };

                            total_quantity = api.column( 3 ).data().reduce( function (a, b) {
                                return (isNaN(intVal(a))?0 : intVal(a) ) + (isNaN(intVal(b))?0:intVal(b));
                            },0 );

                            total_page_quantity = api.column( 3, { page: 'current'} ).data().reduce( function (a, b) {
                                return (isNaN(intVal(a))?0 : intVal(a) ) + (isNaN(intVal(b))?0:intVal(b));
                            }, 0 );

                            total_page_quantity = parseFloat(total_page_quantity);
                            total_quantity = parseFloat(total_quantity);
                            $('#total_quantity').html("Total Quantity: "+total_page_quantity); 

                            total_value = api.column( 5 ).data().reduce( function (a, b) {
                                return (isNaN(intVal(a))?0 : intVal(a) ) + (isNaN(intVal(b))?0:intVal(b));
                            },0 );

                            total_page_value = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) {
                                return (isNaN(intVal(a))?0 : intVal(a) ) + (isNaN(intVal(b))?0:intVal(b));
                            }, 0 );

                            total_page_value = parseFloat(total_page_value);
                            total_value = parseFloat(total_value);
                            $('#total_value').html("Total value: "+total_page_value);                
                        },  

                    });
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

    function buildHtmlTable(records,tableid,footer) {

        var columns = [];
        var headerThead$ = $('<thead/>');
        var headerTr$ = $('<tr/>');

        for (var i = 0 ; i < records.length ; i++) {
            var rowHash = records[i];
            for (var key in rowHash) {
                if ($.inArray(key, columns) == -1){
                    columns.push(key);
                    var trtb = headerTr$.append($('<th/>').html(key));
                }
            }
        }
        headerThead$.append(trtb);
        $("#"+tableid).append(headerThead$);

        var footerTfoot$ = $('<tfoot><th colspan="4" id = "total_quantity" style="text-align:right;"></th><th colspan="2" id = "total_value" style="text-align:right;"></th></tfoot>');
        $("#"+tableid).append(footerTfoot$);


        var length = records.length;
        if (footer == true) {
            length = records.length-1
        }

        for (var i = 0 ; i < length ; i++) {
            var row$ = $('<tr/>');
            for (var colIndex = 0 ; colIndex < columns.length ; colIndex++) {
                var cellValue = records[i][columns[colIndex]];

                if (cellValue == null) { cellValue = "-"; }

                row$.append($('<td class="report-cell" />').html(cellValue));
            }
            $("#"+tableid).append(row$);
        }

        if (footer == true) {
            for (var i = (records.length-1) ; i < records.length ; i++) {
                var row$ = $('<tr/>');
                for (var colIndex = 0 ; colIndex < columns.length ; colIndex++) {
                    var cellValue = records[i][columns[colIndex]];

                    if (cellValue == null) { cellValue = "-"; }

                    row$.append($('<th/>').html(cellValue));
                }

                $("#"+tableid).append(row$);
            }
        }
    }
</script>