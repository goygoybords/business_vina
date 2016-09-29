<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../model/lead_status_model.php';
	require '../model/campaign_model.php';
	require '../model/user_model.php';

	$list_status_model = new Lead_Status_Model(new Database());
	$campaign_model = new Campaign_Model(new Database());
	$user_model = new User_Model(new Database());


	$lead_status = $list_status_model->get_all('lead_status' , array('id' , 'description') , 'status = ?' , array(1) );  
	$users = $user_model->queryUser('users' , array('id' , 'first_name') , 'status = ?' , array(1) ); 
	$campaigns = $campaign_model->get_all('campaign' , array('id' , 'title') , 'status = ?' , array(1));
															
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
												<a class="btn btn-success btn-block" href="manage.php" name="btnAddLead" id="btnAddLead">ADD NEW LEAD</a>
											</div>
										</div>
										<br />
										<div class="col-lg-offset-0 col-md-12">
											<div id = "filters">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group floating-label">
															<select name = "status_filter" id = "status_filter" class = "form-control">
																<option>Select Status Filter</option>
																<?php foreach ($lead_status as $s ): ?>
																	<option value = "<?php echo $s['id']; ?>"><?php echo $s['description']; ?></option>
																<?php endforeach; ?>
															</select>
											
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group floating-label">
															<select name = "campaign_filter" id = "campaign_filter" class = "form-control">
																<option>Select Campaign Filter</option>
																<?php foreach ($campaigns as $u): ?>
																	<option value = "<?php echo $u['id']; ?>"><?php echo $u['title']; ?></option>
																<?php endforeach;?>
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group floating-label">
															<select name = "user_filter" id = "user_filter" class = "form-control">
																<option>Select User Filter</option>
																<?php foreach ($users as $u): ?>
																	<option value = "<?php echo $u['id']; ?>"><?php echo $u['first_name']; ?></option>
																<?php endforeach;?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<input type = "text" name = "filter" id = "filter">
											<input type = "submit" id = "filteraction">
												<br/>
												<br/>
												<table class = "table display responsive nowrap" id = "lead-tbl">
													<thead>
														<th>Date Added</th>
														<th>Company Name</th>
														<th>Lead Status</th>
														<th>Campaign</th>
														<th>Businessname</th>
														<th>First Name</th>
														<th>Last Name</th>
														<th>Phone</th>
														<th>Email</th>
														<th>User</th>
														<th>Action</th>
													</thead>
<!-- 													<tfoot>
														<tr>
															<td><input type="text" data-column="0"  placeholder = "Search ID" class="search-input-text"></td>
															<td><input type="text" data-column="1"  placeholder = "Search Lead Status" class="search-input-text"></td>
															<td><input type="text" data-column="2"  placeholder = "Search Name" class="search-input-text"></td>
															<td><input type="text" data-column="3"  placeholder = "Search Position" class="search-input-text"></td>
															<td><input type="text" data-column="4"  placeholder = "Search SI Code" class="search-input-text"></td>
															<td><input type="text" data-column="5"  placeholder = "Search Address" class="search-input-text"></td>
															<td></td>
														</tr>
													</tfoot> -->
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
	    var dataTable = $('#lead-tbl').DataTable(
	    {
			"bProcessing": true,
			"bServerSide": true,
				"responsive": true,
	        "sPaginationType": "full_numbers",
	        "order": [0,'desc'],
	            "ajax":{
	                url :"../process/lead_list1.php", // json datasource
	                type: "get",  // method  , by default get
	            }
	    } );

	    $( "#filteraction" ).click(function() 
		{
			var filter   = $("#filter").val();
			var status   = $("#status_filter").val();
			var campaign = $("#campaign_filter").val();
			var user     = $("#user_filter").val();
			var data = dataTable.ajax.url( "../process/lead_list2.php?status="+status+"&campaign="+campaign+"&user="+user+"&filter="+filter).load();
			console.log(status + " " + campaign + " " + user);
		});

	   //  $("#employee-grid_filter").css("display","none");

	   //  $('.search-input-text').on( 'keyup click', function () {   // for text boxes
				// 	var i =$(this).attr('data-column');  // getting column index
				// 	var v =$(this).val();  // getting search input value
				// 	dataTable.columns(i).search(v).draw();
				// } );
	} );
</script>
