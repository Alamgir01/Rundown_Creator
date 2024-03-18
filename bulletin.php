<?php
session_start();
include "connection.php";
$id=$_SESSION['id'];
$sql="select * from story where rundown_id= $id order by b_id asc";
$result1 = mysqli_query($connect,$sql);
if(!$result1){
	echo mysqli_errno($connect); 
}

if(isset($_POST['submit'])){
	//var_dump($_POST['A']);
	foreach($_POST["A"] as $value => $v){
		$insert="update story set b_id='$value' where story_id=$v" ;
		$result=mysqli_query($connect,$insert);
		if(!$result){
			echo mysqli_errno($connect);
		}else{
			header("Location:bulletin.php");
		}
 }
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
  background-color: #f2f2f2;
  padding: 20px;
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
<div style="overflow-x: auto;">
		<p> Bulletin </p>
	<form action="bulletin.php" method="post">
	<table>
		<thead>
			<tr>
				<th>Slug Name</th>
				<th>Writer</th>
				<th>Segment</th>
			</tr>
		</thead>
		<tbody id="sortable" >
		<?php  while($row1=mysqli_fetch_assoc($result1)){ ?>							
			<tr>
				<input type="hidden" name="A[]" value="<?php echo $row1['story_id'];?>">
				<td> <?php echo $row1['slug_name']." " ; ?></td>
				<td> <?php echo $row1['writer']." " ; ?></td>
				<td> <?php echo $row1['segment']." " ; ?></td>
				<td><a href="update.php?story_id=<?php echo $row1['story_id'];?>"><?php  echo "Update";?></a></td>
				<td><a href="print.php?story_id=<?php echo $row1['story_id'];?>"><?php  echo "Print";?></a></td>
			</tr>
		<?php
			}mysqli_close($connect);
		 ?>	
		</tbody>
		
	</table>
	 <input type="submit" name="submit" value="Apply">
	</form>
</div>
</body>
</html>

