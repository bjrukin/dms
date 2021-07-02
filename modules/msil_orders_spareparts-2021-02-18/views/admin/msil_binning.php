<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo "Binning Report"; ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo "Binning Report"; ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo form_open('', array('id' =>'form-crm_reports_generate')); ?>
                    
                    <table class="table table-responsive table-striped">
                        <tr>
                        
                            <td><label for='date_range'>Date Range</label></td>
                            <td><div id='date_range' class="date_box" name='date_range'></div></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-xs btn-flat" id="jqxSubmitButton"><?php echo lang('general_generate'); ?></button>
                               
                            </td>
                       </tr>
                    </table>
                <?php echo form_close(); ?>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
$(function(){

    $("#date_range").jqxDateTimeInput({ width: 200, height: 25,  selectionMode: 'range', showFooter: true });
    $('#date_range').jqxDateTimeInput('setRange', null, null);
});
$("#jqxSubmitButton").on('click', function () {
        exportExcel();
 });
function exportExcel() {
    var date = $('#date_range').val('export');
  

    $("#form-crm_reports_generate").attr('action', '<?php echo site_url("msil_orders_spareparts/excel_export"); ?>'+'?date_range='+date);
    $("#form-crm_reports_generate").attr('target', '_blank');
    $("#form-crm_reports_generate").submit();

}
</script>