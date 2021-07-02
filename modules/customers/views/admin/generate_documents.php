
<div id="jqxPopupWindowdelivery_sheet">
	<div class='jqxExpander-custom-div'>
		<span class='popup_title' id="window_poptup_title">Delivery Sheet</span>
	</div>
	<div class="form_fields_area">
		<form method="post" accept-charset="utf-8" action="<?php echo site_url('admin/customers/generate_deliverysheet');?>">
			<input type = "hidden" name = "vehicle_process_id" id = "vehicle_process_id" value="<?php echo $process_detail->vehicle_process_id; ?>"/>
			<input type = "hidden" name = "customer_id" id = "customer_id" value="<?php echo $process_detail->id; ?>"/>
			<input type = "hidden" name = "vehicle_name" id = "vehicle_name" value="<?php echo $process_detail->vehicle_name; ?>"/>
			<input type = "hidden" name = "variant_name" id = "variant_name" value="<?php echo $process_detail->variant_name; ?>"/>
			<input type = "hidden" name = "color_name" id = "color_name" value="<?php echo $process_detail->color_name; ?>"/>
			<input type = "hidden" name="engine_no" id="engine_no">
			<input type = "hidden" name="stock_id" id="stock_id">
			<input type = "hidden" name="msil_dispatch_id" id="msil_dispatch_id">
			<table class="form-table">
				<tr><td><label for="vehicle_name">VEHICLE :</label><input type="hidden" name="vehicle_id"  id="vehicle_id" value="<?php echo $process_detail->vehicle_id; ?>"><?php echo $process_detail->vehicle_name; ?></td></tr>
				<tr><td><label for="variant_name">VARIANT :</label><input type="hidden" name="variant_id" id="variant_id"  value="<?php echo $process_detail->variant_id; ?>"><?php echo $process_detail->variant_name; ?></td></tr>
				<tr><td><label for="color_name">COLOR :</label><input type="hidden" name="color_id"  id="color_id" value="<?php echo $process_detail->color_id;?>"><?php echo $process_detail->color_name; ?></td></tr>
				<tr><td><label for="engine_no">ENGINE NO:</label><div id="chass_no" name="chass_no"></div></td></tr>
				<tr><td><div id="displaychassis"></div></td></tr>			
				<tr>
					<th>
						<button type="submit" class="btn btn-success btn-md btn-flat" id="jqxdelivery_sheetSubmitButton"><?php echo "Generate"//lang('general_save'); ?></button>
						<button type="button" class="btn btn-default btn-md btn-flat" id="jqxdelivery_sheetCancelButton"><?php echo lang('general_cancel'); ?></button>
					</th>
				</tr>
			</table>
			<?php echo form_close(); ?>
		</div>
	</div>	

	<script type="text/javascript">
		$(function(){

			$("#jqxPopupWindowdelivery_sheet").jqxWindow({
				theme: theme,
				width: '30%',
				maxWidth: '30%',
				height: '40%',
				maxHeight: '40%',
				isModal: true,
				autoOpen: false,
				modalOpacity: 0.7,
				showCollapseButton: false
			});

			$("#jqxPopupWindowdelivery_sheet").on('close', function () {
			});

			$("#jqxdelivery_sheetCancelButton").on('click', function () {
				$('#jqxPopupWindowdelivery_sheet').jqxWindow('close');
			});		
		});

		function delivery_sheet() 
		{
			$('#displaychassis').html('');
			var vehicle_id = $('#vehicle_id').val();
			var variant_id = $('#variant_id').val();
			var color_id = $('#color_id').val();

			var stockrecordDatasource = {
				url : '<?php echo site_url("admin/customers/get_stock_json");?>',
				datatype: 'json',
				datafields: [
				{ name: 'chass_no', type: 'number' },
				{ name: 'stock_id', type: 'number' },
				{ name: 'msil_dispatch_id', type: 'number' },
				{ name: 'engine_no', type: 'string' },
				],
				data: {
					veh_id : vehicle_id,
					var_id : variant_id,
					color_id : color_id
				},
				async: false,
				cache: true
			}
			stockrecordDataAdapter = new $.jqx.dataAdapter(stockrecordDatasource);

			$("#chass_no").on('select', function (event) {
				if (event.args) {
					var item = event.args.item;
					if (item) {					
						$("#engine_no").val(item.label);
						$('#stock_id').val(item.originalItem.stock_id);
						$('#msil_dispatch_id').val(item.originalItem.msil_dispatch_id);
						var labelelement = $("<div></div>");
						labelelement.html("<label for='chassis_no'>CHASSIS NO:</label> " + item.value);
						$("#displaychassis").children().remove();
						$("#displaychassis").append(labelelement);
					}
				}
			});

			$("#chass_no").jqxComboBox({
				theme: theme,
				width: 195,
				height: 25,
				selectionMode: 'dropDownList',
				autoComplete: true,
				searchMode: 'containsignorecase',
				source: stockrecordDataAdapter,
				displayMember: "engine_no",
				valueMember: "chass_no",
			});

			openPopupWindow('jqxPopupWindowdelivery_sheet', '<?php echo "Delivery Sheet" . "&nbsp;" .  $header; ?>');
		}

	</script>