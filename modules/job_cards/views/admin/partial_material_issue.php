<!-- for material_issue form -->
<div id="jqxPopupWindowMaterial_issue">
	<div> <?php echo lang("material_issue") ?> </div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('', array('id' =>'form-material_issue_grid', 'onsubmit' => 'return false')); ?>
				<input type="hidden" id = "material_issue-service_type">
				<div class="row form-group">
					<div class="col-md-1">Material Issue No. </div>
					<div class="col-md-2">
						<div id="material_issue-material_issue_no_display" class="form-control" readonly></div>
						<input type="hidden" class="form-control" id="material_issue-material_issue_no" name="" readonly>
					</div>
					<div class="col-md-1">Job No.</div>
					<div class="col-md-2">
						<div id="material_issue-jobcard_group_display" class="form-control" readonly></div>
						<input type="hidden" class="form-control" id="material_issue-jobcard_group" name="jobcard_group" readonly>
					</div>
					<div class="col-md-1">Job Date</div>
					<div class="col-md-2"><input type="text" class="form-control" id="material_issue-jobcard_date" name="" readonly></div>
				</div>
				<fieldset>
					<legend>Details</legend>
					<div class="row form-group">
						<div class="col-md-1">Vehicle No.</div>
						<div class="col-md-2"><input type="text" class="form-control" id="material_issue-vehicle_no" name="" readonly></div>
						<div class="col-md-1">Chassis No.</div>
						<div class="col-md-3"><input type="text" class="form-control" id="material_issue-chassis_no" name="" readonly></div>
					</div>
					<div class="row form-group">
						<div class="col-md-1">Model</div>
						<div class="col-md-6"><input type="text" class="form-control" id="material_issue-vehicle_name" name="" readonly></div>
						<div class="col-md-1">Mechanic</div>
						<div class="col-md-4"><input class="form-control" id="material_issue-mechanic_id" name="mechanic_id" readonly></div>
					</div>
					<div class="row form-group">
						<div class="col-md-1">Party</div>
						<div class="col-md-6"><input type="text" class="form-control" id="material_issue-party_name" name="" readonly></div>
						<div class="col-md-1">Bin No.</div>
						<div class="col-md-3"><input type="text" class="form-control" name="" readonly></div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label>Barcode</label> <input type="text" id="barcode_input" autofocus>
							<div id="jqGrid_partial_material_issue" ></div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-8">
							<div style="padding: 5px;">
								<input type="button" id="gridtoolbar_add_consumables" class="btn btn-flat btn-sm btn-default" value="Add Consumables" onclick="openPopupWindow('window_add_consumables')"/>
							</div>
							<div id="jqGrid_consumables"></div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-3">Total Item</div>
						<div class="col-md-1" hidden>Narration</div>
						<div class="col-md-8" hidden><input type="text" class="form-control" id="material_issue-narration" name="narration"></div>
					</div>
				</fieldset>
				<?php echo form_close(); ?>

				<fieldset>
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class=" btn-group btn-group-sm pull-right">

								<button type="button" class="btn btn-default btn-flat job-status" value=""  >Job Status</button>
								<button type="button" class="btn btn-default btn-flat" value="" onclick="printPreview('Material Issue')"  >Print</button>
								<!-- <button type="button" class="btn btn-success btn-flat" id="material_issue-SubmitButton"><?php echo lang('general_save'); ?></button> -->
								<button type="button" class="btn btn-default btn-flat" id="material_issue-cancelButton"><?php echo ('Close'); ?></button>
							</div>
						</div>
					</div>
				</fieldset>



			</div>
		</div>
	</div>
</div>

<div id="window_add_consumables">
	<div>Add Consumable</div>
	<div>
		<div class="col-md-12">

			<form id='form-consumable'>
				<input type="hidden" name="jobcard_group">
				<?php if($dealer_id == DALLU_DEALER): ?>
					<p>Note:* (Please provide in liter if the consumable is Lube) </p>
				<?php endif; ?>
				<div class="row form-group">
					<div class="col-md-12">
						<label> Consume: </label>
						<div id="consumable_list" name="consumable"></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<label>Quantity</label>
						<input type="number" name="quantity" class="form-control" id="quantity" onchange="get_total_price('unit_consumable_price','quantity','consumable_price')">
					</div>
					<div class="col-md-6">
						<label>Rate</label>
						<input type="number" name="consumable_price" class="form-control" readonly="" id="consumable_price">
						<input type="hidden" name="" class="form-control" id="unit_consumable_price">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-primary" id="consumable-submit">Add</button>	
							<button type="button" class="btn btn-link" id="consumable-cancel">Close</button>	
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<div id="jqxPopupApproveReturnedParts">
	<div>Return Parts</div>
	<div>
		<div class="col-md-12">
			<form id="form-acceptPartsReturn">
				<input type="hidden" name="floor_id" id="acceptPartsReturn-floor_id">
				<input type="hidden" name="part_code" id="acceptPartsReturn-part_code">
				<div class="form-group">
					<div class="col-md-3"> Requested Parts to return: </div>
					<div class="col-md-9"> <input id="acceptPartsReturn-return_quantity" class="form-control" name="return_quantity" readonly> </div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="btn-group pull-right">
							<button class="btn btn-primary" type="button" id="acceptPartsReturn-submit">Accept</button>
							<button class="btn " id="acceptPartsReturn-cancel" type="button">Cancel</button>
						</div>
					</div>
				</div>

				
			</form>
		</div>
	</div>
</div>

<style type="text/css">
.bg-dispatchqty {
	background-color: #e6e6e6;
}
</style>

<script type="text/javascript">
	var warranty_dropdown;
	$(function(){
		$("#jqxPopupWindowMaterial_issue").jqxWindow({ 
			theme: theme, 
			width: innerWidth-10, 
			height: innerHeight, 
			maxWidth: outerWidth, 
			maxHeight: outerHeight, 
			resizable: false, 
			isModal: true, 
			autoOpen: false, 

			cancelButton: $("#material_issue-cancelButton"), 
			modalOpacity: 0.4 
		});

		var warranty_array = ["FOC","PAID","UW"]

		$('.partial_part_to_table').click(function(){
			var part_id = $('#new_part_id').val();
			var part_name = $('#new_part_name').val();
			var part_code = $('#new_part_code').html();
			var part_price = $('#new_part_price').val();
			var part_quantity = $('#new_part_quantity').val();
			var part_total = $('#new_part_total').val();
			if(new_part_id != null && new_part_name != null){
				if(part_quantity == 0 || part_total == 0){
					alert('Quantity is required');
				}else{
					var datarow = {
						'part_id'		:part_id,
						'part_name'		:part_name,
						'part_code'		:part_code,
						'price'			:part_price,
						'quantity'		:part_quantity,
						'total'			:part_total,
					};

					$("#jqGrid_partial_material_issue").jqxGrid('addrow', null, datarow);
					// $('#jqxPopupWindowPart').jqxGrid('addrow', null, datarow);

					// $('#jqxPopupWindowPart').jqxWindow('close');
					// $('#jqxPopupWindowPart').unblock();
				}
			}else{
				alert('Please enter all fields');
			}
		});

		$('#barcode_input').on('keyup', function(event) {
			var val = $(this).val();
			if (val.length >= 3 && event.which == 13) {
				insert_barcode(val);
				$('#barcode_input').val('');
			}
		});

		function insert_barcode( barcode, old = null,advisedpart_id = null, row = null ) {
			var jobcard_group = $('.job-status').val();

			$.post('<?php echo site_url('admin/job_cards/set_barcode'); ?>',{jobcard_group: jobcard_group, barcode: barcode, advisedpart_id: advisedpart_id,old:old},function(result){
				if(result.success == false) {
					alert(result.msg);

					if(row+1) {
						$('#jqGrid_partial_material_issue').jqxGrid('setcellvalue', row, "part_code", '');
					}
					
					return false;
				}

				/*if(result.data.updated == true) {

					var rowdata = $('#jqGrid_partial_material_issue').jqxGrid('getrows');
					$.each(rowdata, function(i,v){
						if(v.part_code == result.data.part_code) {
							$('#jqGrid_partial_material_issue').jqxGrid('setcellvalue', v.uid, "quantity", result.data.quantity);
						}
					});

				} else {
					var datarow = {
						'id'			:result.data.floorparts_advice_id,
						'part_id'		:result.data.part_id,
						'part_name'		:result.data.part_name,
						'part_code'		:result.data.part_code,
						'issue_date'	:result.data.issue_date,
						'quantity'		:result.data.quantity,
					};

					$("#jqGrid_partial_material_issue").jqxGrid('addrow', null, datarow);
				}*/

				$("#jqGrid_partial_material_issue").jqxGrid('updatebounddata');

			},'json');
		}

		$("#jqGrid_partial_material_issue").jqxGrid(
		{
			width: '100%',
			height: '500px',
			showtoolbar: true,
			editable : true,
			editmode : 'dblclick',
			autorowheight: true,
			pageable: true,
			selectionmode: 'singlecell',
			rendergridrows: function (result) {
				return result.data;
			},
			rendertoolbar: function (toolbar) {
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append(' <button class="btn btn-xs btn-flat btn-default" onclick="$(\'#jqGrid_partial_material_issue\').jqxGrid(\'updatebounddata\'); ">Refresh</button> ');
			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ 
				text: 'Action', datafield: 'action',sortable:false,filterable:false, pinned:true, align: 'centre' , cellsalign: 'centre', cellclassname: 'grid-column-left',  editable: false,
				cellsrenderer: function (index,b,c,d,e,rows) {
					var approve = returnvalues = '';
					if(rows.closed_status == 0) {
						// return '<a href="javascript:void(0)" onclick="(' + index + '); return false;" title=""><i class="fa fa-trash"></i></a>';
					}
					if(rows.return_quantity > 0 && rows.returned_status == 1) {
						approve = '<a href="javascript:void(0)" onclick="approveReturnedItem(' + index + '); return false;" title="Approve Returned Item"><i class="fa fa-check"></i></a>';
					}

					returnvalues += approve;

					return '<div style=" margin-top: 8px; padding: 0px 5px;">' + returnvalues +'</div>';
				}
			},
			{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', editable: false, cellclassname: 'bg-dispatchqty', },
			{ text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%',columntype: 'numberinput', editable:false, cellclassname: 'bg-dispatchqty', },
			// { 
			// 	text: '<?php echo lang("part_code")?>', datafield: 'part_code', editable: true, 
			// 	cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
			// 		if (newvalue != oldvalue) {
			// 			var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);
			// 			insert_barcode(newvalue, partdata.id, row);

			// 		}
			// 	}, 
			// 	cellbeginedit: function(row) {
			// 		var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);
			// 		if(partdata.part_code) {
			// 			return false;
			// 		}
			// 		return true;
			// 	}
			// },
			{ 
				text: '<?php echo lang("part_code")?>', datafield: 'part_code', editable: true, 
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					if (newvalue != oldvalue) {

						var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);
						insert_barcode(newvalue,oldvalue, partdata.id, row);

					}
				}, 
				cellbeginedit: function(row) {
					var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);

					if($('#barcode_input').css('display') === 'none'){
						return false;
					
					}
					else{
						return true;
					}
					if(partdata.part_code) {
						return true;
					}
					return true;
				}
			},
			// { 
			// 	text: '<?php echo lang("part_code")?>', datafield: 'part_code', editable: true, 
			// 	cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
			// 		if (newvalue != oldvalue) {

			// 			var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);
			// 			insert_barcode(newvalue,oldvalue, partdata.id, row);

			// 		}
			// 	}, 
			// 	cellbeginedit: function(row) {
			// 		var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);

			// 		if($('#barcode_input').css('display') === 'none'){
			// 			return false;
					
			// 		}
			// 		else{
			// 			return true;
			// 		}
			// 		if(partdata.part_code) {
			// 			return true;
			// 		}
			// 		return true;
			// 	}
			// },
			{
				text: '<?php echo "DispatchedQty"?>', datafield: 'dispatched_quantity', cellsalign: 'right',columntype: 'numberinput', editable: true, 
				
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
					if (newvalue != oldvalue) {
						var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);

						$.post("<?php echo site_url('job_cards/set_material_quantity')?>", {partdata:partdata, newvalue:newvalue, part_code: partdata.part_code }, function(data){
							if(!data.success){
								$("#jqGrid_partial_material_issue").jqxGrid('setcellvalue', row, "dispatched_quantity", data.old_quantity);	
								alert(data.msg);
							}
						},'json');
					}
				},
				// validation: function( cell, value ) {
				// 	var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',cell.row);

				// 	if(!( !isNaN(parseFloat(value)) && isFinite(value))){
				// 		return { result: false, message: "Invalid Number" };
				// 	}
				// 	if( value <= 0) {
				// 		return { result: false, message: "Cannot accept quantity greater than provided." };
				// 	}
				// 	return true;
				// },
			},
			{ 
				text: 'Warranty', datafield: 'warranty', width: '10%', filterable: true, columntype: 'dropdownlist',

				createeditor: function (row, cellvalue, editor, cellText, width, height) {
					warranty_dropdown = editor.jqxDropDownList({
						source: warranty_array, displayMember: 'warranty', valueMember: 'warranty', width: width, height: height, 
						selectionRenderer: function () {
							if($('#material_issue-service_type').val() != 4)
							{
								warranty_dropdown.jqxDropDownList('disableItem','FOC');
							}
							return "<span style='top:4px; position: relative;'>Please Choose:</span>";
						}
					});
				},
				initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
					// set the editor's current value. The callback is called each time the editor is displayed.
					var items = editor.jqxDropDownList('getItems');
					editor.jqxDropDownList('uncheckAll');
					if(cellvalue) {
						var values = cellvalue.split(/,\s*/);
						for (var j = 0; j < values.length; j++) {
							for (var i = 0; i < items.length; i++) {
								if (items[i].label === values[j]) {
								// editor.jqxDropDownList('checkIndex', i);
							}
						}
					}
				}
			},
			geteditorvalue: function (row, cellvalue, editor) {
				return editor.val();
			}, 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);

				if(newvalue != oldvalue) {
					var jobcard_group = $('.job-status').val();

					$.post('<?php echo site_url('job_cards/job_card_detail/set_material_warranty') ?>', {id:partdata.id, part_code: partdata.part_code, newvalue:newvalue, jobcard_group:jobcard_group}, function(r){
						if(!r.success) {
							alert(r.msg);
						}
					},'json');
				}
			},cellbeginedit: function(row) {
				var partdata = $("#jqGrid_partial_material_issue").jqxGrid('getrowdata',row);
				if(partdata.closed_status == 1) {
					return false;
				}
				if(! partdata.part_code) {
					return false;
				}
				return true;
			}
		},		
		{ text: '<?php echo lang("issue_date")?>', datafield: 'issue_date',width: '20%', editable: false, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd_HH_mm, cellclassname: 'bg-dispatchqty', },
		{ text: '<?php echo 'Issued By'?>', datafield: 'material_issued_by',width: '20%', editable: false,  cellclassname: 'bg-dispatchqty', },
		{
			text: '<?php echo ('ReturnQty') ?>', datafield: 'return_quantity', editable: false, cellclassname: 'bg-dispatchqty',
		},
		],
		ready: function() {
			var parts_rows = $('#jqGrid_partial_material_issue').jqxGrid('getrows');
			/*console.log(parts_rows);
			$.each(parts_rows, function(i,v) {
				if(v.closed_status == 1){
					$('#jqGrid_partial_material_issue').jqxGrid('setcellvalue', i, "final_price", '0');
				}
				$('#jqxGridPartBill').jqxGrid('setcellvalue', i, "discount_percentage", '0');
				
			});
			$('#jqGrid_partial_material_issue').jqxGrid('clear');*/

		}
	}); 
$("#partdel").click(function () {
	$('#jqGrid_partial_material_issue').jqxGrid('deleterow', material_issue_id);
	$("#partpopupWindow").jqxWindow('hide');
}); 

// $("#jqGrid_partial_material_issue").jqxGrid('updatebounddata');

});


function f_material_calculation(price, quantity, discount) {
	var part_cost = (price - (price * discount) / 100) * quantity;
	return part_cost;
}

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

$("#material_issue-SubmitButton").on('click', function () {
	saveMaterial_issue_Record();
				/*
				var validationResult = function (isValid) {
								if (isValid) {
									 saveMaterial_issue_Record();
								}
						};
				$('#form-material_issue_grid').jqxValidator('validate', validationResult);
				*/
			});

function saveMaterial_issue_Record(){
	var materialData = JSON.stringify($('#jqGrid_partial_material_issue').jqxGrid('getrows'));
	// var data = $('#form-material_issue_grid').serialize();
	var data = getFormData('form-material_issue_grid');
// return;
	// $('#').block({ 
	// 	message: '<span>Processing your request. Please be patient.</span>',
	// 	css: { 
	// 		width                   : '75%',
	// 		border                  : 'none', 
	// 		padding                 : '50px', 
	// 		backgroundColor         : '#000', 
	// 		'-webkit-border-radius' : '10px', 
	// 		'-moz-border-radius'    : '10px', 
	// 		opacity                 : .7, 
	// 		color                   : '#fff',
	// 		cursor                  : 'wait' 
	// 	}, 
	// });

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/job_cards/material_issue_save"); ?>',
		data: {data, materialData},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				// reset_form_job_cards();
				$('#jqxPopupWindowMaterial_issue').jqxWindow('close');
			} else {
				alert(result.msg);	
			}
			// $('#').unblock();
		}
	});

}

$('.job-status').on('click',function(){
	var jobno = $(this).val();
	$.post('<?php echo site_url("job_cards/get_job_status")?>',{jobcard_group: jobno},function(result){
		if(result.success) {

			$("#form-jobcard_status").find('input').val(function(i,v){
				return result.details[this.name];
			});
			var tr_string;
			var image_check = '<i class="fa fa-check text-success" aria-hidden="true" ></i>';
			var image;

			if(result.status.jobcard == 'TRUE') image = image_check;
			else image = '';
			tr_string += "<tr><td>Job Card</td><td>"+image+"</td></tr>";
			if(result.status.material == 'TRUE') image = image_check;
			else image = '';
			tr_string += "<tr><td>Material Issued</td><td>"+image+"</td></tr>";
			if(result.status.outside_work == 'TRUE') image = image_check;
			else image = '';
			tr_string += "<tr><td>Outside Work</td><td>"+image+"</td></tr>";
			if(result.status.closedstatus == 'TRUE') image = image_check;
			else image = '';
			tr_string += "<tr><td>Job Closed</td><td>"+image+"</td></tr>";
			if(result.status.billinvoice == 'TRUE') image = image_check;
			else image = '';
			tr_string += "<tr><td>Invoice Issued</td><td>"+image+"</td></tr>";

			$('#form-jobcard_status table').html('<tr class="info"> <th>Job</th> <th>Status</th> </tr>');
			$('#form-jobcard_status table').append(tr_string);
			openPopupWindow('jqxPopupWindowJobCardStatus');
		}

	},'JSON');
});

$('#jqxPopupWindowMaterial_issue').on('open', function (event) { 
	// console.log(event);

}); 

$("#window_add_consumables").jqxWindow({ 
	width: '40%', 
	height: '35%', 
	theme: theme, 
	isModal: true, 
	autoOpen: false,
	cancelButton: $("#consumable-cancel"), 
	modalOpacity: 0.2, 
});

$("#jqxPopupApproveReturnedParts").jqxWindow({ 
	width: '30%', 
	height: '24%', 
	theme: theme, 
	isModal: true, 
	autoOpen: false,
	cancelButton: $("#acceptPartsReturn-cancel"), 
	modalOpacity: 0.2, 
});

</script>

<script type="text/javascript">
	$(function(){

		$("#jqGrid_consumables").jqxGrid({
			width: '100%',
			height: '200px',
			showtoolbar: true,
			editable : false,
			editmode : 'dblclick',
			autorowheight: true,
			pageable: true,
			selectionmode: 'singlecell',
			rendergridrows: function (result) {
				return result.data;
			},
			rendertoolbar: function (toolbar) {
				// toolbar.append('<input type="button" class="btn btn-xs btn-default" value="Refresh" onclick="GRID_CONSUMABLE.jqxGrid(\"updatebounddata\")">');
				// var me = this;
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append(' <button class="btn btn-xs btn-flat btn-default" onclick="$(\'#jqGrid_consumables\').jqxGrid(\'updatebounddata\'); ">Refresh</button> ');
			},
			columns: [
			{ 
				text: 'Action', datafield: 'action', width: '10%',sortable:false,filterable:false, pinned:true, align: 'centre' , cellsalign: 'centre', cellclassname: 'grid-column-left',  editable: false,
				cellsrenderer: function (index,b,c,d,e,rows) {
					if(rows.closed_status != 1) {
						return '<a href="javascript:void(0)" onclick="remove_consumable(' + index + '); return false;" title=""><i class="fa fa-trash"></i></a>';
					}
					return '';
				}
			},
			{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '20%', editable: false },
			{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', editable: false },
			// { text: '<?php echo lang("quantity")?>', datafield: 'quantity',width: '10%', editable: false,  cellsrenderer: function (index) {
			// 		var row =  $("#jqGrid_consumables").jqxGrid('getrowdata', index);
			// 		if(row.part_id == '<?php echo ULTRA_SYNTHETIC ?>' || row.part_id == '<?php echo SYNTHETIC ?>' || row.part_id == '<?php echo NORMAL ?>'){
			// 			return row.lube_quantity;
			// 		}else{
			// 			return row.quantity;
			// 		}
			// 	}
			// },
			{ 
			text: '<?php echo "quantity"; ?>',datafield: 'quantity',width: 150,filterable: true,  align: 'center' ,cellsFormat:'F2', 
					cellsrenderer: function (index) {
						var row =  $("#jqGrid_consumables").jqxGrid('getrowdata', index);
						var e='';
							if(row.part_id == '<?php echo ULTRA_SYNTHETIC ?>' || row.part_id == '<?php echo SYNTHETIC ?>' || row.part_id == '<?php echo NORMAL ?>'){
								e = row.lube_quantity;
							}else{
								e = row.quantity;
							}
						// var e = row.display_quantity * row.mrp_price;
						return '<div style="margin-top: 8px; margin-left:5px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>'; 
					}
			},
		
			{ text: '<?php echo lang("price")?>', datafield: 'price',width: '10%', editable: false },
			{ text: '<?php echo lang("issue_date")?>', datafield: 'issue_date',width: '20%', editable: false, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd_HH_mm },

			],
			ready: function() {

			}
		});

		var consumableSource = {
			url : '<?php echo site_url("job_cards/job_card_detail/get_consumable_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'part_code', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'price', type: 'number' },
			{ name: 'latest_part_code', type: 'number' },
			{ name: 'alternate_part_code', type: 'string' },
			{ name: 'category_id', type: 'string' },
			
			{ name: 'dealer_id', type: 'number' },
			],
		}

		consumablesComboAdapter = new $.jqx.dataAdapter(consumableSource,
		{
			formatData: function (data) {
				if ($("#consumable_list").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#consumable_list").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#consumable_list").jqxComboBox({
			width: '100%',
			height: 25,
			source: consumablesComboAdapter,
			remoteAutoComplete: true,
			autoDropDownHeight: true, 
			selectedIndex: 0,
			displayMember: "name",
			valueMember: "id",
			renderer: function (index, label, value) {
				var item = consumablesComboAdapter.records[index];
				if (item != null) {
					var label = /*item.name; + */ item.part_code + " | " + item.name;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = consumablesComboAdapter.records[index];
				if (item != null) {
					var label = item.name;
					console.log(item.price);
					$('#consumable_price').val(item.price);
					$('#unit_consumable_price').val(item.price);
					$('#quantity').val('');
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				consumablesComboAdapter.dataBind();
			}
		});

		$('#consumable-submit').on('click', function(i,v){
			$('#window_add_consumables').block({ 
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
			var formdata = $('#form-consumable').serialize();
			
			$.post('<?php echo site_url('job_cards/job_card_detail/set_consumables')?>', formdata, function(result){
				if(!result.success) {
					alert(result.msg);
					$('#window_add_consumables').unblock();
					return;
				}
				$("#jqGrid_consumables").jqxGrid('updatebounddata');


				$('#consumable_list').val('');
				$('#form-consumable')[0].reset();
				$('#window_add_consumables').unblock();

			}, 'json');
		});

		$('#acceptPartsReturn-submit').on('click', function(){
			var floor_id = $('#acceptPartsReturn-floor_id').val();
			var return_quantity = $('#acceptPartsReturn-return_quantity').val();
			var jobcard = $('.job-status').val();
			var part_code = $('#acceptPartsReturn-part_code').val();
			$.post('<?php echo site_url('job_cards/job_card_detail/confirm_parts_returned'); ?>',{ floor_id:floor_id, return_quantity: return_quantity, jobcard: jobcard, part_code:part_code} ,function(result){

				if( ! result.success ) {
					alert("Error");
				}

				$('#jqxPopupApproveReturnedParts').jqxWindow('close');
				$("#jqGrid_partial_material_issue").jqxGrid('updatebounddata');

			},'json');
		});

	});
</script>


<script type="text/javascript">
	function approveReturnedItem( index ) {
		var row =  $("#jqGrid_partial_material_issue").jqxGrid('getrowdata', index);
		if(row) {
			$('#acceptPartsReturn-floor_id').val(row.id);
			$('#acceptPartsReturn-return_quantity').val(row.return_quantity);
			$('#acceptPartsReturn-part_code').val(row.part_code);
			
			openPopupWindow('jqxPopupApproveReturnedParts');
		}
	}
</script>

<script type="text/javascript">
	function remove_consumable(index) {
		var row = $('#jqGrid_consumables').jqxGrid('getrowdata',index);
		$.post('<?php echo site_url("job_cards/job_card_detail/delete_consumable")?>',{'id':row.id},function(data){
			if(data.success){
				alert('Data deleted!!')
				$("#jqGrid_consumables").jqxGrid('updatebounddata');
			}else{
				alert('Error occured!!!!!!!!!!!!')
			}
		},'json');
		console.log(row);
	}
</script>

<script type="text/javascript">
	function get_total_price(price_id,quantity_id,result_id) {
		var price = parseFloat($('#'+price_id).val());
		var quantity = parseFloat($('#'+quantity_id).val());
		var result = price * quantity;
		console.log(price);
		console.log(quantity);
		console.log(price_id);
		console.log(quantity_id);
		console.log(result_id);
		console.log(result);
		$('#'+result_id).val(result);
	}
</script>