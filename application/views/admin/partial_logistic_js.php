<script type="text/javascript">

    var partial_logistic = function()
    {

        // Stock Status
        url = "<?php echo site_url('stock_records/get_stock_dashboard')?>";
        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
            { name: 'vehicle', type: 'string' },
            { name: 'stock_count', type: 'number' },
            { name: 'avg_sales', type: 'number' },
            { name: 'stock_status', type: 'string' },
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#stock_status").jqxGrid(
        {
            width: '100%',
            pagerButtonsCount: 15,
            source: dataAdapter,
            columnsResize: true,
            showAggregates: true,
            showstatusbar: true,
            showfilterrow: true,
            filterable: true,
            sortable: true,
            statusbarheight: 50,
            columns: [
            { text: 'Vehicle', dataField: 'vehicle', width: 220 },
            { text: 'Stock', dataField: 'stock_count', width: 100,  aggregates: ['sum'] },
            { text: 'Avg. Sales', dataField: 'avg_sales', width: 100,  aggregates: ['sum'] },
            { text: 'Stock Status', dataField: 'stock_status', width: 120},
            ],

        });


        // Stock Position
        var data_source_stock =
        {
            datatype: "json",
            datafields: [
            { name: 'location' },
            { name: 'count' },
            ],
            url: "<?php echo site_url('stock_records/get_dashboard_stock_summary')?>"
        };

        var dataAdapter_stock = new $.jqx.dataAdapter(data_source_stock, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

        var settings = {
            title: "Stock Summary",
            enableAnimations: true,
            showLegend: true,
            showBorderLine: false,
            legendLayout: { left: 5, top: 50, width: 575, height: 400, flow: 'horizontal' },
            padding: { left: 5, top:15, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 60 },
            seriesGroups:
            [
            {
                type: 'donut',
                offsetX: 250,
                showLegend: true,
                source: dataAdapter_stock,
                colorScheme: 'scheme01',
                series:
                [
                {
                    dataField: 'count',
                    displayText: 'location',
                    showLabels: true,
                    labelRadius: 160,
                    labelLinesEnabled: true,
                    labelLinesAngles: true,
                    labelsAutoRotate: true,
                    initialAngle: 0,
                    radius: 125,
                    centerOffset: 0,
                    offsetY: 170,
                }
                ]
            }
            ]
        };
        $('#chartContainer-stock_summary').jqxChart(settings);

        var data_source_year =
        {
            datatype: "json",
            datafields: [
            { name: 'year' },
            { name: 'stock_count' },
            ],
            url: "<?php echo site_url('stock_records/get_dashboard_yearwise_stock')?>"
        };

        var dataAdapter_stock = new $.jqx.dataAdapter(data_source_year, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

        var settings = {
            title: "Yearwise Stock",
            description: "Total Vehicle Count Mfg. Yearwise",
            showLegend: true,
            showBorderLine: false,
            enableAnimations: true,
            padding: { left: 30, top: 5, right: 20, bottom: 5 },
            titlePadding: { left: 120, top: 0, right: 0, bottom: 10 },
            source: dataAdapter_stock,
            xAxis:
            {
                dataField: 'year',
                gridLines: { visible: false },
                flip: false
            },
            valueAxis:
            {
                flip: true,
                unitInterval: 100,
                minValue: 0,
                maxValue: 1500,
                gridLines: { 
                    visible: false,                       
                }
            },
            colorScheme: 'scheme05',
            seriesGroups:
            [
            {
                type: 'column',
                orientation: 'horizontal',
                columnsGapPercent: 30,
                toolTipFormatSettings: { thousandsSeparator: ',' },
                click: myEventHandler,
                series: [
                { dataField: 'stock_count', displayText: 'Stock' }
                ]
            }
            ]
        };
        function myEventHandler(e) 
        {
            var eventData = '<div><h4><b> Value: </b>' + e.elementValue + "</h4></div>";
            window.location.href = "<?php echo site_url('stock_records/billing_stock/cg_stock?generate=1') ?>";
        }
        $('#chartContainer-yearwise').jqxChart(settings);


        var data_source_segmentwise =
        {
            datatype: "json",
            datafields: [
            { name: 'segment_name' },
            { name: 'total_stock' },
            ],
            url: "<?php echo site_url('stock_records/get_segmentwise_stock')?>"
        };

        var dataAdapter_stock_segment = new $.jqx.dataAdapter(data_source_segmentwise, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
        var chartSettings = {
            source: dataAdapter_stock_segment,
            title: 'Segmentwise Stock',
            description: 'Total Vehilce Count Segmentwise',
            enableAnimations: false,
            showLegend: true,
            showBorderLine: false,
            padding: { left: 5, top: 5, right: 5, bottom: 50 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 30 },
            colorScheme: 'scheme10',
            seriesGroups: [
            {
                type: 'pie',
                showLegend: true,
                enableSeriesToggle: true,
                series:
                [
                {
                    dataField: 'total_stock',
                    displayText: 'segment_name',
                    showLabels: true,
                    labelRadius: 160,
                    labelLinesEnabled: true,
                    labelLinesAngles: true,
                    labelsAutoRotate: true,
                    initialAngle: 0,
                    radius: 125,
                    minAngle: 0,
                    maxAngle: 180,
                    centerOffset: 0,
                    offsetY: 170,
                    formatFunction: function (value, itemIdx, serieIndex, groupIndex) {
                        if (isNaN(value))
                            return value;
                        return value;
                    }
                }
                ]
            }
            ]
        };
        $('#chartContainer-segmentwise').jqxChart(chartSettings);

        // Ageing
        var data_source_ageing =
        {
            datatype: "json",
            datafields: [
            { name: 'stock_status' },
            { name: 'total_stock' },
            ],
            url: "<?php echo site_url('stock_records/get_ageingwise_stock')?>"
        };
        var ageing_dataAdapter = new $.jqx.dataAdapter(data_source_ageing, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + data_source_ageing.url + '" : ' + error); } });
          
        var agesettings = {
            title: "Ageingwise Stock",
            description: 'Total Vehicle Count Acc. Ageing',
            enableAnimations: true,
            showLegend: true,
            showBorderLine: false,
            legendPosition: { left: 520, top: 140, width: 100, height: 100 },
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: ageing_dataAdapter,
            colorScheme: 'scheme04',
            seriesGroups:
            [
            {
                type: 'donut',
                showLabels: true,
                series:
                [
                {
                    dataField: 'total_stock',
                    displayText: 'stock_status',
                    showLabels: true,
                    labelRadius: 160,
                    labelLinesEnabled: true,
                    labelLinesAngles: true,
                    labelsAutoRotate: true,
                    initialAngle: 0,
                    radius: 125,
                    offsetY: 170,
                    innerRadius: 50,
                    centerOffset: 0,
                    // formatSettings: { sufix: '%', decimalPlaces: 1 }
                }
                ]
            }
            ]
        };
        $('#chartContainer-ageing').jqxChart(agesettings);

    }

</script>