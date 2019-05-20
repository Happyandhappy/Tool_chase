<?php
	require_once('utils.php');

	if ($_SERVER['REQUEST_METHOD'] != 'POST') errorMessage('POST method only allowed');
	$action = getValue($_POST, 'action');

	switch ($action) {
		case 'settings':
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
			Import($_POST);
			echo json_encode(array("status" => "success", "message" => "imported!"));
			break;
		default:
			errorMessage('action parameter is missing.');
			break;
	}
?>