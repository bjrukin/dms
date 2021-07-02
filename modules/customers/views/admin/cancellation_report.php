<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo lang('monthly_plannings'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo lang('monthly_plannings'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <div id='jqxGridCancellation_reportToolbar' class='grid-toolbar'>
                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCancellation_reportInsert"><?php echo lang('general_create'); ?></button>
                    <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCancellation_reportFilterClear"><?php echo lang('general_clear'); ?></button>
                </div>
                <div id="jqxGridCancellation_report"></div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script language="javascript" type="text/javascript">

    $(function () {
        //mst_vehicles
       

       var cancellationDataSource =
       {
        datatype: "json",
        datafields: [
        {name: 'status_date', type: 'date'},
        {name: 'customer_name', type: 'string'},
        {name: 'username', type: 'string'},
        {name: 'dealer_name', type: 'string'},
        {name: 'notes', type: 'string'},
        {name: 'inquiry_no', type: 'string'},
        ],
        url: '<?php echo site_url("admin/customers/cancellation_report_json"); ?>',
        pagesize: defaultPageSize,
        root: 'rows',
        id: 'id',
        cache: true,
        pager: function (pagenum, pagesize, oldpagenum) {
                        //callback called when a page or page size is changed.
                    },
                    beforeprocessing: function (data) {
                        cancellationDataSource.totalrecords = data.total;
                    },
                    // update the grid and send a request to the server.
                    filter: function () {
                        $("#jqxGridCancellation_report").jqxGrid('updatebounddata', 'filter');
                    },
                    // update the grid and send a request to the server.
                    sort: function () {
                        $("#jqxGridCancellation_report").jqxGrid('updatebounddata', 'sort');
                    },
                    processdata: function (data) {
                    }
                };

                $("#jqxGridCancellation_report").jqxGrid({
                    theme: theme,
                    width: '100%',
                    height: gridHeight,
                    source: cancellationDataSource,
                    altrows: true,
                    pageable: true,
                    sortable: true,
                    rowsheight: 30,
                    columnsheight: 30,
                    showfilterrow: true,
                    filterable: true,
                    columnsresize: true,
                    autoshowfiltericon: true,
                    columnsreorder: true,
                    selectionmode: 'multiplerowsextended',
                    virtualmode: true,
                    enableanimations: false,
                    pagesizeoptions: pagesizeoptions,
                    showtoolbar: true,
                    rendertoolbar: function (toolbar) {
                        var container = $("<div style='margin: 5px; height:50px'></div>");
                        container.append($('#jqxGridCancellation_reportToolbar').html());
                        toolbar.append(container);
                    },
                    columns: [
                    {text: 'SN', width: 50, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
         

                    {text: 'Inquiry Number', datafield: 'inquiry_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: 'Custmer Name', datafield: 'customer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: 'Cancelled By', datafield: 'username', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: 'Cancelled Date', datafield: 'status_date',width: 120,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd_HH_mm },
                    {text: 'Dealer', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: 'Note', datafield: 'notes', width: 150, filterable: true, renderer: gridColumnsRenderer},
                  
                    ],
                    rendergridrows: function (result) {
                        return result.data;
                    }
                });

                $("[data-toggle='offcanvas']").click(function (e) {
                    e.preventDefault();
                    setTimeout(function () {
                        $("#jqxGridCancellation_report").jqxGrid('refresh');
                    }, 500);
                });

                $(document).on('click', '#jqxGridCancellation_reportFilterClear', function () {
                    $('#jqxGridCancellation_report').jqxGrid('clearfilters');
                });

                $(document).on('click', '#jqxGridCancellation_reportInsert', function () {
                    openPopupWindow('jqxPopupWindowMonthly_planning', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
                });

    });


</script>