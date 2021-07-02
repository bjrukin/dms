<script type="text/javascript">
  $(function () {

    var url = "<?php echo site_url('stock_records/stock_position')?>";
        // prepare the data
        var source =
        {
          dataType: "json",
          dataFields: [
          { name: 'vehicle_name', type: 'string' },
          { name: 'variant_name', type: 'string' },
          { name: 'bill_count', type: 'number' },
          { name: 'bill_monthly_count', type: 'number' },
          { name: 'retail_count', type: 'number' },
          { name: 'retail_monthly_count', type: 'number' },
          <?php 
          // foreach ($stock_yards as $key => $value) {
          //   echo "{ name: '".$value['name']."', type: 'number' },";
          // }
          ?>
          { name: 'Kathmandu', type: 'number' },
          { name: 'display_count', type: 'number' },
          { name: 'Birgunj', type: 'number' },
          { name: 'Bhairawa', type: 'number' },
          { name: 'GRP CUSTOMS', type: 'number' },
          { name: 'RXL CUSTOMS', type: 'number' },
          { name: 'RXL STOCKYARD', type: 'number' },
          { name: 'GRP STOCKYARD', type: 'number' },
          { name: 'transit_count', type: 'number' },
          { name: 'pending_count', type: 'number' },
          { name: 'total', type: 'number'},
          { name: 'damage_count', type: 'number' },
          ],
          id: 'id',
          url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#stock_position_table").jqxGrid(
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
            { text: 'Model', dataField: 'vehicle_name', width: 150, pinned: true },
            { text: 'Variant', dataField: 'variant_name', width: 150, pinned: true },
            <?php 
            // foreach ($stock_yards as $key => $value) {
            //   echo "{ text: '".$value['name']."', columngroup: 'stockposition', dataField: '".$value['name']."', width: 100, aggregates: ['sum'] },";
            // }
            ?>
            { text: 'Kathmandu Stock', columngroup: 'stockposition', dataField: 'Kathmandu', width: 150, aggregates: ['sum'] },
            { text: 'Display', columngroup: 'stockposition', dataField: 'display_count', width: 100, aggregates: ['sum'] },
            { text: 'Damage', columngroup: 'stockposition', dataField: 'damage_count', width: 100, aggregates: ['sum'] },
            { text: 'Birgunj', columngroup: 'stockposition', dataField: 'Birgunj', width: 100, aggregates: ['sum'] },
            { text: 'Bhairawa', columngroup: 'stockposition', dataField: 'Bhairawa', width: 100, aggregates: ['sum'] },
            { text: 'GRP STOCKYARD', columngroup: 'stockposition', dataField: 'GRP STOCKYARD', width: 130, aggregates: ['sum'] },
            { text: 'RXL STOCKYARD', columngroup: 'stockposition', dataField: 'RXL STOCKYARD', width: 130, aggregates: ['sum'] },
            { text: 'GRP Custom', columngroup: 'stockposition', dataField: 'GRP CUSTOMS', width: 100, aggregates: ['sum'] },
            { text: 'Rxl custom', columngroup: 'stockposition', dataField: 'RXL CUSTOMS', width: 100, aggregates: ['sum'] },
            { text: 'Transit', columngroup: 'stockposition', dataField: 'transit_count', width: 100, aggregates: ['sum'] },
            { text: 'Total', columngroup: 'stockposition', dataField: 'total', width: 100,  
            cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties,rowdata) {
                  var Kathmandu = parseFloat((rowdata.hasOwnProperty("Kathmandu"))?rowdata.Kathmandu:0);
                  var Birgunj = parseFloat((rowdata.hasOwnProperty("Birgunj"))?rowdata.Birgunj:0);
                  var Bhairawa = parseFloat((rowdata.hasOwnProperty("Bhairawa"))?rowdata.Bhairawa:0);
                  var transit_count = parseFloat((rowdata.hasOwnProperty("transit_count"))?rowdata.transit_count:0);
                  var display_count = parseFloat((rowdata.hasOwnProperty("display_count"))?rowdata.display_count:0);
                  var damage_count = parseFloat((rowdata.hasOwnProperty("damage_count"))?rowdata.damage_count:0);
                  var rxl_stockyard = parseFloat((rowdata.hasOwnProperty("RXL STOCKYARD"))?(rowdata["RXL STOCKYARD"]):0);
                  var grp_stockyard = parseFloat((rowdata.hasOwnProperty("GRP STOCKYARD"))?(rowdata["GRP STOCKYARD"]):0);
                  var grp_custom = parseFloat((rowdata.hasOwnProperty("GRP CUSTOMS"))?(rowdata["GRP CUSTOMS"]):0);
                  var rxl_custom = parseFloat((rowdata.hasOwnProperty("RXL CUSTOMS"))?(rowdata["RXL CUSTOMS"]):0);
                  var total = (isNaN(Kathmandu)?0:Kathmandu) + (isNaN(Birgunj)?0:Birgunj) + (isNaN(Bhairawa)?0:Bhairawa) + (isNaN(transit_count)?0:transit_count) + (isNaN(display_count)?0:display_count) + (isNaN(damage_count)?0:damage_count)   + (isNaN(grp_custom)?0:grp_custom) + (isNaN(rxl_custom)?0:rxl_custom) + (isNaN(grp_stockyard)?0:grp_stockyard) + (isNaN(rxl_stockyard)?0:rxl_stockyard);
                  return "<div style='margin:4px;' class='jqx-right-align'>" + total + "</div>"
                }, 
                aggregates: [{ 'Sum':
                function (aggregatedValue, currentValue, column, record) {
                  var Kathmandu = parseFloat((record.hasOwnProperty("Kathmandu"))?record.Kathmandu:0);
                  var Birgunj = parseFloat((record.hasOwnProperty("Birgunj"))?record.Birgunj:0);
                  var Bhairawa = parseFloat((record.hasOwnProperty("Bhairawa"))?record.Bhairawa:0);
                  var transit_count = parseFloat((record.hasOwnProperty("transit_count"))?record.transit_count:0);
                  var display_count = parseFloat((record.hasOwnProperty("display_count"))?record.display_count:0);
                  var damage_count = parseFloat((record.hasOwnProperty("damage_count"))?record.damage_count:0);
                  var rxl_stockyard = parseFloat((record.hasOwnProperty("RXL STOCKYARD"))?(record["RXL STOCKYARD"]):0);
                  var grp_stockyard = parseFloat((record.hasOwnProperty("GRP STOCKYARD"))?(record["GRP STOCKYARD"]):0);
                  var grp_custom = parseFloat((record.hasOwnProperty("GRP CUSTOMS"))?(record["GRP CUSTOMS"]):0);
                  var rxl_custom = parseFloat((record.hasOwnProperty("RXL CUSTOMS"))?(record["RXL CUSTOMS"]):0);
                  var row_total = (isNaN(Kathmandu)?0:Kathmandu) + (isNaN(Birgunj)?0:Birgunj) + (isNaN(Bhairawa)?0:Bhairawa) + (isNaN(transit_count)?0:transit_count)  +  (isNaN(display_count)?0:display_count) +  (isNaN(damage_count)?0:damage_count) + (isNaN(grp_custom)?0:grp_custom)  + (isNaN(rxl_custom)?0:rxl_custom)  + (isNaN(rxl_stockyard)?0:rxl_stockyard) + (isNaN(grp_stockyard)?0:grp_stockyard);
                  var total = parseInt(row_total);
                  return aggregatedValue + total;
                }
              }]                  
            },
            { text: 'MSIL Pending', columngroup: 'stockposition', dataField: 'pending_count', width: 100, aggregates: ['sum']},
            { text: 'Saleable Stock', columngroup: 'stockposition', width: 150,  
            cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties,rowdata) {
              var Kathmandu = parseFloat((rowdata.hasOwnProperty("Kathmandu"))?rowdata.Kathmandu:0);
              var Birgunj = parseFloat((rowdata.hasOwnProperty("Birgunj"))?rowdata.Birgunj:0);
              var Bhairawa = parseFloat((rowdata.hasOwnProperty("Bhairawa"))?rowdata.Bhairawa:0);
              var total = Kathmandu + Birgunj + Bhairawa;
              return "<div style='margin:4px;' class='jqx-right-align'>" + total + "</div>"
            }, 
            aggregates: [{ 'Sum':
            function (aggregatedValue, currentValue, column, record) {
              var Kathmandu = parseFloat((record.hasOwnProperty("Kathmandu"))?record.Kathmandu:0);
              var Birgunj = parseFloat((record.hasOwnProperty("Birgunj"))?record.Birgunj:0);
              var Bhairawa = parseFloat((record.hasOwnProperty("Bhairawa"))?record.Bhairawa:0);
              var row_total = Kathmandu + Birgunj + Bhairawa;
              var total = parseInt(row_total);
              return aggregatedValue + total;
            }
          }]                  
        },

        ],
        columngroups: [
        { text: 'Billing', align: 'center', name: 'billing'},
        { text: 'Retail', align: 'center', name: 'retail'},
        { text: 'Stock Postition', align: 'center', name: 'stockposition'},
        ]
      });

url = "<?php echo site_url('stock_records/dealership_position/'.$active_fiscal)?>";
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
          { name: 'bill_tilldate', type: 'number' },
          { name: 'retail_tilldate', type: 'number' },
          { name: 'stock', type: 'number'}
          ],
          id: 'id',
          url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#dealership_position").jqxGrid(
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
            { text: 'Dealers', dataField: 'location', width: 230 },
            { text: 'Today', dataField: 'bill', width: 120, columngroup: 'billing', aggregates: ['sum'] },
            { text: 'Month', dataField: 'monthly_bill', width: 120, columngroup: 'billing', aggregates: ['sum'] },
            { text: 'Tilldate', dataField: 'bill_tilldate', width: 120, columngroup: 'billing', aggregates: ['sum'] },
            { text: 'Today', dataField: 'retail', width: 120, columngroup: 'retail', aggregates: ['sum'] },
            { text: 'Month', dataField: 'monthly_retail', width: 120, columngroup: 'retail', aggregates: ['sum'] },
            { text: 'Tilldate', dataField: 'retail_tilldate', width: 120, columngroup: 'retail', aggregates: ['sum'] },
            { text: 'Today\'s Stock', dataField: 'stock', width: 150, columngroup: 'stockposition', aggregates: ['sum'] }              
            ],
            columngroups: [
            { text: 'Bill', align: 'center', name: 'billing'},
            { text: 'Retail', align: 'center', name: 'retail'},
            ]
          });
        /*
        * billing record
        */
        url = "<?php echo site_url('stock_records/billing_record/'.$active_fiscal)?>";
        // prepare the data
        var sourceBilling =
        {
          dataType: "json",
          dataFields: [
          { name: 'VEHICLE', type: 'string' },
          //{ name: 'VARIANT', type: 'string' },
          { name: '4', type: 'number' },
          { name: '5', type: 'number' },
          { name: '6', type: 'number' },
          { name: '7', type: 'number' },
          { name: '8', type: 'number' },
          { name: '9', type: 'number' },
          { name: '10', type: 'number' },
          { name: '11', type: 'number' },
          { name: '12', type: 'number' },
          { name: '1', type: 'number' },
          { name: '2', type: 'number' },
          { name: '3', type: 'number' },
          { name: 'total', type: 'number' },
                // { name: 'retail', type: 'number' },
                // { name: 'monthly_retail', type: 'number' },
                ],
                id: 'id',
                url: url
              };
              var dataAdapterBilling = new $.jqx.dataAdapter(sourceBilling);
              $("#billing_record").jqxGrid(
              {
                width: '100%',
            // pageable: true,
            pagerButtonsCount: 15,
            source: dataAdapterBilling,
            columnsResize: true,
            showAggregates: true,
            showstatusbar: true,
            statusbarheight: 50,
            columns: [
            { text: 'Vehicle', dataField: 'VEHICLE', width: 150, pinned: true },
            //{ text: 'Variant', dataField: 'VARIANT', width: 150, pinned: true },
            { text: 'Shrawan', dataField: '4', width: 100, aggregates: ['sum'] },
            { text: 'Bhadhra', dataField: '5', width: 100, aggregates: ['sum'] },
            { text: 'Ashoj', dataField: '6', width: 100, aggregates: ['sum'] },
            { text: 'Kartik', dataField: '7', width: 100, aggregates: ['sum'] },
            { text: 'Mangshir', dataField: '8', width: 100, aggregates: ['sum'] },
            { text: 'Poush', dataField: '9', width: 100, aggregates: ['sum'] },
            { text: 'Magh', dataField: '10', width: 100, aggregates: ['sum'] },
            { text: 'Falgun', dataField: '11', width: 100, aggregates: ['sum'] },
            { text: 'Chaitra', dataField: '12', width: 100, aggregates: ['sum'] },
            { text: 'Baishak', dataField: '1', width: 100, aggregates: ['sum'] },
            { text: 'Jestha', dataField: '2', width: 100, aggregates: ['sum'] },
            { text: 'Ashad', dataField: '3', width: 100, aggregates: ['sum'] },
            { text: 'Total', dataField: 'total', width: 100, aggregates: ['sum'],
          },
          ],
          columngroups: [
          { text: 'Bill', align: 'center', name: 'billing'},
          { text: 'Retail', align: 'center', name: 'retail'},
          ]
        });

        /*
        * retail record
        */
        url = "<?php echo site_url('stock_records/retail_record/'.$active_fiscal)?>";
        // prepare the data
        var sourceBilling =
        {
          dataType: "json",
          dataFields: [
          { name: 'VEHICLE', type: 'string' },
          //{ name: 'VARIANT', type: 'string' },
          { name: '4', type: 'number' },
          { name: '5', type: 'number' },
          { name: '6', type: 'number' },
          { name: '7', type: 'number' },
          { name: '8', type: 'number' },
          { name: '9', type: 'number' },
          { name: '10', type: 'number' },
          { name: '11', type: 'number' },
          { name: '12', type: 'number' },
          { name: '1', type: 'number' },
          { name: '2', type: 'number' },
          { name: '3', type: 'number' },
          { name: 'total', type: 'number' },
                // { name: 'retail', type: 'number' },
                // { name: 'monthly_retail', type: 'number' },
                ],
                id: 'id',
                url: url
              };
              var dataAdapterRetail = new $.jqx.dataAdapter(sourceBilling);
              $("#retail_record").jqxGrid(
              {
                width: '100%',
            // pageable: true,
            pagerButtonsCount: 15,
            source: dataAdapterRetail,
            columnsResize: true,
            showAggregates: true,
            showstatusbar: true,
            statusbarheight: 50,
            columns: [
            { text: 'Vehicle', dataField: 'VEHICLE', width: 150, pinned: true },
            //{ text: 'Variant', dataField: 'VARIANT', width: 150, pinned: true },
            { text: 'Shrawan', dataField: '4', width: 100, aggregates: ['sum'] },
            { text: 'Bhadhra', dataField: '5', width: 100, aggregates: ['sum'] },
            { text: 'Ashoj', dataField: '6', width: 100, aggregates: ['sum'] },
            { text: 'Kartik', dataField: '7', width: 100, aggregates: ['sum'] },
            { text: 'Mangshir', dataField: '8', width: 100, aggregates: ['sum'] },
            { text: 'Poush', dataField: '9', width: 100, aggregates: ['sum'] },
            { text: 'Magh', dataField: '10', width: 100, aggregates: ['sum'] },
            { text: 'Falgun', dataField: '11', width: 100, aggregates: ['sum'] },
            { text: 'Chaitra', dataField: '12', width: 100, aggregates: ['sum'] },
            { text: 'Baishak', dataField: '1', width: 100, aggregates: ['sum'] },
            { text: 'Jestha', dataField: '2', width: 100, aggregates: ['sum'] },
            { text: 'Ashad', dataField: '3', width: 100, aggregates: ['sum'] },
            { text: 'Total', dataField: 'total', width: 100, aggregates: ['sum'] },
            ],
            columngroups: [
            { text: 'Bill', align: 'center', name: 'billing'},
            { text: 'Retail', align: 'center', name: 'retail'},
            ]
          });

            });

    /**
    * for pie chart
    */

    $.post('<?php echo site_url()?>stock_records/stock_summary', null, function(data){

            var obj = [];//JSON.parse(PieData);
            $.each(data, function( index, value ) {

              obj.push({"value": value.count, "color": '#'+value.count, "hihghlight": '#'+value.count, label: value.title});

              $('#chart_detail').append('<li><a href="#">' + value.title + '<span class="pull-right">' + value.count + '</span></a></li>');
              
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
          }, 'json');

    // for sell chart
    
    // this year
            $.post('<?php echo site_url()?>stock_records/retail_chart_record/false/<?php echo $active_fiscal?>', null, function(data){
              var obj = [];//JSON.parse(PieData);

              $.each(data, function( index, value ) {

                obj.push({"month": value.month, "retail": value.retail, "last_year_retail": value.last_year_retail});

                // $('#chart_detail').append('<li><a href="#">' + value.title + '<span class="pull-right">' + value.count + '</span></a></li>');
                
              });


              // prepare jqxChart settings
              var settings = {
                  title: "Retail",
                  description: "",
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 5, top: 5, right: 5, bottom: 5 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: obj, // data,//sampleData,
                  xAxis:
                      {
                          dataField: 'month',
                          showGridLines: true
                      },
                  colorScheme: 'scheme01',
                  seriesGroups:
                      [
                          {
                              type: 'line',
                              columnsGapPercent: 50,
                              seriesGapPercent: 0,
                              valueAxis:
                              {
                                  unitInterval: 100,
                                  minValue: 0,
                                  // maxValue: 10000,
                                  displayValueAxis: true,
                                  description: 'Quantity',
                                  axisSize: 'auto',
                                  tickMarksColor: '#888888'
                              },
                              series: [
                                      { dataField: 'retail', displayText: 'This Year'},
                                      { dataField: 'last_year_retail', displayText: 'Last Year'},
                                      // { dataField: 'Erica', displayText: 'Erica'},
                                  ]
                          }
                      ]
              };
              
              // setup the chart
              $('#sales_graph').jqxChart(settings);
            },'json');

          // end for this year
          // last year
          $.post('<?php echo site_url()?>stock_records/billing_chart_record/false/<?php echo $active_fiscal?>', null, function(data){
              var obj = [];//JSON.parse(PieData);

              $.each(data, function( index, value ) {

                obj.push({"month": value.month, "billing": value.billing, "last_year_billing": value.last_year_billing});

                // $('#chart_detail').append('<li><a href="#">' + value.title + '<span class="pull-right">' + value.count + '</span></a></li>');
                
              });

              // prepare jqxChart settings
              var settings = {
                  title: "Bill",
                  description: "",
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 5, top: 5, right: 5, bottom: 5 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: obj,//data,//sampleData,
                  xAxis:
                      {
                          dataField: 'month',
                          showGridLines: true
                      },
                  colorScheme: 'scheme01',
                  seriesGroups:
                      [
                          {
                              type: 'line',
                              columnsGapPercent: 50,
                              seriesGapPercent: 0,
                              valueAxis:
                              {
                                  unitInterval: 100,
                                  minValue: 0,
                                  // maxValue: 10000,
                                  displayValueAxis: true,
                                  description: 'Quantity',
                                  axisSize: 'auto',
                                  tickMarksColor: '#888888'
                              },
                              series: [
                                  { dataField: 'billing', displayText: 'This Year'},
                                  { dataField: 'last_year_billing', displayText: 'Last Year'},
                                  // { dataField: 'Erica', displayText: 'Erica'},
                              ]
                          }
                      ]
              };
              
              // setup the chart
              $('#last_year_sales_graph').jqxChart(settings);
            },'json');


            
            // end of sell char

    /*
        * mfg year
        */
        url = "<?php echo site_url('stock_records/mfg_year_report_dashboard/'.$active_fiscal)?>";

        // prepare the data
        var sourceBilling =
        {
          dataType: "json",
          dataFields: [
          { name: 'Model', type: 'string' },
          <?php foreach ($mfg_year as $key => $value):
          echo "{ name: '".$value['year']."', type: 'number' },";
        endforeach;
        ?>
        ],
        id: 'id',
        url: url
      };
      var dataAdapterRetail = new $.jqx.dataAdapter(sourceBilling);
      $("#mgf_year").jqxGrid(
      {
        width: '100%',
        pagerButtonsCount: 15,
        source: dataAdapterRetail,
        columnsResize: true,
        showAggregates: true,
        showstatusbar: true,
        statusbarheight: 50,
        columns: [
        { text: 'Vehicle', dataField: 'Model', width: 200, pinned: true },
        <?php foreach ($mfg_year as $key => $value) {
          echo "{ text: '".$value['year']."', columngroup: 'stockposition', dataField: '".$value['year']."', width: 110, aggregates: ['sum'] },";
        }
        ?>
        ],
      });


      // var retail_request_Datasource =
      // {
      //   datatype: "json",
      //   datafields: [
      //   { name: 'vehicle_name', type: 'string' },
      //   { name: 'variant_name', type: 'string' },
      //   { name: 'color_code', type: 'string' },
      //   { name: 'total', type: 'number' },      

      //   ],
      //   url: '<?php echo site_url("admin/stock_records/get_retail_request_list");?>',
      //   pagesize: defaultPageSize,
      //   root: 'rows',
      //   id : 'id',
      // };


      // $("#retail_request").jqxGrid({
      //   width: '100%',
      //   pagerButtonsCount: 15,
      //   source: retail_request_Datasource,
      //   columnsResize: true,
      //   showAggregates: true,
      //   showstatusbar: true,
      //   statusbarheight: 50,
      //   columns: [
      //   { text: 'SN', width: 50, pinned: true,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer },
      //   { text: 'Vehicle Name',datafield: 'vehicle_name',width: 130, renderer: gridColumnsRenderer },
      //   { text: 'Variant Name',datafield: 'variant_name',width: 110, renderer: gridColumnsRenderer },
      //   { text: 'Color Code',datafield: 'color_code',width: 90, renderer: gridColumnsRenderer },
      //   { text: 'Total',datafield: 'total',width: 80, renderer: gridColumnsRenderer, aggregates: ['sum'] },
      //   ],
      //   rendergridrows: function (result) {
      //     return result.data;
      //   }
      // });

      // var dispatch_request_Datasource =
      // {
      //   datatype: "json",
      //   datafields: [
      //   { name: 'vehicle_name', type: 'string' },
      //   { name: 'variant_name', type: 'string' },
      //   { name: 'color_code', type: 'string' },
      //   { name: 'total', type: 'number' },      

      //   ],
      //   url: '<?php echo site_url("admin/stock_records/get_dispatch_request_list/".$active_fiscal);?>',
      //   pagesize: defaultPageSize,
      //   root: 'rows',
      //   id : 'id',
      // };


      // $("#dispatch_request").jqxGrid({
      //   width: '100%',
      //   pagerButtonsCount: 15,
      //   source: dispatch_request_Datasource,
      //   columnsResize: true,
      //   showAggregates: true,
      //   showstatusbar: true,
      //   statusbarheight: 50,
      //   columns: [
      //   { text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
      //   { text: 'Vehicle Name',datafield: 'vehicle_name',width: 130,filterable: true,renderer: gridColumnsRenderer },
      //   { text: 'Variant Name',datafield: 'variant_name',width: 110,filterable: true,renderer: gridColumnsRenderer },
      //   { text: 'Color Code',datafield: 'color_code',width: 90,filterable: true,renderer: gridColumnsRenderer },
      //   { text: 'Total',datafield: 'total',width: 80,filterable: true,renderer: gridColumnsRenderer, aggregates: ['sum'] },
      //   ],
      //   rendergridrows: function (result) {
      //     return result.data;
      //   }
      // });
    </script>
    <script type="text/javascript">
      /*current stock*/
      // $.ajax({
      //   type: "POST",
      //   url: '<?php echo site_url("stock_records/dashboard_clear_stock_json"); ?>',
      //   // data: data,
      //   dataType: 'json',
      //   success: function (result) {
      //       // console.log(result.success);
      //       // var result = eval('('+result+')');
      //       if (result.success && result.total > 1) {
      //        $("#clear-stock-table").pivotUI(result.data, {
      //         aggregatorName: "Count",
      //         rendererName: "Table",
      //         rows: ["Vehicle"],
      //         cols: ["Year"],
      //       });
      //        $('#clear-stock-table-box').show();
      //        $('#jqxButtonCopyToClipboard').show();
      //      } else {
      //       $('#clear-stock-table-box').hide();
      //       $('#jqxButtonCopyToClipboard').hide();
      //       alert('No Records for generating Reports');
      //     }
      //       //$('.content-wrapper').unblock();
      //     }
      //   });


      </script>