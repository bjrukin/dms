    <style>
    table.form-table td:nth-child(odd){
        width: 10% !important;
    }
    table.form-table td:nth-child(even){
        width: 2% !important;
    }
    .textbox {
        height: 100px;
        width: 200px;
        border-radius: 5px;
        border-color: #ccc;
    }
    .cls-red { background-color: #F56969; }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo lang('credit_control'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo lang('credit_control'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <?php if($cancel_count > 0): ?>
                    <div class="row" style="float: right;"><div class="col-md-12"><a href="<?php echo site_url('dealer_orders/get_cancel_orders'); ?>" target = "_blank"><i class="fa fa-bell fa-2x" aria-hidden="true"></i><?php echo $cancel_count;?></a></div></div>
                <?php endif; ?>
                <div id="jqxGridDealer_order"></div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div id="jqxPopupWindowCredit_approve">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title'>Approval Form</span>
    </div>


    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-Credit_approve', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "approval_order_id"/>
        <input type = "hidden" name = "dealer_id" id = "dealer_id"/>
        <table class="form-table app-table">           
            <tr>
                <td><label for="payment_detail">Payment Detail</label></td>
                <td>:</td>
                <td><span id="payment_details"></span></td>       
            </tr>
            <tr>
                <td><label for="decision">Decision</label></td>
                <td>:</td>
                <td><div id="cc_decision" name="cc_decision"></div></td>       
            </tr>
            <tr id="remarks_credit" style="display: none;">
                <td><label>Remarks</label></td>
                <td>:</td>
                <td><input type="text" name="remarks_credit" class="text_area" id = 'remarks' hidden="true"></td>
            </tr>
            <tr id="on_hold_remark" style="display: none;">
                <td><label>Remarks</label></td>
                <td>:</td>
                <td><input type="text" name="on_hold_remarks" class="text_area" id = 'on_hold_remarks'></td>
            </tr>
            <tr> </tr>
            <tr>
                <th colspan="3">
                    <button type="button" class="btn btn-success btn-md btn-flat" id="jqxCredit_approveSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-md btn-flat" id="jqxCredit_approveCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="jqxPopupWindowCredit_reject">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title'>Reject Form</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-Credit_reject', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "reject_order_id"/>
        <input type = "hidden" name = "dealer_id" id = "reject_dealer_id"/>
        <table class="form-table app-table">           
            <tr>
                <td><label for="payment_detail">Payment Detail</label></td>
                <td>:</td>
                <td><span id="payment_details_reject"></span></td>       
            </tr>
            <tr id="remarks_credit">
                <td><label>Remarks</label></td>
                <td>:</td>
                <td><textarea name="remarks_credit" class="textbox" id = 'reject_remarks'></textarea></td>
            </tr>
            <tr> </tr>
            <tr>
                <th colspan="3">
                    <button type="button" class="btn btn-success btn-md btn-flat" id="jqxCredit_rejectSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-md btn-flat" id="jqxCredit_rejectCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>


<div id="jqxPopupWindowCredit_display">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title'>Display Form</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-Credit_display', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "display_vehicle_main_id"/>
        <input type = "hidden" name = "display_order_id" id = "display_order_id"/>
       
        <input type = "hidden" name = "current_location" id = "display_dealer"/>
        <table class="form-table app-table">           
          
            <tr id="remarks_credit">
                <td><label>Remarks</label></td>
                <td>:</td>
                <td><textarea name="displayremarks_credit" class="textbox" id = 'display_remarks'></textarea></td>
            </tr>
            <tr> </tr>
            <tr>
                <th colspan="3">
                    <button type="button" class="btn btn-success btn-md btn-flat" id="jqxCredit_displaySubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-md btn-flat" id="jqxCredit_displayCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="jqxPopupWindowCredit_cancel">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title'>Cancel Form</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-Credit_cancel', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "cancel_id" id = "cancel_order_id"/>
        <table class="form-table app-table">
            <tr>
                <td>
                    <label><span>Are you sure you want to cancel?</span></label>
                </td>
            </tr>
            <tr>
                <th colspan="3">
                    <button type="button" class="btn btn-success btn-md btn-flat" id="jqxCredit_cancelSubmitButton"><?php echo "YES"//lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-md btn-flat" id="jqxCredit_cancelCancelButton"><?php echo "NO"//lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="jqxPopupWindowCredit_edit">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title'>edit Form</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-Credit_edit', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "edit_order_id"/>
        <table class="form-table app-table">           
            <tr>
                <td><label for="payment_detail">Payment Detail</label></td>
                <td>:</td><td>
                    <select name="payment_method" id="payment_dropdown">
                        <option default>Select a Value</option>
                        <option value="Cash / others">Cash/others</option>
                        <option value="BG">BG</option>
                        <option value="LC">LC</option>
                        <option value="Cheque">Cheque</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Payment value</label></td>
                <td>:</td>
                <td><input name="payment_value" class="text_input" id = 'payment_value'></td>
            </tr>
            <tr> 
                <td><label>Remarks</label></td>
                <td>:</td>
                <td>
                    <input name="remarks" class="text_input" id='remark'>
                </td>
            </tr>
            <tr> </tr>
            <tr>
                <th colspan="3">
                    <button type="button" class="btn btn-success btn-md btn-flat" id="jqxCredit_editSubmitButton"><?php echo lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-md btn-flat" id="jqxCredit_editCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

    $(function () {
       var data = new Array();
       var decision = ["On Hold","Ready For Dispatch"];
       var k = 0;
       for (var i = 0; i < decision.length; i++) {
        var row = {};
        row["decisions"] = decision[k];
        data[i] = row;
        k++;
    }
    var source =
    {
        localdata: data,
        datatype: "array"
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $('#cc_decision').jqxComboBox({ selectedIndex: -1,  source: dataAdapter, displayMember: "decisions", itemHeight: 50, height: 25, width: 270,placeHolder:'Choose a option' });

    $("#cc_decision").on('select', function (event) {
        if (event.args) {
            var item = event.args.item;
            if (item.value == 'On Hold') {
                $('#on_hold_remark').show();
            }
            else
            {
                $('#on_hold_remark').hide();
            }
        }
    });

    var dealer_ordersDataSource =
    {
        datatype: "json",
        datafields: [
        {name: 'id', type: 'string'},
        {name: 'date_of_order', type: 'date'},
        {name: 'created_by', type: 'string'},
        {name: 'updated_by', type: 'string'},
        {name: 'created_at', type: 'date'},
        {name: 'updated_at', type: 'date'},
        {name: 'payment_status', type: 'string'},
        {name: 'vehicle_id', type: 'string'},
        {name: 'variant_id', type: 'string'},
        {name: 'color_id', type: 'string'},
        {name: 'challan_return_image', type: 'string'},
        {name: 'vehicle_main_id', type: 'string'},
        {name: 'payment_method', type: 'string'},
        {name: 'associated_value_payment', type: 'string'},
        {name: 'quantity', type: 'string'},
        {name: 'order_id', type: 'number'},
        {name: 'dealer_id', type: 'string'},
        {name: 'dealer_name', type: 'string'},
        {name: 'incharge_id', type: 'string'},
        {name: 'year', type: 'string'},
        {name: 'cancel_quantity', type: 'string'},
        {name: 'cancel_date', type: 'date'},
        {name: 'cancel_date_np', type: 'string'},
        {name: 'credit_control_approval', type: 'string'},
        {name: 'credit_control_approve_date', type: 'date'},
        {name: 'credit_control_approve_date_np', type: 'string'},
        {name: 'credit_approve_date', type: 'date'},
        {name: 'credit_approve_date_np', type: 'string'},
        {name: 'credit_hold_date', type: 'date'},
        {name: 'credit_hold_date_np', type: 'string'},
        {name: 'on_hold_remarks', type: 'string'},
        {name: 'remarks', type: 'string'},
        {name: 'grn_received_date', type: 'date'},
        {name: 'grn_received_date_np', type: 'string'},
        {name: 'order_month_id', type: 'string'},
        {name: 'received_date', type: 'string'},
        {name: 'vehicle_name', type: 'string'},
        {name: 'order_type', type: 'string'},
        {name: 'variant_name', type: 'string'},
        {name: 'color_name', type: 'string'},
        {name: 'color_code', type: 'string'},
        {name: 'engine_no', type: 'string'},
        {name: 'chass_no', type: 'string'},
        {name: 'dealer_dispatch_date', type: 'date'},
        {name: 'dealer_dispatch_date_np', type: 'string'},
        {name: 'dealer_received_date', type: 'date'},
        {name: 'dealer_received_date_np', type: 'string'},
        {name: 'customer_retail_date', type: 'date'},
        {name: 'customer_retail_date_np', type: 'string'},
        {name: 'stock_id', type: 'string'},
        {name: 'dispatch_id', type: 'string'},
        {name: 'vehicle_ageing', type: 'number'},
        {name: 'order_ageing', type: 'number'},
        {name: 'credit_control_ageing', type: 'number'},
        {name: 'logistic_ageing', type: 'number'},
        {name: 'dispatch_ageing', type: 'number'},
        {name: 'payment_value', type: 'string'},
        {name: 'month_name', type: 'string'},
        {name: 'reject_reason', type: 'string'},
        {name: 'nepali_month', type: 'string'},
        {name: 'payment_edit', type: 'number'},
        {name: 'order_status', type: 'string'},
        {name: 'grn_file', type: 'string'},
        {name: 'grn_status', type: 'string'},
        {name: 'bill_nepali_month', type: 'string'},
        {name: 'logistic_confirmation_date', type: 'date'},

        ],
        url: '<?php echo site_url("admin/dealer_orders/credit_control_json"); ?>',
        pagesize: defaultPageSize,
        root: 'rows',
        id: 'id',
        cache: true,
        pager: function (pagenum, pagesize, oldpagenum) {
        },
        beforeprocessing: function (data) {
            dealer_ordersDataSource.totalrecords = data.total;
        },
        filter: function () {
            $("#jqxGridDealer_order").jqxGrid('updatebounddata', 'filter');
        },
        sort: function () {
            $("#jqxGridDealer_order").jqxGrid('updatebounddata', 'sort');
        },
        processdata: function (data) {
        }
    };
    var cellclassname =  function (row, column, value, data) {
        if (data.payment_edit == 1) {
            return 'cls-red';
        }
    };
    $("#jqxGridDealer_order").jqxGrid({
        theme: theme,
        width: '100%',
        height: gridHeight,
        source: dealer_ordersDataSource,
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
            container.append($('#jqxGridDealer_orderToolbar').html());
            toolbar.append(container);
        },
        columns: [
        {text: 'SN', width: 50, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
        {
            text: 'Action', datafield: 'action', width: 100, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
            cellsrenderer: function (index) {
                var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
                var e = '';
                <?php if(is_credit_control() || is_admin()):?>
                if(row.credit_control_approval != 1 && row.credit_control_approval != 4){
                    e = '<a href="javascript:void(0)" onclick="credit_approve(' + index  + '); return false;" title="Approve"><i class="fa fa-check"></i></a> &nbsp';
                }
                if(row.credit_control_approval ==1 && row.credit_control_approval != 4)
                {
                    <?php if(is_admin()): ?>
                    e += '<a href="javascript:void(0)" onclick="credit_cancel(' + index + '); return false;" title="Cancel Approval"><i class="fa fa-times"></i></a> &nbsp';
                    <?php endif;?>
                }

                if(row.credit_control_approval != 2)
                {
                    e += '<a href="javascript:void(0)" onclick="credit_reject(' + index + '); return false;" title="Reject"><i class="fa fa-ban"></i></a> &nbsp';
                }



                if(row.credit_control_approval != 4)
                {
                    e += '<a href="javascript:void(0)" onclick="credit_display(' + index + '); return false;" title="Display"><i class="fa fa-eye"></i></a> &nbsp';
                }
                e += '<a href="javascript:void(0)" onclick="credit_edit(' + index + '); return false;" title="Edit Payment"><i class="fa fa-edit"></i></a> &nbsp';

                e += '<a href="javascript:void(0)" onclick="allow_grn_upload(' + index + '); return false;" title="Grn Upload Allow"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a> &nbsp';
                <?php endif; ?>
                if(row.grn_received_date)
                {
                    var url = '<?php echo base_url('uploads/grn_file')?>';
                    e += '<a href="'+url+'/'+row.grn_file+'" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> &nbsp';
                }
                return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
            }
        },
        {text: '<?php echo lang("order_id");?>', datafield: 'order_id', width: 60, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("order_status");?>', datafield: 'order_status', width: 100, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname },
        {text: '<?php echo lang("grn_status"); ?>', datafield: 'grn_status', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
        {text: '<?php echo lang("dealer_name");?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_name', width: 120, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("color_code"); ?>', datafield: 'color_code', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("color_id"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("year"); ?>', datafield: 'year', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("month_name"); ?>', datafield: 'nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("order_type"); ?>', datafield: 'order_type', width: 120, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("payment_value"); ?>', datafield: 'payment_value', width: 130, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("date_of_order"); ?>', datafield: 'date_of_order', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd , cellclassname:cellclassname},
        {text: '<?php echo lang("credit_control_approve_date"); ?>', datafield: 'credit_approve_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd , cellclassname:cellclassname},
        {text: 'C. C. Hold Date', datafield: 'credit_hold_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd , cellclassname:cellclassname},
        {text: '<?php echo lang("credit_control_ageing"); ?>', datafield: 'credit_control_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo "Bill Month"//lang("nepali_month"); ?>', datafield: 'bill_nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("dealer_dispatch_date"); ?>', datafield: 'dealer_dispatch_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd , cellclassname:cellclassname},
        {text: '<?php echo lang("dispatch_ageing"); ?>', datafield: 'dispatch_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("engine_no"); ?>', datafield: 'engine_no', width: 110, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("chass_no"); ?>', datafield: 'chass_no', width: 150, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname},
        {text: '<?php echo lang("dealer_received_date"); ?>', datafield: 'dealer_received_date', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd , cellclassname:cellclassname},
        {text: '<?php echo lang("logistic_confirmation_date"); ?>', datafield: 'logistic_confirmation_date', width: 110, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname:cellclassname},
        {text: '<?php echo lang("grn_received_date"); ?>', datafield: 'grn_received_date', width: 190, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd , cellclassname:cellclassname},
         {text: '<?php echo 'Payment Edit Remark';?>', datafield: 'remarks', width: 100, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname },

        {text: '<?php echo lang("on_hold_remarks");?>', datafield: 'on_hold_remarks', width: 100, filterable: true, renderer: gridColumnsRenderer , cellclassname:cellclassname },
        ],
        rendergridrows: function (result) {
            return result.data;
        }
    });

    $("[data-toggle='offcanvas']").click(function (e) {
        e.preventDefault();
        setTimeout(function () {
            $("#jqxGridDealer_order").jqxGrid('refresh');
        }, 500);
    });

    $(document).on('click', '#jqxGridDealer_orderFilterClear', function () {
        $('#jqxGridDealer_order').jqxGrid('clearfilters');
    });

    $(document).on('click', '#jqxGridDealer_orderInsert', function () {
        openPopupWindow('jqxPopupWindowDealer_order', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
    });
});

        // Approve Credit Control
        $("#jqxPopupWindowCredit_approve").jqxWindow({
            theme: theme,
            width: '60%',
            maxWidth: '60%',
            height: '60%',
            maxHeight: '60%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowCredit_approve").on('close', function () {
        });

        $('#form-Credit_approve').jqxValidator({
            hintType: 'label',
            animationDuration: 500,
            rules: [
            { input: '#remarks', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#remarks').val();
                var hidden = $('#remarks').attr('hidden');
                if(hidden == 'hidden')
                {
                    return true;
                }
                else
                {
                    return (val == '' || val == null || val == 0) ? false: true;
                }
            }},
            { input: '#cc_decision', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#cc_decision').jqxComboBox('val');

                return (val == '' || val == null || val == 0) ? false: true;
            }},
            { input: '#on_hold_remarks', message: 'Required', action: 'blur', 
            rule: function(input) {
                on_hold = $('#cc_decision').jqxComboBox('val');
                val = $('#on_hold_remarks').val();
                if(on_hold == 'On Hold')
                {
                    return (val == '' || val == null || val == 0) ? false: true;
                }
                else
                {
                    return true;
                }
            }},

            ]
        });

        $("#jqxCredit_approveSubmitButton").on('click', function () {
           var validationResult = function (isValid) {
            if (isValid) {
               save_Credit_approve();
           }
       };
       $('#form-Credit_approve').jqxValidator('validate', validationResult);

   });
        $("#jqxCredit_approveCancelButton").on('click', function () {
            $('#jqxPopupWindowCredit_approve').jqxWindow('close');
        });

        // Credit Reject
        $("#jqxPopupWindowCredit_reject").jqxWindow({
            theme: theme,
            width: '40%',
            maxWidth: '40%',
            height: '30%',
            maxHeight: '30%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowCredit_reject").on('close', function () {
        });

        $('#form-Credit_reject').jqxValidator({
            hintType: 'label',
            animationDuration: 500,
            rules: [
            { input: '#reject_remarks', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#reject_remarks').val();
                return (val == '' || val == null || val == 0) ? false: true; 
            } 
        }] 
    });

        $("#jqxCredit_rejectSubmitButton").on('click', function () {
           var validationResult = function (isValid) {
            if (isValid) {
               save_Credit_reject();
           }
       };
       $('#form-Credit_reject').jqxValidator('validate', validationResult);

   });
        $("#jqxCredit_rejectCancelButton").on('click', function () {
            $('#jqxPopupWindowCredit_reject').jqxWindow('close');
        });


 // Credit Display
        $("#jqxPopupWindowCredit_display").jqxWindow({
            theme: theme,
            width: '40%',
            maxWidth: '40%',
            height: '30%',
            maxHeight: '30%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowCredit_display").on('close', function () {
        });

        $('#form-Credit_display').jqxValidator({
            hintType: 'label',
            animationDuration: 500,
            rules: [
            { input: '#display_remarks', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#display_remarks').val();
                return (val == '' || val == null || val == 0) ? false: true; 
            } 
        }] 
    });

        $("#jqxCredit_displaySubmitButton").on('click', function () {
           var validationResult = function (isValid) {
            if (isValid) {
               save_Credit_display();
           }
       };
       $('#form-Credit_display').jqxValidator('validate', validationResult);

   });
        $("#jqxCredit_displayCancelButton").on('click', function () {
            $('#jqxPopupWindowCredit_display').jqxWindow('close');
        });


        // credit edit
        $("#jqxPopupWindowCredit_edit").jqxWindow({
            theme: theme,
            width: '40%',
            maxWidth: '40%',
            height: '50%',
            maxHeight: '50%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowCredit_edit").on('close', function () {
        });

        $('#form-Credit_edit').jqxValidator({
            hintType: 'label',
            animationDuration: 500,
            rules: [
            { input: '#payment_value', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#payment_value').val();
                var payment_mode = $('#payment_dropdown').val();
                if(payment_mode == 'bg')
                {
                    return true;
                }
                else
                {
                    return (val == '' || val == null || val == 0) ? false: true; 
                }
            } 
        },{ input: '#remark', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#remark').val();
                return (val == '' || val == null || val == 0) ? false: true; 
            } 
        }] 
    });

        $("#jqxCredit_editSubmitButton").on('click', function () {
           var validationResult = function (isValid) {
            if (isValid) {
               save_Credit_edit();
           }
       };
       $('#form-Credit_edit').jqxValidator('validate', validationResult);

   });
        $("#jqxCredit_editCancelButton").on('click', function () {
            $('#jqxPopupWindowCredit_edit').jqxWindow('close');
        });

        // Cancel Approval
        $("#jqxPopupWindowCredit_cancel").jqxWindow({
            theme: theme,
            width: '40%',
            maxWidth: '40%',
            height: '50%',
            maxHeight: '50%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowCredit_cancel").on('close', function () {
        });
        $("#jqxCredit_cancelSubmitButton").on('click', function () {
           save_Credit_cancel();
       });

        $("#jqxCredit_cancelCancelButton").on('click', function () {
            $('#jqxPopupWindowCredit_cancel').jqxWindow('close');
        });

        function credit_approve(index){
            $('#on_hold_remarks').val('');
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
            {
                $('#approval_order_id').val(row.id);
                $('#dealer_id').val(row.dealer_id);
                $('#payment_details').html(row.payment_value);
                if(row.credit_control_age > 1)
                {
                    $('#remarks_credit').show();
                    $('#remarks').prop('hidden',false);
                }
                openPopupWindow('jqxPopupWindowCredit_approve', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }

        function credit_reject(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
            {
                $('#reject_order_id').val(row.id);
                $('#reject_dealer_id').val(row.dealer_id);
                $('#payment_details_reject').html(row.payment_value);
                openPopupWindow('jqxPopupWindowCredit_reject', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        } 


         function credit_display(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            // console.log(row);

            if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
            {
                 $('#display_vehicle_main_id').val(row.vehicle_main_id);
                 $('#display_order_id').val(row.id);
                $('#display_dealer').val(row.dealer_name);
                
                openPopupWindow('jqxPopupWindowCredit_display', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }

        function credit_cancel(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
            {
                $('#cancel_order_id').val(row.id);
                openPopupWindow('jqxPopupWindowCredit_cancel', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }

        function credit_edit(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
           /* if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
                {*/
                    $('#edit_order_id').val(row.id);
                    $('#payment_value').val(row.associated_value_payment);
                    $('#payment_dropdown').val(row.payment_method);
                    $('#remark').val(row.remarks);
                    
                    openPopupWindow('jqxPopupWindowCredit_edit', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            // }
        }

        function allow_grn_upload(index)
        {
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if(confirm('Allow Grn Upload ?'))
            {
                $.post('<?php echo site_url("dealer_orders/change_grn_upload_status") ?>',{id:row.id},function(result)
                {

                },'JSON');
            }
        }

        function save_Credit_approve()
        {
            var data = $("#form-Credit_approve").serialize();
            $('#jqxPopupWindowCredit_approve').block({
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
                url: '<?php echo site_url("admin/dealer_orders/save_credit_approve"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success == true) {
                       $('#cc_decision').jqxComboBox('clearSelection'); 
                       $('#on_hold_remark').hide(); 
                       $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                       $('#jqxPopupWindowCredit_approve').jqxWindow('close');
                   }                   
                   $('#jqxPopupWindowCredit_approve').unblock();
               }
           });
        }

        function save_Credit_reject()
        {
            var data = $("#form-Credit_reject").serialize();
            $('#jqxPopupWindowCredit_reject').block({
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
                url: '<?php echo site_url("admin/dealer_orders/save_credit_reject"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success == true) {
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowCredit_reject').jqxWindow('close');
                    }                   
                    $('#jqxPopupWindowCredit_reject').unblock();
                }
            });
        }


   function save_Credit_display()
        {
            var data = $("#form-Credit_display").serialize();
            $('#jqxPopupWindowCredit_display').block({
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
                url: '<?php echo site_url("admin/dealer_orders/save_displayCredit"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success == true) {
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowCredit_display').jqxWindow('close');
                    }   else{
                        $('#jqxPopupWindowCredit_display').jqxWindow('close');
                    }                
                    $('#jqxPopupWindowCredit_display').unblock();
                }
            });
        }
        
        function save_Credit_cancel()
        {
            var data = $("#form-Credit_cancel").serialize();
            $('#jqxPopupWindowCredit_cancel').block({
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
                url: '<?php echo site_url("admin/dealer_orders/save_credit_cancel"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success == true) {
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowCredit_cancel').jqxWindow('close');
                    }                   
                    $('#jqxPopupWindowCredit_cancel').unblock();
                }
            });
        }

        function save_Credit_edit()
        {
            var data = $("#form-Credit_edit").serialize();
            $('#jqxPopupWindowCredit_edit').block({
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
                url: '<?php echo site_url("admin/dealer_orders/save_credit_edit"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success == true) {
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowCredit_edit').jqxWindow('close');
                    }                   
                    $('#jqxPopupWindowCredit_edit').unblock();
                }
            });
        }
    </script>