<div id="WindowDeleteOutsidework2">
	<div> <?php echo lang('delete_a_row') ?> </div>
	<div>
		<p><?php echo lang("delete_a_row_confirm") ?></p>
		<button id="partialEstimate_job_del"> <?php echo lang("general_yes") ?></button>
		<button id="partialEstimate_job_cancel"> <?php echo lang("general_no") ?></button>
	</div>
</div>


<!-- ################ ESTIMATE MODEL ################ -->
<div id="jqxWindowPartEstimate">
	<div> <?php echo lang("estimate"); ?> </div>
	<div class="row">
		<div class="col-md-12">
			<form id="form-estimate_details">
				
				<div class="row">
					<div class="col-md-1"> Doc No. </div>
					<div class="col-md-2">
						<div class="input-group">
							<input type="text" name="doc_no" id="partial-estimate_doc" class="form-control" value="">
							<div class="input-group-addon"><i class="fa fa-search" id="partial-btnestimate_doc" onclick=""></i></div>
						</div>
						<input type="hidden" name="doc_id" id="partial-doc_id_hidden">
					</div>
					<div class="col-md-1"> Job Card No. </div>
					<div class="col-md-2"> <input type="text" name="jobcard_group" id="partial-jobcard_group" class="form-control"> </div>
					<div><button type="button" class="btn btn-flat btn-default" onclick="reset_form_partialestimate()">Reset</button></div>
				</div>
				<div class="row">
					<div class="col-md-10">

						<fieldset id="fieldset-vehicle_details">
							<legend><?php echo lang("vehicle_details") ?></legend>
							<div class="row">
								<div class="col-md-2"> <?php echo lang("vehicle_register_no") ?>: </div>
								<div class="col-md-4"> <input id="partial_vehicle_register" name="vehicle_register_no" class="form-control input-sm "> </div>
							</div>
							<div class="row">
								<div class="col-md-2"><?php echo lang("chassis_no") ?></div>
								<div class="col-md-4"><input type="text" name="chassis_no" class="form-control input-sm part_vehicle_no"></div>
								<!-- <div class="col-md-8 part_vehicle_no" name="chass_no"></div> -->
								<div class="col-md-2"><?php echo lang("engine_no") ?></div>
								<div class="col-md-4"><input type="text" name="engine_no" class="form-control input-sm part_vehicle_no"></div>
								<!-- <div class="col-md-8 part_vehicle_no" name="engine_no"></div> -->
							</div>
							<div class="row">
								<div class="col-md-2"><?php echo lang("vehicle_name") ?></div>
								<div class="col-md-4"><div type="text" name="vehicle_id" class="form-control input-sm part_vehicle_no" id="model_combo"></div></div>
							</div>
							<div class="row">
								<div class="col-md-2"><?php echo lang("variant_name") ?></div>
								<div class="col-md-4"><div type="text" name="variant_id" class="form-control input-sm part_vehicle_no" id="variant_combo"></div></div>
								<!-- </div> -->
								<!-- <div class="row"> -->
									<div class="col-md-2"><?php echo lang("color_name") ?></div>
									<div class="col-md-4"><div type="text" name="color_id" class="form-control input-sm part_vehicle_no" id="color_combo"></div></div>
								</div>
								<div class="row">
									<!-- <div class="col-md-8 part_vehicle_no" name="color_name"></div> -->
								</div>
							</fieldset>
						</div>
						<div class="col-md-2">
							<fieldset>
								<div id='jqxcheckbox-partial_estimate_insurance'> Insurance</div>
							</fieldset>
							<fieldset>
								<legend>Party From:</legend>
								<div id='jqxradiobutton-partial_estimate_party2'> None</div>
								<div id='jqxradiobutton-partial_estimate_party1'> Ledger</div>
							</fieldset>


						</div>
					</div>
				</form>
				<!-- INSURANCE SECTION -->
				<div class="row" id="partial_estimate_insurance" hidden>
					<div class="col-md-12">
						<form id="form-partial_estimate_insurance" onsubmit="return false;">
							<fieldset>
								<legend><?php echo lang("insurance_details") ?></legend>
								<div class="row form-group">
									<div class="col-md-1"><?php echo lang("insurance_company") ?></div>
									<div class="col-md-3"><input type="text" name="insurance-companyname" class="form-control"></div>
									<div class="col-md-1"><?php echo lang("policy_no") ?></div>
									<div class="col-md-3"><input type="text" name="insurance-policy_no" class="form-control"></div>
									<div class="col-md-1"><?php echo lang("valid_upto") ?></div>
									<div class="col-md-3"><div name="insurance-company_validupto" class="datetimeinput"></div></div>
								</div>
								<div class="row form-group">
									<div class="col-md-1"><?php echo lang("driver_name") ?></div>
									<div class="col-md-3"><input type="text" name="insurance-drivername" class="form-control"></div>
									<div class="col-md-1"><?php echo lang("driver_license_no") ?></div>
									<div class="col-md-3"><input type="text" name="insurance-license_no" class="form-control"></div>
									<div class="col-md-1"><?php echo lang("valid_upto") ?></div>
									<div class="col-md-3"><div name="insurance-driver_validupto" class="datetimeinput"></div></div>
								</div>
								<div class="row form-group">
									<div class="col-md-1"><?php echo lang("surveyor_name") ?></div>
									<div class="col-md-3"><input type="text" name="insurance-surveyorname" class="form-control"></div>
									<div class="col-md-1"><?php echo lang("date_of_accident") ?></div>
									<div class="col-md-3"><div name="insurance-accident_date" class="datetimeinput"></div></div>
								</div>
								<div class="row form-group">
									<div class="col-md-2"><?php echo lang("claim_summary") ?></div>
									<div class="col-md-10"><input type="text" name="insurance-claim_summary" class="form-control"></div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<!-- INSURANCE SECTION ENDS -->


				<!-- partial_estimate_ledger  -->
				<div class="row" id="partial_estimate_ledger" hidden>
					<div class="col-md-12">
						<form id="form-partial_estimate_ledger" onsubmit="return false;">
							<fieldset>
								<legend><?php echo lang("ledger") ?></legend>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2"><?php echo lang('name') ?></div>
											<div class="col-md-10"> <div id="ledger_name" name="ledger_id" class="form-control"></div> </div>
										</div>

									</div>
								</div>

							</fieldset>
						</form>
					</div>
				</div>
				<!-- partial_estimate_ledger ends -->


				<div class="row">
					<div class="col-md-12">
						<div id="jqxgrid_partial_estimate_job" hidden></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="partial_materialJqxgrid"></div>
					</div>
				</div>
				<div class="row">
					<form id="estimate_summary">
						<div class="col-md-6">
						</div>

						<div class="col-md-6">
							<fieldset>
								<div class="row">

									<div class="col-md-offset-6 col-md-3">Parts</div>
								</div>
								<div class="row">
									<div class="col-md-6">Total</div>
									<div class="col-md-3"><input type="text" name="total_for_parts" class="form-control input-sm" readonly></div>
									<div class="col-md-3"><input type="text" name="total_for_jobs" class="form-control input-sm" readonly></div>
								</div>
								<div class="row">
									<div class="col-md-3">Cash Dis.</div> <!-- total_discount_bill_cash -->
									<div class="col-md-3">
										<div class="input-group">
											<input type="number" name="cash_discount_percent" id="" step="1" onchange="estimate_cal_cash_discount_percent()" onkeyup="" value="0" class="form-control input-sm">
											<div class="input-group-addon">%</div>
										</div>
									</div>
									<div class="col-md-offset-3 col-md-3">
										<input type="number" name="cash_discount_amt" id="" onchange="estimate_cal_cash_discount_amt()" onkeyup="//estimate_cal_cash_discount_amt" value="0" class="form-control input-sm">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">VAT.</div>
									<div class="col-md-3">
										<div class="input-group">
											<input type="number" name="vat_percent" value="13" class="form-control input-sm" onchange="estimate_cal_cash_discount_percent()" readonly>
											<div class="input-group-addon">%</div>
										</div>
									</div>
									<div class="col-md-3"><input type="text" name="vat_parts" class="form-control input-sm" readonly></div>
									<div class="col-md-3"><input type="text" name="vat_job" class="form-control input-sm" readonly></div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">Net Amount</div>
									<div class="col-md-offset-3 col-md-3"><input type="text" name="net_total" id="" class="form-control input-sm" readonly></div>
								</div>
							</fieldset>
						</div>

					</form>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">

						<div class="btn-group btn-group-sm pull-right">
							<button type="button" class="btn btn-default" onclick="printPreview('Estimate')">Print</button>
							<button id="partial_estimate_save" class="btn btn-flat btn-success"> <?php echo lang("general_save"); ?></button>
							<button id="partial_estimate_cancel" class="btn btn-default btn-flat"> <?php echo lang("general_cancel"); ?></button>
						</div>
					</div>
				</div>
			</div> <!-- col -->
		</div>
	</div>
	<!-- ################ ESTIMATE MODEL END ################ -->


	<div id="jqxPopupWindowJob2">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title_job">Add Job</span>
		</div>
		<div class="form_fields_area">
			<div class="row form-group">
				<div class="col-md-4"><label><?php echo lang('job')?></label></div>
				<div class="col-md-8"><div name="job" class="number_general" id="new_job_id2" onchange="partial_get_job_detail()"></div></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label>Description</label></div>
				<div class="col-md-6"><div id="new_job_description2"></div></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label>Price</label></div>
				<div class="col-md-6"><input type="number" id="new_job_price2"></div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<button class="btn btn-primary btn-xs btn-flat" id="partial_job_to_table">Add</button>
					<button class="btn btn-danger btn-xs btn-flat" id="partial_close_add_job"><?php echo lang('general_cancel')?></button>
				</div>
			</div>
			<input type="hidden" name="new_job_name" id="new_job_name2">
		</div>
	</div>

	<!-- for parts form -->
	<div id="jqxPopupWindowPart2">
		<div class='jqxExpander-custom-div'>
			<span class='popup_title' id="window_poptup_title_job">Add Part</span>
		</div>
		<div class="form_fields_area">
			<div class="col-md-12">
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('part_name')?></label></div>
					<div class="col-md-6"><div id="new_part_id2" onchange="partial_get_part_detail()"></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('part_code')?></label></div>
					<div class="col-md-8"><span id="new_part_code2"></span></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('price')?></label></div>
					<div class="col-md-6"><div type="number" class="number_general" id="new_part_price2" ></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('quantity')?></label></div>
					<div class="col-md-6"><div type="number" class="number_general" id="new_part_quantity2"></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('total')?></label></div>
					<div class="col-md-6"><div type="number" class="number_general" id="new_part_total2"></div></div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group btn-xs pull-right">
							<button class="btn btn-primary btn-flat" id="partial_part_to_table">Add</button>
							<button class="btn btn-default btn-flat" id="close_add_part2"><?php echo lang('general_cancel')?></button>
						</div>
					</div>
				</div>
				<input type="hidden" name="new_part_name" id="new_part_name2">
				<input type="hidden" name="new_min_price" id="new_min_price2">
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function getFormData(formId) {
			return $('#' + formId).serializeArray().reduce(function (obj, item) {
				var name = item.name,
				value = item.value;

				if (obj.hasOwnProperty(name)) {
					if (typeof obj[name] == "string") {
						obj[name] = [obj[name]];
						obj[name].push(value);
					} else {
						obj[name].push(value);
					}
				} else {
					obj[name] = value;
				}
				return obj;
			}, {});
		}

		$(function(){
		// initializations
		$("#jqxcheckbox-partial_estimate_insurance").jqxCheckBox({ width: 120, height: 34, rtl: true, boxSize: "15px"});
		$(".datetimeinput").jqxDateTimeInput({ width:'100%', height: "34px"});
		$("#jqxradiobutton-partial_estimate_party1,#jqxradiobutton-partial_estimate_party2").jqxRadioButton({ width: 120, height: 25 });

		$("#jqxcheckbox-partial_estimate_insurance").bind('change', function (event) {
			var checked = event.args.checked;
			// if(checked) {
				$('#partial_estimate_insurance').toggle();
			// }
		});


		$('#jqxradiobutton-partial_estimate_party1').on('checked', function (event) {
			$('#partial_estimate_ledger').fadeIn();
		});
		$('#jqxradiobutton-partial_estimate_party1').on('unchecked', function (event) {
			$('#partial_estimate_ledger').fadeOut();
		}); 

		$("#jqxWindowPartEstimate").jqxWindow({ 
			theme: 'dark',
			width: '80%',
			maxWidth: '80%',
			height: '90%',  
			// maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false,
			cancelButton: $('#partial_estimate_cancel')
		});

		$("#jqxPopupWindowJob2").jqxWindow({ 
			theme: 'dark',
			width: '50%',
			maxWidth: '50%',
			height: '50%',  
			maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false 
		});
		$("#jqxPopupWindowPart2").jqxWindow({ 
			theme: 'dark',
			width: '50%',
			maxWidth: '50%',
			height: '50%',  
			maxHeight: '50%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,

			showCollapseButton: false,
			cancelButton: $('#close_add_part2'),
		}); 

		/*Party Users*/
		var ledgerDataSource = {
			url : '<?php echo site_url("admin/job_cards/get_ledger_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'full_name', type: 'string' },
			{ name: 'party_name', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		ledgerDataAdapter = new $.jqx.dataAdapter(ledgerDataSource);

		$("#ledger_name").jqxComboBox({
			theme: theme,
			width: '95%',
			// height: '34px',
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: ledgerDataAdapter,
			displayMember: "party_name",
			valueMember: "id",
			placeHolder: "Enter User" 
		});



		/*Party Users ENDS*/

		/*var jobDataSource = {
			url : '<?php echo site_url("admin/workshop_jobs/get_job_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		jobAdapter = new $.jqx.dataAdapter(jobDataSource);

		$("#new_job_id2").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: jobAdapter,
			displayMember: "name",
			valueMember: "id",
		});*/


		var data = {};
		var source =
		{
			localdata: data,
			datatype: "local",
			datafields:
			[
			{ name: 'job_id', type: 'number' },
			{ name: 'job', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'status', type: 'string' },
			],
			addrow: function (rowid, rowdata, position, commit) {
				commit(true);
			},
		};
		var partial_job_dataAdapter = new $.jqx.dataAdapter(source);

		Partial_estimate_job_details = $("#jqxgrid_partial_estimate_job").jqxGrid(
		{
			
			altrows: true,
			pageable: true,
			sortable: true,
			columnsresize: true,
			autoshowfiltericon: true,
			columnsreorder: true,
			editable: true,
			selectionmode: 'singlecell',
			enableanimations: false,
			pagesizeoptions: pagesizeoptions,
			showaggregates: true,
			showstatusbar: true,
			
			width: '100%',
			height: '200px',
			source: partial_job_dataAdapter,
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				var me = this;
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append('<input id="addrowbutton2" type="button" value="Add Job" />');
				$("#addrowbutton2").jqxButton();
				$("#addrowbutton2").on('click', function () {
					openPopupWindow('jqxPopupWindowJob2', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
				});
			},
			columns: [
			{ text: 'Job ID', datafield: 'job_id', width: '5%',editable:false, },
			{ text: 'Job', datafield: 'job', width: '10%',editable:false, },
			{ text: 'Description', datafield: 'description', width: '20%',editable:false, },
			{ text: 'Price', datafield: 'price', width: '10%', cellsalign: 'right',columntype: 'numberinput',renderer: gridColumnsRenderer, editable:false, },
			{ text: 'Discount', datafield: 'discount', width: '10%', columntype: 'numberinput',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var price = parseFloat($('#jqxgrid_partial_estimate_job').jqxGrid('getcellvalue', row, "price"));
				price = price - (newvalue/100) * price;
				$("#jqxgrid_partial_estimate_job").jqxGrid('setcellvalue', row, "total_amount", price);

			} },
			{ 
				text: 'Status', datafield: 'status', width: '10%',editable:false,
			},
			{ 
				text: "Total Amount",
				datafield: 'total_amount',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				editable:false,
				aggregates: [{ '<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;
					$('#estimate_summary input[name=total_for_jobs]').val(total);

					return total;
				} }]
			},
			{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
				return "Delete row";
			}, buttonclick: function (row) {
				id = $("#jqxgrid_partial_estimate_job").jqxGrid('getrowid', row);
				var offset = $("#jqxgrid_partial_estimate_job").offset();
				$("#WindowDeleteOutsidework2").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
				$("#WindowDeleteOutsidework2").jqxWindow('show');
			}}, ]

		});

	// //////////////////////////////////////////////////////////////
	$("#WindowDeleteOutsidework2").jqxWindow({ width: 250, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.05 });
	$("#partialEstimate_job_del").jqxButton({ theme: theme });
	$("#partialEstimate_job_del").click(function () {
		$('#jqxgrid_partial_estimate_job').jqxGrid('deleterow', id);
		$("#WindowDeleteOutsidework2").jqxWindow('hide');
	});
	// $("#WindowDeleteOutsidework2").jqxWindow({ isModal: true, autoOpen: false, height: '20%' });

	$('#partial_job_to_table').click(function(){
		var job_id = $('#new_job_id2').val();
		var job_name = $('#new_job_name2').val();
		var description = $('#new_job_description2').html();
		var price = $('#new_job_price2').val();
		if(job_id != null && job_name != null && description != 0 && price != null){
			if(price == ''){
				alert('Price is required');
			}else{
				var datarow = {
					'job_id'    :job_id,
					'job'     :job_name,
					'description' :description,
					'price'     :price,
					'total_amount': price,
					'status'    :'INCOMPLETE'
				};

				Partial_estimate_job_details.jqxGrid('addrow', null, datarow);
				// $('#jqxPopupWindowJob').jqxGrid('addrow', null, datarow);

			}
		}else{
			alert('Please enter all fields');
		}
	});

    //Vehicle
    var vehicle_dataSource = {
    	url : '<?php echo site_url("admin/job_cards/get_vehicles_json"); ?>',
    	datatype: 'json',
    	datafields: [
    	{ name: 'vehicle_id', type: 'number' },
    	{ name: 'vehicle_name', type: 'string' },
    	],
    	async: false,
    	cache: true
    }

    vehicleAdapter = new $.jqx.dataAdapter(vehicle_dataSource);

    $("#model_combo").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: vehicleAdapter,
    	valueMember: "vehicle_id",
    	displayMember: "vehicle_name",
    	placeHolder: "Select Vehicle"
    });

    $("#model_combo").on('select', function (event) {
    	if (event.args) {
    		var item = event.args.item;
    		if (item) {
    			var variant_dataSource = {
    				url : '<?php echo site_url("admin/job_cards/get_variants_combo_json"); ?>',
    				data: {vehicle_id: item.value},
    				datatype: 'json',
    				datafields: [
    				{ name: 'vehicle_id', type: 'number' },
    				{ name: 'variant_id', type: 'number' },
    				{ name: 'variant_name', type: 'string' },
    				],
    				async: false,
    				cache: true
    			}

    			variantAdapter = new $.jqx.dataAdapter(variant_dataSource);

    			$("#variant_combo").jqxComboBox({
    				theme: theme,
    				width: 195,
    				height: 25,
    				selectionMode: 'dropDownList',
    				autoComplete: true,
    				searchMode: 'containsignorecase',
    				source: variantAdapter,
    				valueMember: "variant_id",
    				displayMember: "variant_name",
    				placeHolder: "Select Variant"
    			});

    		}
    	}
    });

    $("#variant_combo").on('select', function (event) {
    	if (event.args) {
    		var item = event.args.item;
			// console.log(item);
			// return;
			if (item) {
				var colors_dataSource = {
					url : '<?php echo site_url("admin/job_cards/get_colors_combo_json"); ?>',
					data: {variant_id: item.value, vehicle_id: item.originalItem.vehicle_id},
					datatype: 'json',
					datafields: [
					{ name: 'color_id', type: 'number' },
					{ name: 'color_name', type: 'string' },
					],
					async: false,
					cache: true
				}

				colorsAdapter = new $.jqx.dataAdapter(colors_dataSource);

				$("#color_combo").jqxComboBox({
					theme: theme,
					width: 195,
					height: 25,
					selectionMode: 'dropDownList',
					autoComplete: true,
					searchMode: 'containsignorecase',
					source: colorsAdapter,
					valueMember: "color_id",
					displayMember: "color_name",
					placeHolder: "Select Colour"
				});

			}
		}
	});

}); 
  // end function

  $(document).on('click','#partial_estimate', function () { 

  	// $.post('<?php echo site_url('job_cards/get_estimate_number'); ?>', function(r){
  		// $('#partial-estimate_doc').val(r).prop('readonly','readonly');
  	// }, 'json');

  	openPopupWindow('jqxWindowPartEstimate', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
  });

  function get_partial_vehicle_detail( field ) {
  	var value = $(field).val();
  	if( ! value ) {
  		return false;
  	}
  	$('#fieldset-vehicle_details').block({ 
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

  	$.post("<?php echo site_url('job_cards/vehicle_detail')?>", {field:'id', value:value}, function(row){
  		var row1 = row[0];


  		$('#jqxWindowPartEstimate').find('.part_vehicle_no').text(function(i,v){
  			return row1[$(this).attr('name')];
  		});

  		$('#fieldset-vehicle_details').unblock();

  	},'json');

  }

  function partial_get_job_detail(){
  	var id = $('#new_job_id2').val();
  	$('#new_job_description2').html('');
  	$('#new_job_price2').val('');
  	$('#new_job_name2').val('');

  	if(id){
  		$.post("<?php echo site_url('workshop_jobs/get_detail')?>",{id:id},function(data){
  			if(data != false){
  				$('#new_job_description2').html(data.description);
  				$('#new_job_price2').val(data.min_price);
  				$('#new_job_name2').val(data.name);
  			}
  		},'json');
  	}
  }
</script>








<script type="text/javascript">
	/*Parts*/
	$(function(){

		var partDataSource = {
			url : '<?php echo site_url("admin/job_cards/get_spareparts_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },

			{ name: 'price', type: 'number' },
			{ name: 'dealer_id', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'sparepart_id', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'part_name', type: 'string' },
			],
		}

		partAdapter = new $.jqx.dataAdapter(partDataSource,
		{
			formatData: function (data) {
				if ($("#new_part_id2").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#new_part_id2").jqxComboBox('searchString');
					return data;
				}
			}
		});

		$("#new_part_id2").jqxComboBox({
			width: 195,
			height: 25,
			source: partAdapter,
			remoteAutoComplete: true,
			selectedIndex: 0,
			autoDropDownHeight:true,
			displayMember: "part_name",
			valueMember: "sparepart_id",
			renderer: function (index, label, value) {
				var item = partAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = partAdapter.records[index];
				if (item != null) {
					var label = item.part_name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				partAdapter.dataBind();
			}
		});

		// calculate total
		$('#new_part_quantity2, #new_part_price2').on('keyup',function(){
			price 		= $('#new_part_price2').val();
			quantity 	= $('#new_part_quantity2').val();
			min_price 	= $('#new_min_price2').val();

			if(price >= min_price && min_price != ''){
				total_price = price * quantity
				$('#new_part_total2').jqxNumberInput('val',total_price);
			}else{
				alert('Minimum price is ' + min_price);
				$('#new_part_price2').jqxNumberInput('val',min_price);
			}

		});

		// part to table
		$('#partial_part_to_table').click(function(){
			var part_id = $('#new_part_id2').val();
			var part_name = $('#new_part_name2').val();
			var part_price = $('#new_part_price2').val();
			var part_quantity = $('#new_part_quantity2').val();
			var part_total = $('#new_part_total2').val();
			var part_code = $('#new_part_code2').html();
			if(new_part_id != null && new_part_name != null){
				if(part_quantity == 0 || part_total == 0){
					alert('Quantity is required');
				}else{
					var datarow = {
						'part_id'			:part_id,
						'part_name'		:part_name,
						'part_code'		:part_code,
						'price'			:part_price,
						'quantity'		:part_quantity,
						'total'			:part_total,
					};

					Partial_estimate_materials.jqxGrid('addrow', null, datarow);
					// $('#jqxPopupWindowPart2').jqxGrid('addrow', null, datarow);
					
					// $('#jqxPopupWindowPart').jqxWindow('close');
					// $('#jqxPopupWindowPart').unblock();
				}
			}else{
				alert('Please enter all fields');
			}
		});


		var data = {};

		var materialSource =
		{
			localdata: data,
			datatype: "local",
			datafields:
			[
			{ name: 'id', type: 'number' },
			{ name: 'part_id', type: 'number' },
			{ name: 'part_name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'total', type: 'number' },
			],
			addrow: function (rowid, rowdata, position, commit) {
				commit(true);
			}, 
		};
		var partial_materialDataAdapter = new $.jqx.dataAdapter(materialSource);
		Partial_estimate_materials = $("#partial_materialJqxgrid").jqxGrid(
		{
			width: '100%',
			height: '300px',
			pageable: true,
			columnsresize: true,
			editable: true,
			selectionmode: 'singlecell',
			enableanimations: false,
			showaggregates: true,
			showstatusbar: true,

			source: partial_materialDataAdapter,
			showtoolbar: true,
			rendertoolbar: function (toolbar) {
				var me = this;
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append('<input id="partsaddrowbutton2" type="button" value="Add Parts" />');
				$("#partsaddrowbutton2").jqxButton();
				$("#partsaddrowbutton2").on('click', function () {
					openPopupWindow('jqxPopupWindowPart2', '<?php echo lang("general_add")  . "&nbsp;" .  lang("part"); ?>');
				});
			},
			columns: [
			{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
				return "Delete row";
			}, buttonclick: function (row) {
				var row_data = Partial_estimate_materials.jqxGrid('getrowdata',row);
				/*if(row_data.status == "Complete") {
					return;
				}*/
				var row_id = Partial_estimate_materials.jqxGrid('getrowid',row);
				Partial_estimate_materials.jqxGrid('deleterow',row_id);
			} },
			{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '15%',editable: false, },
			{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', width: '30%',editable: false, },
			{ text: '<?php echo lang("price")?>', datafield: 'price', width: '10%', cellsalign: 'right', columntype: 'numberinput', editable: false, },
			{ text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%', columntype: 'numberinput', 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var price = parseFloat($('#partial_materialJqxgrid').jqxGrid('getcellvalue', row, "price"));
				var discount = parseFloat($('#partial_materialJqxgrid').jqxGrid('getcellvalue', row, "discount"));

				if(isNaN(discount))
				{
					discount = 0;
				}

				price = newvalue * price;
				price = price - (discount/100) * price;
				$("#partial_materialJqxgrid").jqxGrid('setcellvalue', row, "total", price);

			} },
			{ text: 'Discount', datafield: 'discount', width: '10%', columntype: 'numberinput', 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var price = parseFloat($('#partial_materialJqxgrid').jqxGrid('getcellvalue', row, "price"));
				var quantity = parseFloat($('#partial_materialJqxgrid').jqxGrid('getcellvalue', row, "quantity"));
				price = quantity * price;
				price = price - (newvalue/100) * price;
				$("#partial_materialJqxgrid").jqxGrid('setcellvalue', row, "total", price);

			} },
			{ 
				text: '<?php echo lang("total")?>', datafield: 'total', width: '10%', editable: false,
				aggregates: [
				{ 
					'<b>Total</b>':
					function (aggregatedValue, currentValue, column, record) {
						var total = currentValue;
						total = aggregatedValue + total; 

						$('#estimate_summary input[name=total_for_parts]').val(total);
						estimate_cal_cash_discount_percent();
						return total;
					}
				}
				]  
			},
			]
		});  

			// for saving estimate
			$('#partial_estimate_save').on('click', function(){
				$('#jqxWindowPartEstimate').block({ 
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

				/*Grid Values*/
				var estimate_job_datas = JSON.stringify(Partial_estimate_job_details.jqxGrid('getrows'));
				var estimate_part_datas = JSON.stringify(Partial_estimate_materials.jqxGrid('getrows'));

				/*Insurance Values*/
				var insurance_details = getFormData('form-partial_estimate_insurance');

				/*Details*/
				var estimate_details = getFormData('form-estimate_details'); 
				var estimate_summary = getFormData('estimate_summary');
				// var vehicle_register_no = $('#partial_vehicle_register').val();

				if( $('#jqxradiobutton-partial_estimate_party1').jqxRadioButton('val') ) {
					var party_details = getFormData('form-partial_estimate_ledger');
					var party_setting = 0;

				}

				$.ajax({
					type:       "POST",
					url:        "<?php echo site_url('admin/job_cards/partial_save_estimate')?>",
					data:       {
						jobs: estimate_job_datas,
						parts: estimate_part_datas,

						details:estimate_details,
						summary:estimate_summary,

						// vehicle_register_no: vehicle_register_no,
						insurance_details,
						party_details,
						party_setting: party_setting,
					},
					success:    function(){
						$('#jqxWindowPartEstimate').jqxWindow('close');
						$('#jqxWindowPartEstimate').unblock();

					},
				});
			});

		});
		//end function

		function partial_get_part_detail(){
			var id = $('#new_part_id2').val();

			$('#new_part_code2').html('');
			$('#new_part_price2').jqxNumberInput('val',0);
			$('#new_part_name2').val('');
			$('#new_min_price2').val(0);
			$('#new_part_total2').jqxNumberInput('val',0);
			$('#new_part_quantity2').jqxNumberInput('val',0);

			$.post("<?php echo site_url('spareparts/getDetail')?>", {id:id}, function(data){
				if(data.success){
					$('#new_part_code2').html(data.part_code);
					$('#new_part_price2').jqxNumberInput('val',data.price);
					$('#new_part_name2').val(data.name);
					$('#new_min_price2').val(data.price);
				}
			},'json');
		}

		function estimate_cal_cash_discount_percent() {
			var parts_amount = parseFloat($('#estimate_summary input[name=total_for_parts]').val());
			isNaN(parts_amount)? parts_amount = 0:'';


			var job_amount = parseFloat($('#estimate_summary input[name=total_for_jobs]').val());
			isNaN(job_amount)? job_amount = 0:'';

			var percent = parseFloat($('#estimate_summary input[name=cash_discount_percent]').val());
			isNaN(percent)? percent = 0:'';

			var vat = parseFloat($('#estimate_summary input[name=vat_percent]').val());
			isNaN(vat)? vat = 0:'';

			var net_total = parts_amount + job_amount;

			var total = parseFloat(parts_amount) + parseFloat(job_amount);
			total = total * (percent /100);

			$('#estimate_summary input[name=cash_discount_amt]').val(total);

			parts_amount = parts_amount - ((parts_amount * percent) / 100);		 /*discount cash percent*/
			var vat_parts = (parts_amount * vat ) /100; 							/*add vat*/
			job_amount = job_amount - ((job_amount * percent) / 100);			 /*discount cash percent*/
			var vat_job = (job_amount * vat ) /100; 								/*add vat*/
			$('#estimate_summary input[name=vat_parts]').val(vat_parts);
			$('#estimate_summary input[name=vat_job]').val(vat_job);

			net_total = net_total + vat_parts + vat_job - total;
			$('#estimate_summary input[name=net_total]').val(net_total);
		}

		function estimate_cal_cash_discount_amt() {
			var percent;
			var parts_amount = parseFloat($('#estimate_summary input[name=total_for_parts]').val());
			isNaN(parts_amount)? parts_amount = 0:'';

			var job_amount = parseFloat($('#estimate_summary input[name=total_for_jobs]').val());
			isNaN(job_amount)? job_amount = 0:'';

			var d_amount = parseFloat($('#estimate_summary input[name=cash_discount_amt]').val()); /*cash discount amount*/
			isNaN(d_amount)? d_amount = 0:'';

			var vat = parseFloat($('#estimate_summary input[name=vat_percent]').val());
			isNaN(vat)? vat = 0:'';

			var net_total = parts_amount + job_amount;

			var total = parseFloat(parts_amount) + parseFloat(job_amount);
			percent = ( d_amount /  total) * 100;

			$('#estimate_summary input[name=cash_discount_percent]').val(percent);

			parts_amount = parts_amount - ((parts_amount * percent) / 100);		 /*discount cash percent*/
			var vat_parts = (parts_amount * vat ) /100; 							/*add vat*/
			job_amount = job_amount - ((job_amount * percent) / 100);			 /*discount cash percent*/
			var vat_job = (job_amount * vat ) /100; 								/*add vat*/
			$('#estimate_summary input[name=vat_parts]').val(vat_parts);
			$('#estimate_summary input[name=vat_job]').val(vat_job);

			net_total = net_total + vat_parts + vat_job - d_amount;
			$('#estimate_summary input[name=net_total]').val(net_total);
		}


	</script>

	<script type="text/javascript">
		$(function(){
			$('#partial-jobcard_group').on('change',function(r){
				var jobno = $(this).val();
				get_estimate_details(jobno);
				if(!jobno){
					$("#ledger_name").jqxComboBox({ disabled: false });
					$("#jqxcheckbox-partial_estimate_insurance").jqxCheckBox({disabled: false });

					$('#jqxradiobutton-partial_estimate_party1').jqxRadioButton({disabled: false });
					$('#jqxradiobutton-partial_estimate_party2').jqxRadioButton({disabled: false });
				}
			});

			$('#partial-btnestimate_doc').on('click',function(r){
				var docno = $('#partial-estimate_doc').val();
				get_estimate_details(null,docno);

				$('#partial-estimate_doc').prop('readonly', false);
			});
		});

		function get_estimate_details(jobno, docno = null) {
			$.post('<?php echo site_url('admin/job_cards/get_estimate_details'); ?>',{jobcard_group: jobno, docno: docno},function(result){
				if(result.details == false){
					return;
				}
				$('#partial_materialJqxgrid').jqxGrid('clear');

				$('#jqxradiobutton-partial_estimate_party1').jqxRadioButton('check'); 
				$('#jqxWindowPartEstimate').find('.part_vehicle_no').val(function(i,v){
					return result.details[$(this).attr('name')];
				});
				$('#partial_vehicle_register').val(result.details.vehicle_no);
				$("#ledger_name").jqxComboBox('val',result.details.full_name);
				$("#ledger_name").jqxComboBox({ disabled: true });
				$("#jqxcheckbox-partial_estimate_insurance").jqxCheckBox('disable');

				$('#model_combo').val(result.details.vehicle_id);
				$('#variant_combo').val(result.details.variant_id);
				$('#color_combo').val(result.details.color_id);

				$('#jqxradiobutton-partial_estimate_party1').jqxRadioButton('disable');
				$('#jqxradiobutton-partial_estimate_party2').jqxRadioButton('disable');

				if(docno == null) {
					$('#partial-doc_id_hidden').val('');
				} else {
					$('#partial-doc_id_hidden').val(result.details.id);
				}

				if(result.parts) {
					$.each(result.parts, function(i,v) {
						var datarow = {
							'id'			:v.id,
							'part_id'		:v.part_id,
							'part_name'		:v.part_name,
							'part_code'		:v.part_code,
							'price'			:v.price,
							'quantity'		:v.quantity,
							'discount'		:v.discount_percentage,
							'total'			:v.final_amount,
						};

						Partial_estimate_materials.jqxGrid('addrow', null, datarow);
					});
				}

			},'JSON');
		}

		function reset_form_partialestimate(){
			$('#workshops_id').val('');
			$('#form-estimate_details')[0].reset();
			$('#partial_materialJqxgrid').jqxGrid('clear');
			$('#estimate_summary input').val('');
		}

	</script>