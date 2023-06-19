
<div >
  <h2>Book Items</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Image</th>
        <th class="text-center">Book Name</th>
        <th class="text-center">Book Author</th>
        <th class="text-center">Translator</th>
        <th class="text-center">Page</th>
        <th class="text-center">Category</th>
        <th class="text-center">Language</th>
        <th class="text-center">Summary</th>
        <th class="text-center">Like</th>

        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from book, category WHERE book.category_id=category.category_id";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><img height='100px' src='../<?=$row["photo"]?>'></td>
      <td><?=$row["book_name"]?></td>
      <td><?=$row["book_author"]?></td>   
      <td><?=$row["translator"]?></td>      
      <td><?=$row["pages"]?></td>      
      <td><?=$row["category_name"]?></td>
      <td><?=$row["book_lang"]?></td>    
      <td style="height: 100px; width: 200px; overflow-y: scroll; display: block;"><?=$row["summary"]?></td>      
      <td><?=$row["likes"]?></td>      
 
      <td><button class="btn btn-primary" style="height:40px" onclick="itemEditForm('<?=$row['book_id']?>')">Edit</button></td>
      <td><button class="btn btn-danger" style="height:40px" onclick="itemDelete('<?=$row['book_id']?>')">Delete</button></td>
      </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#myModal">
    Add Book
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Book Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  enctype='multipart/form-data' onsubmit="addItems()" method="POST">
            <div class="form-group">
              <label for="name">Book Name:</label>
              <input type="text" class="form-control" id="book_name" required>
            </div>
            <div class="form-group">
              <label for="author">Book Author:</label>
              <input type="text" class="form-control" id="book_author" required>
            </div>
            <div class="form-group">
              <label for="translator">Translator:</label>
              <input type="text" class="form-control" id="translator" required>
            </div>
            <div class="form-group">
              <label for="pages">Page:</label>
              <input type="number" class="form-control" id="pages" required>
            </div>
           
            <div class="form-group">
              <label>Category:</label>
              <select id="category" >
                <option disabled selected>Select category</option>
                <?php

                  $sql="SELECT * from category";
                  $result = $conn-> query($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      echo"<option value='".$row['category_id']."'>".$row['category_name'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Language:</label>
              <input type="text" class="form-control" id="language" required>
            </div>
           
            <div class="form-group">
              <label for="summary">Summary:</label>
              <input type="text" class="form-control" id="summary" required>
            </div>
            <div class="form-group">
                <label for="file">Choose Image:</label>
                <input type="file" class="form-control-file" id="file">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add Item</button>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  
</div>
   