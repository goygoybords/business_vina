<?php
	session_start();
	require '../class/database.php';
	require '../class/lead.php';
	require '../class/phones.php';
	require '../class/note.php';
	require '../class/campaign_details.php';
	require '../class/calendar_events.php';

	require '../model/phones_model.php';
	require '../model/lead_model.php';
	require '../model/note_model.php';
	require '../model/campaign_details_model.php';
	require '../model/calendar_events_model.php';
	require '../model/position_model.php';
	require '../model/sicode_model.php';


	$leads = new Leads();
	$lead_model = new Lead_Model(new Database());
	$phone = new Phone();
	$phone_model = new Phone_Model(new Database());
	$note = new Note();
	$note_model = new Note_Model(new Database());
	$campaign_details = new Campaign_Details();
	$campaign_details_model = new Campaign_Details_Model(new Database());
	
	$calendar_event = new CalendarEvents();
	$calendar_model = new Calendar_Events_Model(new Database());
	$sic_model = new SICode_Model(new Database());

	$position_model = new Position_Model(new Database());
	extract($_POST);
	if(isset($_POST['create_lead']))
	{
		if($new_position != null)
		{
			$data = [ 'position' => $new_position ];
			$position = $position_model->createPosition('positions' , $data);
		}
		if($new_sicode != null)
		{
			$data = [ 'description' => $new_sicode ];
			$siccode = $sic_model->createPosition('siccode' , $data);
		}
		$data = null;
		$leads->setLeadType(htmlentities($lead_type));
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
		$leads->setDatecreated(strtotime(date('Y-m-d')));
		$leads->setUser($_SESSION['id']);
		$leads->setLeadStatus(htmlentities($lead_status));
		$leads->setStatus(1);

		$data = [
					'lead_type' => $leads->getLeadType(),
					'companyname' => $leads->getCompanyname() ,
					'position'  => $leads->getPosition()   ,
					'firstname'     => $leads->getFirstname()      ,
					'middlename'  => $leads->getMiddlename()   ,
					'lastname' => $leads->getLastname() ,
					'email' => $leads->getEmail() ,
					'siccode' => $leads->getSiccode() ,
					'address' => $leads->getAddress() ,
					'city' => $leads->getCity() ,
					'zip' => $leads->getZip() ,
					'state' => $leads->getState() ,
					'datecreated' => $leads->getDatecreated() ,
					'user' => $leads->getUser(),
					'lead_status' => $leads->getLeadStatus(),
					'status' => $leads->getStatus() ,
				];

		$result = $lead_model->createLead('leads', $data);
		if($campaign != null)
		{
			$data = null;
			$campaign_details->setLeadid($result);
			$campaign_details->setCampaign_id(htmlentities($campaign));
			$campaign_details->setDatecreated(strtotime(date('Y-m-d')));
			$campaign_details->setStatus(1);

			$data = [
						'leadid' => $campaign_details->getLeadid(),
						'campaign_id' => $campaign_details->getCampaign_id(),
						'datecreated' => $campaign_details->getDatecreated(),
						'status' => $campaign_details->getStatus()
					];
			$campaign_details_model->createDetails('campaign_details', $data);

		}
		for($i=0; $i<count($phones); $i++)
		{
			$data = null;
			$phone = new Phone();
			$phone->setNumber($phones[$i]);
			$phone->setPhoneTypeId($phonetypes[$i]);
			$phone->setLeadId($result);

			$data = [
								'number' => $phone->getNumber(),
								'phonetypeid' => $phone->getPhoneTypeId(),
								'leadid' => $phone->getLeadId()
							];
			$phone_result = $phone_model->createPhone('phones', $data);
		}
		if($eventname != null)
		{
			$data = null;
			$start_date  = date('Y-m-d', strtotime($start_date));
			$end_date    = date('Y-m-d', strtotime($end_date));
			$calendar_event->setLeadid($result);
			$calendar_event->setEvent_name(htmlentities($eventname));
			$calendar_event->setStart_date(strtotime($start_date));
			$calendar_event->setEnd_date(strtotime($end_date));
			$calendar_event->setDatecreated(strtotime(date('Y-m-d')));
			$calendar_event->setStatus(1);

			$data = [
						'leadid' => $calendar_event->getLeadid() ,
						'event_name'  => $calendar_event->getEvent_name()   ,
						'start_date' => $calendar_event->getStart_date() ,
						'end_date' => $calendar_event->getEnd_date() ,
						'datecreated'  => $calendar_event->getDatecreated()   ,
						'status' => $calendar_event->getStatus() 
					];
			$calendar_model->createEvent('calendar_events', $data);
		}

		if($notes != null)
		{
			$data = null;
			$note->setLeadid($result);
			$note->setDetails($notes);
			$note->setUserid( $_SESSION['id'] );
			$note->setDatecreated(strtotime(date('Y-m-d')));
			$note->setStatus(1);
			$data = [
						'leadid' => $note->getLeadid() ,
						'details'  => $note->getDetails()   ,
						'userid'     => $note->getUserid()      ,
						'datecreated'  => $note->getDatecreated()   ,
						'status' => $note->getStatus() 
					];
			$note_result = $note_model->createNote('notes', $data);
		}
		header("location: ../leads/manage.php?msg=inserted");
	}
?>