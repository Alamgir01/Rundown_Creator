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
	
	if(isset($_POST['update'])){
	 $rundown_id=$_SESSION['id'];
	 $slug_name=$_POST['slug_name'] ; 
	 $slug=$_POST['slug'] ; 
	 $writer=$_POST['writer'] ; 
	 $segment=$_POST['segment'] ;
	 
	 $insert="update story set slug_name='$slug_name',slug='$slug',writer='$writer',segment='$segment' where story_id=$id" ;
	 $result=mysqli_query($connect,$insert);
	 if(!$result){
			echo mysqli_errno($connect);
		}else{
			$value="file/".$id.".txt";
			$myfile = fopen($value, "w") ;
			fwrite($myfile,$slug_name);
			fwrite($myfile,"/");
			fwrite($myfile,$segment);
			fwrite($myfile,"/");
			fwrite($myfile,$writer);
			fwrite($myfile,"\n");
			fwrite($myfile,"\n");
			fwrite($myfile, $slug);
			
			echo mysqli_affected_rows($connect);
			echo "Data Updated Succssfully";
			header("Location:story.php?id=$rundown_id");
		}
	}
?>
<style>

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
a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
  background-color: lightgreen;
}

a:active {
  text-decoration: underline;
}

</style>

<div>
	<p> Story </p>
	<form method="post" action="update.php?story_id=<?php echo $id ;?>">	
		   
					  <?php  while($row=mysqli_fetch_assoc($result)){ ?>				
							 <input type="hidden" value="<?php echo $row['story_id']?>"/>  
							  <input type="hidden" value="<?php echo $row['rundown_id']?>"/> 
								<label for="s_name">Story or Slug  Name</label>
								<input type="text" name="slug_name" value="<?php echo $row['slug_name']?>" required autofocus />
								<label for="story">Story Or Slug</label>
								<textarea name="slug" rows="2" cols="50" value="" required autofocus ><?php echo $row['slug']?></textarea><br/>
								<label for="writer">Writer</label>
								<input type="text" placeholder="Enter Writer Name" name="writer" value="<?php echo $row['writer']?>" required /><br/>
							  <label for="segment">Segment</label>
								<select name="segment" id="city">
									<option value="<?php echo $row['segment']?>"><?php echo $row['segment']?></option>
									<option value="PKG">PKG</option>
									<option value="OOV">OOV</option>
									<option value="OOV+SOT">OOV+SOT</option>
									<option value="IV SOT">IV SOT</option>
									<option value="GFX">GFX</option>
									<option value="GB">GB</option>
								</select>
							  </td>
							<input type="submit" value ="Update" name="update" />
					<?php
					  }mysqli_close($connect);
					   ?>
	    </table>
	</form>
</div>
