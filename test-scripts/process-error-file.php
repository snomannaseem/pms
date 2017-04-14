<?php 

	$source_file = 'XMLtoJSONFilterMongo.out';
	$error_file = 'error.out';
	
	$file_handle = fopen($source_file, "r") or die("Unable to open file ". $source_file);
	$msg = "";

	$msg_found = false;
	$first_cid = "";
	$second_cid = "";
	$cnt = 0;
	
	#while (($row = trim(fgets($file_handle,4096)))) {
	while (!feof($file_handle)) {
		
		$row = "";
		while (($char = fgetc($file_handle))) {
			if ($char == "\n") break;
			$row .= $char;
		}

		if (empty($row)){
			continue;
		}
		# Parsing line and searching for cid: 2323323 like pattern
		if (preg_match("/^cid\: [0-9]+/is", $row, $matches)){
			
			if (!$msg_found){
				if (isset($matches[0])){
					$first_cid = $matches[0];
					print $first_cid. "\n";
					$second_cid = "";
				}
				continue;
			}
			
			$second_cid = $matches[0];
			
			// Writing data to file.
			
			file_put_contents($error_file, $first_cid."\n".$msg.$second_cid."\n", LOCK_EX | FILE_APPEND);
			$msg_found = false;
			$msg = "";
			$first_cid = "";
			$second_cid = "";
			continue;
		}
		
		# Line 
		if (!empty($first_cid)){
			$msg_found = true;
			$msg .= $row. "\n";
		}
		
		
		$cnt++;
	}
	
	
    if (!feof($file_handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
	print "Total rows are ${cnt}\n";
	fclose($file_handle);
