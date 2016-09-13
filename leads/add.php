<?php
	session_start();
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/position.php';
	require '../class/sicode.php';
	require '../class/state.php';

	require '../model/position_model.php';
	require '../model/sicode_model.php';
	require '../model/state_model.php';

	$list_positions = new Position_Model(new Database());
	$list_siccode = new SICode_Model(new Database());
	$list_state = new State_Model(new Database());
																													
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
												<form class="form-horizontal" method = "post" action = '../process/lead_add.php'>
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
																	<label class="col-sm-2 control-label">Contact Person</label>
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
															<div class="col-sm-2">
																<select name = "position" class = "form-control">
																	<?php 
																		$pos = $list_positions->get_all("positions");
																		foreach ($pos as $p) :
																			$position = new Position();
																			$position->setId($p['id']);
																			$position->setPosition($p['position']);
																	?>
																		<option value = "<?php echo $position->getId(); ?>"><?php echo $position->getPosition(); ?></option>
																	<?php endforeach; ?>
																</select>	
															</div>
															<label for="email" class="col-sm-2 control-label">Siccode</label>
															<div class="col-sm-2">
																<select name = "siccode" class = "form-control">
																	<?php 
																		$sic = $list_siccode->get_all("siccode");
																		foreach ($sic as $p) :
																			$siccode = new SICode();
																			$siccode->setId($p['id']);
																			$siccode->setDescription($p['description']);
																			
																	?>
																		<option value = "<?php echo $siccode->getId(); ?>"><?php echo $siccode->getDescription(); ?></option>
																	<?php endforeach; ?>
																</select>
																
															</div>
															

															<label for="email" class="col-sm-2 control-label">Email</label>
															<div class="col-sm-2">
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
																		<select name = "state" class = "form-control" id = "state" required>
																			<?php $states = $list_state->get_all('state');  foreach ($states as $s ): ?>
																			<?php 
																				$state = new State();
																				$state->setId($s['id']);
																				$state->setCode($s['code']);
																			?>
																				<option value = "<?php echo $state->getId(); ?>"><?php echo $state->getCode(); ?></option>
																			<?php endforeach; ?>
																		</select>
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
																<button type="submit" name = "create_lead" class="btn btn-info">CREATE LEAD</button>
															</div>
														</div>
													</div><!--end .card-body -->
												</form>
													<?php
													if(isset($_GET['msg']))
													{
														$msg = $_GET['msg'];
														if($msg == 'inserted')
															$error = 'Record Successfully Saved';
														echo '<span>'.$error.'</span>';
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
