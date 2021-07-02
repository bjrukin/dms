<link href="<?php echo base_url()?>assets/css/uploader_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ajaxuploader.js"></script>
<style>
	.styled-select.slate {
		/*background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;*/
		height: 33px;
		width: 480px;
	}

	.inputfile + label {
		font-size: 12px;
		font-weight: 100;
		color: white;
		background-color: grey;
		padding: 0.625rem 1.25rem;
		/*display: inline-block;*/
	}

	.inputfile:focus + label,
	.inputfile + label:hover {
		background-color: cadetblue;
	}
	.material-icons {
		vertical-align: bottom;
		font-size: 17px;
	}
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('purchase_invoices'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('purchase_invoices'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- row -->

		<div class="row">
			<div class="col-xs-12 connectedSortable">
				<?php echo displayStatus(); ?>
				<div id='jqxGridPurchase_invoiceToolbar' class='grid-toolbar'>

					<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridPurchase_invoiceInsert"><?php echo lang('general_create'); ?></button>
					<button type="button" class="btn btn-danger btn-flat btn-xs" id="jqxGridPurchase_invoiceFilterClear"><?php echo lang('general_clear'); ?></button>


				</div>
				<div id="jqxGridPurchase_invoice"></div>
			</div><!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPurchase_invoice">
	<div class='jqxExpander-purchase-invoice-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>

	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-purchase_invoices', 'onsubmit' => 'return false')); ?>
		<input type = "hidden" name = "id" id = "purchase_invoices_id"/>

		<div class="row"  style="margin-bottom:20px;">
			<div class="col-xs-6 col-md-3" >
				<label for='date'><?php echo lang('date')?></label>
				<div id='date' class='date_box' name='date'></div>

			</div>
			<div class="col-xs-6 col-md-3">
				<label for='pinv_no'><?php echo lang('pinv_no')?></label>
				<div id='pinv_no' class='number_general' name='pinv_no'></div>
			</div>
			<div class="col-xs-6 col-md-3">		
				<label for='splr_date'><?php echo lang('splr_date')?></label>
				<div id='splr_date' class='date_box' name='splr_date'></div>


			</div>
			<div class="col-xs-6 col-md-3">

				<label for='splr_inv_no'><?php echo lang('splr_inv_no')?></label>
				<div id='splr_inv_no' class='number_general' name='splr_inv_no'></div>
			</div>

		</div>
		<div class="row" style="margin-bottom:20px;">
			<div class="col-xs-6" >
				<label for='ledger'><?php echo lang('ledger')?></label>
				<div id="ledger"  class="number_general"  name="ledger"></div>

			</div>
			<div class="col-xs-6 col-md-2" >
				<input type="checkbox" name="get_mrp">Get MRP as Price

			</div>
		</div>
		<div class="row" style="margin-bottom:20px;">
			<div class="col-xs-6 col-md-3">
				<label for='challan_no'>Challan No.</label>

				<div id='challan_no' class='number_general' name='challan_no'></div>
			</div>

			<div class="col-xs-6 col-md-3">

				<label for='ord_no'>Order No</label>
				<div id='ord_no' class='number_general' name='ord_no'></div>
			</div>

			<div class="col-xs-6 col-md-4" >
				<label for='tax_method'><?php echo lang('tax_method')?></label>
				<!-- <input id='tax_method' class='text_input' name='tax_method'> -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"> <a href="#" role="tab" data-toggle="tab" onclick="showcolumn('vat')">Item Wise</a></li>
					<li role="presentation"                ><a href="#" role="tab" data-toggle="tab" onclick="hidecolumn('vat')" value="0" >Single Tax Percentage</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="item" style="margin-bottom:20px;">	

						<div class="row">
							<div class="col-xs-12 connectedSortable">
								<div id='jqxGridPurchase_methodToolbar' class='grid-toolbar'>
									<p><button id="jqxGridInvoiceItem" type="button">Add New Item</button> </p>
								</div>
								<div id="jqxGridPurchase_method"> </div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
		<div class="row">

			<div class="col-md-7 text-left" style="margin-bottom:10px;">
				<div class="row">
					<div class="col-md-4">
						<label>Total Item</label>&nbsp
						<input class='form-control' placeholder="0" id="total_item" name="total_item" readonly>
					</div>
					<div class="col-md-4">
						<label for='discount'><?php echo lang('discount')?></label> &nbsp 
						<input id='discount' class='form-control'  placeholder="0.00" name='discount' readonly>
					</div>
					<div class="col-md-4">
						<label>Bin No</label>
						<div id='bin_no' class='form-control' name='bin_no'></div>
					</div>
				</div>


				<label for='remark'>Remark</label>
				<textarea id='remark' rows="3" name='remark' class="form-control"></textarea>
				<br/>


				<div class="row">
					<div class="col-md-6">
						<label >Currency</label>
						<input id='currency' class='form-control' name='currency'>
					</div>
					<div class="col-md-6">
						<label >Exchange Price</label>
						<input id='exchange_price' class='form-control' placeholder="0.00" name='exchange_price' readonly>
					</div>
				</div>

			</div>
			<div class="col-md-5 contact-form" style=" margin-bottom:20px;">
				<fieldset>

					<div class="row">
						<div class="col-md-4"><label for='gross_total'>Gross Total</label></div>
						<div class="col-md-8"><input id='gross_total' class='form-control input-sm' placeholder="0.00" name='gross_total' readonly></div>
					</div>
					<div class="row">
						<div class="col-md-4"><label for='excise_duty'><?php echo lang('excise_duty')?></label>   </div>
						<div class="col-md-8"><input id='excise_duty' class='form-control input-sm'placeholder="0.00" name='excise_duty'></div>
					</div>
					<div class="row">
						<div class="col-md-4"><label for='others'><?php echo lang('others')?></label> </div>
						<div class="col-md-8"><input id='others' class='form-control input-sm' placeholder="0.00"name='others'></div>
					</div>
					<div class="row">
						<div class="col-md-2"><label for='vat'>VAT</label></div> 
						<div class="col-md-4">
							<div class="input-group">
								<input class="form-control input-sm" name='vat' value="13" readonly>
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="col-md-6"> <input id='vatamount' class='form-control input-sm'   placeholder="0.00" name='vatamount' readonly></div>
					</div>
					<div class="row">
						<div class="col-md-4"><label for='netamount'>Net Amount</label>  </div>
						<div class="col-md-8"><input id='netamount' class='form-control input-sm'  placeholder="0.00" name='netamount' readonly></div>
					</div>
				</fieldset>
			</div>

		</div>


         <!-- <form action="<?php echo site_url('purchase_methods/excel_export') ?>" method="post">
           
            <button>Export</button>            
        </form> -->
        <!-- <a href="<?php echo site_url('purchase_methods/?type=export')?>" class="btn btn-success pull-right btn-margin">Export</a> -->
        <div class="row">
        	<input type="checkbox" onclick="window.print()">Print After Save 

        	<button class="btn btn-default ">Print</button>


        </div>
        <div class="row">

        	<div style="float:right; ">

        		<div class="btn-group">

        			<button class="btn btn-default">New</button>&nbsp
        			<button type="button" class="btn btn-success" id="jqxPurchase_invoiceSubmitButton"><?php echo lang('general_save'); ?></button>&nbsp
        			<button type="button" class="btn btn-default " id="jqxPurchase_invoiceCancelButton"><?php echo lang('general_cancel'); ?></button>&nbsp
        		</div>


        	</div>
        </div>


        <?php echo form_close(); ?>
        <form method="post" enctype="multipart/form-data">
        	<input name="image" id="image" class='text_input' style="display:none"/>
        	<input type="file" id="image_upload" name="userfile" style="display:block"/>
        	<!--   <button type="submit" class="btn btn-default" id="import" value="submit" >Import</button> &nbsp -->
        	<a href="<?php echo site_url('purchase_methods/export') ?>" class="btn btn-default" >Export</a> 
        </form>

    </div>

</div>

<!-- item detail -->

<div id="jqxPopupWindowInvoiceitem">
	<div class='jqxExpander-item-div'>
		<span class='popup_title' id="window_poptup_title_item"><?php echo lang('general_add') . ' ' . lang('item')?></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-purchase_methods', 'onsubmit' => 'return false')); ?>
		<!-- <input type = "hidden" name = "purchase_invoices_id" id = "purchase_invoices_id"/> -->
		<div class="row">
			<div class="col-md-2"><label for='type'><?php echo lang('type')?></label></div>
			<div class="col-md-8">
				<select name="type" id="type" class="form-control input-sm">
					<option>Dirc</option>
					<option>Chaln</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='part_id'><?php echo lang('part_no')?></label></div>
			<div class="col-md-10"><div id='part_id' class='form-control input-sm' name='part_id'></div></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='description'><?php echo lang('description')?></label></div>
			<div class="col-md-10"><input id='description' class='form-control input-sm' name='description' readonly></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='qty'><?php echo lang('qty')?></label></div>
			<div class="col-md-4"><input id='qty' class='form-control input-sm' name='qty'></div>
			<div class="col-md-2"><label for='price'><?php echo lang('price')?></label></div>
			<div class="col-md-4"><input id='price' class='form-control input-sm' name='price'></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='disc'><?php echo lang('disc')?>(%)</label></div>
			<div class="col-md-4"><input id='disc' class='form-control input-sm' name='disc'></div>
			<div class="col-md-2"><label for='amount'><?php echo lang('amount')?></label></div>
			<div class="col-md-4"><input id='amount' class='form-control input-sm' name='amount'></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='ord_no'><?php echo lang('ord_no')?></label></div>
			<div class="col-md-4"><input id='ord_no' class='form-control input-sm' name='ord_no'></div>
			<div class="col-md-2"><label for='ord_pre'><?php echo ('ord_pre')?></label></div>
			<div class="col-md-4"><input id='ord_pre' class='form-control input-sm' name='ord_pre'></div>
		</div>
		<div class="row">
			<div class="col-md-2"><label for='bin'><?php echo lang('bin')?></label></div>
			<div class="col-md-4"><input id='bin' class='form-control input-sm' name='bin'></div>
		</div>
		<div class="row" id="add_item_vat">
			<div class="col-md-2"><label for='vat'><?php echo lang('vat')?></label></div>
			<div class="col-md-4"><input id='vat' class='form-control input-sm' name='vat'></div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxPurchase_methodSubmitButton"><?php echo lang('general_add'); ?></button>
				<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxPurchase_methodCancelButton"><?php echo lang('general_cancel'); ?></button>
			</div>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_getFormData.js"></script>

<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		uploadReady();
	});
	$(function(){
		// var partsAdapter;
		var ledgerAdapter;
		var purchase_invoicesDataSource =
		{
			datatype: "json",
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'splr_date', type: 'string' },
			{ name: 'ledger', type: 'string' },
			{ name: 'challan_no', type: 'string' },
			{ name: 'ord_no', type: 'string' },
			{ name: 'tax_method', type: 'string' },
			{ name: 'bin_no', type: 'number' },
			{ name: 'discount', type: 'string' },
			{ name: 'remark', type: 'string' },
			{ name: 'currency', type: 'string' },
			{ name: 'exchange_price', type: 'string' },
			{ name: 'excise_duty', type: 'string' },
			{ name: 'others', type: 'string' },
			{ name: 'vat', type: 'string' },
			{ name: 'surCharge', type: 'string' },
			{ name: 'pinv_no', type: 'number' },
			{ name: 'date', type: 'string' },
			{ name: 'splr_inv_no', type: 'number' },
			{name:'total_tem',type:'number'},
			
			],
			url: '<?php echo site_url("admin/purchase_invoices/json"); ?>',
			pagesize: defaultPageSize,
			root: 'rows',
			id : 'id',
			cache: true,
			pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	purchase_invoicesDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPurchase_invoice").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPurchase_invoice").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    }
	};
	
	$("#jqxGridPurchase_invoice").jqxGrid({
		theme: theme,
		width: '100%',
		height: gridHeight,
		source: purchase_invoicesDataSource,
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
			container.append($('#jqxGridPurchase_invoiceToolbar').html());
			toolbar.append(container);
		},
		columns: [
		{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
		// { text: '<?php echo lang("id"); ?>',datafield: 'id',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("splr_date"); ?>',datafield: 'splr_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("ledger"); ?>',datafield: 'ledger',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: 'Challan No.',datafield: 'challan_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		
		{ text: 'Order No',datafield: 'ord_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		
		{ text: '<?php echo lang("tax_method"); ?>',datafield: 'tax_method',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("bin_no"); ?>',datafield: 'bin_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("discount"); ?>',datafield: 'discount',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("remark"); ?>',datafield: 'remark',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("currency"); ?>',datafield: 'currency',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("exchange_price"); ?>',datafield: 'exchange_price',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("excise_duty"); ?>',datafield: 'excise_duty',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("others"); ?>',datafield: 'others',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("vat"); ?>',datafield: 'vat',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("surCharge"); ?>',datafield: 'surCharge',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("pinv_no"); ?>',datafield: 'pinv_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
		{ text: '<?php echo lang("date"); ?>',datafield: 'date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
		{ text: '<?php echo lang("splr_inv_no"); ?>',datafield: 'splr_inv_no',width: 150,filterable: true,renderer: gridColumnsRenderer },

		{ 
			text: 'Total Item',
			datafield: 'total_item',
			width: 150,
			filterable: true,
			


		},
		
		],
		rendergridrows: function (result) {
			return result.data;
		}
	});

	$("[data-toggle='offcanvas']").click(function(e) {
		e.preventDefault();
		setTimeout(function() {$("#jqxGridPurchase_invoice").jqxGrid('refresh');}, 500);
	});

	$(document).on('click','#jqxGridPurchase_invoiceFilterClear', function () { 
		$('#jqxGridPurchase_invoice').jqxGrid('clearfilters');
	});

	$(document).on('click','#jqxGridPurchase_invoiceInsert', function () { 
		openPopupWindow('jqxPopupWindowPurchase_invoice', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
	});

	// initialize the popup window
	$("#jqxPopupWindowPurchase_invoice").jqxWindow({ 
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

	$("#jqxPopupWindowPurchase_invoice").on('close', function () {
		reset_form_purchase_invoices();
	});

	$("#jqxPurchase_invoiceCancelButton").on('click', function () {
		reset_form_purchase_invoices();
		$('#jqxPopupWindowPurchase_invoice').jqxWindow('close');
	});

    /*$('#form-purchase_invoices').jqxValidator({
        hintType: 'label',
        animationDuration: 500,
        rules: [
			{ input: '#created_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_by', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_by').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#created_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#created_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#updated_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#updated_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#deleted_at', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#deleted_at').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#ledger', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#ledger').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#supplier', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#supplier').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#tax_method', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#tax_method').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#bin_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#bin_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#discount', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#discount').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#remark', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#remark').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#currency', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#currency').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#exchange_price', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#exchange_price').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#excise_duty', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#excise_duty').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#others', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#others').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#vat', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#vat').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#surCharge', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#surCharge').val();
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#pinv_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#pinv_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

			{ input: '#splr_inv_no', message: 'Required', action: 'blur', 
				rule: function(input) {
					val = $('#splr_inv_no').jqxNumberInput('val');
					return (val == '' || val == null || val == 0) ? false: true;
				}
			},

        ]
    });*/

    $("#jqxPurchase_invoiceSubmitButton").on('click', function () {
    	savePurchase_invoiceRecord();
        /*
        var validationResult = function (isValid) {
                if (isValid) {
                   savePurchase_invoiceRecord();
                }
            };
        $('#form-purchase_invoices').jqxValidator('validate', validationResult);
        */
    });

    var ledgercount =
    {
    	datatype: "json",
    	datafields: [
    	{ name: 'id',type: 'string'},
    	{ name: 'full_name',type: 'string'},

    	],
    	url: '<?php echo site_url('purchase_invoices/get_ledger')?>'
    };

    ledgerAdapter = new $.jqx.dataAdapter(ledgercount);

    $("#ledger").jqxComboBox({
    	theme: theme,
    	width: 195,
    	height: 25,
    	selectionMode: 'dropDownList',
    	autoComplete: true,
    	searchMode: 'containsignorecase',
    	source: ledgerAdapter,
    	displayMember: "full_name",
    	valueMember: "id",
    });
});

function editPurchase_invoiceRecord(index){
	var row =  $("#jqxGridPurchase_invoice").jqxGrid('getrowdata', index);
	var id= row.id;

	if (row) {
		$('#purchase_invoices_id').val(row.id);

		$('#splr_date').jqxDateTimeInput('setDate', row.splr_date);
		$('#ledger').val(row.ledger);
		
		$('#tax_method').val(row.tax_method);
		$('#bin_no').jqxNumberInput('val', row.bin_no);
		$('#discount').val(row.discount);
		$('#remark').val(row.remark);
		$('#currency').val(row.currency);
		$('#exchange_price').val(row.exchange_price);
		$('#excise_duty').val(row.excise_duty);
		$('#others').val(row.others);
		$('#vat').val(row.vat);
		$('#surCharge').val(row.surCharge);
		$('#pinv_no').jqxNumberInput('val', row.pinv_no);
		$('#date').jqxDateTimeInput('setDate', row.date);
		$('#splr_inv_no').jqxNumberInput('val', row.splr_inv_no);
		$('#challan_no').jqxNumberInput('val', row.challan_no);
		$('#ord_no').jqxNumberInput('val', row.ord_no);

		$.post("<?php echo site_url('admin/purchase_methods/get_method')?>",{id:id},function(data){
			
			
			console.log(data);
			$.each(data,function(key,val){
				
				var id 					= val.id;
				var type 				=	val.type;
				var part_id 			=	val.part_id;
				var description  		= 	val.description;
				var qty 				=	val.qty;
				var ord_no 				=	val.ord_no;
				var price 				= 	val.price;
				var disc 				=	val.disc;
				var amount 				=	val.amount;
				var bin 				=	val.bin;
				var vat 				=	val.vat;

				var datarow = {

					'id'				:id,
					'type'				:type,
					'disc'				:disc,
					'ord_no'			:ord_no,
					'qty'   			:qty,
					'description'     	:description,
					'price'         	:price,
					'part_id'      		:part_id,
					'amount'         	:amount,
					'vat' 				:vat,
					'bin'				:bin,
				};

				$('#jqxGridPurchase_method').jqxGrid('addrow', null, datarow);
				
				cal_cash_calculate();
			});



			

		},'json');
		
		openPopupWindow('jqxPopupWindowPurchase_invoice', '<?php echo lang("general_edit")  . "&nbsp;" .  $header; ?>');

	}
}

function savePurchase_invoiceRecord(){

	var method =JSON.stringify($("#jqxGridPurchase_method").jqxGrid('getrows'));

	console.log( $("#form-purchase_invoices").serialize());
	console.log( getFormData("form-purchase_invoices"));

	var data = $("#form-purchase_invoices").serialize() + '&method=' + method;
	// var estimate_part_datas = JSON.stringify(Partial_estimate_materials.jqxGrid('getrows'));
	//console.log(method);

	/*$('#jqxPopupWindowPurchase_invoice').block({ 
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
	});*/

	$.ajax({
		type: "POST",
		url: '<?php echo site_url("admin/purchase_invoices/save"); ?>',
		data: data,
		success: function (result) {
			var result = eval('('+result+')');
			if (result.success) {
				reset_form_purchase_invoices();
				$('#jqxGridPurchase_invoice').jqxGrid('updatebounddata');
				$('#jqxPopupWindowPurchase_invoice').jqxWindow('close');
			}
			$('#jqxPopupWindowPurchase_invoice').unblock();
		}
	});
}

function reset_form_purchase_invoices(){
	$('#purchase_invoices_id').val('');
	$('#form-purchase_invoices')[0].reset();
}

function uploadReady()
{
    	// alert();
    	uploader=$('#image_upload');

    	new AjaxUpload(uploader, {
    		action: '<?php  echo site_url('admin/purchase_methods/upload_image')?>',
    		name: 'userfile',
    		responseType: "json",

    		onSubmit: function(file, ext){

	  // $.post("<?php echo site_url('admin/purchase_baseds/upload_image')?>",function(data){



		 // },'json');

		},
		onComplete: function(file,data){
			if(data.error==null){
				$.each(data,function(key,val){

					var id 					= val.id;
					var type 				=	val.type;
					var part_id 			=	val.part_id;
					var description  		= 	val.description;
					var qty 				=	val.qty;
					var ord_no 				=	val.ord_no;
					var price 				= 	val.price;
					var disc 				=	val.disc;
					var amount 				=	val.amount;
					var bin 				=	val.bin;
					var vat 				=	val.vat;

					var datarow = {

						'id'				:id,
						'type'				:type,
						'disc'				:disc,
						'ord_no'			:ord_no,
						'qty'   			:qty,
						'description'     	:description,
						'price'         	:price,
						'part_id'      		:part_id,
						'amount'         	:amount,
						'vat' 				:vat,
						'bin'				:bin,
					};

					$('#jqxGridPurchase_method').jqxGrid('addrow', null, datarow);

					cal_cash_calculate();


				});

			}
			else
			{
				$.messager.show({title: '<?php  echo lang('error')?>',msg: response.error});                
			}
		}       
	});     
    }
</script>


<script language="javascript" type="text/javascript">
	var purchase_method_table;
	var partsAdapter;

	$(function(){

		var invoice_type = [
		{ value: "Dirc", label: "Dirc" },
		{ value: "Chln", label: "Challan" },
		];
		var invoice_typeSource =
		{
			datatype: "array",
			datafields: [
			{ name: 'label', type: 'string' },
			{ name: 'value', type: 'string' }
			],
			localdata: invoice_type
		};
		var invoice_typeAdapter = new $.jqx.dataAdapter(invoice_typeSource, {
			autoBind: true
		});

		var purchase_methodsDataSource =
		{
			datatype: "json",
			datafields: [
			// { name: 'id', type: 'number' },
			// { name: 'created_by', type: 'number' },
			// { name: 'updated_by', type: 'number' },
			// { name: 'deleted_by', type: 'number' },
			// { name: 'created_at', type: 'string' },
			// { name: 'updated_at', type: 'string' },
			// { name: 'deleted_at', type: 'string' },
			{ name: 'type', type: 'string', values: {source: invoice_typeAdapter.records, value: 'value', name: 'label' } },
			{ name: 'part_id', type: 'string' },
			{ name: 'description', type: 'string' },
			{ name: 'qty', type: 'number' },
			{ name: 'ord_no	', type: 'number' },
			{ name: 'price', type: 'number' },
			{ name: 'disc', type: 'string' },
			{ name: 'amount', type: 'number' },
			{ name: 'bin', type: 'string' },
			{ name: 'vat', type: 'string'},
			],
		//url: '<?php echo site_url("admin/purchase_methods/json"); ?>',
		pagesize: defaultPageSize,
		root: 'rows',
		id : 'id',
		cache: true,
		pager: function (pagenum, pagesize, oldpagenum) {
        	//callback called when a page or page size is changed.
        },
        beforeprocessing: function (data) {
        	purchase_methodsDataSource.totalrecords = data.total;
        },
	    // update the grid and send a request to the server.
	    filter: function () {
	    	$("#jqxGridPurchase_method").jqxGrid('updatebounddata', 'filter');
	    },
	    // update the grid and send a request to the server.
	    sort: function () {
	    	$("#jqxGridPurchase_method").jqxGrid('updatebounddata', 'sort');
	    },
	    processdata: function(data) {
	    },
	    updaterow: function (rowid, rowdata) {
          // synchronize with the server - send update command   
      }
  };

  $("#jqxGridPurchase_method").jqxGrid({
  	theme: theme,
  	width: '100%',
  	height: '250px',
  	source: purchase_methodsDataSource,
  	altrows: true,
  	pageable: true,
  	sortable: true,
  	rowsheight: 30,
  	showaggregates: true,
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
  	editable: true,
  	rendertoolbar: function (toolbar) {
  		var container = $("<div style='margin: 5px; height:50px'></div>");
  		container.append($('#jqxGridPurchase_methodToolbar').html());
  		toolbar.append(container);
  	},
  	columns: [
  	{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
  	{


  		text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, editable: false, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
  		cellsrenderer: function (index) {
  			var e = '<a href="javascript:void(0)" onclick="deletePurchase_methodRecord(' + index + '); return false;" title="Edit"><i class="fa fa-edit"></i></a>';
  			return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';

  		}
  	},

  	{ text: 'Type',datafield: 'type', columntype: 'dropdownlist', width: 150, filterable: true, renderer: gridColumnsRenderer, createeditor: function (row, value, editor) {
  		editor.jqxDropDownList({ source: invoice_typeAdapter, displayMember: 'label', valueMember: 'value' });
  	}},

  	{ text: 'Part No.',datafield: 'part_id', columntype: 'dropdownlist', width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false, },
  	{ text: 'Description',datafield: 'description',width: 150,filterable: true,renderer: gridColumnsRenderer, editable: false, },



  	{ 
  		text: 'Qty', datafield: 'qty', width: 150, filterable: true, columntype: 'numberinput', cellbeginedit: false,
  		cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {

  			if (newvalue != oldvalue) {
  				var discount = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "disc");
  				var vat = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "vat");
  				var price = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "price");

  				var total = (price * newvalue) - ((discount/100) * (price * newvalue));

  				$("#jqxGridPurchase_method").jqxGrid('setcellvalue', row, "amount", (total).toFixed(2));

  				// cal_cash_calculate(newvalue,price,discount,vat);


  			};

  		}

  	},
  	{ text: 'Ord No.',datafield: 'ord_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
  	{ text: 'Price',datafield: 'price',width: 150,filterable: true,renderer: gridColumnsRenderer ,
  	columntype: 'numberinput', 
  	cellbeginedit: false,

  	cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
  		if (newvalue != oldvalue) {
  			var discount = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "disc");
  			var quantity = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "qty");
  			var vat = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "vat");

  			var total = (newvalue * quantity) - ((discount/100) * (newvalue * quantity));

  			$("#jqxGridPurchase_method").jqxGrid('setcellvalue', row, "amount", (total).toFixed(2));

  			// cal_cash_calculate(newvalue,quantity,discount,vat);
  		};

  	},
  },
  { text: 'Disc',datafield: 'disc',width: 150,filterable: true,renderer: gridColumnsRenderer ,
  columntype: 'numberinput', 
  cellbeginedit: false,

  cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
  	if (newvalue != oldvalue) {
  		var vat = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "vat");
  		var quantity = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "qty");
  		var price = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "price");

  		var total = (price * quantity) - ((newvalue/100) * (price * quantity) ) ;

  		$("#jqxGridPurchase_method").jqxGrid('setcellvalue', row, "amount", (total).toFixed(2));
  		// cal_cash_calculate(newvalue,price,quantity,vat);
  	};

  }
},
{ text: 'VAT %',datafield: 'vat',width: 150,filterable: true,renderer: gridColumnsRenderer,
umntype: 'numberinput', 
cellbeginedit: false,

cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
	if (newvalue != oldvalue) {
		var discount = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "disc");
		var quantity = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "qty");
		var price = $("#jqxGridPurchase_method").jqxGrid('getcellvalue', row, "price");

		var total;
		total = (price * quantity)-discount;

		$("#jqxGridPurchase_method").jqxGrid('setcellvalue', row, "amount", (total).toFixed(2));
		// cal_cash_calculate(newvalue,price,quantity,discount);
	};

}
},
{ 
	text: 'Amount',
	datafield: 'amount',
	width: 150,
	filterable: true,
	renderer: gridColumnsRenderer,
	editable:false,

	columntype: 'numberinput', 
	cellbeginedit: true, 
	aggregates: [{ '<b>Total</b>':
	function (aggregatedValue, currentValue, column, record) {
		var total = currentValue;
		total = aggregatedValue + total;

		$('#gross_total').val(total);

		cal_cash_calculate();
		return total;
	}


}]

},
{ text: 'Bin',datafield: 'bin',width: 150,filterable: true,renderer: gridColumnsRenderer },

			// {text:'VAT',,datafield: 'vat',width: 150,filterable: true,renderer: gridColumnsRenderer },

			
			/*{ 
				text: 'Total',
				datafield: 'total',
				width: '10%',
				filterable: true,
				renderer: gridColumnsRenderer, 
				columntype: 'numberinput', 
				cellbeginedit: true, 
				aggregates: [{ '<b>Total</b>':
				function (aggregatedValue, currentValue, column, record) {
					var total = currentValue;
					total = aggregatedValue + total;

					$('#amount input[name=total]').val(total);

					cal_cash_calculate();
					return total;
				}
				

			}]
		},*/
		],




		rendergridrows: function (result) {
			return result.data;
		}
		
	});
		//combobox for add item

		/*$("#part_id").jqxComboBox({
			theme: theme,
			width: 195,
			height: 25,
			selectionMode: 'dropDownList',
			autoComplete: true,
			searchMode: 'containsignorecase',
			source: partsAdapter,
			displayMember: "part_code",
			valueMember: "id",
		});*/

		//combobox for add item-description

		var partsource = {
			url : '<?php echo site_url("admin/spareparts/get_spareparts_combo_json"); ?>',
			datatype: 'json',
			datafields: [
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'part_code', type: 'string' },
			{ name: 'price', type: 'number' },
			],
		}

		partsAdapter = new $.jqx.dataAdapter(partsource,
		{
			formatData: function (data) {
				if ($("#part_id").jqxComboBox('searchString') != undefined) {
					data.name_startsWith = $("#part_id").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#part_id").jqxComboBox({
			width: '97%',
			// height: 25,
			source: partsAdapter,
			theme: theme,
			remoteAutoComplete: true,
			selectedIndex: 0,
			displayMember: "name",
			valueMember: "id",
			renderer: function (index, label, value) {
				var item = partsAdapter.records[index];
				if (item != null) {
					var label = item.name + "(" + item.name + ", " + item.name + ")";
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = partsAdapter.records[index];
				if (item != null) {
					var label = item.name;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				partsAdapter.dataBind();
			}
		});

		
	});

$("#part_id").bind('select', function(event) {
	if (event.args)
	{
		indexToSelect = event.args.index;

		console.log(partsAdapter.records[indexToSelect]);
		$("#price").val(partsAdapter.records[indexToSelect].price);
		$("#description").val(partsAdapter.records[indexToSelect].name);
	}
});





function hidecolumn(column_name){
	$("#jqxGridPurchase_method").jqxGrid('hidecolumn', column_name);
	$('#add_item_vat').hide();
}


function showcolumn(column_name){
	$("#jqxGridPurchase_method").jqxGrid('showcolumn', column_name);
	$('#add_item_vat').show();
}

function deletePurchase_methodRecord(index){
	$.post("<?php  echo site_url('admin/purchase_methods/delete')?>", {id:[index]}, function(){
		$('#jqxPopupWindowPurchase_invoice').jqxWindow('close');
	});

}
$(document).on('click','#jqxGridInvoiceItem', function () { 
    	// Job_form_table.jqxGrid('clear');
    	openPopupWindow('jqxPopupWindowInvoiceitem', '<?php echo lang("general_add")  . "&nbsp;" .  lang("item"); ?>');
    });

	// initialize the popup window
	$("#jqxPopupWindowInvoiceitem").jqxWindow({ 
		theme: theme,
		width: '45%',
		maxWidth: '75%',
		height: '55%',  
		maxHeight: '75%',  
		isModal: true, 
		autoOpen: false,
		modalOpacity: 0.7,
		showCollapseButton: false 
	});





	$("#qty").on('change', function(){
		var quantity = ($.isNumeric($("#qty").val()))?$("#qty").val():0;
		var price = ($.isNumeric($("#price").val()))?$("#price").val():0;
		var discount = ($.isNumeric($("#disc").val()))?$("#disc").val():0;

		var amount = (price * quantity)-discount/100 ;
    	//alert(price * discount/100);

    	$('#amount').val(amount);
    });

	$("#disc").change(function(){
		if( $(this).val() < 0 || $(this).val() > 99) {
			alert("Error with discount input!");
			return false;
		}


		var quantity = ($.isNumeric($("#qty").val())) 	?	parseInt($("#qty").val())		:0;
		var price = ($.isNumeric($("#price").val())) 	?	parseInt($("#price").val())	:0;
		var discount = ($.isNumeric($("#disc").val())) 	?	parseInt($("#disc").val())	:0;

		var amount = (price * quantity);
		amount = amount - (amount * (discount/100)) ;

		$('#amount').val(amount);
	});

	$('#jqxPurchase_methodSubmitButton').click(function(){
		var type =$('#type').val();
		var qty = $('#qty').val();
		var price = $('#price').val();
		var description = $('#description').val();
		var part_id = $('#part_id').val()
		var disc = $('#disc').val();
		var ord_no = $('#ord_no').val();
		var amount = $('#amount').val();
		var bin = $('#bin').val();
		var vat = $('#vat').val();

		var datarow = {
			'type'				:type,
			'disc'				:disc,
			'ord_no'			:ord_no,
			'qty'   			:qty,
			'description'     	:description,
			'price'         	:price,
			'part_id'      		:part_id,
			'amount'         	:amount,
			'vat' 				:vat,
			'bin'				:bin,
		};
		console.log(datarow);  
		$('#jqxGridPurchase_method').jqxGrid('addrow', null, datarow);

		$('#jqxPopupWindowInvoiceitem').jqxWindow('close');
		cal_cash_calculate();
	});


	$("#excise_duty").change(function(){
		var excise_duty =$("#excise_duty").val();
		var others = $("#others").val();
		var vat = $("#vat").val();

		var total = excise_duty + others + vat;


		$('#netamount').val(total);
	});
	$("#others").change(function(){
		var excise_duty =$("#excise_duty").val();
		var others = $("#others").val();
		var vat = $("#vat").val();

		var total = excise_duty + others + vat;


		$('#netamount').val(total);
	});

	$("#vat").change(function(){
		var excise_duty =$("#excise_duty").val();
		var others = $("#others").val();
		var vat = $("#vat").val();

		var total = excise_duty + others + vat;
		console.log(total);

		$('#netamount').val(total);
	});


	function cal_cash_calculate() {
		var vat_percent = 13;
		var vat_amount;

		var gross_total = parseFloat($('#gross_total').val());
		isNaN(gross_total)? gross_total = 0:'';
		
		var excise_duty = parseFloat($('#excise_duty').val());
		isNaN(excise_duty)? excise_duty = 0:'';

		var others = parseFloat($('#others').val());
		isNaN(others)? others = 0:'';

		vat_amount = (vat_percent/100) * gross_total;
		console.log(vat_amount);

		var total = gross_total + excise_duty + others + vat_amount;

		// $('#discount').val(discount);
		$('#vatamount').val(vat_amount);
		$('#netamount').val(total);

		$('#total_item').val(total);

	}
</script>