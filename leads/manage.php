<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/position.php';
	require '../class/sicode.php';
	require '../class/state.php';
	require '../class/phones.php';
	require '../class/phonetypes.php';
	require '../class/lead.php';
	require '../class/Note.php';
	require '../class/campaign.php';

	require '../model/position_model.php';
	require '../model/sicode_model.php';
	require '../model/state_model.php';
	require '../model/phones_model.php';
	require '../model/phonetypes_model.php';
	require '../model/lead_model.php';
	require '../model/note_model.php';

	require '../model/campaign_model.php';
	require '../model/campaign_details_model.php';

	$list_campaign = new Campaign_Model(new Database());

	$list_positions = new Position_Model(new Database());
	$list_siccode = new SICode_Model(new Database());
	$list_state = new State_Model(new Database());
	$list_phones = new Phone_Model(new Database());
	$list_phonetypes = new PhoneTypes_Model(new Database());
	$lead_model = new Lead_Model(new Database());
	$list_note = new Note_Model(new Database());

	$list_campaign_detail = new Campaign_Details_Model(new Database());

	$lead_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$note_id = (isset($_GET["note"]) ? $_GET["note"] : "");

	$lead_record = new Leads();
	$note_record = new Note();
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
					if($note_id)
					{
						$table = 'notes';
						$fields = array('*');
						$where = " id = ? ";
						$params = array($note_id);
						$notes = $lead_model->get_by_id($table, $fields, $where, $params);

						foreach ($notes as $n ) 
						{
							$note_record->setDetails($n['details']);
						}
					}

					$table = 'campaign_details';
					$fields = array('*');
					$where = " leadid = ? ";
					$params = array($lead_id);
					$detail = $list_campaign_detail->get_all($table, $fields, $where, $params);
					print_r($detail);
					if(count($detail) > 0 )
					{
						foreach ($detail as $d ) 
						{
							$campaign_det = new Campaign();
							$campaign_det->setId($d['campaign_id']);
						}
					}
					else
					{
						$campaign_det = new Campaign();
						//$campaign_det->setId("");
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

							<form class="form" method="POST" action="<?php echo $submit_url; ?>">
								<div class="">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-8">
												<div class="form-group floating-label">
													<input type = "hidden" name = "id" value = "<?php echo $lead_id; ?>">
													<input type="text" name = "companyname" class="form-control"  id="companyname" value="<?php echo $lead_record->getCompanyname(); ?>" required autofocus='autofocus'>
													<label for="companyname">Company Name</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<select name = "position" id = "position" class = "form-control" required>
													<option></option>
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
													<label for="position">Position</label>
												</div>
											</div>
										</div>
										<br />
										<div class="form-group">
											<label><b>CONTACT PERSON</b></label>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "firstname" class="form-control" id="firstname" value="<?php echo $lead_record->getFirstname(); ?>" required >
													<label for="firstname">Firstname</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "middlename" class="form-control" id="middlename" value="<?php echo $lead_record->getMiddlename(); ?>" required >
													<label for="middlename">Middlename</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "lastname" class="form-control" id="lastname" value="<?php echo $lead_record->getLastname(); ?>" required >
													<label for="lastname">Lastname</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-8">
												<div class="form-group floating-label">
													<select name = "siccode" class = "form-control" required>
														<option></option>
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
													<label for="siccode">SI Code</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "email" class="form-control"  id="email" value="<?php echo $lead_record->getEmail(); ?>" required>
													<label for="position">Email</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<input type="text" name = "address" class="form-control"  id="address" value="<?php echo $lead_record->getAddress(); ?>" required>
													<label class="address">Address</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<select name = "state" class = "form-control" id = "state" required>
														<option></option>
														<?php $states = $list_state->get_all('state');  foreach ($states as $s ): ?>
														<?php
															$state = new State();
															$state->setId($s['id']);
															$state->setCode($s['code']);
														?>
															<option value = "<?php echo $state->getId(); ?>" <?php echo ($state->getId() == $lead_record->getState() ? "selected='selected'" : ""); ?> ><?php echo $state->getCode(); ?></option>
														<?php endforeach; ?>
													</select>
													<label class="state">State</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "city" class="form-control" id="city" required value="<?php echo $lead_record->getCity(); ?>">
													<label class="city">City</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "zip" class="form-control" id="zip" required value="<?php echo $lead_record->getZip(); ?>" >
													<label class="zip">Zip</label>
												</div>
											</div>
										</div>
										<br />

										<div class="form-group">
											<label><b>CAMPAIGN</b></label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<?php if(count($detail) > 0) :?>
														<input type = "hidden" name = "add_update2" value = "2">
													<?php else: ?>
														<input type = "hidden" name = "add_update2" value = "1">
													<?php endif; ?>

													<select name = "campaign" class = "form-control" id = "campaign">
														
														<option></option>
														<?php $campaigns = $list_campaign->get_all('campaign' , array('id' , 'title') , 'status = ?' , array(1) );  
														foreach ($campaigns as $s ): ?>
														<?php
															$campaign = new Campaign();
															$campaign->setId($s['id']);
															$campaign->setTitle($s['title']);

														?>
														
														<option value = "<?php echo $campaign->getId(); ?>" <?php echo ($campaign_det->getId() == $campaign->getId() ? "selected='selected'" : ""); ?> ><?php echo $campaign->getTitle(); ?></option>
														<?php endforeach; ?>
													</select>
													<label class="campaign">Campaign</label>
												</div>
											</div>
										</div>
										<br/>

										<div class="form-group">
											<label><b>CONTACT NUMBERS</b></label>
										</div>
										<div class="row">
										<?php
											foreach ($phone_types as $pt) :
												$phone_type = new PhoneTypes();
												$phone_type->setId($pt['id']);
												$phone_type->setType($pt['type']);
										?>
										<div class="col-sm-3">
												<div class="form-group floating-label">
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
													 ?>" maxlength="20" />
													<input type="hidden" name="phonetypes[]" value="<?php echo $phone_type->getId(); ?>" />
													<label><?php echo $phone_type->getType(); ?></label>
												</div>
										</div>
										<?php endforeach; ?>
										</div>
										<br />
										<div class="form-group">
											<label><b>Notes</b></label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<?php if($note_id) :?>
														<input type = "hidden" name = "add_update" value = "2">
														<input type = "hidden" name = "note_id" value = "<?php echo $note_id; ?>">
														<textarea class ="form-control" name = "notes" id = "notes" rows = "5"><?php echo $note_record->getDetails(); ?></textarea>
													<?php else: ?>
														<input type = "hidden" name = "add_update" value = "1">
														<textarea class ="form-control" name = "notes" id = "notes" rows = "5"></textarea>
													<?php endif; ?>			
													<label class="notes">NOTES</label>

												</div>
											</div>
										</div>
										<br/>

										<?php if($lead_id): ?>
										<div class="form-group">
											<label><b>Note List</b></label>
										</div>

										<div class="row">
											<div class="col-lg-offset-0 col-md-12">
												<div class = "row" >
													<table class = "table display responsive nowrap" id = "note-tbl">
														<?php 
															$table = 'notes';
															$fields = array('*');
															$where = " leadid = ? ";
															$params = array($lead_id);
															$notes = $lead_model->get_by_id($table, $fields, $where, $params);
														?>
														<thead>
															<th>Date Noted</th>
															<th>Details</th>
															<th>Action</th>
														</thead>
														<tbody>
															<?php 
																foreach ($notes as $n ): 
																$note_record = new Note();
																$note_record->setId($n['id']);
																$note_record->setDetails($n['details']);
																$note_record->setDatecreated(date('Y-m-d', $n['datecreated']) );

															?>
															<tr>
																<td><?php echo $note_record->getDatecreated(); ?></td>
																<td><?php echo $note_record->getDetails(); ?></td>
																<td>
																	<a href="manage.php?id=<?php echo $lead_id; ?>&note=<?php echo $note_record->getId(); ?>" >
											                            <span class="label label-inverse" style = "color:black;">
											                                <i class="fa fa-edit"></i> Edit
											                            </span>
											                        </a>
											                    </td>
															</tr>
															<?php endforeach; ?>
														</tbody>	
													</table>
												</div>
											</div>
										</div>
										<br/>
										<?php endif; ?>

										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">

												<?php
													if($form_state == 2)
														echo '<a href = "../calendar/specific_event.php?id='.$lead_record->getId().'" class = "btn btn-secondary">Join Event</a>';
												?>
												<button type="submit" name = "create_lead" class="btn btn-info"><?php echo $submit_caption; ?></button>

											</div>
										</div>
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
									</div><!--end .card-body -->
								</div><!--end .card -->
							</form>
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
	$(document).ready(function()
	{
	    dataTable = $('#note-tbl').DataTable(
	    {
			// "bProcessing": true,
			// "bServerSide": true,
			// 	"responsive": true,
	  //       "sPaginationType": "full_numbers",
	  //       "order": [0,'desc'],
	  //           "ajax":{
	  //               url :"../process/note_list.php", // json datasource
	  //               type: "get",  // method  , by default get
	  //           }
	    } );
	} );
</script>