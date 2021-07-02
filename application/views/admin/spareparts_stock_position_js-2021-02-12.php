<script type="text/javascript">
  $(function () {
    // alert('dfs');
    url = "<?php echo site_url('stock_records/spareparts_stock_position')?>";
        // prepare the data
    var source =
    {
      dataType: "json",
      dataFields: [
      { name: 'total_quantity', type: 'number' },
      { name: 'total_price', type: 'number' },
      { name: 'listing_item', type: 'number' },
      { name: 'fms', type: 'string' },
      
      ],
      // id: 'id',
      url: url
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#spareparts_stock_position").jqxGrid(
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
        { text: 'FMSN', dataField: 'fms', width: 120 },
        { text: 'total_quantity', dataField: 'total_quantity', width: 120},
        { text: 'total_price', dataField: 'total_price', width: 120 },
      
        { text: 'listing_item', dataField: 'listing_item', width: 120},
          
        ],
       
    });



    var initWidgets = function (tab) {
      var tabName = $('#jqxTabs').jqxTabs('getTitleAt', tab);
      switch (tabName) {
        case '<?php echo lang("tab_fast");?>':
          partial_fast();
        break;
        case '<?php echo lang("tab_medium");?>':
          partial_medium();
        break;
        case '<?php echo lang("tab_none");?>':
          partial_none();
        break;
        case '<?php echo lang("tab_slow");?>':
          partial_slow();
        break;
      }
    };


    $('#jqxTabs').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgets});    

    $('.select-tab').on('click', function(){
      var tabindex = parseInt(this.getAttribute("data-tabindex"));
      $('#jqxTabs').jqxTabs({ selectedItem: tabindex });
    });
 
    var initWidgetsSales = function (tab) {
      var tabNamesales = $('#jqxTabsSales').jqxTabs('getTitleAt', tab);
      switch (tabNamesales) {
        case '<?php echo lang("tab_daily");?>':
          partial_daily();
        break;
        case '<?php echo lang("tab_monthly");?>':
          partial_monthly();
        break;
       
      }
    };


    $('#jqxTabsSales').jqxTabs({ width: '100%', height: gridHeight, position: 'top', theme: theme, initTabContent: initWidgetsSales});    

    $('.select-tab').on('click', function(){
      var tabindex = parseInt(this.getAttribute("data-tabindex"));
      $('#jqxTabsSales').jqxTabs({ selectedItem: tabindex });
    });



    url = "<?php echo site_url('stock_records/get_pi_pending_sparepart')?>";
        // prepare the data
    var source =
    {
      dataType: "json",
      dataFields: [
      { name: 'id', type: 'number' },
      { name: 'dealer_name', type: 'string' },
      { name: 'less_than_10', type: 'number' },
      { name: 'less_than_20', type: 'number' },
      { name: 'less_than_30', type: 'number' },
      { name: 'more_than_30', type: 'number' },
      ],
      id: 'id',
      url: url
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxPiPending").jqxGrid(
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
        { text: 'Dealers', dataField: 'dealer_name', width: 230 },
        { text: 'value', dataField: 'less_than_10', width: 120, columngroup: 'ageing1', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_20', width: 120, columngroup: 'ageing2', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_30', width: 120, columngroup: 'ageing3', aggregates: ['sum'] },
        { text: 'value', dataField: 'more_than_30', width: 120, columngroup: 'ageing4', aggregates: ['sum'] },
                    
        ],
        columngroups: [
        { text: '0-1', align: 'center', name: 'ageing1'},
        { text: '10-20', align: 'center', name: 'ageing2'},
        { text: '20-30', align: 'center', name: 'ageing3'},
        { text: 'more than 30', align: 'center', name: 'ageing4'},
        ]
    });



    back_order_url = "<?php echo site_url('stock_records/get_back_order_by_dealer')?>";
    // prepare the data
    var backordersource =
    {
      dataType: "json",
      dataFields: [
      { name: 'id', type: 'number' },
      { name: 'dealer_name', type: 'string' },
      { name: 'less_than_15', type: 'number' },
      { name: 'less_than_30', type: 'number' },
      { name: 'less_than_45', type: 'number' },
      { name: 'less_than_60', type: 'number' },
      { name: 'more_than_60', type: 'number' },
      ],
      id: 'id',
      url: back_order_url
    };
    var dataAdapter = new $.jqx.dataAdapter(backordersource);
    $("#jqxbackorder").jqxGrid(
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
        { text: 'Dealers', dataField: 'dealer_name', width: 230 },
        { text: 'value', dataField: 'less_than_15', width: 120, columngroup: 'ageing1', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_30', width: 120, columngroup: 'ageing2', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_45', width: 120, columngroup: 'ageing3', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_60', width: 120, columngroup: 'ageing4', aggregates: ['sum'] },
        { text: 'value', dataField: 'more_than_60', width: 120, columngroup: 'ageing5', aggregates: ['sum'] },

                    
        ],
        columngroups: [
        { text: '0-15', align: 'center', name: 'ageing1'},
        { text: '15-30', align: 'center', name: 'ageing2'},
        { text: '30-45', align: 'center', name: 'ageing3'},
        { text: '45-60', align: 'center', name: 'ageing4'},
        { text: 'more than 60', align: 'center', name: 'ageing5'},
        ]
    });



    picklist_url = "<?php echo site_url('stock_records/get_picklist_by_ordertype')?>";
    // prepare the data
    var picklistsource =
    {
      dataType: "json",
      dataFields: [
      { name: 'id', type: 'number' },
      { name: 'type', type: 'string' },
      { name: 'executed_order_price', type: 'number' },
      { name: 'pending_order_price', type: 'number' },
     
      ],
      id: 'id',
      url: picklist_url
    };
    var dataAdapter = new $.jqx.dataAdapter(picklistsource);
    $("#jqxPicklist").jqxGrid(
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
        { text: 'Order Type', dataField: 'type', width: 230 },
        { text: 'value', dataField: 'executed_order_price', width: 120, columngroup: 'executed_order', aggregates: ['sum'] },
        { text: 'value', dataField: 'pending_order_price', width: 120, columngroup: 'pending_order', aggregates: ['sum'] },
       

                    
        ],
        columngroups: [
        { text: 'Executed Order', align: 'center', name: 'executed_order'},
        { text: 'Pending Order', align: 'center', name: 'pending_order'},
        
        ]
    });




      var dealerDataSource = {
      url : '<?php echo site_url("admin/stock_records/get_dealer_list"); ?>',
      datatype: 'json',
      datafields: [
      { name: 'id', type: 'number' },
      { name: 'name', type: 'string' },   
      
      ],
    
      cache: true,
      method: 'post',
    }

    dealerAdapter = new $.jqx.dataAdapter(dealerDataSource);

    $("#dealer_list").jqxComboBox({
      theme: theme,
      theme: 'energyblue',
      width: '225px',
      height: '25px',
      // searchMode:'endswith',
      // checkboxes:true,
      displayMember: "name",
      valueMember: "id",
      multiSelect: false,
      selectionMode: 'dropDownList',
      autoComplete: true,
      searchMode: 'containsignorecase',
      source: dealerAdapter,
    });

  $.post('<?php echo site_url()?>stock_records/dispatch_chart_record?>', null, function(data){
      var obj = [];//JSON.parse(PieData);
      
      $.each(data, function( index, value ) {
        
        obj.push({"month": value.month_name, "accidental": value.accidental_quantity,"stock":value.stock_quantity,"vor":value.vor_quantity});

        
      });
      makeMyChart(obj);
           
         },'json');

  });
</script>
<script type="text/javascript">
  
  $("#dealer_list").on('change', function(){
    var dealer = $('#dealer_list').val();

    $.post('<?php echo site_url()?>stock_records/dispatch_chart_record?>',{ dealer_id: dealer }, function(data){
      var obj_new = [];//JSON.parse(PieData);
      
      $.each(data, function( index, value ) {
        
          obj_new.push({"month": value.month_name, "accidental": value.accidental_quantity,"stock":value.stock_quantity,"vor":value.vor_quantity});

        
      });

      var dataAdapter = new $.jqx.dataAdapter(obj_new);
      $('#test_graph_div').jqxChart({ source: dataAdapter });
      
     makeMyChart(obj_new);
     


    },'json');
 })


  function makeMyChart(data)
  {
   

      var settings = {
          title: "",
          description: "",
          padding: { left: 5, top: 5, right: 5, bottom: 5 },
          titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
          source: data,
          xAxis:
          {
              dataField: 'month',
              showGridLines: true,
              tickMarksInterval: 10 
          },
         
          colorScheme: 'scheme01',

          seriesGroups:
              [
                  {
                      
                      columnsGapPercent: 50,
                      seriesGapPercent: 0,
                    
                      valueAxis: {
                        description: 'Quantity',
                        displayValueAxis: true,
                        axisSize: 'auto',
                        tickMarksColor: '#888888'
                      
                     },
                      type: 'line', // change the series type here
                      series: [
                              { dataField: 'accidental', displayText: 'ACCIDENTAL'},
                              { dataField: 'stock', displayText: 'STOCK'},
                              { dataField: 'vor', displayText: 'VOR'},
                              
                          ]
                  }
              ]
      };
      
      // select the chartContainer DIV element and render the chart.
      $('#test_graph_div').jqxChart(settings);
  }
</script>