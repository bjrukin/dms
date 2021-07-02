
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
		<h1><?php echo 'Booking Dashboard'; ?><small>Booking Dashboard</small></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li><a href="<?php echo site_url('admin/crm-reports');?>"><?php echo lang('crm_reports');?></a></li>
	        <li class="active"><?php echo 'Booking Dashboard'; ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <form action="<?php echo site_url('admin/crm-reports/booking_dashboard_data') ?>" method="post">
                            
                            <input type="hidden" id="export" name="export" />
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
                                        <label>Year(Nepali) </label>
                                    </td>
                                    <td><input type="number" id="year" name="year" class="number_input">  </td>
                                    <td>
                                        <label>Month</label>
                                    </td>
                                    <td><div id='selectionmonth' name='month'></div></td>
                                </tr>
                            </table>
                            <div class="col-md-12">
                            <hr>
                            <button type="submit" class="btn btn-primary btn-xs" id="search_btn"><i class="fa fa-search"></i></button>
                        </div>
                        </form>
                    </div>
                </div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
        <?php if(isset($reports) && !empty($reports)): ?>
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
            </div><!-- /.col -->
        </div>
        <?php endif; ?>
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

    $('#search_btn').click(function(e){
        // e.preventDefault();
        var year = $('#year').val();
        var month = $('#month').val();
        if(year == '' || month == ''){
            alert('Search Unavailable with empty fields');
            return false;
        }else{
            return true;
        }
    })
</script>


<script type="text/javascript">
    $(document).ready(function () {
        <?php if(isset($reports) && !empty($reports)): ?>
        var rows = $("#table-report-booking-dashboard tbody tr");
        // select columns.
        var columns = $("#table-report-booking-dashboard thead th");
        var data = [];
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var datarow = {};
            for (var j = 0; j < columns.length; j++) {
                // get column's title.
                var columnName = $.trim($(columns[j]).text());
                // select cell.
                var cell = $(row).find('td:eq(' + j + ')');
                datarow[columnName] = $.trim(cell.text());
            }
            data[data.length] = datarow;
        }
        var source = {
            localdata: data,
            datatype: "array",
            datafields:
            [
                { name: "Sn", type: "string" },
                { name: "Vehicle", type: "string" },
                { name: "Variant", type: "string" },
                { name: "Color", type: "string" },
                { name: "Opening Booking", type: "number" },
                { name: "Current Month Booking", type: "number" },
                { name: "Total Booking", type: "number" },
                { name: "Todays Booking", type: "number" },
                { name: "Pending Booking", type: "number" },
                { name: "Retail", type: "number" },
                { name: "Booking Cancellation", type: "number" }
            ]
            
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#table-report-booking-dashboard").jqxGrid(
        {
            width: '100%',
            height: gridHeight,
            source: dataAdapter,
            altrows: true,
            pageable: true,
            sortable: true,
            rowsheight: 30,
            columnsheight:30,
            showfilterrow: true,
            filterable: true,
            columnsresize: true,
            autoshowfiltericon: true,
            columnsreorder: true,
            selectionmode: 'none',
            // aggregate: true,
                    showstatusbar: true,
            
                    showaggregates: true,   
                    statusbarheight: 30,

            enableanimations: false,
            pagesizeoptions: pagesizeoptions,
            showtoolbar: true,
            columns: [
              { text: 'Sn', dataField: 'Sn', align: 'center', width: 130 },
              { text: 'Vehicle', dataField: 'Vehicle', align: 'center', width: 130 },
              { text: 'Variant', dataField: 'Variant', align: 'center', width: 170 },
              { text: 'Color', dataField: 'Color',  align: 'center', width: 150 },
              { text: 'Opening Booking', dataField: 'Opening Booking', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
              { text: 'Current Month Booking', dataField: 'Current Month Booking', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
              { text: 'Total Booking', dataField: 'Total Booking', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
              { text: 'Todays Booking', dataField: 'Todays Booking', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
              { text: 'Pending Booking', dataField: 'Pending Booking', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
              { text: 'Retail', dataField: 'Retail', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
              { text: 'Booking Cancellation', dataField: 'Booking Cancellation', align: 'center', cellsalign: 'right', width: 100 , aggregates: ['sum']  },
            ]
        });
        <?php endif; ?>
    });

</script>
