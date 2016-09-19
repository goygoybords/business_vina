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

	if(isset($_POST['update_user']))
	{
		
	}
	if(isset($_GET['del']))
	{
		

	}
	
?>