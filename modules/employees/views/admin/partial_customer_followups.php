<style>
.cls-yellow { background-color: #F2E477; }
.cls-red { background-color: #F56969; }
}
</style>

<div id='jqxGridCustomer_followupToolbar' class='grid-toolbar'>
	<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridCustomer_followupFilterClear"><?php echo lang('general_clear'); ?></button>
</div>
<div id="jqxGridCustomer_followup"></div>

<script language="javascript" type="text/javascript">

var customer_followups = function(){

	var cellclassname =  function (row, column, value, data) {
		
		var d = data.followup_date_en;

		if (d.compareTo(Date.parse('today')) >= 0 ) {
			return;
		} else if ( d.compareTo(Date.parse('yesterday')) == 0) {
			if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
				return 'cls-yellow';
			}
		} else {
			if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
				return 'cls-red';
			}
		}

	};

	var customer_followupsDataSource =
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
			{ name: 'customer_id', type: 'number' },
			{ name: 'executive_id', type: 'number' },
			{ name: 'status_id', type: 'number' },
			{ name: 'followup_date_en', type: 'date' },
			{ name: 'followup_date_np', type: 'string' },
			{ name: 'followup_mode', type: 'string' },
			{ name: 'followup_status', type: 'string' },
			{ name: 'followup_notes', type: 'string' },
			{ name: 'next_followup', type: 'bool' },
			{ name: 'next_followup_date_en', type: 'date' },
			{ name: 'next_followup_date_np', type: 'string' },
			{ name: 'status_name', type: 'string'},
			{ name: 'executive_name', type: 'string'},
			
        ],
		url: '<?php echo site_url("admin/employees/employee_customers_followup_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		data: {
			executive_id: '<?php echo $employee_info->id;?>'
		},
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	customer_followupsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridCustomer_followup").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridCustomer_followup").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridCustomer_followup").jqxGrid({
		theme: theme,
		width: '100%',
		height: (gridHeight - 65),
		source: customer_followupsDataSource,
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
			container.append($('#jqxGridCustomer_followupToolbar').html());
			toolbar.append(container);
		},
		columns: [
			{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false, cellclassname: cellclassname },
			// { text: '<?php echo lang("customer_id"); ?>',datafield: 'customer_id',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("followup_date_en"); ?>',datafield: 'followup_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd, cellclassname: cellclassname },
			{ text: '<?php echo lang("executive_id"); ?>',datafield: 'executive_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("followup_mode"); ?>',datafield: 'followup_mode',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("followup_status"); ?>',datafield: 'followup_status',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			{ text: '<?php echo lang("status_id"); ?>',datafield: 'status_name',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname },
			//{ text: '<?php echo lang("followup_date_np"); ?>',datafield: 'followup_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname  },
			//{ text: '<?php echo lang("followup_notes"); ?>',datafield: 'followup_notes',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname  },
			{ text: '<?php echo lang("next_followup"); ?>', datafield: 'next_followup', width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'checkbox', filtertype: 'bool', cellclassname: cellclassname  },
			{ text: '<?php echo lang("next_followup_date_en"); ?>',datafield: 'next_followup_date_en',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd, cellclassname: cellclassname },
			// { text: '<?php echo lang("next_followup_date_np"); ?>',datafield: 'next_followup_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer, cellclassname: cellclassname  },
			
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
	    e.preventDefault();
	    setTimeout(function() {$("#jqxGridCustomer_followup").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridCustomer_followupFilterClear', function () { 
		$('#jqxGridCustomer_followup').jqxGrid('clearfilters');
	});
};

</script>