<?php
	session_start();
	ob_start();

	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/lead.php';
	require '../model/lead_model.php';
	$db = new Database();

?>
<!-- BEGIN BASE-->
<div id="base">

	<!-- BEGIN OFFCANVAS LEFT -->
	<div class="offcanvas">
	</div><!--end .offcanvas-->
	<!-- END OFFCANVAS LEFT -->

	<!-- BEGIN CONTENT-->
	<div id="content">
		<!-- BEGIN Customer content -->
		<section>
			<div class="section-body">
				<!-- Button - add new customer and add family memmbers -->
				<div class="row">
					<div class="col-lg-offset-0 col-md-12">
						<div class="card card-underline">
							<div class="card-head">
								<header><i class="fa fa-fw fa-users"></i> Leads</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
												<a class="btn btn-success btn-block" href="manage.php" name="btnAddLead" id="btnAddLead">ADD NEW LEAD</a>
											</div>
										</div>
									</div><!--end .card -->
								</div><!--end .col -->

								<div class="col-lg-offset-0 col-md-12">
									<div class = "row" >
										<table class = "table table-hover" id = "lead-tbl">
											<thead>
												<th>Company Name</th>
												<th>Contact Person</th>
												<th>Email</th>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div><!--end .card -->
					</div>
				</div>
			</div>
		</section>
	</div><!--end #content-->
	<!-- END CONTENT -->
</div>
<!-- END BASE -->
<?php
	include '../include/sidebar.php';
	include '../include/end.php';
?>

<script type="text/javascript">
	// $(document).ready(function() {
 //    	$('#lead-tbl').DataTable();
	// } );

	$(document).ready(function()
	{
/*    $('#lead-tbl').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "..//scripts/server_processing.php"
    } );*/

	    $('#lead-tbl').DataTable( {
		"bProcessing": true,
		"bServerSide": true,
        "sPaginationType": "full_numbers",
            "ajax":{
                url :"../process/lead_list.php", // json datasource
                type: "get",  // method  , by default get
            }
	    } );





	} );
</script>
