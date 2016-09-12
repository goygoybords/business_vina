<?php
	session_start();	
	include '../include/start.html'; 
	require('../include/header.php');	
	// class
	require('../class/database.php');
	require('../class/user.php');
	// models
	require('../model/user_model.php');

	$list = new User_Model(new Database());
		$table = 'users';
		$fields = array('id','firstname' , 'lastname' , 'usertypeid' ,'email', 'password');
		$where = "id = ?";
		$params = array($_GET['id']);
	$users = $list->queryUser($table, $fields, $where, $params);
	
	foreach ($users as $u ) 
	{	
		$user = new User();
		$user->setId($u['id']);
		$user->setFirstname($u['firstname']);
		$user->setLastname($u['lastname']);
		$user->setPassword($u['password']);
		$user->setEmail($u['email']);
		$user->setUsertypeid($u['usertypeid']);
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
								<header><i class="fa fa-fw fa-user-plus"></i> Edit User</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-1 col-lg-2"></div> 
											<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
												<form class="form-horizontal" method = "post" action = '../process/edit_user.php'>
													<div class="card-body" id="div-add-user">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="Firstname5" class="col-sm-4 control-label">Firstname</label>
																	<div class="col-sm-8">
																		<input type="text" name = "firstname" class="form-control" id="Firstname5" 
																		value = "<?php echo $user->getFirstname(); ?>" required>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="Lastname5" class="col-sm-4 control-label">Lastname</label>
																	<div class="col-sm-8">
																		<input type="text" name = "lastname" class="form-control" id="Lastname5"
																		value = "<?php echo $user->getLastname(); ?>" required>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="Email5" class="col-sm-2 control-label">Email</label>
															<div class="col-sm-10">
																<input type="text" name = "email" class="form-control"  id="Email5" 
																value = "<?php echo $user->getEmail(); ?>" required>
															</div>
														</div>
														<div class="form-group">
															<label for="Password5" class="col-sm-2 control-label">Password</label>
															<div class="col-sm-10">
																<input type="password" name = "password" class="form-control" id="Password5" 
																value = "<?php echo $user->getPassword(); ?>" required>
															</div>
														</div>
														<div class="form-group">
															<label for="UserType" class="col-sm-2 control-label">User Type</label>
															<div class="col-sm-10">
																<select name = "user_type" id="UserType" class = "form-control" required>
																	<option value = "1" <?php if($user->getUsertypeid() == 1) echo 'selected="selected"'; ?> >Agent</option>
																	<option value = "2" <?php if($user->getUsertypeid() == 2) echo 'selected="selected"'; ?> >Admin</option>
																</select>
															</div>
														</div>														
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<button type="submit" name = "update" class="btn btn-info">UPDATE RECORD</button>
															</div>			
														</div>											
													</div><!--end .card-body -->
													<input type = "hidden" value = "<?php echo $user->getId(); ?>" name = "id">
												</form>			
													<?php 
													if(isset($_GET['msg']))
													{
														$msg = $_GET['msg'];
														if($msg == 'user_exist')
															$error = "User Already Exists!";
														else if($msg == 'inserted')
															$error = 'Record Successfully Updated';
														echo '<span>'.$error.'</span>';
													}
												?>				
												
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
