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
                    <?php /*<div class="col-xs-12">
                        <select name="stock_yard_id" id='stock_yard_id'>
                            <option>--select stock-yard--</option>
                            <?php foreach($stock_yards as $key => $value){?>
                            <option value="<?php echo $value->id?>"><?php echo $value->name?></option>
                            <?php }?>
                        </select>
                    </div>*/?>
                    <div class="col-xs-12 connectedSortable">
                    	<?php echo displayStatus(); ?>
<!--				<div id='jqxGridStock_recordToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_recordInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridStock_recordFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>-->
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

<!-- for challan status -->
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
<!-- end challan status -->

<div id="jqxPopupWindowRepair">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Repair Form</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-repair', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "stock_id"/>
		<input type = "hidden" name = "dealer_id" id = "repair_dealer_id"/>
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
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxRepairSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxRepairCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>
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
</div>

<script language="javascript" type="text/javascript">

	$(".date_time_picker").jqxDateTimeInput({ width: '250px', height: '25px',formatString: 'yyyy-M-d'});
	
	$(function(){

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
			{ name: 'stock_yard_id', type: 'number' },
			{ name: 'reached_date', type: 'string' },
			{ name: 'dispatched_date', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_name', type: 'string' },
			{ name: 'color_code', type: 'string' },
			{ name: 'engine_no', type: 'string' },
			{ name: 'chass_no', type: 'string' },
			{ name: 'stock_yard', type: 'string' },
			{ name: 'barcode', type: 'string' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'city_name', type: 'string' },
			{ name: 'district_name', type: 'string' },
			{ name: 'mun_vdc_name', type: 'string' },
			{ name: 'received_date', type: 'string' },
			{ name: 'date_of_delivery', type: 'string' },
			{ name: 'retail_date', type: 'string' },
			{ name: 'damage_date', type: 'string' },
			{ name: 'is_damage', type: 'number' },
			{ name: 'repair_date', type: 'string' },
			{ name: 'damage_status', type: 'string' },
			{ name: 'repair_commitment_date', type: 'string' },
			{ name: 'stock_id', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'year', type: 'number' },
			{ name: 'firm_name', type: 'string' },
			],
			url: '<?php echo site_url("admin/stock_records/dealer_stock_json"); ?>',
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
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index,b,c,d,e,value) {
				console.log(value);
				var e = '';
				if(value.is_damage == 0)
				{					
					e += '<a href="javascript:void(0)" onclick="Stock_damage(' + index + '); return false;" title="Damage"><i class="fa fa-recycle"></i></a>&nbsp';
				}
				else if(value.is_damage == 1)
				{
					e += '<a href="javascript:void(0)" onclick="Repair(' + index + '); return false;" title="Repair"><i class="fa fa-list"></i></a>&nbsp';
				}
				else
				{
					e += '<a href="javascript:void(0)" onclick="Details(' + index + '); return false;" title="Details"><i class="fa fa-circle-o"></i></a>&nbsp';
				}
				// e += '<a href="javascript:void(0)" onclick="challan_status(' + index + '); return false;" title="Challan Status"><i class="fa fa-truck"></i></a>&nbsp';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("color_code"); ?>',datafield: 'color_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("mfg_year"); ?>',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("firm_name"); ?>',datafield: 'firm_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("reached_date"); ?>',datafield: 'received_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("city_name"); ?>',datafield: 'city_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridStock_record").jqxGrid('refresh');}, 500);
	});

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
	$("#jqxStock_recordSubmitButton").on('click', function () {
		saveStock_recordRecord();
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
});

function challan_status(index) {
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if(row){
    $('#challan_status_id').val(row.stock_id);
    openPopupWindow('jqxPopupWindowChallan_status', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
  }
}

function Stock_damage(index){
	var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
	if (row) {
		if(row.retail_date)
		{
			alert('Vehicle Already Sold');
		}
		else
		{
			$('#stock_records_id').val(row.stock_id);
			$('#dispatch_dealer').val(row.dispatch_to_dealer_date);
			$('#location_tr').hide();
			openPopupWindow('jqxPopupWindowStock_damage', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
		}
	}
}

function Repair(index){
	var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
	if (row) {
		$('#stock_id').val(row.stock_id);
		$('#repair_dealer_id').val(row.dealer_id);
		openPopupWindow('jqxPopupWindowRepair', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function Details(index){
	var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
	if (row) 
	{
		$('#damage_date_detail').html(row.damage_date);
		$('#repair_commitment_date_detail').html(row.repair_commitment_date);
		$('#repair_date_detail').html(row.repair_date);
		$('#remarks_detail').html(row.remarks);
		openPopupWindow('jqxPopupWindowDetails', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
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

function reset_form_stock_records(){
	$('#stock_records_id').val('');
	$('#form-stock_damage')[0].reset();
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
		url: '<?php echo site_url("admin/stock_records/save_repair_dealer"); ?>',
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

function reset_form_repair(){
	$('#stock_id').val('');
	$('#form-repair')[0].reset();
}


</script>

<script type="text/javascript">
  $('#status_ok').click(function(){
    $('#location_tr').hide();
  });
  $('#status_hold').click(function() {
    $('#location_tr').show();
  });
</script>