<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">		
		<h1><?php echo lang('msil_orders'); ?></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active"><?php echo lang('msil_orders'); ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">		
		<table id="table" border="1">
			<thead>
				<tr>
					<th>Invalid Part Code</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($rows as $key => $value): ?>
					<tr>
						<td>
							<?php echo $value['part_code']?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {            
        $("#table").jqxDataTable(
        {
            altRows: true,
            sortable: true,
            editable: true,
            selectionMode: 'multiplecells',
            columns: [
              { text: 'Invalid Part Code', dataField: 'Invalid Part Code', width: 200 },
            ]
        });
    });
</script>
