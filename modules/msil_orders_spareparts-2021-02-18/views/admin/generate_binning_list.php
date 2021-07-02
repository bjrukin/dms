<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('msil_dispatch'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_dispatch'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="">
			<!-- <div class="">				 -->
				<div class="col-md-12">
					<fieldset>
						<legend>Bining Details</legend>
						<div id="order-form">
							<input type="hidden" name="invoice"  id="invoice" value="<?php echo $invoice_no;?>">
							<div class="row">
								<div class="col-md-2"><label>Scan Person Name:</label></div>
								<div class="col-md-4"><input type="text" class="form-control" name = "scanner_name" id="scanner_name"></div>
							</div>
						
							<div class="row">
								<div class="col-md-2"><label>Barcode Scan</label></div>
								<div class="col-md-4"><input type="text" class="form-control" name = "barcode_partcode" id="scan_barcode" ></div>
								<div class="col-md-2"><label>Location Scan:</label></div>
								<div class="col-md-2"><input type="text" class="form-control" name="scan_location" id="scan_location" onchange= "get_list()"></div>
							</div>
						</div>
					</fieldset>
				</div>
			<!-- </div> -->
			<section>				
				<div class="col-md-12">
					<div id="jqxGridPiList"></div>
				</div>
				<div class="clearfix"></div>
				<div class="box-footer clearfix">
					<fieldset>
						<div id="order-bill">
						
						
					 	<button type="submit" class="btn btn-md btn-flat btn-success" id="generate_binning">Generate Binning</button> 
							<div id="print_binning"></div>
						</div>
					</fieldset>
				</div>
			</section>
		</div>
	</section>
</div><!-- /.content-wrapper -->

<script type="text/javascript">


	$(function(){
	
		$("#jqxGridPiList").jqxGrid({
			theme: theme,
	        width: '100%',
	        height: '1000px',
	        altrows: true,
	      
	        sortable: true,
	        rowsheight: 30,
	        columnsheight: 30,
	        showfilterrow: true,
	        filterable: true,
	        columnsresize: true,
	        autoshowfiltericon: true,
	        columnsreorder: true,
	        selectionmode: 'singlecell',
	        
	        enableanimations: false,
	        pagesizeoptions: ['10','20','50','100','500'],
	        pagesize: 20,
	  
	        editable: true,
				
		
			showAggregates: true,
        	showstatusbar: true,
			// selectionmode: 'singlecell',
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false,editable:false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, editable:false,align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
					var rows = $("#jqxGridPiList").jqxGrid('getrowdata', index);
					var e = '';
					// e += '<a href="javascript:void(0)" onclick="order_delete(' + index + '); return false;" title="Delete Item"><i class="fa fa-trash" aria-hidden="true"></i>';				
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			{ text: 'Partname',datafield: 'part_name',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			{ text: 'Quantity',datafield: 'quantity',width: 200,filterable: false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			
			{ text: 'Location',datafield: 'location',width: 200,filterable: false,editable:false, align: 'center' , cellsalign: 'left',renderer: gridColumnsRenderer },
			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		$("[data-toggle='offcanvas']").click(function(e) {
			e.preventDefault();
			setTimeout(function() {$("#jqxGridPiList").jqxGrid('refresh');}, 500);
		});

		$(document).on('click','#jqxGridPiListFilterClear', function () { 
			$('#jqxGridPiList').jqxGrid('clearfilters');
		});
	});

	$('#scan_barcode').bind('keypress', function(e) {
	    if(e.keyCode==13){
	   		
	   		get_list();
	     	$('#scan_location').focus();

	    }
	});

	$('#scan_location').bind('keypress', function(e) {
	    if(e.keyCode==13){
	  
	     	$('#scan_barcode').focus();

	    }
	});

	function get_list()
	{
		var code = $('#scan_barcode').val();
    	var location = $('#scan_location').val();
    	var invoice = $('#invoice').val();
    	var scanner_name = $('#scanner_name').val();
    	if(code == ''){
    		alert('Please enter the barcode');
    	}
    	else if(scanner_name == '')
    	{
    		alert('Please enter the Scan person Name');
    	}else{
    		$.post('<?php echo site_url('admin/msil_orders_spareparts/get_scanned_values'); ?>',{code:code,scanner_name:scanner_name,location:location,'invoice':invoice},function(result){
    				var result = eval('('+result+')');
					if (result.success == true) 
					{
						$("#jqxGridPiList").jqxGrid('clear');


						var dispatch_ListDataSource =
						{
							datatype: "json",
							datafields: [
							{ name: 'id', type: 'number' },
							{ name: 'part_name', type: 'string' },
							{ name: 'part_code', type: 'string' },
							{ name: 'location', type: 'string' },
							{ name: 'quantity', type: 'number' },
							
							],
							url: '<?php echo site_url("admin/msil_orders_spareparts/get_scanned_order_list"); ?>',
							// pagesize: defaultPageSize,
							data : {'invoice_no':result.invoice_no},
							root: 'rows',
							id : 'id',
							cache: true					
						};

						var picklistData_Adapter = new $.jqx.dataAdapter(dispatch_ListDataSource);

						$('#jqxGridPiList').jqxGrid({source: picklistData_Adapter});
						$('#scan_barcode').val('');
						$('#scan_location').val('');
					}else{
						alert(result.msg);
					}
				});
    	}
    		
    // 			$.post('<?php echo site_url('admin/msil_orders_spareparts/get_scanned_values'); ?>',{code:code,scanner_name:scanner_name,location:location,'invoice':invoice},function(result){
    // 				var result = eval('('+result+')');
				// 	if (result.success == true) 
				// 	{
				// 		$("#jqxGridPiList").jqxGrid('clear');


				// 		var dispatch_ListDataSource =
				// 		{
				// 			datatype: "json",
				// 			datafields: [
				// 			{ name: 'id', type: 'number' },
				// 			{ name: 'part_name', type: 'string' },
				// 			{ name: 'part_code', type: 'string' },
				// 			{ name: 'location', type: 'string' },
				// 			{ name: 'quantity', type: 'number' },
							
				// 			],
				// 			url: '<?php echo site_url("admin/msil_orders_spareparts/get_scanned_order_list"); ?>',
				// 			// pagesize: defaultPageSize,
				// 			data : {'invoice_no':result.invoice_no},
				// 			root: 'rows',
				// 			id : 'id',
				// 			cache: true					
				// 		};

				// 		var picklistData_Adapter = new $.jqx.dataAdapter(dispatch_ListDataSource);

				// 		$('#jqxGridPiList').jqxGrid({source: picklistData_Adapter});
				// 		$('#scan_barcode').val('');
				// 		$('#scan_location').val('');
				// 	}
				// });
    		// }

    		
			
		// }else{
		// 	alert('Please enter the barcode');
		// }
					
	}

	$('#jqxGridPiList').on('cellvaluechanged', function (event) {
			var rowBoundIndex = event.args.rowindex;
			var rowdata = $('#jqxGridPiList').jqxGrid('getrowdata', rowBoundIndex);
			
			$.post('<?php echo site_url('admin/msil_orders_spareparts/update_scanned_quantity') ?>',{id : rowdata.id, quantity:rowdata.quantity},function(result)
			{
				if(result.success)
				{
					// alert('Successfully Updated');
				}else{
					alert(result.msg);
					$("#jqxGridPiList").jqxGrid('setcellvalue', rowBoundIndex, "quantity", "1");
				}

			},'json');

		});

	$('#generate_binning').on('click',function(){

		$('#generate_binning').prop('disabled', true);
		var data = $('#jqxGridPiList').jqxGrid('getrows');
		
		var invoice = $('#invoice').val();

		$('#jqxGridPiList').block({ 
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
			url: '<?php echo site_url("msil_orders_spareparts/generate_binning_list"); ?>',
			data: {data : data,invoice:invoice},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
					// $('#jqxGridPiList').jqxGrid('updatebounddata');
					$("#jqxGridPiList").jqxGrid('clear');
					$('#generate_binning').hide();
					$('#print_binning').html('<a href="<?php echo site_url('msil_orders_spareparts/print_binning');?>/'+invoice+'" target="_blank" class="btn btn-md btn-flat btn-primary">Print Bining</a>');
				}else{
					$('#generate_binning').prop('disabled', false);
					alert(result.msg);
				}
				$('#jqxGridPiList').unblock();
			}
		});
	});
</script>