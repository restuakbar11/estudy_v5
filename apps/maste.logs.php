<div class="col-md-12">
<div class="card-content card">
<div class="card-body card-dashboard">
			<table class="table table-borderless bg-lighten-4 zero-configuration">
			  <thead>
				<tr>
				  <th>Access</th>
				  <th>Date</th>
				  <th>Browser</th>
				  <th>Operation System</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$query = mysqli_query($config, "SELECT * FROM nio_user,counterdb WHERE counterdb.username=nio_user.username ORDER BY id DESC ");
				while($row = mysqli_fetch_array($query)){					
				$date = tgl_indo($row['tanggal']);
				echo"
				<tr class='f14'  data-toggle=\"tooltip\" data-original-title=\" IP Addres : $row[ip_address]\">	  
				  <td><a href='?page=on&usr=$row[username]' class='badge badge-pill badge-secondary' data-toggle='tooltip' data-original-title='Profile Detail'><i class='ft-user f12'></i></a> <b>$row[nama]</b></td>   
				  <td>$date</td> 
				  <td>$row[browser]</td>
				  <td>$row[os]</td>
				</tr>";
				}
				?>
			  </tbody>
			</table>
</div>
</div>
</div>