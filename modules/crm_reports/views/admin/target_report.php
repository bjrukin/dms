
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
		<h1><?php echo 'Target Report'; ?><small>Billing Target Report</small></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li><a href="<?php echo site_url('admin/crm-reports');?>"><?php echo lang('crm_reports');?></a></li>
	        <li class="active"><?php echo 'Billing Target Report'; ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <form id="filter_target_setting">
        					<table class="table table-responsive table-striped">
                                <tr>
                                    <td>
                                        <label for="switch_options">All</label>
                                        <input type="checkbox" name="switch" id="switch_options" value="1">
                                        <br>
                                        <label for='date_range'>Dealer</label></td>
                                    <td>
                                        <td><div id='dealer_id' name='dealer_id'></div></td>
                                    </td>
                                    <td>
                                        <label>Fiscal Year(Nepali) </label>
                                    </td>
                                    <td>
                                        <select name="fiscal_year" id="fiscal_year" class="form-control">
                                            <option value="">Select Fiscal Year</option>
                                            <?php foreach ($fiscal_years as $key => $value) : ?>
                                                <option value="<?php echo $value->id ?>"><?php echo explode('-',$value->nepali_start_date)[0].' / '.explode('-',$value->nepali_end_date)[0] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label>Month</label>
                                    </td>
                                    <td><div id='selectionmonth' name='month'></div></td>
                                </tr>
                            </table>
                            <div class="col-md-12">
                            <hr>
                        </div>
                        </form>
                        <button type="buttton" class="btn btn-primary btn-xs" id="search_btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
			</div><!-- /.col -->
		</div>

        <div class="row" id='report-table-box'>
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div id="jqxGrid_mechanic_earning"></div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /.row -->
        <!-- <?php if(isset($reports) && !empty($reports)): ?>
        <div class="row" id='report-table-box'>
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">Dealer:</div>
                            <div class="col-md-2"><?php echo $dealer_name ?></div>
                            <div class="col-md-2">Year:</div>
                            <div class="col-md-2"><?php echo $year ?></div>
                            <div class="col-md-2">Month:</div>
                            <div class="col-md-2"><?php echo $month ?></div>
                        </div>
                        <div id ="report-table">
                            <table id="table-report-booking-dashboard">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Vehicle</th>
                                        <th>Variant</th>
                                        <th>Color</th>
                                        <th>Opening Booking</th>
                                        <th>Current Month Booking</th>
                                        <th>Total Booking</th>
                                        <th>Todays Booking</th>
                                        <th>Pending Booking</th>
                                        <th>Retail</th>
                                        <th>Booking Cancellation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reports as $key => $value) : ?>
                                        <tr>
                                            <td><?php echo $key + 1 ?></td>
                                            <td><?php echo $value['vehicle_name'] ?></td>
                                            <td><?php echo $value['variant_name'] ?></td>
                                            <td><?php echo $value['color_name'] ?></td>
                                            <td><?php echo $value['opening_booking'] ?></td>
                                            <td><?php echo $value['total_this_month_booking'] ?></td>
                                            <td><?php echo $value['ttl'] ?></td>
                                            <td><?php echo $value['today_booking'] ?></td>
                                            <td><?php echo $value['pending'] ?></td>
                                            <td><?php echo $value['retailed'] ?></td>
                                            <td><?php echo $value['booking_cancel'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?> -->
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    var switch_options = $('#switch_options');
        switch_options.change(function(){
            if(switch_options.is(":checked")){
                $("#dealer_id").jqxComboBox({ disabled: true }); 

            }else{
                $("#dealer_id").jqxComboBox({ disabled: false }); 
            }
        });
    $(function(){
        var monthDataSource =
        {
            dataType: "json",
            dataFields: [
            { name: 'id'},
            { name: 'name'},
            ],
            url: '<?php echo site_url('admin/crm-reports/monthJson')?>'
        };

        monthDataAdapter = new $.jqx.dataAdapter(monthDataSource);

        $("#selectionmonth").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: monthDataAdapter,
            displayMember: "name",
            valueMember: "id",
        });

        //dealers
    var dealerDataSource = {
        url : '<?php echo site_url("admin/customers/get_sales_dealers_combo_json"); ?>',
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
    });
        
    });

    // $('#search_btn').click(function(e){
    //     // e.preventDefault();
    //     var year = $('#year').val();
    //     var month = $('#month').val();
    //     if(year == '' || month == ''){
    //         alert('Search Unavailable with empty fields');
    //         return false;
    //     }else{
    //         return true;
    //     }
    // })
</script>


<script type="text/javascript">
   $("#search_btn").on('click', function (event) {
            var switch_options = $('#switch_options').val();
            var dealer = null;
            if($('#switch_options:checkbox:checked').length > 0){
                dealer =  null;
            }else{
                dealer = $("#dealer_id").jqxComboBox('val');

            }

            console.log(dealer);
             
            var fiscal_year = $('#fiscal_year').val();
            var selectionmonth = $('#selectionmonth').val();
            var target_source =
            {
                datatype: "json",
                datafields: [
                { name: 'labout_amount', type: 'number' },
                { name: 'total_bill', type: 'number' },
                { name: 'total_target', type: 'number' },
                { name: 'target_year', type: 'string' },
                { name: 'month_name', type: 'string' },
                { name: 'dealer_name', type: 'string' },
                ],
                data: {dealer:dealer,fiscal_year:fiscal_year,month:selectionmonth},
                type: 'post',
                url: '<?php echo site_url('crm-reports/billing_target_report/json'); ?>'
            };
            var target_dataAdapter = new $.jqx.dataAdapter(target_source);
            $("#jqxGrid_mechanic_earning").jqxGrid(
            {
                width: '100%',
                height: '300px',
                showstatusbar: true,
                showaggregates: true,
                source: target_dataAdapter,
                columnsresize: true,
                columns: [
                { text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
                { text: '<?php echo "Dealer Name"; ?>', datafield: 'dealer_name', width:'20%' },
                { text: '<?php echo "Target Year" ?>', datafield: 'target_year', width:'20%' },
                { text: '<?php echo "Month"; ?>', datafield: 'month_name', width:'10%' },
                { text: '<?php echo "Billing Target" ?>', datafield: 'total_target', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
                { text: '<?php echo "Total Bill"; ?>', datafield: 'total_bill', width:'10%',cellsformat: 'd2', aggregates: ['sum'] },
                ]
            });
        });

</script>
