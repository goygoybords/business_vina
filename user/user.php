<?php
	session_start();
	ob_start();

	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/user.php';

	require '../model/user_model.php';

	$list = new User_Model(new Database());
		$table = 'users';
		$fields = array('id','firstname' , 'lastname' , 'usertypeid' ,'email');
		$where = "status = ?";
		$params = array(1);
	$users = $list->queryUser($table, $fields, $where, $params);

	

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
								<header><i class="fa fa-fw fa-users"></i> User Accounts</header>
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
												<a class="btn btn-success btn-block" href="add.php" name="btnAddUser" id="btnAddUser">ADD NEW USER</a>
											</div>
										</div>

								<div class="col-lg-offset-0 col-md-12">
									<div class = "row" >
										<table class = "table table-hover" id = "user-tbl">
											<thead>
												<th>Name</th>
												<th>Email</th>
												<th>User Type</th>
												<th>Action</th>
											</thead>
											<tbody>
												<?php $user = new User(); foreach ($users as $u ) : ?>
												<?php
													$user->setId($u['id']);
													$user->setFirstname($u['firstname']);
													$user->setLastname($u['lastname']);
													$user->setEmail($u['email']);
													$user->setUsertypeid($u['usertypeid']);
													if($user->getUsertypeid() == 1)
														$role = "Agent";
													else if($user->getUsertypeid() == 2)
														$role = "Admin";
												?>
												<tr>
													<td><?php echo $user->getFirstname()." ".$user->getLastname();   ?></td>
													<td><?php echo $user->getEmail(); ?></td>
													<td><?php echo $role; ?></td>
													<td>
														<a href ="edit.php?id=<?php echo $user->getId();   ?>">
															<span class="label label-inverse" style = "color:black;">
		                                						<i class="fa fa-edit"></i> Edit
		                                					</span>
														</a>
														<a href ="../process/delete_user.php?id=<?php echo $user->getId(); ?>"
															onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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
	    $('#user-tbl').DataTable(
	    {
			// "bProcessing": true,
			// "bServerSide": true,
			// 	"responsive": true,
	  //       "sPaginationType": "full_numbers",
	  //       "order": [0,'desc'],
	  //           "ajax":{
	  //               url :"../process/lead_list2.php", // json datasource
	  //               type: "get",  // method  , by default get
	  //           }
	    } );
	} );
</script>
