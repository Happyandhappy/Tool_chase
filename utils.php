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
		$type = $data['type'];
		if ($type == 'A'){
			$data['SecurityCode'] = SecurityCode_A;
			$data['GroupId'] 	  = GroupID_A;
		}else{
			$data['SecurityCode'] = SecurityCode_B;
			$data['GroupId'] 	  = GroupID_B;
		}
		
		unset($data['type']);
		$Url = "https://www.chasedatacorp.com/HttpImport/InjectLead.php?".http_build_query($data);
		// echo $Url;
		$ch = curl_init($Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}
?>