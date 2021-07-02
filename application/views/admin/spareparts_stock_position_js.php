<script type="text/javascript">
  
    url = "<?php echo site_url('daily_credits/get_daily_credit_summary')?>";
        // prepare the data
    var source =
    {
      dataType: "json",
      dataFields: [
      { name: 'id', type: 'number' },
      { name: 'dealer_name', type: 'string' },
      { name: 'total_quantity', type: 'number' },
      { name: 'total_amount', type: 'number' },
      { name: 'stock_quantity', type: 'number' },
      { name: 'stock_amount', type: 'number' },
      { name: 'credit_amount', type: 'number' },
      { name: 'credit_left', type: 'number' },
      ],
      id: 'id',
      url: url
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxCreditLimit").jqxGrid(
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
        { text: 'Dealers', dataField: 'dealer_name', width: '20%' },
        // { text: 'PI Quantity', width: 120, dataField: 'total_quantity', aggregates: ['sum'] },
        { text: 'PI Amount', width: 120, dataField: 'total_amount', aggregates: ['sum'] },
        { text: 'Stock Quantity', width: 120, dataField: 'stock_quantity', aggregates: ['sum'] },
        { text: 'Stock Amount', width: 120, dataField: 'stock_amount', aggregates: ['sum'] },
        { text: 'Credit Amount', width: 120, dataField: 'credit_amount' },
        { text: 'Picking Target', width: 120, dataField: 'credit_left', aggregates: ['sum'] },
                    
        ],
    });
    
</script>

<script type="text/javascript">
  
    url = "<?php echo site_url('stock_records/get_pi_pending_sparepart')?>";
        // prepare the data
    var source =
    {
      dataType: "json",
      dataFields: [
      { name: 'id', type: 'number' },
      { name: 'dealer_name', type: 'string' },
      { name: 'less_than_30', type: 'number' },
      { name: 'less_than_60', type: 'number' },
      { name: 'less_than_90', type: 'number' },
      { name: 'more_than_90', type: 'number' },
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
        { text: 'value', dataField: 'less_than_30', width: 120, columngroup: 'ageing1', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_60', width: 120, columngroup: 'ageing2', aggregates: ['sum'] },
        { text: 'value', dataField: 'less_than_90', width: 120, columngroup: 'ageing3', aggregates: ['sum'] },
        { text: 'value', dataField: 'more_than_90', width: 120, columngroup: 'ageing4', aggregates: ['sum'] },
                    
        ],
        columngroups: [
        { text: '0-30', align: 'center', name: 'ageing1'},
        { text: '31-60', align: 'center', name: 'ageing2'},
        { text: '61-90', align: 'center', name: 'ageing3'},
        { text: 'More Than 90', align: 'center', name: 'ageing4'},
        ]
    });
    
</script>