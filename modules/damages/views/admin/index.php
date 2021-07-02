<script src="<?php echo site_url('assets/js/ajaxupload.3.6.js') ?>"></script>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo lang('damages'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo lang('damages'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <div id='jqxGridDamageToolbar' class='grid-toolbar'>
                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDamageInsert"><?php echo lang('general_create'); ?></button>
                    <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDamageFilterClear"><?php echo lang('general_clear'); ?></button>
                </div>
                <div id="jqxGridDamage"></div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDamage">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-damages', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "damages_id"/>
        <table class="form-table">

            <tr>
                <td><label for='damages_name'><?php echo lang('name') ?><span class='mandatory'>*</span></label></td>
                <td><input id='damages_name' class='text_input' name='name'></td>
            </tr>
            <tr>
                <td><label for='vehicle_created_time'><?php echo lang('vehicle_created_time') ?></label></td>
                <td><input id='vehicle_created_time' type="date" class='text_input' name='vehicle_created_time'></td>
            </tr>
            <tr>
                <td><label for='chass_no'><?php echo lang('chass_no') ?></label></td>
                <td>

                    <select id="chassSelect" name="chass_no" class="styled-select slate" class='number_general' style="margin:30px;">

                        <option value="">Chass No</option>

                    </select>

                </td>
            </tr>
            <tr>
                <td><label for='description'><?php echo lang('description') ?></label></td>
                <td><input id='description' class='text_input' name='description'></td>
            </tr>
            <tr>
                <td><label for='vehicle_id'><?php echo lang('vehicle_id') ?></label></td>
                <td><div id='vehicle_id' class='number_general' name='vehicle_id'></div></td>
            </tr>
            <tr>
                <td><label for='repaired_by'><?php echo lang('repaired_by') ?></label></td>
                <td><input id='repaired_by' class='text_input' name='repaired_by'></td>
            </tr>
            <tr>
                <td><label for='repaired_at'><?php echo lang('repaired_at') ?></label></td>
                <td><input id='repaired_at'  type="date" class='text_input' name='repaired_at'></td>
            </tr>
            <tr>
                <td ><label for='image'><?php echo lang('image') ?></label></td>
                <td><label id="upload_image_name" style="display:none"></label>

                    <input name="image" id="image" class='text_input' style="display:none"/>
                    <input type="file" id="upload_image" name="userfile" style="display:block"/>

            </tr>
            <tr>
                <td><label for='service_center'><?php echo lang('service_center') ?></label></td>
                <td><input id='service_center' class='text_input' name='service_center'></td>
            </tr>
            <tr>
                <td><label for='amount'><?php echo lang('amount') ?></label></td>
                <td><div id='amount' class='number_general' name='amount'></div></td>
            </tr>
            <tr>
                <td><label for='estimated_date_of_repair'><?php echo lang('estimated_date_of_repair') ?></label></td>
                <td><div id='estimated_date_of_repair' class='date_box' name='estimated_date_of_repair'></div></td>
            </tr>
            <tr>
                <th colspan="2">
                    <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDamageSubmitButton"><?php echo lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDamageCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="jqxPopupWindowRepair">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields">
        <?php echo form_open('', array('id' => 'form-repairs', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "damages_id"/> 
        <table class="form-table">

            <tr>
                <td><label for='vehicle_name'>Vehicle Name</label></td>
                <td><input id='vehicle_name' class='text_input'  name='vehicle_name'></td>
            </tr>
            <tr>
                <td><label for='vehicle_id'>Vehicle id</label></td>
                <td><input id='vehicle_id1'class='text_input' name='vehicle_id'></td>
            </tr>
            <tr>
                <td><label for='color_name'>Color Name</label></td>
                <td><input id='color_name' class='text_input' name='color_name'></td>
            </tr>
            <tr>
                <td><label for='variant_name'>Variant Name</label></td>
                <td><input id='variant_name' class='text_input' name='variant_name'></td>
            </tr>
            <tr>

                <td><label for='description'>Description</label></td>
                <td><input id='description1' class='text_input' name='description'></td>
            </tr>
            <tr>

                <td><label for='Image'>Image</label></td>
                <td><input id='image1' class='text_input' name='image'></td>
            </tr>

            <tr>
                <td ><label for='chass_no'>Chass No</label></td>
                <td><div id="chass_no" class='number_general' name='chass_no'></div></td>
            </tr>
            <tr>
                <td><label for='engine_no'>Engine No</label></td>
                <td><input id='engine_no' class='text_input' name='engine_no'></td>
            </tr>



            <tr>
                <th colspan="2">
                    <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxRepairSubmitButton"><?php echo lang('general_save'); ?></button>

                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>
<script language="javascript" type="text/javascript">

    $(function () {

        var damagesDataSource =
                {
                    datatype: "json",
                    datafields: [
                        // { name: 'id', type: 'number' },
                        // { name: 'created_by', type: 'number' },
                        // { name: 'updated_by', type: 'number' },
                        // { name: 'deleted_by', type: 'number' },
                        // { name: 'created_at', type: 'string' },
                        // { name: 'updated_at', type: 'string' },
                        // { name: 'deleted_at', type: 'string' },
                        {name: 'name', type: 'string'},
                        {name: 'vehicle_created_time', type: 'string'},
                        {name: 'chass_no', type: 'number'},
                        {name: 'description', type: 'string'},
                        {name: 'vehicle_id', type: 'number'},
                        {name: 'repaired_by', type: 'string'},
                        {name: 'repaired_at', type: 'string'},
                        {name: 'image', type: 'string'},
                        {name: 'service_center', type: 'string'},
                        {name: 'amount', type: 'number'},
                        {name: 'estimated_date_of_repair', type: 'date'},
                    ],
                    url: '<?php echo site_url("admin/damages/json"); ?>',
                    pagesize: defaultPageSize,
                    root: 'rows',
                    id: 'id',
                    cache: true,
                    pager: function (pagenum, pagesize, oldpagenum) {
                        //callback called when a page or page size is changed.
                    },
                    beforeprocessing: function (data) {
                        damagesDataSource.totalrecords = data.total;
                    },
                    // update the grid and send a request to the server.
                    filter: function () {
                        $("#jqxGridDamage").jqxGrid('updatebounddata', 'filter');
                    },
                    // update the grid and send a request to the server.
                    sort: function () {
                        $("#jqxGridDamage").jqxGrid('updatebounddata', 'sort');
                    },
                    processdata: function (data) {
                    }
                };

        $("#jqxGridDamage").jqxGrid({
            theme: theme,
            width: '100%',
            height: gridHeight,
            source: damagesDataSource,
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
                container.append($('#jqxGridDamageToolbar').html());
                toolbar.append(container);
            },
            columns: [
                {text: 'SN', width: 50, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
                {
                    text: 'Action', datafield: 'action', width: 75, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
                    cellsrenderer: function (index) {
                        var e = '<a href="javascript:void(0)" onclick="editDamageRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
                        var f = '<a href="javascript:void(0)"  onclick="repairDamageRecord(' + index + '); return false;" title="Edit"><i class="fa fa-refresh"></i></a>';
                        return '<div style="text-align: center; margin-top: 8px;">' + e + ' | ' + f + '</div>';


                    }
                },
                // { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
                // { text: '<?php echo lang("created_by"); ?>',datafield: 'created_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
                // { text: '<?php echo lang("updated_by"); ?>',datafield: 'updated_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
                // { text: '<?php echo lang("deleted_by"); ?>',datafield: 'deleted_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
                // { text: '<?php echo lang("created_at"); ?>',datafield: 'created_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
                // { text: '<?php echo lang("updated_at"); ?>',datafield: 'updated_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
                // { text: '<?php echo lang("deleted_at"); ?>',datafield: 'deleted_at',width: 150,filterable: true,renderer: gridColumnsRenderer },
                {text: '<?php echo lang("name"); ?>', datafield: 'name', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("vehicle_created_time"); ?>', datafield: 'vehicle_created_time', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("chass_no"); ?>', datafield: 'chass_no', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("description"); ?>', datafield: 'description', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_id', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("repaired_by"); ?>', datafield: 'repaired_by', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("repaired_at"); ?>', datafield: 'repaired_at', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("image"); ?>', datafield: 'image', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("service_center"); ?>', datafield: 'service_center', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("amount"); ?>', datafield: 'amount', width: 150, filterable: true, renderer: gridColumnsRenderer},
                {text: '<?php echo lang("estimated_date_of_repair"); ?>', datafield: 'estimated_date_of_repair', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
            ],
            rendergridrows: function (result) {
                return result.data;
            }
        });

        $("[data-toggle='offcanvas']").click(function (e) {
            e.preventDefault();
            setTimeout(function () {
                $("#jqxGridDamage").jqxGrid('refresh');
            }, 500);
        });

        $(document).on('click', '#jqxGridDamageFilterClear', function () {
            $('#jqxGridDamage').jqxGrid('clearfilters');
        });
        $(document).on('click', '#jqxGridDamageInsert', function () {

            $.post('<?php echo site_url('damages/get_dispatch') ?>', function (data) {
                // console.log(data );
                $('#chassSelect').find('option').remove().end();
                var content = '<option value="">Select</option>';
                //$('#chassSelect').append(content);
                //  $("#chassSelect").append('<option value=>data.chass_no</option>');
                $.each(data, function (i, item) {


                    // // for(i=0;i<data;i++){
                    // //   console.log('option ',data.chass_no[i].id);
                    // //   //console.log('option ',data.model[i].model);
                    $('#chassSelect').append($('<option>', {
                        value: item.chass_no,
                        text: item.chass_no
                                //   		//text(data.chass_no[i].chass_no).attr('value', data.chass_no[i].chass_no)); //just incase value req
                    }));
                });
            }, 'json');

            openPopupWindow('jqxPopupWindowDamage', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
            uploadReady();
        });

        $(document).on('click', '#jqxGridDamageInsert', function () {
            openPopupWindow('jqxPopupWindowDamage', '<?php echo lang("general_add") . "&nbsp;" . $header; ?>');
        });

        // initialize the popup window
        $("#jqxPopupWindowDamage").jqxWindow({
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

        $("#jqxPopupWindowDamage").on('close', function () {
            reset_form_damages();
        });

        $("#jqxDamageCancelButton").on('click', function () {
            reset_form_damages();
            $('#jqxPopupWindowDamage').jqxWindow('close');
        });


        // initialize the popup window
        $("#jqxPopupWindowRepair").jqxWindow({
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

        $("#jqxPopupWindowRepair").on('close', function () {
            reset_form_damages();
        });

        $("#jqxRepairCancelButton").on('click', function () {
            reset_form_damages();
            $('#jqxPopupWindowRepair').jqxWindow('close');
        });

        /*$('#form-damages').jqxValidator({
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
         
         { input: '#damages_name', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#damages_name').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#vehicle_created_time', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#vehicle_created_time').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#chass_no', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#chass_no').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#description', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#description').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#vehicle_id', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#vehicle_id').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#repaired_by', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#repaired_by').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#repaired_at', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#repaired_at').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#image', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#image').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#service_center', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#service_center').val();
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         { input: '#amount', message: 'Required', action: 'blur', 
         rule: function(input) {
         val = $('#amount').jqxNumberInput('val');
         return (val == '' || val == null || val == 0) ? false: true;
         }
         },
         
         ]
         });*/

        $("#jqxDamageSubmitButton").on('click', function () {
            saveDamageRecord();
            /*
             var validationResult = function (isValid) {
             if (isValid) {
             saveDamageRecord();
             }
             };
             $('#form-damages').jqxValidator('validate', validationResult);
             */
        });
        $("#jqxRepairSubmitButton").on('click', function () {
            saveRepairRecord();
            /*
             var validationResult = function (isValid) {
             if (isValid) {
             saveDamageRecord();
             }
             };
             $('#form-damages').jqxValidator('validate', validationResult);
             */

        });
    });

    function editDamageRecord(index) {
        var row = $("#jqxGridDamage").jqxGrid('getrowdata', index);
        if (row) {
            $('#damages_id').val(row.id);
            //       $('#created_by').jqxNumberInput('val', row.created_by);
            // $('#updated_by').jqxNumberInput('val', row.updated_by);
            // $('#deleted_by').jqxNumberInput('val', row.deleted_by);
            // $('#created_at').val(row.created_at);
            // $('#updated_at').val(row.updated_at);
            // $('#deleted_at').val(row.deleted_at);
            $('#damages_name').val(row.name);
            $('#vehicle_created_time').val(row.vehicle_created_time);
            $('#chass_no').jqxNumberInput('val', row.chass_no);
            $('#description').val(row.description);
            $('#vehicle_id').jqxNumberInput('val', row.vehicle_id);
            $('#repaired_by').val(row.repaired_by);
            $('#repaired_at').val(row.repaired_at);
            $('#image').val(row.image);
            $('#service_center').val(row.service_center);
            $('#amount').jqxNumberInput('val', row.amount);
            $('#estimated_date_of_repair').jqxDateTimeInput('setDate', row.estimated_date_of_repair);

            openPopupWindow('jqxPopupWindowDamage', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
        }
    }

    function saveDamageRecord() {
        var data = $("#form-damages").serialize();

        $('#jqxPopupWindowDamage').block({
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
            url: '<?php echo site_url("admin/damages/save"); ?>',
            data: data,
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.success) {
                    reset_form_damages();
                    $('#jqxGridDamage').jqxGrid('updatebounddata');
                    $('#jqxPopupWindowDamage').jqxWindow('close');
                }
                $('#jqxPopupWindowDamage').unblock();
            }
        });
    }

    function saveRepairRecord() {
        var data = $("#form-repairs").serialize();

        $('#jqxPopupWindowRepair').block({
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
            url: '<?php echo site_url("admin/damages/Repair_save"); ?>',
            data: data,
            success: function (result) {
                console.log(result);
                var result = eval('(' + result + ')');
                if (result.success) {
                    reset_form_repairs();
                    $('#jqxGridDamage').jqxGrid('updatebounddata');
                    $('#jqxPopupWindowRepair').jqxWindow('close');
                }
                $('#jqxPopupWindowRepair').unblock();
            }
        });
    }

    function repairDamageRecord(index) {


        var row = $("#jqxGridDamage").jqxGrid('getrowdata', index);

        var vehicle_id = row.vehicle_id;

        var dataString = 'vehicle_id=' + vehicle_id;
        //console.log(vehicle_id);

        $.post('<?php echo site_url('damages/get_vehicle_details') ?>', {vehicle_id: vehicle_id}, function (data) {
            // alert();

            console.log(data);

            if (data) {
                $('#vehicle_name').val(data[0].vehicle_name);
                $('#vehicle_id1').val(data[0].vehicle_id);
                $('#color_name').val(data[0].color_name);
                $('#variant_name').val(data[0].variant_name);

                $('#description1').val(data[0].description);
                uploadReady();
                $('#image1').val(data[0].image);
                $('#chass_no').jqxNumberInput('val', data[0].chass_no);
                $('#engine_no').val(data[0].engine_no);


                openPopupWindow('jqxPopupWindowRepair', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }, 'json');

    }




    function uploadReady()
    {
        uploader = $('#upload_image');
        new AjaxUpload(uploader, {
            action: '<?php echo site_url('damages/upload_image') ?>',
            name: 'userfile',
            responseType: "json",
            onSubmit: function (file, ext) {
                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    // extension is not allowed 
                    $.messager.show({title: '<?php echo lang('error') ?>', msg: 'Only JPG, PNG or GIF files are allowed'});
                    return false;
                }
                //status.text('Uploading...');
            },
            onComplete: function (file, response) {
                if (response.error == null) {
                    var filename = response.file_name;
                    $('#upload_image').hide();
                    $('#image').val(filename);
                    $('#upload_image_name').html(filename);
                    $('#upload_image_name').show();
                    $('#change-image').show();
                }
                else
                {
                    $.messager.show({title: '<?php echo lang('error') ?>', msg: response.error});
                }
            }
        });
    }
    function reset_form_damages() {
        $('#damages_id').val('');
        $('#form-damages')[0].reset();
    }
    function  reset_form_repairs() {
        $('#id').val('');
        $('#form-repairs')[0].reset();
    }
</script>