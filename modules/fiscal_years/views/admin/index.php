<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('fiscal_years'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li class="active"><?php echo lang('menu_fiscal_years');?></li>
      	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridFiscal_yearToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridFiscal_yearInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridFiscal_yearFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridFiscal_year"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowFiscal_year">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-fiscal_years', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "id"/>
            <table class="form-table">
            <col width="35%">
            <col width="65%">
				<tr>
					<td>
						<label for='nepali_start_date'><?php echo lang('nepali_start_date')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="fiscal_years" data-arg3="jqxPopupWindowFiscal_year" data-arg4="nepali_start_date" data-arg5="english_start_date"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="nepali_start_date" id="nepali_start_date" placeholder="YYYY-MM-DD" class="text_input"/></td>
				</tr>

				<tr>
					<td valign="top">
						<label for='english_start_date'><?php echo lang('english_start_date')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="fiscal_years" data-arg3="jqxPopupWindowFiscal_year" data-arg4="english_start_date" data-arg5="nepali_start_date"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='english_start_date' class='date_box' name='english_start_date'></div>
					</td>
				</tr>

				<tr>
					<td>
						<label for='nepali_end_date'><?php echo lang('nepali_end_date')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the Nepali Date to English Date" data-arg1="bs_to_ad" data-arg2="fiscal_years" data-arg3="jqxPopupWindowFiscal_year" data-arg4="nepali_end_date" data-arg5="english_end_date"> <?php echo lang('general_bs_to_ad')?></a>
					</td>
					<td><input type="text" name="nepali_end_date" id="nepali_end_date" placeholder="YYYY-MM-DD" class="text_input"/></td>
				</tr>
				
				<tr>
					<td valign="top">
						<label for='english_end_date'><?php echo lang('english_end_date')?><span class='mandatory'>*</span></label>
						<a href="javascript:void(0)" class='convert-date' title="Click to Convert the English Date to Nepali Date" data-arg1="ad_to_bs" data-arg2="fiscal_years" data-arg3="jqxPopupWindowFiscal_year" data-arg4="english_end_date" data-arg5="nepali_end_date"> <?php echo lang('general_ad_to_bs')?></a>
					</td>
					<td valign="top">
						<div id='english_end_date' class='date_box' name='english_end_date'></div>
					</td>
				</tr>
                <tr>
                    <th colspan="4">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxFiscal_yearSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxFiscal_yearCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	$('#nepali_start_date').jqxInput({ placeHolder: 'YYYY-MM-DD'});
	$('#nepali_end_date').jqxInput({ placeHolder: 'YYYY-MM-DD'});

	$('.convert-date').on('click', function(){
		var arg1 = this.getAttribute("data-arg1"),
			arg2 = this.getAttribute("data-arg2"),
			arg3 = this.getAttribute("data-arg3"),
			arg4 = this.getAttribute("data-arg4"),
			arg5 = this.getAttribute("data-arg5");

			window[arg1](arg2,arg3,arg4,arg5);
	});

	var fiscal_yearsDataSource =
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
			{ name: 'nepali_start_date', type: 'string' },
			{ name: 'nepali_end_date', type: 'string' },
			{ name: 'english_start_date', type: 'date' },
			{ name: 'english_end_date', type: 'date' },
			{ name: 'active', type: 'bool' },
			
        ],
		url: '<?php echo site_url("admin/fiscal_years/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	fiscal_yearsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridFiscal_year").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridFiscal_year").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridFiscal_year").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: fiscal_yearsDataSource,
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
			container.append($('#jqxGridFiscal_yearToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editFiscal_yearRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("nepali_start_date"); ?>',	datafield: 'nepali_start_date',		width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("nepali_end_date"); ?>',	datafield: 'nepali_end_date',		width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("english_start_date"); ?>',datafield: 'english_start_date',	width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("english_end_date"); ?>',	datafield: 'english_end_date',		width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
			{ text: '<?php echo lang("active"); ?>',			datafield: 'active',				width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox', filtertype: 'bool' },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridFiscal_year").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridFiscal_yearFilterClear', function () { 
		$('#jqxGridFiscal_year').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridFiscal_yearInsert', function () { 
		$('#active-1').prop('checked', 'checked');
		openPopupWindow('jqxPopupWindowFiscal_year', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowFiscal_year").jqxWindow({ 
        theme: theme,
        width: 600,
        maxWidth: 600,
        height: 300,  
        maxHeight: 300,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowFiscal_year").on('close', function () {
        reset_fiscal_years_form()
    });

    $("#jqxFiscal_yearCancelButton").on('click', function () {
        reset_fiscal_years_form()
        $('#jqxPopupWindowFiscal_year').jqxWindow('close');
    });

    $('#form-fiscal_years').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#nepali_start_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#nepali_start_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#nepali_end_date', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#nepali_end_date').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#nepali_start_date', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#nepali_start_date').val();
					if (val != '') {
						return (val.match(date_pattern)) ? true : false;
					} else {
						return true;
					}
				}
			},

			{ input: '#nepali_end_date', message: 'Invalid Format', action: 'blur', 
				rule: function(input) {
					val = $('#nepali_end_date').val();
					if (val != '') {
						return (val.match(date_pattern)) ? true : false;
					} else {
						return true;
					}
				}
			},
        ]
    });

    $("#jqxFiscal_yearSubmitButton").on('click', function () {
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveFiscal_yearRecord();
                }
            };
        $('#form-fiscal_years').jqxValidator('validate', validationResult);
        
    });
});

function editFiscal_yearRecord(index){
    var row =  $("#jqxGridFiscal_year").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#id').val(row.id);
        $('#nepali_start_date').val(row.nepali_start_date);
		$('#nepali_end_date').val(row.nepali_end_date);
		$('#english_start_date').jqxDateTimeInput('setDate', row.english_start_date);
		$('#english_end_date').jqxDateTimeInput('setDate', row.english_end_date);
		
        openPopupWindow('jqxPopupWindowFiscal_year', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveFiscal_yearRecord(){
    var data = $("#form-fiscal_years").serialize();
	
	$('#jqxPopupWindowFiscal_year').block({ 
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
        url: '<?php echo site_url("admin/fiscal_years/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
               reset_fiscal_years_form();
                $('#jqxGridFiscal_year').jqxGrid('updatebounddata');
                $('#jqxPopupWindowFiscal_year').jqxWindow('close');
            }
            $('#jqxPopupWindowFiscal_year').unblock();
        }
    });
}
function reset_fiscal_years_form(){
	$('#id').val('');
    $('#form-fiscal_years')[0].reset();
}
</script>