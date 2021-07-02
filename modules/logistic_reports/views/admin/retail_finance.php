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
    #data-table td:nth-child(2) {
        width: 800px!important;
        font-size: 105%;
        text-align:left;
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
                        <?php echo form_open('', array('id' =>'form-crm_reports_retail_finance')); ?>
                        <input type="hidden" id="report_criteria" name="report_criteria" value="<?php echo $type;?>" />
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <td style="display:none"><label for='group_criteria'>Parameter</label></td>
                                    <td style="display:none"><div id='group_criteria' name='group_criteria'></div></td>  
                                    <td><label for='date_range'>Date Range</label></td>
                                    <td><div id='date_range' class="date_box" name='date_range'></div></td>
                                    <td><td class="dealer-selection"><div id='dealer_id' name='dealer_id'></div></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
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


<script type="text/javascript">
$(function(){

    $("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true });
    $('#date_range').jqxDateTimeInput('setRange', null, null);
    
    //dealers
    var dealerDataSource = {
        url : '<?php echo site_url("admin/customers/get_dealers_combo_json"); ?>',
        datatype: 'json',
        datafields: [
            { name: 'id', type: 'number' },
            { name: 'name', type: 'string' },
        ],
        async: false,
        cache: true
    }

    dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

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
        checkboxes: true,
    });

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

    group_criteriasDataAdapter = new $.jqx.dataAdapter(group_criteriasDataSource);

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
     

    $("#jqxResetButton").on('click', function () {
        reset_form_crm_reports_retail_finance();
    });

    $("#jqxSubmitButton").on('click', function () {
        generateReport();
    });
});

function reset_form_crm_reports_retail_finance() {
    $('#group_criteria').jqxComboBox('selectIndex', 0);
    $('#date_range').jqxDateTimeInput('setRange', null, null);
}

function generateReport() {
    var data = $("#form-crm_reports_retail_finance").serialize();

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
        url: '<?php echo site_url("admin/crm-reports/retail_finance_json"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                $('#report-table').html("<table class='table table-bordered table-condensed table-striped dataTable' style='table-layout:auto;width:150%' id='data-table'></table>");
                buildHtmlTable(result.data,'data-table', false);
                $('#reports').show();
            } else {
                $('#reports').hide();
                alert('No Records for generating Reports');
            }
            $('.content-wrapper').unblock();
        }
    });
}
</script>