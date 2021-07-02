<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo lang('stock_records'); ?></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active"><?php echo lang('stock_records'); ?></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- row -->
    <div class="row">

      <div class="col-xs-12 connectedSortable">
        <?php echo displayStatus(); ?>
        <div id="jqxGridStock_record"></div>
      </div><!-- /.col -->
    </div>
    <!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="jqxPopupWindowPdi">
  <div class='jqxExpander-custom-div'>
    <span class='popup_title' id="window_poptup_title"></span>
  </div>
  <div class="form_fields_area">
    <?php echo form_open('', array('id' =>'form-sales_pdi_damage', 'onsubmit' => 'return false')); ?>
    <input type = "hidden" name = "id" id = "sales_pdis_id"/>
    <table class="form-table">
      <tr>
        <td><label for='pdi_date'><?php echo "PDI Date"?></label></td>
        <td><div id='pdi_date' class='date_box' name='pdi_date'></div></td>
      
        <td><label for='pdi_to_yard_date'>PDI To Yard Date</label></td>
        <td><div id='pdi_to_yard_date' class='date_box' name='pdi_to_yard_date'></div></td>
      </tr>
      <tr>
        <td><label for='yard_location'>yard_location</label></td>
        <td><input type='text' id='yard_location' class='text_input' name='yard_location'></td>
      
        <td><label for='pdi_status'>PDI Status</label></td>
        <td><input type='text' id='pdi_status' class='text_input' name='pdi_status'></td>
      </tr>
      <tr>
        <td><label for='pdi_job_card_open_date'>PDI Job Card Open Date</label></td>
        <td><div id='pdi_job_card_open_date' class='date_box' name='pdi_job_card_open_date'></div></td>
      
        <td><label for='pdi_job_card_no'>PDI Job Card No</label></td>
        <td><input type="text" id='pdi_job_card_no' class='text_input' name='pdi_job_card_no'></td>
      </tr>
      <tr>
        <td><label for='pdi_bill_no'>PDI Bill No</label></td>
        <td><input type="text" id='pdi_bill_no' class='text_input' name='pdi_bill_no'></td>
      
        <td><label for='pdi_bill_date'>PDI Bill Date</label></td>
        <td><div id='pdi_bill_date' class='date_box' name='pdi_bill_date'></div></td>
      </tr>
      <tr>
        <td><label for='stock_out_date'>Stock Out Date</label></td>
        <td><div id='stock_out_date' class='date_box' name='stock_out_date'></div></td>
      
        <td><label for='dealers_return_date'> Dealers Return Date</label></td>
        <td><div id='dealers_return_date' class='date_box' name='dealers_return_date'></div></td>
      </tr>
      <tr>
        <td><label for='allocation_date'>Allocation Date</label></td>
        <td><div id='allocation_date' class='date_box' name='allocation_date'></div></td>
      
        <td><label for='allocation_type'>Allocation Type</label></td>
        <td><input type="text" id='allocation_type' class='text_input' name='allocation_type'></td>
      </tr>
      <tr>
        <td><label for='received_confirmation_via_challan'>Received Confirmation Via Challan</label></td>
        <td><input type="text" id='received_confirmation_via_challan' class='text_input' name='received_confirmation_via_challan'></td>
      
        <td><label for='insurance_email_date'>Insurance Email Date</label></td>
        <td><div id='insurance_email_date' class='date_box' name='insurance_email_date'></div></td>
      </tr>
      <tr>
        <td><label for='pdi_remarks'>PDI Remarks</label></td>
        <td><textarea id='pdi_remarks' class='text_area' name='pdi_remarks'></textarea></td>
      </tr>
      <tr>
        <th colspan="2">
          <button type="button" class="btn btn-success btn-xs btn-flat" id="jqxSales_pdiSubmitButton"><?php echo lang('general_save'); ?></button>
          <button type="button" class="btn btn-default btn-xs btn-flat" id="jqxSales_pdiCancelButton"><?php echo lang('general_cancel'); ?></button>
        </th>
      </tr>

    </table>
    <?php echo form_close(); ?>
  </div>
</div>


<script language="javascript" type="text/javascript">

  $(function(){    
    // $("#pdi_date").jqxDateTimeInput({ width: '250px', height: '25px',formatString: 'yyyy-M-d'});
    $('.date_box').jqxDateTimeInput({allowNullDate: true});
    $('.date_box').jqxDateTimeInput('val','');

    var stock_recordsDataSource =
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
      { name: 'vehicle_id', type: 'number' },
      { name: 'variant_id', type: 'number' },
      { name: 'color_id', type: 'number' },
      { name: 'stock_yard_id', type: 'number' },
      { name: 'reached_date', type: 'string' },
      { name: 'dispatched_date', type: 'string' },
      { name: 'vehicle_name', type: 'string' },
      { name: 'variant_name', type: 'string' },
      { name: 'color_name', type: 'string' },
      { name: 'color_code', type: 'string' },
      { name: 'engine_no', type: 'string' },
      { name: 'chass_no', type: 'string' },
      { name: 'stock_yard', type: 'string' },
      { name: 'location', type: 'string' },
      { name: 'damage_date', type: 'string' },
      { name: 'is_damage', type: 'number' },
      { name: 'repair_date', type: 'string' },
      { name: 'accident_type', type: 'string' },
      { name: 'repair_commitment_date', type: 'string' },
      { name: 'remarks', type: 'string' },
      { name: 'dealer_reject', type: 'number' },
      { name: 'dealer_id', type: 'number' },
      { name: 'dispatch_id', type: 'number' },
      { name: 'vehicle_return', type: 'number' },
      { name: 'dispatch_to_dealer_date', type: 'string' },
      { name: 'actual_location', type: 'string' },
      { name: 'current_location', type: 'string' },
      { name: 'current_status', type: 'string' },
      { name: 'dispatch_date_to_customer', type: 'string' },
      { name: 'order_id', type: 'number' },
      { name: 'stock_id', type: 'number' },
      { name: 'pdi_date', type: 'date' },
      { name: 'pdi_date_np', type: 'string' },
      { name: 'year', type: 'string' },
      { name: 'firm_name', type: 'string' },
      { name: 'msil_dispatch_date', type: 'date' },
      { name: 'age', type: 'number' },
      { name: 'custom_name', type: 'string' },
      { name: 'driver_name', type: 'string' },
      { name: 'driver_number', type: 'string' },
      { name: 'logistic_confirmation_date', type: 'date' },
      { name: 'pdi_to_yard_date', type: 'date' },
      { name: 'yard_location', type: 'string' },
      { name: 'pdi_status', type: 'string' },
      { name: 'pdi_job_card_open_date', type: 'date' },
      { name: 'pdi_job_card_no', type: 'string' },
      { name: 'pdi_bill_no', type: 'string' },
      { name: 'pdi_bill_date', type: 'date' },
      { name: 'pdi_bill_month', type: 'string' },
      { name: 'stock_out_date', type: 'date' },
      { name: 'dealers_return_date', type: 'date' },
      { name: 'allocation_date', type: 'date' },
      { name: 'allocation_age', type: 'number' },
      { name: 'allocation_type', type: 'string' },
      { name: 'received_confirmation_via_challan', type: 'string' },
      { name: 'insurance_email_date', type: 'date' },
      { name: 'pdi_remarks', type: 'string' },

      ],
      url: '<?php echo site_url("admin/stock_records/json"); ?>',
      pagesize: defaultPageSize,
      root: 'rows',
      id : 'id',
      cache: true,
      pager: function (pagenum, pagesize, oldpagenum) {
      },
      beforeprocessing: function (data) {
        stock_recordsDataSource.totalrecords = data.total;
      },
      filter: function () {
        $("#jqxGridStock_record").jqxGrid('updatebounddata', 'filter');
      },
      sort: function () {
        $("#jqxGridStock_record").jqxGrid('updatebounddata', 'sort');
      },
      processdata: function(data) {
      }
    };

    $("#jqxGridStock_record").jqxGrid({
      theme: theme,
      width: '100%',
      height: gridHeight,
      source: stock_recordsDataSource,
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
      selectionmode: 'multiplecells',
      virtualmode: true,
      enableanimations: false,
      pagesizeoptions: pagesizeoptions,
      showtoolbar: true,
      rendertoolbar: function (toolbar) {
        var container = $("<div style='margin: 5px; height:50px'></div>");
        container.append($('#jqxGridStock_recordToolbar').html());
        toolbar.append(container);
      },
      columns: [
      { text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},
      {
        text: 'Action', datafield: 'action', width:75, sortable:false,filterable:false, pinned:true, align: 'center' , cellsalign: 'center', cellclassname: 'grid-column-center', 
        cellsrenderer: function (index,b,c,d,e,value) {
          var e = '';

          if(value.is_damage == 0)
          {         
            e += '<a href="javascript:void(0)" onclick="Pdi_entry(' + index + '); return false;" title="Pdi Entry"><i class="fa fa-calendar"></i></a>&nbsp';
          }

          return '<div style="text-align: center; margin-top: 8px;">' + e + '</div>';
        }     
      },
      { text: '<?php echo lang("vehicle_name"); ?>',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("variant_name"); ?>',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("color_name"); ?>',datafield: 'color_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("color_code"); ?>',datafield: 'color_code',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("engine_no"); ?>',datafield: 'engine_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("chass_no"); ?>',datafield: 'chass_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Year',datafield: 'year',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("firm_name"); ?>',datafield: 'firm_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("msil_dispatch_date"); ?>',datafield: 'msil_dispatch_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Age',datafield: 'age',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Current Status',datafield: 'current_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Current Location',datafield: 'current_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Defect Received',datafield: 'accident_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Dispatch From',datafield: 'custom_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo lang("dispatched_date"); ?>',datafield: 'dealer_dispatch_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Driver Name',datafield: 'driver_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Driver Number',datafield: 'driver_number',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Received Date',datafield: 'logistic_confirmation_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI To Yard Date',datafield: 'pdi_to_yard_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Yard Location',datafield: 'yard_location',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI Status',datafield: 'pdi_status',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: '<?php echo "Pdi Date" ?>',datafield: 'pdi_date',width: 150,filterable: true,renderer: gridColumnsRenderer, columntype: 'date', filtertype: 'range', cellsformat:  formatString_yyyy_MM_dd},
      { text: '<?php echo "Pdi Date Nep"; ?>',datafield: 'pdi_date_np',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI Job Card Open Date',datafield: 'pdi_job_card_open_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI Job Card Number',datafield: 'pdi_job_card_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI Bill Number',datafield: 'pdi_bill_no',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI Bill Month',datafield: 'pdi_bill_month',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Stock Out Date',datafield: 'stock_out_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Dealer Retuen Date',datafield: 'dealers_return_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Allocation Date',datafield: 'allocation_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Allocation Age',datafield: 'allocation_age',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Allocation Type',datafield: 'allocation_type',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Received Confirmation Via Challan',datafield: 'received_confirmation_via_challan',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'Insurance Email Date',datafield: 'insurance_email_date',width: 150,filterable: true,renderer: gridColumnsRenderer },
      { text: 'PDI Remarks',datafield: 'pdi_remarks',width: 150,filterable: true,renderer: gridColumnsRenderer },

      ],
      rendergridrows: function (result) {
        return result.data;
      }
    });

    $("[data-toggle='offcanvas']").click(function(e) {
      e.preventDefault();
      setTimeout(function() {$("#jqxGridStock_record").jqxGrid('refresh');}, 500);
    });

    $(document).on('click','#jqxGridStock_recordFilterClear', function () { 
      $('#jqxGridStock_record').jqxGrid('clearfilters');
    });

    $("#jqxPopupWindowPdi").jqxWindow({ 
      theme: theme,
      width: '60%',
      maxWidth: '60%',
      height: '430px',  
      maxHeight: '430px',  
      isModal: true, 
      autoOpen: false,
      modalOpacity: 0.7,
      showCollapseButton: false 
    });

    $("#jqxPopupWindowPdi").on('close', function () {
    });

    $("#jqxSales_pdiCancelButton").on('click', function () {
      $('#jqxPopupWindowPdi').jqxWindow('close');
    });

    $('#form-sales_pdi_damage').jqxValidator({
      hintType: 'label',
      animationDuration: 500,
      rules: [
      { input: '#pdi_date', message: 'Required', action: 'blur', 
      rule: function(input) {
        val = $('#pdi_date').val();
        return (val == '' || val == null || val == 0) ? false: true;
      }
    },
    ]
  });
    $("#jqxSales_pdiSubmitButton").on('click', function () {    
      var validationResult = function (isValid) {
        if (isValid) {
          save_Pdi_date();
        }
      };
      $('#form-sales_pdi_damage').jqxValidator('validate', validationResult); 
    });

  });

function Pdi_entry(index){
  var row =  $("#jqxGridStock_record").jqxGrid('getrowdata', index);
  if (row) {
    $('#sales_pdis_id').val(row.stock_id);
    $.each(row, function(index,value){
      $('#'+index).val(value);
      console.log(index + value);
    });
    openPopupWindow('jqxPopupWindowPdi', '<?php echo "Pdi Entry"; ?>');
  }
}


function save_Pdi_date(){
  var data = $("#form-sales_pdi_damage").serialize();

  $('#jqxPopupWindowPdi').block({ 
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
    url: '<?php echo site_url("admin/stock_records/save_pdi_date"); ?>',
    data: data,
    success: function (result) {
      var result = eval('('+result+')');
      if (result.success) {
        $('#jqxGridStock_record').jqxGrid('updatebounddata');
        $('#jqxPopupWindowPdi').jqxWindow('close');
      }
      $('#jqxPopupWindowPdi').unblock();
    }
  });
}
</script>