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
						<li></li>
						<li><a href="#"><label>Stock-yard</label><span id="detail_stock_yard" class="pull-right"></span></a></li>
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
		<span class='popup_title' id="window_poptup_title">Select Year</span>
	</div>
	<div class="form_fields_log_year">
		<input type="hidden" id="index">
		<div class="row">
			<div class="col-md-3">
				<label for="log_year">Year:</label>	
			</div>
			<div class="col-md-9">
				<input type="text" class="text_input" name="year_logistic" id="log_year" placeholder="Enter Year">				
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<label for="repaired">Repaired:</label>
			</div>
			<div class="col-md-9">
				<div id="check_repaired"></div>
			</div>
		</div>
		<button type="button" class="btn btn-flat btn-xs btn-warning" id="jqxSubmitButton">Generate</button>
	</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ajaxuploader.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>

<script language="javascript" type="text/javascript">

	$("#check_repaired").jqxCheckBox({ width: 120, height: 25 });
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
	$(function () {

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
			{name: 'id', type: 'number'},
			{name: 'vehicle_id', type: 'integer'},
			{name: 'color_id', type: 'integer'},
			{name: 'date_of_order', type: 'date'},
			{name: 'date_of_delivery', type: 'date'},
			{name: 'delivery_lead_time', type: 'string'},
			{name: 'pdi_status', type: 'number'},
			{name: 'date_of_retail', type: 'date'},
			{name: 'retail_lead_time', type: 'string'},
			{name: 'variant_id', type: 'integer'},
			{name: 'vehicle_name', type: 'string'},
			{name: 'variant_name', type: 'string'},
			{name: 'color_name', type: 'string'},
			{name: 'payment_status', type: 'string'},
			{name: 'dispatch_id', type: 'integer'},
			{name: 'driver_name', type: 'string'},
			{name: 'driver_address', type: 'string'},
			{name: 'driver_contact', type: 'string'},
			{name: 'driver_liscense_no', type: 'string'},
			{name: 'image_name', type: 'string'},
			{name: 'engine_no', type: 'string'},
			{name: 'chass_no', type: 'string'},
			{name: 'stock_id', type: 'integer'},
			{name: 'dispatched_vehicle_id', type: 'integer'},
			{name: 'chass_no', type: 'string'},
			{name: 'engine_no', type: 'string'},
			{name: 'stock_dispatch_date', type: 'date'},
			{name: 'dealer_name', type: 'string'},
			{name: 'order_year', type: 'integer'},
			{name: 'dealer_id', type: 'integer'},
			],
			url: '<?php echo site_url("admin/dealer_orders/json_dealer_incharge"); ?>',
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
			selectionmode: 'none',
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

					var e = '<a href="javascript:void(0)" onclick="Dispatch_form(' + index + '); return false;" title="Dispatch" class="dispatch_button"><i class="fa fa-truck" aria-hidden="true"></i></a>';
					if (row.dispatch_id) {
						return '<div style="text-align: center; margin-top: 8px;"><button onClick="Dispatch_details(' + index + ')">Details</button></div>';
					}
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			// {text: '<?php echo lang("id"); ?>', datafield: 'id', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("dealer_name"); ?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("model_id"); ?>', datafield: 'vehicle_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("color_id"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("date_of_order"); ?>', datafield: 'date_of_order', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
			// {text: '<?php echo lang("date_of_delivery"); ?>', datafield: 'date_of_delivery', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
			{text: '<?php echo "Dispatched Date"?>', datafield: 'stock_dispatch_date', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
			{
				text: '<?php echo lang("delivery_lead_time"); ?>', datafield: 'delivery_lead_time',width: 150, sortable: false, filterable: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
				cellsrenderer: function (index) {
					var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

					var fromDate = new Date(row.date_of_order);
					var toDate = new Date(row.stock_dispatch_date);
					var timeDiff = (toDate - fromDate) / 1000 / 60 / 60 / 24;
					if (row.stock_dispatch_date)
					{
						return '<div style="text-align: center; margin-top: 8px;">' + timeDiff + '</div>';
					}
					else
					{
						return '<div style="text-align: center; margin-top: 8px;">Not Dispatched</div>';
					}
				}
			},
			// {text: '<?php echo lang("pdi_status"); ?>', datafield: 'pdi_status', width: 150, filterable: true, renderer: gridColumnsRenderer},
			// {text: '<?php echo lang("date_of_retail"); ?>', datafield: 'date_of_retail', width: 150, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
			// {text: '<?php echo lang("retail_lead_time"); ?>', datafield: 'retail_lead_time', width: 150, filterable: true, renderer: gridColumnsRenderer},
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
	openPopupWindow('jqxPopupWindowDealer_order', '<?php echo "Insert". "&nbsp;" . $header; ?>');
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

$("#jqxDealer_orderSubmitButton").on('click', function () {
	saveDealer_orderRecord();
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
	$('#log_year').val('');
});

});


function Dispatch_form(index) 
{
	$('#index').val(index);
	openPopupWindow('jqxPopupWindowDispatch_form', '<?php echo lang("general_edit") . "&nbsp;" . $header; ?>');
}

$('#jqxSubmitButton').click(function(){
	var index = $('#index').val();
	var year_logistic = $('#log_year').val();
	var is_repaired = $("#check_repaired").jqxCheckBox('val');;
	submit_form(index,year_logistic,is_repaired);
});

function submit_form(index,year_logistic,is_repaired) {

	uploadReady();
	var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);

	$('#challan_id').val(row.id);
	$('#vehicle_id').html(row.vehicle_name);
	$('#variant_id').html(row.variant_name);
	$('#color_id').html(row.color_name);
	$('#engine_no').html('');
	$('#chasis_no').html('');
	$('#barcode').html('');
	$('#stock_id').val(row.stock_id);
	$('#jqxDealer_orderSubmitButton').prop('disabled', true);

	$.post('<?php echo site_url('dealer_orders/get_nearest_stockyard') ?>', {id: row.id, vehicle_id: row.vehicle_id, variant_id: row.variant_id, color_id: row.color_id, year:year_logistic,dealer_id : row.dealer_id , is_repaired:is_repaired}, function (result) {
		if (result.result == 1) {
			$('#stock_message').html('');
			$('#stock_id').val(result.vehicle[0]['id']);
			$('#stock_yard_id').val(result.vehicle[0]['stock_yard_id']);
			$('#vehicle_stock_id').val(result.vehicle[0]['stock_vehicle_id']);
			$('#stock_message').css('background-color', 'white');
			$('#engine_no').html(result.vehicle[0]['engine_no']);
			$('#chasis_no').html(result.vehicle[0]['chass_no']);
			$('#dealer_id').val(result.dealer[0].id);
			$('#dealer_name').html(result.dealer[0].name);
			$('#address').html(result.dealer[0].address_1);
			$('#phone').html(result.dealer[0].phone);
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
		$('#driver_image').html('<img src="<?php echo base_url() . "uploads/driver_docs/" ?>' + row.image_name + '">');
		$('#challan_print_btn').html('<btn onclick="printList(' + row.id + ')" class="btn btn-primary btn-flat btn-xs">Print Challan</btn>')

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
                //status.text('Uploading...');
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