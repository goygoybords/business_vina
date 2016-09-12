<?php
	 session_start(); 
	if(isset($_SESSION['isLogin']) == false)
		header("location: ../index.php");

	set_include_path('../include');
	include 'start.html'; 
	require('header.php');					
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
								<header><i class="fa fa-fw fa-home"></i> Main</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										

									</div><!--end .card -->
								</div><!--end .col -->
								<div class="col-md-12">

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
	include 'sidebar.php'; 
	include 'end.html';	
?>
