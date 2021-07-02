
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui.min.js');?>"></script>

<!-- PivotTable.js libs from ../dist -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/pivot/pivot.css');?>">
<script type="text/javascript" src="<?php echo site_url('assets/js/pivot/pivot.js');?>"></script>

<style type="text/css">
    .data-table{
        width:100%;
        border-collapse:collapse;
        table-layout:fixed; 
    }
    .data-table th, .data-table td{
        text-align: center;
        vertical-align: middle;
        font-weight: normal!important;       
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo lang('crm_reports'); ?><small>Follow Up Report</small></h1>
		<ol class="breadcrumb">
	        <li><a href="<?php echo site_url();?>"><?php echo lang('menu_home');?></a></li>
	        <li><a href="<?php echo site_url('admin/crm-reports');?>"><?php echo lang('crm_reports');?></a></li>
	       
      </ol>
	</section>
	<!-- Main content -->
	<section class="content">
	<section class="content">
    <!-- row -->
    <div class="row">

      <div class="col-xs-12 connectedSortable">
        <?php echo displayStatus(); ?>
        <div id="jqxGridFollowup_Record"></div>
      </div><!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
</div><!-- /.content-wrapper -->


<script type="text/javascript">



  $(function(){



  var followup_recordsDataSource =
  {
    datatype: "json",
    datafields: [
    { name: 'id', type: 'number' },
    { name: 'customer_id', type: 'number' },
    // { name: 'created_by', type: 'number' },
    // { name: 'updated_by', type: 'number' },
    // { name: 'deleted_by', type: 'number' },
    // { name: 'created_at', type: 'string' },
    // { name: 'updated_at', type: 'string' },
    // { name: 'deleted_at', type: 'string' },
    // { name: 'vehicle_id', type: 'number' },
    
 
 
     { name: 'name', type: 'string' },
   
   
    
    { name: 'variant_name', type: 'string' },
    { name: 'vehicle_name', type: 'string' },
   
   
    { name: 'inquiry_count', type: 'number' },
    { name: 'follow_count', type: 'number' },
    { name: 'pending_follow_count', type: 'number' },
    
   
    ],
    url: '<?php echo site_url("admin/crm_reports/get_followup_combo_json"); ?>',
    pagesize: defaultPageSize,
    root: 'rows',
    id : 'id',
    cache: true,
    pager: function (pagenum, pagesize, oldpagenum) {
//callback called when a page or page size is changed.
},
beforeprocessing: function (data) {
  followup_recordsDataSource.totalrecords = data.total;
},
// update the grid and send a request to the server.
filter: function () {
  $("#jqxGridFollowup_Record").jqxGrid('updatebounddata', 'filter');
},
// update the grid and send a request to the server.
sort: function () {
  $("#jqxGridFollowup_Record").jqxGrid('updatebounddata', 'sort');
},
processdata: function(data) {
}
};

$("#jqxGridFollowup_Record").jqxGrid({
  theme: theme,
  width: '100%',
  height: gridHeight,
  source: followup_recordsDataSource,
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
  // selectionmode: 'multiplecellsadvanced',
  virtualmode: true,
  enableanimations: false,
  pagesizeoptions: pagesizeoptions,
  showtoolbar: true,
  rendertoolbar: function (toolbar) {
    var container = $("<div style='margin: 5px; height:50px'></div>");
    container.append($('#jqxGridFollowup_RecordToolbar').html());
    toolbar.append(container);
  },
  columns: [
  { text: 'SN', width: 50, pinned: true, exportable: false,  columntype: 'number', cellclassname: 'jqx-widget-header', renderer: gridColumnsRenderer, cellsrenderer: rownumberRenderer , filterable: false},



  
  { text: 'Dealer Name',datafield: 'name',width: 250,filterable: true,renderer: gridColumnsRenderer },
  
  { text: 'Vehicle Name',datafield: 'vehicle_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  // { text: 'Varirant Name',datafield: 'variant_name',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: 'Inquiry Count',datafield: 'inquiry_count',width: 150,filterable: true,renderer: gridColumnsRenderer },
  { text: 'No of Followup',datafield: 'follow_count',width: 150,filterable: false,renderer: gridColumnsRenderer },
  { text: 'No of Followup Pending',datafield: 'pending_follow_count',width: 150,filterable: false,renderer: gridColumnsRenderer },
 
  
  ],
  rendergridrows: function (result) {
    return result.data;
  }
});

$("[data-toggle='offcanvas']").click(function(e) {
  e.preventDefault();
  setTimeout(function() {$("#jqxGridFollowup_Record").jqxGrid('refresh');}, 500);
});

$(document).on('click','#jqxGridStock_recordFilterClear', function () { 
  $('#jqxGridFollowup_Record').jqxGrid('clearfilters');
});







});








</script>