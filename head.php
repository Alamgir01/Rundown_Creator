
<style>
	#headnav a{
	    float:Left;
	    border:1px solid black;
		text-align: center;
		font-size: 17px;
		padding :15px 50px 15px;
		margin :10px;		
		background-color:#045c44;
		color:white;
		text-decoration: none;
        overflow:hidden;
	  }
    #headnav a:hover,#category p:hover{
	  background-color:#39ac6d;
	  color:white;
	 }	  
</style>

<div style="background-image:url('promo_bg.png');"> 
  <div> 
    <ul>
        <img src="Logogtv.png" sytle="margin">
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

