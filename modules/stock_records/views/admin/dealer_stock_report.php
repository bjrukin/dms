<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $header; ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo $header; ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <div id='jqxGridMonthly_planningToolbar' class='grid-toolbar'>
<!--                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridMonthly_planningInsert"><?php echo lang('general_create'); ?></button>
                    <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridMonthly_planningFilterClear"><?php echo lang('general_clear'); ?></button>-->
                </div>
                
                <div id="jqxGridMonthly_planning"></div>
                <table id="jqxTableOrder">
                    <thead>
                        <tr>
                            <th>Vehicle Name</th>
                            <th>Variant</th>
                            <th>Color</th>
                            <th>Kathmandu</th>
                            <th>Birgunj</th>
                            <th>Bhairahawa</th>
                            <th>RXL Custom</th>
                            <th>Indian Custom</th>
                            <th>Nepal Custom</th>
                            <th>Transit</th>
                            <th>Total</th>
                            <?php
                            foreach ($dealers as $dealer) {
                                echo '<th>' . $dealer->name . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) { ?>
                            <tr>
                                <?php $total = 0; ?>
                                <td><?php echo $row->vehicle_name ?></td>
                                <td><?php echo $row->variant_name ?></td>
                                <td><?php echo $row->color_name ?></td>
                                <td><?php
                                    if (key_exists(1, $records['stock']) && key_exists($row->vehicle_id, $records['stock'][1]) && key_exists($row->variant_id, $records['stock'][1][$row->vehicle_id]) && key_exists($row->color_id, $records['stock'][1][$row->vehicle_id][$row->variant_id])) {
                                        echo $records['stock'][1][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        $total += $records['stock'][1][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if (key_exists(2, $records['stock']) && key_exists($row->vehicle_id, $records['stock'][2]) && key_exists($row->variant_id, $records['stock'][2][$row->vehicle_id]) && key_exists($row->color_id, $records['stock'][2][$row->vehicle_id][$row->variant_id])) {
                                        echo $records['stock'][2][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        $total += $records['stock'][2][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                    } else {
                                        echo 0;
                                    }
                                    ?></td>
                                <td><?php
                                    if (key_exists(3, $records['stock']) && key_exists($row->vehicle_id, $records['stock'][3]) && key_exists($row->variant_id, $records['stock'][3][$row->vehicle_id]) && key_exists($row->color_id, $records['stock'][3][$row->vehicle_id][$row->variant_id])) {
                                        echo $records['stock'][3][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        $total += $records['stock'][3][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                    } else {
                                        echo 0;
                                    }
                                    ?></td>
                                <td><?php
                                    if (is_array($records['transit'])) {
                                        if (key_exists('indian_customs', $records['transit']) && key_exists($row->vehicle_id, $records['transit']['indian_customs']) && key_exists($row->variant_id, $records['transit']['indian_customs'][$row->vehicle_id]) && key_exists($row->color_id, $records['transit']['indian_customs'][$row->vehicle_id][$row->variant_id])) {
                                            echo $records['transit']['indian_customs'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                            $total += $records['transit']['indian_customs'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        } else {
                                            echo 0;
                                        }
                                    } else {
                                        echo 0;
                                    }
                                    ?></td>
                                <td><?php
                                    if (is_array($records['transit'])) {
                                        if (key_exists('nepal_customs', $records['transit']) && key_exists($row->vehicle_id, $records['transit']['nepal_customs']) && key_exists($row->variant_id, $records['transit']['nepal_customs'][$row->vehicle_id]) && key_exists($row->color_id, $records['transit']['nepal_customs'][$row->vehicle_id][$row->variant_id])) {
                                            echo $records['transit']['nepal_customs'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                            $total += $records['transit']['nepal_customs'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        } else {
                                            echo 0;
                                        }
                                    } else {
                                        echo 0;
                                    }
                                    ?></td>
                                <td><?php
                                    if (is_array($records['transit'])) {
                                        if (key_exists('nepal_customs', $records['transit']) && key_exists($row->vehicle_id, $records['transit']['nepal_customs']) && key_exists($row->variant_id, $records['transit']['nepal_customs'][$row->vehicle_id]) && key_exists($row->color_id, $records['transit']['nepal_customs'][$row->vehicle_id][$row->variant_id])) {
                                            echo $records['transit']['nepal_customs'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                            $total += $records['transit']['nepal_customs'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        } else {
                                            echo 0;
                                        }
                                    } else {
                                        echo 0;
                                    }
                                    ?></td>
                                <td><?php
                                    if (is_array($records['transit'])) {
                                        if (key_exists('transits', $records['transit']) && key_exists($row->vehicle_id, $records['transit']['transits']) && key_exists($row->variant_id, $records['transit']['transits'][$row->vehicle_id]) && key_exists($row->color_id, $records['transit']['transits'][$row->vehicle_id][$row->variant_id])) {
                                            echo $records['transit']['transits'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                            $total += $records['transit']['transits'][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                        } else {
                                            echo 0;
                                        }
                                    } else {
                                        echo 0;
                                    }
                                    ?></td>
                                <td><?php echo $total ?></td>
                                <?php foreach ($dealers as $dealer) { ?>
                                    <td>
                                        <?php
                                        if (is_array($dealer_stocks)) {
                                            if (key_exists($dealer->id, $dealer_stocks) && key_exists($row->vehicle_id, $dealer_stocks[$dealer->id]) && key_exists($row->variant_id, $dealer_stocks[$dealer->id][$row->vehicle_id]) && key_exists($row->color_id, $dealer_stocks[$dealer->id][$row->vehicle_id][$row->variant_id])) {
                                                echo $dealer_stocks[$dealer->id][$row->vehicle_id][$row->variant_id][$row->color_id]['count'];
                                            } else {
                                                echo 0;
                                            }
                                        } else {
                                            echo 0;
                                        }
                                        ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

<!--for editing order-->
<div style="visibility: hidden;" id="dialog">
    <div>Edit Quantity</div>
    <div style="overflow: hidden;">
        <table style="table-layout: fixed; border-style: none;">
            <tr>
                <td align="right">Order Quantity:
                </td>
                <td align="left">
                    <input id="order_quantity" type="text" />
                </td>
            </tr>

            <tr>
                <td colspan="2" align="right">
                    <br />
                    <button id="save">Save</button> <button style="margin-left: 5px;" id="cancel">Cancel</button></td>                    
            </tr>
        </table>
    </div>
</div>

<script language="javascript" type="text/javascript">

    $(function () {
        var year = <?php echo (key_exists('year', $search)) ? $search['year'] : date('Y') ?>;
        var month = <?php echo (key_exists('year', $search)) ? $search['month'] : date('m') ?>;

        $('#export_year').val(year);
        $('#export_month').val(month);
        //for order table
        $("#jqxTableOrder").jqxDataTable(
                {
                    width: 1500,
                    height: 500,
                    altRows: true,
//                    sortable: true,
//                    selectionMode: 'singleRow',
                    pageable: true,
                    pagerButtonsCount: 3,
                    pageSize: 50,
                    columns: [
                        {text: 'Vehicle Name', pinned: true, dataField: 'Vehicle Name', width: 100},
                        {text: 'Variant', pinned: true, dataField: 'Variant', width: 100},
                        {text: 'Color', pinned: true, dataField: 'Color', width: 150},
                        {text: 'Kathmandu', dataField: 'Kathmandu', width: 100},
                        {text: 'Birgunj', dataField: 'Birgunj', width: 100},
                        {text: 'Bhairahawa', dataField: 'Bhairahawa', width: 100},
                        {text: 'RXL Custom', dataField: 'RXL Custom', width: 100},
                        {text: 'Indian Custom', dataField: 'Indian Custom', width: 100},
                        {text: 'Nepal Custom', dataField: 'Nepal Custom', width: 100},
                        {text: 'Transit', dataField: 'Transit', width: 100},
                        {text: 'Total', dataField: 'Total', width: 100},
<?php foreach ($dealers as $dealer) { ?>
                            {text: '<?php echo $dealer->name ?>', dataField: '<?php echo $dealer->name ?>', width: 200},
<?php } ?>
                    ]
                });

        var monthly_planningsDataSource =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'deleted_at', type: 'string'},
                        {name: 'vehicle_id', type: 'number'},
                        {name: 'variant_id', type: 'number'},
                        {name: 'color_id', type: 'number'},
                        //{name: 'dealer_id', type: 'number'},
                        {name: 'quantity', type: 'number'},
                        {name: 'year', type: 'number'},
                        {name: 'month', type: 'number'},
                        {name: 'vehicle_name', type: 'string'},
                        {name: 'variant_name', type: 'string'},
                        {name: 'color_name', type: 'string'},
                        {name: 'color_code', type: 'string'},
                        {name: 'total', type: 'string'},
                        //{name: 'dealer_name', type: 'string'},
                    ],
                    url: '<?php echo site_url("admin/monthly_plannings/order_json"); ?>',
                    pagesize: defaultPageSize,
                    root: 'rows',
                    id: 'id',
                    data: {
                        year: year,
                        month: month,
                    },
                    cache: true,
                    pager: function (pagenum, pagesize, oldpagenum) {
                        //callback called when a page or page size is changed.
                    },
                    beforeprocessing: function (data) {
                        monthly_planningsDataSource.totalrecords = data.total;
                    },
                    // update the grid and send a request to the server.
                    filter: function () {
//                        $("#jqxGridMonthly_planning").jqxGrid('updatebounddata', 'filter');
                    },
                    // update the grid and send a request to the server.
                    sort: function () {
//                        $("#jqxGridMonthly_planning").jqxGrid('updatebounddata', 'sort');
                    },
                    processdata: function (data) {
                    }
                };

        /*$("#jqxGridMonthly_planning").jqxGrid({
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
         //                {
         //                    text: 'Action', datafield: 'action', width: 75, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
         //                    cellsrenderer: function (index) {
         //                        var e = '<a href="javascript:void(0)" onclick="editMonthly_planningRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
         //                        return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
         //                    }
         //                },
         //                {text: '<?php echo lang("id"); ?>', datafield: 'id', width: 150, filterable: true, renderer: gridColumnsRenderer},
         
         {text: '<?php echo lang("vehicle"); ?>', datafield: 'vehicle_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
         {text: '<?php echo lang("variant"); ?>', datafield: 'variant_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
         {text: '<?php echo lang("color"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
         {text: '<?php echo lang("color_code"); ?>', datafield: 'color_code', width: 150, filterable: true, renderer: gridColumnsRenderer},
         //                {text: '<?php echo lang("dealer"); ?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
         {text: '<?php echo lang("quantity"); ?>', datafield: 'total', width: 150, filterable: true, renderer: gridColumnsRenderer},
         {text: '<?php echo lang("year"); ?>', datafield: 'year', width: 150, filterable: true, renderer: gridColumnsRenderer},
         {text: '<?php echo lang("month"); ?>', datafield: 'month', width: 150, filterable: true, renderer: gridColumnsRenderer},
         ],
         rendergridrows: function (result) {
         return result.data;
         }
         });*/

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
        $("#jqxTableOrder").on('rowDoubleClick', function (event) {
            var args = event.args;
            var index = args.index;
            var row = args.row;
//             console.log(row);
//                // update the widgets inside jqxWindow.
            $("#dialog").jqxWindow('setTitle', "Edit Row: ");
            $("#dialog").jqxWindow('open');
            $("#dialog").attr('data-row', index);
            $("#jqxTableOrder").jqxDataTable({disabled: true});

            $("#order_quantity").val(row.Quantity);
//                $("#freight").val(row.Freight);
//                $("#shipCountry").val(row.ShipCountry);
//                $("#shipDate").val(row.ShippedDate);
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