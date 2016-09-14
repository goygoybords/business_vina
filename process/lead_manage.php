<?php
	require '../class/database.php';
	require '../class/lead.php';
	require '../model/lead_model.php';
	$leads = new Leads();
	$lead_model = new Lead_Model(new Database());

	extract($_POST);
	if(isset($_POST['create_lead']) || isset($_POST['delete_lead']))
	{
		$leads->setId(htmlentities($id));
		$leads->setCompanyname(htmlentities($companyname));
		$leads->setFirstname(htmlentities($firstname));
		$leads->setMiddlename(htmlentities($middlename));
		$leads->setLastname(htmlentities($lastname));
		$leads->setPosition(htmlentities($position));
		$leads->setSiccode(htmlentities($siccode));
		$leads->setEmail(htmlentities($email));
		$leads->setAddress(htmlentities($address));
		$leads->setCity(htmlentities($city));
		$leads->setState(htmlentities($state));
		$leads->setZip(htmlentities($zip));
		$leads->setDatelastupdated(strtotime(date('Y-m-d')));
		$leads->setStatus(1);

		$table  = "leads";
		if(isset($_POST['create_lead']))
		{
			$leads->setStatus(1);
			$fields = array('companyname' ,'position' ,'firstname' , 'middlename' , 'lastname', 'email', 'siccode', 'address', 'city', 'zip', 'state', 'datelastupdated');
			$where  = "WHERE id = ?";
			$params = array(
									$leads->getCompanyname(),
									$leads->getPosition(),
									$leads->getFirstname(),
									$leads->getMiddlename(),
									$leads->getLastname(),
									$leads->getEmail(),
									$leads->getSiccode(),
									$leads->getAddress(),
									$leads->getCity(),
									$leads->getZip(),
									$leads->getStatus(),
									$leads->getDatelastupdated(),
									$leads->getId()
								);
			$result = $lead_model->updateLead($table, $fields, $where, $params);
			header("location: ../leads/manage.php?id=".$leads->getId()."&msg=updated");
		}
		else if(isset($_POST['delete_lead']))
		{
			$leads->setStatus(0);
			$fields = array('status', 'datelastupdated');
			$where  = "WHERE id = ?";
			$params = array(
									$leads->getStatus(),
									$leads->getDatelastupdated(),
									$leads->getId()
								);
			$result = $lead_model->updateLead($table, $fields, $where, $params);
			header("location: ../leads/manage.php?id=".$leads->getId()."&msg=deleted");
		}
	}
?>