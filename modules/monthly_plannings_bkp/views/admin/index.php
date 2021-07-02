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
        <form action="<?php echo base_url('monthly_plannings/read_file') ?>" method="post" enctype="multipart/form-data">
            <?php $this->session->set_userdata('referred_from', current_url()); ?>
            <input type="file" name="userfile">
            <button>Read</button>
        </form>
        <form action="<?php echo base_url('monthly_plannings/generate_order') ?>" method="post" enctype="multipart/form-data">
            <label>Year:</label><input type="number" min="1980" name="year" required>
            <label>Month:</label><input type="number" min="1" max="12" name="month" required>
            <button>Generate</button>
        </form>
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <div id='jqxGridMonthly_planningToolbar' class='grid-toolbar'>
                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridMonthly_planningInsert"><?php echo lang('general_create'); ?></button>
                    <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridMonthly_planningFilterClear"><?php echo lang('general_clear'); ?></button>
                </div>
                <div id="jqxGridMonthly_planning"></div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowMonthly_planning">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-monthly_plannings', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "monthly_plannings_id"/>
        <table class="form-table">
            <tr>
                <td><label for='vehicle_id'><?php echo lang('vehicle_id') ?></label></td>
                <td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
            </tr>
            <tr>
                <td><label for='variant_id'><?php echo lang('variant_id') ?></label></td>
                <td><div id='variant_id' class='number_general' name='variant_id'></div></td>
            </tr>
            <tr>
                <td><label for='color_id'><?php echo lang('color_id') ?></label></td>
                <td><div id='color_id' class='number_general' name='color_id'></div></td>
            </tr>
            <tr>
                <td><label for='dealer_id'><?php echo lang('dealer_id') ?></label></td>
                <td><div id='dealer_id' class='number_general' name='dealer_id'></div></td>
            </tr>
            <tr>
                <td><label for='quantity'><?php echo lang('quantity') ?></label></td>
                <td><div id='quantity' class='number_general' name='quantity'></div></td>
            </tr>
            <tr>
                <td><label for='year'><?php echo lang('year') ?></label></td>
                <td><div id='year' class='number_general' name='year'></div></td>
            </tr>
            <tr>
                <td><label for='month'><?php echo lang('month') ?></label></td>
                <td><div id='month' class='number_general' name='month'></div></td>
            </tr>
            <tr>
                <th colspan="2">
                    <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxMonthly_planningSubmitButton"><?php echo lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxMonthly_planningCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

    $(function () {
        //mst_vehicles
        masterDataSource.data = {table_name: 'mst_vehicles'};

        vehicleAdapter = new $.jqx.dataAdapter(masterDataSource);

        $("#vehicle_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: vehicleAdapter,
            displayMember: "name",
            valueMember: "id",
        });

        //mst_variants
        masterDataSource.data = {table_name: 'mst_variants'};

        variantAdapter = new $.jqx.dataAdapter(masterDataSource);

        $("#variant_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: variantAdapter,
            displayMember: "name",
            valueMember: "id",
        });

        // mst_colors
        masterDataSource.data = {table_name: 'mst_colors'};

        colorAdapter = new $.jqx.dataAdapter(masterDataSource);

        $("#color_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: colorAdapter,
            displayMember: "name",
            valueMember: "id",
        });
        
        // dms_dealers
        var dealerDataSource = {
           url : '<?php echo site_url("admin/monthly_plannings/get_dealers_combo_json"); ?>',
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

       var monthly_planningsDataSource =
       {
        datatype: "json",
        datafields: [
        {name: 'id', type: 'number'},
        {name: 'created_by', type: 'number'},
        {name: 'updated_by', type: 'number'},
        {name: 'deleted_by', type: 'number'},
        {name: 'created_at', type: 'string'},
        {name: 'updated_at', type: 'string'},
        {name: 'deleted_at', type: 'string'},
        {name: 'vehicle_id', type: 'number'},
        {name: 'variant_id', type: 'number'},
        {name: 'color_id', type: 'number'},
        {name: 'dealer_id', type: 'number'},
        {name: 'quantity', type: 'number'},
        {name: 'year', type: 'number'},
        {name: 'month', type: 'number'},
        {name: 'vehicle_name', type: 'string'},
        {name: 'variant_name', type: 'string'},
        {name: 'color_name', type: 'string'},
        {name: 'color_code', type: 'string'},
        {name: 'dealer_name', type: 'string'},
        ],
        url: '<?php echo site_url("admin/monthly_plannings/json"); ?>',
        pagesize: defaultPageSize,
        root: 'rows',
        id: 'id',
        cache: true,
        pager: function (pagenum, pagesize, oldpagenum) {
                        //callback called when a page or page size is changed.
                    },
                    beforeprocessing: function (data) {
                        monthly_planningsDataSource.totalrecords = data.total;
                    },
                    // update the grid and send a request to the server.
                    filter: function () {
                        $("#jqxGridMonthly_planning").jqxGrid('updatebounddata', 'filter');
                    },
                    // update the grid and send a request to the server.
                    sort: function () {
                        $("#jqxGridMonthly_planning").jqxGrid('updatebounddata', 'sort');
                    },
                    processdata: function (data) {
                    }
                };

                $("#jqxGridMonthly_planning").jqxGrid({
                    theme: theme,
                    width: '100%',
                    height: gridHeight,
                    source: monthly_planningsDataSource,
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
                    selectionmode: 'none',
                    virtualmode: true,
                    enableanimations: false,
                    pagesizeoptions: pagesizeoptions,
                    showtoolbar: true,
                    rendertoolbar: function (toolbar) {
                        var container = $("<div style='margin: 5px; height:50px'></div>");
                        container.append($('#jqxGridMonthly_planningToolbar').html());
                        toolbar.append(container);
                    },
                    columns: [
                    {text: 'SN', width: 50, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
                    {
                        text: 'Action', datafield: 'action', width: 75, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
                        cellsrenderer: function (index) {
                            var e = '<a href="javascript:void(0)" onclick="editMonthly_planningRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
                            return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
                        }
                    },
//                {text: '<?php echo lang("id"); ?>', datafield: 'id', width: 150, filterable: true, renderer: gridColumnsRenderer},

{text: '<?php echo lang("vehicle"); ?>', datafield: 'vehicle_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("variant"); ?>', datafield: 'variant_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("color"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("color_code"); ?>', datafield: 'color_code', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("dealer"); ?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("quantity"); ?>', datafield: 'quantity', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("year"); ?>', datafield: 'year', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("month"); ?>', datafield: 'month', width: 150, filterable: true, renderer: gridColumnsRenderer},
{text: '<?php echo lang("created_at"); ?>', datafield: 'created_at', width: 150, filterable: true, renderer: gridColumnsRenderer},
],
rendergridrows: function (result) {
    return result.data;
}
});

                $("[data-toggle='offcanvas']").click(function (e) {
                    e.preventDefault();
                    setTimeout(function () {
                        $("#jqxGridMonthly_planning").jqxGrid('refresh');
                    }, 500);
                });

                $(document).on('click', '#jqxGridMonthly_planningFilterClear', function () {
                    $('#jqxGridMonthly_planning').jqxGrid('clearfilters');
                });

                $(document).on('click', '#jqxGridMonthly_planningInsert', function () {
                    openPopupWindow('jqxPopupWindowMonthly_planning', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
                });

        // initialize the popup window
        $("#jqxPopupWindowMonthly_planning").jqxWindow({
            theme: theme,
            width: '75%',
            maxWidth: '75%',
            height: '75%',
            maxHeight: '75%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowMonthly_planning").on('close', function () {
            reset_form_monthly_plannings();
        });

        $("#jqxMonthly_planningCancelButton").on('click', function () {
            reset_form_monthly_plannings();
            $('#jqxPopupWindowMonthly_planning').jqxWindow('close');
        });


        $("#jqxMonthly_planningSubmitButton").on('click', function () {
            saveMonthly_planningRecord();
            /*
             var validationResult = function (isValid) {
             if (isValid) {
             saveMonthly_planningRecord();
             }
             };
             $('#form-monthly_plannings').jqxValidator('validate', validationResult);
             */
         });
    });

function editMonthly_planningRecord(index) {
    var row = $("#jqxGridMonthly_planning").jqxGrid('getrowdata', index);
    if (row) {
        $('#monthly_plannings_id').val(row.id);
        $('#vehicle_id').jqxComboBox('val', row.vehicle_id);
        $('#variant_id').jqxComboBox('val', row.variant_id);
        $('#color_id').jqxComboBox('val', row.color_id);
        $('#dealer_id').jqxComboBox('val', row.dealer_id);
        $('#quantity').jqxNumberInput('val', row.quantity);
        $('#year').jqxNumberInput('val', row.year);
        $('#month').jqxNumberInput('val', row.month);

        openPopupWindow('jqxPopupWindowMonthly_planning', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
    }
}

function saveMonthly_planningRecord() {
    var data = $("#form-monthly_plannings").serialize();

    $('#jqxPopupWindowMonthly_planning').block({
        message: '<span>Processing your request. Please be patient.</span>',
        css: {
            width: '75%',
            border: 'none',
            padding: '50px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .7,
            color: '#fff',
            cursor: 'wait'
        },
    });

    $.ajax({
        type: "POST",
        url: '<?php echo site_url("admin/monthly_plannings/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('(' + result + ')');
            if (result.success) {
                reset_form_monthly_plannings();
                $('#jqxGridMonthly_planning').jqxGrid('updatebounddata');
                $('#jqxPopupWindowMonthly_planning').jqxWindow('close');
            }
            $('#jqxPopupWindowMonthly_planning').unblock();
        }
    });
}

function reset_form_monthly_plannings() {
    $('#monthly_plannings_id').val('');
    $('#form-monthly_plannings')[0].reset();
}
</script>