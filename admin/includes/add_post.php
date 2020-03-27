
<?php 
   if(isset($_POST['create_post'])){
   $post_title = $_POST['post_title'];
   $post_author = $_POST['post_author'];
   $post_category_id = $_POST['post_category_id'];
   $post_status = $_POST['post_status'];
   $post_image = $_FILES['post_image']['name'];
   $post_image_temp = $_FILES['post_image']['tmp_name'];
   $post_tag = $_POST['post_tag'];
   $post_content = $_POST['post_content'];
   $post_date = date('d-m-y');
   //$post_comment_count = 4;

   move_uploaded_file($post_image_temp, "../images/$post_image" );

   $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_status) VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tag}',  '{$post_status}') ";

   $create_post_query = mysqli_query($connection, $query);

   $the_post_id = mysqli_insert_id($connection);

   confirmQuery($create_post_query);

   echo "<p class='bg-success'>Post has been created successfully <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit more Posts</a> </p>";

  
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
        <?php

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        confirmQuery($select_categories); // izbacit ce error ako nema podataka ako ima ide dalje..
                                                
        while($row = mysqli_fetch_assoc($select_categories)){
        
        $cat_id = $row['category_id'];
        $cat_name = $row['category_name'];

        if($row['category_id'] == $post_category_id)
        {
            $sel = "selected";
        }
        else
        {
            $sel = '';
        }

        echo "<option value='{$cat_id}'$sel>{$cat_name}</option>";
     
        }
        
        ?>
    </select>
</div>

    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class=form-group"> 
        <select name="post_status" id="">
            <option value="">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
       
    </div>

    <br />

    <div class="form-group">
        <label for="post_image">Picture</label>
        <input type="file" class="form-control" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_content">Body</label>
        <textarea type="text" class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="post_tag">Post Tags</label>
        <input type="text" class="form-control" name="post_tag">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
    