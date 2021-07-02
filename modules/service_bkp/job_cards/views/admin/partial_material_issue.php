<!-- for material_issue form -->
<div id="jqxPopupWindowMaterial_issue">
	<div> <?php echo lang("material_issue") ?> </div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('', array('id' =>'form-material_issue_grid', 'onsubmit' => 'return false')); ?>
				<fieldset>
					<div class="row form-group">
						<div class="col-md-1">Job No.</div>
						<div class="col-md-2"><input type="text" class="form-control" id="material_issue-jobcard_group" name="jobcard_group" readonly></div>
						<div class="col-md-2">Job Date</div>
						<div class="col-md-3"><input type="text" class="form-control" name="" readonly></div>
					</div>
					<div class="row form-group">
						<div class="col-md-1">Vehicle No.</div>
						<div class="col-md-2"><input type="text" class="form-control" id="material_issue-vehicle_no" name="" readonly></div>
						<!-- </div> -->
						<!-- <div class="row form-group"> -->
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

							<div id="jqGrid_partial_material_issue" ></div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-3">Total Item</div>
						<div class="col-md-1">Narration</div>
						<div class="col-md-8"><input type="text" class="form-control" id="material_issue-narration" name="narration"></div>
					</div>
				</fieldset>
				<?php echo form_close(); ?>

				<fieldset>
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="pull-right">
								<button type="button" class="btn btn-success btn-xs btn-flat" id="material_issue-SubmitButton"><?php echo lang('general_save'); ?></button>
								<button type="button" class="btn btn-default btn-xs btn-flat" id=""><?php echo lang('general_cancel'); ?></button>
								<button type="button" class="btn btn-default btn-xs btn-flat job-status" value=""  >Job Status</button>
								<button type="button" class="btn btn-default btn-xs btn-flat" value="" onclick="printPreview('Material Issue')"  >Print</button>
							</div>
						</div>
					</div>
				</fieldset>



			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$("#jqxPopupWindowMaterial_issue").jqxWindow({ 
			width: '90%', 
			height: '80%', 
			maxWidth: '90%', 
			maxHeight: '80%', 
			resizable: false, 
			theme: theme, 
			isModal: true, 
			autoOpen: false, 
			cancelButton: $("#Cancel"), 
			modalOpacity: 0.8 
		});

		/*$('#material_issue-jobcard_group').on('change',function(r){
			var jobno = $(this).val();
			$('.job-status').val(jobno);
			$("#jqGrid_partial_material_issue").jqxGrid('updatebounddata');
			$.post('<?php echo site_url('admin/job_cards/get_material_issue'); ?>',{jobcard_group: jobno},function(result){
				console.log(result);
				var narration;
				var details = result.parts[0]; 
				$.each(result.parts,function(i,v){
					var datarow = {
						'id'			: v.id,
						'part_id'		: v.part_id,
						'part_name'		: v.part_name,
						'part_code'		: v.part_code,
						'price'			: v.price,
						'quantity'		: v.quantity,
						'total'			: v.final_price,
						'issue_date'	: v.issue_date,
						'warranty'		: v.warranty,
					};
					narration = v.narration;

					$("#jqGrid_partial_material_issue").jqxGrid('addrow', null, datarow);
				});
				$('#material_issue-narration').val(narration);
				$('#material_issue-vehicle_no').val(details.vehicle_no);
				$('#material_issue-chassis_no').val(details.chassis_no);
				$('#material_issue-vehicle_name').val(details.vehicle_name);
				$('#material_issue-party_name').val(details.full_name);
				$('#material_issue-mechanic_id').val(details.mechanics_id);

			},'JSON');
		});*/

		var warranty_array = {};

		warranty_array['0'] = {};
		warranty_array['0']['warranty'] = "FOC";
		warranty_array['1'] = {};
		warranty_array['1']['warranty'] = "PAID";
		warranty_array['2'] = {};
		warranty_array['2']['warranty'] = "UW";

		var getwarrantyDataAdapter  = function (datafield){
			var source =
			{
				localdata: warranty_array,
				datatype: "array",
				datafields:
				[
				{ name: 'warranty', type: 'string' },
				]
			};
			var warrantyDataAdapter = new $.jqx.dataAdapter(source, { uniqueDataFields: [datafield] });
			return warrantyDataAdapter;
		}

	// part to table
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



	var materialSource =
	{
		// localdata: data,
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
		{ name: 'issue_date', type: 'date' },
		// { name: 'warranty', values: { source: warrantyDataAdapter.records, } },
		],
		addrow: function (rowid, rowdata, position, commit) {
			// synchronize with the server - send insert command
			// call commit with parameter true if the synchronization with the server is successful 
			// and with parameter false if the synchronization failed.
			// you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
			commit(true);
		},
	};
	var MaterialIssue_dataAdapter = new $.jqx.dataAdapter(materialSource);
	// initialize jqxGrid
	$("#jqGrid_partial_material_issue").jqxGrid(
	{
		width: '100%',
		height: '50%',
		source: MaterialIssue_dataAdapter,
		showtoolbar: true,
		editable : true,
		editmode : 'click',
		rendergridrows: function (result) {
			return result.data;
		},
		autorowheight: true,
		pageable: true,

		selectionmode: 'singlecell',
		rendertoolbar: function (toolbar) {
			var me = this;
			var container = $("<div style='margin: 5px;'></div>");
			toolbar.append(container);
			container.append('<input id="" type="button" value="Add Parts" onclick="openPopupWindow(\'jqxPopupWindowPart\')"/>');
			container.append('<span class="pull-right">*For free service, Oil and filters are added by default*<span>');
			// $("#partsaddrowbutton").jqxButton();
			// create new row.
			// $("#partsaddrowbutton").on('click', function () {
				// var datarow = generaterow();
				// var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);
				// openPopupWindow('jqxPopupWindowPart', '<?php echo lang("general_add")  . "&nbsp;" .  lang("part"); ?>');
			// });
		},
		columns: [
		// { text: '<?php echo lang("part_id")?>', datafield: 'part_id', width: '10%' },
		{ text: '<?php echo lang("part_code")?>', datafield: 'part_code', width: '10%', editable: false },
		{ text: '<?php echo lang("part_name")?>', datafield: 'part_name', width: '30%', editable: false },
		{ text: '<?php echo lang("price")?>', datafield: 'price', width: '10%', cellsalign: 'right', editable: false },
		{ 
			text: '<?php echo lang("quantity")?>', datafield: 'quantity', width: '10%',columntype: 'numberinput',
			cellbeginedit: false, 
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				if (newvalue != oldvalue) {
					var price = $("#jqGrid_partial_material_issue").jqxGrid('getcellvalue', row, "price");
					$("#jqGrid_partial_material_issue").jqxGrid('setcellvalue', row, "total", (price * newvalue).toFixed(2));
				}
			},

		},
		{ text: '<?php echo lang("total")?>', datafield: 'total', width: '5%', editable: false  },

		{ text: 'Warranty', datafield: 'warranty', width: '10%', filterable: true, columntype: 'dropdownlist',

		createeditor: function (row, cellvalue, editor, cellText, width, height) {
                  	// construct the editor. 
                  	editor.jqxDropDownList({
                  		source: getwarrantyDataAdapter('warranty'), displayMember: 'warranty', valueMember: 'warranty', width: width, height: height, 
                  		selectionRenderer: function () {
                  			return "<span style='top:4px; position: relative;'>Please Choose:</span>";
                  		}
                  	});
                  },
                  initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
                          // set the editor's current value. The callback is called each time the editor is displayed.
                          var items = editor.jqxDropDownList('getItems');
                          editor.jqxDropDownList('uncheckAll');
                          var values = cellvalue.split(/,\s*/);
                          for (var j = 0; j < values.length; j++) {
                          	for (var i = 0; i < items.length; i++) {
                          		if (items[i].label === values[j]) {
                                      // editor.jqxDropDownList('checkIndex', i);
                                  }
                              }
                          }
                      },
                      geteditorvalue: function (row, cellvalue, editor) {
                  	// return the editor's value.
                  	return editor.val();
                  }
              },
              {
              	text: 'Issue Date', datafield: 'issue_date', columntype: 'datetimeinput', width: 110, align: 'right', cellsalign: 'right', cellsformat: 'd',
              	validation: function (cell, value) {
              		if (value == "")
              			return true;
              		var year = value.getFullYear();
                          /*if (year >= 2015) {
                              return { result: false, message: "Ship Date should be before 1/1/2015" };
                          }*/
                          return true;
                      }
                  },

                  { text: 'Delete', datafield: 'Delete', width: '10%', columntype: 'button', cellsrenderer: function () {
                  	return "Delete row";
                  }, buttonclick: function (row) {
			// open the popup window when the user clicks a button.
			material_issue_id = $("#jqGrid_partial_material_issue").jqxGrid('getrowid', row);
			var offset = $("#jqGrid_partial_material_issue").offset();
			$("#partpopupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 100, y: parseInt(offset.top) + 60} });
			// show the popup window.
			$("#partpopupWindow").jqxWindow('show');
		} },
		],
		ready: function() {
			// $('#jqGrid_partial_material_issue').jqxGrid('clear');

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

</script>