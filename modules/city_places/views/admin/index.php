<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('city_places'); ?></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li class="active"><?php echo lang('city_places'); ?></li>
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridCity_placeToolbar' class='grid-toolbar'>
					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridCity_placeInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCity_placeFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridCity_place"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowCity_place">
   <div class='jqxExpander-custom-div'>
        <span class='popup_title' id="window_poptup_title"></span>
    </div>
    <div class="form_fields_area">
        <?php echo form_open('', array('id' =>'form-city_places', 'onsubmit' => 'return false')); ?>
        	<input type = "hidden" name = "id" id = "city_places_id"/>
            <table class="form-table">
				<tr>
					<td><label for='district_id'><?php echo lang('district_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='district_id' class='number_general' name='district_id'></div></td>
				</tr>
				<tr>
					<td><label for='mun_vdc_id'><?php echo lang('mun_vdc_id')?><span class='mandatory'>*</span></label></td>
					<td><div id='mun_vdc_id' class='number_general' name='mun_vdc_id'></div></td>
				</tr>
				<tr>
					<td><label for='city_places_name'><?php echo lang('name')?><span class='mandatory'>*</span></label></td>
					<td><input id='city_places_name' class='text_input' name='name'></td>
				</tr>
				
                <tr>
                    <th colspan="2">
                        <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxCity_placeSubmitButton"><?php echo lang('general_save'); ?></button>
                        <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxCity_placeCancelButton"><?php echo lang('general_cancel'); ?></button>
                    </th>
                </tr>
               
          </table>
        <?php echo form_close(); ?>
    </div>
</div>

<script language="javascript" type="text/javascript">

$(function(){

	//districts
    var districtDataSource = {
        url : '<?php echo site_url("admin/city_places/get_districts_combo_json"); ?>',
        datatype: 'json',
        datafields: [
            { name: 'id', type: 'number' },
            { name: 'name', type: 'string' },
        ],
        async: true,
        cache: true
    }

    districtDataAdapter = new $.jqx.dataAdapter(districtDataSource);

    $("#district_id").jqxComboBox({
        theme: theme,
        width: 195,
        height: 25,
        selectionMode: 'dropDownList',
        autoComplete: true,
        searchMode: 'containsignorecase',
        source: districtDataAdapter,
        displayMember: "name",
        valueMember: "id",
    });


    $("#district_id").select('bind', function (event) {
        val = $("#district_id").jqxComboBox('val');
        //districts
        munVdcDataSource  = {
            url : '<?php echo site_url("admin/city_places/get_mun_vdcs_combo_json"); ?>',
            datatype: 'json',
            datafields: [
                { name: 'id', type: 'number' },
                { name: 'name', type: 'string' },
            ],
            data: {
                parent_id: val
            },
            async: false,
            cache: true
        }

        munVdcDataAdapter = new $.jqx.dataAdapter(munVdcDataSource, {autoBind: false});

        $("#mun_vdc_id").jqxComboBox({
            theme: theme,
            width: 195,
            height: 25,
            selectionMode: 'dropDownList',
            autoComplete: true,
            searchMode: 'containsignorecase',
            source: munVdcDataAdapter,
            displayMember: "name",
            valueMember: "id",
        });
    });

	var city_placesDataSource =
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
			{ name: 'name', type: 'string' },
			{ name: 'district_id', type: 'number' },
			{ name: 'mun_vdc_id', type: 'number' },
			{ name: 'district_name', type: 'string' },
			{ name: 'mun_vdc_name', type: 'string' },
			
        ],
		url: '<?php echo site_url("admin/city_places/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	city_placesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCity_place").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCity_place").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCity_place").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: city_placesDataSource,
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
			container.append($('#jqxGridCity_placeToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index) {
					var e = '<a href="javascript:void(0)" onclick="editCity_placeRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: '<?php echo lang("district_id"); ?>',datafield: 'district_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("mun_vdc_id"); ?>',datafield: 'mun_vdc_name',width: 250,filterable: true,renderer: gridColumnsRenderer },
			{ text: '<?php echo lang("name"); ?>',datafield: 'name',width: 200,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCity_place").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCity_placeFilterClear', function () { 
		$('#jqxGridCity_place').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridCity_placeInsert', function () { 
		openPopupWindow('jqxPopupWindowCity_place', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
    });

	// initialize the popup window
    $("#jqxPopupWindowCity_place").jqxWindow({ 
        theme: theme,
        width: 400,
        maxWidth: 400,
        height: 250,  
        maxHeight: 250,  
        isModal: true, 
        autoOpen: false,
        modalOpacity: 0.7,
        showCollapseButton: false 
    });

    $("#jqxPopupWindowCity_place").on('close', function () {
        reset_form_city_places();
    });

    $("#jqxCity_placeCancelButton").on('click', function () {
        reset_form_city_places();
        $('#jqxPopupWindowCity_place').jqxWindow('close');
    });

    $('#form-city_places').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#city_places_name', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#city_places_name').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#district_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#district_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#mun_vdc_id', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#mun_vdc_id').jqxComboBox('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });

    $("#jqxCity_placeSubmitButton").on('click', function () {
        var validationResult = function (isValid) {
                if (isValid) {
                   saveCity_placeRecord();
                }
            };
        $('#form-city_places').jqxValidator('validate', validationResult);
    });
});

function editCity_placeRecord(index){
    var row =  $("#jqxGridCity_place").jqxGrid('getrowdata', index);
  	if (row) {
  		$('#city_places_id').val(row.id);
        $('#city_places_name').val(row.name);
		$('#district_id').jqxComboBox('val', row.district_id);
		$('#mun_vdc_id').jqxComboBox('val', row.mun_vdc_id);
		
        openPopupWindow('jqxPopupWindowCity_place', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');
    }
}

function saveCity_placeRecord(){
    var data = $("#form-city_places").serialize();
	
	$('#jqxPopupWindowCity_place').block({ 
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
        url: '<?php echo site_url("admin/city_places/save"); ?>',
        data: data,
        success: function (result) {
            var result = eval('('+result+')');
            if (result.success) {
                reset_form_city_places();
                $('#jqxGridCity_place').jqxGrid('updatebounddata');
                $('#jqxPopupWindowCity_place').jqxWindow('close');
            }
            $('#jqxPopupWindowCity_place').unblock();
        }
    });
}

function reset_form_city_places(){
	$('#city_places_id').val('');
	
	$('#district_id').jqxComboBox('clearSelection');
    $('#mun_vdc_id').jqxComboBox('clearSelection');

    $('#district_id').jqxComboBox('selectIndex', -1);
    $('#mun_vdc_id').jqxComboBox('selectIndex', -1);
    
    $('#form-city_places')[0].reset();
}
</script>