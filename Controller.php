<?php
	$page = "Controller";
	require_once('utils.php');

	if ($_SERVER['REQUEST_METHOD'] != 'POST') errorMessage('POST method only allowed');
	$action = getValue($_POST, 'action');

	switch ($action) {
		case 'settings':
			if ($_POST['Rate_A'] + $_POST['Rate_B'] > 100) errorMessage("Rates cant be over 100");
			foreach ($names as $name) {
            	if (!setValue($_POST,$name)){
	                errorMessage($name . " is missing.");
            	}
        	}        	
        	echo json_encode(array("status" => "success", "data" => $_POST));
			break;
		case 'upload':
			$file = saveFile();
			if ($file == null) errorMessage('File uploading error');
			else echo json_encode(array("status" => "success", "file" => $file, "data" => getContentFile($file)));
			break;

		case 'import':
			unset($_POST['action']);
			$data = json_decode($_POST['data']);

			foreach ($data as $row) {
				$res = Import((array)$row);
			}

			/*$res = Import($_POST);
			if (strpos($res, 'OK') > 0)
				echo json_encode(array("status" => "success", "message" => 'Imported!'));
			else if (strpos($res, 'Duplicated') > 0)
				echo json_encode(array("status" => "success", "message" => 'Duplicated phone number!'));
			else echo json_encode(array("status" => "success", "message" => $res));			
			*/
			break;
		default:
			errorMessage('action parameter is missing.');
			break;
	}
?>