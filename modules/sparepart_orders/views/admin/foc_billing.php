<div class="content-wrapper">
	<section class="content">
		<section class="content-header "><!-- connectedSortable -->
			<?php echo displayStatus(); ?>
		</section>
		
		<div class="box">
			<div class="box-header ui-sortable-handle" style="cursor: pointer;">
				<i class="fa fa-scan"></i>
				<h3 class="box-title">Barcode Scan</h3>
			</div>
			<div class="box-body">

				<div class="col-md-3">
					<input type="text" name="barcode" class="form-control" id="barcode" autofocus>

					<form id="form-scan_code">
						<div id="scan_result"></div>
						
					</form>
				</div>
				<div class="col-md-9">
					<div id="jqxGridSparepartList"></div>
				</div>

			</div>
			<div class="box-footer clearfix">
				<a href="<?php echo site_url("admin/sparepart_orders/generate_foc_bill"); ?>" class="pull-right btn btn-default" >Generate Bill <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>


	</section>
</div>
<script language="javascript" type="text/javascript">

	var barcode_array = new Array();

	function submit_quantity()
	{
		var data = $("#form-scan_code").serialize();

		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/sparepart_orders/save_foc_billing"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {
						// reset_form_sparepart_orders();
						$('#scan_result').html('');
						$('#jqxGridSparepartList').jqxGrid('updatebounddata');
						// $('#jqxPopupWindowSparepart_order').jqxWindow('close');
					}
					// $('#jqxPopupWindowSparepart_order').unblock();
				}
			});
	}

	$(function(){

		$('#barcode').keypress(function(e){
			if(e.which == 13)
			{
				var barcode = $('#barcode').val();
				if($.inArray(barcode,barcode_array) < 0){
					$.ajax({
						type: "POST",
						url: '<?php echo site_url("admin/sparepart_orders/list_foc_item_json"); ?>',
						data: {barcode:barcode},
						success: function (result) {	
							console.log(result);			
							var result = eval('('+result+')');	
							if (result.success == true) {
								// barcode_array.push(result.stocklist.name);
								var result_string = "";

								result_string += '<button type="button" class="btn btn-flat btn-sm pull-right" id="close_scannedbarcode"><i class="fa fa-minus"></i></button>';
								result_string += "Name: "+result.stocklist.name;
								result_string += "<br>Part-Code: "+result.stocklist.part_code;
								result_string += "<br>Price: "+result.stocklist.price;
								result_string += "<input type='hidden' name='quantity' value='"+result.stocklist.stock_quantity+"'>";								
								result_string += "<input type='hidden' name='stock_id' value='"+result.stocklist.id+"'>";								
								result_string += '<button type="button" class="pull-right btn btn-flat" onclick="submit_quantity()">Save <i class="fa fa-arrow-circle-right"></i></button>';

								$('#scan_result').html(result_string);

								$('#close_scannedbarcode').click(function(){
									$('#scan_result').html('');
								});

							}
							else{
								$('#scan_result').html("Item not in Order list.");

							}
						}
					});
				}
				else
				{
					$('#scan_result').html('Error: Do not scan the same item twice');

				}
			}
		});

		var sparepart_ordersDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },			
			{ name: 'order_quantity', type: 'number' },
			{ name: 'dispatched_quantity', type: 'number' },
			{ name: 'dispatched_date', type: 'string' },
			{ name: 'dispatched_date_nepali', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'price', type: 'string' },
			],
			url: '<?php echo site_url("admin/sparepart_orders/dispatch_list_foc_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	sparepart_ordersDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridSparepartList").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridSparepartList").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridSparepartList").jqxGrid({		
		width: '100%',
		height: gridHeight,
		source: sparepart_ordersDataSource,
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
		showaggregates: true,
		selectionmode: 'singlecell',
		ready: function () {
			var rowsCount = $("#jqxGridSparepartList").jqxGrid("getrows").length;
			for (var i = 0; i < rowsCount; i++) {
				var currentQuantity = $("#jqxGridSparepartList").jqxGrid('getcellvalue', i, "dispatched_quantity");
				var currentPrice = $("#jqxGridSparepartList").jqxGrid('getcellvalue', i, "price");
				var currentTotal = currentQuantity * currentPrice;
				$("#jqxGridSparepartList").jqxGrid('setcellvalue', i, "total", currentTotal.toFixed(2));
			}
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},	
		{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width:200, filterable: true,renderer: gridColumnsRenderer },		
		{ text: '<?php echo lang("price"); ?>', datafield: 'price', align:'center', cellsalign: 'right', width : 150, cellsformat: 'F2'},
		{ text: '<?php echo lang("dispatched_quantity"); ?>', datafield: 'dispatched_quantity', align:'center', cellsalign: 'right', width : 150},
		{ text: '<?php echo lang("dispatch_date"); ?>', datafield: 'dispatched_date', align:'center', cellsalign: 'right', width : 150},
		{ text: '<?php echo lang("total_amount"); ?>', editable: false, width: 150, datafield: 'total', align:'center', cellsalign: 'right', aggregates: ['sum'] },
		]
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridSparepartList").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridSparepartListFilterClear', function () { 
		$('#jqxGridSparepartList').jqxGrid('clearfilters');
	});

	


    /*$('#form-sparepart_orders').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#sparepart_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#sparepart_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#dispatched_quantity', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dispatched_quantity').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

});

</script>