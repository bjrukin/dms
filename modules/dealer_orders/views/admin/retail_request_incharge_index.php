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
.cls-green { background-color: #3abb23; }
.cls-yellow{background-color: #f4dc42;}
.cls-blue{background-color: #4980d8;}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('menu_retail_list'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('menu_retail_list'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>  
				<div id='jqxGridDealer_orderToolbar' class='grid-toolbar'>
					<a href="<?php echo site_url('dealer_orders/daily_dispatch')?>" target="_blank"><button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDealer_orderGenerate"><?php echo lang('generate_daily_dispatch'); ?></button></a>
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
		<div id="message"><span id="stock_message" style="color:white;padding: 5px"></span></div>
		<table class="form-table">
			<tr>
				<td><h4>Dealer Detail</h4></td>
			</tr>
			<tr>
				<td><label for='Dealer_name'><?php /* echo lang('vehicle') */ echo "Dealer" ?></label></td>
				<td><div id='dealer_name' name='dealer_name'></div></td>
				<td><label for='Dealer_Address'>Address</label></td>
				<td><div id='address' name='dealer_adderss'></div></td>
			</tr>
			<tr>
				<td><label for='contact_no'>Contact NO:</label></td>
				<td><div id='phone' name='contact_no'></div></td>
			</tr>
			<tr>
				<td><h4>Vehicle Details</h4><hr/></td>
			</tr>
			<tr>
				<td><label for='vehicle_id'><?php /* echo lang('vehicle') */ echo "Vehicle" ?></label></td>
				<td><div id='vehicle_id' name='vehicle_id'></div></td>
				<td><label for='variant_id'><?php echo lang('variant_id') ?></label></td>
				<td><div id='variant_id' name='variant_id'></div></td>
			</tr>
			<tr>
				<td><label for='color_id'><?php echo lang('color_id') ?></label></td>
				<td><div id='color_id' name='color_id'></div></td>
				<td><label for="nearest_stockyard"><?php echo "Nearest Stockyard" ?></label></td>
				<td><div id="nearest_stockyard_value" name="nearest_stockyard_value"></div></td>
			</tr>
			<tr>
				<td><label for="engine_no"><?php echo "Engine No" ?></label></td>
				<td><div id="engine_no" name="engine_no"></div></td>
				<td><label for="chasis_no"><?php echo "Chasis No" ?></label></td>
				<td><div id="chasis_no" name="chasis_no"></div></td>
			</tr>			
			<tr><td><h4>Driver Details</h4><hr/></td></tr>
			<tr>
				<td>
					<label for="driver_image">Driver Image</label>
				</td>         
				<td>
					<div id="driver_image"></div>
					<div id="result_image"></div>
				</td>      
			</tr>
			<?php echo form_open('', array('id' => 'form-dispatch_info', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "id" id = "dealer_orders_id"/>
			<input type="hidden" id="image_file" name="image_name">
			<input type="hidden" name="challan_id" id="challan_id">
			<input type="hidden" name="stock_id" id="stock_id">
			<input type="hidden" name="stock_vehicle_id" id="vehicle_stock_id">
			<input type="hidden" name="stock_yard_id" id="stock_yard_id">
			<input type="hidden" name="dealer_id" id="dealer_id">
			<input type="hidden" name="dispatch_id" id="dispatch_id">
			<input type="hidden" name="nepali_month" id="nep_month">
			<tr>
				<td><label>Driver Name</label><input type="text" name="driver_name" class="form-control"></td>
				<td><label>Driver Address</label><input type="text" name="driver_address" class="form-control"></td>
			</tr>
			<tr>
				<td><label>Driver Contact No.</label><input type="text" name="driver_contact_no" class="form-control"></td>
				<td><label>Driver License No.</label><input type="text" name="driver_liscense_no" class="form-control"></td>
			</tr>
			<tr  id="remarks_dispatch_delay" style="display: none;">
				<td><label>Delay Dispatch Remarks</label></td><td><textarea name="remarks_delay" class="textbox" id = 'remarks_delay' hidden="true" rows="5" cols="40"></textarea></td>
			</tr> 
			<tr>
				<td><label for="damage">Damage</label></td><td><div id="damage_toggle"></div></td>
			</tr>
			<tr class="challan_dmg" style="display: none;">
				<td><label>Remarks</label><textarea rows="5" cols="40" name="remarks"></textarea></td>
			</tr> 
			<tr class="challan_dmg" style="display: none;">
				<td>
					<label for="challan_damage">Challan Damage</label>
					<form action="<?php echo site_url('dealer_orders/challan_upload_image') ?>" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
						<label id="image_upload_name" style="display:none"></label>

						<input name="image" id="image" class='text_input' style="display:none"/>
						<input type="file" id="image_upload" name="userfile" style="display:block"/>
					</form>
				</td>            
			</tr>          
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDealer_orderSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDealer_orderCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
			<?php echo form_close(); ?>

			<tr>
				<td><a onClick="printList()" class="btn" id="print_challan" style="display: none"><span><i class="icon-print"></i></span>Print</a></td>
			</tr>
		</table>
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
					<div id="challan_print_btn"></div>
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
					</div>
				</ul>
			</div>
		</div>

	</div>
</div>
<div id="jqxPopupWindowDispatch_form">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Vehicle Detail</span>
	</div>
	<div class="form_fields_log_year">
		<input type="hidden" id="index">
		<div class="row">
			<div class="col-md-3"> <label for="chassis_no">Chassis No:</label> </div>
			<div class="col-md-9"> <input type="text" class="text_input" name="chassis_no" id="chassis_no" placeholder="Enter Chassis"> </div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-3"> <label for="nepali_month">Month</label> </div>
			<div class="col-md-9"> <div id="nepali_month"></div></div>
		</div>		
		<button type="button" class="btn btn-flat btn-xs btn-warning" id="jqxSubmitButton">Generate</button>
		<div class="row">
			<div class="col-md-12">
				<h3>Suggested Stock</h3>
				<div id="available_stock"></div>
			</div>
		</div>

	</div>
</div>
</div>

<div id="jqxPopupWindowCancel_dispatch">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Cancel Dispatch Form</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-Cancel_dispatch', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "dispatch_id" id = "cancel_dispatch_id"/>
		<input type = "hidden" name = "dealer_id" id = "cancel_dealer_id"/>
		<input type = "hidden" name = "stock_id" id = "cancel_stock_id"/>
		<input type = "hidden" name = "order_id" id = "cancel_id"/>
		<table class="form-table app-table">
			<tr>
				<td><label for="stockyard">Stockyard</label></td>
				<td><div id="stockyard_id" name="stockyard_id"></div></td>
			</tr>
			<tr>
				<td> <label><span>Remarks</span></label> </td>
				<td> <input type="text" name="reason" class="text_area" id="reason"></td>
			</tr>
			<tr>
				<th colspan="3">
					<button type="button" class="btn btn-success btn-md btn-flat" id="jqxCancel_dispatchSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-md btn-flat" id="jqxCancel_dispatchCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<div id="jqxPopupWindowEdit_Dispatch_month">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'>Cancel Dispatch Form</span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-edit_Dispatch_month', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "edit_dispatch_id" id = "edit_dispatch_id"/>
		<table class="form-table app-table">
			<tr>
				<td><label for="dealer_name">Dealer Name</label></td>
				<td><input id="edit_dealer_name" class="text_input" readonly="true"></td>
			</tr>
			<tr>
				<td><label for="chassis_no">Chassis No.</label></td>
				<td><input id="edit_chassis_no" class="text_input" readonly="true"></td>
			</tr>
			<tr>
				<td><label for="month">Dispatch Month</label></td>
				<td><div id="edit_dispatch_month" name="dispatch_month"></div></td>
			</tr>
			<tr>
				<td><label for="year">Dispatch Year</label></td>
				<td><input id="edit_dispatch_year" class="text_input" name="edit_dispatch_year"></td>
			</tr>
			<tr>
				<td><label for="month">Dispatch Date</label></td>
				<td><div id="edit_dispatch_date" class="date_box" name="dispatch_date"></div></td>
			</tr>
			<tr>
				<th colspan="3">
					<button type="button" class="btn btn-success btn-md btn-flat" id="jqxEdit_Dispatch_monthSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-md btn-flat" id="jqxEdit_Dispatch_monthCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ajaxuploader.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>

<script language="javascript" type="text/javascript">

	$(function () {
		$("#edit_dispatch_date").jqxDateTimeInput({ width: '250px', height: '25px' });
		$('#driver_image').jqxFileUpload({ width: 300, uploadUrl: '<?php echo site_url('dealer_orders/upload_image') ?>', fileInputName: 'image_file' });
		$('#driver_image').on('uploadEnd', function (event) {
			var args = event.args;
			var parsed_data = JSON.parse(args.response);
			var file = parsed_data.file_name;
			var img ='<div id="thumb-image" align="center"> <img src="'+base_url+'uploads/driver_docs/'+file+'" alt="Thumbnail" height = "400"> <a href="#" class="change-image"  class="btn btn-danger btn-xs" title="Delete" onClick="removeImage()"><span class="glyphicon glyphicon-remove"></span></a> <br /></div>';

			$('#result_image').html(img);
			$('#image_file').val(file);
			$('#driver_image').hide();
		});


		var stockyardDataSource  = {
			url : '<?php echo site_url("admin/dealer_orders/get_stockyard_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		stockyardDataAdapter = new $.jqx.dataAdapter(stockyardDataSource);

		$("#stockyard_id").jqxComboBox({
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

		var nepali_monthDataSource  = {
			url : '<?php echo site_url("admin/dealer_orders/get_nepali_month_list"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true
		}

		nepali_monthDataAdapter = new $.jqx.dataAdapter(nepali_monthDataSource);

		$("#nepali_month").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			placeHolder: "Select Month",
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: nepali_monthDataAdapter,
			displayMember: "name",
			valueMember: "id",
		});

// $("#check_repaired").jqxCheckBox({ width: 120, height: 25 });
$("#damage_toggle").jqxCheckBox({ width: 120, height: 25 });
$("#damage_toggle").bind('change', function (event) {
	var checked = event.args.checked;
	if(checked == true)
	{
		$('.challan_dmg').show();
	}
	else
	{
		$('.challan_dmg').hide();
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
	{name: 'year', type: 'number'},
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
	{name: 'dispatch_id', type: 'number'},
	{name: 'vehicle_ageing', type: 'number'},
	{name: 'order_ageing', type: 'number'},
	{name: 'credit_control_ageing', type: 'number'},
	{name: 'logistic_ageing', type: 'number'},
	{name: 'dispatch_ageing', type: 'number'},
	{name: 'payment_value', type: 'string'},
	{name: 'nepali_month', type: 'string'},
	{name: 'reject_reason', type: 'string'},
	{name: 'driver_name', type: 'string'},
	{name: 'driver_address', type: 'string'},
	{name: 'driver_contact', type: 'string'},
	{name: 'driver_liscense_no', type: 'string'},
	{name: 'driver_image', type: 'string'},
	{name: 'dealer_address', type: 'string'},
	{name: 'dealer_phone', type: 'string'},
	{name: 'bill_nepali_month', type: 'string'},
	{name: 'dispatch_month_nepali', type: 'number'},
	{name: 'in_stock_remarks', type: 'number'},
	{name: 'order_status', type: 'string'},
	{name: 'stock_status', type: 'string'},
	{name: 'dispatched_date_np_year', type: 'number'},
	{name: 'bill_nepali_month', type: 'string'},
	{name: 'retail_nepali_month', type: 'string'},
	{name: 'nepali_edit_retail_month', type: 'string'},
	{name: 'credit_approve_date', type: 'date'},
	{name: 'challan_status', type: 'string'},
	{name: 'location', type: 'string'},
	{name: 'vehicle_register_no', type: 'string'},

	],
	url: '<?php echo site_url("admin/dealer_orders/json_retail_request_list"); ?>',
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
	else if(data.in_stock_remarks == 3){
		return 'cls-blue';
	}
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
	{text: 'SN', width: 50, pinned: true, exportable: false, columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer, filterable: false},
	{
		text: 'Dispatch', datafield: 'action', width: 75, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
		cellsrenderer: function (index) {
			var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

			var e = '';
			if (row.dispatch_id) {
				e += '<a href="javascript:void(0)"  onClick="Dispatch_details(' + index + ')" title="Dispatch Details" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp';
				e += '<a href="javascript:void(0)" onclick="cancel_dispatch(' + index + '); return false;" title="Cancel Dispatch"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp';
				e += '<a href="javascript:void(0)" onclick="change_dispatch_month(' + index + '); return false;" title="Edit Dispatch Month"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp';
			}
			else
			{
				e += '<a href="javascript:void(0)" onclick="Dispatch_form(' + index + '); return false;" title="Dispatch" class="dispatch_button"><i class="fa fa-truck" aria-hidden="true"></i></a>&nbsp';
			}


			return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>'; 
		}
	},
	{text: '<?php echo lang("order_id");?>', datafield: 'order_id', width: 60, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("order_status");?>', datafield: 'order_status', width: 100, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("stock_status");?>', datafield: 'stock_status', width: 100, filterable: false, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("dealer_name");?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_name', width: 120, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("chass_no"); ?>', datafield: 'chass_no', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("engine_no"); ?>', datafield: 'engine_no', width: 110, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("color_code"); ?>', datafield: 'color_code', width: 80, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("color_id"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("year"); ?>', datafield: 'year', width: 80, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("vehicle_register_no"); ?>', datafield: 'vehicle_register_no', width: 100, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("month_name"); ?>', datafield: 'nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("retail_request_date"); ?>', datafield: 'date_of_order', width: 140, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname:cellclassname},
	{text: '<?php echo lang("order_ageing"); ?>', datafield: 'order_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: 'Credit Approved Date', datafield: 'credit_approve_date', width: 140, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname:cellclassname,
		cellsrenderer:function (index) {
			var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

			if(row.order_status == 'On Hold'){
				return '';
			}else{
				return row.credit_control_approve_date;
			}
		}
	},
	{text: '<?php echo lang("credit_control_ageing"); ?>', datafield: 'credit_control_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: 'Payment Value', datafield: 'payment_value', width: 150, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},

	{text: '<?php echo lang("bill_nepali_month"); ?>', datafield: 'bill_nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname},
	{text: '<?php echo lang("dealer_dispatch_date"); ?>', datafield: 'dealer_dispatch_date', width: 90, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd, cellclassname:cellclassname},
	{text: '<?php echo lang("dispatch_location"); ?>', datafield: 'stockyard_name', width: 110, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("logistic_ageing"); ?>', datafield: 'logistic_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: '<?php echo lang("retail_nepali_month"); ?>', datafield: 'retail_nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname : cellclassname, cellsrenderer: function (index, row, data) {
			var rowData = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
			if(rowData.nepali_edit_retail_month != null)
			{
				return rowData.nepali_edit_retail_month
			}else{
				return rowData.retail_nepali_month
				
			}
		}	
	},
	{text: 'Challan Status', datafield: 'challan_status', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},
	{text: 'Location', datafield: 'location', width: 90, filterable: true, renderer: gridColumnsRenderer, cellclassname:cellclassname},

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

		// Available Stock
		var available_StockDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'engine_no', type: 'string' },
			{ name: 'chass_no', type: 'string' },
			{ name: 'ageing', type: 'number' },
			],
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
			},
			beforeprocessing: function (data) {
				available_StockDataSource.totalrecords = data.total;
			},
			filter: function () {
				$("#available_stock").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#available_stock").jqxGrid('updatebounddata', 'sort');
			},
			processdata: function(data) {
			}
		};

		$("#available_stock").jqxGrid({		
			width: '100%',
			height: gridHeight,
			source: available_StockDataSource,
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
			showstatusbar: true,
			theme:theme,
			statusbarheight: 30,
			pagesizeoptions: pagesizeoptions,
			showtoolbar: true,
			virtualmode: true,
			showaggregates: true,
			selectionmode: 'singlecell',
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width:150,  align: 'center' , cellsalign: 'left',filterable: false,renderer: gridColumnsRenderer },										
			{ text: '<?php echo lang("ageing"); ?>',datafield: 'ageing',width: 200,filterable: false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#available_stock").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#available_stockFilterClear', function () { 
			$('#available_stock').jqxGrid('clearfilters');
		});

		$("#jqxPopupWindowDealer_order").jqxWindow({
			theme: theme,
			width: '90%',
			maxWidth: '90%',
			height: '90%',
			maxHeight: '90%',
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

		$('#submit-btn').on('click', function () {
			$('#MyUploadForm').submit();
		});

/*$("#jqxDealer_orderSubmitButton").on('click', function () {
saveDealer_orderRecord();
});*/

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

$("#jqxPopupWindowDispatch_form").jqxWindow({
	theme: theme,
	width: '90%',
	maxWidth: '90%',
	height: '90%',
	maxHeight: '90%',
	isModal: true,
	autoOpen: false,
	modalOpacity: 0.7,
	showCollapseButton: false
});

$("#jqxPopupWindowDispatch_form").on('close', function () {
	$('#chassis_no').val('');
});

});

$('#form-dispatch_info').jqxValidator({
	hintType: 'label',
	animationDuration: 500,
	rules: [
	{ input: '#remarks_delay', message: 'Required', action: 'blur', 
	rule: function(input) {
		val = $('#remarks_delay').val();
		var hidden = $('#remarks_delay').attr('hidden');
		if(hidden == 'hidden')
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

$("#jqxDealer_orderSubmitButton").on('click', function () {
	var validationResult = function (isValid) {
		if (isValid) {
			saveDealer_orderRecord();
		}
	};
	$('#form-dispatch_info').jqxValidator('validate', validationResult);

});

// Cancel Dispatch
$("#jqxPopupWindowCancel_dispatch").jqxWindow({
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

$("#jqxPopupWindowCancel_dispatch").on('close', function () {
});

$('#form-Cancel_dispatch').jqxValidator({
	hintType: 'label',
	animationDuration: 500,
	rules: [
	{ input: '#reason', message: 'Required', action: 'blur', 
	rule: function(input) {
		val = $('#reason').val();
		return (val == '' || val == null || val == 0) ? false: true; 
	} 
}] 
});

$("#jqxCancel_dispatchSubmitButton").on('click', function () {
	var validationResult = function (isValid) {
		if (isValid) {
			save_Cancel_dispatch();
		}
	};
	$('#form-Cancel_dispatch').jqxValidator('validate', validationResult);

});
$("#jqxCancel_dispatchCancelButton").on('click', function () {
	$('#jqxPopupWindowCancel_dispatch').jqxWindow('close');
});

// Edit Dispatch Date
$("#jqxPopupWindowEdit_Dispatch_month").jqxWindow({
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

$("#jqxPopupWindowEdit_Dispatch_month").on('close', function () {
});
$("#jqxEdit_Dispatch_monthCancelButton").on('click', function () {
	$('#jqxPopupWindowEdit_Dispatch_month').jqxWindow('close');

});
$("#jqxEdit_Dispatch_monthSubmitButton").on('click', function () {
	save_edit_dispatch_month();
});


function Dispatch_form(index) 
{
	$('#index').val(index);
	var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
	$.post('<?php echo site_url('dealer_orders/generate_suggested_dispatch') ?>',{row:row},function(result)
	{
		$("#available_stock").jqxGrid('clear')
		$.each(result,function(i,v){								
			datarow = {
				'chass_no':v.chass_no,
				'ageing':v.age,
			};
			$("#available_stock").jqxGrid('addrow', null, datarow);
		});

	},'JSON');
	openPopupWindow('jqxPopupWindowDispatch_form', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
}

function cancel_dispatch(index) 
{
	var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
	if(row)
		if(row.customer_retail_date)
		{
			alert('Vehicle Sold to Customer');
			return false;
		}
		else
		{
			$('#cancel_dispatch_id').val(row.dispatch_id);
			$('#cancel_stock_id').val(row.stock_id);
			$('#cancel_dealer_id').val(row.dealer_id);
			$('#cancel_id').val(row.id);
		}
		openPopupWindow('jqxPopupWindowCancel_dispatch', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
	}

	function change_dispatch_month(index) 
	{
		var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
		if(row)
		{
			$("#edit_dispatch_month").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				placeHolder: "Select Month",
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: nepali_monthDataAdapter,
				displayMember: "name",
				valueMember: "id",
			});

			$('#edit_dispatch_id').val(row.dispatch_id);
			$('#edit_chassis_no').val(row.chass_no);
			$('#edit_dealer_name').val(row.dealer_name);
			$('#edit_dispatch_year').val(row.dispatched_date_np_year);
			$('#edit_dispatch_month').jqxComboBox('val',row.dispatch_month_nepali);
			$('#edit_dispatch_date').jqxDateTimeInput('val',row.dealer_dispatch_date);
		}
		openPopupWindow('jqxPopupWindowEdit_Dispatch_month', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
	}

	$('#jqxSubmitButton').click(function(){
		var index = $('#index').val();
		var chassis_no = $('#chassis_no').val();
		var  nep_month = $('#nepali_month').jqxComboBox('val');
		submit_form(index,chassis_no,nep_month);
	});

	function submit_form(index,chassis_no,nep_month) {
		var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
		if(row.logistic_age >= 1)
		{
			$('#remarks_dispatch_delay').show();
			$('#remarks_delay').attr('hidden',false);
		}
		$('#challan_id').val(row.id);
		$('#nep_month').val(nep_month);
		$('#vehicle_id').html(row.vehicle_name);
		$('#variant_id').html(row.variant_name);
		$('#color_id').html(row.color_name);
		$('#dispatch_id').val(row.dispatch_id);
		$('#engine_no').html('');
		$('#chasis_no').html('');
		$('#stock_id').val(row.stock_id);
		$('#jqxDealer_orderSubmitButton').prop('disabled', true);

		$.post('<?php echo site_url('dealer_orders/get_nearest_stockyard') ?>', {id: row.id, chassis_no:chassis_no,dealer_id : row.dealer_id,vehicle_id: row.vehicle_id, variant_id: row.variant_id, color_id: row.color_id, year:row.year  }, function (result) {
			if (result.result == 1) {
				$('#stock_message').html('');
				$('#stock_id').val(result.vehicle.id);
				$('#stock_yard_id').val(result.vehicle.stock_yard_id);
				$('#vehicle_stock_id').val(result.vehicle.stock_vehicle_id);
				$('#stock_message').css('background-color', 'white');
				$('#engine_no').html(result.vehicle.engine_no);
				$('#chasis_no').html(result.vehicle.chass_no);
				$('#dealer_id').val(result.dealer.id);
				$('#dealer_name').html(result.dealer.name);
				$('#address').html(result.dealer.address_1);
				$('#phone').html(result.dealer.phone);
				$('#jqxDealer_orderSubmitButton').prop('disabled', false);
				$('#nearest_stockyard_value').html(result.stockyard);
			} else {
				$('#stock_message').css('background-color', 'red')
				$('#stock_message').html('Out of stock');
			}
		}, 'json');

		openPopupWindow('jqxPopupWindowDealer_order', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');

	}
	function saveDealer_orderRecord() {
		var data = $("#form-dispatch_info").serialize();
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
			url: '<?php echo site_url("admin/dispatch_dealers/save"); ?>',
			data: data,
			success: function (result) {
				var result = eval('(' + result + ')');
				if (result.success == true) {
					reset_form_dealer_orders();
					$('#jqxGridDealer_order').jqxGrid('updatebounddata');
					$('#dispatch_id').val(result.dispatch_id);
					$('#jqxDealer_orderSubmitButton').prop('disabled', true);
					$('.dispatch_button').hide();
					$('#print_challan').show();
				}
				$('#jqxPopupWindowDealer_order').unblock();
			}
		});
	}


	function save_Cancel_dispatch() {
		var data = $("#form-Cancel_dispatch").serialize();
		$('#jqxPopupWindowCancel_dispatch').block({
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
			url: '<?php echo site_url("admin/dealer_orders/save_cancel_dispatch"); ?>',
			data: data,
			success: function (result) {
				var result = eval('(' + result + ')');
				if (result.success == true) {
					reset_form_cancel_dispatch();
					$('#jqxGridDealer_order').jqxGrid('updatebounddata');
					$('#jqxPopupWindowCancel_dispatch').jqxWindow('close');
				}
				$('#jqxPopupWindowCancel_dispatch').unblock();
			}
		});
	}

	function reset_form_dealer_orders() {
		$('#dealer_orders_id').val('');
		$('#form-dispatch_info')[0].reset();
		$('#MyUploadForm').show();
	}
	function reset_form_grn_add() {
		$('#orders_id').val('');
		$('#form-Grn_add')[0].reset();
	}
	function reset_form_cancel_dispatch() {
		$('#cancel_id').val('');
		$('#cancel_stock_id').val('');
		$('#cancel_dealer_id').val('');
		$('#form-Cancel_dispatch')[0].reset();
	}
	function printList(id = null)
	{
		if (id == null) {
			id = $('#dispatch_id').val();
		}
		var url = '<?php echo site_url('dispatch_dealers/print_challan_doc?challan_id=') ?>' + id;
		myWindow = window.open(url, 'Print Order List', "height=900,width=1300");
		myWindow.document.close();
		myWindow.focus();
		myWindow.print();
	}

	function Dispatch_details(index) {
		var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
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
			$('#driver_image').html('<img src="<?php echo base_url() . "uploads/driver_docs/" ?>' + row.image_name + '">');
			$('#challan_print_btn').html('<btn onclick="printList(' + row.dispatch_id + ')" class="btn btn-primary btn-flat btn-xs">Print Challan</btn>');

			openPopupWindow('jqxPopupWindowDispatch_details', '<?php echo "Dispatch Details";?>');
		}
	}

	function removeImage()
	{
		var filename = $('#image_name').val();
		var id = $('#id').val();
		var r = confirm('Are you sure to remove the image?');
		if (r == true)
		{
			$.post('<?php echo site_url('dealer_orders/upload_delete') ?>', {filename: filename, id: id}, function () {
				$('#form-msg-image').html('');
				$('#image_name').val('');
				$('#upload_image_name').html('');
				$('#upload_image_name').hide();
				$('#change-image').hide();
				$('#display_image_name').text('');
				$('#image_detail').css('display', 'none');
				$('#no_image').css('display', 'block');
				$('#driver_image').show();
				$('#thumb-image').attr('class', 'hide');
				$('#imageInput').show();
				$('#image-Input').show();
				$('#submit-btn').show(); 
				$('#thumb-image').hide();
			});
		}
		return false;
	}

	function save_edit_dispatch_month() {
		var data = $("#form-edit_Dispatch_month").serialize();
		$('#jqxPopupWindowEdit_Dispatch_month').block({
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
			url: '<?php echo site_url("admin/dealer_orders/save_edit_dispatch_month"); ?>',
			data: data,
			success: function (result) {
				var result = eval('(' + result + ')');
				if (result.success == true) {
					$('#jqxGridDealer_order').jqxGrid('updatebounddata');
					$('#jqxPopupWindowEdit_Dispatch_month').jqxWindow('close');
				}
				$('#jqxPopupWindowEdit_Dispatch_month').unblock();
			}
		});
	}
</script>
