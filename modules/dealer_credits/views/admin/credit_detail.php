<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('dealer_credits'); ?></h1><br/>
		<h1><?php echo $dealer_name->name;?></h1> 
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('dealer_credits'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->
		<a href="javascript:void(0)" id="journal_voucher" class="btn btn-default"  style="float:right" >Journal Voucher</a>
		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>			
				<div id="jqxGridDealer_credit"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="jqxPopupWindowVoucher">
	<div class='jqxExpander-item-div'>
		<span class='popup_title' id="window_poptup_title_item">Journal Voucher</span>
		<h3><?php echo $dealer_name->name;?></h3>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-journal', 'onsubmit' => 'return false')); ?>
		<div class="row form-group">
			<div class="col-md-2">
				<label for='date_nepali'>Date (nep)</label>
			</div>
			<div class="col-md-4"><input id='date_nepali' class='text_input convert-date' name='date_nepali' data-arg1="bs_to_ad" data-arg2="dealer_credits" data-arg3="jqxPopupWindowVoucher" data-arg4="date_nepali" data-arg5="date"></div>
			<div class="col-md-2"><label for='date'>Date (eng)</label></div>
			<div class="col-md-4"><div id='date' class='date_box convert-date' name='date'  data-arg1="ad_to_bs" data-arg2="dealer_credits" data-arg3="jqxPopupWindowVoucher" data-arg4="date" data-arg5="date_nepali"></div></div>
		</div>

		<div class="row form-group">
			<div class="col-md-2"><label>Select</label></div>
			<div class="col-md-4">
				<input type="radio" name="cr_dr" id="cr_dr" value="DEBIT" checked onclick="$('#debit_data').show()"><label style="padding-left:10px;margin-left:10px;">DEBIT</label>
				<input type="radio" name="cr_dr"  id="cr_dr" value="CREDIT" onclick="$('#debit_data').show()" style="margin-left: 24px;"><label style="padding-left:10px;">CREDIT</label>
			</div>
		</div>

		<div class="row form-group" id="debit_data">
			<div class="col-md-2"><label for='cash_card'>Cash/Bank</label></div>
			<div class="col-md-4">
				<select name="cash_card" class="text_input" id="cash_card">
					<option>Cash</option>
					<option>Card</option>
				</select></div>
			<div class="col-md-2"><label for='receipt_no'>Recipt No.</label></div>
			<div class="col-md-4"><input id='receipt_no' class='text_input' name='receipt_no'></div>
		</div>

		<input type="hidden"  name="dealer_id" value="<?php echo $dealer;?>">
		<div class="row form-group">
			<div class="col-md-2"><label for='amount'>Amount</label></div>
			<div class="col-md-8"><input id='amount' class='text_input' name='amount'></div>
		</div>
		<div style="margin-bottom:30px;"></div>
		<div class="row form-group">
			<div class="col-md-2"><label>Particulars</label></div>
			<div class="col-md-2"><textarea cols="50" rows="10"  id=" particular" name="particular"></textarea></div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxJournalSave"><?php echo lang('general_add'); ?></button>
				<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxJournalClose"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>


<script language="javascript" type="text/javascript">
	var total = 0;
	$(function(){

		$('.convert-date').on('change', function(){
			var arg1 = this.getAttribute("data-arg1"),
			arg2 = this.getAttribute("data-arg2"),
			arg3 = this.getAttribute("data-arg3"),
			arg4 = this.getAttribute("data-arg4"),
			arg5 = this.getAttribute("data-arg5");

			window[arg1](arg2,arg3,arg4,arg5);
		});

		var dealer_creditsDataSource =
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
			{ name: 'cr_dr', type: 'string' },
			{ name: 'amount', type: 'number' },
			{ name: 'date', type: 'string' },
			{ name: 'receipt_no', type: 'number' },
			{ name: 'credit', type: 'number' },
			{ name: 'debit', type: 'number' },
			{ name: 'remaining_amount', type: 'number' },
			{ name: 'particular', type: 'string'},
			{ name: 'cash_card', type: 'string'},


			
			],
			url: '<?php echo site_url("admin/dealer_credits/detail_json")?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			data: {'id':'<?php echo $rows->id;?>'},
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	dealer_creditsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridDealer_credit").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridDealer_credit").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridDealer_credit").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: dealer_creditsDataSource,
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
			container.append($('#jqxGridDealer_creditToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},

		// { text: '<?php echo lang("cr_dr"); ?>',datafield: 'cr_dr',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: '<?php echo lang("credit"); ?>',datafield: 'credit',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right',align: 'right'},
		{ text: '<?php echo lang("debit"); ?>',datafield: 'debit',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right',align: 'right'},
		{ text: '<?php echo lang("receipt_no"); ?>',datafield: 'receipt_no',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: 'Cash/Card',datafield: 'cash_card',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },
		{ text: '<?php echo lang("amount"); ?>',datafield: 'remaining_amount',width: 150,filterable: true,renderer: gridColumnsRenderer, cellsformat:'F2', cellsalign:'right',align: 'right',
		cellsrenderer: function (index) {
			var rows = $('#jqxGridDealer_credit').jqxGrid('getrowdata',index);
			if(rows.cr_dr == 'CREDIT')
			{
				total = total + rows.credit;
			}		
			if(rows.cr_dr == 'DEBIT')
			{
				total = total - rows.debit;
			}
			return '<div style="text-align: right; margin-top: 8px;">' + total.toFixed(2) +'</div>';
		}
	},
	{ text: 'Particulars',datafield: 'particular',width: 150,filterable: true,renderer: gridColumnsRenderer,cellsalign:'center',align: 'right' },

	],
	rendergridrows: function (result) {
		return result.data;
	}
});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridDealer_credit").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridDealer_creditFilterClear', function () { 
		$('#jqxGridDealer_credit').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridDealer_creditInsert', function () { 
		openPopupWindow('jqxPopupWindowDealer_credit', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});
});

$("#journal_voucher").on('click', function () 
{
	openPopupWindow('jqxPopupWindowVoucher', 'Journal Voucher');
});
$("#jqxJournalClose").on('click', function () {
    $('#jqxPopupWindowVoucher').jqxWindow('close');
});

$("#jqxPopupWindowVoucher").jqxWindow({ 
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

$("#jqxJournalSave").on('click', function () {
	saveJournal();

});


function saveJournal()
{
	var data = $("#form-journal").serialize();
	$('#jqxPopupWindowreceipt').block({ 
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
		url: '<?php echo site_url("admin/dealer_credits/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
					//reset_form_receipt();
					$('#jqxPopupWindowVoucher').jqxWindow('close');						
				}
				$('#jqxPopupWindowVoucher').unblock();
				location.reload();

			}
		});

}

</script>