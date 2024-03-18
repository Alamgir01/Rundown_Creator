
<?php
       $host = "localhost" ;
	   $user = "root" ;
	   $password ="";
	   $db="newsroom";
	   $connect = mysqli_connect($host,$user,$password,$db);
	  if(!$connect){
	      die("ERROR: Could not connect. " . mysqli_connect_error());
	  }
?>
