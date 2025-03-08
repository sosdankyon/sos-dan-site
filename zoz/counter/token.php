<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ctoken'])){
		$token = basename($_POST['ctoken']);

		$filepath = "../../counter/tmp/{$token}.txt";
		if (file_exists($filepath)) {
			$ctime = filemtime($filepath);
	        $now = time();

	        if ($now - $ctime <= 60) {
		        $count_path = '../../counter/count.txt';
		        $file = fopen($count_path, 'r+');
		        $count = fread($file, filesize($count_path));
			    $count = (int) $count;
			    $count++;

			    fseek($file, 0);
				fwrite($file, "$count");
				fclose($file);
			}

		    unlink($filepath);
	    }
	}
?>