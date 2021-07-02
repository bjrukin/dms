<script type="text/javascript">
      var partial_sales = function()
      {
            // dealer combobox
            var dealerDataSource = {
                  url : base_url + 'admin/employees/get_dealers_combo_json',
                  datatype: 'json',
                  datafields: [
                  { name: 'id', type: 'number' },
                  { name: 'name', type: 'string' },
                  ],async: true,
                  cache: true
            }

            dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

            $(".dealer_list").jqxComboBox({
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

            // vehicle combobox
            $(".vehicle_list").jqxComboBox({
                  theme: theme,
                  width: 195,
                  height: 25,
                  selectionMode: 'dropDownList',
                  autoComplete: true,
                  searchMode: 'containsignorecase',
                  source: array_vehicles,
                  displayMember: "name",
                  valueMember: "id",
            });

            $('#dealer_search').on("click",function()
            {
                  var dealer_id = $('#dealer_id_bill').val();

                  if(dealer_id == 0)
                  {
                        var dealerwise_bill_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_bill' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              url: "<?php echo site_url('stock_records/get_bill_tar_act_all_dealer') ?>"
                        };

                  }
                  else
                  {
                        var dealerwise_bill_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_bill' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              data : {dealer_id:dealer_id},
                              url: "<?php echo site_url('stock_records/get_bill_tar_act_dealer') ?>"
                        };
                  }

                  var dealerwise_billdataAdapter = new $.jqx.dataAdapter(dealerwise_bill_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                  title: "Dealerwise",
                  description : false,
                  showLegend: true,
                  enableAnimations: true,
                  showBorderLine: false,
                  padding: { left: 5, top: 5, right: 5, bottom: 5 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: dealerwise_billdataAdapter,
                  xAxis:
                  {
                        dataField: 'month_name',
                        displayText: 'Month',
                        gridLines: { visible: true },
                        valuesOnTicks: false,
                       labels: {
                        angle: -45,
                        rotationPoint: 'topright',
                        offset: { x: 0, y: -25 }
                  }
            },
            colorScheme: 'scheme01',
            columnSeriesOverlap: false,
            seriesGroups:
            [
            {
                type: 'column',
                valueAxis:
                {
                     visible: true,
                     unitInterval: 25,
                              /*minValue: 0,
                              maxValue: 250,*/
                              title: { text: 'Value<br>' }
                        },
                        series: [
                        { dataField: 'total_target', displayText: 'Target' },
                        { dataField: 'total_bill', displayText: 'Billed' }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#dealerwise_bill').css('height', 350);
            $('#dealerwise_bill').css('width', '100%');
            $('#dealerwise_bill').jqxChart(settings); 
      });

            $('#vehicle_search').on("click",function()
            {     
                  var vehicle_id = $('#vehicle_id_bill').val();

                  if(vehicle_id == 0)
                  {
                        var modelwise_bill_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_bill' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              data : {vehicle_id:vehicle_id},
                              url: "<?php echo site_url('stock_records/get_bill_tar_act_all_model') ?>"
                        };
                  }
                  else
                  {
                        var modelwise_bill_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_bill' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              data : {vehicle_id:vehicle_id},
                              url: "<?php echo site_url('stock_records/get_bill_tar_act_model') ?>"
                        };
                  }
                  var modelwise_billdataAdapter = new $.jqx.dataAdapter(modelwise_bill_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Modelwise",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: modelwise_billdataAdapter,
                  colorScheme: 'scheme05',
                  xAxis: {
                        dataField: 'month_name',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                       labels: {
                        angle: -45,
                        rotationPoint: 'topright',
                        offset: { x: 0, y: -25 }
                  }
            },
            valueAxis: {
                unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_bill',
                              displayText: 'Bill',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#modelwise').css('height', 350);
            $('#modelwise').css('width', '100%');
            $('#modelwise').jqxChart(settings);
      });

            $('#dealer_search_retail').on("click",function()
            {
                  var dealer_id = $('#dealer_id_retail').val();

                  if(dealer_id == 0)
                  {
                        var dealerwise_retail_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_retail' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              url: "<?php echo site_url('stock_records/get_retail_tar_act_all_dealer') ?>"
                        };

                  }
                  else
                  {
                        var dealerwise_retail_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_retail' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              data : {dealer_id:dealer_id},
                              url: "<?php echo site_url('stock_records/get_retail_tar_act_dealer') ?>"
                        };
                  }

                  var dealerwise_retaildataAdapter = new $.jqx.dataAdapter(dealerwise_retail_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                  title: "Dealerwise",
                  description : false,
                  showLegend: true,
                  enableAnimations: true,
                  showBorderLine: false,
                  padding: { left: 5, top: 5, right: 5, bottom: 5 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: dealerwise_retaildataAdapter,
                  xAxis:
                  {
                        dataField: 'month_name',
                        displayText: 'Month',
                        gridLines: { visible: true },
                        valuesOnTicks: false,
                       labels: {
                        angle: -45,
                        rotationPoint: 'topright',
                        offset: { x: 0, y: -25 }
                  }
            },
            colorScheme: 'scheme01',
            columnSeriesOverlap: false,
            seriesGroups:
            [
            {
                type: 'column',
                valueAxis:
                {
                     visible: true,
                     unitInterval: 25,
                              /*minValue: 0,
                              maxValue: 250,*/
                              title: { text: 'Value<br>' }
                        },
                        series: [
                        { dataField: 'total_target', displayText: 'Target' },
                        { dataField: 'total_retail', displayText: 'Retail' }
                        ]
                  }
                  ]
            };
            // setup the chart
             $('#dealerwise_retail').css('height', 350);
            $('#dealerwise_retail').css('width', '100%');
            $('#dealerwise_retail').jqxChart(settings); 
      });

            $('#vehicle_search_retail').on("click",function()
            {     
                  var vehicle_id = $('#vehicle_id_retail').val();

                  if(vehicle_id == 0)
                  {
                        var modelwise_bill_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_retail' },
                              { name: 'nepali_month' },
                              { name: 'target_year' },
                              ],
                              data : {vehicle_id:vehicle_id},
                              url: "<?php echo site_url('stock_records/get_retail_tar_act_all_model') ?>"
                        };
                  }
                  else
                  {
                        var modelwise_bill_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_target' },
                              { name: 'total_retail' },
                              { name: 'nepali_month' },
                              { name: 'target_year' },
                              ],
                              data : {vehicle_id:vehicle_id},
                              url: "<?php echo site_url('stock_records/get_retail_tar_act_model') ?>"
                        };
                  }
                  var modelwise_billdataAdapter = new $.jqx.dataAdapter(modelwise_bill_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Modelwise",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: modelwise_billdataAdapter,
                  colorScheme: 'scheme05',
                  xAxis: {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                       labels: {
                        angle: -45,
                        rotationPoint: 'topright',
                        offset: { x: 0, y: -25 }
                  }
            },
            valueAxis: {
                unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_retail',
                              displayText: 'Retail',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#modelwise_retail').css('height', 350);
            $('#modelwise_retail').css('width', '100%');
            $('#modelwise_retail').jqxChart(settings);
      });

            var passenger_retail_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_retail' },
                  { name: 'nepali_month' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_retail_segmentwise/Passenger') ?>"
            };

            var passenger_retaildataAdapter = new $.jqx.dataAdapter(passenger_retail_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Passenger",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: passenger_retaildataAdapter,
                  colorScheme: 'scheme01',
                  xAxis: {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_retail',
                              displayText: 'Retail',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#passenger_retail').jqxChart(settings);

            var van_retail_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_retail' },
                  { name: 'nepali_month' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_retail_segmentwise/Van') ?>"
            };

            var van_retaildataAdapter = new $.jqx.dataAdapter(van_retail_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Van",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: van_retaildataAdapter,
                  colorScheme: 'scheme01',
                  xAxis: {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_retail',
                              displayText: 'Retail',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#van_retail').jqxChart(settings);

            // for utility Retail
            var utility_retail_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_retail' },
                  { name: 'nepali_month' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_retail_segmentwise/Utility') ?>"
            };

            var utility_retaildataAdapter = new $.jqx.dataAdapter(utility_retail_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Utility",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: utility_retaildataAdapter,
                  colorScheme: 'scheme01',
                  xAxis: {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_retail',
                              displayText: 'Retail',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#utility_retail').jqxChart(settings);
            // end utiluty Retail

            // for commercial
            var commercial_retail_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_retail' },
                  { name: 'nepali_month' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_retail_segmentwise/Commercial') ?>"
            };

            var commercial_retaildataAdapter = new $.jqx.dataAdapter(commercial_retail_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Commercial",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: commercial_retaildataAdapter,
                  colorScheme: 'scheme01',
                  xAxis: {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_retail',
                              displayText: 'Retail',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#commercial_retail').jqxChart(settings);
            //end for commercial

            // for hybrid
            var hybrid_retail_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_retail' },
                  { name: 'nepali_month' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_retail_segmentwise/Hybrid') ?>"
            };

            var hybrid_retaildataAdapter = new $.jqx.dataAdapter(hybrid_retail_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "hybrid",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: hybrid_retaildataAdapter,
                  colorScheme: 'scheme01',
                  xAxis: {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_retail',
                              displayText: 'Retail',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#hybrid_retail').jqxChart(settings);
            //end for hybrid

            var passenger_billing_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_bill' },
                  { name: 'month_name' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_billing_segmentwise/Passenger') ?>"
            };

            var passenger_billingdataAdapter = new $.jqx.dataAdapter(passenger_billing_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Passenger",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: passenger_billingdataAdapter,
                  colorScheme: 'scheme03',
                  xAxis: {
                        dataField: 'month_name',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_bill',
                              displayText: 'Billed',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#passenger_billing').jqxChart(settings);

            var van_billing_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_bill' },
                  { name: 'month_name' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_billing_segmentwise/Van') ?>"
            };

            var van_billingdataAdapter = new $.jqx.dataAdapter(van_billing_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Van",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: van_billingdataAdapter,
                  colorScheme: 'scheme03',
                  xAxis: {
                        dataField: 'month_name',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_bill',
                              displayText: 'Billed',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#van_billing').jqxChart(settings);// for utolity billing

            // for utility billing
            var utility_billing_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_bill' },
                  { name: 'month_name' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_billing_segmentwise/Utility') ?>"
            };

            var utility_billingdataAdapter = new $.jqx.dataAdapter(utility_billing_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Utility",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: utility_billingdataAdapter,
                  colorScheme: 'scheme03',
                  xAxis: {
                        dataField: 'month_name',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_bill',
                              displayText: 'Billed',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#utility_billing').jqxChart(settings);
            // end utility billing

            // for commercial billing
            var commercial_billing_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_bill' },
                  { name: 'month_name' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_billing_segmentwise/Commercial') ?>"
            };

            var commercial_billingdataAdapter = new $.jqx.dataAdapter(commercial_billing_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "Commercial",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: commercial_billingdataAdapter,
                  colorScheme: 'scheme03',
                  xAxis: {
                        dataField: 'month_name',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_bill',
                              displayText: 'Billed',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#commercial_billing').jqxChart(settings);
            // end commercial billing

            // for hybrid billing
            var hybrid_billing_source =
            {
                  datatype: "json",
                  datafields: [
                  { name: 'total_target' },
                  { name: 'total_bill' },
                  { name: 'month_name' },
                  { name: 'target_year' },
                  ],
                  url: "<?php echo site_url('stock_records/get_billing_segmentwise/Hybrid') ?>"
            };

            var hybrid_billingdataAdapter = new $.jqx.dataAdapter(hybrid_billing_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                  title: "hybrid",
                  description: false,
                  enableAnimations: true,
                  showLegend: true,
                  padding: { left: 10, top: 10, right: 15, bottom: 10 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: hybrid_billingdataAdapter,
                  colorScheme: 'scheme03',
                  xAxis: {
                        dataField: 'month_name',
                        displayText: 'Month',
                        unitInterval: 1,
                        tickMarks: { visible: true, interval: 1 },
                        gridLinesInterval: { visible: true, interval: 1 },
                        valuesOnTicks: false,
                        padding: { bottom: 10 },
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  valueAxis: {
                        unitInterval: 100,
                        /*minValue: 0,
                        maxValue: 1000,*/
                        title: { text: 'Value<br><br>' },
                        labels: { horizontalAlignment: 'right' }
                  },
                  seriesGroups:
                  [
                  {
                        type: 'line',
                        series:
                        [
                        {
                              dataField: 'total_target',
                              displayText: 'Target',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        },
                        {
                              dataField: 'total_bill',
                              displayText: 'Billed',
                              symbolType: 'square',
                              labels:
                              {
                                    visible: true,
                                    backgroundColor: '#FEFEFE',
                                    backgroundOpacity: 0.2,
                                    borderColor: '#7FC4EF',
                                    borderOpacity: 0.7,
                                    padding: { left: 5, right: 5, top: 0, bottom: 0 }
                              }
                        }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#hybrid_billing').jqxChart(settings);
            // end hybrid billing


            // Inquiry Target Vs Actual

            $('#dealer_search_inquiry').on("click",function()
            {
                  var dealer_id = $('#dealer_id_inquiry').val();

                  if(dealer_id == 0)
                  {
                        var dealerwise_inquiry_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_inquiry_target' },
                              { name: 'total_inquiry' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              url: "<?php echo site_url('stock_records/get_inquiry_tar_act_all_dealer') ?>"
                        };

                  }
                  else
                  {
                        var dealerwise_inquiry_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_inquiry_target' },
                              { name: 'total_inquiry' },
                              { name: 'month_name' },
                              { name: 'target_year' },
                              ],
                              data : {dealer_id:dealer_id},
                              url: "<?php echo site_url('stock_records/get_inquiry_tar_act_dealer') ?>"
                        };
                  }

                  var dealerwise_inquirydataAdapter = new $.jqx.dataAdapter(dealerwise_inquiry_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                  title: "Dealerwise",
                  description : false,
                  showLegend: true,
                  enableAnimations: true,
                  showBorderLine: false,
                  padding: { left: 5, top: 5, right: 5, bottom: 5 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: dealerwise_inquirydataAdapter,
                  xAxis:
                  {
                        dataField: 'month_name',
                        displayText: 'Month',
                        gridLines: { visible: true },
                        valuesOnTicks: false,
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  colorScheme: 'scheme03',
                  columnSeriesOverlap: false,
                  seriesGroups:
                  [
                  {
                        type: 'column',
                        valueAxis:
                        {
                              visible: true,
                              unitInterval: 100,
                              /*minValue: 0,
                              maxValue: 250,*/
                              title: { text: 'Value<br>' }
                        },
                        series: [
                        { dataField: 'total_inquiry_target', displayText: 'Target' },
                        { dataField: 'total_inquiry', displayText: 'Inquiry' }
                        ]
                  }
                  ]
            };
            // setup the chart
              $('#dealerwise_inquiry').css('height', 350);
            $('#dealerwise_inquiry').css('width', '100%');
            $('#dealerwise_inquiry').jqxChart(settings); 
      });


            $('#vehicle_search_inquiry').on("click",function()
            {
                  var vehicle_id = $('#vehicle_id_inquiry').val();

                  if(vehicle_id == 0)
                  {
                        var modelwise_inquiry_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_inquiry_target' },
                              { name: 'total_inquiry' },
                              { name: 'nepali_month' },
                              { name: 'target_year' },
                              ],
                              url: "<?php echo site_url('stock_records/get_inquiry_tar_act_all_model') ?>"
                        };

                  }
                  else
                  {
                        var modelwise_inquiry_source =
                        {
                              datatype: "json",
                              datafields: [
                              { name: 'total_inquiry_target' },
                              { name: 'total_inquiry' },
                              { name: 'nepali_month' },
                              { name: 'target_year' },
                              ],
                              data : {vehicle_id:vehicle_id},
                              url: "<?php echo site_url('stock_records/get_inquiry_tar_act_model') ?>"
                        };
                  }

                  var modelwise_inquirydataAdapter = new $.jqx.dataAdapter(modelwise_inquiry_source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                  title: "Modelwise",
                  description : false,
                  showLegend: true,
                  enableAnimations: true,
                  showBorderLine: false,
                  padding: { left: 5, top: 5, right: 5, bottom: 5 },
                  titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                  source: modelwise_inquirydataAdapter,
                  xAxis:
                  {
                        dataField: 'nepali_month',
                        displayText: 'Month',
                        gridLines: { visible: true },
                        valuesOnTicks: false,
                        labels: {
                              angle: -45,
                              rotationPoint: 'topright',
                              offset: { x: 0, y: -25 }
                        }
                  },
                  colorScheme: 'scheme03',
                  columnSeriesOverlap: false,
                  seriesGroups:
                  [
                  {
                        type: 'column',
                        valueAxis:
                        {
                              visible: true,
                              unitInterval: 100,
                              title: { text: 'Value<br>' }
                        },
                        series: [
                        { dataField: 'total_inquiry_target', displayText: 'Target' },
                        { dataField: 'total_inquiry', displayText: 'Inquiry' }
                        ]
                  }
                  ]
            };
            // setup the chart
            $('#modelwise_inquiry').css('height', 350);
            $('#modelwise_inquiry').css('width', '100%');
            $('#modelwise_inquiry').jqxChart(settings); 
      });
      }

</script>