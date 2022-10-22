
 <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="themes/sweetalert/css/sweetalert2.min.css">
<style type="text/css">
  .panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
          box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}
.panel-default {
  border-color: #ddd;
}
.panel-default > .panel-heading {
  color: #333;
  background-color: #f5f5f5;
  border-color: #ddd;
}
</style>

        <?php
          $no = 1; //batasan halaman
          $id_mapel = $_REQUEST['id_mapel'];
          $semester = $_SESSION['semester'];

                    
         // $id_mapel = ;
                    
                  
                   
                    
                    $data = mysqli_query($config, "SELECT * FROM m_soal_essay WHERE id_mapel='$id_mapel' and semester='$semester'");
                   
                    $urut = 0;
                    while($row=mysqli_fetch_array($data)) { 
                      $id_soal = $row['id'];
                      $soal = $row['soal'];                 
                      $jawaban = $row['jawaban'];
                      $kd_soal = $row['id_soal'];
                      ?>
          

      
      <tr>
          <td width="17"><font color="#000000"><?php echo $urut=$urut+1; ?></font></td>
          <td width="430"><font color="#000000"><b><?php echo "$soal"; ?></b></font></td>
      </tr></br>
     
      <tr>
          <td height="21"><font color="#000000">&nbsp;</font></td>
          
      </tr>
      <tr>
        <div class="form-group col-md-12">
                <input type="text" class="form-control border-primary" value="<?php echo $jawaban; ?>" disabled>
                <code class='f12 danger'> <b>JAWABAN</b></code>
                </div>
      </tr>
     </br></br></br></br>
      
    <?php
    }
    ?>
      </table>

        


