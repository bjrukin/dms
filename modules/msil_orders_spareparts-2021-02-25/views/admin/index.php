	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">				
				<fieldset>
					<form action="<?php echo base_url('dispatch_spareparts/order_import') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="order_type" id="order_type">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-2">
									<label>Order Type:</label>
								</div>
								<div class="col-md-1">
									<div id="radio_land_order">Land</div>
								</div>
								<div class="col-md-1">
									<div id="radio_air_order">Air</div>
								</div>
								<div class="col-md-4">
									<div class="col-md-6"><label>Order Date:</label></div>					
									<div class="col-md-6"><div id="order_date" class="date_picker" name="order_date"></div></div>
								</div>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-4"><label>Choose a file:</label></div>
								<div class="col-md-8"><input type="file" name="userfile"></div>
							</div>
							<div class="col-md-6"><button class="btn btn-md btn-flat btn-success">Read</button></div>
						</div>
					</form>
				</fieldset>
				<div id="jqxGridMsil_grouped_order"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->

	<div id="jqxPopupWindowAdd_pi">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="">Add Pi Details</span>
		</div>
		<div class="form_fields_area">
			<?php echo form_open('', array('id' =>'form-pi_add', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "order_no" id = "order_no_pi"/>
			<table class="form-table">
				<tr>
					<td><label for='pi_number'><?php echo lang('pi_number')?></label></td>
					<td><input type="text" class="text_input" name="pi_number"></td>
				</tr>			
				<tr>
					<td><label for='pi_received_date'><?php echo lang('pi_received_date')?></label></td>
					<td><div class="date_picker" name='pi_received_date'></div></td>
				</tr>
				<tr>
					<td><label for='pi_confirmed_date'><?php echo lang('pi_confirmed_date')?></label></td>
					<td><div  class="date_picker" name='pi_confirmed_date'></div></td>
				</tr>		
				<tr>
					<th colspan="2">
						<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxpi_addSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxpi_addCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div id="jqxPopupWindowAdd_Proforma">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="">Add Pi Details</span>
		</div>
		<div class="form_fields_area">
			<form action="<?php echo site_url('admin/msil_orders_spareparts/pi_import') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="order_no" id="order_no">
				<fieldset>
					<div class="col-md-8">
						<div class="col-md-4"><label>Choose a File: </label></div><div class="col-md-8"><input type="file" name="userfile"></div></div>
						<div class="col-md-4"><button class="btn btn-flat btn-success btn-md">Read</button></div>
						<br/>
						<br/>
						<br/>
					</fieldset>
				</form>
			</div>
		</div>
		<script language="javascript" type="text/javascript">

			$(function(){
				$("#radio_land_order").jqxRadioButton({ width: 250, height: 25});
				$("#radio_air_order").jqxRadioButton({ width: 250, height: 25});
				$('#radio_land_order').on('change', function (event) { 
					var checked = event.args.checked;
					if(checked == true)
					{
						$('#order_type').val('land');			
					}
				});
				$('#radio_air_order').on('change', function (event) { 
					var checked = event.args.checked;
					if(checked == true)
					{
						$('#order_type').val('air');			
					}
				});

				$(".date_picker").jqxDateTimeInput({ width: 200, height: 25, showFooter: true,formatString: "yyyy-MM-dd" });

				var msil_ordersDataSource =
				{
					datatype: "json",
					datafields: [
					{ name: 'final_order_no', type: 'string' },
					{ name: 'date', type: 'string' },
					],
					url: '<?php echo site_url("admin/msil_orders_spareparts/grouped_order"); ?>',
					pagesize: defaultPageSize,
					root: 'rows',
					id : 'id',
					cache: true,
					pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	msil_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridMsil_grouped_order").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMsil_grouped_order").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridMsil_grouped_order").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: msil_ordersDataSource,
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
		selectionmode: 'none',
		virtualmode: true,
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showtoolbar: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			container.append($('#jqxGridMsil_grouped_orderToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:85, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {

				var row = $("#jqxGridMsil_grouped_order").jqxGrid('getrowdata', index);
				var e = '' ;
				e += '<a href="javascript:void(0)" onclick="import_pi(' + index + '); return false;" title="Import Pi"><i class="fa fa-plus"></i></a>&nbsp';
				e += '<a href="<?php echo site_url('msil_orders_spareparts/msil_order_list')?>/'+row.final_order_no+'" title="List Order" target="_blank"><i class="fa fa-list"></i></a>&nbsp';
				e += '<a href="<?php echo site_url('msil_orders_spareparts/order_received_list')?>/'+row.final_order_no+'" title="Received Order" target="_blank"><i class="fa fa-circle"></i></a>&nbsp';
				e += '<a href="<?php echo site_url('msil_orders_spareparts/remaining_order_list')?>/'+row.final_order_no+'" title="Remaining Order" target="_blank"><i class="fa fa-circle-o"></i></a>&nbsp';
				e += '<a href="javascript:void(0)" onclick="add_pi_details(' + index + '); return false;" title="Add Pi Details"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("msil_order_no"); ?>',datafield: 'final_order_no',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridMsil_grouped_order").jqxGrid('refresh');}, 500);
	});	

	$("#jqxPopupWindowAdd_pi").jqxWindow({ 
		theme: theme,
		width: '75%',
		maxWidth: '75%',
		height: '50%',  
		maxHeight: '50%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowAdd_pi").on('close', function () {
		reset_form_pi_add();
	});

	$("#jqxpi_addCancelButton").on('click', function () {
		reset_form_pi_add();
		$('#jqxPopupWindowAdd_pi').jqxWindow('close');
	});

	$("#jqxpi_addSubmitButton").on('click', function () {
		save_pi_details();        
	});

	$("#jqxPopupWindowAdd_Proforma").jqxWindow({ 
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
});

	function add_pi_details(index)
	{
		var row =  $("#jqxGridMsil_grouped_order").jqxGrid('getrowdata', index);

		if (row) {
			$('#order_no_pi').val(row.final_order_no);
			openPopupWindow('jqxPopupWindowAdd_pi', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
		}
	}

	function import_pi(index)
	{
		var row =  $("#jqxGridMsil_grouped_order").jqxGrid('getrowdata', index);

		if (row) {
			$('#order_no').val(row.final_order_no);
			openPopupWindow('jqxPopupWindowAdd_Proforma', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
		}
	}

	function save_pi_details(){
		var data = $("#form-pi_add").serialize();

		$('#jqxPopupWindowAdd_pi').block({ 
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
			url: '<?php echo site_url("admin/msil_orders_spareparts/save_pi_details"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					reset_form_pi_add();
					$('#jqxPopupWindowAdd_pi').jqxWindow('close');
				}
				$('#jqxPopupWindowAdd_pi').unblock();
			}
		});
	}

	function reset_form_pi_add(){
		$('#order_no_pi').val('');
		$('#form-pi_add')[0].reset();
	}
</script>