<?php
	session_start();
	include "connection.php";
	if(isset($_POST['comment'])){
		$comment = $_POST["comment"];
		$currentDate = date('Y-m-d');
		$insert="INSERT INTO rundown(rundown_name, rundown_create_date) VALUES ('$comment','$currentDate')" ;
		$result = mysqli_query($connect,$insert);
		if(!$result){
			echo mysqli_errno($connect);
		}else{
			echo mysqli_affected_rows($connect)." affected";
			header("Location:rundown.php");
		}
	}
	//$name = $_POST["name"];
	//
	$query="select * from rundown";
	$result = mysqli_query($connect,$query);
	if(!$result){
		echo mysqli_errno($connect);
		 
	}
	
   
?>
<style>
  table {
  width:50%;
  border: 1px solid green;
  border-radius: 10px;
  
}
tr ,td  {
  text-align: center;
  padding: 10px 10px 10px 10px;
  border: 1px solid ;
  border-color: green;
  border-collapse: collapse;
  border-radius: 10px;
}

textarea {
  width: 100%;
  height: 50px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
}

a:link, a:visited {
  background-color: MediumSeaGreen;
  color: white;
  border: 2px solid white;
  border-radius: 12px;
  padding: 5px;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin:10px;
}

a:hover, a:active {
  background-color: DarkTurquoise;
  color: white;
}
p {
	background-color: MediumSeaGreen;
	font-weight: bold;
}

</style>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
  } );
  </script>
</head>
<body>
	<div style="background-color:#045c44; margin-bottom:50px;"> 
		<div style="background-image:url('promo_bg.png');"> 
		  <div> 
			<ul>
				<img src="Logogtv.png">
							<h1></h1>
					<h3 style="color:white;">Green Multimedia Limited</h3>	
			</ul>	
		  </div>
			<div id="headnav"> 
				<a href="rundown.php">Rundown</a>
				<?php if(isset($_SESSION['id'])){ ?>
				<a href="bulletin.php">Bulletin</a>
				<a href="story.php?id=<?php echo $_SESSION['id']; ?>">Story</a>
				<?php } ?>
			</div>
		</div>
	</div>
    <div>
	    <form name="form1" method="POST" action="rundown.php" accept-charset="utf-8" id="rundown_form" >
		  <label for="rundown">Create Rundown </label><br>
		   <textarea name="comment" rows="4" cols="50" required autofocus ></textarea>
		   <input type="submit" value="Submit">
		</form> 
	</div>
	<div>
	<p style=""> Rundown List </p>
	 <table> 
			<?php  while($row=mysqli_fetch_assoc($result)){ ?>
				<tr>  
				  <td><a href="story.php?id=<?php echo $row['rundown_id'];?>"><?php echo $row['rundown_name']." "; ?></a></td>  
				  <td><a href=""><?php echo $row['rundown_create_date']." "; ?></a></td> 
				</tr>
			<?php
			  }//mysqli_close($connect);
			?>
	 </table>
	</div>
</body>
</html>