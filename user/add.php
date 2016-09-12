<?php
	session_start();	
	include '../include/start.html'; 
	require('../include/header.php');					
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
								<header><i class="fa fa-fw fa-user-plus"></i> Add New User</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-1 col-lg-2"></div> 
											<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
												<form class="form-horizontal">
													<div class="card-body" id="div-add-user">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="Firstname5" class="col-sm-4 control-label">Firstname</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="Firstname5">
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="Lastname5" class="col-sm-4 control-label">Lastname</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="Lastname5">
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="Username5" class="col-sm-2 control-label">Username</label>
															<div class="col-sm-10">
																<input type="text" class="form-control" id="Username5">
															</div>
														</div>
														<div class="form-group">
															<label for="Password5" class="col-sm-2 control-label">Password</label>
															<div class="col-sm-10">
																<input type="password" class="form-control" id="Password5">
															</div>
														</div>
														<div class="form-group">
															<label for="RetypePassword5" class="col-sm-2 control-label">Re-type Password</label>
															<div class="col-sm-10">
																<input type="password" class="form-control" id="RetypePassword5">
															</div>
														</div>														
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<button type="submit" class="btn btn-info">CREATE ACCOUNT</button>
															</div>			
														</div>											
													</div><!--end .card-body -->
												</form>												
											</div>
											<div class="col-xs-12 col-sm-12 col-md-1 col-lg-2"></div> 
										</div>
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
	include '../include/sidebar.php'; 
	include '../include/end.html';	
?>
