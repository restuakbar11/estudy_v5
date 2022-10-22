<?php
	$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$_SESSION[username]'");
	while($row = mysqli_fetch_array($query)){
		echo"<div class='media'>
		<div class='media-left pr-1'>";
							if($row['photo'] == ''){echo"<a href='#' class='profile-image'><img src='themes/user/avatar.png' alt='niozone' class='ounded-circle img-border height='100'></a>";}
							else{ echo"<a href='#' class='profile-image'><img src='themes/user/$row[photo]'  alt='niozone' class='ounded-circle img-border width='125' height='90'></a>"; }
						
		echo"</div>
		<div class='media-body'><h4><b>";
			if($_SESSION['level'] == 'A'){ echo"Superuser";}
			else{echo"Guru";}
		
		echo"</b></h4><h6 class='f14'><i class='ft-users'></i> $_SESSION[nama]</h6>
			<b class='f12'> </b>
		</div>
		</div>
		";
			  
?>
<?php } ?>