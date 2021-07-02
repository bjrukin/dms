<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('warranty_claims'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('warranty_claims'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridWarranty_claimToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridWarranty_claimInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridWarranty_claimFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridWarranty_claim"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowWarranty_claim">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<div class="col-md-12">
			<?php echo form_open('', array('id' =>'form-warranty_claims', 'onsubmit' => 'return false')); ?>
			<input type = "hidden" name = "id" id = "warranty_claims_id"/>
			<div class="row">
				<div class="col-md-2"> <label for='date'><?php echo lang('date')?></label> </div>
				<div class="col-md-2"><input type="date" name="date" class="form-control input-sm" id='date'> </div>
				<div class="col-md-2"><label for='claim_on'><?php echo lang('claim_on')?></label></div>
				<div class="col-md-3">
					<label class="radio-inline"><input type="radio" name="claim_on" value="JOBCARD"  checked>Job Card</label>
					<label class="radio-inline"><input type="radio" name="claim_on" value="SALEINVOICE" >Sale Invoice</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='claim_number'><?php echo lang('claim_number')?></label></div>
				<div class="col-md-2">

					<div class="input-group">
						<input id="claim_number" type="text" name="claim_number" class="form-control input-sm" readonly>
						<!-- <div class="input-group-addon"><i class="fa fa-search" onclick=""></i></div> -->
					</div>

				</div>
				<div class="col-md-2"><label for='job_no'><?php echo lang('job_no')?></label></div>
				<div class="col-md-2">
					<div class="input-group">
						<input type="text" name="job_no" class="form-control input-sm" id="job_no">
						<div class="input-group-addon"><i class="fa fa-search" onclick="get_from_jobno()"></i></div>
					</div>
				</div>
				<div class="col-md-2"><label for='job_date'><?php echo lang('job_date')?></label></div>
				<div class="col-md-2"><input type="date" name="job_date" class="form-control input-sm" id="job_date"></div>
			</div>
			<div class="row">
				<div class="col-md-2"> <?php echo lang('customer_name'); ?> </div>
				<div class="col-md-4"><input type="text" name="" class="form-control input-sm" id="customer_name" readonly></div>

				<div class="col-md-2"> <label for='manufacturer_id'><?php echo lang('manufacturer_id')?></label></div>
				<div class="col-md-4"><div id="manufacturer_id"  name="manufacturer_id" ></div> </div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="warranty_claim_list"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><label for='remarks'><?php echo lang('remarks')?></label></div>
				<div class="col-md-10"><input type="text" name="remarks" class="form-control" id='remarks'></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="btn-group btn-group-sm pull-right">

						<button type="button" class="btn btn-default btn-flat" onclick="reset_form_warranty_claims()"><?php echo lang('reset'); ?></button>
						<button type="button" class="btn btn-success btn-flat" id="jqxWarranty_claimSubmitButton"><?php echo lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-flat" id="jqxWarranty_claimCancelButton"><?php echo lang('general_cancel'); ?></button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">
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

		var warranty_claimsDataSource =
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
			{ name: 'date', type: 'string' },
			{ name: 'claim_number', type: 'number' },
			{ name: 'claim_on', type: 'string' },
			{ name: 'job_no', type: 'number' },
			{ name: 'job_date', type: 'string' },
			{ name: 'manufacturer_id', type: 'number' },
			{ name: 'remarks', type: 'string' },
			
			],
			url: '<?php echo site_url("admin/warranty_claims/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	warranty_claimsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridWarranty_claim").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridWarranty_claim").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridWarranty_claim").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: warranty_claimsDataSource,
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
			container.append($('#jqxGridWarranty_claimToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{
			text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
			cellsrenderer: function (index) {
				var e = '<a href="javascript:void(0)" onclick="editWarranty_claimRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
				return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
			}
		},
		{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer, hidden:true },
		{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("claim_number"); ?>',datafield: 'claim_number',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("claim_on"); ?>',datafield: 'claim_on',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("job_no"); ?>',datafield: 'job_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("job_date"); ?>',datafield: 'job_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("manufacturer_id"); ?>',datafield: 'manufacturer_id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridWarranty_claim").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridWarranty_claimFilterClear', function () { 
		$('#jqxGridWarranty_claim').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridWarranty_claimInsert', function () { 
		$('#warranty_claim_list').jqxGrid('updatebounddata');
		$.post('<?php echo site_url('warranty_claims/get_claim_number'); ?>', function(id){
			$('#claim_number').val(id);
		});
		openPopupWindow('jqxPopupWindowWarranty_claim', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowWarranty_claim").jqxWindow({ 
		theme: theme,
		width: '75%',
		maxWidth: '75%',
		height: '75%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});

	$("#jqxPopupWindowWarranty_claim").on('close', function () {
		reset_form_warranty_claims();
	});

	$("#jqxWarranty_claimCancelButton").on('click', function () {
		reset_form_warranty_claims();
		$('#jqxPopupWindowWarranty_claim').jqxWindow('close');
	});

    /*$('#form-warranty_claims').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [

			{ input: '#date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#claim_number', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#claim_number').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#claim_on', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#claim_on').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#job_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#job_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#job_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#job_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#manufacturer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#manufacturer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remarks', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remarks').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxWarranty_claimSubmitButton").on('click', function () {
    	saveWarranty_claimRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   saveWarranty_claimRecord();
                }
            };
        $('#form-warranty_claims').jqxValidator('validate', validationResult);
        */
    });

    var manufactureDataSource = {
    	url : '<?php echo site_url("admin/warranty_claims/get_manufacturer_json"); ?>',
    	datatype: 'json',
    	datafields: [
    	{ name: 'id', type: 'number' },
    	{ name: 'name', type: 'string' },
    	],
    	async: false,
    	cache: true
    }

    manufactureAdapter = new $.jqx.dataAdapter(manufactureDataSource);

    $("#manufacturer_id").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: manufactureAdapter,
    	displayMember: "name",
    	valueMember: "id",
    	placeHolder: "Select Manufacture"
    });
});

function editWarranty_claimRecord(index){
	$('#warranty_claim_list').jqxGrid('updatebounddata');
	var row =  $("#jqxGridWarranty_claim").jqxGrid('getrowdata', index);
	console.log(row);
	if (row) {
		$('#warranty_claims_id').val(row.id);
		$('#date').val(row.date);
		$('#claim_number').val(row.claim_number);
		$('#claim_on').val(row.claim_on);
		$('#job_no').val(row.job_no);
		$('#job_date').val(row.job_date);
		$('#manufacturer_id').jqxComboBox('val', row.manufacturer_id);
		$('#remarks').val(row.remarks);

		$.post('<?php echo site_url('admin/warranty_claims/get_warranty_claim_list'); ?>', {claim_id: row.id}, function(result){
			$.each(result.rows, function(i,v){
				var datarow = {
					'id'				: v.id,
					'selected'			: v.selected,
					'part_id'			: v.part_id,
					'part_code'			: v.part_code,
					'part_name'			: v.part_name,
					'quantity'			: v.quantity,
					'remarks'			: v.remarks
				};

				$('#warranty_claim_list').jqxGrid('addrow', null, datarow);
			});
		}, 'JSON');
		
		openPopupWindow('jqxPopupWindowWarranty_claim', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
	}
}

function saveWarranty_claimRecord(){
	var data = getFormData("form-warranty_claims");
	var warranty_parts = ($("#warranty_claim_list").jqxGrid('getrows'));
	
	$('#jqxPopupWindowWarranty_claim').block({ 
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
		url: '<?php echo site_url("admin/warranty_claims/save"); ?>',
		data: {
			data: data,
			warranty_parts
		},
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_warranty_claims();
				$('#jqxGridWarranty_claim').jqxGrid('updatebounddata');
				$('#jqxPopupWindowWarranty_claim').jqxWindow('close');
			} else {
				alert(result.msg);
			}
			$('#jqxPopupWindowWarranty_claim').unblock();
		}
	});
}

function reset_form_warranty_claims(){
	$('#warranty_claims_id').val('');
	$('#form-warranty_claims')[0].reset();
	$('#manufacturer_id').jqxComboBox('clearSelection');
	$("#warranty_claim_list").jqxGrid('updatebounddata');
}
</script>

<script type="text/javascript">
	$(function(){
		var warranty_claim_listDataSource =
		{
			datatype: "local",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'created_by', type: 'number' },
			{ name: 'updated_by', type: 'number' },
			{ name: 'deleted_by', type: 'number' },
			{ name: 'created_at', type: 'string' },
			{ name: 'updated_at', type: 'string' },
			{ name: 'deleted_at', type: 'string' },

			{ name: 'selected', type: 'string' },
			{ name: 'part_id', type: 'number' },
			{ name: 'part_code', type: 'number' },
			{ name: 'quantity', type: 'number' },
			{ name: 'remarks', type: 'string' },
			
			],
			// url: '<?php echo site_url("admin/warranty_claims/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	warranty_claim_listDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	// $("#warranty_claim_list").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	// $("#warranty_claim_list").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};

	$("#warranty_claim_list").jqxGrid({
		theme: theme,
		width: '100%',
		height: '300px',
		source: warranty_claim_listDataSource,
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
		// showtoolbar: true,
		editable: true,
		rendertoolbar: function (toolbar) {
			var container = $("<div style='margin: 5px; height:50px'></div>");
			// container.append($('#jqxGridWarranty_claimToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		{ text: '<?php echo lang("id"); ?>',datafield: 'id',width: 10,filterable: true,renderer: gridColumnsRenderer, hidden:true },
		{ text: '<?php echo lang("selected"); ?>', datafield: 'selected', columntype: 'checkbox', width: 67 },
		// { text: '<?php echo ("part_id"); ?>',datafield: 'part_id',width: 150,filterable: true,renderer: gridColumnsRenderer, hidden: true },
		{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
		{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',filterable: true,renderer: gridColumnsRenderer, editable: false },
		{ text: '<?php echo lang("quantity"); ?>',datafield: 'quantity',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false },
		{ text: '<?php echo lang("remarks"); ?>',datafield: 'remarks',filterable: true,renderer: gridColumnsRenderer },

		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	

});

	function get_from_jobno() {
		var job_no = $('#job_no').val();

		$.post('<?php echo site_url('admin/warranty_claims/get_from_job'); ?>', {job_no: job_no}, function(result){
			if( result.success ) {

				if(result.rows[0] != null) {
					$('#warranty_claim_list').jqxGrid('clear');

					$.each(result.rows, function(i,v) {
						var datarow = {
							'selected'			: true,
							'part_id'			: v.part_id,
							'part_code'			: v.part_code,
							'part_name'			: v.part_name,
							'quantity'			: v.quantity,
							'remarks'			: ''
						};

						$('#warranty_claim_list').jqxGrid('addrow', null, datarow);
					});
					/*End Each*/

					$('#customer_name').val(result.user.customer_name);
					$('#job_date').val(result.user.job_card_issue_date);


				} else {
					alert("No warranty claim found!");
				}
			} else {
				alert(result.msg);
			}

		},'JSON');
	}
</script>