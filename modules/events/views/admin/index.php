<style type="text/css">
	table.form-table td:nth-child(odd){
		width:13%;
	}
	table.form-table td:nth-child(even){
		width:20%;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('events'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('events'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridEventToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridEventInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridEventFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridEvent"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowEvent">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-events', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "events_id"/>
            <table class="form-table">
				<tr>
					<td><label for='dealer_id'><?php echo lang('dealer_id')?></label></td>
					<td><div id='dealer_id' name='dealer_id'></div></td>
					<td><label for='events_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='events_name' class='text_input' name='name'></td>
				</tr>
				<tr>
					<td>
						<label for='start_date_en'><?php echo lang('start_date_en')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="ad_to_bs" data-arg2="events" data-arg3="jqxPopupWindowEvent" data-arg4="start_date_en" data-arg5="start_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td><div id='start_date_en' class='date_box' name='start_date_en'></div></td>
					<td>
						<label for='start_date_np'><?php echo lang('start_date_np')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="events" data-arg3="jqxPopupWindowEvent" data-arg4="start_date_np" data-arg5="start_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input id='start_date_np' class='text_input' name='start_date_np'></td>
				</tr>
				<tr>
					<td>
						<label for='end_date_en'><?php echo lang('end_date_en')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="ad_to_bs" data-arg2="events" data-arg3="jqxPopupWindowEvent" data-arg4="end_date_en" data-arg5="end_date_np"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td><div id='end_date_en' class='date_box' name='end_date_en'></div></td>
					<td>
						<label for='end_date_np'><?php echo lang('end_date_np')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="events" data-arg3="jqxPopupWindowEvent" data-arg4="end_date_np" data-arg5="end_date_en"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input id='end_date_np' class='text_input' name='end_date_np'></td>
				</tr>
				<tr>
					<td><label for="description"><?php echo lang('description') ?></label></td>
					<td><input type="text" name="description" class="text_area" id="description" ></td>
				</tr>
				<tr>
					<td><label for='active'><?php echo lang('active')?></label></td>
					<td valign="top">
						<input type="radio" id="active-1" name="active" value="1"> Yes
						<input type="radio" id="active-2" name="active" value="0"> No
					</td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxEventSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxEventCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){
	
	$('#start_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});
	$('#end_date_np').jqxInput({ placeHolder: 'YYYY-MM-DD'});

	$("#start_date_en, #end_date_en").jqxDateTimeInput({ value: null, });

	$('.convert-date').on('click', function(){
		var arg1 = this.getAttribute("data-arg1"),
			arg2 = this.getAttribute("data-arg2"),
			arg3 = this.getAttribute("data-arg3"),
			arg4 = this.getAttribute("data-arg4"),
			arg5 = this.getAttribute("data-arg5");

			window[arg1](arg2,arg3,arg4,arg5);
	});

	var eventsDataSource =
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
			{ name: 'dealer_id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'start_date_en', type: 'date' },
			{ name: 'start_date_np', type: 'string' },
			{ name: 'end_date_en', type: 'date' },
			{ name: 'end_date_np', type: 'string' },
			{ name: 'active', type: 'bool' },
			{ name: 'dealer_name', type: 'string' },
			{ name: 'description', type: 'string' },

			
        ],
		url: '<?php echo site_url("admin/events/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	eventsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridEvent").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridEvent").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridEvent").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: eventsDataSource,
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
			container.append($('#jqxGridEventToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					<?php if(is_admin()):?>
					var e = '<a href="javascript:void(0)" onclick="editEventRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
					<?php endif; ?>
				}
			},
			{ text: '<?php echo lang("dealer_id"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("start_date_en"); ?>',datafield: 'start_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("start_date_np"); ?>',datafield: 'start_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("end_date_en"); ?>',datafield: 'end_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("end_date_np"); ?>',datafield: 'end_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("description"); ?>',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("active"); ?>',datafield: 'active',width: 75,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox', filtertype: 'bool'},
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridEvent").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridEventFilterClear', function () { 
		$('#jqxGridEvent').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridEventInsert', function () { 
		openPopupWindow('jqxPopupWindowEvent', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

    //dealers
	var dealerDataSource = {
	    url : '<?php echo site_url("admin/events/get_dealers_combo_json"); ?>',
	    datatype: 'json',
	    datafields: [
	        { name: 'id', type: 'number' },
	        { name: 'name', type: 'string' },
	    ],
	    async: false,
	    cache: true
	}

	dealerDataAdapter = new $.jqx.dataAdapter(dealerDataSource);

	$("#dealer_id").jqxComboBox({
	    theme: theme,
	    width: 195,
	    height: 25,
	    selectionMode: 'dropDownList',
	    autoComplete: true,
	    searchMode: 'containsignorecase',
	    source: dealerDataAdapter,
	    displayMember: "name",
	    valueMember: "id",
	});

	// initialize the popup window
    $("#jqxPopupWindowEvent").jqxWindow({ 
        theme: theme,
        width: 850,
        maxWidth: 850,
        height: 350,  
        maxHeight: 350,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowEvent").on('close', function () {
        reset_form_events();
    });

    $("#jqxEventCancelButton").on('click', function () {
        reset_form_events();
        $('#jqxPopupWindowEvent').jqxWindow('close');
    });

    $('#form-events').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			/*{ input: '#dealer_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#dealer_id').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},*/

			{ input: '#events_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#events_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#start_date_en', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#start_date_en').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#start_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#start_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#end_date_en', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#end_date_en').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},
			{ input: '#end_date_np', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#end_date_np').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			/*{ input: '#active', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#active').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},*/

			{ input: '#start_date_np', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#start_date_np').val();
					if (val != '') {
						return (val.match(date_pattern)) ? true : false;
					} else {
						return true;
					}
				}
			},

			{ input: '#end_date_np', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#end_date_np').val();
					if (val != '') {
						return (val.match(date_pattern)) ? true : false;
					} else {
						return true;
					}
				}
			},



        ]
    });

    $("#jqxEventSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveEventRecord();
                }
            };
        $('#form-events').jqxValidator('validate', validationResult);
       
    });
});

function editEventRecord(index){
    var row =  $("#jqxGridEvent").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#events_id').val(row.id);
        $('#dealer_id').jqxComboBox('val', row.dealer_id);
		$('#events_name').val(row.name);
		$('#start_date_en').jqxDateTimeInput('setDate', row.start_date_en);
		$('#start_date_np').val(row.start_date_np);
		$('#end_date_en').jqxDateTimeInput('setDate', row.end_date_en);
		$('#end_date_np').val(row.end_date_np);
		$('#description').val(row.description);
		if(row.active == 1) {
			$('#active-1').prop('checked', 'checked');   
		} else if(row.active == 2) {
			$('#active-2').prop('checked', 'checked');   
		}
		
        openPopupWindow('jqxPopupWindowEvent', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveEventRecord(){
    var data = $("#form-events").serialize();
	
	$('#jqxPopupWindowEvent').block({ 
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
        url: '<?php echo site_url("admin/events/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_events();
                $('#jqxGridEvent').jqxGrid('updatebounddata');
                $('#jqxPopupWindowEvent').jqxWindow('close');
            }
            $('#jqxPopupWindowEvent').unblock();
        }
    });
}

function reset_form_events(){
	$('#events_id').val('');
    $('#form-events')[0].reset();

    $('#dealer_id').jqxComboBox('clearSelection');
    $('#dealer_id').jqxComboBox('selectIndex', '-1');

    $("#start_date_en, #end_date_en").jqxDateTimeInput({ value: null });
}
</script>