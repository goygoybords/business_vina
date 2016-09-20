<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/campaign.php';
	require '../class/campaign_type.php';

	require '../model/campaign_model.php';
	require '../model/campaign_type_model.php';

	$list_campaign = new Campaign_Model(new Database());
	$list_type = new Campaign_Type_Model(new Database());
	$campaign_record = new Campaign();
	$campaign_type = new Campaign_Type();


	$table = 'campaign_type';
	$fields = array('*');
	$where = " status = ? ";
	$params = array(1);
	$campaign_type_list = $list_type->get_all($table, $fields, $where, $params);


	$campaign_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$form_state = 1;
	$form_header = "Add New Campaign";
	$submit_caption = "Create Campaign";
	
	$name = "create_campaign";

											
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");
	if($campaign_id)
	{
			if($msg != 'deleted')
			{
				$table = 'campaign';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($campaign_id);
				$list = $list_campaign->get_all($table, $fields, $where, $params);

				if(count($list) > 0)
				{
					foreach ($list as $l)
					{
						$campaign_record->setTitle($l['title']);
						$campaign_record->setAlternate_tite($l['alternate_title']);
						$campaign_record->setCampaign_type($l['campaign_type']);
						$campaign_record->setCost_per_lead($l['cost_per_lead']);
						$campaign_record->setEmail($l['email']);
						$campaign_record->setNote($l['note']);
						$campaign_record->setStatus($l['status']);
						
					}
					
					
					if($campaign_record->getStatus() == 1)
					{
						//$lead_phones = $list_phones->get_phones_by_leadid($lead_record->getId());
						$form_state = 2;
						$form_header = "Edit Campaign Details";
						$submit_caption = "Save Changes";
						$name = "update_campaign";
					}
					else
					{
						$campaign_record = new Campaign();
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

							<form class="form" method="POST" action="../process/campaign_manage.php">
								<div class="">
									<div class="card-body">
										
										<div class="form-group">
											<label><b>CAMPAIGN DETAILS</b></label>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<?php if($form_state == 2): ?>
														<input type = "hidden" name = "id" value = "<?php echo $campaign_id; ?>">
													<?php endif; ?>
													<input type="text" name = "title" class="form-control" id="title"  value = "<?php echo $campaign_record->getTitle(); ?>" required >
													<label for="title">Title</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "alt_title" class="form-control" id="alt_title" value = "<?php echo $campaign_record->getAlternate_tite(); ?>" required >
													<label for="alt_title">Alternate Title</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
										
													<select name = "campaign_type" class = "form-control" required>
														<option></option>
														<?php foreach ($campaign_type_list as $c): 
															$campaign_type->setId($c['id']);
															$campaign_type->setDescription($c['description']);
														?>
															<option value = "<?php echo $campaign_type->getId(); ?>" 
																<?php if($campaign_type->getId() == $campaign_record->getCampaign_type() ) echo "selected"; ?> >
																<?php echo $campaign_type->getDescription(); ?>
															</option>
														<?php endforeach; ?>
														
													</select>
													<label for="campaign_type">Campaign Type</label>
											
												</div>
											</div>
										</div>
										<div class="row">
										
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="email" name = "email" class="form-control"  value = "<?php echo $campaign_record->getEmail(); ?>" id="email"  required>
													<label for="position">Email</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "cost_per_lead" class="form-control dollar-mask"  id="cost_per_lead" value = "<?php echo $campaign_record->getCost_per_lead(); ?>" required>
													<label for="cost_per_lead">Cost Per Lead</label>
												</div>
									
											</div>
										</div>
															
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<textarea class ="form-control" name = "notes" id = "notes" rows = "5" required><?php echo $campaign_record->getNote(); ?></textarea>
													<label class="notes">NOTES</label>
												</div>
											</div>
										</div>
										<br/>

										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
												<button type="submit" name = "<?php echo $name; ?>" class="btn btn-info"><?php echo $submit_caption; ?></button>
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