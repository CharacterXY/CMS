<?php
// ako je pritisnut odnosno pozvan request gledamo koji je te ga trazimo u bazi da nesto nparavimo s njim.
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];

}

// ovdje selektiramo odredeni post koji stisnemo da zelimo editirat potom taj post zovemo iz baze i ljepimo u inpute od edita da se vidi sto zelimo promjeniti.

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";

$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_author = $row['post_author'];
    $post_content = $row['post_content'];
    $post_tag = $row['post_tag'];
    $post_comment_count = $row['post_comment_count'];
    $post_status = $row['post_status'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
}

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tag = $_POST['post_tag'];
        $post_content = $_POST['post_content'];


        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_image)){
        $post_image = $row['post_image'];
        }
        } 
        
        $query = "UPDATE posts SET ";
        $query .="post_title = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date = now(), ";
        $query .="post_author = '{$post_author}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tag = '{$post_tag}', ";
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}' ";
        $query .="WHERE post_id = {$the_post_id} ";

        $update_post = mysqli_query($connection, $query);

        confirmQuery($update_post);
     
        echo "<p class='bg-success'>You're post has edit successfully <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit more Posts</a> </p>";
     
        
        ?>
        <hr />
        <?php

    }
?>              

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>

    <!-- Ovdje zovemo query za kategorije da ih mozemo prikazati u padajucem izborniku kad zelimo editirat pojedini post -->
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
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    
    <div class="form-gorup">
    <select name="post_status" id="">
        <option value='<?php echo $post_status ;?>'><?php echo $post_status; ?></option>
        <?php
        if($post_status == 'published'){

            echo "<option value='draft'>Draft</option>";  
        } else {
            echo "<option value='published'>Published</option>"; 
        }
 
        ?>
    </select>
    </div>

 <!--    <div class=form-gorup">
        <label for="post_author">Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div> -->

    <div class="form-group">
        <br />
        <img id="post_picture" width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" class="form-control" name="post_image" value="<?php echo $post_image; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Body</label>
        <textarea  type="text"  class="form-control" name="post_content" id=body cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <label for="post_tag">Post Tags</label>
        <input type="text" class="form-control" name="post_tag" value="<?php echo $post_tag; ?>">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>


<style>

#post_picture{
    border-radius: 50%;
    opacity: 80%;
    box-shadow: 10px 10px 5px grey;
    
}

</style>