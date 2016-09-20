<?php
	require '../class/database.php';
	require '../class/campaign.php';
	require '../model/campaign_model.php';


	$campaign = new Campaign();
	$campaign_model = new Campaign_Model(new Database());
	
	$table = "campaign";
	extract($_POST);
	if(isset($_POST['create_campaign']))
	{
		$campaign->setTitle(htmlentities($title));
		$campaign->setAlternate_tite(htmlentities($alt_title));
		$campaign->setCampaign_type(htmlentities($campaign_type));
		$campaign->setCost_per_lead(floatval($cost_per_lead));
		$campaign->setEmail(htmlentities($email));
		$campaign->setNote(htmlentities($notes));
		$campaign->setStatus(1);

		$data = [
					'title' => $campaign->getTitle() , 
					'alternate_title' => $campaign->getAlternate_tite(),
					'campaign_type' => $campaign->getCampaign_type(),
					'cost_per_lead' => $campaign->getCost_per_lead(),
					'email'    => $campaign->getEmail(),
					'note'    => $campaign->getNote(),
					'status' => $campaign->getStatus()
				];

		$campaign_model->createCampaign($table , $data);

		header("location: ../campaign/manage.php?msg=inserted");
		
	}

	if(isset($_POST['update_campaign']))
	{
		$campaign->setId(htmlentities($id));
		$campaign->setTitle(htmlentities($title));
		$campaign->setAlternate_tite(htmlentities($alt_title));
		$campaign->setCampaign_type(htmlentities($campaign_type));
		$campaign->setCost_per_lead(floatval($cost_per_lead));
		$campaign->setEmail(htmlentities($email));
		$campaign->setNote(htmlentities($notes));
		$campaign->setStatus(1);
	
		$fields = array('title', 'alternate_title', 'campaign_type', 'cost_per_lead', 'email', 'note');
		$where  = "WHERE id = ? AND status = ?";
		$params = array($campaign->getTitle(),  $campaign->getAlternate_tite(), $campaign->getCampaign_type() ,
					$campaign->getCost_per_lead(), $campaign->getEmail(), $campaign->getNote(), $campaign->getId(), 
					$campaign->getStatus()	);
		$campaign_model->updateCampaign($table, $fields, $where, $params);
		header("location: ../campaign/manage.php?id=".$campaign->getId()."&msg=updated");
		
	}
	if(isset($_GET['del']))
	{

		$campaign->setId(htmlentities($_GET['id']));
		$campaign->setStatus(0);
	
		$fields = array('status');
		$where  = "WHERE id = ?";
		$params = array($campaign->getStatus(), $campaign->getId());
		$campaign_model->updateCampaign($table, $fields, $where, $params);

		header("location: ../campaign/campaign.php?msg=deleted");

	}
	
?>