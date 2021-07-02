<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo lang('stock_records'); ?></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active"><?php echo lang('stock_records'); ?></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- row -->
    <div class="row">

      <div class="col-xs-12 connectedSortable">
        <?php echo displayStatus(); ?>
        <div id="jqxGridStock_record"></div>
      </div><!-- /.col -->
    </div>
    <!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowStock_damage">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title"></span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-stock_damage', 'onsubmit' => 'return false')); ?>
    <input type = "hidden" name = "id" id = "stock_records_id"/>
    <input type = "hidden" name = "dispatch_date" id = "dispatch_dealer"/>
    <table class="form-table">
      <tr>
        <td><label for='damage_date'><?php echo lang('damage_date')?></label></td>
        <td><div id='damage_date' class="date_time_picker" name='damage_date'></div></td>
      </tr>
      <tr>
        <td><label for='repair_commitment_date'><?php echo lang('repair_commitment_date')?></label></td>
        <td><div id='repair_date' class="date_time_picker" name='repair_commit_date'></div></td>
      </tr>
      <tr>
        <td><label for="current_location">Current Location</label></td>
        <td><input type="text" id= "curr_location" name="current_location" class="text_input"></td>
      </tr>
      <tr>
        <td><label for="accident_type"><?php echo lang('accident_type') ?></label></td>
        <td><div id="accident_type" name="accident_type"></div></td>
      </tr>
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_recordSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_recordCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>

    </table>
    <?php echo form_close(); ?>
  </div>
</div>

<div id="jqxPopupWindowChallan_status">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Challan Status</span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-challan_status', 'onsubmit' => 'return false')); ?>
    <input type="hidden" name="id" id="challan_status_id">
    <table>
      <tr>
        <td><label>Challan Status</label></td>
        <td>
          <input type="radio" name="challan_status" id="status_ok" value="Ok" checked="true"> OK
          <br>
          <input type="radio" name="challan_status" id="status_hold" value="On Hold"> Hold
        </td>
      </tr>
      <tr id="location_tr" hidden="">
        <td><label>Location</label></td>
        <td><input type="text" id= "location" name="location" class="text_input"></td>
      </tr>
      <!--  <tr id="remark_hold" hidden="">
        <td><label>Hold Remark</label></td>
        <td><input type="text" id= "hold_remark" name="hold_remark" class="text_input"></td>
      </tr> -->

      <tr >
        <td><label>Logistic Confirmation Date</label></td>
        <td><div id= "challan_confirmation_date" name="challan_confirmation_date" class="date_box"></div></td>
      </tr>
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="challan_statusSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="challan_statusCancelButton"><?php echo lang('general_cancel'); ?></button>
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
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-repair', 'onsubmit' => 'return false')); ?>
    <input type = "hidden" name = "id" id = "stock_id"/>
    <input type = "hidden" name = "location_type" id = "return_location_type"/>
    <input type = "hidden" name = "vehicle_id" id = "vehicle_id"/>
    <input type = "hidden" name = "variant_id" id = "variant_id"/>
    <input type = "hidden" name = "color_id" id = "color_id"/>
    <table class="form-table">
      <tr>
        <td><label for='repair_date'><?php echo lang('repair_date')?></label></td>
        <td><div id='repair_date' class="date_time_picker" name='repair_date'></div></td>
      </tr>
      <tr>
        <td><label for='remarks'><?php echo lang('remarks')?></label></td>
        <td><textarea name="remarks" style="height: 100px; width: 250px; border-radius: 5px" placeholder="Remarks"></textarea></td>
      </tr>
      <tr>
        <td><label>Stockyard/Dealer</label></td><td><div class="location_type" id="stockyard_return">Stockyard<div class="location_type" id="dealer_return">Dealer</div></td>
        <td><label>Location</label></td><td><div id="stockyard_return_combobox" name="return_location_id"></div></td>
      </tr>
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxRepairSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxRepairCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
</div>
<!-- <div id="jqxPopupWindowDetails">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Details</span>
  </div>
  <div class="form_fields_area">    
    <div class="row">
      <div class="col-md-12">
        <h4><u><b>Damage Report</b></u></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3"><label for='damage_date'><?php echo lang('damage_date')?></label></div>
      <div class="col-md-1">:</div>
      <div class="col-md-8"><div id='damage_date_detail'></div></div>
    </div>
    <div class="row">
      <div class="col-md-3"><label for='repair_commitment_date'><?php echo lang('repair_commitment_date')?></label></div>
      <div class="col-md-1">:</div>
      <div class="col-md-8"><div id='repair_commitment_date_detail'></div></div>
    </div>
    <div class="row">
      <div class="col-md-3"><label for='repair_date'><?php echo lang('repair_date')?></label></div>
      <div class="col-md-1">:</div>
      <div class="col-md-8"><div id='repair_date_detail'></div></div>
    </div>
    <div class="row">
      <div class="col-md-3"><label for='remarks'><?php echo lang('remarks')?></label></div>
      <div class="col-md-1">:</div>
      <div class="col-md-8"><div id="remarks_detail"></div></div>
    </div>
  </div>
</div> -->
<div id="jqxPopupWindowDetails">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Details</span>
  </div>
  <div class="form_fields_area">    
    <div class="row">
      <div class="col-md-12">
        <h4><u><b>Damage Report</b></u></h4>
      </div>
    </div>
    <div id="detail-damage-record"></div>
  </div>
</div>
<div id="jqxPopupWindowStock_return">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Stock Return</span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-stock_return', 'onsubmit' => 'return false')); ?>
    <input type = "hidden" name = "dispatch_id" id = "dispatch_id"/>
    <input type = "hidden" name = "stock_id" id = "return_stock_id"/>
    <input type = "hidden" name = "dealer_id" id = "return_dealer_id"/>
    <input type = "hidden" name = "order_id" id = "return_order_id"/>
    <table class="form-table">
      <tr>
        <td><label for="stockyard"><?php echo lang('stockyard') ?></label></td>
        <td><div class="stockyard" name="stockyard"></div></td>
      </tr>
      <tr>
        <td><label for='stock_return_reason'><?php echo lang('stock_return_reason')?></label></td>
        <td><textarea name="reason" style="height: 100px; width: 250px; border-radius: 5px" placeholder="Reason"></textarea></td>
      </tr>
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxReturnSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxReturnCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
</div>

<div id="jqxPopupWindowStock_transfer">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Stock Tramsfer</span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-stock_transfer', 'onsubmit' => 'return false')); ?>
    <input type = "hidden" name = "stock_id" id = "stock_record_id_transfer"/>
    <input type = "hidden" name = "source" id = "current_stockyard"/>
    <table class="form-table">
      <tr>
        <td><label for="display">Display</label></td>
        <td><div id="is_display" name="is_display"></div></td>
      </tr>
      <tr id="stockyard_div">
        <td><label for="stockyard"><?php echo lang('stockyard') ?></label></td>
        <td><div class="stockyard" name="stockyard_id"></div></td>
      </tr>   
      <tr id="dealer_div" style="display: none;">
        <td><label for="dealer_id_transfer"><?php echo lang('dealer_id') ?></label></td>
        <td><div id="dealer_id_transfer" name="dealer_id"></div></td>
      </tr>   
      <tr>
        <td><label>Driver Name</label></td>
        <td><input type="text" name="driver_name" id="driver_name" class="text_input"></td>
      </tr>
      <tr><td><label>Driver Address</label></td>
        <td><input type="text" name="driver_address" id="driver_address" class="text_input"></td>
      </tr>
      <tr><td><label>Driver Number</label></td>
        <td><input type="text" name="driver_number" id="driver_number" class="text_input"></td>
      </tr>
      <tr><td><label>license No.</label></td>
        <td><input type="text" name="license_no" id="license_no" class="text_input"></td>
      </tr>       
      <tr>
        <td><label>Location</label></td>
        <td><input type="text" name="present_location" id="present_location" class="text_input"></td>
      </tr>
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxTransferSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxTransferCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
</div>
<div id="jqxPopupWindowStatus_Change">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Status Change</span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-status_change', 'onsubmit' => 'return false')); ?>
    <input type = "hidden" name = "vehicle_main_id" id = "vehicle_main_id"/>
    <table class="form-table">
      <!-- <tr>
        <td><label for="dealer_list"><?php echo lang('dealer_list') ?></label></td>
        <td><div id="dealer_list" name="dealer_list"></div></td>
      </tr> -->
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-bg btn-flat" id="jqxStatus_changeSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-bg btn-flat" id="jqxStatus_changeCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
</div>


<div id="jqxPopupWindowHold_remark">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title">Hold Remark</span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-hold_remark', 'onsubmit' => 'return false')); ?>
    <input type="hidden" name="id" id="log_stock_id">
    <table>
     
     
       <tr>
        <td><label>Hold Remark</label></td>
        <td> <input type="text" id= "hold_remark" name="hold_remark" class="text_input"></td>
      </tr>

     
      <tr>
        <th colspan="2" style="padding-left:106px;padding-top:18px;">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="hold_remarkSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="hold_remarkCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
</div>


<script language="javascript" type="text/javascript">

  $(function(){

   $("#is_display").jqxCheckBox({ width: 120, height: 25 });
   $('#is_display').on('change', function (event) { 
    var checked = event.args.checked; 
    if(checked == true)
    {
      $('#dealer_div').show();
      $('#stockyard_div').hide();
    }
    else
    {
      $('#dealer_div').hide();
      $('#stockyard_div').show();
    }

  });

   $(".location_type").jqxRadioButton({ width: 120, height: 25 });

   $(".date_time_picker").jqxDateTimeInput({ width: '250px', height: '25px',formatString: 'yyyy-M-d'});

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

  $(".stockyard").jqxComboBox({
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

  // accident_type

  $("#accident_type").jqxComboBox({
    theme: theme,
    width: 195,
    height: 25,
    selectionMode: 'dropDownList',
    autoComplete: true,
    searchMode: 'containsignorecase',
    source: array_accident_type,
    displayMember: "name",
    valueMember: "name",
  });

  // end accident_type

  var DealerDataSource  = {
    url : '<?php echo site_url("admin/stock_records/get_dealers_combo_json"); ?>',
    datatype: 'json',
    datafields: [
    { name: 'id', type: 'number' },
    { name: 'name', type: 'string' },
    ],
    async: false,
    cache: true
  }

  DealerDataAdapter = new $.jqx.dataAdapter(DealerDataSource);

  $("#dealer_id_transfer").jqxComboBox({
    theme: theme,
    width: 195,
    height: 25,
    placeHolder: "Select Dealer",
    selectionMode: 'dropDownList',
    autoComplete: true,
    searchMode: 'containsignorecase',
    source: DealerDataAdapter,
    displayMember: "name",
    valueMember: "id",
  });


  var stock_recordsDataSource =
  {
    datatype: "json",
    datafields: [
    { name: 'id', type: 'number' },
    { name: 'created_by', type: 'number' },
    { name: 'updated_by', type: 'number' },
    { name: 'deleted_by', type: 'number' },
    { name: 'created_at', type: 'string' },
    { name: 'updated_at', type: 'string' },
    { name: 'deleted_at', type: 'string' },
    { name: 'vehicle_id', type: 'number' },
    { name: 'variant_id', type: 'number' },
    { name: 'color_id', type: 'number' },
    { name: 'dealer_dispatch_date', type: 'string' },
    { name: 'dealer_received_date', type: 'string' },
    { name: 'dealer_retail_date', type: 'string' },
    { name: 'vehicle_name', type: 'string' },
    { name: 'variant_name', type: 'string' },
    { name: 'color_name', type: 'string' },
    { name: 'color_code', type: 'string' },
    { name: 'engine_no', type: 'string' },
    { name: 'chass_no', type: 'string' },
    { name: 'location', type: 'string' },
    { name: 'damage_date', type: 'string' },
    { name: 'is_damage', type: 'number' },
    { name: 'repair_date', type: 'string' },
    { name: 'damage_status', type: 'string' },
    { name: 'repair_commitment_date', type: 'string' },
    { name: 'remarks', type: 'string' },
    { name: 'dealer_reject', type: 'number' },
    { name: 'dealer_id', type: 'number' },
    { name: 'dispatch_id', type: 'number' },
    { name: 'vehicle_return', type: 'number' },
    { name: 'age', type: 'number' },
    { name: 'dispatch_to_dealer_date', type: 'string' },
    { name: 'actual_location', type: 'string' },
    { name: 'current_location', type: 'string' },
    { name: 'current_status', type: 'string' },
    { name: 'year', type: 'number' },
    { name: 'msil_dispatch_date', type: 'string' },
    { name: 'stock_id', type: 'number' },
    { name: 'payment_value', type: 'string' },
    { name: 'firm_name', type: 'string' },
    { name: 'order_id', type: 'number' },
    { name: 'present_location', type: 'string' },
    { name: 'stock_transfer_date', type: 'date' },
    { name: 'pdi_date', type: 'date' },
    { name: 'transfer_from', type: 'string' },
    { name: 'accident_type', type: 'string' },
    { name: 'driver_id', type: 'number' },
    { name: 'challan_status', type: 'string' },
    { name: 'driver_name', type: 'string' },
    { name: 'driver_number', type: 'string' },
    { name: 'challan_hold_location', type: 'string' },
    { name: 'credit_approve_date_np', type: 'string' },
    { name: 'challan_confirmation_date', type: 'string' },
    { name: 'vehicle_register_no', type: 'string' },
    { name: 'hold_remark', type: 'string' },
    ],
    url: '<?php echo site_url("admin/stock_records/json"); ?>',
    pagesize: defaultPageSize,
    root: 'rows',
    id : 'id',
    cache: true,
    pager: function (pagenum, pagesize, oldpagenum) {
//callback called when a page or page size is changed.
},
beforeprocessing: function (data) {
  stock_recordsDataSource.totalrecords = data.total;
},
// update the grid and send a request to the server.
filter: function () {
  $("#jqxGridStock_record").jqxGrid('updatebounddata', 'filter');
},
// update the grid and send a request to the server.
sort: function () {
  $("#jqxGridStock_record").jqxGrid('updatebounddata', 'sort');
},
processdata: function(data) {
}
};

$("#jqxGridStock_record").jqxGrid({
  theme: theme,
  width: '100%',
  height: gridHeight,
  source: stock_recordsDataSource,
  altrows: true,
  pageable: true,
  sortable: true,
  rowsheight: 30,
  columnsheight:30,
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
    container.append($('#jqxGridStock_recordToolbar').html());
    toolbar.append(container);
  },
  columns: [
  { text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
  {
    text: 'Action', datafield: 'action', width:85, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
    cellsrenderer: function (index,b,c,d,e,value) {
      var e = '';

        
        e += '<a href="javascript:void(0)" onclick="Stock_damage(' + index + '); return false;" title="Damage"><i class="fa fa-recycle"></i></a>&nbsp';
      
      if(value.is_damage == 1)
      {
        e += '<a href="javascript:void(0)" onclick="Repair(' + index + '); return false;" title="Repair"><i class="fa fa-list"></i></a>&nbsp';
      }
      else if(value.is_damage == 2)
      {
        e += '<a href="javascript:void(0)" onclick="Details(' + index + '); return false;" title="Details"><i class="fa fa-circle-o"></i></a>&nbsp';
      }

      // if(value.dealer_id == null || (value.dealer_id && value.vehicle_return == 1))
      if(value.current_status == 'Stock' || value.current_status == 'Display' || value.current_status == 'repaired stock')
      {
        if(value.dealer_reject == 0)
        {
          e += '<a href="javascript:void(0)" onclick="Dealer_reject(' + index + '); return false;" title="Normal"><i class="fa fa-check"></i></a>&nbsp';
        }
        else
        {
          e += '<a href="javascript:void(0)" onclick="Dealer_accept(' + index + '); return false;" title="Rejected"><i class="fa fa-times"></i></a>&nbsp';
        }
      }
      else
      {
        e += '<a href="javascript:void(0)" onclick="Stock_return(' + index + '); return false;" title="Stock Return"><i class="fa fa-mail-reply"></i></a>&nbsp';

      }
      if(value.current_status == 'Stock' || value.current_status == 'Display' || value.current_status == 'repaired stock')
      {
        e += '<a href="javascript:void(0)" onclick="Stock_transfer(' + index + '); return false;" title="Stock Transfer"><i class="fa fa-exchange"></i></a>&nbsp';        
      }
      if(value.driver_id){
        e += '<a href="javascript:void(0)" onclick="Stock_transfer_detail(' + index + '); return false;" title="Stock Transfer Detail"><i class="fa fa-eye"></i></a>&nbsp';
      }
        e += '<a href="javascript:void(0)" onclick="addHoldRemarks(' + index + '); return false;" title="Add Hold Remark"><i class="fa fa-comments"></i></a>&nbsp';
      e += '<a href="javascript:void(0)" onclick="challan_status(' + index + '); return false;" title="Challan Status"><i class="fa fa-truck"></i></a>&nbsp';
      <?php if (is_group(DEALER_INCHARGE_GROUP)){?>
        e = '';
      <?php }?>
      return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
    }     
  },
  { text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("color_code"); ?>',datafield: 'color_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("mfg_year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("firm_name"); ?>',datafield: 'firm_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("msil_dispatch_date"); ?>',datafield: 'msil_dispatch_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("vehicle_register_no"); ?>',datafield: 'vehicle_register_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("ageing"); ?>',datafield: 'age',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("location"); ?>',datafield: 'current_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("damage_status"); ?>',datafield: 'current_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("accident_type"); ?>',datafield: 'accident_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
  // { text: '<?php echo lang("present_location"); ?>',datafield: 'present_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("transfer_from"); ?>',datafield: 'transfer_from',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("stock_transfer_date"); ?>',datafield: 'stock_transfer_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
  { text: '<?php echo "Driver Name" ?>',datafield: 'driver_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo "Driver Address" ?>',datafield: 'driver_number',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo "Pdi Date" ?>',datafield: 'pdi_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
  { text: '<?php echo lang("dealer_dispatch_date"); ?>',datafield: 'dealer_dispatch_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("payment_value"); ?>',datafield: 'payment_value',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: '<?php echo lang("dealer_received_date"); ?>',datafield: 'dealer_received_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: 'Challan Status',datafield: 'challan_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: 'Challan Hold Location',datafield: 'challan_hold_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: 'Approve Date',datafield: 'credit_approve_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: 'Challan Confirmation Date',datafield: 'challan_confirmation_date',width: 150,filterable: true,renderer: gridColumnsRenderer,columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd },

{ text: 'Hold Remark',datafield: 'hold_remark',width: 150,filterable: true,renderer: gridColumnsRenderer },
  ],
  rendergridrows: function (result) {
    return result.data;
  }
});

$("[data-toggle='offcanvas']").click(function(e) {
  e.preventDefault();
  setTimeout(function() {$("#jqxGridStock_record").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridStock_recordFilterClear', function () { 
  $('#jqxGridStock_record').jqxGrid('clearfilters');
});

$(document).on('click','#jqxGridStock_recordInsert', function () { 
  openPopupWindow('jqxPopupWindowStock_damage', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

// initialize the popup window
$("#jqxPopupWindowStock_damage").jqxWindow({ 
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

$("#jqxPopupWindowStock_damage").on('close', function () {
  reset_form_stock_records();
});

$("#jqxStock_recordCancelButton").on('click', function () {
  reset_form_stock_records();
  $('#jqxPopupWindowStock_damage').jqxWindow('close');
});

// challan_status

$(document).on('click','#jqxGridStock_recordInsert', function () { 
  openPopupWindow('jqxPopupWindowChallan_status', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
});

// initialize the popup window
$("#jqxPopupWindowChallan_status").jqxWindow({ 
  theme: theme,
  width: '25%',
  maxWidth: '25%',
  height: '25%',  
  maxHeight: '25%',  
  isModal: true, 
  autoOpen: false,
  modalOpacity: 0.7,
  showCollapseButton: false 
});

$("#jqxPopupWindowChallan_status").on('close', function () {
  reset_form_stock_records();
});

$("#challan_statusCancelButton").on('click', function () {
  reset_form_stock_records();
  $('#jqxPopupWindowChallan_status').jqxWindow('close');
});

// end challan_status

$('#form-stock_damage').jqxValidator({
  hintType: 'label',
  animationDuration: 500,
  rules: [
  { input: '#curr_location', message: 'Required', action: 'blur', 
  rule: function(input) {
    val = $('#curr_location').val();
    return (val == '' || val == null || val == 0) ? false: true;
  }
},
]
});
$("#jqxStock_recordSubmitButton").on('click', function () {    
  var validationResult = function (isValid) {
    if (isValid) {
      saveStock_recordRecord();
    }
  };
  $('#form-stock_damage').jqxValidator('validate', validationResult); 
});

$("#challan_statusSubmitButton").on('click', function () {    
    savechallan_statusRecord();
});

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
  reset_form_repair();
});

$("#jqxRepairCancelButton").on('click', function () {
  reset_form_repair();
  $('#jqxPopupWindowRepair').jqxWindow('close');
});

$("#jqxRepairSubmitButton").on('click', function () {
  save_Repair();
});

$("#jqxPopupWindowDetails").jqxWindow({ 
  theme: theme,
  width: '75%',
  maxWidth: '75%',
  height: '40%',  
  maxHeight: '40%',  
  isModal: true, 
  autoOpen: false,
  modalOpacity: 0.7,
  showCollapseButton: false 
});


$("#jqxPopupWindowStock_return").jqxWindow({ 
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

$("#jqxPopupWindowStock_return").on('close', function () {
  reset_form_stock_return();
});

$("#jqxReturnCancelButton").on('click', function () {
  reset_form_stock_return();
  $('#jqxPopupWindowStock_return').jqxWindow('close');
});

$("#jqxReturnSubmitButton").on('click', function () {
  save_Return();
});

$("#jqxPopupWindowStock_transfer").jqxWindow({ 
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

$("#jqxPopupWindowStock_transfer").on('close', function () {
  reset_form_stock_transfer();
});

$("#jqxTransferCancelButton").on('click', function () {
  $('#jqxPopupWindowStock_transfer').jqxWindow('close');
  reset_form_stock_transfer();
});

$("#jqxTransferSubmitButton").on('click', function () {
  save_Stock_transfer();
});

$("#jqxPopupWindowStatus_Change").jqxWindow({ 
  theme: theme,
  width: '35%',
  maxWidth: '35%',
  height: '35%',  
  maxHeight: '35%',  
  isModal: true, 
  autoOpen: false,
  modalOpacity: 0.7,
  showCollapseButton: false 
});

$("#jqxPopupWindowHold_remark").jqxWindow({ 
  theme: theme,
  width: '35%',
  maxWidth: '35%',
  height: '35%',  
  maxHeight: '35%',  
  isModal: true, 
  autoOpen: false,
  modalOpacity: 0.7,
  showCollapseButton: false 
});

$("#jqxPopupWindowStatus_Change").on('close', function () {
  reset_form_Status_change();
});

$("#jqxStatus_changeCancelButton").on('click', function () {
  $('#jqxPopupWindowStatus_Change').jqxWindow('close');
  reset_form_Status_change();
});

$("#jqxStatus_changeSubmitButton").on('click', function () {
  save_Status_change();
});

$("#hold_remarkSubmitButton").on('click', function () {    
    savehold_remarkRecord();
});

$("#hold_remarkCancelButton").on('click', function () {    
     reset_form_hold_remarks();
  $('#jqxPopupWindowHold_remark').jqxWindow('close');
});


});

function Stock_damage(index){
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if (row) {
    $('#stock_records_id').val(row.stock_id);
    $('#dispatch_dealer').val(row.dealer_dispatch_date);
    openPopupWindow('jqxPopupWindowStock_damage', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  }
}

function challan_status(index) {
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if(row){
    $('#challan_status_id').val(row.stock_id);
    if(row)
    {
      $('#challan_status_id').val(row.stock_id);
      $('#logistic_confirmation_id').val(row.id);
      if(row.challan_status != 'On Hold'){
        $('#status_ok').prop('checked','true');
        $('#location').val('');
        $('#location_tr').hide();
        //  $('#hold_remark').val('');
        // $('#remark_hold').hide();
        $
      }else{
        $('#status_hold').prop('checked','true');
        $('#location').val(row.location);
        $('#location_tr').show();
        // $('#hold_remark').val(row.reamrk);
        // $('#remark_hold').show();
      }
    }
    openPopupWindow('jqxPopupWindowChallan_status', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  }
}

function Repair(index){
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  // console.log(row);
  if (row) {
    $('#stock_id').val(row.stock_id); 
    $('#vehicle_id').val(row.vehicle_id);
    $('#variant_id').val(row.variant_id);
    $('#color_id').val(row.color_id); 
    openPopupWindow('jqxPopupWindowRepair', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  }
}
// function Details(index){
//   var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
//   if (row) 
//   {
//     $('#damage_date_detail').html(row.damage_date);
//     $('#repair_commitment_date_detail').html(row.repair_commitment_date);
//     $('#repair_date_detail').html(row.repair_date);
//     $('#remarks_detail').html(row.remarks);
//     openPopupWindow('jqxPopupWindowDetails', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
//   }
// }

function Details(index){
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  var html = '';
  $.post('<?php echo site_url('stock_records/get_damage_log_detail_json') ?>',{id:row.stock_id},function(result){
      if(result.rows){
        $.each(result.rows,function(k,v){
          html += '<div class="row">'
          html += '<div class="col-md-3"><label for="damage_date"><?php echo lang('damage_date')?></label></div>';
          html += '<div class="col-md-1">:</div>';
          html += '<div class="col-md-8"><div class="damage_date_detail">'+v.damage_date+'</div></div>';
          html += '</div>';
          html += '<div class="row">'
          html += '<div class="col-md-3"><label for="damage_date"><?php echo lang('accident_type')?></label></div>';
          html += '<div class="col-md-1">:</div>';
          html += '<div class="col-md-8"><div class="damage_date_detail">'+v.accident_type+'</div></div>';
          html += '</div>';
          html += '<div class="row">';
          html += '<div class="col-md-3"><label for="repair_commitment_date"><?php echo lang('repair_commitment_date')?>';
          html += '</label></div>';
          html += '<div class="col-md-1">:</div>';
          html += '<div class="col-md-8"><div class="repair_commitment_date_detail">'+v.repair_commitment_date+'</div></div>';
          html += '</div>';
          html += '<div class="row">';
          html += '<div class="col-md-3"><label for="repair_date"><?php echo lang('repair_date')?></label></div>';
          html += '<div class="col-md-1">:</div>';
          html += '<div class="col-md-8"><div class="repair_date_detail">'+v.repair_date+'</div></div>';
          html += '</div>';
          html += '<div class="row">';
          html += '<div class="col-md-3"><label for="remarks"><?php echo lang('remarks')?></label></div>';
          html += '<div class="col-md-1">:</div>';
          html += '<div class="col-md-8"><div class="remarks_detail">'+v.remarks+'</div></div>';
          html += '</div>';

        });
        $('#detail-damage-record').html(html);
      }
  },'json');
  // if (row) 
  // {
  //   $('#damage_date_detail').html(row.damage_date);
  //   $('#repair_commitment_date_detail').html(row.repair_commitment_date);
  //   $('#repair_date_detail').html(row.repair_date);
  //   $('#remarks_detail').html(row.remarks);
    openPopupWindow('jqxPopupWindowDetails', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  // }
}

function addHoldRemarks(index){
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);

  if (row)
  {   
    $('#log_stock_id').val(row.stock_id);
    // $('#current_stockyard').val(row.current_location);
    openPopupWindow('jqxPopupWindowHold_remark', 'Add Hold Remark');
  }
}


function Stock_return(index)
{
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if (row)
  {
    if(row.dealer_retail_date)
    {
      alert('Vehicle Already Sold');
    }
    else
    {
     $('#dispatch_id').val(row.dispatch_id);
     $('#return_stock_id').val(row.id);
     $('#return_dealer_id').val(row.dealer_id);
     $('#return_order_id').val(row.order_id);
   }
   openPopupWindow('jqxPopupWindowStock_return', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
 }
}

function Stock_transfer(index)
{
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if (row)
  {   
    $('#stock_record_id_transfer').val(row.stock_id);
    $('#current_stockyard').val(row.current_location);
    openPopupWindow('jqxPopupWindowStock_transfer', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  }
}

function Stock_transfer_detail(index) {
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  printList(row.driver_id);
  // console.log(row);
}

function Change_status(index)
{
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if (row)
  {   
    $('#vehicle_main_id').val(row.id);
    $('#current_stockyard').val(row.current_location);
    openPopupWindow('jqxPopupWindowStatus_Change', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  }
}


function saveStock_recordRecord(){
  var data = $("#form-stock_damage").serialize();

  $('#jqxPopupWindowStock_damage').block({ 
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
    url: '<?php echo site_url("admin/stock_records/save"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        reset_form_stock_records();
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowStock_damage').jqxWindow('close');
      }
      $('#jqxPopupWindowStock_damage').unblock();
    }
  });
}

function savechallan_statusRecord() {
  var data = $("#form-challan_status").serialize();

  $('#jqxPopupWindowChallan_status').block({ 
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
    url: '<?php echo site_url("admin/stock_records/saveChallanStatus"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        reset_form_stock_records();
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowChallan_status').jqxWindow('close');
      }
      $('#jqxPopupWindowChallan_status').unblock();
    }
  });
}

function reset_form_stock_records(){
  $('#stock_records_id').val('');
  $('#form-stock_damage')[0].reset();
}

function savehold_remarkRecord() {
  var data = $("#form-hold_remark").serialize();

  $('#jqxPopupWindowChallan_status').block({ 
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
    url: '<?php echo site_url("admin/stock_records/saveHoldRemark"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        reset_form_hold_remarks();
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowHold_remark').jqxWindow('close');
      }
      $('#jqxPopupWindowHold_remark').unblock();
    }
  });
}

function reset_form_hold_remarks(){
  $('#stock_records_id').val('');
  $('#form-hold_remark')[0].reset();
}


function save_Repair(){
  var data = $("#form-repair").serialize();

  $('#jqxPopupWindowRepair').block({ 
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
    url: '<?php echo site_url("admin/stock_records/save_repair"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        reset_form_stock_records();
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowRepair').jqxWindow('close');
      }
      $('#jqxPopupWindowRepair').unblock();
    }
  });
}

function reset_form_repair(){
  $('#stock_id').val('');
  $('#form-repair')[0].reset();
}

function Dealer_reject(index)
{
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);

  $('#jqxGridStock_record').block({ 
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
    url: '<?php echo site_url("admin/stock_records/dealer_reject"); ?>',
    data: {id:row.id},
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
      }
      $('#jqxGridStock_record').unblock();
    }
  });

}

function Dealer_accept(index)
{
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);

  $('#jqxGridStock_record').block({ 
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
    url: '<?php echo site_url("admin/stock_records/dealer_accept"); ?>',
    data: {id:row.id},
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
      }
      $('#jqxGridStock_record').unblock();
    }
  });
}

function save_Return(){
  var data = $("#form-stock_return").serialize();

  $('#jqxPopupWindowStock_return').block({ 
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
    url: '<?php echo site_url("admin/stock_records/save_stock_return"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        reset_form_stock_records();
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowStock_return').jqxWindow('close');
      }
      $('#jqxPopupWindowStock_return').unblock();
    }
  });
}

function reset_form_stock_return(){
  $('#dispatch_id').val('');
  $('#form-stock_return')[0].reset();
}

/*function save_Stock_transfer(){
var data = $("#form-stock_transfer").serialize();

$('#jqxPopupWindowStock_transfer').block({ 
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
url: '<?php echo site_url("admin/stock_records/save_stock_transfer"); ?>',
data: data,
success: function (result) {
var result = eval('('+result+')');
if (result.success) {
$('#jqxGridStock_record').jqxGrid('updatebounddata');
$('#jqxPopupWindowStock_transfer').jqxWindow('close');
reset_form_stock_records();
}
$('#jqxPopupWindowStock_transfer').unblock();
}
});
}*/
function save_Stock_transfer(){
  var data = $("#form-stock_transfer").serialize();

  $('#jqxPopupWindowStock_transfer').block({ 
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

    url: '<?php echo site_url("admin/stock_records/save_stock_transfer"); ?>',
    data: data,
    success: function (result) {

      var result = eval('('+result+')');
      // var driver_id = result.driverid;

      if (result.success) {
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowStock_transfer').jqxWindow('close');
        var driver_id = result.driverid;
        printList(driver_id);
      }
      $('#jqxPopupWindowStock_transfer').unblock();
    }
  });
}

function save_Status_change(){
  var data = $("#form-status_change").serialize();

  $('#jqxPopupWindowStatus_Change').block({ 
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

    url: '<?php echo site_url("admin/stock_records/save_Status_change"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowStatus_Change').jqxWindow('close');
      }
      $('#jqxPopupWindowStatus_Change').unblock();
    }
  });
}

function reset_form_stock_transfer(){
  $('#dispatch_id_transfer').val('');
  // $('#form-stock_return_transfer')[0].reset();
}

$(".location_type").on("checked", function (event) {
  var loc_type = event.target.id;
  if(loc_type == 'stockyard_return')
  {
    $('#return_location_type').val('stockyard');
    var dataDataSource  = {
      url : '<?php echo site_url("admin/stock_records/get_stockyard_combo_json"); ?>',
      datatype: 'json',
      datafields: [
      { name: 'id', type: 'number' },
      { name: 'name', type: 'string' },
      ],
      async: false,
      cache: true
    }
  }

  else if(loc_type == 'dealer_return')
  {
    $('#return_location_type').val('dealer');
    var dataDataSource  = {
      url : '<?php echo site_url("admin/stock_records/get_dealers_combo_json"); ?>',
      datatype: 'json',
      datafields: [
      { name: 'id', type: 'number' },
      { name: 'name', type: 'string' },
      ],
      async: false,
      cache: true
    }
  }

  dataDataAdapter = new $.jqx.dataAdapter(dataDataSource);
  $("#stockyard_return_combobox").jqxComboBox({
    theme: theme,
    width: 195,
    height: 25,
    placeHolder: "Select Location",
    selectionMode: 'dropDownList',
    autoComplete: true,
    searchMode: 'containsignorecase',
    source: dataDataAdapter,
    displayMember: "name",
    valueMember: "id",
  });
});

function printList(stock_id )
{
  if (id == null) {
    var id= stock_id;
  }
  console.log(stock_id);
  var url1 = '<?php echo site_url('driver_details/print_driverdetails?id=') ?>' + id;
  console.log(url1);
  myWindow = window.open(url1, 'Print Stock Records List', "height=900,width=1300");
  myWindow.document.close();
  myWindow.focus();
  myWindow.print();
  location.reload(true);
}
</script>

<script type="text/javascript">
  $('#status_ok').click(function(){
    $('#location_tr').hide();
     // $('#remark_hold').hide();
  });
  $('#status_hold').click(function() {
    $('#location_tr').show();
    // $('#remark_hold').show();
  });
</script>