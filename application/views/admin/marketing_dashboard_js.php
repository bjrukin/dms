<script type="text/javascript">

	$(document).ready(function () {
		var url = "<?php echo site_url('admin/crm-reports/modelwise_status')?>";

            // prepare the data
            var modelwise_status_source =
            {
            	datatype: "json",
            	datafields:
            	[
            	{ name: 'model', type: 'string' },
            	{ name: 'referral', type: 'number' },
            	{ name: 'walk_in', type: 'number' },
            	{ name: 'generated', type: 'number' },
            	{ name: 'referral_conv', type: 'number' },
            	{ name: 'walk_in_conv', type: 'number' },
            	{ name: 'generated_conv', type: 'number' },
            	],
            	id: 'id',
            	url: url,
            	updaterow: function (rowid, rowdata) {
                    // synchronize with the server - send update command   
                 }
              };
              var modelwise_status_dataAdapter = new $.jqx.dataAdapter(modelwise_status_source);
            // initialize jqxGrid
            $("#modelwise_grid").jqxGrid(
            {
            	width: '100%',
            	height: 535,
            	source: modelwise_status_dataAdapter,
            	sortable: true,
            	filterable: true,
            	columnsresize: true,
            	altrows: true,
            	columns: [
            	{ text: 'Model', datafield: 'model', width: 160 },
            	{ text: 'Referral', datafield: 'referral', width: 130 },
            	{ text: 'Converted(%)', datafield: 'referral_conv', width: 130 },
            	{ text: 'Walk In', datafield: 'walk_in', width: 130 },
            	{ text: 'Converted(%)', datafield: 'walk_in_conv', width: 130 },
            	{ text: 'Generated', datafield: 'generated', width: 130 },
            	{ text: 'Converted(%)', datafield: 'generated_conv', width: 130 },
            	]
            });

            var url_dealer = "<?php echo site_url('admin/crm-reports/dealerwise_status')?>";

            // prepare the data
            var dealerwise_source =
            {
            	datatype: "json",
            	datafields:
            	[
            	{ name: 'dealer', type: 'string' },
            	{ name: 'referral', type: 'number' },
            	{ name: 'walk_in', type: 'number' },
            	{ name: 'generated', type: 'number' },
            	{ name: 'referral_conv', type: 'number' },
            	{ name: 'walk_in_conv', type: 'number' },
            	{ name: 'generated_conv', type: 'number' },
            	],
            	id: 'id',
            	url: url_dealer,
            	updaterow: function (rowid, rowdata) {
                    // synchronize with the server - send update command   
                 }
              };
              var dealerwise_dataAdapter = new $.jqx.dataAdapter(dealerwise_source);
            // initialize jqxGrid
            $("#dealerwise_grid").jqxGrid(
            {
            	width: '100%',
            	height: 810,
            	source: dealerwise_dataAdapter,
            	sortable: true,
            	filterable: true,
            	columnsresize: true,
            	altrows: true,
            	columns: [
            	{ text: 'Dealer', datafield: 'dealer', width: 260 },
            	{ text: 'Referral', datafield: 'referral', width: 70 },
            	{ text: 'Converted(%)', datafield: 'referral_conv', width: 100 },
            	{ text: 'Walk In', datafield: 'walk_in', width: 70 },
            	{ text: 'Converted(%)', datafield: 'walk_in_conv', width: 100 },
            	{ text: 'Generated', datafield: 'generated', width: 80 },
            	{ text: 'Converted(%)', datafield: 'generated_conv', width: 100 },
            	]
            });

            var source_type = ['Referral','Generated','Walk-In'];

            $.each(source_type,function(i,v)
            {
               var inquiry_source =
               {
                  datatype: "json",
                  datafields: [
                  { name: 'inquiry_month' },
                  { name: 'total_inquiry' },
                  { name: 'converted' },
                  ],
                  data : {source_type:v},
                  url: "<?php echo site_url('stock_records/get_dashboard_inquiry_trend') ?>"
               };


               var inquirydataAdapter = new $.jqx.dataAdapter(inquiry_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
                  // prepare jqxChart settings
                  var settings = {
                     title: v,
                     description: false,
                     enableAnimations: true,
                     showLegend: true,
                     padding: { left: 10, top: 5, right: 10, bottom: 5 },
                     titlePadding: { left: 50, top: 0, right: 0, bottom: 10 },
                     source: inquirydataAdapter,
                     xAxis:
                     {
                       dataField: 'inquiry_month',
                       type: 'basic',
                       // baseUnit: 'month',
                       valuesOnTicks: true,
                       tickMarks: {
                        visible: true,
                        interval: 1,
                        color: '#BCBCBC'
                     },
                     unitInterval: 1,
                     gridLines: {
                        visible: true,
                        interval: 3,
                        color: '#BCBCBC'
                     },
                     labels: {
                        angle: -45,
                        rotationPoint: 'topright',
                        offset: { x: 0, y: -25 }
                     }
                  },
                  valueAxis:
                  {
                    visible: true,
                    title: { text: 'Unit' },
                    tickMarks: { color: '#BCBCBC' }
                 },
                 colorScheme: 'scheme04',
                 seriesGroups:
                 [
                 {
                   type: 'line',
                   series: [
                   { dataField: 'total_inquiry', displayText: 'Inquiry' },
                   { dataField: 'converted', displayText: 'Converted' }
                   ]
                }
                ]
             };
         // setup the chart
         $('#'+v+'_inquirytrend').css('height', 350);
         $('#'+v+'_inquirytrend').css('width', '100%');
         $('#'+v+'_inquirytrend').jqxChart(settings); 
      });
         });
      </script>