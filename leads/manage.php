<?php
	session_start();
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/position.php';
	require '../class/sicode.php';
	require '../class/state.php';
	require '../class/phones.php';
	require '../class/phonetypes.php';
	require '../class/lead.php';

	require '../model/position_model.php';
	require '../model/sicode_model.php';
	require '../model/state_model.php';
	require '../model/phones_model.php';
	require '../model/phonetypes_model.php';
	require '../model/lead_model.php';

	$list_positions = new Position_Model(new Database());
	$list_siccode = new SICode_Model(new Database());
	$list_state = new State_Model(new Database());
	$list_phones = new Phone_Model(new Database());
	$list_phonetypes = new PhoneTypes_Model(new Database());
	$lead_model = new Lead_Model(new Database());

	$lead_id = (isset($_GET["id"]) ? $_GET["id"] : "");

	$lead_record = new Leads();
	$lead_phones = null;
	$phone_types = $list_phonetypes->get_all("phonetypes");

	$form_state = 1;
	$form_header = "Add New Lead";
	$submit_caption = "Create Lead";
	$submit_url = "../process/lead_add.php";

	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");
	if($lead_id)
	{
			if($msg != 'deleted')
			{
				$table = 'leads';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($lead_id);
				$leads = $lead_model->get_by_id($table, $fields, $where, $params);

				if(count($leads))
				{
					foreach ($leads as $l)
					{
						$lead_record->setId($l['id']);
						$lead_record->setCompanyname($l['companyname']);
						$lead_record->setPosition($l['position']);
						$lead_record->setFirstname($l['firstname']);
						$lead_record->setMiddlename($l['middlename']);
						$lead_record->setLastname($l['lastname']);
						$lead_record->setEmail($l['email']);
						$lead_record->setSiccode($l['siccode']);
						$lead_record->setLeaddetailsid($l['leaddetailsid']);
						$lead_record->setAddress($l['address']);
						$lead_record->setCity($l['city']);
						$lead_record->setZip($l['zip']);
						$lead_record->setState($l['state']);
						$lead_record->setDatecreated($l['datecreated']);
						$lead_record->setDatelastupdated($l['datelastupdated']);
						$lead_record->setStatus($l['status']);
					}

					if($lead_record->getStatus() == 1)
					{
						$lead_phones = $list_phones->get_phones_by_leadid($lead_record->getId());
						$form_state = 2;
						$form_header = "Edit Lead Details";
						$submit_caption = "Save Changes";
						$submit_url = "../process/lead_manage.php";
					}
					else
					{
						$lead_record = new Leads();
						$_GET["msg"] = "prev_deleted";
					}
				}
				else
				{
					$_GET["msg"] = "none";
				}
			}
	}

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
								<header><i class="fa fa-fw fa-user-plus"></i> <?php echo $form_header; ?></header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<form class="form" method = "post" action = '<?php echo $submit_url; ?>'>
													<input type="hidden" name="id" id="id" value="<?php echo $lead_record->getId() ?>" />
													<div class="card-body" id="div-add-lead">
														<div class="row">
															<div class="col-sm-12">
																<!-- <div class="form-group">
																	<div class="col-sm-6">
																		<label for="companyname">Company Name</label>
																	</div>
																</div> -->
																<div class="form-group">
																	<label class="col-sm-12 control-label">Company Name</label>
																	<div class="col-sm-6">
																		<input type="text" name = "companyname" class="form-control"  id="companyname" value="<?php echo $lead_record->getCompanyname(); ?>" required autofocus='autofocus'>
																	</div>
																</div>

															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-sm-12 control-label">Contact Person</label>
																	<div class="col-sm-4">
																		<input type="text" name = "firstname" class="form-control" id="firstname" value="<?php echo $lead_record->getFirstname(); ?>" required placeholder='Firstname'>
																	</div>
																	<div class="col-sm-4">
																		<input type="text" name = "middlename" class="form-control" id="middlename" value="<?php echo $lead_record->getMiddlename(); ?>" required placeholder='Middlename'>
																	</div>
																	<div class="col-sm-4">
																		<input type="text" name = "lastname" class="form-control" id="lastname" value="<?php echo $lead_record->getLastname(); ?>" required placeholder='Lastname'>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-sm-12 control-label">Contact Person Details</label>
																	<div class="col-sm-4">
																		<select name = "position" id = "position" class = "form-control" required>
																			<option>Choose A Position</option>
																			<?php
																				$pos = $list_positions->get_all("positions");
																				foreach ($pos as $p) :
																					$position = new Position();
																					$position->setId($p['id']);
																					$position->setPosition($p['position']);
																			?>
																				<option value = "<?php echo $position->getId(); ?>"  <?php echo ($position->getId() == $lead_record->getPosition() ? "selected='selected'" : ""); ?> ><?php echo $position->getPosition(); ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																	<div class="col-sm-4">
																		<select name = "siccode" class = "form-control" required>
																			<option>Choose a SI Code</option>
																			<?php
																				$sic = $list_siccode->get_all("siccode");
																				foreach ($sic as $p) :
																					$siccode = new SICode();
																					$siccode->setId($p['id']);
																					$siccode->setDescription($p['description']);
																			?>
																				<option value = "<?php echo $siccode->getId(); ?>" <?php echo ($siccode->getId() == $lead_record->getSiccode() ? "selected='selected'" : ""); ?>><?php echo $siccode->getDescription(); ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																	<div class="col-sm-4">
																		<input type="text" name = "email" class="form-control"  id="email" placeholder = "Email" value="<?php echo $lead_record->getEmail(); ?>" required>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label for="address" class="col-sm-2 control-label">Address</label>
																	<div class="col-sm-10">
																		<input type="text" name = "address" class="form-control"  id="address" value="<?php echo $lead_record->getAddress(); ?>" required>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group">
																	<label class="col-sm-2 control-label"></label>
																	<div class="col-sm-4">
																		<input type="text" name = "city" class="form-control" id="city" required value="<?php echo $lead_record->getCity(); ?>" placeholder='City'>
																	</div>
																	<div class="col-sm-3">
																		<select name = "state" class = "form-control" id = "state" required>
																			<?php $states = $list_state->get_all('state');  foreach ($states as $s ): ?>
																			<?php
																				$state = new State();
																				$state->setId($s['id']);
																				$state->setCode($s['code']);
																			?>
																				<option value = "<?php echo $state->getId(); ?>" <?php echo ($state->getId() == $lead_record->getState() ? "selected='selected'" : ""); ?>><?php echo $state->getCode(); ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																	<div class="col-sm-3">
																		<input type="text" name = "zip" class="form-control" id="zip" required value="<?php echo $lead_record->getZip(); ?>" placeholder='Zip'>
																	</div>
																</div>
															</div>
														</div>
														<br />
														<div class="form-group">
															<div class="col-sm-2"></div>
															<div class="col-sm-10">
																	<div class="row">
																		<div class="col-sm-4">
																			<div class="form-group">
																				<label for="phones[]" class="control-label">Contact Numbers</label>
																			</div>
																		</div>
																	</div>
																	<?php
																		foreach ($phone_types as $pt) :
																			$phone_type = new PhoneTypes();
																			$phone_type->setId($pt['id']);
																			$phone_type->setType($pt['type']);
																	?>
																	<div class="row">
																		<div class="col-sm-4">
																				<div class="form-group">
																					<input type="text" name = "phones[]" class="form-control" value="<?php
																						if($form_state == 2)
																						{
																							foreach($lead_phones as $lp)
																							{
																								$lead_phone = new Phone();
																								$lead_phone->setId($lp['id']);
																								$lead_phone->setNumber($lp['number']);
																								$lead_phone->setPhoneTypeId($lp['phonetypeid']);
																								$lead_phone->setLeadId($lp['leadid']);

																								if($lead_phone->getPhoneTypeId() == $phone_type->getId())
																								{
																									echo $lead_phone->getNumber();
																									break;
																								}
																							}
																						}
																					 ?>" placeholder="<?php echo $phone_type->getType();  ?>" maxlength="20" />
																					<input type="hidden" name="phonetypes[]" value="<?php echo $phone_type->getId(); ?>" />
																				</div>
																		</div>
																	</div>
																	<?php endforeach; ?>
															</div>
														</div>

														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">

																<?php
																	if($form_state == 2)
																		echo '<a href = "../calendar/specific_event.php?id='.$lead_record->getId().'" class = "btn btn-secondary">Join Event</a>';
																?>
																<button type="submit" name = "create_lead" class="btn btn-info"><?php echo $submit_caption; ?></button>
																
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
														else if($msg == 'updated')
															$error = 'Record Successfully Updated';
														else if($msg == 'deleted')
															$error = 'Record Successfully Deleted';
														else if($msg == 'prev_deleted')
															$error = 'Record was deleted previously';
														else if($msg == 'none')
															$error = 'Sorry, the record selected does not exist.';
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
