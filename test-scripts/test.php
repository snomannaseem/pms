<?php 

	$row = "cid: 1\ncid: 1";
	preg_match("/^cid\: [0-9]+/is", $row, $matches);
	print_r($matches);