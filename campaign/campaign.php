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
	require '../model/campaign_model.php';
	$campaign = new Campaign();
	$campaign_model = new Campaign_Model(new Database());


	$table = 'campaign';
	$fields = array('*');
	$where = " status = ? ";
	$params = array(1);
	$campaign_list = $campaign_model->get_all($table, $fields, $where, $params);

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
								<header><i class="fa fa-fw fa-users"></i> Campaign</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<?php
								if(isset($_GET['msg']))
								{
									$msg = $_GET['msg'];
									if($msg == 'deleted')
										$error = 'Record Successfully Deleted';
									else if($msg == 'prev_deleted')
										$error = 'Record was deleted previously';
									else if($msg == 'none')
										$error = 'Sorry, the record selected does not exist.';
									echo '<span>'.$error.'</span>';
								}
							?>
							</div>
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
												<a class="btn btn-success btn-block" href="manage.php" id="btnAddLead">ADD NEW CAMPAIGN</a>
											</div>
										</div>
										<br />
										<div class="col-lg-offset-0 col-md-12">
											<div class = "row" >
												<table class = "table display responsive nowrap" id = "camp-tbl">
													<thead>
														<th>Title</th>
														<th>Cost Per Lead</th>
														<th>Email</th>
														<th>Note</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php foreach ($campaign_list as $c ):
															$campaign->setId($c['id']);
															$campaign->setTitle($c['title']);
															$campaign->setCost_per_lead($c['cost_per_lead']);
														 	$campaign->setEmail($c['email']);
														 	$campaign->setNote($c['note']);

														 ?>
														<tr>
															<td><?php echo $campaign->getTitle(); ?></td>
															<td><?php echo $campaign->getCost_per_lead(); ?></td>
															<td><?php echo $campaign->getEmail(); ?></td>
															<td><?php echo $campaign->getNote(); ?></td>
															<td>
																<a href="manage.php?id=<?php echo $campaign->getId(); ?>" >
										                            <span class="label label-inverse" style = "color:black;">
										                                <i class="fa fa-edit"></i> Edit
										                            </span>
										                        </a> &nbsp;
										                        <a href="../process/campaign_manage.php?id=<?php echo $campaign->getId(); ?>" onclick="return confirm(\'Are you sure you want to delete this record?\')" >
										                            <span class="label label-inverse" style = "color:black;">
										                                <i class="fa fa-remove"></i> Delete
										                            </span>
										                        </a>
										                    </td>
														</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div><!--end .card -->
								</div><!--end .col -->
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
	$(document).ready(function()
	{
	    $('#camp-tbl').DataTable(
	    {
			
	    } );
	} );
</script>
