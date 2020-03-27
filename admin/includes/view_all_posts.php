<!-- <script type="text/javascript">
           
           checkAll(){
               var checkboxes = document.getElementByName('checkBoxArray[]');
               for($i = 0; $i <= checkboxes.length; $i++){
                   checkboxes[$i].checked = true;
               }
            }
</script> -->
<?php
if(isset($_POST['checkBoxArray'])){ 

    foreach($_POST['checkBoxArray'] as $postValueId){

        if(isset($_POST['bulk_options'])){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){
                case 'published';
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_publish = mysqli_query($connection, $query);
                    confirmQuery($update_to_publish);
                break;
                case 'delete';
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                    $deleted_post = mysqli_query($connection, $query);
                break;
                case 'draft';
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $postValueId";
                    $draft_posts = mysqli_query($connection, $query);
                    confirmQuery($draft_posts);
                break;  
            }         
        }
    }
}
?>
<form action="" method="post">
<table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-5">
        <div class="form-group">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>

        <div class="col-xs-6">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
            <hr />
        </div>
    </div>
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Text</th>
            <th>Tag</th>
            <th>Comments</th>
            <th>Status</th>
            <th>Picture</th>
            <th>Date</th>
            <th>Action</th>
            </tr>
    </thead>
    <tbody>

<?php
$query = "SELECT * FROM posts";
$query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($query)){
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

    echo "<tr>";
    ?>
    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
    <?php
    echo "<td>{$post_id}</td>";
    echo "<td>{$post_title}</td>";
 
    $query_category = "SELECT * FROM categories WHERE category_id = {$post_category_id} ";
    $post_category_id = mysqli_query($connection, $query_category);
                                        
    while($row = mysqli_fetch_assoc($post_category_id)){
    $cat_id = $row['category_id'];
    $cat_title = $row['category_name'];
    }
    
    echo "<td><a href=''>$cat_title</td>"; // ispisujemo stvarni naziv kategorije za svaki post jer usporedujemo category_id s postovim post_category_id
    echo "<td>{$post_author}</td>";
    echo "<td>{$post_content}</td>";
    echo "<td>{$post_tag}</td>";
    echo "<td><a href=''>{$post_comment_count}</a></td>";
    echo "<td>{$post_status}</td>";
    echo "<td><img width='150x100' class='img-responsive' src='../images/$post_image' alt='image'></td>";
    echo "<td>{$post_date}</td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a> | " ; 
    echo " <a href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";
    
}
?>                                 
    </tbody>
</table>

<?php
if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = $post_id";
    $delete_post = mysqli_query($connection, $query);

    if(!$delete_post){
        die("MYSQL ERROR " .mysqli_error($connection));
    } else {
        echo "You successfully delete post from database";
        header("Location: posts.php");
    } 
}
?>

</form>

<style>
.select.form-control {
       text-indent: 16px;
}
</style>