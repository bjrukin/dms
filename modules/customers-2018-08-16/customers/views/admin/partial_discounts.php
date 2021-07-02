		<div id="jqxPopupWindowDiscounts">
			<div class='jqxExpander-custom-div'>
				<span class='popup_title' id="discounts_window_poptup_title"></span>
			</div>
			<div class="form_fields_area">
				<?php echo form_open('', array('id' =>'form-discount_notify', 'onsubmit' => 'return false')); ?>

				<input type = "hidden" name = "id" id = "discounts_id"/>
				<input type = "hidden" name = "customer_id" id = "discounts_customer_id" value="<?php echo $customer_info->id;?>"/>
				<input type = "hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $customer_info->vehicle_id; ?>">
				<input type = "hidden" name="variant_id" id="variant_id" value="<?php echo $customer_info->variant_id; ?>">
				<input type = "hidden" name="color_id" id="color_id" value="<?php echo $customer_info->color_id; ?>" >
				<!-- <input type="hidden" name="approved" value="1"> -->
				<div class="form-inline">
					
					<table class="form-table">
						<tr>
							<td><label for="actual_price"><?php echo lang("actual_price") ?>:</label></td>
							<td><div class="input-group"><div class="input-group-addon">Rs.</div><input type="text" name="actual_price" id="actual_price" class="form-control" readonly value="<?php echo $customer_info->price; ?>"></div>
							</td>
						</tr>
						<tr>
							<td><label for="discount_request"><?php echo lang("discount") ?>:</label></td>
							<td><div class="input-group"><div class="input-group-addon">Rs.</div><input type="number" name="discount_request" id="discount_request" class="form-control"></div></td>
						</tr>
						<!-- <tr>
							<td><label>Approval From: </label></td>
							<td><input type="text" name="approved_by" id="approved_by" class="form-control"></td>
						</tr> -->
						<!-- <tr>
							<td><label>Designation</label></td>
							<td><input type="text" name="designation" id="designation" class="form-control"></td>
						</tr> -->
						<tr>
							<th colspan="2">
								<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxDiscounts_SubmitButton"><?php echo lang('general_save'); ?></button>
								<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxDiscounts_CancelButton"><?php echo lang('general_cancel'); ?></button>
							</th>
						</tr>

					</table>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div id='jqxGridDiscountToolbar' class='grid-toolbar'>
			<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridDiscountInsert"><?php echo lang('general_create'); ?></button>
			<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDiscountFilterClear"><?php echo lang('general_clear'); ?></button>
		</div>

		<div id="jqxPOPDiscountApproval">
			<div >
				<?php echo lang('discount_approval') ?>
			</div>
			<div id="jqxGridDiscount"></div>
		</div>


		<div id="jqxWindowReducedDiscount">
			<div class='jqxExpander-custom-div'>
				<span class='popup_title' id="window_poptup_title"></span>
			</div>
			<div class="form_fields_area">
				<?php echo form_open(base_url("admin/discount_schemes/discount_operation/".DISCOUNT_REDUCED), array('id' => 'form-reduced_discount','class' => 'form-horizontal')); ?>
				<input type="hidden" name="discount_id" id="discount_id">
				<input type="hidden" name="customer_id"  value="<?php echo $customer_info->id; ?>">
				<div class="form-line">
					<label>New Discount</label>
					<input type="number" name="reduced_discount" id="reduced_discount" class="form-control">
				</div>

				<div class="form-buttons">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxReducedDiscountSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxReducedDiscountCancelButton"><?php echo lang('general_cancel'); ?></button>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>

		<div class="col-md-9">
			
			<fieldset>
				<legend><?php echo lang("discount") ?></legend>
				
					<div class="row" <?php if(! is_null($customer_info->customer_discount_amount)) echo "hidden"; ?>>
						<div class="col-md-6">

							
							<?php echo form_open('', array('id' => 'form-addDiscount')); ?>
								<div class="row">
									<div class="col-md-2"><label><?php echo lang("discount") ?>:</label></div>
									<div class="col-md-10"> <input type="text" name="discount" id="input-addDiscount" class="form-control"> </div>
								</div>
								<input type = "hidden" name = "customer_id" id = "" value="<?php echo $customer_info->id;?>"/>
								<input type = "hidden" name="vehicle_id" id="" value="<?php echo $customer_info->vehicle_id; ?>">
								<input type = "hidden" name="variant_id" id="" value="<?php echo $customer_info->variant_id; ?>">

								<div class="row">
									<div class="col-md-12">
										<button type="button" id="button-askDiscountApproval" class="btn btn-default btn-flat pull-right"><?php echo lang("general_save") ?></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				<?php //else: ?>

					<div class="row" <?php if( is_null($customer_info->customer_discount_amount)) echo "hidden"; ?>>
						<div class="col-md-3">

							<label><?php echo lang("discount") ?>: </label>
						</div>
						<div class="col-md-9">
							Rs. <?php echo moneyFormat($customer_info->customer_discount_amount); ?>
							(currently set)

							<a class="btn btn-flat" href="<?php echo base_url("admin/discount_schemes/reset_discount/".$customer_info->id."/".$customer_info->vehicle_process_id) ?>"><i class="fa fa-trash"></i></a>
							<a class="btn btn-flat" href="<?php echo base_url("admin/discount_schemes/print_discount/".$customer_info->id) ?>" title="Print" target = "_blank"><i class="fa fa-print"></i></a>
						</div>
					</div>
				<?php //endif; ?>
			</fieldset>
		</div>
		<div class="col-md-3">
			<button type="button" class="btn btn-flat btn-default" id="btn-open_requests">Open Requests</button>
		</div>


		<script language="javascript" type="text/javascript">

			

			var discounts = function() {

		/*var inchargeDataSource = {
			url : '<?php echo site_url("admin/customers/get_executives_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			data: {
				dealer_id : "<?php echo $customer_info->dealer_id;?>"
			},
			async: false,
			cache: true
		};

		var inchargeAdapter = new $.jqx.dataAdapter(inchargeDataSource);

		$("#incharge_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: inchargeAdapter,
			displayMember: "name",
			valueMember: "id",
		});
		*/
		var discountsDataSource =
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

			{ name: 'first_name', type: 'string' },
			{ name: 'last_name', type: 'string' },
			{ name: 'gender', type: 'string' },
			{ name: 'age', type: 'number' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'color_id', type: 'number' },
			{ name: 'color_name', type: 'string' },
			{ name: 'customer_id', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'incharge_id', type: 'number' },
			{ name: 'actual_price', type: 'number' },
			{ name: 'discount_request', type: 'number' },
			{ name: 'reduced_discount', type: 'string' },
			{ name: 'remarks', type: 'string' },

			{ name: 'approval', type: 'number' },
			{ name: 'approved_by', type: 'number' },			
			{ name: 'approved_date', type: 'date' },			
			],
			url: '<?php echo site_url("admin/customers/discount_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			data: {
				customer_id: '<?php echo $customer_info->id;; ?>'
			},
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	discountsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDiscount").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDiscount").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDiscount").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: discountsDataSource,
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
			container.append($('#jqxGridDiscountToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:95, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {
				var p = '';
				p += '<a href="' + base_url + 'admin/discount_schemes/discount_operation/<?php echo DISCOUNT_APPROVED; ?>/' + columnproperties.id + '"><i class="fa fa-fw fa-check"></i></a>&nbsp';
				p += '<a href="' + base_url + 'admin/discount_schemes/discount_operation/<?php echo DISCOUNT_REJECTED; ?>/' + columnproperties.id + '"><i class="fa fa-fw fa-times"></i></a>&nbsp';
				p += '<a href="#jqxGridDiscount" onclick="discount_reduce_window(' +index+ ', '+ columnproperties.id +')"><i class="fa fa-fw fa-chevron-circle-down"></i></a>&nbsp';
				p += '<a href="' + base_url + 'admin/discount_schemes/discount_operation/<?php echo DISCOUNT_FORWARD; ?>/' + columnproperties.id + '"><i class="fa fa-fw fa-arrow-right"></i></a>&nbsp';
				// p += '<a href="' + base_url + 'admin/customers/discount_operation/5/' + columnproperties.id + '"><i class="fa fa-fw fa-trash"></i></a>&nbsp';
				if(columnproperties.approval == 1)
				{
					return "<i class='fa fa-check'></i>";
				}
				if(columnproperties.approval == 2)
				{
					return "<i class='fa fa-times'></i>";
				}
				if(columnproperties.approval == 3)
				{
					return "<i class='fa fa-angle-double-down'></i><i class='fa fa-check'></i>";
				}

				<?php if(is_sales_executive()){ ?>
					return '<div style="text-align: center; margin-top: 8px;">Pending</div>';
					<?php } ?>

					return '<div style="text-align: center; margin-top: 8px;">' + p + '</div>';

				}
			},
			// { text: '<?php echo lang("first_name"); ?>',datafield: 'first_name',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			// { text: '<?php echo lang("gender"); ?>',datafield: 'gender',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("age"); ?>',datafield: 'age',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("actual_price"); ?>',datafield: 'actual_price',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("discount_request"); ?>',datafield: 'discount_request',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("reduced_discount"); ?>',datafield: 'reduced_discount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDiscount").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDiscountFilterClear', function () { 
		$('#jqxGridDiscount').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDiscountInsert', function () { 
		$('#discounts_window_poptup_title').html('<?php echo lang("general_add")  . "&nbsp;" .  lang("discounts"); ?>');
        // $("#").jqxComboBox('val', '<?php echo $customer_info->vehicle_id;?>');
     	// $("#").jqxComboBox('val', '<?php echo $customer_info->variant_id;?>');
     	// $("#").jqxComboBox('val', '<?php echo $customer_info->executive_id;?>');

     	openPopupWindow('jqxPopupWindowDiscounts', 'N/A');
     });

    	// initialize the popup window
    	$("#jqxPopupWindowDiscounts").jqxWindow({ 
    		theme: theme,
    		width: 800,
    		maxWidth: 800,
    		height: 340,  
    		maxHeight: 340,  
    		isModal: true, 
    		autoOpen: false,
    		modalOpacity: 0.7,
    		showCollapseButton: false 
    	});
    	$("#jqxPOPDiscountApproval").jqxWindow({ 
    		theme: theme,
    		width: '80%',
    		maxWidth: '95%',
    		height: '70%',  
    		maxHeight: '95%',  
    		isModal: true, 
    		autoOpen: false,
    		modalOpacity: 0.7,
    		showCollapseButton: false 
    	});

    	$("#jqxPopupWindowDiscounts").on('close', function () {
    		// reset_form_customer_test_drives();
    	});

    	$("#jqxDiscounts_CancelButton").on('click', function () {
    		// reset_form_customer_test_drives();
    		$('#jqxPopupWindowDiscounts').jqxWindow('close');
    	});
    };


    $(function(){
    	$('#btn-open_requests').click(function(){
    		openPopupWindow('jqxPOPDiscountApproval', '<?php echo lang("discounts") ; ?>');
    	});

    	$('#form-addDiscount').jqxValidator({
    		hintType: 'label',
    		animationDuration: 500,
    		rules: [
    		{ 
    			input: '#input-addDiscount', message: 'Required', action: 'keyup', 
    			rule: function(input) { 
    				val = $('#input-addDiscount').val(); 
    				return (val == '' || val == null || val == 0) ? false: true; 
    			}
    		},
    		]
    	});

    	$("#button-askDiscountApproval").on('click', function () {
    		var validationResult = function (isValid) {
    			if (isValid) {
    				addDiscount();
    			}
    		};
    		$('#form-addDiscount').jqxValidator('validate', validationResult);
    	});

    	function addDiscount() {
    		var data = $("#form-addDiscount").serialize();
    		
    		$.ajax({
    			type: "POST",
    			url: '<?php echo site_url("admin/discount_schemes/set_discount"); ?>',
    			data: data,
    			success: function (result) {
    				var result = eval('('+result+')');
    				
    				if (result.success) {
    					location.reload();
    					// $('#jqxGridDiscount').jqxGrid('updatebounddata');
    					// $('#jqxPopupWindowDiscounts').jqxWindow('close');
    				}
    				else {
    					openPopupWindow('jqxPOPDiscountApproval', '<?php echo lang("discount_approval") ; ?>');

    				}
    				alert(result.msg);
    			}
    		});

    	}


    	$('#form-discount_notify').jqxValidator({
    		hintType: 'label',
    		animationDuration: 500,
    		rules: [
    		{ input: '#actual_price', message: 'No Price Allocated', action: 'blur', 
    		rule: function(input) {
    			var val2 = $('#actual_price').val();
    			return (val2 == '' || val2 == null || val2 == 0) ? false: true;
    		}},
    		{ input: '#discount_request', message: 'Required', action: 'blur', 
    		rule: function(input) {
    			var val = $('#discount_request').val();
    			return (val == '' || val == null || val == 0 ) ? false: true;
    		}},
    		{ input: '#discount_request', message: 'Value must not exceed actual amount.', action: 'blur', 
    		rule: function(input) {
    			var val = $('#discount_request').val();
    			var val2 = $('#actual_price').val();
    			return (parseInt(val) >= parseInt(val2)) ? false: true;
    		}},
    		/*{ input: '#approved_by', message: 'Required', action: 'blur', 
    		rule: function(input) {
    			val = $('#approved_by').val();
    			return (val == '' || val == null || val == 0) ? false: true;
    		}},*/
    		/*{ input: '#designation', message: 'Required', action: 'blur', 
    		rule: function(input) {
    			val = $('#designation').val();
    			return (val == '' || val == null || val == 0) ? false: true;
    		}},*/
    		]
    	});
    	

    	$("#jqxDiscounts_SubmitButton").on('click', function () {

    		var validationResult = function (isValid) {
    			if (isValid) {
    				saveDiscount_request();
    			}
    		};
    		$('#form-discount_notify').jqxValidator('validate', validationResult);

    	});

    	

    	$("#jqxWindowReducedDiscount").jqxWindow({
    		theme: theme,
    		width: 500,
    		maxWidth: 500,
    		height: 200,
    		maxHeight: 200,
    		isModal: true,
    		autoOpen: false,
    		modalOpacity: 0.7,
    		showCollapseButton: false
    	});
    });

    /*function saveReduced_Discount_request(){
    	var data = $("#form-reduced_discount").serialize();

    	$('#jqxWindowReducedDiscount').block({ 
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

    	$('#form-reduced_discount').submit();
    	$('#jqxWindowReducedDiscount').unblock();

    	$.ajax({
    		type: "POST",
    		url: '<?php echo site_url("admin/customers/save_discounts_request"); ?>',
    		data: data,
    		success: function (result) {
    			var result = eval('('+result+')');
    			if (result.success) {
    				// reset_form_customer_test_drives();
    				$('#jqxGridDiscount').jqxGrid('updatebounddata');
    				$('#jqxWindowReducedDiscount').jqxWindow('close');
    			}
    			$('#jqxWindowReducedDiscount').unblock();
    		}
    	});
    }  */  

    function saveDiscount_request(){
    	var data = $("#form-discount_notify").serialize();

    	$('#jqxPopupWindowDiscounts').block({ 
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
    		url: '<?php echo site_url("admin/discount_schemes/save_discounts_request"); ?>',
    		data: data,
    		success: function (result) {
    			var result = eval('('+result+')');
    			if (result.success) {
    				// reset_form_customer_test_drives();
    				$('#jqxGridDiscount').jqxGrid('updatebounddata');
    				$('#jqxPopupWindowDiscounts').jqxWindow('close');
    			}
    			$('#jqxPopupWindowDiscounts').unblock();
    		}
    	});
    }

    function discount_reduce_window(index, id)
    {
    	$('#discount_id').val(id);
    	openPopupWindow('jqxWindowReducedDiscount', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }

</script>