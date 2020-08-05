<?php
	set_time_limit(300);
	session_start();

	require_once('config.php');
	require_once('PowerImportAPI.php');
	

	$names = [
        'Campaign_A',
        'Subcampaign_A',
        'Rate_A',
        'Campaign_B',
        'Subcampaign_B',
        'Rate_B',
    ];

    $api1 = new PowerImportAPI("http://" . SYSTEM_A . "/PowerStudio/WebAPI");
	$api2 = new PowerImportAPI("http://" . SYSTEM_B . "/PowerStudio/WebAPI");

    // Checke User logged in status
	if (!isset($_SESSION['LoggedIn'])) {
		header('Location: index.php');
		exit();
	}


	// Check User set credentials status
	foreach ($names as $name) {
		if (getValue($_SESSION, $name) == '' and $page == 'Home' and $name != 'Subcampaign_A' and $name != 'Subcampaign_B'){
			header('Location: settings.php');
			exit();
		}	
	}

/////////////////////////////////////////////////////////////////////////////////////////
	function errorMessage($message){
		echo json_encode(array('status' => 'failed','message' => $message));
		exit;
	}

	/* get Value from $data with $name if not existed, then echo error message */
	function setValue($data, $name){
		if (!isset($data[$name])){
			return false;
		}

		$_SESSION[$name] = $data[$name];
		return true;
	}


	function getValue($data, $name){
		if (!isset($data[$name])){
			return '';
		}		
		return $data[$name];	
	}

	// Save file
	function saveFile(){
		$image = null;
		if (isset($_FILES["file"])) {
			$target_dir = "uploads/";
			$image_name = $_FILES["file"]['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$error = $_FILES['file']['error'];
			if ($error === 0){
				$words = explode(".", $image_name);
                $name = uniqid() . '.' . end($words);
                $storagename = $target_dir . $name;
				@move_uploaded_file($tmp_name, $storagename);
				$image = str_replace("uploads",'uploads',$storagename);
			}else{
				errorMessage("Failded in image uploading...");
			}
		}
		return $image;
	}


	// get content from CSV file
	function getContentFile($filename){
		// The nested array to hold all the arrays
		$data_array = [];
		$header = [];
		$first = true;
		try{
			// Open the file for reading
			if (($h = fopen("{$filename}", "r")) !== FALSE) 
			{
			  	// Each line in the file is converted into an individual array that we call $data
			  	// The items of the array are comma separated
			  	while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
			  	{	
			  		if ($first == true){
			  			$first = false;
			  			$header = $data;
			  		}else{
			  			$arr = [];
			  			$index = 0;
			  			foreach ($header as $key) {
			  				$arr[$key] = $data[$index++];
			  			}
			  			// Each individual array is being pushed into the nested array
				    	$data_array[] = $arr;
			  		}			    	
			  	}

			  	// Close the file
			  	fclose($h);
			}
		}catch(Exception $e) {
		  	errorMessage("File format is wrong.");
		}
		unlink($filename) or errorMessage("Couldn't delete file");
		return $data_array;
	}



	function Import($data){
		// initialize variables
		$dialDups = 0;
		$dialNonCallables = 0;
		$duplicatesCheck = 1;

		$type = $data['type'];
		unset($data['type']);
		if ($type == 'A'){
			$api =  $GLOBALS['api1'];
			$data['SecurityCode'] = SecurityCode_A;
			$groupid 	  = GroupID_A;
		}else{
			$api =  $GLOBALS['api2'];
			$data['SecurityCode'] = SecurityCode_B;
			$groupid	  = GroupID_B;
		}

		$subcampaign = $data['Subcampaign'];unset($data['Subcampaign']);
		$campaign    = $data['Campaign'];   unset($data['Campaign']);


		$result = $api->ImportData($data, $groupid, $campaign, $subcampaign, $dialDups, $dialNonCallables, $duplicatesCheck);

		if($result == false){
			$result = $api->GetLastError();
		}
		else{
			echo "<br>";
			$result = " OK";
		}

		echo $result;
	}
?>