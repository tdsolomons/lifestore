<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<title>Untitled Document</title>
</head>

<body>
<h1>Testing Page</h1>

	<?php
	$test1="wer";
	$test = mt_rand(10,100)."100".$test1;
	echo $test;
	
	?>
    
    <button id="1"  onclick="test(1)" ></button>
    
    
	<script type="text/javascript">
	 function test(buttonid){
	   var id=buttonid;
	    this.document.write(id);
	   alert();
	 
	 }
	 
	 </script>
		    
	    




</body>
</html>
