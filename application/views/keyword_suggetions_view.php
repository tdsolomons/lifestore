<?php

if ($keywords) {
	$arr;
	foreach ($keywords as $object) {
		 $arr[] = $object->keyword;
		 //echo $object->keyword;
	}
	echo json_encode($arr);
}

?>