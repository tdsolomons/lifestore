<?php

class A extends CI_Controller {
		
function __construct()
{
	parent::__construct();

	$myfile = fopen("a.txt", "w") or die("Unable to open file!");
	$txt = "Mickey Mouse\n";
	fwrite($myfile, $txt);
	$txt = "Minnie Mouse\n";
	fwrite($myfile, $txt);
	fclose($myfile);
}

 public function index()
 	{
 		//load user's items table
	
	}

}
?>