<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/pivot/pivot.css');?>">

<script type="text/javascript">
<!--
var base_url = '<?php echo base_url();?>';
var index_page = "";
// -->
</script>

 <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/pivot/c3.min.css');?>">
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/d3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/c3.min.js');?>"></script>

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-2.1.4.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/pivot.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/c3_renderers.js');?>"></script>

<style type="text/css">
    .data-table{
        width:100%;
        border-collapse:collapse;
        table-layout:fixed; 
        font-family: 'Source Sans Pro',sans-serif;
    }
    .data-table th, .data-table td{
        text-align: center;
        vertical-align: middle;
        font-weight: normal!important;       
    }
    .pvtCols { background-color:#F5F5F5!important}
    .pvtRows { background-color:#F5F5F5!important}
</style>

<?php $form_id = 'form-crm_reports_generate-' . $type;?>
<?php echo form_open('', array('id' => $form_id )); ?>
<input type="hidden" id="report_criteria" name="report_criteria" value="<?php echo $type;?>" />
<input type="hidden" id="export" name="export" />
<?php echo form_close();?>

<div id ="report-table"></div>
                    
<script type="text/javascript">
//google.load("visualization", "1", {packages:["corechart", "charteditor"]});
$(function(){
    generateReport();

    $('#data-table').bind('DOMSubtreeModified', function(event){
        alert('test');
    });
});


function generateReport() {

    var data = $("#<?php echo $form_id;?>").serialize();

    $.ajax({
        type: "POST",
        url: '<?php echo site_url("admin/crm-reports/get_report_dashboard_json"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success && result.total > 1) {

                var derivers = $.pivotUtilities.derivers;
                var renderers = $.extend($.pivotUtilities.renderers, $.pivotUtilities.c3_renderers);

                 $("#report-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",
                    rows: ["<?php echo ($default_row != '') ? $default_row: 'Month (BS)';?>"],
                    cols: ["<?php echo $default_col;?>"],
                    // rows: [result.rows],
                    // cols: [result.cols]
                });
            }
        }
    });
}
</script>