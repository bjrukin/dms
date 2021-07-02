<link href="http://localhost/nip/themes/nip/assets/css/uploader_style.css" rel="stylesheet" type="text/css">
<style type="text/css">

	#uploadForm {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
	#uploadForm label {margin:2px; font-size:1em; font-weight:bold;}
	.demoInputBox{padding:5px; border:#F0F0F0 1px solid; border-radius:4px; background-color:#FFF;}
	#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
	.btnSubmit{background-color:#09f;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}
	#progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}
	#targetLayer{width:100%;text-align:center;}
</style>
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('dealer_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>  
				<div id='jqxGridDealer_orderToolbar' class='grid-toolbar'>
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
				<td colspan="3">
					<label for="dirver_image">Driver Image</label>
					<form action="<?php echo site_url('dealer_orders/upload_image') ?>" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
						<div class="image-form" id="image-Input"><input name="image_file" id="imageInput" type="file" /></div>
						<input type="button"  id="submit-btn" class="btn btn-danger btn-xs btn-flat" value="Upload" />

						<img src="<?php echo base_url() ?>assets/images/loading.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
						<div id="progressbox" class="image-form" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
						<div id="output"></div>
					</form>
					<div id="form-msg-image"></div> 
					<input type="hidden" id="upload_image" name="userfile" style="display:none">
				</td>               
			</tr>
			<?php echo form_open('', array('id' => 'form-dispatch_info', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "id" id = "dealer_orders_id"/>
			<input type="hidden" id="hidden_image" name="image_name">
			<input type="hidden" name="challan_id" id="challan_id">
			<input type="hidden" name="stock_id" id="stock_id">
			<input type="hidden" name="stock_vehicle_id" id="vehicle_stock_id">
			<input type="hidden" name="stock_yard_id" id="stock_yard_id">
			<input type="hidden" name="dealer_id" id="dealer_id">
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

<div id="jqxPopupWindowDispatch_form">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Vehicle Detail</span>
	</div>
	<div class="form_fields_log_year">
		<input type="hidden" id="index">
		<div class="row">
			<div class="col-md-3">
				<label for="chassis_no">Chassis No:</label>	
			</div>
			<div class="col-md-9">
				<input type="text" class="text_input" name="chassis_no" id="chassis_no" placeholder="Enter Year">				
			</div>
		</div>		
		<button type="button" class="btn btn-flat btn-xs btn-warning" id="jqxSubmitButton">Generate</button>
	</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ajaxuploader.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>

<script language="javascript" type="text/javascript">

	$(function () {

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

	var progressbox = $('#progressbox');
	var progressbar = $('#progressbar');
	var statustxt = $('#statustxt');
	var completed = '0%';

	var options = {
		target: '#output', 
		beforeSubmit: beforeSubmit,
		uploadProgress: OnProgress,
		success: afterSuccess, 
		resetForm: true      
	};

	$('#MyUploadForm').submit(function () {
		$(this).ajaxSubmit(options);
		return false;
	});

	function OnProgress(event, position, total, percentComplete)
	{
		progressbar.width(percentComplete + '%') 
		statustxt.html(percentComplete + '%');
		if (percentComplete > 50)
		{
			statustxt.css('color', '#fff'); 
		}
	}

	function beforeSubmit() {
		if (window.File && window.FileReader && window.FileList && window.Blob)
		{

			if (!$('#imageInput').val())
			{
				$("#output").html("Choose file");
				return false
			}

			var fsize = $('#imageInput')[0].files[0].size; 
			var ftype = $('#imageInput')[0].files[0].type; 

			switch (ftype)
			{
				case 'image/png':
				case 'image/gif':
				case 'image/jpeg':
				case 'image/pjpeg':
				break;
				default:
				$("#output").html("<b>" + ftype + "</b> Unsupported file type!");
				return false
			}


			if (fsize > 10000000)
			{
				$("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
				return false
			}


			progressbox.show();
			progressbar.width(completed);
			statustxt.html(completed); 
			statustxt.css('color', '#000'); 


			$('#submit-btn').hide();
			$('#loading-img').show(); 
			$("#output").html("");
		}
		else
		{

			$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
			return false;
		}
	}

	function afterSuccess()
	{
		$('#submit-btn').hide();
		$('#loading-img').hide();
		$('.image-form').hide();
		$('#change-image').show();
		$('#imageInput').hide();
		var imagename = $('#imagename').val();
		$('#hidden_image').val(imagename);
	}

	function bytesToSize(bytes) {
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if (bytes == 0)
			return '0 Bytes';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	}

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
		{name: 'order_id', type: 'string'},
		{name: 'dealer_id', type: 'string'},
		{name: 'dealer_name', type: 'string'},
		{name: 'incharge_id', type: 'string'},
		{name: 'year', type: 'string'},
		{name: 'cancel_quantity', type: 'string'},
		{name: 'cancel_date', type: 'date'},
		{name: 'cancel_date_np', type: 'string'},
		{name: 'credit_control_approval', type: 'string'},
		{name: 'credit_approve_date', type: 'date'},
		{name: 'credit_approve_date_np', type: 'string'},
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
            //{name: 'suggested_chass_no', type: 'string'},
            ],
            url: '<?php echo site_url("admin/dealer_orders/generate_daily_dispatch"); ?>',
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
        	if (data.day_date > 15) {
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
        		text: 'Dispatch', datafield: 'action', width: 75, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
        		cellsrenderer: function (index) {
        			var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

        			var e = '';
        			if (row.dispatch_id) {
        				e += '<a href="javascript:void(0)"  onClick="Dispatch_details(' + index + ')" title="Dispatch Details" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp';
        				e += '<a href="javascript:void(0)" onclick="cancel_dispatch(' + index + '); return false;" title="Cancel Dispatch"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp';
        			}
        			else
        			{
        				e += '<a href="javascript:void(0)" onclick="Dispatch_form(' + index + '); return false;" title="Dispatch" class="dispatch_button"><i class="fa fa-truck" aria-hidden="true"></i></a>&nbsp';
        			}
        			
        			return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>'; 
        		}
        	},
        	{text: '<?php echo lang("order_id");?>', datafield: 'order_id', width: 60, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("dealer_name");?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_name', width: 120, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 90, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("color_id"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("month_name"); ?>', datafield: 'nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("year"); ?>', datafield: 'year', width: 80, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("date_of_order"); ?>', datafield: 'date_of_order', width: 110, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
        	{text: '<?php echo lang("order_ageing"); ?>', datafield: 'order_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer},
        	{text: '<?php echo lang("credit_control_approve_date"); ?>', datafield: 'credit_approve_date', width: 110, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
        	{text: '<?php echo lang("credit_control_ageing"); ?>', datafield: 'credit_control_ageing', width: 90, filterable: true, renderer: gridColumnsRenderer},
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

        $("#jqxPopupWindowDispatch_form").jqxWindow({
        	theme: theme,
        	width: '50%',
        	maxWidth: '50%',
        	height: '35%',
        	maxHeight: '35%',
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

$('#jqxSubmitButton').click(function(){
	var index = $('#index').val();
	var chassis_no = $('#chassis_no').val();
	submit_form(index,chassis_no);
});

function Dispatch_form(index) 
{
	$('#index').val(index);
	openPopupWindow('jqxPopupWindowDispatch_form', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
}

function submit_form(index,chassis_no) {

	uploadReady();
	var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
	if(row.logistic_age >= 1)
	{
		$('#remarks_dispatch_delay').show();
		$('#remarks_delay').attr('hidden',false);
	}
	$('#challan_id').val(row.id);
	$('#vehicle_id').html(row.vehicle_name);
	$('#variant_id').html(row.variant_name);
	$('#color_id').html(row.color_name);
	$('#engine_no').html('');
	$('#chasis_no').html('');
	$('#stock_id').val(row.stock_id);
	$('#jqxDealer_orderSubmitButton').prop('disabled', true);

	$.post('<?php echo site_url('dealer_orders/get_nearest_stockyard') ?>', {id: row.id, chassis_no:chassis_no,dealer_id : row.dealer_id,vehicle_id: row.vehicle_id, variant_id: row.variant_id, color_id: row.color_id }, function (result) {
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
				$('#challan_id').val(result.id);
				$('#jqxDealer_orderSubmitButton').prop('disabled', true);
				$('.dispatch_button').hide();
				$('#print_challan').show();
			}
			$('#jqxPopupWindowDealer_order').unblock();
		}
	});
}

function reset_form_dealer_orders() {
	$('#dealer_orders_id').val('');
	$('#form-dispatch_info')[0].reset();
	$('#MyUploadForm').show();
}

function printList(id = null)
{
	if (id == null) {
		var id = $('#challan_id').val();
	}
	var url = '<?php echo site_url('dispatch_dealers/print_challan_doc?challan_id=') ?>' + id;
	myWindow = window.open(url, 'Print Order List', "height=900,width=1300");
	myWindow.document.close();
	myWindow.focus();
	myWindow.print();
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
			$('#upload_image').show();
			$('#thumb-image').attr('class', 'hide');
			$('#imageInput').show();
			$('#image-Input').show();
			$('#submit-btn').show(); 
			$('#thumb-image').hide();
		});
	}
	return false;
}

</script>
<script type="text/javascript">

	function uploadReady()
	{
		uploader=$('#image_upload');
		new AjaxUpload(uploader, {
			action: '<?php  echo site_url('dealer_orders/challan_damage_upload_image')?>',
			name: 'userfile',
			responseType: "json",
			onSubmit: function(file, ext){
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
                    $.messager.show({title: '<?php  echo lang('error')?>',msg: 'Only JPG, PNG or GIF files are allowed'});
                    return false;
                }
            },
            onComplete: function(file, response){
            	if(response.error==null){
            		var filename = response.file_name;
            		$('#image_upload').hide();
            		$('#image').val(filename);
            		$('#image_upload_name').html(filename);
            		$('#image_upload_name').show();
            		$('#change-image').show();
            	}
            	
            }       
        });     
	}


</script>