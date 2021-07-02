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
   <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="box box-solid">
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                      <tr>
                        <td><label for='date_range'>Start Date</label></td>
                        <td><div id='start_date' class="date_box"></div></td>
                        <td><label for='date_range'>End Date</label></td>
                        <td><div id='end_date' class="date_box"></div></td> 
                        <td><a href="<?php echo site_url('logistic_reports/excel_sequence') ?>" class="btn btn-warning btn-flat btn-sm">Excel Formater</a></td>
                    </tr>
                </table>
                <br />                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="<?php echo site_url('logistic_reports/generate_dealer_billing')?>" id="dealer_bill">Dealer Billing</a></li>
                    <li><a href="<?php echo site_url('logistic_reports/generate_dealer_retail')?>" id="dealer_retail">Dealer Retail</a></li>
                    <li><a href="<?php echo site_url('logistic_reports/generate_dealer_stock')?>" id="dealer_stock">Dealer Stock</a></li>
                    <li><a href="<?php echo site_url('logistic_reports/generate_cg_stock')?>" id="cg_stock">Cg Stock</a></li>
                    <li><a href="<?php echo site_url('logistic_reports/generate_cg_vintage_stock')?>" id="cg_vintage_stock">Cg Vintage Stock</a></li>
                    <li><a href="<?php echo site_url('logistic_reports/generate_unplanned_order')?>" id="dealer_stock">Unplanned Order</a></li>
                    <li><a href="<?php echo site_url('logistic_reports/generate_stock_summary')?>" id="stock_summary">Stock Summary</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /.col -->
</div>
<!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    var end_date = new Date().toISOString().slice(0,10);
    var start_date; 
    // var end_date = today.getFullYear()+'-'+ (today.getMonth() + 1) + '-' + today.getDate();
    // console.log(today);
    $(function()
    {
        $("#start_date").jqxDateTimeInput({ formatString: "yyyy-MM-dd" });
        $("#end_date").jqxDateTimeInput({ formatString: "yyyy-MM-dd" });
    })
    $('#start_date').change(function()
    {
        var dealer_bill = '';
        var dealer_retail = '';
        var dealer_stock = '';
        var cg_stock = '';
        var stock_summary = '';

        var start_date = $(this).val();

        dealer_bill = '<?php echo site_url('logistic_reports/generate_dealer_billing')?>';
        $("#dealer_bill").attr("href", dealer_bill+'/'+start_date+'/'+end_date);

        dealer_retail = '<?php echo site_url('logistic_reports/generate_dealer_retail')?>';
        $("#dealer_retail").attr("href", dealer_retail+'/'+start_date+'/'+end_date);

        dealer_stock = '<?php echo site_url('logistic_reports/generate_dealer_stock')?>';
        $("#dealer_stock").attr("href", dealer_stock+'/'+start_date+'/'+end_date);

        cg_stock = '<?php echo site_url('logistic_reports/generate_cg_stock')?>';
        $("#cg_stock").attr("href", cg_stock+'/'+start_date+'/'+end_date);

        stock_summary = '<?php echo site_url('logistic_reports/generate_stock_summary')?>';
        $("#stock_summary").attr("href", stock_summary+'/'+start_date+'/'+end_date);

    });
    $('#end_date').change(function()
    {
        end_date = $(this).val();
        var dealer_bill = '';
        var dealer_retail = '';
        var dealer_stock = '';
        var cg_stock = '';
        var stock_summary = '';

        var start_date = $('#start_date').val();

        // dealer_bill = $('#dealer_bill').attr('href');
        dealer_bill = '<?php echo site_url('logistic_reports/generate_dealer_billing')?>';        
        $("#dealer_bill").attr("href", dealer_bill+'/'+start_date+'/'+end_date);

        dealer_retail = '<?php echo site_url('logistic_reports/generate_dealer_retail')?>';
        $("#dealer_retail").attr("href", dealer_retail+'/'+start_date+'/'+end_date);

        dealer_stock = '<?php echo site_url('logistic_reports/generate_dealer_stock')?>';
        $("#dealer_stock").attr("href", dealer_stock+'/'+start_date+'/'+end_date);

        cg_stock = '<?php echo site_url('logistic_reports/generate_cg_stock')?>';
        $("#cg_stock").attr("href", cg_stock+'/'+start_date+'/'+end_date);

        stock_summary = '<?php echo site_url('logistic_reports/generate_stock_summary')?>';
        $("#stock_summary").attr("href", stock_summary+'/'+start_date+'/'+end_date);
    });
</script>

