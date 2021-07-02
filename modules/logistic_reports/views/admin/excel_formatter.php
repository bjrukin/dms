<style type="text/css">
#data-table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed; 
}
#data-table th, #data-table td{
    text-align: center;
    vertical-align: middle;
}
#data-table td:first-child {
    width: 300px!important;
    font-size: 105%
}
.box.box-solid>.box-header .btn:hover, .box.box-solid>.box-header a:hover {
    background-color: #367fa9;
}
.report-cell {min-width: 100px;max-width: 350px}
</style>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};
function create_sortable()
{
	$('#excels').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		handle:'.handle',
		update: function(){
			save_sortable();
		}
	});	
	$('#excels').sortable('enable');
}

function save_sortable()
{
	serial=$('#excels').sortable('serialize');
			
	$.ajax({
		url:'<?php echo site_url('admin/logistic_reports/organize_excel_report');?>',
		type:'POST',
		data:serial
	});
}

//]]>
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
        	<div class="box box-solid">
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                      	<tr>
	                        Drag To Sort 
                    	</tr>
	                </table>
	                <br />                
	            </div>
	        </div>
            <table class="table table-striped" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th><?php echo lang('sort');?></th>
						<th><?php echo lang('vehicle');?></th>
						<th><?php echo lang('variant');?></th>
						<th><?php echo lang('color');?></th>
						<th></th>
					</tr>
				</thead>
				<tbody id="excels">
					<?php foreach ($result_sql as $result):?>
						<tr id="excel-<?php echo $result['RANK'];?>">
							<td class="handle"><a class="btn" style="cursor:move"><span class="fa fa-list"></span></a></td>
							<td><?php echo  $result['Model']; ?></td>
							<td><?php echo $result['Variant'];?></td>
							<td><?php echo $result['Color'];?></td>							
					  </tr>
					<?php endforeach; ?>
				</tbody>
			</table>
	    </div><!-- /.col -->
	</div>
	<!-- /.row -->
</section><!-- /.content -->