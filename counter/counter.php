<?php
	function not_bot(){
		$blockedBots = [
		    '-', 'bot', 'curl', 'python', 'HttpClient', 'wget', 
		    'java', 'Go-http-client', 'libwww-perl', 'PHP', 'postman',
		    'headless'
		];
		$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '-';

		foreach ($blockedBots as $bot) {
		    if(stripos($userAgent, $bot) !== false) {
		        return false;
		    }
		}

		// analyze_ua($userAgent);
		return true;
	}

	// function analyze_ua($ua){
	// 	$file = fopen('../counter/uas.txt', 'a');
	//     fwrite($file, "\n". $ua);
	//     fclose($file);
	// }

	function check_countable(){
		if (!isset($_COOKIE['visited'])) {
			if(not_bot()){
		    	setcookie('visited', '1', time() + (30 * 60), "/");
		    	return true;
		    }else{
		    	return false;
		    }
		}else {
		    return false;
		}
	}

	function print_counter($count){
		$str_count = str_pad($count, 8, '0', STR_PAD_LEFT);
		$nums = str_split($str_count);
		$result = '';

		foreach ($nums as $num) {
		    $result .= "<img src='image/counter/{$num}.gif' alt='{$num}'>";
		}

		return $result;
	}

	function counter(){
		global $token, $countable;
		$count_path = '../counter/count.txt';

		if(file_exists($count_path)) {
		    $file = fopen($count_path, 'r+');
		    $count = fread($file, filesize($count_path));
		    $count = (int) $count;

		    if($countable){
			    $count++;

			    if($token !== ''){
				    $token_file = fopen("../counter/tmp/{$token}.txt", 'w');
				    fwrite($token_file, '');
				    fclose($token_file);
				}
			}
		}else {
			$file = fopen($count_path, 'w');
			chmod($count_path, 0666);
			fwrite($file, '1');
		    $count = 1;
		}

		fclose($file);

		echo print_counter($count);
	}

	function counter_token(){
		global $token, $countable;

		if(!$countable){
			$token = '';
		}

		echo "<script>const ctoken = '{$token}';</script>";
	}


	$token =  uniqid();
	$countable = check_countable();
?>