<?php
	require '../class/database.php';
	require '../class/lead_status.php';
	require '../model/lead_status_model.php';

	$lead = new LeadStatus();
	$lead_model = new Lead_Status_Model(new Database());
	
	$table = "lead_status";
	extract($_POST);

	if(isset($_POST['add_status']))
	{

		$lead->setDescription(htmlentities($description));
		$lead->setStatus(1);
		$data = [
					'description' => $lead->getDescription()  , 
					'status' => $lead->getStatus() 
				];

		$result = $lead_model->createType($table, $data);
		header("location: ../status/manage.php?msg=inserted");
		
	}

	if(isset($_POST['update_status']))
	{
		// user setters and getters
		

		$lead->setId(htmlentities($id));
		$lead->setDescription(htmlentities($description));
		$fields = array('description');
		$where  = "WHERE id = ?";
		$params = array($lead->getDescription(),  $lead->getId() );
		$result = $lead_model->updateType($table, $fields, $where, $params);

		header("location: ../status/manage.php?id=".$lead->getId()."&msg=updated");
	}
	
	if(isset($_GET['del']))
	{
		$lead->setId($_GET['id']);
		$lead->setStatus(0);
		$fields = array('status');
		$where  = "WHERE id = ?"; 
		$params = array($lead->getStatus(), $lead->getId() );
		$result = $lead_model->updateType($table, $fields, $where, $params);
		header("location: ../status/status.php?&msg=deleted");

	}
	
?>