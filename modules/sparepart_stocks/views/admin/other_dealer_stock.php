<!-- Content Wrapper. Contains page content -->
<div class="alert alert-success" id="success-msg" style="display: none;">
	<span> Your Request Has been Sent Successfully! </span>
</div>
<!-- Main content -->
<section class="content">
	<!-- row -->
	<div class="row">
		<div class="col-xs-12 connectedSortable">
			<?php echo displayStatus(); ?>
			<div>
				<button type="button" class="btn btn-primary btn-flat btn-xs" id="jqxGridStock_other_dealerInsert"><?php echo lang('general_create'); ?></button>
			</div>
			<div id="jqxGridStock_other_dealer"></div>
		</div><!-- /.col -->
	</div>
	<!-- /.row -->
</section><!-- /.content -->


<div id="jqxPopupWindowStock_other_dealer">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title"></span>
	</div>
	<div class="form_fields_area">
		<?php echo form_open('', array('id' =>'form-stock_other_dealers', 'onsubmit' => 'return false')); ?>
		<!-- <input type = "hidden" name = "id" id = "stock_other_dealers_id"/> -->
		<table class="form-table">
			<tr>
				<td><label for="sparepart"> <?php echo lang('sparepart');?></label></td>
				<td><div id="sparepart_list" name="sparepart_id"></div></td>
			</tr>
			<tr>
				<td><label for="part_name"> <?php echo lang('part_name');?></label></td>
				<td><div id="part_name"></div></td>
			</tr>
			<tr>
				<td><label for="quantity"> <?php echo lang('quantity');?></label></td>
				<td><input type="text" name="quantity" class="text_input"></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="button" class="btn btn-success btn-xs btn-flat" id="jqxStock_other_dealerSubmitButton"><?php echo lang('general_save'); ?></button>
					<button type="button" class="btn btn-default btn-xs btn-flat" id="jqxStock_other_dealerCancelButton"><?php echo lang('general_cancel'); ?></button>
				</th>
			</tr>

		</table>
		<?php echo form_close(); ?>
	</div>
</div>

<script language="javascript" type="text/javascript">

	$(function(){
		$(document).on('click','#jqxGridStock_other_dealerInsert', function () { 
			openPopupWindow('jqxPopupWindowStock_other_dealer', '<?php echo lang("general_add")  . "&nbsp;" .  $header; ?>');
		});

		var source =
		{
			datatype: "json",
			datafields: [
			{ name: 'id' },
			{ name: 'part_code' },
			{ name: 'name' },
			],
			url: "<?php echo site_url('admin/sparepart_stocks/sparepart_list_json')?>",
		};

		var dataAdapter = new $.jqx.dataAdapter(source,
		{
			formatData: function (data) {
				if ($("#sparepart_list").jqxComboBox('searchString') != undefined) {
					data.part_code_startsWith = $("#sparepart_list").jqxComboBox('searchString');
					return data;
				}
			}
		}
		);

		$("#sparepart_list").jqxComboBox(
		{
			width: 200,
			height: 25,
			source: dataAdapter,
			remoteAutoComplete: true,
			autoDropDownHeight: true,               
			selectedIndex: 0,
			displayMember: "part_code",
			valueMember: "id",
			minLength:5,
			renderer: function (index, label, value) {
				var item = dataAdapter.records[index];
				if (item != null) {
					var label = item.part_code;
					return label;
				}
				return "";
			},
			renderSelectedItem: function(index, item)
			{
				var item = dataAdapter.records[index];
				if (item != null) {
					var label = item.part_code;
					return label;
				}
				return "";   
			},
			search: function (searchString) {
				dataAdapter.dataBind();
			}
		});

		$('#part_name').jqxPanel({  height: '30px', width: '200px' });
		$('#part_name').css('border', 'none');

		$('#sparepart_list').on('select', function (event) {
			// $('#part_name').html('');
			var args = event.args;
			if (args != undefined) {
				var item = event.args.item;
				if (item != null) {
					$('#part_name').jqxPanel('clearcontent');
					$('#part_name').jqxPanel('append', '<div style="margin-top: 5px;">' + item.originalItem.name + '</div>');
				}
			}
		});

	// initialize the popup window
	$("#jqxPopupWindowStock_other_dealer").jqxWindow({ 
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

	$("#jqxPopupWindowStock_other_dealer").on('close', function () {
		reset_form_stock_other_dealers();
	});

	$("#jqxStock_other_dealerCancelButton").on('click', function () {
		reset_form_stock_other_dealers();
		$('#jqxPopupWindowStock_other_dealer').jqxWindow('close');
	});

	$("#jqxStock_other_dealerSubmitButton").on('click', function () {
		saveStock_other_dealerRecord();    
	});
});

	function saveStock_other_dealerRecord(){


		$('#jqxGridStock_other_dealer').jqxGrid('updatebounddata');
		var data = $("#form-stock_other_dealers").serialize();

		$('#jqxPopupWindowStock_other_dealer').block({ 
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
			url: '<?php echo site_url("admin/sparepart_stocks/check_dealer_stock"); ?>',
			data: data,
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) {

					reset_form_stock_other_dealers();
					$('#jqxPopupWindowStock_other_dealer').jqxWindow('close');
					$('#jqxPopupWindowStock_other_dealer').unblock();
					
					var data = result.rows;
					var stock_other_dealersDataSource =
					{
						localdata: data ,
						datatype: "json",
						datafields: [
						{ name: 'name', type: 'string' },
						{ name: 'dealer_id', type: 'number' },
						{ name: 'dealer_name', type: 'string' },
						{ name: 'sparepart_name', type: 'string' },
						{ name: 'part_code', type: 'string' },
						{ name: 'sparepart_id', type: 'number' },
						{ name: 'total_quantity', type: 'number' },
						],
						pagesize: defaultPageSize,
						root: 'rows',
						id : 'id',
						cache: true,
						pager: function (pagenum, pagesize, oldpagenum) {
						},
						beforeprocessing: function (data) {
							stock_other_dealersDataSource.totalrecords = data.total;
						},
						filter: function () {
							$("#jqxGridStock_other_dealer").jqxGrid('updatebounddata', 'filter');
						},
						sort: function () {
							$("#jqxGridStock_other_dealer").jqxGrid('updatebounddata', 'sort');
						},
						processdata: function(data) {
						}
					};

					$("#jqxGridStock_other_dealer").jqxGrid({
						theme: theme,
						width: '100%',
						height: gridHeight,
						source: stock_other_dealersDataSource,
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
							container.append($('#jqxGridStock_other_dealerToolbar').html());
							toolbar.append(container);
						},
						columns: [
						{ text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
						{
							text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
							cellsrenderer: function (index) {
								var row = $("#jqxGridStock_other_dealer").jqxGrid('getrowdata', index);
								var e = '<a href="javascript:void(0)" onclick="request_Stock_transfer(' + row.dealer_id + ','+row.sparepart_id+','+result.order_quantity+'); return false;" title="Edit"><i class="fa fa-phone" aria-hidden="true"></i></a>';
								return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
							}
						},

						{ text: '<?php echo lang("dealer_name"); ?>',datafield: 'dealer_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
						{ text: '<?php echo lang("part_code"); ?>',datafield: 'part_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
						{ text: '<?php echo lang("part_name"); ?>',datafield: 'sparepart_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
						{ text: '<?php echo lang("total_quantity"); ?>',datafield: 'total_quantity',width: 150,filterable: true,renderer: gridColumnsRenderer },
						],
						rendergridrows: function (result) {
							return result.data;
						}
					});

					$("[data-toggle='offcanvas']").click(function(e) {
						e.preventDefault();
						setTimeout(function() {$("#jqxGridStock_other_dealer").jqxGrid('refresh');}, 500);
					});
				}
			}
		});
	}

	function reset_form_stock_other_dealers(){
		$('#stock_other_dealers_id').val('');
		$('#form-stock_other_dealers')[0].reset();
	}

	function request_Stock_transfer(dealer_id,sparepart_id,quantity)
	{
		$.ajax({
			type: "POST",
			url: '<?php echo site_url("admin/sparepart_stocks/send_transfer_request"); ?>',
			data: {dealer_id:dealer_id,sparepart_id:sparepart_id,quantity:quantity},
			success: function (result) {
				var result = eval('('+result+')');
				if (result.success) 
				{
					$('#success-msg').show();
				}
				$('#success-msg').delay(3000).fadeOut('slow');
			}
		});
	}	
</script>