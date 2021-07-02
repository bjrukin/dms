<style>
	

.rtable {
  display: inline-block;
  vertical-align: top;
  max-width: 100%;
  overflow-x: auto;
  white-space: nowrap;
  border-collapse: collapse;
  border-spacing: 0;
}

.rtable,
.rtable--flip tbody {
  -webkit-overflow-scrolling: touch;
  background: -webkit-radial-gradient(left ellipse, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 75%) 0 center, -webkit-radial-gradient(right ellipse, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 75%) 100% center;
  background: radial-gradient(ellipse at left, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 75%) 0 center, radial-gradient(ellipse at right, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 75%) 100% center;
  background-size: 10px 100%, 10px 100%;
  background-attachment: scroll, scroll;
  background-repeat: no-repeat;
}

.rtable td:first-child,
.rtable--flip tbody tr:first-child {
  background-image: -webkit-linear-gradient(left, white 50%, rgba(255, 255, 255, 0) 100%);
  background-image: linear-gradient(to right, white 50%, rgba(255, 255, 255, 0) 100%);
  background-repeat: no-repeat;
  background-size: 20px 100%;
}

.rtable td:last-child,
.rtable--flip tbody tr:last-child {
  background-image: -webkit-linear-gradient(right, white 50%, rgba(255, 255, 255, 0) 100%);
  background-image: linear-gradient(to left, white 50%, rgba(255, 255, 255, 0) 100%);
  background-repeat: no-repeat;
  background-position: 100% 0;
  background-size: 20px 100%;
}

.rtable th {
  font-size: 11px;
  text-align: left;
  text-transform: uppercase;
  background: #f2f0e6;
}

.rtable th,
.rtable td {
  padding: 6px 12px;
  border: 1px solid #d9d7ce;
}

.rtable--flip {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  overflow: hidden;
  background: none;
}

.rtable--flip thead {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-shrink: 0;
      -ms-flex-negative: 0;
          flex-shrink: 0;
  min-width: -webkit-min-content;
  min-width: -moz-min-content;
  min-width: min-content;
}

.rtable--flip tbody {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  position: relative;
  overflow-x: auto;
  overflow-y: hidden;
}

.rtable--flip tr {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column;
  min-width: -webkit-min-content;
  min-width: -moz-min-content;
  min-width: min-content;
  -webkit-flex-shrink: 0;
      -ms-flex-negative: 0;
          flex-shrink: 0;
}

.rtable--flip td,
.rtable--flip th {
  display: block;
}

.rtable--flip td {
  background-image: none !important;
  border-left: 0;
}

.rtable--flip th:not(:last-child),
.rtable--flip td:not(:last-child) {
  border-bottom: 0;
}



table {
  margin-bottom: 30px;
}


</style>
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
								<div class="col-md-4">Choose File to Upload:</div>	
								<div class="col-md-8"><input type="file" name="userfile"></div>
							</label>
						</div>
						<div class="col-md-4">
							<div class="col-md-3"><label>Invoice Date:</label></div>	
							<div class="col-md-9"><div id="invoice_date" class="date_picker" name="invoice_date"></div></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="col-md-4"><label>Received Date:</label></div>	
							<div class="col-md-8"><div id="received_date" class="date_picker" name="received_date"></div></div>
						</div>
						<div class="col-md-1"><button class="btn btn-md btn-flat btn-success">Read</button></div>
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
			<tbody>
				
				<tr>

					<th colspan="4" style="text-align: center !important;">
						<h3>Are You Sure You Want to Confirm?</h3>
						<br/> <br/>
						<div id="jqxconfirm_binning"></div>
					</th>
				</tr>
				
			</tbody>
		
		</table>

		<div>
			
			<button type="button" class="btn btn-success btn-md" id="jqxBinning_ConfirmSubmitButton"><?php echo "Confirm" ?></button>
			<button type="button" class="btn btn-default btn-md" id="jqxBinning_ConfirmCancelButton"><?php echo lang('general_cancel'); ?></button>
		</div>
		<?php echo form_close(); ?>
	</div>

	
</div>

<div id="jqxPopupWindowBinning_list">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title'><?php echo lang('binning_list');?></span>
	</div>
	<div class="form_fields_area">
		<div id="jqxGridBinningList"></div>
		<button type="button" class="btn btn-default btn-md" id="jqxBinning_listCancelButton"><?php echo lang('general_cancel'); ?></button>
	</div>
	
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		$(".date_picker").jqxDateTimeInput({ width: 200, height: 25, showFooter: true,formatString: "yyyy-MM-dd" });
		var msil_dispatchDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'invoice_no', type: 'string' },
			{ name: 'reached_date', type: 'date' },
			{ name: 'msil_invoice_date', type: 'date' },
			{ name: 'in_stock', type: 'number' },
			{ name: 'binning_status', type: 'number' },
			{ name: 'items', type: 'array' },

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
				if(row.in_stock == 0  && row.binning_status == 1)
				{
					// e += '<a href="javascript:void(0)" onclick="confirm_dispatch(\''+encodeURIComponent(String(row.invoice_no))+'\')" title="Approve"><i class="fa fa-check"></i></a>&nbsp';
					e += '<a href="javascript:void(0)" onclick="confirm_dispatch('+index+')" title="Approve"><i class="fa fa-check"></i></a>&nbsp';
				}

				if(row.binning_status == 1)
				{

					e += '<a href="javascript:void(0)" onclick="generate_binning_list('+index+')" title="Binning List"><i class="fa fa-bars" aria-hidden="true"></i></a>&nbsp';
				}
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("invoice_no"); ?>',datafield: 'invoice_no',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("reached_date"); ?>',datafield: 'reached_date',width: 120,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("invoice_date"); ?>',datafield: 'msil_invoice_date',width: 120,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},

		{ text: 'Binning Status',datafield: 'binning_status',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' , cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {

				var row = $("#jqxGridMsil_dispatch").jqxGrid('getrowdata', index);
				if(row.binning_status == '1')
				{
					return 'Binning Generated';
				}
				else{
					return 'Not Generated';
				}
			},
		}

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
		width: '60%',
		maxWidth: '60%',
		height: '50%',  
		maxHeight: '50%',  
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



	$("#jqxPopupWindowBinning_list").jqxWindow({ 
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

	$("#jqxPopupWindowBinning_list").on('close', function () {
	});

	$("#jqxBinning_listCancelButton").on('click', function () {
		$('#jqxPopupWindowBinning_list').jqxWindow('close');
	});
	$("#jqxBinning_ConfirmSubmitButton").on('click', function () {
		save_binning_confirm();
	});
	
});
function confirm_dispatch(index)
{	
	$('#jqxconfirm_binning').empty();

	var row = $("#jqxGridMsil_dispatch").jqxGrid('getrowdata', index);
	var html = '';
	html += "<table class='table table-hove  rtable'>";
	html += "<thead><tr><th>SN</th>";
	html += "<th>Partcode</th>"; 
	html += "<th>Invoice quantity</th>"; 
	html += "<th>Binning quantity</th>"; 
	html += "<th>Box quantity</th>"; 
	html += "<th>Old Location</th>";
	html += "<th>Scan Location</th></tr></thead><tbody>";
	var i = 0;

	 $.each(row.items, function(k,v){
	 	 i += 1;
	 
	 	
	 	html += "<tr>"+
	 			"<td>"+i+"</td>"+
	 			"<td>"+v.part_code+"</td>"+
	 			"<td>"+v.total_invoice_quantity+"</td>"+
				"<td>"+v.binning_quantity+"</td>"+
				"<td>"+v.box_quantity+"</td>"+
	 			"<td>"+v.location+"</td>"+
				
				"<td>"+v.binning_location+"</td>"+
	 		
	 			"</tr>";
	 });
	html += "</tbody></table>";
	
	 	
	$('#jqxconfirm_binning').append(html);

	// $('#binning_invoice_no').val(decodeURIComponent(invoice_no));
	$('#binning_invoice_no').val(row.invoice_no);
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

<script type="text/javascript">
	
	function generate_binning_list(index)
	{

		var row = $("#jqxGridMsil_dispatch").jqxGrid('getrowdata', index);
		var BinningListSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'invoice_no', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'part_name', type: 'string' },
			{ name: 'quantity', type: 'string' },
			{ name: 'binning_quantity', type: 'string' },
			{ name: 'location', type: 'string' },
			{ name: 'binning_location', type: 'string' },
			{ name: 'scanner_name', type: 'string' },
			{ name: 'device_name', type: 'string' },
			

			],
			url: '<?php echo site_url("admin/msil_orders_spareparts/get_binned_list"); ?>',
			pagesize: defaultPageSize,
			data : {'invoice_no':row.invoice_no},
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	BinningListSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridBinningList").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridBinningList").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};

	var dataAdapter = new $.jqx.dataAdapter(BinningListSource);
	
	$("#jqxGridBinningList").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dataAdapter,
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
			container.append($('#jqxGridBinningListToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},

		{ text: '<?php echo lang("invoice_no"); ?>',datafield: 'invoice_no',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo  "Invoice quantity"; ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo  "Binning quantity"; ?>',datafield: 'binning_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("location"); ?>',datafield: 'location',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo "Binning Location"; ?>',datafield: 'binning_location',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo lang("scanner_name"); ?>',datafield: 'scanner_name',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		{ text: '<?php echo "Device Name"; ?>',datafield: 'device_name',width: 150,filterable: true,renderer: gridColumnsRenderer, align:'center', cellsalign:'center' },
		
		

		

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	openPopupWindow('jqxPopupWindowBinning_list', '<?php echo lang("binning_list")  . "&nbsp;" .  $header; ?>');

	}
</script>