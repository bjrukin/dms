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
                            <?php
                            for ($i=1; $i < 13 ; $i++) { 
                                echo '<th>' . $i . '</th>';
                            }
                            ?>
                            <!-- <th>final</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) { ?>
                            <tr>
                                <?php $total = 0; ?>
                                <td><?php echo $row->vehicle_name ?></td>
                                <td><?php echo $row->variant_name ?></td>
                                <td><?php echo $row->color_name ?></td>
                                <?php for ($i=1; $i < 13; $i++) { ?>
                                <td><?php
                                    $final = 0;
                                    $total = 0;
                                    // echo $row->$i;
                                    if (key_exists($i, $order_item) && key_exists($row->vehicle_name, $order_item[$i]) && key_exists($row->variant_name, $order_item[$i][$row->vehicle_name]) && key_exists($row->color_id, $order_item[$i][$row->vehicle_name][$row->variant_name])) {
                                        // echo $order_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                                        $total = $order_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                                    };
                                    if (key_exists($i, $dispatch_item) && key_exists($row->vehicle_name, $dispatch_item[$i]) && key_exists($row->variant_name, $dispatch_item[$i][$row->vehicle_name]) && key_exists($row->color_id, $dispatch_item[$i][$row->vehicle_name][$row->variant_name])) {
                                        // echo $order_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                                        $total -= $dispatch_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                                    }
                                    if($total != 0){
                                        echo $total;
                                    }else{
                                        echo '--';
                                    }
                                        
                                    $final += $total;
                                    ?>
                                </td>
                                <?php }?>
                                <!-- <td><?php echo $final?></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


</div>
<?php 
    $month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec');
    // print_r($month['0']);
?>
<script language="javascript" type="text/javascript">

    $(function () {

        // $('#export_year').val(year);
        // $('#export_month').val(month);
        //for order table
        $("#jqxTableOrder").jqxDataTable(
                {
                    width: 1275,
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
                        <?php for ($i = 1; $i < 13; $i++) { ?>
                            {text: '<?php echo $month[$i-1]?>', dataField: '<?php echo $i?>', width: 100},
                        <?php }?>
                        // {text: 'Final', dataField: 'final', width: 100},
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
                        <?php for($i = 1; $i < 13; $i++) { ?>
                            {name: '<?php echo $i?>', type: 'number'},
                        <?php }?>
                        // {name: 'final', type: 'number'},
                    ],
                    url: '<?php echo site_url("admin/monthly_plannings/order_json"); ?>',
                    pagesize: defaultPageSize,
                    root: 'rows',
                    id: 'id',
                    data: {
                        // year: year,
                        // month: month,
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

        // $(document).on('click', '#jqxGridMonthly_planningInsert', function () {
        //     openPopupWindow('jqxPopupWindowMonthly_planning', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
        // });

        // // initialize the popup window
        // $("#jqxPopupWindowMonthly_planning").jqxWindow({
        //     theme: theme,
        //     width: '75%',
        //     maxWidth: '75%',
        //     height: '75%',
        //     maxHeight: '75%',
        //     isModal: true,
        //     autoOpen: false,
        //     modalOpacity: 0.7,
        //     showCollapseButton: false
        // });

        // $("#jqxPopupWindowMonthly_planning").on('close', function () {
        //     reset_form_monthly_plannings();
        // });

        // $("#jqxMonthly_planningCancelButton").on('click', function () {
        //     reset_form_monthly_plannings();
        //     $('#jqxPopupWindowMonthly_planning').jqxWindow('close');
        // });


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

    // function editMonthly_planningRecord(index) {
    //     var row = $("#jqxGridMonthly_planning").jqxGrid('getrowdata', index);
    //     if (row) {
    //         $('#monthly_plannings_id').val(row.id);
    //         $('#vehicle_id').jqxComboBox('val', row.vehicle_id);
    //         $('#variant_id').jqxComboBox('val', row.variant_id);
    //         $('#color_id').jqxComboBox('val', row.color_id);
    //         $('#dealer_id').jqxComboBox('val', row.dealer_id);
    //         $('#quantity').jqxNumberInput('val', row.quantity);
    //         $('#year').jqxNumberInput('val', row.year);
    //         $('#month').jqxNumberInput('val', row.month);

    //         openPopupWindow('jqxPopupWindowMonthly_planning', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
    //     }
    // }

    // function saveMonthly_planningRecord() {
    //     var data = $("#form-monthly_plannings").serialize();

    //     $('#jqxPopupWindowMonthly_planning').block({
    //         message: '<span>Processing your request. Please be patient.</span>',
    //         css: {
    //             width: '75%',
    //             border: 'none',
    //             padding: '50px',
    //             backgroundColor: '#000',
    //             '-webkit-border-radius': '10px',
    //             '-moz-border-radius': '10px',
    //             opacity: .7,
    //             color: '#fff',
    //             cursor: 'wait'
    //         },
    //     });

    //     $.ajax({
    //         type: "POST",
    //         url: '<?php echo site_url("admin/monthly_plannings/save"); ?>',
    //         data: data,
    //         success: function (result) {
    //             var result = eval('(' + result + ')');
    //             if (result.success) {
    //                 reset_form_monthly_plannings();
    //                 $('#jqxGridMonthly_planning').jqxGrid('updatebounddata');
    //                 $('#jqxPopupWindowMonthly_planning').jqxWindow('close');
    //             }
    //             $('#jqxPopupWindowMonthly_planning').unblock();
    //         }
    //     });
    // }

    function reset_form_monthly_plannings() {
        $('#monthly_plannings_id').val('');
        $('#form-monthly_plannings')[0].reset();
    }

</script>