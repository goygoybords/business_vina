<?php
	session_start();
	require '../class/database.php';
	require '../class/lead.php';
	require '../model/lead_model.php';

	$lead = new Leads();
	$lead_model = new Lead_Model(new Database());


	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
	{

		$table = "leads";
		$fields = array('id','companyname', 'firstname', 'lastname');
		$where = 1;
		$params = array();

		$leads = $lead_model->get_all($table, $fields, $where, $params);
		$arr_json = array();
			foreach ($leads as $l )
			{
				$arr_json[] = array($l['id'], $l['companyname'], $l['firstname'] , $l['lastname']);
			}


			$data = array("draw" => 1,"recordsTotal" => count($leads), 
				"recordsFiltered" => count($leads), "data" =>  $arr_json  );
		echo json_encode($data);
	}
?>