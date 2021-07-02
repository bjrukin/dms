<?php echo form_open('', array('id' =>'form-outside_work', 'onsubmit' => 'return false')); ?>

<input type="hidden" id="job_group" name="job_group" class="form-control">

<!-- START Grid -->
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-default btn-xs" id="button-addoutsidework" type="button" ><?php echo lang('addoutsidework') ?> </button>
	</div>
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
				<div class="col-md-7"><input type="text" id="outside_work-round_off" name="round_off" class="form-control" readonly></div>
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
		<div class="btn-group btn-group-sm pull-right">
			<button type="button" class="btn btn-default" onclick="printPreview('Outside Work')">Print</button>
			<button onclick="saveOutSideWork();" class="btn btn-flat btn-success" id="outside_work-save" hidden>Save</button>
			<button id="outside_work-cancel" class="btn btn-flat">Cancel</button>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

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
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-2">Date:</div>
					<div class="col-md-6"><div id="send_date" name="send_date" class=""></div> </div>
				</div>
				<div class="row">
					<div class="col-md-2">Ledger <br> <a href="<?php echo site_url('outsidework_ledgers'); ?>" target="_blank">Create New</a> </div>
					<div class="col-md-9"><div id="combo_workshop_id" name="workshop_id" class=""></div> </div>
					<div class="col-md-1"> </div>
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

					<div class="row form-group" id="outsideMargin" hidden>
						<div class="col-md-2"><lable>Margin</lable></div>
						<div class="col-md-2"><input type="number" name="margin_percentage" id="add_outside_work-margin_percentage" class="form-control"></div>
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
							<div class="btn-group btn-group-sm pull-right">
								<button type="button" class="btn btn-primary btn-flat" id="jqxOutside_workSubmitButton"><?php echo lang('general_save'); ?></button>
								<button type="button" class="btn btn-default btn-flat" id="jqxOutside_workCancelButton"><?php echo lang('general_cancel'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <input type="hidden" name="jobcard_group" id="jobcard_group_outsidework"> -->
			<!-- <input type="hidden" name="id" id="id_outsidework"> -->
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

			$("#button-addoutsidework").on('click', function () {
				openPopupWindow('jqxPopupWindow_AddOutsideWork', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
			});

			$('#add_outside_work-amount').bind('keyup change',function(e){
				
				var total,tax,discount,margin_percentage,margin_amt;
				total = $('#add_outside_work-amount').val();


			
				if((total <= 1000)){
					// console.log("1000");
					$('#add_outside_work-margin_percentage').val('30');
					$('#outsideMargin').show();
				}
				else if((total >= 1001 && total <= 5000)){
					// console.log("between 1001-5000");
					$('#add_outside_work-margin_percentage').val('25');
					$('#outsideMargin').show();
				}
				else if((total >= 5001 && total <= 10000)){
					// console.log("between 5001-10000");
					$('#add_outside_work-margin_percentage').val('20');
					$('#outsideMargin').show();
				}
				if((total >= 10000)){
					// console.log("10000+");
					$('#add_outside_work-margin_percentage').val('15');
					$('#outsideMargin').show();
				}


				else{
					$('#add_outside_work-margin_percentage').val();
				}
				tax = $('#add_outside_work-taxes').val();
				discount = $('#add_outside_work-discount').val();
				margin_percentage = $('#add_outside_work-margin_percentage').val();
				
				if(tax == '') tax = 0;
				if(discount == '') discount = 0;
				if(margin_percentage == '') margin_percentage = 0;
				margin_amt = parseFloat(total)*parseFloat(margin_percentage)/100;
				
				total = parseFloat(total) + parseFloat(tax) - parseFloat(discount) + parseFloat(margin_amt);
				
				$('#add_outside_work-total_amount').val(total);
				
			});

			$('#add_outside_work-taxes').bind('keyup change',function(e){
				var total,tax,discount,margin_amt;
				total = $('#add_outside_work-amount').val();
				tax = $('#add_outside_work-taxes').val();
				discount = $('#add_outside_work-discount').val();
				margin_percentage = $('#add_outside_work-margin_percentage').val();
				
				if(tax == '') tax = 0;
				if(discount == '') discount = 0;
				if(margin_percentage == '') margin_percentage = 0;
				margin_amt = parseFloat(total)*parseFloat(margin_percentage)/100;
				
				total = parseFloat(total) + parseFloat(tax) - parseFloat(discount) + parseFloat(margin_amt);
				
				
				$('#add_outside_work-total_amount').val(total);
				
			});

			$('#add_outside_work-discount').bind('keyup change',function(e){
				var total,tax,discount,margin_amt;
				total = $('#add_outside_work-amount').val();
				tax = $('#add_outside_work-taxes').val();
				discount = $('#add_outside_work-discount').val();
				margin_percentage = $('#add_outside_work-margin_percentage').val();
				
				if(tax == '') tax = 0;
				if(discount == '') discount = 0;
				if(margin_percentage == '') margin_percentage = 0;
				margin_amt = parseFloat(total)*parseFloat(margin_percentage)/100;
				
				total = parseFloat(total) + parseFloat(tax) - parseFloat(discount) + parseFloat(margin_amt);
				

				$('#add_outside_work-total_amount').val(total);
				
			});


			$("#jqxGridOutside_work").jqxGrid({
				theme: theme,
				width: '100%',
				height: '250px',
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
					container.append('');
				},
				columns: [
				{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
				{ text: 'Action', datafield: 'action', width:100, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index,a,b,c,d,data) {
					var e = '';
					// e += '<a href="javascript:void(0)" onclick="edit_outside_work(' + index + '); return false;" title="<?php echo lang('edit_outsidework')?>"><i class="fa fa-edit"></i></a>&nbsp';
					e += '<a href="javascript:void(0)" onclick="delete_outsidework('+index+')" title="<?php echo lang('delete_outsidework')?>"><i class="fa fa-trash"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>'; }
				},
				{ text: '<?php echo 'Send Date'; ?>',datafield: 'send_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo 'Splr Invoice No'; ?>',datafield: 'splr_invoice_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo 'Splr Invoice Date'; ?>',datafield: 'splr_invoice_date',width: 150,filterable: true,renderer: gridColumnsRenderer ,filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
				{ text: '<?php echo 'Workshop'; ?>',datafield: 'workshop_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("prefix"); ?>',datafield: 'prefix',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },

				{ text: '<?php echo lang("amount"); ?>',datafield: 'amount',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("taxes"); ?>',datafield: 'taxes',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("discount"); ?>',datafield: 'discount',width: 150,filterable: true,renderer: gridColumnsRenderer },
				{ text: '<?php echo lang("total_amount"); ?>',datafield: 'total_amount',width: 150,filterable: true,
						cellsrenderer: function (index,a,b,c,d,data) {
							
								var rows = $("#jqxGridOutside_work").jqxGrid('getrowdata', index);
								
								
								
								var margin_amt= parseInt(rows.amount) * rows.margin_percentage/100;
								
								var e = parseInt(rows.total_amount) + parseInt(margin_amt);
								
								
								return '<div style="margin-top: 8px; margin-left:5px;">' + e.toLocaleString('en-IN', {minimumFractionDigits : 2}) + '</div>'; 
							},


				 },
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
			var index = $("#outsidework_index").val();
			var id = $('#jqxGridOutside_work').jqxGrid('getrowid',index);
			$('#jqxGridOutside_work').jqxGrid('deleterow', id);
			$("#WindowDeleteOutsidework").jqxWindow('hide');
			// $('#WindowDeleteOutsidework').jqxGrid('updatebounddata');

			// $.post('<?php //echo site_url("admin/job_cards/delete_outsidework"); ?>',{id: id},function(r){
			// 	if(r.success == true) {
			// 		console.log(r);
			// 		$("#WindowDeleteOutsidework").jqxWindow('hide');
			// 	}
			// });
		});
		$("#outsidework_cancel").click(function () {
			$("#WindowDeleteOutsidework").jqxWindow('hide');
		});

		$("#outside_work-round_off").keyup(function(){

			alert();

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

function delete_outsidework( index ) {
	// alert()
// var rowid = $("#jqxGridOutside_work").jqxGrid('getrowid',index);
$("#outsidework_index").val(index);

openPopupWindow('WindowDeleteOutsidework', '<?php echo lang("general_delete")  . "&nbsp;" .  $header; ?>');
}

// function delete_outsidework(index){
// 	$("#WindowDeleteOutsidework").jqxWindow('show');

// 	// $('#jqxGridOutside_work').jqxGrid('deleterow',index);
	
// }


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
	
	var rows = $('#jqxGridOutside_work').jqxGrid('getrows');
	
	var margin_amt = parseInt(data.amount) *parseInt(data.margin_percentage)/100;
	var total = parseInt(data.total_amount) - parseInt(margin_amt);
	var datarow = {
		'prefix'			: data.prefix,
		'jobcard_group'		: data.jobcard_group,
		'workshop_job_id'	: data.workshop_job_id,
		'description'		: data.description,
		'amount'			: data.amount,
		'taxes'				: data.taxes,
		'discount'			: data.discount,
		'total_amount'		: total,
		'total'	        	: data.total_amount,
		'mechanics_id'		: data.mechanics_id,
		'mechanic_name'		: data.mechanic_name,
		'send_date'			: data.send_date,
		'workshop_id'		: data.workshop_id,
		'splr_invoice_no'	: data.splr_invoice_no,
		'splr_invoice_date'	: data.splr_invoice_date,
		
		'margin_percentage'	: data.margin_percentage
	};
	// console.log(datarow);
	if(rows.length > 0){
		$("#jqxGridOutside_work").jqxGrid('addrow', null, datarow, 'first');	
		
	}else{

		$("#jqxGridOutside_work").jqxGrid('addrow', null, datarow);
	}

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
	// console.log(data);
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
	$("#form-add_outside_work input[name=margin_percentage]").val('');
	

}

function totalGrossAmount()
{
	var columnData = [];
	var rows = $('#jqxGridOutside_work').jqxGrid('getrows');

	// console.log(rows);
	var sum = 0;

	for (var i = 0; i < rows.length; i++) {
		columnData.push(rows[i].total);
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