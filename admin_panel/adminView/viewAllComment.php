
<div >
  <h2>Comments Details</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Book Name</th>
        <th class="text-center">Comment</th>
        <th class="text-center">Username</th>
        <th class="text-center">Date</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT *
      FROM ((comments INNER JOIN users ON users.user_id = comments.user_id) INNER JOIN book ON book.book_id = comments.book_id);";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      
      <td><?=$row["book_name"]?></td>
      <td><?=$row["comment"]?></td>   
      <td><?=$row["username"]?></td>      
      <td><?=$row["date"]?></td>      
          
 
       </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>

  

  <!-- Modal -->
  
      
    
  

  
</div>
   