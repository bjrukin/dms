
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
   
   <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box box-solid">
                <div class="box-body">
                    <?php echo form_open('', array('id' =>'form-msil_pending_report_generate')); ?>
                    
                    <table class="table">
                      <tr>
                        <td><label for='date_range'>Year</label></td>
                        <td><div id='year' class="" name='select_year'></div></td>
                        <td><label for='month'>Month</label></td>
                        <td><div id='month' class="" name='select_month'></div></td>
                        <td>    
                            <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>                            
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div><!-- /.col -->
</div>
<!-- /.row -->
<div class="row" id='report-table-box' style="display: none;">
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
    $("#jqxSubmitButton").on('click', function () {
        generateReport();
    });

    var date = new Date();    
    var key = [];
    for(var i= date.getFullYear(); i>=2010; i--){
        key.push(i)
    }

    $("#year").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: key,
    }); 

    var data = [{
        name:'January',
        value:1},{
           name:'February',
           value:2 
        },{
            name:'March',
            value:3
        },
        {
            name:'April',
            value:4
        },
        {
            name:'May',
            value:5
        },
        {
            name:'June',
            value: 6
        },
        {   
            name: 'July',
            value:7
        },{
            name: 'August',
            value: 8
        },{
            name:'September',
            value: 9
        },{
            name: 'October',
            value: 10
        },{
            name: 'November',
            value: 11
        },{
            name: 'December',
            value: 12    
        }];
    // var month_val = ['1','2','3','4','5','6','7','8','9','10','11','12'];

    // var data = new Array();
    // for(var i=0; i< month_name.length; i++){
    //     var row = {};
    //     row['key'] =  month_val[i];
    //     row['value'] =  month_name[i];
    //     data[i] = row;

    // }

    // var monthsource  = {
    //     localdata: data,
    //     datatype: "array", 
    //     async: false,
    //     cache: true
    // };
    // monthDataAdapter = new $.jqx.dataAdapter(monthsource);
    $("#month").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: data,
        valueMember: 'value',
        displayMember: 'name',
    });
});

function reset_form_crm_reports_generate() {
    $('#group_criteria').jqxComboBox('selectIndex', 0);
    $('#date_range').jqxDateTimeInput('setRange', null, null);
}

function generateReport() {
    $('#export').val('');
    var data = $("#form-msil_pending_report_generate").serialize();

    $.ajax({
        type: "POST",
        url: '<?php echo site_url("admin/monthly_plannings/pending_json"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success && result.total >= 1) {
               $("#report-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",   

                    
                });
                $('#report-table-box').show();         
            }
            else{
                alert('No record found');
            }   
        }
    });
}

</script>