<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
<?php

if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
                                        

        $edit_cat_query = "SELECT * FROM categories WHERE category_id = $cat_id ";
        $select_categories_id = mysqli_query($connection, $edit_cat_query);
                                            
        while($row = mysqli_fetch_assoc($select_categories_id)){
        $cat_id = $row['category_id'];
        $cat_title = $row['category_name'];
?>
<input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="category_name">
<?php } ?>



<?php //update query
                                                
    if(isset($_POST['update_category'])){
        $the_cat_title = $_POST['category_name'];
    
        $query = "UPDATE categories SET category_name = '{$the_cat_title}' WHERE category_id = {$cat_id} ";
        $update_query = mysqli_query($connection, $query);
         if(!$update_query){
            die("QUERY FAILD" . mysqli_error($connection));
            }

            }}

            ?>  
                                                      
            </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>

