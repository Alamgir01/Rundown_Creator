<?php 
	session_start();
	$id = $_SESSION["id"]=$_REQUEST['id'];
	include "connection.php";
	if (isset($_POST['create'])){ 
	 $rundown_id=$_REQUEST['id'];
	 $slug_name=$_POST['slug_name'] ; 
	 $slug=$_POST['slug'] ; 
	 $writer=$_POST['writer'] ; 
	 $segment=$_POST['segment'] ;
	 
	 $insert="INSERT INTO story VALUES ('','$rundown_id','$slug_name','$slug','$writer','$segment','')" ;
	 $result=mysqli_query($connect,$insert);
	 if(!$result){
			echo mysqli_errno($connect);
		}else{
			$last_id = mysqli_insert_id($connect);
			$value="file/".$last_id.".txt";
			$myfile = fopen($value, "w") ;
			fwrite($myfile,$slug_name);
			fwrite($myfile,"/");
			fwrite($myfile,$segment);
			fwrite($myfile,"/");
			fwrite($myfile,$writer);
			fwrite($myfile,"\n");
			fwrite($myfile,"\n");
			fwrite($myfile, $slug);
			fclose($myfile);
			
			echo mysqli_affected_rows($connect);
			echo "    ";
			echo "Data Updated Succssfully";
			header("Refresh:5");
			header("Location:story.php?id=$rundown_id");
		}
	}

    $query="select * from story where rundown_id= $id";
	$result = mysqli_query($connect,$query);
	if(!$result){
		echo mysqli_errno($connect); 
	}


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Green Tv News Bulletin</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<style>
  table {
  width:100%;
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
  height: 150px;
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
	
 	    <div class="center">
			<form method="post">
				<div class="container">  
						  <label for="s_name">Story or Slug  Name</label>
						  <input type="text" name="slug_name" required autofocus /><br/>
						  <label for="story">Story Or Slug</label>
						  <textarea id="story" name="slug" rows="10" cols="50"  autofocus ></textarea><br/>			  
						  <label for="writer">Writer</label>
						  <input type="text" placeholder="Enter Writer Name" name="writer"  /><br/>
						  
							<label for="segment">Segment</label>
							<select name="segment" id="city">
								<option value=" ">None</option>
								<option value="PKG">PKG</option>
								<option value="OOV">OOV</option>
								<option value="OOV+SOT">OOV+SOT</option>
								<option value="IV SOT">IV SOT</option>
								<option value="GFX">GFX</option>
								<option value="GV">GV</option>
							</select>
						  <input type="submit" value ="Create" name="create" />  
				</div>
			 </form>
		</div>	
		
	<div style="overflow-x: auto;">
		<p> Story List </p>
	 <table style="" >	   
					  <?php  while($row=mysqli_fetch_assoc($result)){ ?>			
						<tr> 
							  <td><a href="print.php?story_id=<?php echo $row['story_id'];?>">Print</a></td> 
							  <td> <a href="download.php?story_id=<?php echo $row['story_id'];?>"> <?php echo "Download"; ?></a></td>  
							  <td><a href="update.php?story_id=<?php echo $row['story_id'];?>"><?php echo "Update"; ?></a></td>  
							  <td> 
							  <p><?php echo $row['slug_name']." ";?><p/>
							  <textarea rows="20" cols="150" disabled ><?php echo $row['slug_name']." / "; echo $row['segment']." / ";echo $row['writer']." "; echo "\n";echo "\n";?><?php echo $row['slug']." "; ?>
							  </textarea>
							  </td> 
						</tr>
					<?php
					  }mysqli_close($connect);
					   ?>
	 </table>
	</div>
</body>
</html>