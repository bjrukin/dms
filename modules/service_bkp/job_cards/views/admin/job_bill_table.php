<div id="jqxGridJobBill"></div>
 
<script type="text/javascript">

	var source_job_status = {};

	source_job_status['0'] = {};
	source_job_status['0']['status'] = "PENDING";
	source_job_status['1'] = {};
	source_job_status['1']['status'] = "COMPLETE";

	var getEditorDataAdapterJob  = function (datafield){
		var source =
         	{
               	localdata: source_job_status,
               	datatype: "array",
               	datafields:
                   	[
                       	{ name: 'status', type: 'string' },
                   	]
         	};
         	var statusDataAdapter = new $.jqx.dataAdapter(source, { uniqueDataFields: [datafield] });
            return statusDataAdapter;
	}

	var job_cardsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'job_id', type: 'number' },
			// { name: '', type: 'number'},
			{ name: 'id', type: 'number' },
			{ name: 'job', type: 'string'},
			{ name: 'job_description', type: 'string'},
			{ name: 'min_price', type: 'number'},
			{ name: 'cost', type: 'number'},
			{ name: 'discount_amount', type: 'number'},
			{ name: 'discount_percentage', type: 'number'},
			{ name: 'final_amount', type: 'number'},
			{ name: 'status', type: 'string'},
			
        ],
		url: '<?php echo site_url("admin/job_cards/estimate_form_data_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		data: {
			jobcard_group	: <?php echo $job_detail['jobcard_group']?>,
			vehicle_id		: <?php echo $job_detail['vehicle_id']?>,
			status 			: 'PENDING',
		},
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	job_cardsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridJobBill").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridJobBill").jqxGrid('updatebounddata', 'sort');
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
	
	$("#jqxGridJobBill").jqxGrid({
		theme: theme,
		width: '100%',
		height: '50%',
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
		enableanimations: false,
		pagesizeoptions: pagesizeoptions,
		showaggregates: true,
		showstatusbar: true,
		columns: [
			{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			
			{ text: '<?php echo lang("job"); ?>',datafield: 'job',width: '30%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true },
			{ text: '<?php echo lang("description"); ?>',datafield: 'job_description',width: '45%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true },
			{ text: '<?php echo lang("status"); ?>',datafield: 'status',width: '20%',filterable: true,renderer: gridColumnsRenderer, columntype: 'template', 
				createeditor: function (row, cellvalue, editor, cellText, width, height) {
                  	// construct the editor. 
                  	editor.jqxDropDownList({
                  		checkboxes: true, source: getEditorDataAdapterJob('status'), displayMember: 'status', valueMember: 'status', width: width, height: height, 
                      	selectionRenderer: function () {
                          	return "<span style='top:4px; position: relative;'>Please Choose:</span>";
                      	}
              		});
              	},
              	initeditor: function (row, cellvalue, editor, celltext, pressedkey) {
                          // set the editor's current value. The callback is called each time the editor is displayed.
                          var items = editor.jqxDropDownList('getItems');
                          editor.jqxDropDownList('uncheckAll');
                          var values = cellvalue.split(/,\s*/);
                          for (var j = 0; j < values.length; j++) {
                              for (var i = 0; i < items.length; i++) {
                                  if (items[i].label === values[j]) {
                                      editor.jqxDropDownList('checkIndex', i);
                                  }
                              }
                          }
                      },
              	geteditorvalue: function (row, cellvalue, editor) {
                  	// return the editor's value.
                  	return editor.val();
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
   //                      var cost = $("#jqxGridJobBill").jqxGrid('getcellvalue', row, "cost");
   //                      var amount = newvalue/100 * cost;
   //                      $("#jqxGridJobBill").jqxGrid('setcellvalue', row, "final_amount", cost - amount);
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