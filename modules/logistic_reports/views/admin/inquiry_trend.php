<style type="text/css">
	table.form-table td:nth-child(odd){
		width:13%;
	}
	table.form-table td:nth-child(even){
		width:20%;
	}
    #data-table{
        width:100%;
        border-collapse:collapse;
        table-layout:fixed; 
    }
    #data-table td:first-child {
        width: 500px!important;
    }
    .box.box-solid>.box-header .btn:hover, .box.box-solid>.box-header a:hover {
        background-color: #367fa9;
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
		<!-- row -->
		<div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <td><label for="date_range">Date Range</label></td>
                                <td><div id="date_range" name="date_range" class="date_box"></div></td>
                                <td><label for="period">Format</label></td>
                                <td><div id="graph_format" name="graph_format" class="combo_box"></div></td>
                                <td><label for="select_chart_type">Chart Type</label></td>
                                <td><div id='chart_types'></div></td>
                                <td><label for='group_criteria'>Grouping Criteria</label></td>
                                <td><div id='group_criteria' name='group_criteria'></div></td>
                                <td><button type="button" class="btn btn-success btn-xs btn-flat" id="jqxGraphUpdate">Show</button></td>
                            </tr>
                        </table>
                        <br />
                        <div id='chartContainer-1'></div>
                    </div>
                </div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">

$(function (){   
    var array_formats = ['Day', 'Month', 'Year'],
        array_chart_types = ["Line", "Spline", "Column", "Stacked Column"],
        colorsArray = ['#0000FF', '#FFFF00', '#FF0000', '#00FF00', '#0FFFF0',  '#F0FFF0'],
        chart = null,
        url = '<?php echo site_url("admin/crm_reports/get_datafield_sources");?>',
        group_criteriasDataSource = {
            url : '<?php echo site_url("admin/crm_reports/get_grouping_criteria_json"); ?>',
            datatype: 'json',
            datafields: [
                { name: 'name', type: 'string' },
                { name: 'value', type: 'string' },
            ],
            data: { 'key' : '<?php echo $type;?>'},
            async: true,
            cache: true
        },
        group_criteriasDataAdapter = new $.jqx.dataAdapter(group_criteriasDataSource);

    $.jqx._jqxChart.prototype.colorSchemes.push({ name: 'myScheme', colors: colorsArray });

    $('#date_range').jqxDateTimeInput({ 
        width: 200, 
        height: 25,
        selectionMode: 'range', 
        showFooter: true 
    });   

    $("#graph_format").jqxComboBox({ 
        theme:theme, 
        width: 150, 
        height: 25,
        source: array_formats, 
        selectedIndex: 0, 
    });

    $("#chart_types").jqxComboBox({ 
        theme:theme, 
        width: 150, 
        height: 25,
        source: array_chart_types, 
        selectedIndex: 0, 
    });

    $("#group_criteria").jqxComboBox({
        theme: theme,
        width: 150, 
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: group_criteriasDataAdapter,
        displayMember: "name",
        valueMember: "value",
        selectedIndex: 0
    });

    //create chart
    var settings = {
        title: "Inquiry Trend",
        description: "",
        enableAnimations: true,
        showLegend: true,
        padding: { left: 10, top: 5, right: 10, bottom: 5 },
        titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
        source: null,
        xAxis:
        {
            dataField: 'Duration',
            showTickMarks: true,
            tickMarksInterval: 1,
            tickMarksColor: '#888888',
            showGridLines: true,
            gridLinesInterval: 3,
            gridLinesColor: '#888888',
            valuesOnTicks: true,
            textRotationPoint: 'topright',
            textOffset: {x: 0, y: 0}
        },
        colorScheme: 'scheme01',
        seriesGroups:
            [{
                type: 'line',
                valueAxis:
                {
                    displayValueAxis: true,
                    axisSize: 'auto',
                    tickMarksColor: '#888888'
                },
                series: []
            }]
    };
    $('#chartContainer-1').jqxChart(settings);
    chart = $('#chartContainer-1').jqxChart('getInstance');

    $('#chartContainer-1').css('height', gridHeight-50);
    $('#chartContainer-1').css('width', '100%');

    $('#jqxGraphUpdate').on('click', function() {
        var data = {};
        data.graph_format = $('#graph_format').jqxComboBox('val'); 
        data.group_criteria = $('#group_criteria').jqxComboBox('val');

        d = $("#date_range").jqxDateTimeInput('getRange');
        if (d.from != null && d.to != null) {
            data.date_range = {};
            data.start_date = data.date_range.from = d.from.toString('yyyy-MM-dd');
            data.end_date = data.date_range.to = d.to.toString('yyyy-MM-dd');
        } else {
            data.date_range = {};
        data.start_date = data.date_range.from = '<?php echo date("Y-m-d", strtotime("-1 month", time()));?>';
        data.end_date = data.date_range.to = '<?php echo date("Y-m-d");?>';
        }

        data.column_name = 'inquiry_date_en';
        data.table_view = 'view_customers';

        $.getJSON( 
            url,
            data
        ).done(function(response) {
            var source =
            {
                datatype: "json",
                datafields: response.source,
                url: '<?php echo site_url("admin/crm_reports/inquiry_trend_json"); ?>',
                data: data
            };

            var dataAdapter = new $.jqx.dataAdapter(source, {
                async: true, 
                autoBind: true, 
                loadError: function (xhr, status, error) {
                    alert('Error loading "' + source.url + '" : ' + error); 
                },
            });

            value = ($('#chart_types').jqxComboBox('val')).toLowerCase().replace(" ", ""),
            isColumn = value.indexOf('column') != -1;
            
            chart.seriesGroups[0].series = response.series;
            chart.seriesGroups[0].type = value;

            if (isColumn) {
                var group = chart.seriesGroups[0];
                $.each(group.series, function (index, obj){
                    obj.lineWidth = 1;
                });
            }

            $('#chartContainer-1').jqxChart({ source: dataAdapter });
        });
    });


});
</script>