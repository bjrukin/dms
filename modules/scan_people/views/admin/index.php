<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('scan_people'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="#">Home</a></li>
	        <li class="active"><?php echo lang('scan_people'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridScan_personToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridScan_personInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridScan_personFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridScan_person"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowScan_person">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-scan_people', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "scan_people_id"/>
            <table class="form-table">
			
				<tr>
					<td><label for='scan_people_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='scan_people_name' class='text_input' name='name'></td>
				</tr>
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxScan_personSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxScan_personCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	var scan_peopleDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			
			
			{ name: 'name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/scan_people/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	scan_peopleDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridScan_person").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridScan_person").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridScan_person").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: scan_peopleDataSource,
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
			container.append($('#jqxGridScan_personToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editScan_personRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			
			
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridScan_person").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridScan_personFilterClear', function () { 
		$('#jqxGridScan_person').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridScan_personInsert', function () { 
		openPopupWindow('jqxPopupWindowScan_person', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowScan_person").jqxWindow({ 
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

    $("#jqxPopupWindowScan_person").on('close', function () {
        reset_form_scan_people();
    });

    $("#jqxScan_personCancelButton").on('click', function () {
        reset_form_scan_people();
        $('#jqxPopupWindowScan_person').jqxWindow('close');
    });

    $('#form-scan_people').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			
			{ input: '#scan_people_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#scan_people_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxScan_personSubmitButton").on('click', function () {
        // saveScan_personRecord();
        
        var validationResult = function (isValid) {
                if (isValid) {
                   saveScan_personRecord();
                }
            };
        $('#form-scan_people').jqxValidator('validate', validationResult);
        
    });
});

function editScan_personRecord(index){
    var row =  $("#jqxGridScan_person").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#scan_people_id').val(row.id);
       
		$('#scan_people_name').val(row.name);
		
        openPopupWindow('jqxPopupWindowScan_person', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveScan_personRecord(){
    var data = $("#form-scan_people").serialize();
	
	$('#jqxPopupWindowScan_person').block({ 
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
        url: '<?php echo site_url("admin/scan_people/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_scan_people();
                $('#jqxGridScan_person').jqxGrid('updatebounddata');
                $('#jqxPopupWindowScan_person').jqxWindow('close');
            }
            $('#jqxPopupWindowScan_person').unblock();
        }
    });
}

function reset_form_scan_people(){
	$('#scan_people_id').val('');
    $('#form-scan_people')[0].reset();
}
</script>