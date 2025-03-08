<?php
	$randomNumber = rand(1, 10);

	if (!isset($_COOKIE['m']) && !isset($_COOKIE['z'])) {
	    if ($randomNumber === 1) {
	        setcookie('m', '1', time() + (6 * 60 * 60), "/");
	        setcookie('z', '1', time() + (10 * 365 * 24 * 60 * 60), "/");
	    }
	}
?>
