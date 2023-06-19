
<div class="container p-5">

<h4>Edit Book Detail</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM book WHERE book_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
      $catID=$row1["category_id"];
?>
<form id="update-Items" onsubmit="updateItems()" enctype='multipart/form-data'>
	<div class="form-group">
      <input type="number" class="form-control" id="book_id" value="<?=$row1['book_id']?>" hidden>
    </div>
    <div class="form-group">
      <label>Book Name:</label>
      <input type="text" class="form-control" id="book_name" value="<?=$row1['book_name']?>">
    </div>
    <div class="form-group">
      <label >Book Author:</label>
      <input type="text" class="form-control" id="book_author" value="<?=$row1['book_author']?>">
    </div>
    <div class="form-group">
      <label>Page:</label>
      <input type="number" class="form-control" id="pages" value="<?=$row1['pages']?>">
    </div>
    <div class="form-group">
      <label>Summary:</label>
      <input type="longtext" class="form-control" id="summary" value="<?=$row1['summary']?>">
    </div>
    <div class="form-group">
      <label>Language:</label>
      <input type="text" class="form-control" id="language" value="<?=$row1['book_lang']?>">
    </div>
    <div class="form-group">
      <label>Translator:</label>
      <input type="text" class="form-control" id="translator" value="<?=$row1['translator']?>">
    </div>
    
    
    <div class="form-group">
      <label>Category:</label>
      <select id="category">
        <?php
          $sql="SELECT * from category WHERE category_id='$catID'";
          $result = $conn-> query($sql);
          if ($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
              echo"<option value='". $row['category_id'] ."'>" .$row['category_name'] ."</option>";
            }
          }
        ?>
      </select>
    </div>
      <div class="form-group">
         <img width='200px' height='150px' src='<?=$row1["photo"]?>'>
         <div>
            <label for="file">Choose Image:</label>
            <input type="text" id="existingImage" class="form-control" value="<?=$row1['photo']?>" hidden>
            <input type="file" id="newImage" value="">
         </div>
    </div>
    <div class="form-group">
      <button type="submit" style="height:40px" class="btn btn-primary">Update Book</button>
    </div>
    <?php
    		}
    	}
    ?>
  </form>

    </div>