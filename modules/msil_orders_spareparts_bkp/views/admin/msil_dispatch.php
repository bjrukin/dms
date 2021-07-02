
<!-- Main content -->
<section class="content">
	<!-- row -->
	<div class="row">
		<div class="col-xs-12 connectedSortable">
			<fieldset>
				<form action="<?php echo site_url('admin/msil_orders_spareparts/excel_read') ?>" method="post" enctype="multipart/form-data">
					<?php $this->session->set_userdata('referred_from', current_url()); ?>
					<div class="row" style="height: 50px; margin-top: 5px;">
						<div class="col-md-5">
							<label>
								<div class="col-md-5">Choose File to Upload:</div>	
								<div class="col-md-7"><input type="file" name="userfile"></div>	
							</label>
						</div>
						<div class="col-md-7"><button class="btn btn-md btn-flat btn-success">Read</button></div>
					</div>
				</form>
			</fieldset>
			<div id="jqxGridMsil_dispatch"></div>
		</div><!-- /.col -->
	</div>
	<!-- /.row -->
</section><!-- /.content -->

<div id="jqxPopupWindowBinning_Confirm">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo lang('binning_confirm');?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' => 'form-binning_confirm', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "binning_invoice_no" id = "binning_invoice_no"/>
		<table class="form-table">
			<tr>
				<th colspan="4" style="text-align: center !important;">
					<h3>Are You Sure You Want to Confirm?</h3>
					<br/> <br/>
					<button type="button" class="btn btn-success btn-md" id="jqxBinning_ConfirmSubmitButton"><?php echo "Confirm"//lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-md" id="jqxBinning_ConfirmCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>
		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){

		var msil_dispatchDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'invoice_no', type: 'string' },
			{ name: 'reached_date', type: 'string' },
			{ name: 'in_stock', type: 'number' },
			],
			url: '<?php echo site_url("admin/msil_orders_spareparts/grouped_dispatch"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	msil_dispatchDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridMsil_dispatch").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridMsil_dispatch").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridMsil_dispatch").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: msil_dispatchDataSource,
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
			container.append($('#jqxGridMsil_dispatchToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {

				var row = $("#jqxGridMsil_dispatch").jqxGrid('getrowdata', index);
				var e = '<a href="<?php echo site_url('msil_orders_spareparts/msil_dispatch_list')?>?invoice_no='+encodeURI(row.invoice_no)+'" title="List Item" target="_blank"><i class="fa fa-list"></i></a>&nbsp';
				if(row.in_stock == 0)
				{
					e += '<a href="javascript:void(0)" onclick="confirm_dispatch(\''+encodeURIComponent(String(row.invoice_no))+'\')" title="Approve"><i class="fa fa-check"></i></a>&nbsp';
				}
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("invoice_no"); ?>',datafield: 'invoice_no',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("reached_date"); ?>',datafield: 'reached_date',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridMsil_dispatch").jqxGrid('refresh');}, 500);
	});
	
	$("#jqxPopupWindowBinning_Confirm").jqxWindow({ 
		theme: theme,
		width: '30%',
		maxWidth: '30%',
		height: '30%',  
		maxHeight: '30%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowBinning_Confirm").on('close', function () {
	});

	$("#jqxBinning_ConfirmCancelButton").on('click', function () {
		$('#jqxPopupWindowBinning_Confirm').jqxWindow('close');
	});
	$("#jqxBinning_ConfirmSubmitButton").on('click', function () {
		save_binning_confirm();
	});
	
});
	function confirm_dispatch(invoice_no)
	{	
		$('#binning_invoice_no').val(decodeURIComponent(invoice_no));
		openPopupWindow('jqxPopupWindowBinning_Confirm', '<?php echo lang("binning_confirm")  . "&nbsp;" .  $header; ?>');
	}

	function save_binning_confirm(){
		var data = $("#form-binning_confirm").serialize();

		$('#jqxPopupWindowBinning_Confirm').block({ 
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
			url: '<?php echo site_url("admin/msil_orders_spareparts/confirm_binning"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {				
					$('#jqxPopupWindowBinning_Confirm').jqxWindow('close');
				}
				$('#jqxPopupWindowBinning_Confirm').unblock();
			}
		});
	}
</script>