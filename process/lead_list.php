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
		$fields = array('companyname', 'position', 'firstname');
		$where = 1;
		$params = array();

		$leads = $lead_model->get_all($table, $fields, $where, $params);
		$arr_json = array();
			foreach ($leads as $l )
			{
				$arr_json[] = array($l['companyname'], $l['position'], $l['firstname']);
			}

			$data = array("draw" => 1, "data" => $arr_json);
		echo json_encode($data);
	}
?>