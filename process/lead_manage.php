<?php
	session_start();
	require '../class/database.php';
	require '../class/lead.php';
	require '../class/phones.php';
	require '../class/note.php';
	require '../class/campaign_details.php';
	require '../class/calendar_events.php';

	require '../model/lead_model.php';
	require '../model/phones_model.php';
	require '../model/note_model.php';
	require '../model/campaign_details_model.php';
	require '../model/calendar_events_model.php';
	require '../model/position_model.php';
	require '../model/lead_type_model.php';
	require '../model/lead_status_model.php';


	$leads = new Leads();
	$lead_model = new Lead_Model(new Database());

	$phone = new Phone();
	$phone_model = new Phone_Model(new Database());

	$note = new Note();
	$note_model = new Note_Model(new Database());

	$campaign_detail = new Campaign_Details();
	$campaign_detail_model = new Campaign_Details_Model(new Database());

	$calendar_event = new CalendarEvents();
	$calendar_model = new Calendar_Events_Model(new Database());
	$position_model = new Position_Model(new Database());
	$lead_type_model = new Lead_Type_Model(new Database());
	$lead_status_model = new Lead_Status_Model(new Database());

	if(isset($_POST['create_lead']))
	{
		extract($_POST);
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
		if($new_leadtype != null)
		{
			$data = [ 'description' => $new_leadtype  , 'status' => 1];
			$lead_type = $lead_type_model->createType('lead_type', $data);
		}
		if($new_leadstatus != null)
		{
			$data = [ 'description' => $new_leadstatus , 'status' => 1];
			$lead_status = $lead_status_model->createType('lead_status', $data);

		}
		$leads->setId(htmlentities($id));
		$leads->setCompanyname(htmlentities($companyname));
		$leads->setBusinessname(htmlentities($businessname));
		$leads->setFirstname(htmlentities($firstname));
		$leads->setMiddlename(htmlentities($middlename));
		$leads->setLeadType(htmlentities($lead_type));
		$leads->setLastname(htmlentities($lastname));
		$leads->setPosition(htmlentities($position));
		$leads->setSiccode(htmlentities($siccode));
		$leads->setEmail(htmlentities($email));
		$leads->setAddress(htmlentities($address));
		$leads->setCity(htmlentities($city));
		$leads->setState(htmlentities($state));
		$leads->setZip(htmlentities($zip));
		$leads->setLeadStatus(htmlentities($lead_status));
		$leads->setDatelastupdated(strtotime(date('Y-m-d')));
		

		$table  = "leads";
		if(isset($_POST['create_lead']))
		{
			$leads->setStatus(1);
			$fields = array('companyname' ,'businessname' ,'position' ,'lead_type','firstname' , 'middlename' , 'lastname', 'email', 'siccode', 'address', 'city', 'zip', 
				'state', 'lead_status' ,'datelastupdated');
			$where  = "WHERE id = ?";
			$params = array(
									$leads->getCompanyname(),
									$leads->getBusinessname(),
									$leads->getPosition(),
									$leads->getLeadType(),
									$leads->getFirstname(),
									$leads->getMiddlename(),
									$leads->getLastname(),
									$leads->getEmail(),
									$leads->getSiccode(),
									$leads->getAddress(),
									$leads->getCity(),
									$leads->getZip(),
									$leads->getState(),
									$leads->getLeadStatus(),
									$leads->getDatelastupdated(),
									$leads->getId()
								);
			$result = $lead_model->updateLead($table, $fields, $where, $params);

			// $lead_phones = $phone_model->get_phones_by_leadid($leads->getId());

			// foreach($lead_phones as $lp)
			// {
			// 	echo $lp['number']." ";
			// 	die();
			// 	$lead_phone = new Phone();
			// 	$lead_phone->setId($lp[0]); //id
			// 	$lead_phone->setNumber('');
			// 	$lead_phone->setPhoneTypeId($lp['phonetypeid']);
			// 	$lead_phone->setLeadId($lp['leadid']);

			// 	$fields = array('number');
			// 	$where  = " WHERE id = ? ";
			// 	$params = array(
			// 								$lead_phone->getNumber(),
			// 								$lead_phone->getId()
			// 								);

			// 	$resultEmptyPhones = $phone_model->updatePhone("phones", $fields, $where, $params);
			// }

			for($i=0; $i<count($phones); $i++)
			{
				$phone = new Phone();
				$phone->setNumber($phones[$i]);
				$phone->setPhoneTypeId($phonetypes[$i]);
				$phone->setLeadId($result);

				$fields = array('number');
				$where  = " WHERE phonetypeid = ? and leadid = ? ";
				$params = array(
											$phone->getNumber(),
											$phone->getPhoneTypeId(),
											$leads->getId()
											);

				$resultUpdatePhones = $phone_model->updatePhone("phones", $fields, $where, $params);
			}
			// campaign part
			if($campaign != null)
			{
				if($detail_update == 1)
				{
					$data = null;
					$campaign_detail->setLeadid($id);
					$campaign_detail->setCampaign_id(htmlentities($campaign));
					$campaign_detail->setDatecreated(strtotime(date('Y-m-d')));
					$campaign_detail->setStatus(1);

					$data = [
								'leadid' => $campaign_detail->getLeadid() ,
								'campaign_id'  => $campaign_detail->getCampaign_id()   ,
								'datecreated'  => $campaign_detail->getDatecreated()   ,
								'status' => $campaign_detail->getStatus() 
							];
					$campaign_detail_model->createDetails('campaign_details', $data);

				}
				else if($detail_update == 2)
				{
					$campaign_detail->setLeadid($id);
					$campaign_detail->setCampaign_id($campaign);
					$fields = array('campaign_id');
					$where  = "WHERE leadid = ?";
					$params = array($campaign_detail->getCampaign_id(), $campaign_detail->getLeadid());
					$campaign_detail_model->updateDetails("campaign_details", $fields, $where, $params);
				}

			}

			if($eventname != null)
			{
				if($event_update == 1)
				{
					$data = null;
					$start_date  = date('Y-m-d', strtotime($start_date));
					$end_date    = date('Y-m-d', strtotime($end_date));
					$calendar_event->setLeadid($id);
					$calendar_event->setEvent_name(htmlentities($eventname));
					$calendar_event->setStart_date(strtotime($start_date));
					$calendar_event->setEnd_date(strtotime($end_date));
					$calendar_event->setDatecreated(strtotime(date('Y-m-d')));
					$calendar_event->setDescription(htmlentities($event_description));
					$calendar_event->setUser($_SESSION['id']);
					$calendar_event->setStatus(1);

					$data = [
								'leadid' => $calendar_event->getLeadid() ,
								'event_name'  => $calendar_event->getEvent_name()   ,
								'description' => $calendar_event->getDescription(),
								'start_date' => $calendar_event->getStart_date() ,
								'end_date' => $calendar_event->getEnd_date() ,
								'datecreated'  => $calendar_event->getDatecreated()   ,
								'user_id' => $calendar_event->setUser($_SESSION['id']),
								'status' => $calendar_event->getStatus() 
							];
					$calendar_model->createEvent('calendar_events', $data);
				}
				else if($event_update == 2)
				{
					$start_date  = date('Y-m-d', strtotime($start_date));
					$end_date    = date('Y-m-d', strtotime($end_date));

					$calendar_event->setId($event_id);
					$calendar_event->setEvent_name(htmlentities($eventname));
					$calendar_event->setStart_date(strtotime($start_date));
					$calendar_event->setEnd_date(strtotime($end_date));
					$calendar_event->setDescription(htmlentities($event_description));

					$fields = array('event_name', 'start_date' , 'end_date' , 'description');
					$where  = "WHERE id = ?";
					$params = array($calendar_event->getEvent_name(), $calendar_event->getStart_date(), 
									$calendar_event->getEnd_date() , $calendar_event->getDescription() , $calendar_event->getId()
									);
					$calendar_model->updateEvent("calendar_events", $fields, $where, $params);
				}
			}
			

			if($notes != null)
			{
				// note update part
				if($add_update == 1)
				{
					$data = null;
					$note->setLeadid($id);
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
				else if($add_update == 2)
				{
					$note->setId($note_id);
					$note->setLeadid($id);
					$note->setDetails($notes);
					$fields = array('details');
					$where  = "WHERE id = ? AND leadid = ?";
					$params = array($note->getDetails(), $note->getId(), $note->getLeadid());
					$result_note = $note_model->updateNote("notes", $fields, $where, $params);
				}
			}
			header("location: ../leads/manage.php?id=".$leads->getId()."&msg=updated");
		}
	}

	if(isset($_GET['del']))
	{
		$lead_id = (isset($_GET["id"]) ? $_GET["id"] : "");
		$page_request = (isset($_GET["p"]) ? $_GET["p"] : "");

		$table = 'leads';
		$fields = array('*');
		$where = " id = ? ";
		$params = array($lead_id);
		$leads = $lead_model->get_by_id($table, $fields, $where, $params);

		if(count($leads))
		{
			$lead_record = new Leads();
			foreach ($leads as $l)
			{
				$lead_record->setId($l['id']);
				$lead_record->setCompanyname($l['companyname']);
				$lead_record->setPosition($l['position']);
				$lead_record->setFirstname($l['firstname']);
				$lead_record->setMiddlename($l['middlename']);
				$lead_record->setLastname($l['lastname']);
				$lead_record->setEmail($l['email']);
				$lead_record->setSiccode($l['siccode']);
				$lead_record->setLeaddetailsid($l['leaddetailsid']);
				$lead_record->setAddress($l['address']);
				$lead_record->setCity($l['city']);
				$lead_record->setZip($l['zip']);
				$lead_record->setState($l['state']);
				$lead_record->setDatecreated($l['datecreated']);
				$lead_record->setDatelastupdated($l['datelastupdated']);
				$lead_record->setStatus($l['status']);
			}

			if($lead_record->getStatus() == 1)
			{
				$lead_record->setStatus(0);
				$fields = array('status', 'datelastupdated');
				$where  = "WHERE id = ?";
				$params = array(
										$lead_record->getStatus(),
										$lead_record->getDatelastupdated(),
										$lead_record->getId()
									);
				$result = $lead_model->updateLead($table, $fields, $where, $params);

				if($page_request == "form")
				{
					header("location: ../leads/manage.php?msg=deleted");
					exit;
				}
				else if($page_request == "list")
				{
					header("location: ../leads/leads.php?msg=deleted");
					exit;
				}
			}
			else
			{
				if($page_request == "form")
				{
					header("location: ../leads/manage.php?msg=prev_deleted");
					exit;
				}
				else if($page_request == "list")
				{
					header("location: ../leads/leads.php?msg=prev_deleted");
					exit;
				}
			}
		}
		else
		{
				if($page_request == "form")
				{
					header("location: ../leads/manage.php?msg=none");
					exit;
				}
				else if($page_request == "list")
				{
					header("location: ../leads/leads.php?msg=none");
					exit;
				}
		}
	}
?>