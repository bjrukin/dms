<style type="text/css">
	.cls-red { background-color: #F56969; }
	.cls-green { background-color: #3abb23; }
	.cls-yellow{background-color: #f4dc42;}
	.cls-blue{background-color: #4980d8;}
</style>
<div id="jqxPopupWindowFloorSupervisor_material">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="">Assign Parts</span>
	</div>

	<div>
		<div class="form_fields_area" id="detail_list"> 
			<label> Job Detail </label>
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-flat btn-xs btn-primary" id="add_new_job">Add Job</button>
				</div>
			</div>
			<div class="row"><div id="jqxGridDetail"> </div></div>

			<label>Material Required</label> <br>
			<input type="button" id="openAssignParts" class="btn btn-xs btn-primary" value="Assign Parts" onclick="openPopupWindow('jqxPopupWindowAssignParts')" />
			<div id="jqxGridJobDetailPart"> </div>

		</div>
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<!-- <button class="btn btn-primary btn-flat btn-xs" id="save_detail">Save</button> -->
				<button class="btn btn-success btn-flat btn-sm" id="close_detail" onclick="$('#jqxPopupWindowFloorSupervisor_material').jqxWindow('close');">Close</button>
				
			</div>
		</div>

	</div>
</div>

<div id="jqxPopupWindowAssignParts">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="">Add Parts</span>
	</div>

	<div>
		<div class="col-md-12">
			
			<form id="form-material_advice">
				<input type="hidden" name="jobcard_group">
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('part_name','part_name'); ?>
					</div>
					<div class="col-md-8">
						<div id="advice_new_parts" name="advice_new_parts" class="form-control"></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('quantity','quantity'); ?>
					</div>
					<div class="col-md-3">
						<input type="number" id="material_advice-quantity" name="quantity" class="form-control" value="1">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group pull-right">

							<button type="button" class="btn btn-primary" id="material_advice-submit">Add</button>	
							<button type="button" class="btn btn-link" id="material_advice-cancel">Close</button>	
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="jqxPopupWindowRemoveQuantity">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="">Remove Quantity</span>
	</div>

	<div>
		<div class="col-md-12">
			<form id="form-return">
				<input type="hidden" name="jobcard_group" id="return_jobcard_group">
				<input type="hidden" name="dealer_id" id="return_dealer_id">
				<input type="hidden" id="return_dispatched_quantity">
				<input type="hidden" id="return_floor_id" name="return_floor_id">
				<input type="hidden" id="return_total_dispatched" name="">

				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('part_name','part_name'); ?>
					</div>
					<div class="col-md-8">
						<input type="text" class="text_input" name="return_part_name" id="return_part_name" readonly="true">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('quantity','quantity'); ?>
					</div>
					<div class="col-md-3">
						<input type="number" id="return-quantity" name="return_quantity" class="text_input">
						(Quantity upto now)
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<?php echo lang('remarks','remarks'); ?>
					</div>
					<div class="col-md-3">
						<input type="text" id="return-remarks" name="return_remarks" class="text_area">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-primary" id="return-submit">Save</button>	
							<button type="button" class="btn btn-link" id="return-cancel">Close</button>	
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="jqxPopupWindowAddNewJob">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="">Add New Job</span>
	</div>
	<div>
		<div class="col-md-12">
			<form id="form-floor_addjob">
				<input type="hidden" name="jobcard_group" class="job-status">
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('customer_voice')?></label></div>
					<div class="col-md-8"><textarea class="text_area" name="customer_voice" id="floor_addjob-customer_voice"></textarea></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('floor_supervisor_voice')?></label></div>
					<div class="col-md-8"><textarea class="text_area" name="floor_supervisor_voice" id="floor_addjob-floor_supervisor_voice"></textarea></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label><?php echo lang('job')?></label></div>
					<div class="col-md-8"><div name="job_id" class="form-control" id="floor_addjob-job"></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label>Description</label></div>
					<div class="col-md-6"><div id="floor_addjob-description"></div><div id="floor_addjob-job_code" hidden></div></div>
				</div>
				<div class="row form-group">
					<div class="col-md-4"><label>Price</label></div>
					<div class="col-md-6"><input type="number" name="price" id="floor_addjob-price" class="form-control" ></div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="btn-group btn-xs pull-right">
							<button type="button" id="add_new_job_submit" class="btn btn-primary">Add Job</button>
							<button type="button" id="add_new_job_close" class="btn btn-default">Close</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(function(){
		// initialize detail popup
		$("#jqxPopupWindowFloorSupervisor_material").jqxWindow({ 
			theme: theme,
			width: innerWidth-10,
			maxWidth: innerWidth,
			height: innerHeight,  
			maxHeight: innerHeight,  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.5,
			showCollapseButton: false 
		});

		$("#jqxPopupWindowRemoveQuantity").jqxWindow({ 
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

		$("#jqxPopupWindowAddNewJob").jqxWindow({ 
			theme: theme,
			width: '50%',
			height: '70%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false,
			cancelButton: $('#add_new_job_close')
		});

		$("#return-cancel").click(function () {
			reset_return_form();
			$("#jqxPopupWindowRemoveQuantity").jqxWindow('close');
		});

		$('#add_new_job').on('click', function(){
			openPopupWindow('jqxPopupWindowAddNewJob');
		});

		var jobDataSource = {
			url : '<?php echo site_url("admin/service_jobs/get_jobs"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'job_code', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'apply_tax', type: 'string' },
			{ name: 'mechanic_incentive', type: 'string' },
			{ name: 'job_description', type: 'string' },
			],
			async: false,
			cache: true,
			method: 'post',
		}

		jobAdapter = new $.jqx.dataAdapter(jobDataSource);

		$("#floor_addjob-job").jqxComboBox({
			theme: theme,
			width: '95%',
			// height: 30,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: jobAdapter,
			displayMember: "job_description",
			valueMember: "id",
			placeHolder: "Enter Job Code",
		});

		$('#floor_addjob-job').on('select', function (e){
			var args = e.args.item.originalItem;
			$('#floor_addjob-description').text(args.description);
			$('#floor_addjob-job_code').text(args.job_code);

		});

		$('#add_new_job_submit').on('click', function(){	

			var validationResult = function (isValid) {
				if (isValid) {

					$('#jqxPopupWindowAddNewJob').block({ 
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

					var data = getFormData('form-floor_addjob');
					$.post('<?php echo site_url("job_cards/job_card_detail/set_job_floorsupervisor"); ?>', { data }, function( result ){
						if( ! result.success) {
							alert('False');
							return;
						}
						var datarow = {
							'customer_voice'			: result.data.customer_voice,
							'floor_supervisor_voice'	: result.data.floor_supervisor_voice,
							'advisor_voice'				: result.data.advisor_voice,
							'job_id'					: result.data.job_id,
							'job'						: $('#floor_addjob-job_code').text(),
							'job_description'			: $('#floor_addjob-description').text(),
							'price'						: result.data.final_amount,
							'status'					: result.data.status,
							'closed_status'				: result.data.closed_status,
							'id'						: result.data.id
						};
						$("#jqxGridDetail").jqxGrid('addrow', null, datarow);
						$('#jqxPopupWindowAddNewJob').jqxWindow('close');
						$('#jqxPopupWindowAddNewJob').unblock();
					},'json');
				}
			};
			$('#form-floor_addjob').jqxValidator('validate', validationResult);
		});

		$('#form-floor_addjob').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			/*{ input: '#floor_addjob-floor_supervisor_voice', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#floor_addjob-floor_supervisor_voice').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },*/
			{ input: '#floor_addjob-job', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#floor_addjob-job').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#floor_addjob-price', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#floor_addjob-price').val();
				return (val == '' || val == null ) ? false: true;
			} },

			]
		});

		$('#form-return').jqxValidator({
			hintType: 'label',
			animationDuration: 500,
			rules: [
			{ input: '#return-remarks', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#return-remarks').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#return-quantity', message: 'Required', action: 'blur', 
			rule: function(input) {
				val = $('#return-quantity').val();
				return (val == '' || val == null || val == 0) ? false: true;
			} },
			{ input: '#return-quantity', message: 'More than Dispatched', action: 'blur', 
			rule: function(input) {
				val = $('#return-quantity').val();
				var dispatched = $('#return_dispatched_quantity').val();
				return (val > dispatched) ? false: true;
			} },
			{ input: '#return-quantity', message: 'Can not be negative.', action: 'blur', 
			rule: function(input) {
				val = $('#return-quantity').val();
				return (val <= 0) ? false: true;
			} },

			]
		});

		$("#return-submit").on('click', function () {

			var validationResult = function (isValid) {
				if (isValid) {
					save_returnParts();
				}
			};
			$('#form-return').jqxValidator('validate', validationResult);

		});

		$("#jqxPopupWindowAssignParts").jqxWindow({ 
			theme: theme,
			width: '45%',
			maxWidth: '75%',
			height: '40%',  
			maxHeight: '75%',  
			isModal: true, 
			autoOpen: false,
			modalOpacity: 0.7,
			showCollapseButton: false,
			cancelButton: $('#material_advice-cancel')
		});

		var advicePartSource = {
			url : '<?php echo site_url("job_cards/job_card_detail/get_advice_material"); ?>',
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
			{ name: 'display_member', type: 'string' },
			],
		}

		advicePartAdapter = new $.jqx.dataAdapter(advicePartSource,
		{
			formatData: function (data) {
				if ($("#advice_new_parts").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#advice_new_parts").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#advice_new_parts").jqxComboBox({
			width: '100%',
			height: 25,
			source: advicePartAdapter,
			remoteAutoComplete: true,
			// autoDropDownHeight: true, 
			selectedIndex: 0,
			displayMember: "display_member",
			valueMember: "name",
			renderer: function (index, label, value) {
				var item = advicePartAdapter.records[index];
				if (item != null) {
					var label = item.display_member;
					// var label = item.display_member; // + "(" + item.part_code + ", " + item.name + ")";
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = advicePartAdapter.records[index];
				if (item != null) {
					var label = item.name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				advicePartAdapter.dataBind();
			}
		});

		$('#material_advice-submit').on('click', function(){
			$('#jqxPopupWindowAssignParts').block({ 
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

			var formdata = getFormData('form-material_advice');

			$.post('<?php echo site_url('job_cards/job_card_detail/set_part_adviced')?>', formdata, function(result){
				if(! result.success) {
					alert(result.msg);
					$('#jqxPopupWindowAssignParts').unblock();
					return;
				}

				var floor_materialpartsDataSource =
				{
					datatype: "json",
					datafields: [
					{ name: 'id', type: 'number' },
					{ name: 'part_name', type: 'string'},
					{ name: 'part_id', type: 'number'},
					{ name: 'part_code', type: 'string'},
					{ name: 'quantity', type: 'number'},
					{ name: 'received_status', type: 'number'},
					{ name: 'received_quantity', type: 'number'},
					{ name: 'dispatched_quantity', type: 'number'},
					{ name: 'closed_status', type: 'string'},
					{ name: 'total_dispatched', type: 'number'},
					{ name: 'material_issued_by', type: 'string'},
					],
					url: '<?php echo site_url("job_cards/job_card_detail/get_parts_adviced"); ?>',
					pagesize: defaultPageSize,
					root: 'rows',
					data: {jobcard_group: formdata.jobcard_group},
				};
				var floor_materialpartsAdapter = new $.jqx.dataAdapter(floor_materialpartsDataSource);
				$('#jqxGridJobDetailPart').jqxGrid({source: floor_materialpartsAdapter });

				$('#advice_new_parts').val('');
				$('#material_advice-quantity').val(1);

				$('#jqxPopupWindowAssignParts').unblock();
			}, 'json');

		});

	});


function floor_supervisor(index) {
	var row =  $("#jqxGridJob_card").jqxGrid('getrowdata', index);
	var jobcard_group = row.jobcard_group;
	var vehicle_id = row.vehicle_id;

	if(row.closed_status == 1) {
		$('#openAssignParts').hide();
		$('#add_new_job').hide();
	} else {
		$('#openAssignParts').show();
		$('#add_new_job').show();
	}

	$('#return_jobcard_group').val(jobcard_group);
	$('#return_dealer_id').val(row.dealer_id);

	$("#jqxGridDetail").jqxGrid('clear');
	$("#jqxGridJobDetailPart").jqxGrid('clear');

	$.post("<?php echo site_url('job_cards/job_card_detail/get_jobs_json')?>", {jobcard_group:jobcard_group, vehicle_id: vehicle_id},function(data){
		$.each(data.rows, function(i,v){
			var datarow = {
				'customer_voice'			: v.customer_voice,
				'floor_supervisor_voice'	: v.floor_supervisor_voice,
				'advisor_voice'				: v.advisor_voice,
				'job_id'					: v.job_id,
				'job'						: v.job,
				'job_description'			: v.job_description,
				'price'						: v.final_amount,
				'status'					: v.status,
				'closed_status'				: v.closed_status,
				'id'						: v.id
			};
			$("#jqxGridDetail").jqxGrid('addrow', null, datarow);

		});
	},'json');

	var floor_materialpartsDataSource =
	{
		datatype: "json",
		datafields: [
		{ name: 'id', type: 'number' },
		{ name: 'part_name', type: 'string'},
		{ name: 'part_id', type: 'number'},
		{ name: 'part_code', type: 'string'},
		{ name: 'quantity', type: 'number'},
		{ name: 'received_status', type: 'number'},
		{ name: 'received_quantity', type: 'number'},
		{ name: 'dispatched_quantity', type: 'number'},
		{ name: 'closed_status', type: 'string'},
		{ name: 'return_quantity', type: 'number'},
		{ name: 'return_remarks', type: 'string'},
		{ name: 'total_dispatched', type: 'number'},
		{ name: 'material_issued_by', type: 'string'},
		{ name: 'lube_dispatched_qty', type: 'number'},
		
		],
		url: '<?php echo site_url("job_cards/job_card_detail/get_parts_adviced"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		data: {
			jobcard_group:jobcard_group 
		},
	};
	var floor_materialpartsAdapter = new $.jqx.dataAdapter(floor_materialpartsDataSource);
	$('#jqxGridJobDetailPart').jqxGrid({source: floor_materialpartsAdapter });

	openPopupWindow('jqxPopupWindowFloorSupervisor_material');
	$('#form-material_advice input[name=jobcard_group]').val(jobcard_group);
	$('.job-status').val(jobcard_group);


}
</script>

<script type="text/javascript">
	var job_card2DataSource =
	{
		datatype: "local",
		datafields: [
		{ name: 'job_id', type: 'number' },
		{ name: 'id', type: 'number' },
		{ name: 'job', type: 'string'},
		{ name: 'job_description', type: 'string'},
		{ name: 'min_price', type: 'number'},
		{ name: 'cost', type: 'number'},
		{ name: 'discount_amount', type: 'number'},
		{ name: 'discount_percentage', type: 'number'},
		{ name: 'final_amount', type: 'number'},
		{ name: 'status', type: 'string'},
		{ name: 'customer_voice', type: 'string'},
		{ name: 'advisor_voice', type: 'string'},
		{ name: 'status', type: 'string'},

		
		],
		// url: '<?php echo site_url("admin/job_cards/estimate_form_data_json"); ?>',
		// pagesize: defaultPageSize,
		// root: 'rows',
		// id : 'id',
		// cache: true,
		/*data: {
			 jobcard_group	: <?php // echo $jobcard_group?>,
			 vehicle_id		: <?php // echo $vehicle_id?>,
			},*/
			/*pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	// job_card2DataSource.totalrecords = data.total;
        },*/
	    // update the grid and send a request to the server.
	    /*filter: function () {
	    	$("#jqxGridDetail").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDetail").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }*/

	};
	/* for calculating discount */
	var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
		if (value < 20) {
			return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
		}
		else {
			return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
		}
	}

	var job_statusArray = ["Complete","Pending","Incomplete"];

	
	$("#jqxGridDetail").jqxGrid({
		// theme: theme,
		// width: '100%',
		// height: '300px',
		// source: job_card2DataSource,
		// altrows: true,
		// pageable: true,
		// sortable: true,
		// rowsheight: 30,
		// columnsheight:30,
		// showfilterrow: true,
		// filterable: true,
		// columnsresize: true,
		// autoshowfiltericon: true,
		// columnsreorder: true,
		// selectionmode: 'none',
		// virtualmode: true,
		// enableanimations: false,
		// pagesizeoptions: pagesizeoptions,
		// showaggregates: true,
		// showstatusbar: true,
		// editable : true,

		width: '100%',
		height: '300px',
		showtoolbar: true,
		altrows: true,
		editable : true,
		rowsheight: 30,
		showfilterrow: true,
		filterable:true,
		columnsresize: true,
		autoshowfiltericon: true,
		selectionmode: 'none',
		theme:theme,
		pageable: false,

		autorowheight: true,
		pageable: true,
		columns: [
		{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		// { text: 'ID', width: '10%', hidden: true, datafield:id},
		{ text: '<?php echo lang("customer_voice"); ?>',datafield: 'customer_voice',width: '20%',filterable: true,editable : false, renderer: gridColumnsRenderer, },
		{ text: '<?php echo lang("advisor_voice"); ?>',datafield: 'advisor_voice',width: '20%',filterable: true, editable : false, renderer: gridColumnsRenderer, },
		{
			text: '<?php echo lang("floor_supervisor_voice") ?>', datafield: 'floor_supervisor_voice', filterable: true, editable: true, renderer: gridColumnsRenderer, width: '20%',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var jobdata = $("#jqxGridDetail").jqxGrid('getrowdata',row);
				if (newvalue != oldvalue) {
					$.post("<?php echo site_url('job_cards/job_card_detail/update_floor_voice')?>", {row:jobdata, floor_voice: newvalue}, function(data){
						if(!data.success){
							alert('Error occur. Try again.');
						}
					},'json');
					
				};
			},cellbeginedit: function(row) {
				var jobdata = $("#jqxGridDetail").jqxGrid('getrowdata',row);
				if(jobdata.closed_status == 1) {
					return false;
				}
				return true;
			}
		},
		{ text: '<?php echo lang("job"); ?>',datafield: 'job',width: '5%',filterable: true,renderer: gridColumnsRenderer, editable : false, },
		{ text: '<?php echo lang("description"); ?>',datafield: 'job_description',filterable: true, editable : false, renderer: gridColumnsRenderer, width: '25%', },
		{ 
			text: '<?php echo lang("complete"); ?>',datafield: 'status', columntype: 'dropdownlist',width: '5%',filterable: true,renderer: gridColumnsRenderer,
			createeditor: function (row, cellvalue, editor, cellText, width, height) {
				// construct the editor. 
				job_statusDropdown = editor.jqxDropDownList({
					source: job_statusArray, displayMember: 'status', valueMember: 'status', width: width, height: height, autoDropDownHeight: true,
					selectionRenderer: function () {
						// if($('#service_type').val() != 4)
						// {
						// 	warranty_dropdown.jqxDropDownList('disableItem','FOC');
						// }
						return "<span style='top:4px; position: relative;'>Please Choose:</span>";
					}
				});
			},
			geteditorvalue: function (row, cellvalue, editor) {
				return editor.val();
			},
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var jobdata = $("#jqxGridDetail").jqxGrid('getrowdata',row);
				if (newvalue != oldvalue) {
					$.post("<?php echo site_url('job_cards/job_card_detail/job_status_change')?>", {row:jobdata, status: newvalue}, function(data){
						if(!data.success){
							alert('Error occur. Try again.');
						}
					},'json');
					
				};
			},cellbeginedit: function(row) {
				var jobdata = $("#jqxGridDetail").jqxGrid('getrowdata',row);
				if(jobdata.closed_status == 1) {
					return false;
				}
				return true;
			}
		},
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	var cellclassname =  function (row, column, value, data) 
	{
		if (data.quantity == 0) {
			return 'cls-yellow';
		}
		
	}

	$("#jqxGridJobDetailPart").jqxGrid({
		width: '100%',
		height: '600px',
		showtoolbar: true,
		altrows: true,
		editable : true,
		rowsheight: 30,
		showfilterrow: true,
		filterable:true,
		columnsresize: true,
		autoshowfiltericon: true,
		selectionmode: 'none',
		theme:theme,
		pageable: false,
		// editmode : 'click',
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
			container.append(' <button class="btn btn-xs btn-flat btn-default" onclick="$(\'#jqxGridJobDetailPart\').jqxGrid(\'updatebounddata\'); ">Refresh</button> ');
		},
		columns: [
		{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false, cellclassname:cellclassname  },
		{
			text: 'Action', width: '5%', pinned: true, exportable: false, editable : false, cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, filterable: false, cellsrenderer: function(index,b,c,d,e,rows) {
				// console.log(rows);
				var button = '';
				if(rows.lube_dispatched_qty){

				}else{
					if(rows.closed_status == 0) {
						if(rows.dispatched_quantity == 0 ) {
							button += '<a href="javascript:void(0)" class="" onclick="delete_part_adviced('+ index +')" title="Delete" ><i class="fa fa-trash"> </i></a>&nbsp';
						}
						if( rows.received_status !== 1){
							button += '<a href="javascript:void(0)" class="" onclick="return_part('+ index +')"  title="Return Parts"><i class="fa fa-reply"> </i></a>';
						}
					}
					
				}
				return '<div style="text-align: left; margin-top: 8px; padding: 0px 5px;">' + button +'</div>';
			}, cellclassname:cellclassname
		},

		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable : false, cellclassname:cellclassname},
		/*{
			text: '<?php echo lang("send_request")?>', datafield: 'request_status', width: '10%', filterable: false, renderer: gridColumnsRenderer, columntype:'checkbox', cellbeginedit: false,
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var v

				ar button return_part'<a href="javascript:void(0)" class="" onclick="delete_part_adviced('+ index +')" ><i class="fa fa-trash"> </i></a>&nbsp';
				 button += '<a href="javascript:void(0)" class="" onclick="return_part('+ index +')" ><i class="fa fa-trash"> </i></a>';
				return button;
			}
		},

		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable : false,},
		/*{
			text: '<?php echo lang("send_request")?>', datafield: 'request_status', width: '10%', filterable: false, renderer: gridColumnsRenderer, columntype:'checkbox', cellbeginedit: false,
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);
				if (newvalue != oldvalue) {
					$.post("<?php echo site_url('job_cards/job_card_detail/part_request_status')?>", {partdata:partdata, status:newvalue}, function(data){
						if(!data.success){
							alert('Error occur. Try again.');
						}
					},'json');
				};
			}
		},*/
		{
			text: '<?php echo 'Material Issued By' ?>', datafield: 'material_issued_by', width: '10%', filterable: true, renderer: gridColumnsRenderer, editable : false, cellclassname:cellclassname
		},{
			text: '<?php echo lang('quantity') ?>', datafield: 'quantity', width: '10%', filterable: true, renderer: gridColumnsRenderer, editable : false, cellclassname:cellclassname
		},
		{
			text: '<?php echo lang('dispatched_quantity') ?>', datafield: 'dispatched_quantity', width: '10%', filterable: true, renderer: gridColumnsRenderer, editable : false, cellclassname:cellclassname , cellsrenderer: function (index,b,c,d,e,rows) {
						var row =  $("#jqxGridJobDetailPart").jqxGrid('getrowdata', index);

				var e = '';
					if(row.lube_dispatched_qty) {
						e = row.lube_dispatched_qty;
					}else{
						e = row.dispatched_quantity;
					}
						// var e = row.display_quantity * row.mrp_price;
						return '<div style="margin-top: 8px; margin-left:5px;">' + e + '</div>'; 
						// return '<div style="margin-top: 8px; margin-left:5px;">' + e + '</div>'; 
					// return '';
				}
		},
		{
			text: '<?php echo lang('received_quantity') ?>', datafield: 'received_quantity', width: '10%', filterable: true, renderer: gridColumnsRenderer, columntype: 'numberinput',validation: function( cell, value ) {
				var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',cell.row);

				if(!( !isNaN(parseFloat(value)) && isFinite(value))){
					return { result: false, message: "Invalid Number" };
				}

				if(value > partdata.dispatched_quantity || value < 0) {
					return { result: false, message: "Cannot accept quantity greater than provided." };
				}
				return true;
			},  cellvaluechanging: function(row, datafield, columntype, oldvalue, newvalue) {
				if(newvalue != oldvalue) {
					var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);

					if(newvalue <= partdata.dispatched_quantity && newvalue > 0) {
						$.post("<?php echo site_url('job_cards/job_card_detail/set_received_quantity')?>", {partdata:partdata, newvalue:newvalue}, function(data){
							if(!data.success){
								alert('Error occur. Try again.');
							}
						},'json');
					}
				}
			},cellbeginedit: function(row) {
				var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);
				if(partdata.closed_status == 1) {
					return false;
				}
				return true;
			}, cellclassname:cellclassname
		},
		{
			text: '<?php echo lang("receive")?>', datafield: 'received_status', width: '10%', filterable: false, renderer: gridColumnsRenderer, columntype:'checkbox',
			cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
				var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);

				if(partdata.received_status == 0 ) {
					if(partdata.dispatched_quantity < partdata.received_quantity ) {
						alert("Received quantity greater than dispatched.");
						return false;
					}
				}

				if (newvalue != oldvalue) {
					$.post("<?php echo site_url('job_cards/job_card_detail/part_recived_status')?>", {partdata:partdata, status:newvalue}, function(data){
						if(!data.success){
							alert('Error occur. Try again.');
						}
					},'json');
				};
			}, cellbeginedit: function(row) {
				var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);
				if(partdata.closed_status == 1) {
					return false;
				}
				return true;
			}, cellclassname:cellclassname
		},

		],
		rendergridrows: function (result) {
			return result.data;
		},
	});

function delete_part_adviced(index) {
	var row = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',index);
	var del_id = $("#jqxGridJobDetailPart").jqxGrid('getrowid',index);

	$.post("<?php echo site_url('job_cards/job_card_detail/delete_part_adviced')?>", {row:row}, function(result){
		if(result.success){
			$("#jqxGridJobDetailPart").jqxGrid('deleterow', del_id);
		} else {
			alert('Error occur. Try again.');
		}
	},'json');

}

function return_part(index) 
{
	var row = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',index);
	console.log(row);
	$('#return-quantity').val(row.return_quantity);
	$('#return-remarks').val(row.return_remarks);
	$('#return_part_name').val(row.part_name);
	$('#return_dispatched_quantity').val(row.dispatched_quantity);
	$('#return_floor_id').val(row.id);
	$('#return_total_dispatched').val(row.total_dispatched);

	openPopupWindow('jqxPopupWindowRemoveQuantity');
}

function save_returnParts()
{
	var data = $("#form-return").serialize();
	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/job_cards/save_part_return"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				$('#jqxPopupWindowRemoveQuantity').jqxWindow('close');
				$('#jqxGridJobDetailPart').jqxGrid('updatebounddata');

				reset_return_form();
			}
		}
	});

}

function reset_return_form()
{
	$('#return-quantity').val('');
}
</script>