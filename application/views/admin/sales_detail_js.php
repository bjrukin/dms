<style type="text/css">
.pipeline{
  color: black !important;
  background-color: #adfd79 !important;
}

.order{
  color: black !important;
  background-color: #FFE4C4 !important;
}

.enquiry_status{
  color: black !important;
  background-color: #FFE4E1 !important;
}

.customer_type{
  color: black !important;
  background-color: #FAF0E6 !important;
}
</style>
  
<script type="text/javascript">
    var dealer_array_list = null;
    $(function () {

        var url = "<?php echo site_url('stock_records/sales_status')?>";
        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'vehicle_name', type: 'string' },
                // { name: 'variant_name', type: 'string' },
                // { name: 'color_name', type: 'string' },
                // { name: 'today', type: 'number' },
                { name: 'booked', type: 'number' },
                { name: 'confirmed', type: 'number' },
                { name: 'Pending', type: 'number' },
                { name: 'retail', type: 'number' },
                { name: 'closed', type: 'number' },
                { name: 'Dispatched', type: 'number' },
                { name: 'Accepted', type: 'number' },
                { name: 'Pending', type: 'number' },
                { name: 'Conversion', type: 'number' },
                { name: 'Hot', type: 'number' },
                { name: 'Lost', type: 'number' },
                { name: 'First Time Buyer', type: 'number' },
                { name: 'Additional Buyer', type: 'number' },
                { name: 'Exchange', type: 'number' },
                { name: 'order_pending', type: 'number' },
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#customer_status").jqxGrid(
        {
            width: '100%',
            // pageable: true,
            pagerButtonsCount: 15,
            source: dataAdapter,
            columnsResize: true,
            showAggregates: true,
            showstatusbar: true,
            statusbarheight: 50,
            // filterable: true,
            // sortable: true,
            columns: [
              { text: 'Model', dataField: 'vehicle_name', width: 150, pinned: true, filtertype: 'checkedlist' },
              // { text: 'Variant', dataField: 'variant_name', width: 150, pinned: true, filtertype: 'checkedlist' },
              // { text: 'Color', dataField: 'color_name', width: 200, pinned: true, filtertype: 'checkedlist' },
              // { text: 'New Inquiry', dataField: 'today', width: 100, aggregates: ['sum'] },
              { text: 'Booked', columngroup: 'pipeline_status', dataField: 'booked', width: 100, aggregates: ['sum'],
                cellclassname: 'pipeline',
              },
              { text: 'Confirmed', columngroup: 'pipeline_status', dataField: 'confirmed', width: 100, aggregates: ['sum'], cellclassname: 'pipeline',},
              { text: 'Pending', columngroup: 'pipeline_status', dataField: 'Pending', width: 100, aggregates: ['sum'], cellclassname: 'pipeline', },
              { text: 'Retail', columngroup: 'pipeline_status', dataField: 'retail', width: 100, aggregates: ['sum'], cellclassname: 'pipeline', },
              { text: 'Closed', columngroup: 'pipeline_status', dataField: 'closed', width: 100, aggregates: ['sum'], cellclassname: 'pipeline', },
              { text: 'Dispatched', columngroup: 'order_status', dataField: 'Dispatched', width: 100, aggregates: ['sum'], cellclassname: 'order', },
              { text: 'Accepted', columngroup: 'order_status', dataField: 'Accepted', width: 100, aggregates: ['sum'], cellclassname: 'order', },
              { text: 'Order Pending', columngroup: 'order_status', dataField: 'order_pending', width: 100, aggregates: ['sum'], cellclassname: 'order', },
              { text: 'Conversion', columngroup: 'enquiry_status', dataField: 'Conversion', width: 100, cellclassname: 'enquiry_status',  },
              { text: 'Hot', columngroup: 'enquiry_status', dataField: 'Hot', width: 100, aggregates: ['sum'], cellclassname: 'enquiry_status', },
              { text: 'Lost', columngroup: 'enquiry_status', dataField: 'Lost', width: 100, aggregates: ['sum'], cellclassname: 'enquiry_status', },
              { text: 'First Time Buyer', columngroup: 'customer_status', dataField: 'First Time Buyer', width: 100, aggregates: ['sum'] , cellclassname: 'customer_type',},
              { text: 'Additional Buyer', columngroup: 'customer_status', dataField: 'Additional Buyer', width: 100, aggregates: ['sum'], cellclassname: 'customer_type', },
              { text: 'Exchange', columngroup: 'customer_status', dataField: 'Exchange', width: 100, aggregates: ['sum'], cellclassname: 'customer_type', },
          ],
          columngroups: [
              { text: 'Pipeline Status', align: 'center', name: 'pipeline_status'},
              { text: 'Order Status', align: 'center', name: 'order_status'},
              { text: 'Enquiry Status', align: 'center', name: 'enquiry_status'},
              { text: 'Customer Status', align: 'center', name: 'customer_status'},
          ]
        });

       /* url = "<?php echo site_url('stock_records/dashboard_stack_json')?>";
        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'location', type: 'string' },
                { name: 'bill', type: 'string' },
                { name: 'monthly_bill', type: 'number' },
                { name: 'retail', type: 'number' },
                { name: 'monthly_retail', type: 'number' },
                { name: 'stock', type: 'number' },
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#dealer_stock_position_table").jqxGrid(
        {
            width: '100%',
            // pageable: true,
            pagerButtonsCount: 15,
            source: dataAdapter,
            columnsResize: true,
            showAggregates: true,
            showstatusbar: true,
                statusbarheight: 50,
            columns: [
              { text: 'Dealers', dataField: 'location', width: 150 },
              { text: 'Today', dataField: 'bill', width: 150, aggregates: ['sum'] },
              { text: 'Month', dataField: 'monthly_bill', width: 150, aggregates: ['sum'] },
              { text: 'Today', dataField: 'retail', width: 150, aggregates: ['sum'] },
              { text: 'Month', dataField: 'monthly_retail', width: 150, aggregates: ['sum'] },
              { text: 'Today\'s Stock', dataField: 'stock', width: 150, aggregates: ['sum'] },
              
          ],
        });*/

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
            checkboxes:true,

        }).on('checkChange',function(event){
            var items = $(this).jqxComboBox('getCheckedItems');
            var array = [];
            $.each(items, function(key, value){ 
              array.push(value.value)
            });

            source.data = {items:array};
            source.type = 'POST';

            var sourceAdaptor = new $.jqx.dataAdapter(source);

            $('#customer_status').jqxGrid({source:sourceAdaptor});

            // return;
        });


    });

    /**
    * for pie chart
    */

    /*$.post('<?php echo site_url()?>stock_records/stock_summary', null, function(data){
            // var PieData = [{
            //             value: 700,
            //             color: "#f56954",
            //             highlight: "#f56954",
            //             label: "Chrome"
            // }];
            // console.log(PieData);

            var obj = [];//JSON.parse(PieData);
            $.each(data, function( index, value ) {
            
                obj.push({"value": value.count, "color": '#'+value.count, "hihghlight": '#'+value.count, label: value.location});

                $('#chart_detail').append('<li><a href="#">' + value.location + '<span class="pull-right">' + value.count + '</span></a></li>');
                
            });
            PieData = obj;
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var pieOptions = {
              //Boolean - Whether we should show a stroke on each segment
              segmentShowStroke: true,
              //String - The colour of each segment stroke
              segmentStrokeColor: "#fff",
              //Number - The width of each segment stroke
              segmentStrokeWidth: 2,
              //Number - The percentage of the chart that we cut out of the middle
              percentageInnerCutout: 50, // This is 0 for Pie charts
              //Number - Amount of animation steps
              animationSteps: 10,
              //String - Animation easing effect
              animationEasing: "easeOutBounce",
              //Boolean - Whether we animate the rotation of the Doughnut
              animateRotate: true,
              //Boolean - Whether we animate scaling the Doughnut from the centre
              animateScale: false,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true,
              // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: true,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);
    }, 'json');*/
</script>
<script type="text/javascript">
  /*current stock*/
  $.ajax({
        type: "POST",
        url: '<?php echo site_url("stock_records/dashboard_stack_json"); ?>',
        // data: data,
        dataType: 'json',
        success: function (result) {
            // console.log(result.success);
            // var result = eval('('+result+')');
            if (result.success && result.total > 1) {
                 $("#report-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",
                    rows: ["Dealer Name"],
                    cols: ["Status"],
                });
                $('#report-table-box').show();
                $('#jqxButtonCopyToClipboard').show();
            } else {
                $('#report-table-box').hide();
                $('#jqxButtonCopyToClipboard').hide();
              alert('No Records for generating Reports');
            }
            //$('.content-wrapper').unblock();
        }
    });

    /*billing record*/
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("stock_records/dashboard_billing_json"); ?>',
        // data: data,
        dataType: 'json',
        success: function (result) {
            // console.log(result.success);
            // var result = eval('('+result+')');
            if (result.success && result.total > 1) {
                 $("#report-billing-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",
                    rows: ["Dealer Name"],
                    cols: ["Month"],
                });
                $('#report-billing-table-box').show();
                $('#jqxButtonCopyToClipboard').show();
            } else {
                $('#report-billing-table-box').hide();
                $('#jqxButtonCopyToClipboard').hide();
              alert('No Records for generating Reports');
            }
            //$('.content-wrapper').unblock();
        }
    });

    /*retail record*/
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("stock_records/dashboard_retail_json"); ?>',
        // data: data,
        dataType: 'json',
        success: function (result) {
            // console.log(result.success);
            // var result = eval('('+result+')');
            if (result.success && result.total > 1) {
                 $("#report-retail-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",
                    rows: ["Dealer Name"],
                    cols: ["Month"],
                });
                $('#report-retail-table-box').show();
                $('#jqxButtonCopyToClipboard').show();
            } else {
                $('#report-retail-table-box').hide();
                $('#jqxButtonCopyToClipboard').hide();
              alert('No Records for generating Reports');
            }
            //$('.content-wrapper').unblock();
        }
    });

    /*inquiry record*/
    /*$.ajax({
        type: "POST",
        url: '<?php echo site_url("stock_records/dashboard_inquiry_json"); ?>',
        // data: data,
        dataType: 'json',
        success: function (result) {
            // console.log(result.success);
            // var result = eval('('+result+')');
            if (result.success && result.total > 1) {
                 $("#report-inquiry-table").pivotUI(result.data, {
                    aggregatorName: "Count",
                    rendererName: "Table",
                    rows: ["Dealer Name"],
                    cols: ["Month"],
                });
                $('#report-inquiry-table-box').show();
                $('#jqxButtonCopyToClipboard').show();
            } else {
                $('#report-inquiry-table-box').hide();
                $('#jqxButtonCopyToClipboard').hide();
              alert('No Records for generating Reports');
            }
            //$('.content-wrapper').unblock();
        }
    });*/
</script>