<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridDublicate_document_logToolbar' class='grid-toolbar'>
					
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridDublicate_document_logFilterClear"><?php echo lang('general_clear'); ?></button>
				</div>
				<div id="jqxGridDublicate_document_log"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script language="javascript" type="text/javascript">

$(function(){

	var dublicate_document_logsDataSource =
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
		{ name: 'inquiry_no', type: 'string' },
		{ name: 'fiscal_year_id', type: 'number' },
		{ name: 'inquiry_date_en', type: 'date' },
		{ name: 'inquiry_date_np', type: 'string' },
		{ name: 'inquiry_kind', type: 'string' },
		{ name: 'customer_type_id', type: 'number' },
		{ name: 'first_name', type: 'string' },
		{ name: 'middle_name', type: 'string' },
		{ name: 'last_name', type: 'string' },
		{ name: 'gender', type: 'string' },
		{ name: 'marital_status', type: 'string' },
		{ name: 'family_size', type: 'string' },
		{ name: 'dob_en', type: 'date' },
		{ name: 'dob_np', type: 'string' },
		{ name: 'anniversary_en', type: 'date' },
		{ name: 'anniversary_np', type: 'string' },
		{ name: 'district_id', type: 'number' },
		{ name: 'mun_vdc_id', type: 'number' },
		{ name: 'address_1', type: 'string' },
		{ name: 'address_2', type: 'string' },
		{ name: 'email', type: 'string' },
		{ name: 'home_1', type: 'string' },
		{ name: 'home_2', type: 'string' },
		{ name: 'work_1', type: 'string' },
		{ name: 'work_2', type: 'string' },
		{ name: 'mobile_1', type: 'string' },
		{ name: 'mobile_2', type: 'string' },
		{ name: 'pref_communication', type: 'string' },
		{ name: 'occupation_id', type: 'number' },
		{ name: 'education_id', type: 'number' },
		{ name: 'dealer_id', type: 'number' },
		{ name: 'executive_id', type: 'number' },
		{ name: 'payment_mode_id', type: 'number' },
		{ name: 'source_id', type: 'number' },
		{ name: 'status_id', type: 'number' },
		{ name: 'contact_1_name', type: 'string' },
		{ name: 'contact_1_mobile', type: 'string' },
		{ name: 'contact_1_relation_id', type: 'number' },
		{ name: 'contact_2_name', type: 'string' },
		{ name: 'contact_2_mobile', type: 'string' },
		{ name: 'contact_2_relation_id', type: 'number' },
		{ name: 'remarks', type: 'string' },
		{ name: 'vehicle_id', type: 'number' },
		{ name: 'variant_id', type: 'number' },
		{ name: 'color_id', type: 'number' },
		{ name: 'walkin_source_id', type: 'number' },
		{ name: 'event_id', type: 'number' },
		{ name: 'institution_id', type: 'number' },
		{ name: 'exchange_car_make', type: 'string'},
		{ name: 'exchange_car_model', type: 'string'},
		{ name: 'exchange_car_year', type: 'string'},
		{ name: 'exchange_car_kms', type: 'number'},
		{ name: 'exchange_car_value', type: 'number'},
		{ name: 'exchange_car_bonus', type: 'number'},
		{ name: 'exchange_total_offer', type: 'number'},
		{ name: 'full_name', type: 'string'},
		{ name: 'fiscal_year', type: 'string'},
		{ name: 'customer_type', type: 'string'},
		{ name: 'district_name', type: 'string'},
		{ name: 'mun_vdc_name', type: 'string'},
		{ name: 'occupation_name', type: 'string'},
		{ name: 'education_name', type: 'string'},
		{ name: 'dealer_name', type: 'string'},
		{ name: 'executive_name', type: 'string'},
		{ name: 'payment_mode_name', type: 'string'},
		{ name: 'source_name', type: 'string'},
		{ name: 'status_name', type: 'string'},
		{ name: 'contact_1_relation_name', type: 'string'},
		{ name: 'contact_2_relation_name', type: 'string'},
		{ name: 'vehicle_name', type: 'string'},
		{ name: 'variant_name', type: 'string'},
		{ name: 'color_name', type: 'string'},
		{ name: 'walkin_source_name', type: 'string'},
		{ name: 'event_name', type: 'string'},
		{ name: 'institution_name', type: 'string'},
		{ name: 'is_booked', type: 'number'},
		{ name: 'booking_canceled', type: 'number'},
		{ name: 'booking_age', type: 'number'},
		{ name: 'actual_status_rank', type: 'number'},
		{ name: 'cancel_amount', type: 'number'},
		{ name: 'notes', type: 'string'},
		{ name: 'booking_receipt_no', type: 'string'},
		{ name: 'status_remarks', type: 'string'},
		{ name: 'inquiry_age', type: 'number'},
		{ name: 'inquiry_type', type: 'string'},
		{ name: 'sub_status_name', type: 'string'},
		{ name: 'status_date', type: 'date'},
		{ name: 'booked_date', type: 'date'},
		{ name: 'notes', type: 'string'},
		{ name: 'test_drive_status', type: 'string'},
		{ name: 'customer_type_name', type: 'string'},
		{ name: 'is_edited', type: 'number'},
		{ name: 'customer_id', type: 'number'},
		{ name: 'booking_cancel_reason', type: 'string'},
		{ name: 'vehicle_make_year', type: 'number'},
		{ name: 'uploadeddocument', type: 'string'},
			
			
        ],
		url: '<?php echo site_url("admin/dublicate_number_logs/documentJson"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dublicate_document_logsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDublicate_document_log").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDublicate_document_log").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDublicate_document_log").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight ,
		source: dublicate_document_logsDataSource,
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
			container.append($('#jqxGridDublicate_document_logToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{
				text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
				cellsrenderer: function (index, row, columnfield, value, defaulthtml, columnproperties) {

					var e = '<a href="<?php echo site_url("admin/dublicate_number_logs/detail/'+columnproperties.customer_id+'") ?>" title="Details" target="_blank"><i class="fa fa-eye"></i></a>';
					return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
				}
			},
			{ text: 'Inquiry Number',datafield: 'inquiry_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Inquiry Date',datafield: 'inquiry_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd },
			{ text: '<?php echo lang("customer_name"); ?>',datafield: 'full_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Dealer',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Model',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Variant',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Color',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
			{ text: 'Mobile',datafield: 'mobile_1',width: 150,filterable: true,renderer: gridColumnsRenderer },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridDublicate_document_log").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDublicate_document_logFilterClear', function () { 
		$('#jqxGridDublicate_document_log').jqxGrid('clearfilters');
	});

});


</script>