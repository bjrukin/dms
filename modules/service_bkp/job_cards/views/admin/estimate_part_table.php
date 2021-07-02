<div id="jqxGridPart">
	
</div>
<fieldset>
	<legend>Summary</legend>
	<form id="total">
		<input type="hidden" name="jobcard_group" value="<?php print_r($jobcard_group)?>">
		<input type="hidden" name="vehicle_id" value="<?php print_r($vehicle_id)?>">
		<input type="hidden" name="no_vat_total" id="no_vat_total">

		<b>Parts Total Amount: </b><span id="total_part_amount"></span><br>
		<b>Labour Total Amount: </b><span id="total_labour_amount"></span><br>
		<b>Discount Total Amount: </b><span id="total_discount_amount"></span><br>
		<b>Total Amount: </b><span id="total_final_amount"></span><br>
		<b>Cash Discount: </b>

		<input type="number" name="cash_discount" id="cash_discount" step="1" onchange="cal_cash_discount_amt()" onkeyup="cal_cash_discount_amt" value="0">%
		<input type="number" name="total_discount" id="total_discount" class="total_discount_cash" onchange="cal_cash_discount_per()" onkeyup="cal_cash_discount_per" value="0"><br>

		<b>VAT Amount (13%): </b><span id="vat_total"></span><br>
		<b>Net Amount: </b><span id="net_amount"></span>
	</form>
</fieldset>

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
			
        ],
		url: '<?php echo site_url("admin/job_cards/estimate_for_parts_json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		data: {
			jobcard_group	: <?php echo $job_detail['jobcard_group']?>,
			vehicle_id		: <?php echo $job_detail['vehicle_id']?>,
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
	console.log(job_cardsDataSource2.records[0]);
	if(job_cardsDataSource2.records[0] != undefined){
		$('#total_discount').val(job_cardsDataSource2.records[0].cash_discount);
	}



	    /* for calculating discount */
	    var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                if (value < 20) {
                    return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
                }
                else {
                    return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
                }
            }
	
	$("#jqxGridPart").jqxGrid({
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
			{ text: '<?php echo lang("price"); ?>',datafield: 'price',width: '10%',filterable: true,renderer: gridColumnsRenderer, cellbeginedit: true,},
			{ 
				text: '<?php echo lang("quantity"); ?>',
				datafield: 'quantity',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: false, 
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                    if (newvalue != oldvalue) {
                    	var labour = $("#jqxGridPart").jqxGrid('getcellvalue', row, "labour");
                        var cost = $("#jqxGridPart").jqxGrid('getcellvalue', row, "price");
                        var discount = $("#jqxGridPart").jqxGrid('getcellvalue', row, "discount_percentage");

                        var amount = cal_part_cost(cost, newvalue, discount);
                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "final_price", (amount).toFixed(2));

                        discount_amount = cal_discount_amount(cost, newvalue, labour, discount);
                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "discount_amount", (discount_amount).toFixed(2));
                        
                        cal_cash_discount_amt();
                    };
                }
			},
			{ 
				text: '<?php echo lang("discount_percentage"); ?>',
				datafield: 'discount_percentage',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: false, 
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                    if (newvalue != oldvalue) {
                        var cost = $("#jqxGridPart").jqxGrid('getcellvalue', row, "price");
                        var quantity = $("#jqxGridPart").jqxGrid('getcellvalue', row, "quantity");
                        var labour = $("#jqxGridPart").jqxGrid('getcellvalue', row, "labour");
                        
                        var amount = cal_part_cost(cost, quantity, newvalue);
                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "final_price", amount);

                        var final_labour = cal_labor_cost(labour, newvalue);
                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "final_labour", final_labour);

                        var discount_amount = cal_discount_amount(cost, quantity, labour, newvalue);
                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "discount_amount", (discount_amount).toFixed(2));

                        cal_cash_discount_amt();
                    };
                }
			},
			{ 
				text: '<?php echo lang("final_amount"); ?>',
				datafield: 'final_price',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: true, 
                aggregates: [{ '<b>Total</b>':
                    function (aggregatedValue, currentValue, column, record) {
                        var total = currentValue;

                        $('#total_part_amount').html(aggregatedValue);

                        return aggregatedValue + total;
                    }
              	}] 
			},
			{ 
				text: '<?php echo lang("labour"); ?>',
				datafield: 'labour',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: false,
                
				cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                    if (newvalue != oldvalue) {
                        var cost = $('#jqxGridPart').jqxGrid('getcellvalue',row,"price");
                        var quantity = $('#jqxGridPart').jqxGrid('getcellvalue',row,"quantity");

                        var discount = $("#jqxGridPart").jqxGrid('getcellvalue', row, "discount_percentage");
                        final_labour = cal_labor_cost(newvalue, discount);

                        var discount_amount = cal_discount_amount(cost,quantity,newvalue,discount);

                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "final_labour", final_labour);
                        $("#jqxGridPart").jqxGrid('setcellvalue', row, "discount_amount", discount_amount);

                        cal_cash_discount_amt();
                    };
                },
			},
			{ 
				text: '<?php echo lang("final_labour"); ?>',
				datafield: 'final_labour',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: true, 
                aggregates: [{ '<b>Total</b>':
                    function (aggregatedValue, currentValue, column, record) {
                        var total = currentValue;

                        $('#total_labour_amount').html(aggregatedValue);

                        total_part = parseFloat($('#total_part_amount').html());
                        total_labour = parseFloat($('#total_labour_amount').html());
                        $('#total_final_amount').html(total_part + total_labour);

                        cal_cash_discount_amt();
                        return aggregatedValue + total;
                    }
              	}] 
			},
			{ 
				text: '<?php echo lang("discount_amount"); ?>',
				datafield: 'discount_amount',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput',
				cellbeginedit: false,
				hidden: true,
                
				aggregates: [{ '<b>Total</b>':
                    function (aggregatedValue, currentValue, column, record) {
                        var ini_cash_discount_percent = cal_cash_discount_per();
                        $('#total_discount_amount').html(aggregatedValue);

                        var total = currentValue;
                        return aggregatedValue + total;
                    }
              	}] 
			},
			
		],
		editable : true,
		rendergridrows: function (result) {
			return result.data;
		},
		autorowheight: true,
	});

function cal_cash_discount_per(){
	var total 				= ($('#total_final_amount').html())?parseFloat($('#total_final_amount').html()):0;
	var part_amount 		= ($('#total_part_amount').html())?parseFloat($('#total_part_amount').html()):0;
	var labour_amount 		= ($('#total_labour_amount').html())?parseFloat($('#total_labour_amount').html()):0;
	var total_discount		= ($('#total_discount').val())?parseFloat($('#total_discount').val()):0;

	per_discount 		= total_discount * 100 /total;
	part_discount 		= part_amount - (part_amount * per_discount) * 100;
	labour_discount 	= labour_amount - (labour_amount * per_discount) * 100;

	// calculate amount without VAT
	no_vat_total = total - total_discount;
	$('#no_vat_total').val(no_vat_total);

	// calculate vat amount
	vat_total = (no_vat_total * <?php echo VAT_PERCENTAGE; ?>) / 100;
	$('#vat_total').html((vat_total).toFixed(2));

	//net amount
	var net_amount = no_vat_total + vat_total;
	$('#net_amount').html(net_amount);

	$('#cash_discount').val(per_discount);
}

function cal_cash_discount_amt(){
	var total 				= parseFloat($('#total_final_amount').html());
	var part_amount 		= parseFloat($('#total_part_amount').html());
	var labour_amount 		= parseFloat($('#total_labour_amount').html());
	var dis_percentage 		= parseFloat($('#cash_discount').val());

	part_discount 		= part_amount - (part_amount * dis_percentage) * 100;
	labour_discount 	= labour_amount - (labour_amount * dis_percentage) * 100;
	total_discount 		= (total * dis_percentage) / 100;

	// calculate amount without VAT
	no_vat_total = total - total_discount;
	$('#no_vat_total').val(no_vat_total);

	// calculate vat amount
	vat_total = (no_vat_total * <?php echo VAT_PERCENTAGE; ?>) / 100;
	$('#vat_total').html((vat_total).toFixed(2));

	//net amount
	var net_amount = no_vat_total + vat_total;
	$('#net_amount').html(net_amount);

	if(dis_percentage > 0){
		$('#total_discount').val(total_discount);
	}
}

function cal_part_cost(price, quantity, discount) {
	var part_cost = (price - (price * discount) / 100) * quantity;
	return part_cost;
}

function cal_labor_cost(labour, discount) {
	var labour_cost = labour - (labour * discount) / 100;
	return labour_cost;
}

function cal_discount_amount(cost,quantity,labour,discount) {
	var discount_amount = (cost * quantity +labour) * discount / 100;
	return discount_amount;
}

function cal_vat_amt(){
	var final_amount = 1000;
	var discount_percentage = $('#no_vat_total')
}
</script>