<?php 
	session_start();
	include "connection.php";
	//echo $_REQUEST['story_id'];
	$id=$_REQUEST['story_id'];
	if(isset($_REQUEST['story_id'])){
		$query="select * from story where story_id=$id";
		$result = mysqli_query($connect,$query);
		if(!$result){
			echo mysqli_errno($connect); 
		}
	}

?>

<style>

textarea {
  width: 50%;
  height: 10%;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}


div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

</style>

<div>	   
	  <?php  while($row=mysqli_fetch_assoc($result)){ ?>				
				
				<p>
					<?php 
							echo "\n";
							echo $row['slug_name']."\n" ; 
							echo "\n";
					?>
				</p>
				<p>
					<?php
							echo "\n";
							echo $row['segment'];
							echo "\n";
					?>
				</p>				<p>
					<?php
							echo "\n";
							echo $row['writer'];
							echo "\n";
					?>
				</p>
				<p>
					<?php
							echo "\n";
							echo "\n";
							echo $row['slug']; 
					?>
				</p>
				
	<?php
		echo "<script type = 'text/javascript'> window.print();</script>" ;
	  }mysqli_close($connect);
	   ?>
</div>