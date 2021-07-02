<style type="text/css">
.cls-red { background-color: #F56969; }
.cls-green { background-color: #3abb23; }
.cls-yellow{background-color: #f4dc42;}
.cls-blue{background-color: #4980d8;}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo lang('menu_create_dispatch_request'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><?php echo lang('menu_create_dispatch_request'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 connectedSortable">
                <?php echo displayStatus(); ?>
                <div id='jqxGridDealer_orderToolbar' class='grid-toolbar'>
                    <button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_orderInsert"><?php echo lang('general_create'); ?></button>
                    <button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDealer_orderFilterClear"><?php echo lang('general_clear'); ?></button>
                </div>
                <div id="jqxGridDealer_order"></div>
            </div><!-- /.col -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowDealer_order">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php 
            $setting = get_setting('Display stock status','Logistics');
            $check = 0;
            if($setting[0]->value == 0){
                if(is_admin() || is_logistic_user() || is_sales_head() || is_manager()){
                    $check = 1;
                }
            }else{
                $check = 1;
            }
        ?>
        <?php echo form_open('', array('id' => 'form-dealer_orders', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "dealer_orders_id"/>
        <input type = "hidden" name = "is_ktm_dealer" value= "0">
        <input type = "hidden" name = "in_stock_remarks" id = "in_stock_remarks"/>
        <table class="form-table">
            <tr>
                <td><label for='vehicle_id'><?php  echo lang('vehicle_id'); ?></label></td>
                <td><div id='vehicle_id' name='vehicle_id'></div></td>
            </tr>
            <tr>
                <td><label for='variant_id'><?php echo lang('variant_id') ?></label></td>
                <td><div id='variant_id' name='variant_id'></div></td>
            </tr>
            <tr>
                <td><label for='color_id'><?php echo lang('color_id') ?></label></td>
                <td><div id='color_id' name='color_id'></div></td>
            </tr>
            <tr>
                <td><label for='year'><?php echo "Year" ?></label></td>
                <td><input type="text" class='text_input' name="year" id="year"></td>
            </tr>
            <?php if($check){?>
            <tr id="error_div" style="display: none">
                <td></td>
                <td><span style="color:#f00;font-size : 20px; ">Not in Stock</span></td>
            </tr>
            <tr id="transit_error_div" style="display: none">
                <td></td>
                <td><span style="color:#f4dc42;font-size : 20px; ">In Transit</span></td>
            </tr>
            <tr id="instock_div" style="display: none">
                <td></td>
                <td><span style="color:#4cae4c;font-size : 20px; ">In Stock</span></td>
            </tr> 
            <?php }?>           
            <tr>
                <td><label for="order_month"><?php echo "Order Month" ?></label></td>
                <td><div id="order_month" name="order_month"></div>
                </td>
            </tr>
            <tr>
                <td><label for="payment_method"> <?php echo lang('payment_method');?></label></td>
                <td> <div id="payment_method" name="payment_method"> </div></td>
            </tr>
            <tr>
                <td><label><?php echo lang('associated_value_payment');?></label></td>
                <td>
                    <input type="text" class="text_input" name="associated_value_payment" id="payment_number" style="display: none">                    
                </td>
            </tr>            
            <tr>
                <th colspan="2">
                    <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealer_orderSubmitButton"><?php echo lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDealer_orderCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>

        </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="jqxPopupWindowChallan_entry">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title">Add Challan Detail</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-challan_entry', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "dealer_orders_id_challan"/>
        <input type = "hidden" name = "dispatch_id" id = "dispatch_id"/>
        <input type = "hidden" name = "msil_dispatch_id" id = "msil_dispatch_id"/>
        <input type = "hidden" name = "dealer_name" id = "dealer_name"/>
        <input type="hidden" id="challan_image" name="challan_image_name">
        <table class="form-table">
            <tr>
                <td><label for='vehicle_id'><?php /* echo lang('vehicle') */ echo "Vehicle" ?></label></td>
                <!-- <td><input id='vehicle' class='text_input' name='vehicle'></td> -->
                <td><div id='vehicle_id_challan' name='vehicle_id_challan'></div></td>
            </tr>
            <tr>
                <td><label for='variant_id'><?php echo lang('variant_id') ?></label></td>
                <td><div id='variant_id_challan' name='variant_id_challan'></div></td>
            </tr>
            <tr>
                <td><label for='color_id'><?php echo lang('color_id') ?></label></td>
                <td><div id='color_id_challan' name='color_id_challan'></div></td>
            </tr>
            <tr>
                <td><label for='engine_no'>Engine Number </label></td>
                <td><div id='engine_no_challan' name='engine_no'></div></td>
            </tr>
            <tr>
                <td><label for='chassis_no'>Chassis Number </label></td>
                <td><div id='chass_no_challan' name='chass_no'></div></td>
            </tr>            
            <tr>
                <td><label for="received_date"><?php echo lang('reveived_date'); ?></label></td>
                <td><div id="received_date_challan" class="date_box" name="reveived_date_challan"></div></td>
            </tr>
            <tr>
                <td> <label for="image"> Upload Image</label></td>
                <td colspan="3">
                    <div id="img_upload"></div> 
                    <div id="res_image"></div>
                </td>               
            </tr>
            <tr>
                <th colspan="2">
                    <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxChallan_entrySubmitButton"><?php echo lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxChallan_entryCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>
            <?php echo form_close(); ?>
            
        </table>       
    </div>
</div>

<div id="jqxPopupWindowDamage_entry">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title">Add Damage Details</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-damages', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "id" id = "damages_id"/>
        <input   type="hidden" id="vehicle_id_damage"  name="vehicle_id">
        <input   type="hidden" id="vehicle_created_time"  name="vehicle_created_time">
        <input   type="hidden" id="chass_no"  name="chass_no">
        <input   type="hidden" id="damage_image_name"  name="damage_image_name">
        <input type="hidden" name="dispatch_id" id="damage_dispatch_id">
        <table class="form-table">
            <tr>
                <td><label for='part'>Item</span></label></td>
                <td><input id='part' class='text_input' name='part'></td>
            </tr>
            <tr>
                <td><label for='category'>Category</label></td>
                <td>
                    <input type="checkbox"  id="category" name="category"  value="Minor"> Minor &nbsp
                    <input type="checkbox"  id="category" name="category" value="Medium"> Medium &nbsp
                    <input type="checkbox"  id="category" name="category"  value="Major"> Major &nbsp
                    <input type="checkbox"  id="category" name="category"  value="Extrem"> Extreme &nbsp
                </td>
            </tr>
            <tr>
                <td><label for='description'>Description</label></td>
                <td><input id='description' class='text_input' name='description'></td>
            </tr>
            <tr>
                <td><label for='service_center'>Service Center</label></td>
                <td><input id='service_center' class='text_input' name='service_center'></td>
            </tr>
            <tr>
                <td><label for='amount'>Amount</label></td>
                <td><div id='amount' class='number_general' name='amount'></div></td>
            </tr>
            <tr>
                <td><label for='estimated_date_of_repair'>Estimated Date of Repair</label></td>
                <td><div id='estimated_date_of_repair' class='date_box' name='estimated_date_of_repair'></div></td>
            </tr>
            <tr>
                <td><label for='return'>Return</label></td>
                <td>
                    <input id="return"  type="checkbox" name="return" value="1"/>
                    <span class="item-text">Yes</span>
                </td>
            </tr>
            <tr id="return_location" style="display: none;">
                <td> <label for="location">Return Location</label> </td>
                <td> <div id="stock_yards" name="stockyard_id"></div></td>
            </tr>
            <tr>
                <td ><label for='image'>Image</label></td>
                <td> <div id="damage_image"></div> <div id="res_damage_image"></div> </td>
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
                    <td>:</td>
                    <td><input name="payment_value" class="text_input" id = 'payment_value'></td>
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
    <div id="jqxPopupWindowReject_display">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title' id="window_poptup_title">Reject Reason</span>
        </div>
        <div class="form_fields_area">
            <div class="row">
                <div class="col-md-12">
                    <h4><div id="reject_reason"></div></h4>
                </div>
            </div>
        </div>
    </div>
    <div id="jqxPopupWindowOnhold">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title' id="window_poptup_title">On Hold Reason</span>
        </div>
        <div class="form_fields_area">
            <div class="row">
                <div class="col-md-12">
                    <h4><div id="onhold_reason"></div></h4>
                </div>
            </div>
        </div>
    </div>
    <div id="jqxPopupWindowDamage_display">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title' id="window_poptup_title">Damage Display</span>
        </div>
        <div class="form_fields_area">
            <div class="row">
                <div class="col-md-3"> <label> Category: </label></div>
                <div class="col-md-4" id="damage_category"></div>
                <div class="col-md-3"> <label> Damage Part: </label></div>
                <div class="col-md-2" id="damage_part"></div>
            </div>
            <div class="row">
                <div class="col-md-3"> <label> Damage Description: </label></div>
                <div class="col-md-4" id="damage_description"></div>
                <div class="col-md-3"> <label> Estimated date of Repair: </label></div>
                <div class="col-md-2" id="damage_repair_date"></div>
            </div>
            <div class="row">
                <div class="col-md-3"> <label> Service Center: </label></div>
                <div class="col-md-4" id="damage_service_center"></div>
                <div class="col-md-3"> <label> Repair Cost: </label></div>
                <div class="col-md-2" id="damage_repair_cost"></div>
            </div>
            <div class="row">
                <div id="image_damage"></div>
            </div>
        </div>
    </div>

    <div id="jqxPopupWindowgrn_add">
        <div class='jqxExpander-custom-div'>
            <span class='popup_title'>Grn Form</span>
        </div>
        <div class="form_fields_area">
            <?php echo form_open('', array('id' => 'form-Grn_add', 'onsubmit' => 'return false')); ?>
            <input type = "hidden" name = "order_id" id = "order_id"/>
            <input type = "hidden" name = "grn_upload_filename" id = "grn_upload_filename"/>
            <table class="form-table app-table">
               <tr id="file_upload">
                <td ><label for='grn_file_upload'>Upload File</label></td>
                <td> <div id="grn_file_upload"></div></td>
            </tr>
            <tr id="file_name_grn" style="display: none">
                <td><div id="grn_file_name"></div></td>
            </tr>
            <tr>
                <th colspan="3">
                    <button type="button" class="btn btn-success btn-md btn-flat" id="jqxGrn_addSubmitButton" style="display: none"><?php echo lang('general_save'); ?></button>
                    <button type="button" class="btn btn-default btn-md btn-flat" id="jqxGrn_addCancelButton"><?php echo lang('general_cancel'); ?></button>
                </th>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="jqxPopupWindowChange_color">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title'>Grn Form</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' => 'form-Change_color', 'onsubmit' => 'return false')); ?>
        <input type = "hidden" name = "color_order_id" id = "color_order_id"/>
        <table class="form-table">
           <tr>
            <td><label for='vehicle_id'><?php  echo lang('vehicle_id'); ?></label></td>
            <td><div class='vehicle_id' id='vehicle_id_cc' name='vehicle_id' readonly="true"></div></td>
        </tr>
        <tr>
            <td><label for='variant_id'><?php echo lang('variant_id') ?></label></td>
            <td><div class='variant_id' id='variant_id_cc' name='variant_id' readonly="true"></div></td>
        </tr>
        <tr>
            <td><label for='color_id'><?php echo lang('color_id') ?></label></td>
            <td><div class='color_id' id='color_id_cc' name='color_id'></div></td>
        </tr>
        <tr>
            <td><label for='year'><?php echo "Year" ?></label></td>
            <td><input type="text" class='text_input' name="year" id="year_cc" <?php echo (is_logistic_user() ||is_logistic_executive() || is_admin())?'':'readonly' ?>></td>
        </tr>
        <tr>
            <td><label for="order_month"><?php echo "Order Month" ?></label></td>
            <td><input id="order_month_cc" class="text_input" name="order_month" readonly="true"></td>
        </tr>
        <tr>
            <td><label for="payment_method"> <?php echo lang('payment_method');?></label></td>
            <td> <input id="payment_method_cc" class="text_input" name="payment_method" readonly="true"> </td>
        </tr>
        <tr>
            <td><label><?php echo lang('associated_value_payment');?></label></td>
            <td>
                <input type="text" class="text_input" name="associated_value_payment" id="payment_number_cc" style="display: none" readonly="true">                    
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxChange_colorSubmitButton"><?php echo lang('general_save'); ?></button>
                <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxChange_colorCancelButton"><?php echo lang('general_cancel'); ?></button>
            </th>
        </tr>
    </table> 
    <?php echo form_close(); ?>
</div>
</div>

<div id="jqxPopupWindowDispatch_details">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title">Detail</span>
    </div>
    <div class="form_fields_area">
        <!--vehicle detail-->
        <div class="col-md-6">
            <h2 class="page-header">Detail</h2>
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue">
                    <h3 class="widget-user-username"><span id="detail_vehicle_name"></span></h3>
                    <h5 class="widget-user-desc"><span id="detail_variant_name"></span></h5>
                </div>

                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#"><label>Color</label><span id="detail_color_name" class="pull-right"></span></a></li>
                        <li><a href="#"><label>Engine Number</label><span id="detail_engine_no" class="pull-right"></span></a></li>
                        <li><a href="#"><label>Chassis Number</label><span id="detail_chass_no" class="pull-right"></span></a></li>
                        <li></li>
                        <li><a href="#"><label>Dealer</label><span id="detail_dealer_name" class="pull-right"></span></a></li>
                        <li><a href="#"><label>Address</label><span id="detail_dealer_address" class="pull-right"></span></a></li>
                        <li><a href="#"><label>Contact</label><span id="detail_dealer_phone" class="pull-right"></span></a></li>
                        <!-- <li></li> -->
                        <!-- <li><a href="#"><label>Stock-yard</label><span id="detail_stock_yard" class="pull-right"></span></a></li> -->
                    </ul>
                    <!-- <div id="challan_print_btn"></div> -->
                </div>
            </div>
        </div>
        <!--driver detail-->
        <div class="col-md-6">
            <h2 class="page-header">Driver Detail</h2>
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <h3 class="widget-user-username"><span id="driver_name"></span></h3>
                    <h5 class="widget-user-desc"><span id="driver_address"></span></h5>
                </div>

                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#"><label>Driver Contact No.</label><span id="driver_contact_no" class="pull-right"></span></a></li>
                        <li><a href="#"><label>Driver License No.</label><span id="driver_liscense_no" class="pull-right"></span></a></li>
                        <li>
                            <div id="driver_image"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">  
            <div id="view_challan_dealer_added"></div>          
            
        </div>
    </div>
</div>

<div id="jqxPopupWindowchange_challan_image">
    <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title">Challan Change</span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-change-challan', 'onsubmit' => 'return false')); ?>   
        
            <input type = "hidden" name = "challan_change_id" id = "challan_change_id" />


            <table class="form-table">
            <tr><td>
                <label for="receipt_image">challan Image :</label>
                <input type="text" name="image_name" id="challan_changed_image_name" hidden>
                <div id="challan_jqxFileUpload"></div>
                <div id="challan_output"></div>
                <button type="button" class="btn btn-default waves-effect" id="challan_change_image" title="Change Image" style="display:none"><i class="fa fa-exchange" aria-hidden="true"></i>Change Image</button> 
            </td></tr>    
                <tr>
                    <th>
                        <button type="submit" class="btn btn-success btn-flat  btn-md" id="jqxchange_challan_submit_button"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default  btn-flat btn-md" id="jqxreceiptCancelButton_discount"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
            </table>
            <?php echo form_close(); ?>
        </div>
    </div>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<script language="javascript" type="text/javascript">

    $(function () {

        $('#challan_jqxFileUpload').jqxFileUpload({ width: 300, uploadUrl: '<?php echo site_url('dealer_orders/challan_upload_image') ?>', fileInputName: 'image_file' });
        $('#challan_jqxFileUpload').on('uploadEnd', function (event) {
            var args = event.args;
            var parsed_data = JSON.parse(args.response);
            var file = parsed_data.file_name;
            var base_url = '<?php echo base_url(); ?>';

            $('#challan_changed_image_name').val(file);     
            $('#challan_output').html("<img src='"+base_url+"/uploads/challan_image/"+file+"' max-width='400px' height='200px'>");   
            $('#challan_jqxFileUpload').hide();
            $("#challan_change_image").show();
        });
      //$("#grn_date").jqxDateTimeInput({ width: '250px', height: '25px' });
      // $('#challan_jqxFileUpload').jqxFileUpload({
      //       width: 300,
      //       accept: 'image/*',
      //       uploadUrl: '<?php  echo site_url('admin/dealer_orders/challan_upload_image')?>',
      //       fileInputName: 'fileToUpload'
      //   });
      //   $('#challan_jqxFileUpload').on('uploadEnd', function (event) {
      //       var args = event.args;
      //       var parsed_data = JSON.parse(args.response);
      //       var file = parsed_data.file_name;
      //       $('#challan_changed_image_name').val(file);     
      //       $('#challan_output').html("<img src='"+base_url+"/uploads/challan_image/"+file+"' max-width='400px' height='200px'>");   
      //       $('#challan_jqxFileUpload').hide();
      //       $("#challan_change_image").show();

      //   });
      var paymentSource = [
      "Cash / Others",
      "BG",
      "LC",
      "Cheque"
      ];
      $("#payment_method").jqxComboBox({ 
        source: paymentSource, 
        width: '200px', 
        height: '25px',
        placeHolder : 'Select a value'
    });

      $("#payment_method").bind('select', function (event) {

        if (!event.args)
            return;

        payment_method = $("#payment_method").jqxComboBox('val');
        if(payment_method=='Cash / Others')
        {
            $('#payment_number').show();
            $('#payment_number').attr("placeholder", "Receipt Number");
        }
        if(payment_method=='LC')
        {
            $('#payment_number').show();
            $('#payment_number').attr("placeholder", "LC Number");        
        }
        if(payment_method=='Cheque')
        {
            $('#payment_number').show();
            $('#payment_number').attr("placeholder", "Cheque Number");;
        }
        if(payment_method=='BG')
        {        
            $('#payment_number').hide();           
        }

    });

      var stockyardDataSource = {
        url: '<?php echo site_url("admin/dealer_orders/get_stockyard_combo_json"); ?>',
        datatype: 'json',
        datafields: [
        {name: 'id', type: 'number'},
        {name: 'name', type: 'string'},
        ]
    };

    stockyardDataAdapter = new $.jqx.dataAdapter(stockyardDataSource);

    $("#stock_yards").jqxComboBox({ 
        source: stockyardDataAdapter, 
        selectedIndex: 0, 
        width: '200px', 
        height: '25px',
        placeHolder:'Select Stockyard',
        displayMember: "name",
        valueMember: "id",

    });

    var monthDataSource = {
        url: '<?php echo site_url("admin/dealer_orders/get_nepali_month_list"); ?>',
        datatype: 'json',
        datafields: [
        {name: 'id', type: 'number'},
        {name: 'name', type: 'string'},
        ]
    };

    monthDataAdapter = new $.jqx.dataAdapter(monthDataSource);

    $("#order_month").jqxComboBox({ 
        source: monthDataAdapter, 
        width: '200px', 
        height: '25px',
        placeHolder:'Select month',
        displayMember: "name",
        valueMember: "id",

    });

    $('#img_upload').jqxFileUpload({ width: 300, uploadUrl: '<?php echo site_url('dealer_orders/challan_upload_image') ?>', fileInputName: 'image_file' });
    $('#img_upload').on('uploadEnd', function (event) {
        var args = event.args;
        var parsed_data = JSON.parse(args.response);
        var file = parsed_data.file_name;
        var base_url = '<?php echo base_url(); ?>';

        var img ='<div id="thumb-image" align="center"> <img src="'+base_url+'uploads/challan_image/'+file+'" alt="Thumbnail" height = "400"> <a href="#" class="change-image"  class="btn btn-danger btn-xs" title="Delete" onClick="removeImage()"><span class="glyphicon glyphicon-remove"></span></a> <br /></div>';
        $('#res_image').html(img);
        $('#challan_image').val(file);
        $('#img_upload').hide();
    });

    $('#damage_image').jqxFileUpload({ width: 300, uploadUrl: '<?php echo site_url('dealer_orders/challan_damage_upload_image') ?>', fileInputName: 'image_file' });
    $('#damage_image').on('uploadEnd', function (event) {
        var args = event.args;
        var parsed_data = JSON.parse(args.response);
        var file = parsed_data.file_name;
        var base_url = '<?php echo base_url(); ?>';

        var img ='<div id="thumb-image" align="center"> <img src="'+base_url+'uploads/challan_damage/'+file+'" alt="Thumbnail" height = "400"> <a href="#" class="change-image"  class="btn btn-danger btn-xs" title="Delete" onClick="removeImage()"><span class="glyphicon glyphicon-remove"></span></a> <br /> </div>';
        $('#res_damage_image').html(img);
        $('#damage_image_name').val(file);
        $('#damage_image').hide();
    });

    $('#grn_file_upload').jqxFileUpload({ width: 300, uploadUrl: '<?php echo site_url('dealer_orders/upload_grn_file') ?>', fileInputName: 'file_name' });
    $('#grn_file_upload').on('uploadEnd', function (event) {
        var args = event.args;
        var parsed_data = JSON.parse(args.response);
        var file = parsed_data.file_name;
        var grn_url = '<?php echo base_url(); ?>/uploads/grn_file';
        
        $('#grn_upload_filename').val(file);
        $('#jqxGrn_addSubmitButton').show();
        $('#grn_file_name').html('<a href="'+grn_url+'/'+file+'" target="_blank">'+file+'</a>');
        $('#file_upload').hide();
        $('#file_name_grn').show();

    });

    $("#vehicle_id").jqxComboBox({
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

    $("#vehicle_id").bind('select', function (event) {

        if (!event.args)
            return;

        vehicle_id = $("#vehicle_id").jqxComboBox('val');

        var variantDataSource = {
            url: '<?php echo site_url("admin/dealer_orders/get_variants_combo_json"); ?>',
            datatype: 'json',
            datafields: [
            {name: 'variant_id', type: 'number'},
            {name: 'variant_name', type: 'string'},
            ],
            data: {
                vehicle_id: vehicle_id
            },
            async: false,
            cache: true
        }
        variantDataAdapter = new $.jqx.dataAdapter(variantDataSource, {autoBind: false});

        $("#variant_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: variantDataAdapter,
            displayMember: "variant_name",
            valueMember: "variant_id",
        });
    });

    $("#variant_id").bind('select', function (event) {

        if (!event.args)
            return;

        vehicle_id = $("#vehicle_id").jqxComboBox('val');
        variant_id = $("#variant_id").jqxComboBox('val');

        var colorDataSource = {
            url: '<?php echo site_url("admin/dealer_orders/get_colors_combo_json"); ?>',
            datatype: 'json',
            datafields: [
            {name: 'color_id', type: 'number'},
            {name: 'color_name', type: 'string'},
            ],
            data: {
                vehicle_id: vehicle_id,
                variant_id: variant_id
            },
            async: false,
            cache: true
        }

        colorDataAdapter = new $.jqx.dataAdapter(colorDataSource, {autoBind: false});
        $("#color_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: colorDataAdapter,
            displayMember: "color_name",
            valueMember: "color_id",
        });
    });

    $("#color_id").bind('select', function (event) {

        if (!event.args)
            return;
        $('#year').val('');


    });


    $('#year').on('blur',function()
    {
        vehicle_id  = $("#vehicle_id").jqxComboBox('val');
        variant_id  = $("#variant_id").jqxComboBox('val');
        color_id    = $("#color_id").jqxComboBox('val');
        year        = $("#year").val();
        if(vehicle_id && variant_id && color_id && year)
        {
             $.post("<?php echo site_url('dealer_orders/check_stock_availability')?>",{vehicle_id:vehicle_id , variant_id:variant_id, color_id : color_id, year:year},function(result)
            {
            if(year != '2019'){
                if(result.success == 'transit')
                {
                    $('#in_stock_remarks').val('2');
                    $('#error_div').hide();
                    $('#instock_div').hide();
                    $('#transit_error_div').show();

                }
                else if(result.success == 'instock')
                {
                    $('#in_stock_remarks').val('1');
                    $('#error_div').hide();
                    $('#instock_div').show();
                    $('#transit_error_div').hide();
                }   
                else
                {
                    $('#instock_div').hide();
                    $('#in_stock_remarks').val('0');
                    $('#error_div').show();
                    $('#transit_error_div').hide();
                }
            }else{
                if(result.success == 'transit')
                {
                    $('#in_stock_remarks').val('2');
                    $('#error_div').hide();
                    $('#instock_div').hide();
                    $('#transit_error_div').hide();

                }
                else if(result.success == 'instock')
                {
                    $('#in_stock_remarks').val('1');
                    $('#error_div').hide();
                    $('#instock_div').hide();
                    $('#transit_error_div').hide();
                }   
                else
                {
                    $('#in_stock_remarks').val('0');
                    $('#error_div').hide();
                    $('#instock_div').hide();
                    $('#transit_error_div').hide();
                }
            }
        },'JSON');
        }
    });

    var dealer_id = '<?php echo $this->session->userdata('employee')['dealer_id'] ?>';
    var showroom_incharge = '<?php echo is_showroom_incharge();?>';
    var dealer_incharge = '<?php echo is_dealer_incharge();?>';
    var is_admin = '<?php echo is_admin();?>';
    var is_logistic_user = '<?php echo is_logistic_user();?>';
    var is_credit_control = '<?php echo is_credit_control();?>';
    var is_sales_head = '<?php echo is_sales_head();?>';
    var is_sales_executive = '<?php echo is_sales_executive();?>';


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
        {name: 'remarks', type: 'string'},
        {name: 'grn_received_date', type: 'date'},
        {name: 'grn_received_date_np', type: 'string'},
        {name: 'order_month_id', type: 'string'},
        {name: 'received_date', type: 'string'},
        {name: 'vehicle_name', type: 'string'},
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
        {name: 'vehicle_ageing', type: 'string'},
        {name: 'order_ageing', type: 'string'},
        {name: 'credit_control_ageing', type: 'string'},
        {name: 'logistic_ageing', type: 'string'},
        {name: 'dispatch_ageing', type: 'string'},
        {name: 'payment_value', type: 'string'},
        {name: 'reject_reason', type: 'string'},
        {name: 'nepali_month', type: 'string'},
        {name: 'order_status', type: 'string'},
        {name: 'in_stock_remarks', type: 'string'},
        {name: 'stock_status', type: 'string'},
        {name: 'dealer_stock_status', type: 'string'},
        {name: 'damage_id', type: 'number'},
        {name: 'stock_in_ktm_status', type: 'string'},
        {name: 'pdi_status', type: 'number'},
        {name: 'pdi_status_check', type: 'string'},
        {name: 'firm_name', type: 'string'},
        {name: 'grn_file', type: 'string'},
        {name: 'grn_allow_status', type: 'number'},
        {name: 'stock_in_ktm', type: 'number'},
        {name: 'bill_nepali_month', type: 'string'},
        {name: 'retail_nepali_month', type: 'string'},
        {name: 'grn_status', type: 'string'},
        {name: 'on_hold_remarks', type: 'string'},
        {name: 'driver_name', type: 'string'},
        {name: 'driver_contact', type: 'string'},
        {name: 'challan_image', type: 'string'},
        {name: 'vehicle_register_no', type: 'string'},
        {name: 'driver_image', type: 'string'},
        
        ],
        url: '<?php echo site_url("admin/dealer_orders/json"); ?>',
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

    var cellclassname =  function (row, column, value, data) 
    {
        if(showroom_incharge == 1 || dealer_incharge == 1 ||  is_sales_executive == 1){

        }else{

            if (data.in_stock_remarks == 1) {
                return 'cls-green';
            }

            else if (data.in_stock_remarks == 0)
            {
                return 'cls-red';
            }
            else if(data.in_stock_remarks == 2){
                return 'cls-yellow';

            }
        }
    }

    var show_hide = '';
    if((is_admin == 1 || is_sales_head == 1) || (showroom_incharge && (dealer_id == 1 || dealer_id == 2 || dealer_id == 111)))
    {
        show_hide = false;
    }
    else
    {
        show_hide = true;
    }

    var show_hide_status = '';
    if(showroom_incharge == 1 || dealer_incharge == 1 ||  is_sales_executive == 1)
    {
        show_hide_status = true;
    }
    else
    {
        show_hide_status = false;
    }


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
        {text: 'SN', width: 75, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
        {
            text: 'Action', datafield: 'action', width: 200, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
            cellsrenderer: function (index) {
                var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
                var e = '';
                if(row.credit_control_approval == '0')
                {
                    e +='<a href="javascript:void(0)" title="Pending"><i class="fa fa-spinner"></i></a>&nbsp';
                }
                else if(row.credit_control_approval == '1')
                {
                    e +='<a href="javascript:void(0)" title="Approved"><i class="fa fa-check"></i></a>&nbsp';
                }    
                else if(row.credit_control_approval == '2')
                {
                    e +='<a href="javascript:void(0)" onclick="reject_Reason(' + index + '); return false;" title="Rejected"><i class="fa fa-times"></i></a>&nbsp';
                }
                else if(row.credit_control_approval == '3')
                {
                    e +='<a href="javascript:void(0)" onclick="onhold_reason(' + index + '); return false;" title="On Hold"><i class="fa fa-refresh" aria-hidden="true"></i></a>&nbsp';
                }
                if(row.dispatch_id)
                {
                    e += '<a href="javascript:void(0)"  onClick="Dispatch_details(' + index + ')" title="Dispatch Details" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp';
                    
                    if(!row.dealer_received_date)
                    {
                        e += '<a href="javascript:void(0)" onclick="challanEntry(' + index + '); return false;" title="Add Challan"><i class="fa fa-plus-circle"></i></a>&nbsp';
                    }
                    if(!row.damage_id)
                    {
                        e +='<a href="javascript:void(0)" onclick="damage_Entry(' + index + '); return false;" title="Damage Entry"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>&nbsp'
                    }
                    else
                    {
                        e +='<a href="javascript:void(0)" onclick="damage_Details(' + index + '); return false;" title="Damage Details"><i class="fa fa-desktop" aria-hidden="true"></i></i></a>&nbsp'
                    }
                }
                if(row.credit_control_approval != 1 || is_admin || is_logistic_user || is_credit_control){
                    e += '<a href="javascript:void(0)" onclick="cancel_order(' + index + '); return false;" title="Cancel Order"><i class="fa fa-ban"></i></a>&nbsp';
                }
                if(row.credit_control_approval != 1){

                    e += '<a href="javascript:void(0)" onclick="credit_edit(' + index + '); return false;" title="Edit Payment"><i class="fa fa-edit"></i></a>&nbsp';
                }else if(is_admin == 1 ||  is_credit_control == 1 || is_sales_head == 1){
                    e += '<a href="javascript:void(0)" onclick="credit_edit(' + index + '); return false;" title="Edit Payment"><i class="fa fa-edit"></i></a>&nbsp';
                }
                e += '<a href="javascript:void(0)" onclick="color_edit(' + index + '); return false;" title="Edit Color"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp';
                if(!row.grn_received_date)
                {
                    if(row.dispatch_ageing < 5 || row.grn_allow_status == 1)
                    {
                        e += '<a href="javascript:void(0)" onclick="Grn_entry(' + index + '); return false;" title="GRN entry"><i class="fa fa-file-text-o" aria-hidden="true"></i></a> &nbsp';
                    }
                }
                else
                {
                    var url = '<?php echo base_url('uploads/grn_file')?>';
                    e += '<a href="'+url+'/'+row.grn_file+'" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                    <?php if(is_admin()): ?>
                        e += '&nbsp<a href="javascript:void(0)" onclick="cancel_grn_entry(' + index + '); return false;" title="Cancel Grn Entry"><i class="fa fa-close" aria-hidden="true"></i></a>&nbsp';

                    <?php endif; ?>      
                }

                <?php if(is_admin()): ?>
                    if(row.challan_image != null && row.challan_image != ''){
                        e += '<a href="javascript:void(0)" onclick="change_challan_image('+row.id+')" title="Edit Challan Image"><i class="fa fa-file-picture-o" aria-hidden="true"></i></a>';
                    }
                <?php endif; ?>


                return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
            }
        },
        {text: '<?php echo lang("order_id");?>', datafield: 'order_id', width: 60, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname },
        {text: '<?php echo lang("order_status");?>', datafield: 'order_status', width: 100, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("dealer_stock_status");?>', datafield: 'dealer_stock_status', width: 100, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname },
        {text: '<?php echo lang("stock_status");?>', datafield: 'stock_status', width: 100, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname,  hidden: show_hide_status},
        // {text: '<?php echo lang("pdi_status_check");?>', datafield: 'pdi_status_check', width: 100, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname ,  hidden: show_hide },
        {text: '<?php echo lang("dealer_name");?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_name', width: 120, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("color_code"); ?>', datafield: 'color_code', width: 110, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("color_id"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("chass_no"); ?>', datafield: 'chass_no', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("engine_no"); ?>', datafield: 'engine_no', width: 110, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("year"); ?>', datafield: 'year', width: 80, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("vehicle_register_no"); ?>', datafield: 'vehicle_register_no', width: 80, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("firm_name"); ?>', datafield: 'firm_name', width: 170, filterable: true, renderer: gridColumnsRenderer , cellclassname : cellclassname},
        {text: '<?php echo lang("date_of_order"); ?>', datafield: 'date_of_order', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname : cellclassname},
        {text: '<?php echo lang("month_name"); ?>', datafield: 'nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("payment_value"); ?>', datafield: 'payment_value', width: 130, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("credit_control_ageing"); ?>', datafield: 'credit_control_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("dealer_dispatch_date"); ?>', datafield: 'dealer_dispatch_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname : cellclassname},
        {text: '<?php echo lang("logistic_ageing"); ?>', datafield: 'logistic_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("bill_nepali_month"); ?>', datafield: 'bill_nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("dealer_received_date"); ?>', datafield: 'dealer_received_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname : cellclassname},
        {text: '<?php echo lang("retail_nepali_month"); ?>', datafield: 'retail_nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
        {text: '<?php echo lang("grn_status"); ?>', datafield: 'grn_status', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
        {text: 'Driver Name', datafield: 'driver_name', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
        {text: 'Driver Contact', datafield: 'driver_contact', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
        ],
        rendergridrows: function (result) {
            return result.data;
        },

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



        // Dealer Order
        $("#jqxPopupWindowDealer_order").jqxWindow({
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


        $("#jqxPopupWindowDealer_order").on('close', function () {
            reset_form_dealer_orders();
        });

        $("#jqxDealer_orderCancelButton").on('click', function () {
            reset_form_dealer_orders();
            $('#jqxPopupWindowDealer_order').jqxWindow('close');
        });

        $("#jqxPopupWindowDispatch_details").jqxWindow({
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

        //Challan Entry
        $("#jqxPopupWindowChallan_entry").jqxWindow({
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
        $("#jqxPopupWindowChallan_entry").on('close', function () {

        });

        $("#jqxChallan_entryCancelButton").on('click', function () {
            $('#jqxPopupWindowChallan_entry').jqxWindow('close');
        });
        // Damage Entry
        $("#jqxPopupWindowDamage_entry").jqxWindow({
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
        $("#jqxPopupWindowDamage_entry").on('close', function () {

        });

        $("#jqxDamageCancelButton").on('click', function () {
            $('#jqxPopupWindowDamage_entry').jqxWindow('close');
        });

        //Reject Reason
        $("#jqxPopupWindowReject_display").jqxWindow({
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
        $("#jqxPopupWindowReject_display").on('close', function () {
        });

          //Onhold Reason
          $("#jqxPopupWindowOnhold").jqxWindow({
            theme: theme,
            width: '50%',
            maxWidth: '50%',
            height: '30%',
            maxHeight: '30%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });
          $("#jqxPopupWindowOnhold").on('close', function () {
          });

        //Damage Display
        $("#jqxPopupWindowDamage_display").jqxWindow({
            theme: theme,
            width: '60%',
            maxWidth: '60%',
            height: '70%',
            maxHeight: '70%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });
        $("#jqxPopupWindowDamage_display").on('close', function () {
        });


        $('#form-dealer_orders').jqxValidator({
            hintType: 'label',
            animationDuration: 500,
            rules: [
            { input: '#payment_number', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#payment_number').val();
                var payment_mode = $('#payment_method').val();
                if(payment_mode == 'BG') { return true; } else { return (val == '' || val == null || val == 0) ? false: true; }
            } },
            { input: '#payment_method', message: 'Required', action: 'blur', 
            rule: function(input) {
                val = $('#payment_method').jqxComboBox('val');
                return (val == '' || val == null || val == 0) ? false: true;
            } },
            { input: '#year', message: 'Invalid Format', action: 'blur', 
            rule: function(input) {
                val = $('#year').val();
                return (val == '' || val == null || val == 0 || val.length != 4) ? false: true;
            } },
            ] 
        });
        //validation
        $("#jqxDealer_orderSubmitButton").on('click', function () {
         var validationResult = function (isValid) 
         {
            if (isValid) {
             saveDealer_orderRecord();
         }};

         $('#form-dealer_orders').jqxValidator('validate', validationResult);
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
                if(payment_mode == 'BG')
                {
                    return true;
                }
                else
                {
                    return (val == '' || val == null || val == 0) ? false: true; 
                }
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
        $("#jqxChallan_entrySubmitButton").on('click', function () {
            saveChallan_entry();

        });

        $("#jqxCancel_OrderSubmitButton").on('click', function () {
            save_cancel_order();                            
        });

        $("#jqxDamageSubmitButton").on('click', function () {
            saveDamageRecord();
        });
    });

    // Add grn
    $("#jqxPopupWindowgrn_add").jqxWindow({
        theme: theme,
        width: '50%',
        maxWidth: '50%',
        height: '50%',
        maxHeight: '50%',
        isModal: true,
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false
    });

    $("#jqxPopupWindowgrn_add").on('close', function () {
    });

    $("#jqxGrn_addSubmitButton").on('click', function () {
        save_Grn_add();
    });
    $("#jqxGrn_addCancelButton").on('click', function () {
        $('#jqxPopupWindowgrn_add').jqxWindow('close');
    });

        // Edit Color
        $("#jqxPopupWindowChange_color").jqxWindow({
            theme: theme,
            width: '50%',
            maxWidth: '50%',
            height: '50%',
            maxHeight: '50%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowChange_color").on('close', function () {
        });

        $("#jqxChange_colorCancelButton").on('click', function () {
            // reset_color_change();
            $('#jqxPopupWindowChange_color').jqxWindow('close');
        });

        $("#jqxChange_colorSubmitButton").on('click', function () {
            save_color_change();
        });


        $("#jqxPopupWindowchange_challan_image").jqxWindow({
            theme: theme,
            width: '50%',
            maxWidth: '50%',
            height: '20%',
            maxHeight: '20%',
            isModal: true,
            autoOpen: false,
            modalOpacity: 0.7,
            showCollapseButton: false
        });

        $("#jqxPopupWindowchange_challan_image").on('close', function () {
        });

        $("#jqxreceiptCancelButton_discount").on('click', function () {
            $('#jqxPopupWindowchange_challan_image').jqxWindow('close');
        });     

        $("#jqxchange_challan_submit_button").on('click', function () {
            save_change_challan_image();
        });


        function credit_edit(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
            {
                $('#edit_order_id').val(row.id);
                $('#payment_value').val(row.associated_value_payment);
                $('#payment_dropdown').val(row.payment_method);
                openPopupWindow('jqxPopupWindowCredit_edit', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }

        function color_edit(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row.dispatch_id) 
            {
                alert('Vehicle already dispatched');
            }
            else
            {
                $("#vehicle_id_cc").jqxComboBox({
                    theme: theme,
                    width: 195,
                    height: 25,
                    selectionMode: 'dropDownList',
                    autoComplete: true,
                    searchMode: 'containsignorecase',
                    source: array_vehicles,
                    displayMember: "name",
                    valueMember: "id",
                    disabled : "true"
                });

                var variantDataSource_new = {
                    url: '<?php echo site_url("admin/dealer_orders/get_variants_combo_json"); ?>',
                    datatype: 'json',
                    datafields: [
                    {name: 'variant_id', type: 'number'},
                    {name: 'variant_name', type: 'string'},
                    ],
                    data: {
                        vehicle_id: row.vehicle_id
                    },
                    async: false,
                    cache: true
                }
                variantDataAdapter_new = new $.jqx.dataAdapter(variantDataSource_new, {autoBind: false});

                $("#variant_id_cc").jqxComboBox({
                    theme: theme,
                    width: 195,
                    height: 25,
                    selectionMode: 'dropDownList',
                    autoComplete: true,
                    searchMode: 'containsignorecase',
                    source: variantDataAdapter_new,
                    displayMember: "variant_name",
                    valueMember: "variant_id",
                    // disabled : "true"
                });

                var colorDataSource_new = {
                    url: '<?php echo site_url("admin/dealer_orders/get_colors_combo_json"); ?>',
                    datatype: 'json',
                    datafields: [
                    {name: 'color_id', type: 'number'},
                    {name: 'color_name', type: 'string'},
                    ],
                    data: {
                        vehicle_id: row.vehicle_id,
                        variant_id: row.variant_id
                    },
                    async: false,
                    cache: true
                }

                colorDataAdapter_new = new $.jqx.dataAdapter(colorDataSource_new, {autoBind: false});
                $("#color_id_cc").jqxComboBox({
                    theme: theme,
                    width: 195,
                    height: 25,
                    selectionMode: 'dropDownList',
                    autoComplete: true,
                    searchMode: 'containsignorecase',
                    source: colorDataAdapter_new,
                    displayMember: "color_name",
                    valueMember: "color_id",
                });

                $("#color_order_id").val(row.id);
                $("#vehicle_id_cc").jqxComboBox('val',row.vehicle_id);
                $("#variant_id_cc").jqxComboBox('val',row.variant_id);
                $("#color_id_cc").jqxComboBox('val',row.color_id);
                $("#order_month_cc").val(row.nepali_month);
                $("#year_cc").val(row.year);
                $("#payment_method_cc").val(row.payment_method);
                $("#payment_number_cc").val(row.payment_value);
                openPopupWindow('jqxPopupWindowChange_color', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }


        function damage_Details(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

            $.post('<?php echo site_url('dealer_orders/view_damage_details') ?>', { dispatch_id : row.dispatch_id }, function(result)
            {
                $('#damage_part').html(result.part);
                $('#damage_category').html(result.category);
                $('#damage_description').html(result.description);
                $('#damage_repair_date').html(result.estimated_date_of_repair);
                $('#damage_service_center').html(result.service_center);
                $('#damage_repair_cost').html(result.amount);
                $('#image_damage').html('<img src = "<?php echo base_url('uploads/challan_damage')?>/'+result.image+'" style = "margin-left : 30px">');
            },'JSON');
            openPopupWindow('jqxPopupWindowDamage_display', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
        }

        function Grn_entry(index) 
        {
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if(row)
            {
                if(!row.dealer_received_date)
                {
                    alert('Vehicle not received');
                }
                else
                {
                    $('#order_id').val(row.id);
                    openPopupWindow('jqxPopupWindowgrn_add', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
                }
            }
        }

        function cancel_grn_entry(index)
        {
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

            if(!confirm('Are you sure want to cancel grn entry??'))
                return false;
            
            $.post('<?php echo site_url("admin/dealer_orders/cancel_grn_entry"); ?>',{order_id:row.id},function(result){
                if(result.success){
                    alert('successfully canceled grn entry');
                    $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                }else{
                    alert('Something went wront');
                }
            },'json');

        }


        function saveDealer_orderRecord() {
            var data = $("#form-dealer_orders").serialize();

            $('#jqxPopupWindowDealer_order').block({
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
                url: '<?php echo site_url("admin/dealer_orders/save"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success) {
                        reset_form_dealer_orders();
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowDealer_order').jqxWindow('close');
                    }
                    $('#jqxPopupWindowDealer_order').unblock();
                }
            });
        }

        function saveChallan_entry() {
            var data = $("#form-challan_entry").serialize();
            // console.log(data);
            var is_admin = '<?php echo is_admin() ?>';
            var dealer = '<?php echo $dealer_id ?>';
            $('#jqxPopupWindowDealer_order').block({
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
            if(!is_admin && dealer != '<?php echo TAXI_SALE ?>' && dealer != '<?php echo AIT_PULCHOWK ?>' && dealer != '<?php echo AIT_THAPATHALI ?>'){
                var image = $('#challan_image').val();
                if(image == '' || image == null){
                    alert('challan file is compulsory');
                    $('#jqxPopupWindowChallan_entry').unblock();                    
                    return false;
                }
            }

            $.ajax({
                type: "POST",
                url: '<?php echo site_url("admin/dealer_orders/save_challan"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success) {
                        reset_form_dealer_orders();
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowChallan_entry').jqxWindow('close');
                    }
                    $('#jqxPopupWindowChallan_entry').unblock();
                }
            });
        }

        function reset_form_dealer_orders() {
            $('#dealer_orders_id').val('');
            $('#form-dealer_orders')[0].reset();
        }

        function reset_form_damages(){
            $('#damages_id').val('');
            $('#form-damages')[0].reset();
        }

        function cancel_order(index){
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            
            if (row) 
            {  
                if(row.vehicle_main_id)
                {
                    alert('Vehicle Already Dispatched');
                }
                else
                {
                    if(confirm('Are you sure?'))
                    {
                        $.post('<?php echo site_url('dealer_orders/save_cancel_order')?>',{id:row.id},function(result)
                        {
                            if (result.success) 
                            {
                                $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                            } 
                        },'json');
                    }
                }
            }
        }

        function challanEntry(index) {
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row) {
                $('#dealer_orders_id_challan').val(row.id);
                $('#vehicle_id_challan').html(row.vehicle_name);
                $('#variant_id_challan').html(row.variant_name);
                $('#color_id_challan').html(row.color_name);
                $('#engine_no_challan').html(row.engine_no);
                $('#chass_no_challan').html(row.chass_no);   
                $('#chass_no1').html(row.chass_no);
                $('#dispatch_id').val(row.dispatch_id);
                $('#msil_dispatch_id').val(row.vehicle_main_id);
                $('#dealer_name').val(row.dealer_name);
                openPopupWindow('jqxPopupWindowChallan_entry', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
            }
        }

        function damage_Entry(index)
        {
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
            if (row) 
            {
                if(row.dispatch_id == null)
                {
                    alert('Vehicle Not dispatched');
                }
                else
                {
                    $('#damage_dispatch_id').val(row.dispatch_id);
                    $('#vehicle_id_damage').val(row.vehicle_main_id);
                    $('#chass_no').val(row.chass_no);
                    $('#vehicle_created_time').val(row.date_of_order);
                    openPopupWindow('jqxPopupWindowDamage_entry', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
                }
            }
        }

        function cancel_payment(index)
        {
            var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

            if(confirm('Are you Sure?'))
            {
              $.post('<?php echo site_url('dealer_orders/save_cancel_payment') ?>',{ order_id : row.order_id }, function(result)
              {     
                if (result.success) {
                    location.reload();
                } 
            },'json');
          }
      }

      function reject_Reason(index)
      {
        var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
        if(row)
        {
            $('#reject_reason').html(row.reject_reason);
        }
        openPopupWindow('jqxPopupWindowReject_display', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>'); 
    }
    function onhold_reason(index)
    {
        var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
        if(row)
        {
            $('#onhold_reason').html(row.on_hold_remarks);
        }
        openPopupWindow('jqxPopupWindowOnhold'); 
    }

    function saveDamageRecord(index){

        var data = $("#form-damages").serialize();

        $('#jqxPopupWindowChallan_entry').block({ 
            message: '<span>Processing your request. Please be patient.</span>',
            css: { 
                width                   : '75%',
                border                  : 'none', 
                padding                 : '50px', 
                backgroundColor         : '#000', 
                '-webkit-border-radius' : '10px', 
                '-moz-border-radius'    : '10px', 
                opacity                 : .7, 
                color                   : '#fff',
                cursor                  : 'wait' 
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
                    $('#jqxPopupWindowChallan_entry').jqxGrid('updatebounddata');
                    $('#jqxPopupWindowChallan_entry').jqxWindow('close');
                }
                $('#jqxGridDealer_order').unblock();
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

    function reset_form_damages(){
        $('#damages_id').val('');
        $('#form-damages')[0].reset();
    }

    $('#return').on('click',function()
    {
        if($(this).prop('checked') == true)
        {
            $('#return_location').show();
        }
        else
        {
            $('#return_location').hide();
        }
    });

    function removeImage()
    {
        var filename = $('#image_name').val();
        var r = confirm('Are you sure to remove the image?');
        if (r == true)
        {
            $.post('<?php echo site_url('dealer_orders/challan_upload_delete') ?>', {filename: filename, id: id}, function () {
                $('#form-msg-image').html('');
                $('#image_name').val('');
                $('#upload_image_name').html('');
                $('#upload_image_name').hide();
                $('#change-image').hide();
                $('#upload_image').show();
                $('#imageInput').show();
                $('#image-Input').show();
                $('#submit-btn').show(); 
                $('#thumb-image').hide();
            });
        }
        return false;
    }

    function save_Grn_add() {
        var data = $("#form-Grn_add").serialize();
        $('#jqxPopupWindowgrn_add').block({
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
            url: '<?php echo site_url("admin/dealer_orders/save_grn_add"); ?>',
            data: data,
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.success == true) {
                    reset_form_grn_add();
                    $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                    $('#jqxPopupWindowgrn_add').jqxWindow('close');
                }
                $('#jqxPopupWindowgrn_add').unblock();
            }
        });
    }

    function reset_form_grn_add() {
        $('#orders_id').val('');
        $('#form-Grn_add')[0].reset();
    }

    function save_color_change() {
        var data = $("#form-Change_color").serialize();
        $('#jqxPopupWindowChange_color').block({
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
            url: '<?php echo site_url("admin/dealer_orders/save_color_change"); ?>',
            data: data,
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.success == true) {
                    reset_form_();
                    $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                    $('#jqxPopupWindowChange_color').jqxWindow('close');
                }
                $('#jqxPopupWindowChange_color').unblock();
            }
        });
    }

    function reset_form_() {
        $('#color_order_id').val('');
        $('#form-Change_color')[0].reset();
    }

    function Dispatch_details(index) {
        var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
        // console.log(row.challan_return_image != null);
        console.log(row);
        if (row) {
            $('#dealer_orders_id').val(row.id);
            $('#detail_vehicle_name').html(row.vehicle_name);
            $('#detail_variant_name').html(row.variant_name);
            $('#detail_color_name').html(row.color_name);
            $('#detail_chass_no').html(row.chass_no);
            $('#detail_engine_no').html(row.engine_no);
            $('#driver_name').html(row.driver_name);
            $('#driver_address').html(row.driver_address);
            $('#driver_contact_no').html(row.driver_contact);
            $('#driver_liscense_no').html(row.driver_liscense_no);
            $('#detail_dealer_name').html(row.dealer_name);
            $('#detail_dealer_phone').html(row.dealer_phone);
            $('#detail_dealer_address').html(row.dealer_address);
            if(row.driver_imag){
                $('#driver_image').html('<img src="<?php echo base_url() . "uploads/driver_docs/" ?>' + row.driver_image + '">');
            }
            
            if(row.challan_image != '' && row.challan_image != null){
                var img_url = '<?php echo base_url('uploads/challan_image/')?>';
                $('#view_challan_dealer_added').html('<a class="btn btn-default btn-flat" href="'+img_url+'/'+row.challan_image+'" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;&nbsp; View Challan</a>')
                
            }
            // $('#challan_print_btn').html('<btn onclick="printList(' + row.dispatch_id + ')" class="btn btn-primary btn-flat btn-xs">Print Challan</btn>');
            openPopupWindow('jqxPopupWindowDispatch_details', '<?php echo "Dispatch Details";?>');
        }
    }

    function change_challan_image(id)
    {
        $('#challan_change_id').val(id);
            openPopupWindow('jqxPopupWindowchange_challan_image', '<?php echo "Dispatch Details";?>');

    }

    function save_change_challan_image()
    {
        var data = $('#form-change-challan').serialize();

        $('#jqxPopupWindowchange_challan_image').block({
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
                url: '<?php echo site_url("admin/dealer_orders/change_challan_image"); ?>',
                data: data,
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.success) {
                        reset_form_dealer_orders();
                        $('#jqxGridDealer_order').jqxGrid('updatebounddata');
                        $('#jqxPopupWindowchange_challan_image').jqxWindow('close');
                    }
                    $('#jqxPopupWindowchange_challan_image').unblock();
                }
            });
        // console.log(data);
    }
</script>