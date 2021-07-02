<div id="jqxPopupWindowCustomer_test_drive">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="customer_test_drives_window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-customer_test_drives', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "customer_test_drives_id"/>
        	<input type = "hidden" name = "customer_id" id = "customer_test_drives_customer_id" value="<?php echo $customer_info->id;?>"/>
            <table class="form-table">
				<!-- <tr>
					<td valign="top">
						<label for='td_date_en'><?php echo lang('td_date_en')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="customers" data-arg3="jqxPopupWindowCustomer" data-arg4="td_date_en" data-arg5="td_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='td_date_en' class='date_box' name='td_date_en'></div>
					</td>
					<td>
						<label for='td_date_np'><?php echo lang('td_date_np')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="customers" data-arg3="jqxPopupWindowCustomer" data-arg4="td_date_np" data-arg5="td_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="td_date_np" id="td_date_np" placeholder="YYYY-MM-DD" class="text_input"/></td>
				</tr> -->
				<?php /* ?>
				<tr>
					<td><label for='td_time'><?php echo lang('td_time')?><span class='mandatory'>*</span></label></td>
					<td><div id='td_time' name='td_time'></div></td>
				</tr>
				<?php */ ?>
				<tr>
					<td class="executive-selection"><label for='executive_id'><?php echo lang('executive_id')?><span class='mandatory'>*</span></label></td>
					<td class="executive-selection"><div id='td_executive_id' name='executive_id'></div></td>
				</tr>
				<tr>
					<td><label for='vehicle_id'><?php echo lang('vehicle_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='vehicle_id_test' name='vehicle_id'></div></td>
				
					<td><label for='variant_id'><?php echo lang('variant_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='variant_id_test' name='variant_id'></div></td>
				</tr>
				<tr>
					<td><label for='chassis_no'><?php echo lang('chassis_no')?><span class='mandatory'>*</span></label></td>
					<td><input id='chassis_no_test' name='chassis_no_test' class="text_input" onkeyup="this.value = this.value.toUpperCase();"></td>
				</tr>
				<?php /* ?>
				<tr>
					<td><label for='mileage_start'><?php echo lang('mileage_start')?><span class='mandatory'>*</span></label></td>
					<td><div id='mileage_start' class='number_general' name='mileage_start'></div></td>
				
					<td><label for='mileage_end'><?php echo lang('mileage_end')?><span class='mandatory'>*</span></label></td>
					<td><div id='mileage_end' class='number_general' name='mileage_end' ></div></td>
				</tr>
				<?php */ ?>
				<tr>
					<td><label for='document'><?php echo lang('document')?></label></td>
					<!-- <label id="image_upload_name" style="display:none"></label> -->
					<input type="hidden" id="document" name="document">

					<td>
						<label id="image_upload_name" style="display:none"></label>
						<input id="image" class='text_input' style="display:none"/>
						<input type="file" id="image_upload" name="userfile" style="display:block"/>
					</td>
				</tr>

				<tr>
					<td><label for='duration'><?php echo lang('duration')?><span class='mandatory'>*</span></label></td>
					<td><div id='duration' class='number_general' name='duration' ></div></td>

					<td><label for='td_location'><?php echo lang('td_location')?><span class='mandatory'>*</span></label></td>
					<td><div id='td_location' name='td_location'></div></td>
				</tr>

				<tr>
					<td><label for="fuel">Fuel:<span class='mandatory'>*</span></label></td>
					<td><input type="text" class='text_input'id='fuel' name="fuel" placeholder="Enter quantity in Ltrs."></td>
				<!-- </tr>
				<tr>
                    <td> <label><span>Choose Location</span><span class='mandatory'>*</span></label> </td>
                    <td> <div name="fuel_location" id="fuel_location"></div></td> -->
                    <td> <label><span>Month:</span><span class='mandatory'>*</span></label> </td>
                    <td> <div name="month" id="month"></div></td>
                </tr>
                <tr>
                    <td> <label><span>Opening Kms:</span><span class='mandatory'>*</span></label> </td>
                    <td> <div name="opening_kms" class="number_general" id="opening_kms" onchange="calculate_total_kms()"></div></td>
                    <td> <label><span>Closing Kms:</span><span class='mandatory'>*</span></label> </td>
                    <td> <div name="closing_kms" class="number_general" id="closing_kms" onchange="calculate_total_kms()"></div></td>
                </tr>
                <tr>
                    <td> <label><span>Kms:</span></label> </td>
                    <td> <div name="kms" class="number_general" id="kms"></div></td>
                    <td> <label><span>Report By:</span><span class='mandatory'>*</span></label> </td>
                    <td> <input type="text" name="reported_by" class="text_input" id="reported_by"></td>
                </tr>

                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCustomer_test_driveSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCustomer_test_driveCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<div id='jqxGridCustomer_test_driveToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCustomer_test_driveInsert"><?php echo lang('general_create'); ?></button>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomer_test_driveFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridCustomer_test_drive"></div>
<div id="viewImageTestdriveModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-body">
        	<div id="imgDiv"></div>
      	</div>
    </div>

  </div>
</div>
<script language="javascript" type="text/javascript">

var customer_test_drives = function() {

	//$("#td_time").jqxDateTimeInput({ theme: theme, width: '190', height: '25', formatString: 'T', showTimeButton: true, showCalendarButton: false});

	$('.convert-date').on('click', function(){
		var arg1 = this.getAttribute("data-arg1"),
			arg2 = this.getAttribute("data-arg2"),
			arg3 = this.getAttribute("data-arg3"),
			arg4 = this.getAttribute("data-arg4"),
			arg5 = this.getAttribute("data-arg5");

			window[arg1](arg2,arg3,arg4,arg5);
	});

	//executives
	var executiveDataSource = {
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

	var executiveDataAdapter = new $.jqx.dataAdapter(executiveDataSource);

	$("#td_executive_id").jqxComboBox({
	    theme: theme,
	    width: 195,
	    height: 25,
	    selectionMode: 'dropDownList',
	    autoComplete: true,
	    searchMode: 'containsignorecase',
	    source: executiveDataAdapter,
	    displayMember: "name",
	    valueMember: "id",
	});

	//mst_vehicles
    masterDataSource.data = {table_name: 'mst_vehicles'};

    vehicleAdapter = new $.jqx.dataAdapter(masterDataSource);

    $("#vehicle_id_test").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: vehicleAdapter,
        displayMember: "name",
        valueMember: "id",
    });

    //mst_variants
    $("#vehicle_id_test").select('bind', function (event) {
	    vehicle_id = $("#vehicle_id_test").jqxComboBox('val');
	    
	    var variantDataSource  = {
	        url : '<?php echo site_url("admin/customers/get_variants_combo_json"); ?>',
	        datatype: 'json',
	        datafields: [
	            { name: 'variant_id', type: 'number' },
	            { name: 'variant_name', type: 'string' },
	        ],
	        data: {
	            vehicle_id: vehicle_id
	        },
	        async: false,
	        cache: true
	    }

	    variantDataAdapter = new $.jqx.dataAdapter(variantDataSource);
	    
	    $("#variant_id_test").jqxComboBox({
	        theme: theme,
	        width: 195,
	        height: 25,
	        selectionMode: 'dropDownList',
	        autoComplete: true,
	        searchMode: 'containsignorecase',
	        source: variantDataAdapter,
	        displayMember: "variant_name",
	        valueMember: "variant_id",
	    });

	});

	// for chassis_no
    $("#variant_id_test").select('bind', function (event) {
	    var vehicle_id = $("#vehicle_id_test").jqxComboBox('val');
	    var variant_id = $("#variant_id_test").jqxComboBox('val');
	    
	    var variantDataSource  = {
	        url : '<?php echo site_url("admin/customers/get_stock_combo_json"); ?>',
	        datatype: 'json',
	        datafields: [
	            { name: 'chass_no', type: 'string' },
	        ],
	        data: {
	            vehicle_id: vehicle_id,
	            variant_id: variant_id,
	        },
	        async: false,
	        cache: true
	    }

	    /*chassisDataAdapter = new $.jqx.dataAdapter(variantDataSource);
	    
	    $("#chassis_no_test").jqxComboBox({
	        theme: theme,
	        width: 195,
	        height: 25,
	        selectionMode: 'dropDownList',
	        autoComplete: true,
	        searchMode: 'containsignorecase',
	        source: chassisDataAdapter,
	        displayMember: "chass_no",
	        valueMember: "chass_no",
	    });*/

	});

	 //td_location
	$("#td_location").jqxComboBox({
    	theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: array_test_drive_location,
        displayMember: "name",
        valueMember: "id",
		selectedIndex:0
    });

	var customer_test_drivesDataSource =
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
			{ name: 'td_date_en', type: 'date' },
			{ name: 'td_date_np', type: 'string' },
			{ name: 'td_time', type: 'string' },
			{ name: 'executive_id', type: 'number' },
			{ name: 'vehicle_id', type: 'number' },
			{ name: 'variant_id', type: 'number' },
			{ name: 'mileage_start', type: 'string' },
			{ name: 'mileage_end', type: 'string' },
			{ name: 'duration', type: 'string' },
			{ name: 'td_location', type: 'string' },
			{ name: 'executive_name', type: 'string' },
			{ name: 'vehicle_name', type: 'string' },
			{ name: 'variant_name', type: 'string' },
			{ name: 'test_drive_document', type: 'string' },
			{ name: 'opening_kms', type: 'string' },
			{ name: 'closing_kms', type: 'string' },
			{ name: 'kms', type: 'string' },
			{ name: 'fuel', type: 'string' },
			// { name: 'fuel_location', type: 'string' },
			{ name: 'reported_by', type: 'string' },
			{ name: 'month', type: 'string' },
			{ name: 'chassis_no_test', type: 'chassis_no_test' },
			
        ],
		url: '<?php echo site_url("admin/customers/customer_test_drives_json"); ?>',
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
        	customer_test_drivesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCustomer_test_drive").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCustomer_test_drive").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCustomer_test_drive").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: customer_test_drivesDataSource,
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
			container.append($('#jqxGridCustomer_test_driveToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var rows = $("#jqxGridCustomer_test_drive").jqxGrid('getrowdata', index);
					var e =  '';
					if(rows.test_drive_document != '' && rows.test_drive_document != null){
						e += '<a href="javascript:void(0)" onclick="showImageTestDrive(' + index + '); return false;" title="View Image"><i class="fa fa-eye"></i></a>&nbsp;';
						e += '<a href="<?php echo base_url('uploads/customer_doc/') ?>/'+rows.test_drive_document+'"  title="Download" download><i class="fa fa-download "></i></a>&nbsp;';
						
					}
					e += '  <a href="javascript:void(0)" onclick="editCustomer_test_driveRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("td_date_en"); ?>',datafield: 'td_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("td_date_np"); ?>',datafield: 'td_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			//{ text: '<?php echo lang("td_time"); ?>',datafield: 'td_time',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("executive_id"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("vehicle_id"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("variant_id"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("chassis_no"); ?>',datafield: 'chassis_no_test',width: 150,filterable: true,renderer: gridColumnsRenderer },
			//{ text: '<?php echo lang("mileage_start"); ?>',datafield: 'mileage_start',width: 150,filterable: true,renderer: gridColumnsRenderer },
			//{ text: '<?php echo lang("mileage_end"); ?>',datafield: 'mileage_end',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("duration"); ?>',datafield: 'duration',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("td_location"); ?>',datafield: 'td_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Opening Kms',datafield: 'opening_kms',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Closing Kms',datafield: 'closing_kms',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Kms',datafield: 'kms',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Fuel',datafield: 'fuel',width: 150,filterable: true,renderer: gridColumnsRenderer },
			// { text: 'Fuel Location',datafield: 'fuel_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Month',datafield: 'month',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Reported By',datafield: 'reported_by',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCustomer_test_drive").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCustomer_test_driveFilterClear', function () { 
		$('#jqxGridCustomer_test_drive').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCustomer_test_driveInsert', function () { 
        $('#customer_test_drives_window_poptup_title').html('<?php echo lang("general_add")  . "&nbsp;" .  lang("customer_test_drives"); ?>');
        $("#vehicle_id_test").jqxComboBox('val', '<?php echo $customer_info->vehicle_id;?>');
     	$("#variant_id_test").jqxComboBox('val', '<?php echo $customer_info->variant_id;?>');
     	$("#td_executive_id").jqxComboBox('val', '<?php echo $customer_info->executive_id;?>');

     	// uploadReady();
		$('#image_upload').show();
		$('#image_upload_name').hide();
		$('#document').val('');

     	<?php if( !control('Executive Selection', FALSE)):?>
		$('.executive-selection').hide();
		$('#td_executive_id').jqxComboBox('val','<?php echo $this->session->userdata("employee")["employee_id"]; ?>');
		<?php endif;?>

		openPopupWindow('jqxPopupWindowCustomer_test_drive', 'N/A');
    });

	// initialize the popup window
    $("#jqxPopupWindowCustomer_test_drive").jqxWindow({ 
        theme: theme,
        width: 800,
        maxWidth: 800,
        height: 440,  
        maxHeight: 440,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowCustomer_test_drive").on('close', function () {
        reset_form_customer_test_drives();
    });

    $("#jqxCustomer_test_driveCancelButton").on('click', function () {
        reset_form_customer_test_drives();
        $('#jqxPopupWindowCustomer_test_drive').jqxWindow('close');
    });

    $('#form-customer_test_drives').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			// { input: '#td_date_np', message: 'Required', action: 'blur', 
			// 	rule: function(input) {
			// 		val = $('#td_date_np').val();
			// 		return (val == '' || val == null || val == 0) ? false: true;
			// 	}
			// },
			<?php /* ?>
			{ input: '#td_time', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#td_time').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			<?php */ ?>
			{ input: '#td_executive_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#td_executive_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vehicle_id_test', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vehicle_id_test').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#variant_id_test', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#variant_id_test').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#chassis_no_test', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#chassis_no_test').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#opening_kms', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#opening_kms').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#fuel', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#fuel').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#closing_kms', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#closing_kms').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#reported_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#reported_by').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#month', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#month').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			// { input: '#fuel_location', message: 'Required', action: 'blur', 
			// 	rule: function(input) {
			// 		val = $('#fuel_location').val();
			// 		return (val == '' || val == null || val == 0) ? false: true;
			// 	}
			// },

			<?php /* ?>
			{ input: '#mileage_start', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#mileage_start').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#mileage_end', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#mileage_end').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#mileage_end', message: 'Start kms is greater then End kms', action: 'blur', 
				rule: function(input) {
					start = $('#mileage_start').jqxNumberInput('val');
					end   = $('#mileage_end').jqxNumberInput('val');
					return (start > end) ? false: true;
				}
			},
			<?php */ ?>

			{ input: '#duration', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#duration').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#td_location', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#td_location').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxCustomer_test_driveSubmitButton").on('click', function () {

    	var selected = document.getElementById("document");
		var fileName = selected.value;
		
		if(!fileName){
		
			alert("Please upload a file");
			return false;

		}
		
       
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCustomer_test_driveRecord();
                }
            };
        $('#form-customer_test_drives').jqxValidator('validate', validationResult);
        
    });

    // var fuel_location = ["NAXAL", "DHOBIGHAT", "THAPATHALI"];

    //  	$("#fuel_location").jqxComboBox({
    //          theme: theme,
    //          width: 195,
    //          height: 25,
    //          placeHolder: "Select Location",
    //          selectionMode: 'dropDownList',
    //          autoComplete: true,
    //          searchMode: 'containsignorecase',
    //          source: fuel_location           
    //  	});

 	var nepali_monthDataSource  = {
        url : '<?php echo site_url("admin/dealer_orders/get_nepali_month_list"); ?>',
        datatype: 'json',
        datafields: [
        { name: 'id', type: 'number' },
        { name: 'name', type: 'string' },
        ],
        async: false,
        cache: true
    }

    nepali_monthDataAdapter = new $.jqx.dataAdapter(nepali_monthDataSource);

    $("#month").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        placeHolder: "Select Month",
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: nepali_monthDataAdapter,
        displayMember: "name",
        valueMember: "name",
    });
};

function editCustomer_test_driveRecord(index){
    var row =  $("#jqxGridCustomer_test_drive").jqxGrid('getrowdata', index);
 	// uploadReady();

    if(row.document){
		$('#image_upload').hide();
		$('#document').val(row.document);
		$('#image_upload_name').html('<img src="<?php echo site_url()?>uploads/customer_doc/'+row.document+'" height="100px" width="100px"> <buttton type="button" onclick="remove_doc()" class="btn btn-danger"><i class="fa fa-trash"></i></button>');
		$('#image_upload_name').show();
		$('#change-image').show();
	}else{
		$('#image_upload').show();
		$('#image_upload_name').hide();
		$('#document').val('');
	}

  	if (row) {
  		$('#customer_test_drives_id').val(row.id);
  //       $('#td_date_en').jqxDateTimeInput('setDate', row.td_date_en);
		// $('#td_date_np').val(row.td_date_np);
		//$("#td_time").jqxDateTimeInput('val', row.td_time);
		$('#td_executive_id').jqxComboBox('val', row.executive_id);
		$('#vehicle_id_test').jqxComboBox('val', row.vehicle_id);
		$('#variant_id_test').jqxComboBox('val', row.variant_id);
		$('#chassis_no_test').val(row.chassis_no_test);
		//$('#mileage_start').val(row.mileage_start);
		//$('#mileage_end').val(row.mileage_end);
		$('#duration').val(row.duration);
		$('#td_location').jqxComboBox('val', row.td_location);
		// $('#fuel_location').jqxComboBox('val', row.fuel_location);
		$('#kms').val(row.kms);
		$('#opening_kms').val(row.opening_kms);
		$('#closing_kms').val(row.closing_kms);
		$('#reported_by').val(row.reported_by);
		$('#month').jqxComboBox('val', row.month);
		$('#fuel').val(row.fuel);
		
        $('#customer_test_drives_window_poptup_title').html('<?php echo lang("general_edit")  . "&nbsp;" .  lang("customer_test_drives"); ?>');

        <?php if( !control('Executive Selection', FALSE)):?>
		$('.executive-selection').hide();
		<?php endif;?>
		
        openPopupWindow('jqxPopupWindowCustomer_test_drive', 'N/A');
    }
}


function showImageTestDrive(index)
{
	var rows = $("#jqxGridCustomer_test_drive").jqxGrid('getrowdata', index);
	var image = rows.test_drive_document;
	// $('#imgDiv').html('<img src="<?php echo base_url('uploads/customer_doc/') ?>/'+image+'">');
	// $('#viewImageTestdriveModal').modal('show');
	var url = '<?php echo base_url('uploads/customer_doc/') ?>/'+image;
		myWindow = window.open(url, 'Print Test Drive Document', "height=900,width=1300");
		myWindow.document.close();
		myWindow.focus();
		myWindow.print();
}

function saveCustomer_test_driveRecord(){
    var data = $("#form-customer_test_drives").serialize();
	
	$('#jqxPopupWindowCustomer_test_drive').block({ 
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
        url: '<?php echo site_url("admin/customers/save_customer_test_drive"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_customer_test_drives();
                $('#jqxGridCustomer_test_drive').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCustomer_test_drive').jqxWindow('close');
            }
            $('#jqxPopupWindowCustomer_test_drive').unblock();
        }
    });
}

function reset_form_customer_test_drives(){
	$('#customer_test_drives_id').val('');
    $('#form-customer_test_drives')[0].reset();

    $('#td_executive_id').jqxComboBox('clearSelection');
	$('#vehicle_id_test').jqxComboBox('clearSelection');
	$('#variant_id_test').jqxComboBox('clearSelection');
	$('#td_location').jqxComboBox('clearSelection');

    $('#td_executive_id').jqxComboBox('selectIndex', '-1');
    $('#vehicle_id_test').jqxComboBox('selectIndex', '-1');
    $('#variant_id_test').jqxComboBox('selectIndex', '-1');
    $('#td_location').jqxComboBox('selectIndex', '-1');
}
</script>

	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ajaxuploader.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>

<script type="text/javascript">
	$(function(){
		uploadReady();
	})
	function uploadReady()
	{
		uploader=$('#image_upload');
		new AjaxUpload(uploader, {
			action: '<?php  echo site_url('customers/upload_doc')?>',
			name: 'userfile',
			responseType: "json",
			onSubmit: function(file, ext){
				if (! (ext && /^(jpg|png|jpeg|gif|pdf)$/.test(ext))){ 
                    // extension is not allowed 
                    $.messager.show({title: '<?php  echo lang('error')?>',msg: 'Only pdf, JPG, PNG or GIF files are allowed'});
                    return false;
                }
                //status.text('Uploading...');
            },
            onComplete: function(file, response){
            	if(response.error==null){
            		var filename = response.file_name;
            		$('#image_upload').hide();
            		$('#document').val(filename);
            		$('#image_upload_name').html('<img src="<?php echo site_url()?>uploads/customer_doc/'+filename+'" height="100px" width="100px"> <buttton type="button" onclick="remove_doc()" class="btn btn-danger"><i class="fa fa-trash"></i></button>');
            		$('#image_upload_name').show();
            		$('#change-image').show();
            	}
            	
            }       
        });     
	}

	function remove_doc(argument) {
		$('#image_upload').show();
		$('#image_upload_name').hide();
		$('#document').val('');
	}

	function viewDoc(index) {
		var row = $("#jqxGridCustomer").jqxGrid('getrowdata', index);
		
		$('#image_div').html('<img src="<?php echo site_url()?>uploads/customer_doc/'+row.document+'" height="500px" width="500px">');
		openPopupWindow('jqxPopupWindowCustomerDoc', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');

	}


</script>

<script type="text/javascript">
    function calculate_total_kms() {
        var opening = parseFloat($('#opening_kms').val());
        var closing = parseFloat($('#closing_kms').val());

        var total = closing - opening;

        if(closing){
            if(total < 0){
                alert('Difference cannot be less than zero');
                $('#kms').val(0);
                $('#opening_kms').val(0);
                $('#closing_kms').val(0);
            }else{
                $('#kms').val(total);
            }
        }
    }
</script>