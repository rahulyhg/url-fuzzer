<?php
	$error = 0;
	if($argc >= 3){
		if(file_exists($argv[2])){
			if(filter_var($argv[1], FILTER_VALIDATE_URL) === false){
				$error = 3;
			}
		}
		else{
			$error = 2;
		}
	}
	else{
		$error = 1;
	}
	if($error <= 0){
		$url_arg = $argv[1];
		$url_list = [];
		$list = fopen($argv[2],"r");
		$result = [];
		while(!feof($list)){
			$url_list[] = fgets($list);
		}
		$ch = curl_init();
		$hide = [];
		for($i = 3; $i < $argc; $i++){
			$hide[] = $argv[$i];
		}			
		for($i = 0; $i < sizeof($url_list); $i++){
			$url = $url_arg."/".trim($url_list[$i]);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$res = curl_exec($ch);
			$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if(!empty($hide)){
				if(!in_array($code, $hide)){
					echo $url." ".strval($code)."\n";	
				}
			}
			else if($code != 404){
				echo $url." ".strval($code)."\n";	
			}
		}
		curl_close($ch);
		fclose($list);
	}
	else{
		switch($error){
			case 1:
				echo "\nUsage: php fuzzer.php <url> <list> [hide]...\n\nParameters:\n  url\t\t\tUrl to fuzz\n  list\t\t\tFile containing the list of directories to search\n  hide (Optional)\tHTTP codes to hide in results, default is 404";
				break;
			case 2:
				echo "Error: Unable to open list file";
				break;
			case 3:
				echo "Error: Invalid url";
				break;
			default:
				echo "Error: Unhandled exception";
				break;
		}
	}
?>