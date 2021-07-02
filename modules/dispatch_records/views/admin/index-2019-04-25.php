<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo lang('dispatch_records'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo lang('dispatch_records'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url('dispatch_records/read_file') ?>" method="post" enctype="multipart/form-data">
            <?php $this->session->set_userdata('referred_from', current_url()); ?>
            <input type="file" name="userfile">
            <button>Read</button>
        </form>
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <div id='jqxGridDispatch_recordToolbar' class='grid-toolbar'>
                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDispatch_recordInsert"><?php echo lang('general_create'); ?></button>
                    <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDispatch_recordFilterClear"><?php echo lang('general_clear'); ?></button>
                </div>
                <div id="jqxGridDispatch_record"></div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDispatch_record">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-dispatch_records', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "dispatch_records_id"/>
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
                <td><label for='engine_no'><?php echo lang('engine_no') ?></label></td>
                <!--<td><div id='engine_no' name='engine_no'></div></td>-->
                <td><input id='engine_no' class='text_input' name='engine_no'></td>
            </tr>
            <tr>
                <td><label for='chass_no'><?php echo lang('chass_no') ?></label></td>
                <td><div id='chass_no' class='number_general' name='chass_no'></div></td>
            </tr>
            <tr>
                <td><label for='dispatch_date'><?php echo lang('dispatch_date') ?></label></td>
                <td><div id='dispatch_date' class='date_box' name='dispatch_date'></div>
                </tr>
                <tr>
                    <td><label for='month'><?php echo lang('month') ?></label></td>
                    <td><div id='month' class='number_general' name='month'></div></td>
                </tr>
                <tr>
                    <td><label for='year'><?php echo lang('year') ?></label></td>
                    <td><div id='year' class='number_general' name='year'></div></td>
                </tr>
                <tr>
                    <td><label for='order_no'><?php echo lang('order_no') ?></label></td>
                    <td><div id='order_no' class='number_general' name='order_no'></div></td>
                </tr>
                <tr>
                    <td><label for='ait_reference_no'><?php echo lang('ait_reference_no') ?></label></td>
                    <td><input id='ait_reference_no' class='text_input' name='ait_reference_no'></td>
                </tr>
                <tr>
                    <td><label for='invoice_no'><?php echo lang('invoice_no') ?></label></td>
                    <td><div id='invoice_no' class='number_general' name='invoice_no'></div></td>
                </tr>
                <tr>
                    <td><label for='invoice_date'><?php echo lang('invoice_date') ?></label></td>
                    <td><div id='invoice_date' class='date_box' name='invoice_date'></div></td>
                </tr>
                <tr>
                    <td><label for='transit'><?php echo lang('transit') ?></label></td>
                    <td><div id='transit' class='number_general' name='transit'></div></td>
                </tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDispatch_recordSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDispatch_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>

            </table>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div id="jqxPopupWindowVehicle_register">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title' id="window_poptup_track_title">Track Form</span>
        </div>
        <div class="form_fields_area">
            <?php echo form_open('', array('id' => 'form-vehicle_register', 'onsubmit' => 'return false')); ?>
            <div class="row">
                <div class="col-md-4 col-xs-12"><label>Vehicle Register Number:</label></div>
                <div class="col-md-8 col-xs-12"><input type="text" name="vehicle_register_no" class="form-control"></div>
            </div>
            <div class="row">
                <div class="col-md-4"><label>Vehicle Register Date</label></div>
                <div class="col-md-8"><input type="text" name="vehicle_register_date" class="form-control"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-flat btn-success btn-xs" id="jqxVechile_registerButton"><?php echo lang("general_save") ?></button>
                </div>
            </div>
            <input type="hidden" name="id" id="vehicle_register_id">
            <?php echo form_close(); ?>
        </div>
    </div>

    <div id="jqxPopupWindowTrack_record">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title' id="window_poptup_track_title">Track Form</span>
        </div>
        <div class="form_fields_area">
            <?php echo form_open('', array('id' => 'form-track_records', 'onsubmit' => 'return false')); ?>
            <table class="form-table">
                <input type = "hidden" name = "id" id = "dispatch_records_track_id"/>
                <input type = "hidden" name = "vehicle_id" id = "vehicle_id_true"/>  
                <input type = "hidden" name = "variant_id" id = "variant_id_true"/>  
                <input type = "hidden" name = "color_id" id = "color_id_true"/>
                <tr id="act_location">
                    <td>
                        <label for="location">Select Location</label>
                    </td>
                    <td>
                        <select name="label" class="jqx-listmenu-item jqx-fill-state-small jqx-item" id="track_record">
                            <option value="">--select option--</option>
                            <option value="indian_stock_yard"><?php echo lang('indian_stock_yard') ?></option>
                            <option value="indian_custom"><?php echo lang('indian_custom') ?></option>
                            <option value="nepal_custom"><?php echo lang('nepal_custom') ?></option>
                        </select>
                    </td>
                    <td><label for="Date">Choose Date</label></td>
                    <td><div id='date' class='date_box' name='date'></div></td>
                </tr>        
                <tr id="indian_stockyar_name" style="display: none;">
                    <td><label for="indian_stockyar_name"><?php echo "Stockyard Name";?></label></td>
                    <td>
                        <select name="indian_stockyar_name" class="jqx-listmenu-item jqx-fill-state-normal jqx-item" id="india_stockyard">
                            <option><?php echo "GRP STOCKYARD"; ?></option>
                            <option><?php echo "RXL STOCKYARD"; ?></option>                           
                        </select>
                    </td>
                </tr>
                <tr id="stockyard_list" style="display: none;">
                    <td><label for="dispatch_to" id="stock_yard_id_label"><?php echo "Dispatch to Stockyard";?></label></td>
                    <td><div name="stock_yard_id"  id="stock_yard_id"></div>
                    </td>
                </tr>
                <tr id="custom_list" style="display: none;">
                    <td><label for="dispatch_to" id="stock_yard_id_label"><?php echo "Dispatch to Custom";?></label></td>
                    <td>
                        <select name="custom_name" class="jqx-listmenu-item jqx-fill-state-normal jqx-item" id="custom_name">
                            <option value="">--select option--</option>
                            <option value="RXL CUSTOMS"><?php echo "RXL Custom"; ?></option>
                            <option value="GRP CUSTOMS"><?php echo "GRP Custom"; ?></option>                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxTrack_recordSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxtrack_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>

            </table>
            <?php echo form_close(); ?>
        </div>
    </div>

    <div id="jqxPopupWindowPragyapan">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title'>Cancel Form</span>
        </div>
        <div class="form_fields_area">
            <?php echo form_open('', array('id' => 'form-Pragyapan_add', 'onsubmit' => 'return false')); ?>
            <input type = "hidden" name = "vehicle_id" id = "pragyapan_vehicle_id"/>
            <table class="form-table app-table">
                <tr>
                    <td> <label><span>Pragyapan Patra No.</span></label> </td>
                    <td> <input type="text" name="pragyapan_no" class="text_input" id="pragyapan_no"></td>
                </tr>
                <tr>
                    <td> <label><span>Pragyapan Received Date:</span></label> </td>
                    <td> <div id="pragyapan_date" name= "pragyapan_date"></div></td>
                </tr>
                <tr>
                    <th colspan="3">
                        <button type="button" class="btn btn-success btn-md btn-flat" id="jqxPragyapanSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-md btn-flat" id="jqxPragyapanCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>

            </table>
            <?php echo form_close(); ?>
        </div>
    </div>
        <div id="jqxPopupWindowFuelKms">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title'>Add Fuel Kms</span>
        </div>
        <div class="form_fields_area">
            <?php echo form_open('', array('id' => 'form-Fuel_kms', 'onsubmit' => 'return false')); ?>
            <input type = "hidden" name = "fuel_msil_id" id = "fuel_msil_id"/>
            <table class="form-table app-table">
                <tr>
                    <td> <label><span>Choose Location</span></label> </td>
                    <td> <div name="fuel_location" id="fuel_location"></div></td>
                </tr>
                <tr>
                    <td> <label><span>Fuel:</span></label> </td>
                    <td> <input type="text" name="fuel_quantity" class="text_input" id="fuel_quantity"></td>
                </tr>
                <tr>
                    <td> <label><span>Kms:</span></label> </td>
                    <td> <input type="text" name="fuel_kms" class="text_input" id="fuel_kms"></td>
                </tr>
                <tr>
                    <th colspan="3">
                        <button type="button" class="btn btn-success btn-md btn-flat" id="jqxFuelKmsSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-md btn-flat" id="jqxFuelKmsCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
            </table>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div id="jqxPopupWindowViewFuelKms">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title'>View Fuel Kms</span>
        </div>
        <div class="form_fields_area">
            <table class="table table-striped" id="view_fuel_kms">  
            </table>
        </div>
    </div>

    <script language="javascript" type="text/javascript">

        $(function () {

            $("#pragyapan_date").jqxDateTimeInput({ width: '250px', height: '25px', formatString: "yyyy-MM-dd" });

            var stockyardDataSource  = {
               url : '<?php echo site_url("admin/stock_records/get_stockyard_combo_json"); ?>',
               datatype: 'json',
               datafields: [
               { name: 'id', type: 'number' },
               { name: 'name', type: 'string' },
               ],
               async: false,
               cache: true
           }

           stockyardDataAdapter = new $.jqx.dataAdapter(stockyardDataSource);

           $("#stock_yard_id").jqxComboBox({
               theme: theme,
               width: 195,
               height: 25,
               placeHolder: "Select Stockyard",
               selectionMode: 'dropDownList',
               autoComplete: true,
               searchMode: 'containsignorecase',
               source: stockyardDataAdapter,
               displayMember: "name",
               valueMember: "id",
           });

            var fuel_location = ["India stock to India Customs","India Customs to Nepal Customs","Nepal Customs to CG stock Yard","CG stock yaard to ktm stock yard/dealers","Ktm stock yard to show room test drive/internal stock yard"];

             $("#fuel_location").jqxComboBox({
                 theme: theme,
                 width: 195,
                 height: 25,
                 placeHolder: "Select Location",
                 selectionMode: 'dropDownList',
                 autoComplete: true,
                 searchMode: 'containsignorecase',
                 source: fuel_location           
             });


           var dispatch_recordsDataSource =
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
            {name: 'engine_no', type: 'string'},
            {name: 'chass_no', type: 'string'},
            {name: 'dispatch_date', type: 'date'},
            {name: 'month', type: 'number'},
            {name: 'year', type: 'number'},
            {name: 'order_no', type: 'number'},
            {name: 'ait_reference_no', type: 'string'},
            {name: 'invoice_no', type: 'string'},
            {name: 'invoice_date', type: 'date'},
            {name: 'transit', type: 'number'},
            {name: 'transit_status', type: 'number'},
            {name: 'indian_stock_yard', type: 'date'},
            {name: 'stock_transfer_date', type: 'date'},
            {name: 'dispatched_date', type: 'date'},
            {name: 'indian_custom', type: 'date'},
            {name: 'nepal_custom', type: 'date'},
            {name: 'stockyard_name', type: 'string'},
            {name: 'barcode', type: 'string'},
            {name: 'vehicle_name', type: 'string'},
            {name: 'variant_name', type: 'string'},
            {name: 'color_name', type: 'string'},
            {name: 'color_code', type: 'string'},
            {name: 'custom_name', type: 'string'},
            {name: 'vehicle_register_no', type: 'string'},
            {name: 'current_location', type: 'string'},
            {name: 'current_status', type: 'string'},
            {name: 'key_no', type: 'string'},
            {name: 'pragyapan_no', type: 'string'},
            {name: 'pragyapan_date', type: 'string'},
            {name: 'pragyapan_date_np', type: 'string'},
            {name: 'stock_transfer_from', type: 'string'},
            {name: 'firm_name', type: 'string'},
            ],
            url: '<?php echo site_url("admin/dispatch_records/json"); ?>',
            pagesize: defaultPageSize,
            root: 'rows',
            id: 'id',
            cache: true,
            pager: function (pagenum, pagesize, oldpagenum) {
                        //callback called when a page or page size is changed.
                    },
                    beforeprocessing: function (data) {
                        dispatch_recordsDataSource.totalrecords = data.total;
                    },
                    // update the grid and send a request to the server.
                    filter: function () {
                        $("#jqxGridDispatch_record").jqxGrid('updatebounddata', 'filter');
                    },
                    // update the grid and send a request to the server.
                    sort: function () {
                        $("#jqxGridDispatch_record").jqxGrid('updatebounddata', 'sort');
                    },
                    processdata: function (data) {
                    }
                };

                $("#jqxGridDispatch_record").jqxGrid({
                    theme: theme,
                    width: '100%',
                    height: gridHeight,
                    source: dispatch_recordsDataSource,
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
                    selectionmode: 'multiplecellsadvanced',
                    virtualmode: true,
                    enableanimations: false,
                    pagesizeoptions: pagesizeoptions,
                    showtoolbar: true,
                    rendertoolbar: function (toolbar) {
                        var container = $("<div style='margin: 5px; height:50px'></div>");
                        container.append($('#jqxGridDispatch_recordToolbar').html());
                        toolbar.append(container);
                    },
                    columns: [
                    {text: 'SN', width: 50, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
                    {
                        text: 'Action', datafield: 'action', width: 100, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
                        cellsrenderer: function (index) {
                            var rows = $('#jqxGridDispatch_record').jqxGrid('getrowdata',index);
                            var e = '';
                            e +='<a href="javascript:void(0)" onclick="editDispatch_recordRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp';
                            if(rows.current_status != 'retail')
                            {
                                e += '<a href="javascript:void(0)" onclick="updateDispatch_recordRecord(' + index + '); return false;" title="Tracking"><i class="fa fa-clock-o"></i></a>&nbsp';
                            }
                            e += '<a href="javascript:void(0)" onclick="updateVehicle_register(' + index + '); return false;" title="Vehicle Reg. Entry"><i class="fa fa-bus"></i></a>&nbsp';
                            e += '<a href="javascript:void(0)" onclick="add_pragyapan(' + index + '); return false;" title="Pragyapan Entry"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>&nbsp';
                            e += '<a href="javascript:void(0)" onclick="add_fuel_kms(' + index + '); return false;" title="Add Fuel and Kms"><i class="fa fa-plus" aria-hidden="true"></i></a>&nbsp';
                            e += '<a href="javascript:void(0)" onclick="view_kms(' + index + '); return false;" title="View Fuel and Kms"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                            return '<div style="text-align: center; margin-top: 8px;">' + e +'</div>';
                        }
                    },
                    {text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_name', width: 130, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 120, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("chass_no"); ?>', datafield: 'chass_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("engine_no"); ?>', datafield: 'engine_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("color_id"); ?>', datafield: 'color_code', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("color_name"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("dispatch_date"); ?>', datafield: 'dispatch_date', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("month"); ?>', datafield: 'month', width: 100, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("year"); ?>', datafield: 'year', width: 100, filterable: true, renderer: gridColumnsRenderer},
                    {text: 'Company', datafield: 'firm_name', width: 180, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("invoice_no"); ?>', datafield: 'invoice_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("invoice_date"); ?>', datafield: 'invoice_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("transit"); ?>', datafield: 'transit_status', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("pragyapan_no"); ?>', datafield: 'pragyapan_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("pragyapan_date"); ?>', datafield: 'pragyapan_date', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("indian_stock_yard"); ?>', datafield: 'indian_stock_yard', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("indian_custom"); ?>', datafield: 'indian_custom', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("nepal_custom"); ?>', datafield: 'nepal_custom', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("current_location"); ?>', datafield: 'current_location', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("stock_transfer_from"); ?>', datafield: 'stock_transfer_from', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    {text: '<?php echo lang("stock_transfer_date"); ?>', datafield: 'stock_transfer_date', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("dispatched_date"); ?>', datafield: 'dispatched_date', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
                    {text: '<?php echo lang("key_no"); ?>', datafield: 'key_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                    ],
                    rendergridrows: function (result) {
                        return result.data;
                    }
                });

$("[data-toggle='offcanvas']").click(function (e) {
    e.preventDefault();
    setTimeout(function () {
        $("#jqxGridDispatch_record").jqxGrid('refresh');
    }, 500);
});

$(document).on('click', '#jqxGridDispatch_recordFilterClear', function () {
    $('#jqxGridDispatch_record').jqxGrid('clearfilters');
});

$(document).on('click', '#jqxGridDispatch_recordInsert', function () {
    openPopupWindow('jqxPopupWindowDispatch_record', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
});

        // initialize the popup window
         $("#jqxPopupWindowViewFuelKms").jqxWindow({
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

        $("#jqxPopupWindowFuelKms").jqxWindow({
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
        $("#jqxPopupWindowFuelKms").on('close', function () {
            //reset_form_Pragyapans();
        });

        $("#jqxFuelKmsCancelButton").on('click', function () {
            //reset_form_Pragyapans();
            $('#jqxPopupWindowFuelKms').jqxWindow('close');
        });

        $('#form-Fuel_kms').jqxValidator({
         hintType: 'label',
         animationDuration: 500,
         rules: [
         { input: '#fuel_kms', message: 'Required', action: 'blur', 
         rule: function(input) {
             val = $('#fuel_kms').val();
             return (val == '' || val == null || val == 0) ? false: true;
         }},
         { input: '#fuel_quantity', message: 'Required', action: 'blur', 
         rule: function(input) {
             val = $('#fuel_quantity').val();
             return (val == '' || val == null || val == 0) ? false: true;
         }},
         { input: '#fuel_location', message: 'Required', action: 'blur', 
         rule: function(input) {
             val = $('#fuel_location').val();
             return (val == '' || val == null || val == 0) ? false: true;
         }},
         { input: '#fuel_location', message: 'Entry Already Exists', action: 'blur', 
         rule: function(input, commit) {
             val = $('#fuel_location').val();
             $.ajax({
                url: "<?php echo site_url('admin/dispatch_records/check_duplicate'); ?>",
                type: 'POST',
                data: {value: val, vehicle_id:$('input#fuel_msil_id').val()},
                success: function (result) {
                    var result = eval('('+result+')');
                    return commit(result.success);
                },
                error: function(result) {
                    return commit(false);
                }
            });
         }},

         ] });

        $("#jqxFuelKmsSubmitButton").on('click', function () {
         var validationResult = function (isValid) {
             if (isValid) {
                save_Kms()
            } };
            $('#form-Fuel_kms').jqxValidator('validate', validationResult);
        });

        $("#jqxPopupWindowDispatch_record").jqxWindow({
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
        $("#jqxPopupWindowTrack_record").jqxWindow({
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
        $("#jqxPopupWindowVehicle_register").jqxWindow({
            theme: theme,
            width: '40%',
            maxWidth: '80%',
            height: '35%',
            maxHeight: '70%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowDispatch_record").on('close', function () {
            reset_form_dispatch_records();
        });

        $("#jqxDispatch_recordCancelButton").on('click', function () {
            reset_form_dispatch_records();
            $('#jqxPopupWindowDispatch_record').jqxWindow('close');
        });
        $("#jqxtrack_recordCancelButton").on('click', function () {
            reset_form_dispatch_records();
            $('#jqxPopupWindowTrack_record').jqxWindow('close');
        });

        // Add Pragyapan
        $("#jqxPopupWindowPragyapan").jqxWindow({
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
        $("#jqxPopupWindowPragyapan").on('close', function () {
            reset_form_Pragyapans();
        });

        $("#jqxPragyapanCancelButton").on('click', function () {
            reset_form_Pragyapans();
            $('#jqxPopupWindowPragyapan').jqxWindow('close');
        });


        $('#form-vehicle_register').jqxValidator({
            hintType: 'label',
            animationDuration: 500,
            rules: [ 
            { input: '#form-vehicle_register input[name=vehicle_register_no]', message: 'Required', action: 'blur', rule: 'required'}, 
            { input: '#form-vehicle_register input[name=vehicle_register_date]', message: 'Required', action: 'blur', rule: 'required'},
            ]
        });
        /*$('#form-dispatch_records').jqxValidator({
         hintType: 'label',
         animationDuration: 500,
         rules: [
         { input: '#created_by', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#created_by').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#updated_by', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#updated_by').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#deleted_by', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#deleted_by').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#created_at', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#created_at').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#updated_at', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#updated_at').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#deleted_at', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#deleted_at').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#vehicle_id', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#vehicle_id').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#variant_id', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#variant_id').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#color_id', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#color_id').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#engine_no', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#engine_no').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#chass_no', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#chass_no').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#dispatch_date', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#dispatch_date').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#month', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#month').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#year', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#year').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#order_no', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#order_no').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#ait_reference_no', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#ait_reference_no').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#invoice_no', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#invoice_no').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#invoice_date', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#invoice_date').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#transit', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#transit').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#indian_stock_yard', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#indian_stock_yard').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#indian_custom', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#indian_custom').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#nepal_custom', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#nepal_custom').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#border', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#border').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#barcode', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#barcode').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         ]
     });*/
     $('#jqxVechile_registerButton').on('click',function(){

        var validationResult = function (isValid) {
            if (isValid) {
                saveVehicle_Registers();
            }
        };
        $('#form-vehicle_register').jqxValidator('validate', validationResult);

    });

     $("#jqxDispatch_recordSubmitButton").on('click', function () {
        saveDispatch_recordRecord();
            /*
             var validationResult = function (isValid) {
             if (isValid) {
             saveDispatch_recordRecord();
             }
             };
             $('#form-dispatch_records').jqxValidator('validate', validationResult);
             */
         });
     $("#jqxTrack_recordSubmitButton").on('click', function () {
        saveTrack_recordRecord();
            /*
             var validationResult = function (isValid) {
             if (isValid) {
             saveDispatch_recordRecord();
             }
             };
             $('#form-dispatch_records').jqxValidator('validate', validationResult);
             */
         });

     $('#form-Pragyapan_add').jqxValidator({
       hintType: 'label',
       animationDuration: 500,
       rules: [
       { input: '#pragyapan_no', message: 'Required', action: 'blur', 
       rule: function(input) {
           val = $('#pragyapan_no').val();
           return (val == '' || val == null || val == 0) ? false: true;
       }
   }]
});

     $("#jqxPragyapanSubmitButton").on('click', function () {
       var validationResult = function (isValid) {
           if (isValid) {
            save_Pragyapan();
        }
    };
    $('#form-Pragyapan_add').jqxValidator('validate', validationResult);

});
 });

function add_pragyapan(index){
    var row = $("#jqxGridDispatch_record").jqxGrid('getrowdata', index);
    if (row) 
    {
        $('#pragyapan_vehicle_id').val(row.id);
        openPopupWindow('jqxPopupWindowPragyapan', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
    }
}

function editDispatch_recordRecord(index) {
    var row = $("#jqxGridDispatch_record").jqxGrid('getrowdata', index);
    if (row) {
        $('#dispatch_records_id').val(row.id);
        $('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
        $('#variant_id').jqxNumberInput('val', row.variant_id);
        $('#color_id').jqxNumberInput('val', row.color_id);
        $('#engine_no').val(row.engine_no);
        $('#chass_no').val(row.chass_no);
        $('#dispatch_date').val(row.dispatch_date);
        $('#month').jqxNumberInput('val', row.month);
        $('#year').jqxNumberInput('val', row.year);
        $('#order_no').jqxNumberInput('val', row.order_no);
        $('#ait_reference_no').val(row.ait_reference_no);
        $('#invoice_no').jqxNumberInput('val', row.invoice_no);
        $('#invoice_date').val(row.invoice_date);
        $('#transit').jqxNumberInput('val', row.transit);

        openPopupWindow('jqxPopupWindowDispatch_record', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
    }
}

function saveDispatch_recordRecord() {
    var data = $("#form-dispatch_records").serialize();

    $('#jqxPopupWindowDispatch_record').block({
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
        url: '<?php echo site_url("admin/dispatch_records/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('(' + result + ')');
            if (result.success) {
                reset_form_dispatch_records();
                $('#jqxGridDispatch_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowDispatch_record').jqxWindow('close');
            }
            $('#jqxPopupWindowDispatch_record').unblock();
        }
    });
}

function saveVehicle_Registers(){
   var data = $("#form-vehicle_register").serialize();
   $.ajax({
    type: "POST",
    url: '<?php echo site_url("admin/dispatch_records/save_vehicle_register"); ?>',
    data: data,
    success: function (result) {
        var result = eval('(' + result + ')');
        if (result.success) {
                // reset_form_dispatch_records();
                $('#jqxGridDispatch_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowVehicle_register').jqxWindow('close');
            }
            $('#jqxPopupWindowVehicle_register').unblock();
        }
    });
}

//    for tracking
function saveTrack_recordRecord() {
    var data = $("#form-track_records").serialize();

    $('#jqxPopupWindowTrack_record').block({
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
        url: '<?php echo site_url("admin/dispatch_records/track"); ?>',
        data: data,
        success: function (result) {
            var result = eval('(' + result + ')');
            if (result.success) {
                reset_form_dispatch_records();
                $('#jqxGridDispatch_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowTrack_record').jqxWindow('close');
            }
            $('#jqxPopupWindowTrack_record').unblock();
        }
    });
}

function reset_form_dispatch_records() {
    $('#dispatch_records_id').val('');
    $('#form-dispatch_records')[0].reset();
}

//    save Pragyapan
function save_Pragyapan() {
    var data = $("#form-Pragyapan_add").serialize();

    $('#jqxPopupWindowPragyapan').block({
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
        url: '<?php echo site_url("admin/dispatch_records/save_pragyapan"); ?>',
        data: data,
        success: function (result) {
            var result = eval('(' + result + ')');
            if (result.success) {
                reset_form_dispatch_records();
                $('#jqxGridDispatch_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowPragyapan').jqxWindow('close');
            }
            $('#jqxPopupWindowPragyapan').unblock();
        }
    });
}

function reset_form_Pragyapans() {
    $('#pragyapan_vehicle_id').val('');
    $('#form-Pragyapan_add')[0].reset();
}

//    for tracking form
function updateDispatch_recordRecord(index){
    var row = $("#jqxGridDispatch_record").jqxGrid('getrowdata', index);
    if (row) {
        $('#dispatch_records_track_id').val(row.id);
        $('#indian_stock_yard').val(row.indian_stock_yard);
        $('#indian_custom').val(row.indian_custom);
        $('#nepal_custom').val(row.nepal_custom);
        $('#border').val(row.border);
        $('#barcode').val(row.barcode);
        $('#vehicle_id_true').val(row.vehicle_id);
        $('#variant_id_true').val(row.variant_id);
        $('#color_id_true').val(row.color_id);
        openPopupWindow('jqxPopupWindowTrack_record', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
    }
}

function updateVehicle_register(index)
{
    var row = $("#jqxGridDispatch_record").jqxGrid('getrowdata', index);
    if(row){
        $("#form-vehicle_register").find('input').val(function(i,v){
            return row[this.name];
        });

        openPopupWindow('jqxPopupWindowVehicle_register', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
    }
    
}

$('#track_record').change(function(){
    var current = $('#track_record').val();
    if(current == 'indian_stock_yard')
    {
        $('#stockyard_list').hide();
        $('#custom_list').hide();
        $('#indian_stockyar_name').show();
    }
    else if(current == 'indian_custom')
    {
        $('#indian_stockyar_name').hide();
        $('#custom_list').show();
        $('#stockyard_list').hide();
    }
    else 
    {
        $('#indian_stockyar_name').hide();
        $('#stockyard_list').show();
        $('#custom_list').hide();
    }

});

function add_fuel_kms(index)
{
    var row = $("#jqxGridDispatch_record").jqxGrid('getrowdata', index);
    if (row) {
        $('#fuel_msil_id').val(row.id);
        openPopupWindow('jqxPopupWindowFuelKms');
    }
}

//    save Pragyapan
function save_Kms() {
    var data = $("#form-Fuel_kms").serialize();

    $('#jqxPopupWindowFuelKms').block({
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
        url: '<?php echo site_url("admin/dispatch_records/save_fuel_kms"); ?>',
        data: data,
        success: function (result) {
            var result = eval('(' + result + ')');
            if (result.success) {
                reset_form_dispatch_records();
                $('#jqxGridDispatch_record').jqxGrid('updatebounddata');
                $('#jqxPopupWindowFuelKms').jqxWindow('close');
            }
            $('#jqxPopupWindowFuelKms').unblock();
        }
    });
}

function view_kms(index){
    var row = $("#jqxGridDispatch_record").jqxGrid('getrowdata', index);
    if (row) 
    {     
        $.post('<?php echo site_url('admin/dispatch_records/get_fuel_kms')?>',{id:row.id},function(result)
        {
            $('#view_fuel_kms').html('');
            $('#view_fuel_kms').append('<tr> <th>Date</th> <th>Location</th> <th>Fuel</th> <th>Kms</th> </tr>');
            $.each(result.data,function(key,val)
            {
                $('#view_fuel_kms').append('<tr><td>'+val.date+'</td><td>'+val.location+'</td><td>'+val.fuel+'</td><td>'+val.kms+'</td></tr>')
            });
        },'json');    
        openPopupWindow('jqxPopupWindowViewFuelKms');
    }
}

</script>