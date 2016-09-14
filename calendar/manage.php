<?php
	session_start();
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/calendar_events.php';



	
	$lead_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$events = new CalendarEvents();
	$form_state = 1;
	$form_header = "Create Calendar Event";
	$submit_caption = "Create Lead";
	$submit_url = "../process/lead_add.php";

	// $msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");
	// if($lead_id)
	// {
	// 		if($msg != 'deleted')
	// 		{
	// 			$table = 'leads';
	// 			$fields = array('*');
	// 			$where = " id = ? ";
	// 			$params = array($lead_id);
	// 			$leads = $lead_model->get_by_id($table, $fields, $where, $params);

	// 			if(count($leads))
	// 			{
	// 				foreach ($leads as $l)
	// 				{
	// 					$lead_record->setId($l['id']);
	// 					$lead_record->setCompanyname($l['companyname']);
	// 					$lead_record->setPosition($l['position']);
	// 					$lead_record->setFirstname($l['firstname']);
	// 					$lead_record->setMiddlename($l['middlename']);
	// 					$lead_record->setLastname($l['lastname']);
	// 					$lead_record->setEmail($l['email']);
	// 					$lead_record->setSiccode($l['siccode']);
	// 					$lead_record->setLeaddetailsid($l['leaddetailsid']);
	// 					$lead_record->setAddress($l['address']);
	// 					$lead_record->setCity($l['city']);
	// 					$lead_record->setZip($l['zip']);
	// 					$lead_record->setState($l['state']);
	// 					$lead_record->setDatecreated($l['datecreated']);
	// 					$lead_record->setDatelastupdated($l['datelastupdated']);
	// 					$lead_record->setStatus($l['status']);
	// 				}

	// 				if($lead_record->getStatus() == 1)
	// 				{
	// 					$form_state = 2;
	// 					$form_header = "Edit Lead Details";
	// 					$submit_caption = "Save Changes";
	// 					$submit_url = "../process/lead_manage.php";
	// 				}
	// 				else
	// 				{
	// 					$lead_record = new Leads();
	// 					$_GET["msg"] = "prev_deleted";
	// 				}
	// 			}
	// 			else
	// 			{
	// 				$_GET["msg"] = "none";
	// 			}
	// 		}
	// }

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
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">
												<form class="form-horizontal" method = "post" action = '<?php echo $submit_url; ?>'>
													<input type="hidden" name="id" id="id" value="<?php ?>" />
													<div class="card-body" id="div-add-lead">
														<div class="form-group">
															<label for="eventname" class="col-sm-2 control-label">Event Name</label>
															<div class="col-sm-10">
																<input type="text" name = "eventname" class="form-control"  id="eventname" 
																value="<?php ?>" required autofocus='autofocus'>
															</div>
														</div>
														
														<div class="form-group">
															<label for="address" class="col-sm-2 control-label">Start Date</label>
															<div class="col-sm-10">
																<input type="text" name = "start_date" class="form-control"  id="start_date" value="<?php  ?>" required>
															</div>
														</div>

														<div class="form-group">
															<label for="address" class="col-sm-2 control-label">End Date</label>
															<div class="col-sm-10">
																<input type="text" name = "end_date" class="form-control"  id="end_date" value="<?php ?>" required>
															</div>
														</div>
													
												
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<button type="submit" name = "create_lead" class="btn btn-info"><?php echo $submit_caption; ?></button>
																<?php
																	if($form_state == 2)
																	{
																		echo "<button type='submit' name = 'delete_event' class='btn btn-warning'>Delete</button>";
																	}
																?>
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
