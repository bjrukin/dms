<?php echo form_open('', array('id' =>'form-outside_work', 'onsubmit' => 'return false')); ?>

<div class="row">
	<div class="col-md-7">
		<div class="row">
			<div class="col-md-2">Date:</div>
			<div class="col-md-6"><div id="send_date" name="send_date" class=""></div> </div>
		</div>
		<div class="row">
			<div class="col-md-2">Ledger</div>
			<div class="col-md-10"><div id="combo_workshop_id" name="workshop_id" class=""></div> </div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="row">
			<div class="col-md-3">Splr Inv No.</div>
			<div class="col-md-9"><input type="text" id="outside_work-splr_invoice_no" name="splr_invoice_no" class="form-control"></div>
		</div>
		<div class="row">
			<div class="col-md-3">Splr Inv Date</div>
			<div class="col-md-9"><div id="splr_invoice_date" name="splr_invoice_date" class=""></div></div>
		</div>
	</div>
</div>
<!-- START Grid -->
<div class="row">
	<div class="col-md-12">
		<div id="jqxGridOutside_work"></div>
	</div>
</div>
<!-- END Grid  -->
<div class="row">
	<div class="col-md-8">
		Remarks
		<input type="text" id="outside_work-remarks" name="remarks" class="form-control">
	</div>
	<div class="col-md-4">
		<fieldset>
			<div class="row">
				<div class="col-md-5">Gross Total</div>
				<div class="col-md-7"><input type="text" id="outside_work-gross_total" name="gross_total" class="form-control" readonly></div>
			</div>
			<div class="row">
				<div class="col-md-5">Round Off</div>
				<div class="col-md-7"><input type="text" id="outside_work-round_off" name="round_off" class="form-control"></div>
			</div>
			<div class="row">
				<div class="col-md-5">Net Amount</div>
				<div class="col-md-7"><input type="text" id="outside_work-net_amount" name="net_amount" class="form-control" readonly></div>
			</div>
		</fieldset>
	</div>
</div>
<!-- <input type="hidden" name="id" id="outside_work-id"> -->

<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
			<button onclick="saveOutSideWork();" class="btn btn-flat btn-sm btn-success" id="outside_work-save" hidden>Save</button>
			<button onclick="$('#jqxPopupWindow_AddOutsideWork').jqxWindow('close');" class="btn btn-flat btn-sm">Cancel</button>
			<button type="button" class="btn btn-sm" onclick="printPreview('Outside Work')">Print</button>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<!-- combo_job_id -->

<!-- POPUP Window for adding Outside Work -->
<div id="jqxPopupWindow_AddOutsideWork">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title_job"><?php echo lang('addoutsidework') ?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-add_outside_work', 'onsubmit' => 'return false')); ?>
		<h3>Item Details</h3>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="row form-group">
					<div class="col-md-2"> <label><?php echo lang('prefix'); ?></label> </div>
					<div class="col-md-2"> <input type="text" name="prefix" class="form-control" maxlength="8"> </div>

					<div class="col-md-2"> <label><?php echo lang('job'); ?> </label> </div>
					<div class="col-md-2"> <input type="text" id="add_outside_work-jobcard_group" name="jobcard_group" class="form-control" readonly> </div>
					<div class="col-md-2"> <label>Vehicle No.</label> </div>
					<div class="col-md-2"> <input type="text" id="add_outside_work-vehicle_no" name="vehicle_no" class="form-control" readonly> </div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"><label>Work No.</label></div>
					<div class="col-md-2"><div id="combo_job_id" name="workshop_job_id" class="form-control"></div></div>
					<div class="col-md-2"><label>Description</label></div>
					<div class="col-md-6"><input type="text" id="add_outside_work-description" name="description" class="form-control" readonly></div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"> <label><?php echo lang('amount'); ?></label> </div>
					<div class="col-md-2"><input type="number" name="amount" id="add_outside_work-amount" class="form-control"></div>
					<!-- </div> -->
					<!-- <div class="row form-group"> -->
					<div class="col-md-2"> <label><?php echo lang('taxes'); ?></label> </div>
					<div class="col-md-2"><input type="number" name="taxes" id="add_outside_work-taxes" class="form-control"></div>

					<div class="col-md-2"> <label><?php echo lang('discount'); ?></label> </div>
					<div class="col-md-2"><input type="number" name="discount" id="add_outside_work-discount" class="form-control" min=0 max=100></div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"><label><?php echo lang("mechanics_id") ?></label></div>
					<div class="col-md-6"><div type="text" id="add_outside_work-mechanic_id" name="mechanics_id" class="form-control"></div></div>
					<div class="col-md-2"><label>Total Amt. </label></div>
					<div class="col-md-2"><input type="text" id='add_outside_work-total_amount' name="total_amount" class="form-control" readonly></div>
					<input type="hidden" id="add_outside_work-mechanic_name" name="mechanic_name">
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-primary btn-xs btn-flat" id="jqxOutside_workSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxOutside_workCancelButton"><?php echo lang('general_cancel'); ?></button>
					</div>
				</div>
			</div>
		</div>
		<!-- <input type="hidden" name="jobcard_group" id="jobcard_group_outsidework"> -->
		<input type="hidden" name="id" id="id_outsidework">
		<?php echo form_close(); ?>
	</div>
</div>
<div id="WindowDeleteOutsidework">
	<div> Delete row </div>
	<div>
		<p> Are you sure you would like to delete the selected row?</p>
		<input type="hidden" id="outsidework_index">
		<button id="outsidework_del"> Yes</button>
		<button id="outsidework_cancel"> No</button>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#send_date, #splr_invoice_date").jqxDateTimeInput({ width: '100%', height: '34px', formatString: 'yyyy-MM-dd' });

		$('#add_outside_work-amount').bind('keyup change',function(e){
			var total,tax,discount;
			total = $('#add_outside_work-amount').val();
			tax = $('#add_outside_work-taxes').val();
			discount = $('#add_outside_work-discount').val();
			if(tax == '') tax = 0;
			if(discount == '') discount = 0;

			total = parseFloat(total) + parseFloat(tax) - parseFloat(discount);
			$('#add_outside_work-total_amount').val(total);
		});
		$('#add_outside_work-taxes').bind('keyup change',function(e){
			var total,tax,discount;
			total = $('#add_outside_work-amount').val();
			tax = $('#add_outside_work-taxes').val();
			discount = $('#add_outside_work-discount').val();
			if(tax == '') tax = 0;
			if(discount == '') discount = 0;

			total = parseFloat(total) + parseFloat(tax) - parseFloat(discount);
			$('#add_outside_work-total_amount').val(total);
		});
		$('#add_outside_work-discount').bind('keyup change',function(e){
			var total,tax,discount;
			total = $('#add_outside_work-amount').val();
			tax = $('#add_outside_work-taxes').val();
			discount = $('#add_outside_work-discount').val();
			if(tax == '') tax = 0;
			if(discount == '') discount = 0;

			total = parseFloat(total) + parseFloat(tax) - parseFloat(discount);
			$('#add_outside_work-total_amount').val(total);
		});

		var outside_workDataSource =
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

			{ name: 'job_id', type: 'number' },
			{ name: 'jobcard_group', type: 'number' },
			{ name: 'workshop_id', type: 'number' },
			{ name: 'description', type: 'string' },
			{ name: 'amount', type: 'number' },
			{ name: 'taxes', type: 'number' },
			{ name: 'discount', type: 'number' },
			{ name: 'remarks', type: 'string' },
			{ name: 'splr_invoice_no', type: 'number' },
			{ name: 'send_date', type: 'string' },
			{ name: 'arrived_date', type: 'string' },
			{ name: 'mechanics_id', type: 'number' },
			{ name: 'prefix', type: 'string' },
			{ name: 'total_amount', type: 'number' },
			{ name: 'mechanic_name', type: 'string' },

			],
			// url: '<?php echo site_url("admin/job_cards/outside_work_json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
	        	//callback called when a page or page size is changed.
	        },
	        beforeprocessing: function (data) {
	        	outside_workDataSource.totalrecords = data.total;
	        },
		    // update the grid and send a request to the server.
		    filter: function () {
		    	$("#jqxGridOutside_work").jqxGrid('updatebounddata', 'filter');
		    },
		    // update the grid and send a request to the server.
		    sort: function () {
		    	$("#jqxGridOutside_work").jqxGrid('updatebounddata', 'sort');
		    },
		    processdata: function(data) {
		    }
		};

		$("#jqxGridOutside_work").jqxGrid({
			theme: theme,
			width: '100%',
			height: '250px',
			source: outside_workDataSource,
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
				var container = $("<div style='margin: 5px;'></div>");
				toolbar.append(container);
				container.append('<input id="button-addoutsidework" type="button" value="<?php echo lang('addoutsidework') ?>" />');
				$("#button-addoutsidework").jqxButton();
				$("#button-addoutsidework").on('click', function () {
					
					// reset_form_outsideWorks();
					openPopupWindow('jqxPopupWindow_AddOutsideWork', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
				});

			},
			columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'Action', datafield: 'action', width:100, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index,a,b,c,d,data) {
				var e = '';
				// e += '<a href="javascript:void(0)" onclick="edit_outside_work(' + index + '); return false;" title="<?php echo lang('edit_outsidework')?>"><i class="fa fa-edit"></i></a>&nbsp';
				e += '<a href="javascript:void(0)" onclick="$(\'#jqxGridOutside_work\').jqxGrid(\'deleterow\', '+index+');" title="<?php echo lang('delete_outsidework')?>"><i class="fa fa-trash"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>'; }
			},
			{ text: '<?php echo lang("prefix"); ?>',datafield: 'prefix',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: '<?php echo lang("jobcard_group"); ?>',datafield: 'jobcard_group',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: 'Work No.',datafield: 'workshop_job_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },

			{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("taxes"); ?>',datafield: 'taxes',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("discount"); ?>',datafield: 'discount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mechanics_name"); ?>',datafield: 'mechanic_name',width: 150,filterable: true,renderer: gridColumnsRenderer },

			],
			rendergridrows: function (result) {
				return result.data;
			}
		});

		/*$('#form-assign_jobcards').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [ 
			{ input: '#form-assign_jobcards input[name=combo_floor_supervisor]', message: 'Required', action: 'blur', rule: 'required'}, 
			{ input: '#form-assign_jobcards input[name=combo_mechanics]', message: 'Required', action: 'blur', rule: 'required'},
			{ input: '#form-assign_jobcards input[name=combo_cleaner]', message: 'Required', action: 'blur', rule: 'required'},
			]
		});*/


		$("#form-add_outside_work input[name=amount]").jqxInput({ placeHolder: "Enter Amount", height: 34, width: '100%', minLength: 1 });
		$("#form-add_outside_work input[name=taxes]").jqxInput({ placeHolder: "Enter Tax", height: 34, width: '100%', minLength: 1 });
		$("#form-add_outside_work input[name=discount]").jqxInput({ placeHolder: "Enter Discount", height: 34, width: '100%', minLength: 1, maxLength:100 });

		$('#form-add_outside_work').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [ 
		/*{ input: '#form-add_outside_work #combo_workshop_id', message: 'Required', action: 'blur', rule: function(input) {
			var val = $('#combo_workshop_id').jqxComboBox('val');
			return (val == '' || val == null || val == 0) ? false: true;
		}}, 
		{ input: '#form-add_outside_work #combo_job_id', message: 'Required', action: 'blur', rule: function(input) {
			var val = $('#form-add_outside_work #combo_job_id').jqxComboBox('val');
			return (val == '' || val == null || val == 0) ? false: true;
		}},
		{ input: '#form-add_outside_work input[name=amount]', message: 'Required', action: 'blur', rule: 'required'},
		{ input: '#form-add_outside_work input[name=taxes]', message: 'Required', action: 'blur', rule: 'required'},
		{ input: '#form-add_outside_work input[name=discount]', message: 'Required', action: 'blur', rule: 'required'},
		{ input: '#form-add_outside_work input[name=discount]', message: 'Maximum value', action: 'blur', rule: function(input) {
			var val = $('#form-add_outside_work #combo_job_id').jqxComboBox('val');
			return (val > 100) ? false: true;
		}},*/
			// { input: '#form-add_outside_work #send_date', message: 'Required', action: 'blur', rule: 'required'},
			// { input: '#form-add_outside_work #arrived_date', message: 'Required', action: 'blur', rule: 'required'},
			]
		});

		$("#WindowDeleteOutsidework").jqxWindow({ isModal: true, autoOpen: false, height: '20%' });
		$("#outsidework_del").click(function () {
			var id = $("#outsidework_index").val();
			$.post('<?php echo site_url("admin/job_cards/delete_outsidework"); ?>',{id: id},function(r){
				if(r.success == true) {
					$('#jqxGridOutside_work').jqxGrid('deleterow', id);
					$("#WindowDeleteOutsidework").jqxWindow('hide');
				}
			});
		});
		$("#outsidework_cancel").click(function () {
			$("#WindowDeleteOutsidework").jqxWindow('hide');
		});

		$("#outside_work-round_off").keyup(function(){
			var round_off = $('#outside_work-round_off').val();
			var gross_total = $('#outside_work-gross_total').val();
			if(round_off == '')
			{
				round_off = 0;
			} 
			$('#outside_work-net_amount').val( parseFloat(gross_total) + parseFloat(round_off) );

		});

		$("#combo_job_id").select('bind', function (event) {
			if (!event.args)
				return;
			var desc = event.args.item.originalItem.job_description;
			$('#add_outside_work-description').val(desc);
		});

		$("#add_outside_work-mechanic_id").select('bind', function (event) {
			if (!event.args)
				return;
			var desc = event.args.item.originalItem.employee_name;
			$('#add_outside_work-mechanic_name').val(desc);
		});



	}); /*endfunction*/

$("#jqxOutside_workSubmitButton").on('click', function () {        
	saveOutside_workRecord();

	totalGrossAmount();
		// var validationResult = function (isValid) {
		// 	if (isValid) {
		// 		saveOutside_workRecord();
		// 	}
		// };
		// $('#form-add_outside_work').jqxValidator('validate', validationResult);

	});

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

function saveOutside_workRecord(){
	// var data = $("#form-add_outside_work").serializeArray();
	var data = getFormData('form-add_outside_work');
	var datarow = {
		'prefix'			: data.prefix,
		'jobcard_group'		: data.jobcard_group,
		'workshop_job_id'	: data.workshop_job_id,
		'description'		: data.description,
		'amount'			: data.amount,
		'taxes'				: data.taxes,
		'discount'			: data.discount,
		'total_amount'		: data.total_amount,
		'mechanics_id'		: data.mechanics_id,
		'mechanic_name'		: data.mechanic_name
	};

	$("#jqxGridOutside_work").jqxGrid('addrow', null, datarow);
	reset_form_outsideWorks();
	// console.log(data);
	return;

	$('#jqxPopupWindow_AddOutsideWork').block({
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
		url: '<?php echo site_url("admin/job_cards/save_outside_work"); ?>',
		data: data,
		success: function (result) {
			var result = eval('(' + result + ')');
			if (result.success) {
                // reset_form_dispatch_records();
                $('#jqxGridOutside_work').jqxGrid('updatebounddata');
                $('#jqxPopupWindow_AddOutsideWork').jqxWindow('close');
            }
            $('#jqxPopupWindow_AddOutsideWork').unblock();
        }
    });
}

function saveOutSideWork() {
	var data = getFormData('form-outside_work');
	var outsideRecords = $('#jqxGridOutside_work').jqxGrid('getrows');
	console.log(data);
	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/job_cards/save_outside_work_all"); ?>',
		data: {data,outsideRecords},
		success: function (result) {
			var result = eval('(' + result + ')');
			if (result.success) {
				// reset_form_dispatch_records();
				// $('#jqxGridOutside_work').jqxGrid('updatebounddata');
				$('#jqxPopupWindowOutsideWork').jqxWindow('close');
			}
			// $('#jqxPopupWindow_AddOutsideWork').unblock();
		}
	});

}

function delete_outside_work( index ) {
// var rowid = $("#jqxGridOutside_work").jqxGrid('getrowid',index);
openPopupWindow('WindowDeleteOutsidework', '<?php echo lang("general_delete")  . "&nbsp;" .  $header; ?>');
$("#outsidework_index").val(index);
}

function edit_outside_work( index ) {
	var row =  $("#jqxGridOutside_work").jqxGrid('getrowdata', index);
	if(!row) {
		return false;
	}
	reset_form_outsideWorks();

	$("#form-add_outside_work").find('input').val(function(i,v){
		return row[this.name];
	});
	$("#combo_workshop_id").val(row.workshop_id);
	$("#combo_job_id").val(row.job_id);
// $("#id").val(row.id);

openPopupWindow('jqxPopupWindow_AddOutsideWork', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');

}
function reset_form_outsideWorks()
{
	// $("#id_outsidework").val('');
	// $("#jobcard_group_outsidework").val('');

	$("#form-add_outside_work input[name=prefix]").val('');
	$("#combo_job_id").val('');
	$("#form-add_outside_work input[name=description]").val('');
	$("#form-add_outside_work input[name=amount]").val('');
	$("#form-add_outside_work input[name=taxes]").val('');
	$("#form-add_outside_work input[name=discount]").val('');
	$("#form-add_outside_work input[name=total_amount]").val('');

}

function totalGrossAmount()
{
	var columnData = [];
	var rows = $('#jqxGridOutside_work').jqxGrid('getrows');
	var sum = 0;

	for (var i = 0; i < rows.length; i++) {
		columnData.push(rows[i].total_amount);
	}
	$.each(columnData,function(){sum+=parseFloat(this) || 0;});
	$('#outside_work-gross_total').val(sum);

	var round_off = $('#outside_work-round_off').val();
	if(round_off == '')
	{
		round_off = 0;
	} 
	$('#outside_work-net_amount').val( parseFloat(sum) + parseFloat(round_off) );

}


</script>