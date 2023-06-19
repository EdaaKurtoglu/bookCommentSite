<div >
  <h2>All Users</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Username </th>
        <th class="text-center">Email</th>
        <th class="text-center">profile_image</th>
       
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from users where isAdmin=0";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
    <td><?=$row["user_id"]?></td>
      <td><?=$row["username"]?></td>
      <td><?=$row["e_mail"]?></td>
      <td><img height='100px' src='../<?=$row["profile_image"]?>'></td>
      
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>