<label>Material Required</label>
<div id="jqxGridJobDetailPart">
	
</div>

<script type="text/javascript">
	var total_part;
	var total_labour;
	var total;

	var job_cardsDataSource =
	{
		datatype: "json",
		datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'part_name', type: 'string'},
			{ name: 'part_id', type: 'number'},
			{ name: 'part_code', type: 'string'},
			{ name: 'price', type: 'number'},
			{ name: 'quantity', type: 'number'},
			{ name: 'discount_percentage', type: 'number'},
			{ name: 'final_price', type: 'number'},
			{ name: 'labour', type: 'number'},
			{ name: 'final_labour', type: 'number'},
			{ name: 'discount_amount', type: 'number'},
			{ name: 'cash_discount', type: 'number'},
			{ name: 'recived_status', type: 'number'},
			{ name: 'request_status', type: 'number'},
			
        ],
		url: '<?php echo site_url("admin/job_cards/estimate_for_parts_json"); ?>',
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
	    	$("#jqxGridEstimate").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridEstimate").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }

	};
	var job_cardsDataSource2 = new $.jqx.dataAdapter(job_cardsDataSource,{
		async: false,
		autoBind:true,
	});

	// cash_discount = job_cardsDataSource2.records[0].cash_discount;
	if(job_cardsDataSource2.records[0] != undefined){
		$('#total_discount').val(job_cardsDataSource2.records[0].cash_discount);
	}

	$("#jqxGridJobDetailPart").jqxGrid({
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
			{ text: '<?php echo lang("id")?>', datafield: 'id', hidden: true},
			{ text: '<?php echo lang("part_id")?>', datafield: 'part_id', hidden: true},
			{ text: 'SN', width: '5%', pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
			
			{ text: '<?php echo lang("part_name"); ?>',datafield: 'part_name',width: '25%',filterable: true,renderer: gridColumnsRenderer,cellbeginedit: true, },
			{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: '10%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true,},
			{ 
				text: '<?php echo lang("quantity"); ?>',
				datafield: 'quantity',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: false, 
				// cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
    //                 if (newvalue != oldvalue) {
    //                 	var labour = $("#jqxGridJobDetailPart").jqxGrid('getcellvalue', row, "labour");
    //                     var cost = $("#jqxGridJobDetailPart").jqxGrid('getcellvalue', row, "price");
    //                     var discount = $("#jqxGridJobDetailPart").jqxGrid('getcellvalue', row, "discount_percentage");

    //                     var amount = cal_part_cost(cost, newvalue, discount);
    //                     $("#jqxGridJobDetailPart").jqxGrid('setcellvalue', row, "final_price", (amount).toFixed(2));

    //                     discount_amount = cal_discount_amount(cost, newvalue, labour, discount);
    //                     $("#jqxGridJobDetailPart").jqxGrid('setcellvalue', row, "discount_amount", (discount_amount).toFixed(2));
                        
    //                     cal_cash_discount_amt();
    //                 };
    //             }
			},
			{
				text: '<?php echo lang("send_request")?>', datafield: 'request_status', width: '10%', filterable: false, renderer: gridColumnsRenderer, columntype:'checkbox', cellbeginedit: false,
					cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
	                    var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);
	                    if (newvalue != oldvalue) {
	                    	$.post("<?php echo site_url('job_cards/job_card_detail/part_request_status')?>", {partdata:partdata, status:newvalue}, function(data){
	                    		if(!data.success){
	                    			alert('Error occur. Try again.');
	                    		}
	                    	},'json');
	                    };
                	}
			},
			{
				text: '<?php echo lang("recive")?>', datafield: 'recived_status', width: '10%', filterable: false, renderer: gridColumnsRenderer, columntype:'checkbox', cellbeginedit: false,
					cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
	                    var partdata = $("#jqxGridJobDetailPart").jqxGrid('getrowdata',row);
	                    if (newvalue != oldvalue) {
	                    	$.post("<?php echo site_url('job_cards/job_card_detail/part_recived_status')?>", {partdata:partdata, status:newvalue}, function(data){
	                    		if(!data.success){
	                    			alert('Error occur. Try again.');
	                    		}
	                    	},'json');
	                    };
                	}
			},
			
		],
		editable : true,
		rendergridrows: function (result) {
			return result.data;
		},
		autorowheight: true,
	});
</script>