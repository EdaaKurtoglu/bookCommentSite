

function showProductItems(){  
    $.ajax({
        url:"./adminView/viewAllProducts.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showComments(){  
    $.ajax({
        url:"./adminView/viewAllComment.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showLog(){  
    $.ajax({
        url:"./adminView/viewLogMove.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function showCategory(){  
    $.ajax({
        url:"./adminView/viewCategories.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}



function showCustomers(){
    $.ajax({
        url:"./adminView/viewCustomers.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}




//add product data
function addItems(){
    var book_name=$('#book_name').val();
    var book_author=$('#book_author').val();
    var translator=$('#translator').val();
    var pages=$('#pages').val();
    var category=$('#category').val();
    var language=$('#language').val();
    var summary=$('#summary').val();
   
    var file=$('#file')[0].files[0];
    var upload=$('#upload').val();

    var fd = new FormData();
    fd.append('book_name', book_name);
    fd.append('book_author', book_author);
    fd.append('translator', translator);
    fd.append('pages', pages);
    fd.append('category', category);
    fd.append('language', language);
    fd.append('summary', summary);
    fd.append('file', file);
    fd.append('upload', upload);
    $.ajax({
        url:"./controller/addItemController.php",
        method:"post",
        data:fd,
        processData: false,
        contentType: false,
        success: function(data){
            alert('Product Added successfully.');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}

//edit product data
function itemEditForm(id){
    $.ajax({
        url:"./adminView/editItemForm.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

//update product after submit
function updateItems(){
    var book_id = $('#book_id').val();
    var book_name=$('#book_name').val();
    var book_author=$('#book_author').val();
    var pages=$('#pages').val();
    var category = $('#category').val();
    var language=$('#language').val();
    var translator=$('#translator').val();
    var summary=$('#summary').val();
    var existingImage = $('#existingImage').val();
    var newImage = $('#newImage')[0].files[0];
    var fd = new FormData();
    fd.append('book_id', book_id);
    fd.append('book_name', book_name);
    fd.append('book_author', book_author);
    fd.append('pages', pages);
    fd.append('category', category);
    fd.append('language', language);
    fd.append('translator', translator);
    fd.append('summary', summary);
    fd.append('existingImage', existingImage);
    fd.append('newImage', newImage);
   
    $.ajax({
      url:'./controller/updateItemController.php',
      method:'post',
      data:fd,
      processData: false,
      contentType: false,
      success: function(data){
        alert('Data Update Success.');
        $('form').trigger('reset');
        showProductItems();
      }
    });
}

//delete product data
function itemDelete(id){
    $.ajax({
        url:"./controller/deleteItemController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Items Successfully deleted');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}








//delete category data
function categoryDelete(id){
    $.ajax({
        url:"./controller/catDeleteController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Category Successfully deleted');
            $('form').trigger('reset');
            showCategory();
        }
    });
}




function search(id){
    $.ajax({
        url:"./controller/searchController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.eachCategoryProducts').html(data);
        }
    });
}




