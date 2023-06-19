<div >
  <h2>Log Details</h2>
  <table class="table ">
    <thead>
      <tr>
      <th class="text-center">SN</th>
        <th class="text-center">Moves</th>
        
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT *
      FROM log INNER JOIN users ON users.user_id = log.user_id;";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["user_id"]?>  <?=$row['actions']?> on <?=$row["date"]?> . </td>
           
          
 
       </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>
  
</div>
   