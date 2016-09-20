<?php
	session_start();
	require '../class/database.php';
	require '../class/lead.php';
	require '../class/phones.php';
	require '../class/note.php';
	require '../model/phones_model.php';
	require '../model/lead_model.php';
	require '../model/note_model.php';


	$leads = new Leads();
	$lead_model = new Lead_Model(new Database());
	$phone = new Phone();
	$phone_model = new Phone_Model(new Database());
	$note = new Note();
	$note_model = new Note_Model(new Database());

	extract($_POST);
	if(isset($_POST['create_lead']))
	{
		print_r($_POST);
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
		$leads->setStatus(1);


		$data = [
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
					'status' => $leads->getStatus() ,
				];

		$result = $lead_model->createLead('leads', $data);
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

		header("location: ../leads/manage.php?msg=inserted");
	}
?>