<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('cancel_order'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('cancel_order'); ?></li>
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

<script language="javascript" type="text/javascript">

	$(function () {

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
			{name: 'vehicle_id', type: 'string'},
			{name: 'variant_id', type: 'string'},
			{name: 'color_id', type: 'string'},
			{name: 'payment_method', type: 'string'},
			{name: 'associated_value_payment', type: 'string'},
			{name: 'order_id', type: 'string'},
			{name: 'dealer_id', type: 'string'},
			{name: 'dealer_name', type: 'string'},
			{name: 'incharge_id', type: 'string'},
			{name: 'year', type: 'string'},
			{name: 'cancel_quantity', type: 'string'},
			{name: 'cancel_date', type: 'date'},
			{name: 'cancel_date_np', type: 'string'},
			{name: 'vehicle_name', type: 'string'},
			{name: 'variant_name', type: 'string'},
			{name: 'color_name', type: 'string'},
			{name: 'color_code', type: 'string'},

			],
			url: '<?php echo site_url("admin/dealer_orders/get_order_cancel_json"); ?>',
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
				text: 'Action', datafield: 'action', width: 75, sortable: false, filterable: false, pinned: true, align: 'center', cellsalign: 'center', cellclassname: 'grid-column-center',
				cellsrenderer: function (index) {
					var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
					var e = '';

					e += '<a href="javascript:void(0)" onclick="approve(' + index + '); return false;" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></a>&nbsp';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>'; 
				}
			},
			{text: '<?php echo lang("order_id");?>', datafield: 'order_id', width: 80, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("dealer_name");?>', datafield: 'dealer_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("vehicle_id"); ?>', datafield: 'vehicle_name', width: 120, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("variant_id"); ?>', datafield: 'variant_name', width: 100, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("color_id"); ?>', datafield: 'color_name', width: 150, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("month_name"); ?>', datafield: 'nepali_month', width: 90, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("year"); ?>', datafield: 'year', width: 100, filterable: true, renderer: gridColumnsRenderer},
			{text: '<?php echo lang("date_of_order"); ?>', datafield: 'date_of_order', width: 110, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
			{text: '<?php echo lang("cancel_date"); ?>', datafield: 'cancel_date', width: 110, filterable: true, renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat: formatString_yyyy_MM_dd},
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
	});

function approve(index) 
{
	var row = $("#jqxGridDealer_order").jqxGrid('getrowdata', index);
	if(confirm('Are you sure?'))
	{
		$.post("<?php echo site_url('dealer_orders/change_order_cancel_status')?>",{id:row.id},function(result)
		{
			if (result.success == true) 
			{
				$('#jqxGridDealer_order').jqxGrid('updatebounddata');
			}

		},'JSON');
	}
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

</script>