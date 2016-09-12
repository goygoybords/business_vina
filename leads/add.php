<?php
	session_start();
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/position.php';
	require '../model/position_model.php';
	
	$table = "leads";
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
								<header><i class="fa fa-fw fa-user-plus"></i> Add New Lead</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">
												<form class="form-horizontal" method = "post" action = '../process/add_lead.php'>
													<div class="card-body" id="div-add-lead">
														<div class="form-group">
															<label for="companyname" class="col-sm-2 control-label">Company Name</label>
															<div class="col-sm-10">
																<input type="text" name = "companyname" class="form-control"  id="companyname" required>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-sm-2 control-label">Name</label>
																	<div class="col-sm-4">
																		<input type="text" name = "firstname" class="form-control" id="firstname" required placeholder='Firstname'>
																	</div>
																	<div class="col-sm-3">
																		<input type="text" name = "middlename" class="form-control" id="middlename" required placeholder='Middlename'>
																	</div>
																	<div class="col-sm-3">
																		<input type="text" name = "lastname" class="form-control" id="lastname" required placeholder='Lastname'>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="email" class="col-sm-2 control-label">Position</label>
															<div class="col-sm-4">
																<?php
																		$positions = new Position_Model();
																		print_r($positions->get_all("positions"));
																?>
															</div>
															<label for="email" class="col-sm-2 control-label">Email</label>
															<div class="col-sm-4">
																<input type="text" name = "email" class="form-control"  id="email" required>
															</div>
														</div>
														<div class="form-group">
															<label for="address" class="col-sm-2 control-label">Address</label>
															<div class="col-sm-10">
																<input type="text" name = "address" class="form-control"  id="address" required>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-sm-2 control-label"></label>
																	<div class="col-sm-4">
																		<input type="text" name = "city" class="form-control" id="city" required placeholder='City'>
																	</div>
																	<div class="col-sm-3">
																		<input type="text" name = "state" class="form-control" id="state" required placeholder='State'>
																	</div>
																	<div class="col-sm-3">
																		<input type="text" name = "zip" class="form-control" id="zip" required placeholder='Zip'>
																	</div>
																</div>
															</div>
														</div>
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<button type="submit" name = "register" class="btn btn-info">CREATE LEAD</button>
															</div>
														</div>
													</div><!--end .card-body -->
												</form>
													<?php
													if(isset($_GET['msg']))
													{

													}
												?>

											</div>
											<div class="col-xs-12 col-sm-12 col-lg-1"></div>
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
