<label>
	Job Detail
</label>
<div id="jqxGridDetail">
	
</div>
<hr>

<script type="text/javascript">
	var job_cardsDataSource =
	{
		datatype: "json",
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
			{ name: 'stat', type: 'string'},
			
        ],
		url: '<?php echo site_url("admin/job_cards/estimate_form_data_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		data: {
			jobcard_group	: <?php echo $jobcard_group?>,
			vehicle_id		: <?php echo $vehicle_id?>,
		},
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	job_cardsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDetail").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDetail").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }

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
	
	$("#jqxGridDetail").jqxGrid({
		theme: theme,
		width: '100%',
		height: '100%',
		source: job_cardsDataSource,
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
		showaggregates: true,
		showstatusbar: true,
		columns: [
			{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			{ text: 'ID', width: '10%', hidden: true, datafield:id},
			{ text: '<?php echo lang("customer_voice"); ?>',datafield: 'customer_voice',width: '30%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true },
			{ text: '<?php echo lang("job"); ?>',datafield: 'job',width: '20%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true },
			{ text: '<?php echo lang("description"); ?>',datafield: 'job_description',width: '35%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true },
			{ text: '<?php echo lang("complete"); ?>',datafield: 'stat', columntype: 'checkbox',width: '10%',filterable: true,renderer: gridColumnsRenderer,
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                    var jobdata = $("#jqxGridDetail").jqxGrid('getrowdata',row);
                    if (newvalue != oldvalue) {
                    	$.post("<?php echo site_url('job_cards/job_card_detail/job_status_change')?>", jobdata, function(data){
                    		if(!data.success){
                    			alert('Error occur. Try again.');
                    		}
                    	},'json');
                    };
                }
			 },
			// { text: '<?php echo lang("cost"); ?>',datafield: 'cost',width: '10%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true,},

			// { 
			// 	text: '<?php echo lang("discount_percentage"); ?>',
			// 	datafield: 'discount_percentage',
			// 	width: '10%',filterable: true,
			// 	renderer: gridColumnsRenderer, 
			// 	columntype: 'numberinput', 
			// 	cellbeginedit: false, 
			// 	cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
   //                  if (newvalue != oldvalue) {
   //                      var cost = $("#jqxGridDetail").jqxGrid('getcellvalue', row, "cost");
   //                      var amount = newvalue/100 * cost;
   //                      $("#jqxGridDetail").jqxGrid('setcellvalue', row, "final_amount", cost - amount);
   //                  };
   //              }
			// },
			// { 
			// 	text: '<?php echo lang("final_amount"); ?>',
			// 	datafield: 'final_amount',
			// 	width: '10%',
			// 	filterable: true,
			// 	renderer: gridColumnsRenderer, 
			// 	columntype: 'numberinput', 
			// 	cellbeginedit: true,
			// 	aggregates: [{ '<b>Total</b>':
   //                  function (aggregatedValue, currentValue, column, record) {
   //                      var total = currentValue;
   //                      return aggregatedValue + total;
   //                  }
   //            	}]                  
			// },
			
		],
		editable : true,
		rendergridrows: function (result) {
			return result.data;
		}
	});
</script>