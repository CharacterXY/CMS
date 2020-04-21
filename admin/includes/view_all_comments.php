
<?php

if(isset($_POST['checkAllComments'])){
   /*  echo "<pre>";
    print_r($_POST['checkAllComments']);
    echo "</pre>"; */
    foreach($_POST['checkAllComments'] as $valueId){

        if(isset($_POST['bulk_options'])){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){    
            case 'approved';
            $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$valueId} ";
            $comments_to_approve = mysqli_query($connection, $query);
            confirmQuery($comments_to_approve);
            break;
            case 'unapproved';
            $query = "UPDATE comments SET comment_status = {'$bulk_options}' WHERE comment_id = {$valueId} ";
            $comments_to_unapprove = mysqli_query($connection, $query);
            confirmQuery($comments_to_unapprove);
            break;
            case 'delete';
            $query = "DELETE FROM comments WHERE comment_id = {$valueId} ";
            $delete_comments = mysqli_query($connection, $query);
            confirmQuery($delete_comments);
            break;

            default:
            }        
        }       
    }
}

?>
<form action="" method="post">

<div id="bulkOptionsContainer" class="col-xs-4">
        <div class="form-group">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Option</option>
                <option value="approved">Approve</option>
                <option value="unnapproved">Unnapprove</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <hr />
        </div>
        
</div>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>    
            <th>Delete</th>  
            <th>Approve</th>
            <th>Unapprove</th>          
        </tr>
    </thead>
    <tbody>

<?php
$query = "SELECT * FROM comments";
$query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($query)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = $row['comment_content'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td><input class='checkedComments' type='checkbox' name='checkAllComments[]' value='{$comment_id}'></td>";
    echo "<td>{$comment_id}</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_content}</td>";
    echo "<td>{$comment_email}</td>";
    echo "<td>{$comment_status}</td>";
    $query_comment_to_post = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    $select_post_id = mysqli_query($connection, $query_comment_to_post);
    while($row = mysqli_fetch_assoc($select_post_id)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        
    }
    echo  "<td>{$comment_date}</td>";
    echo  "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
    echo  "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
    echo  "<td><a href='comments.php?delete=$comment_id'>DELETE</a></td>"; 

    echo "</tr>";

}
    
    /* $query_comments = "SELECT * FROM categories WHERE category_id = {$post_category_id} ";
    $post_category_id = mysqli_query($connection, $query_category);
                                        
    while($row = mysqli_fetch_assoc($post_category_id)){
    $cat_id = $row['category_id'];
    $cat_title = $row['category_name'];
    } */
    
 

?>                                 
    </tbody>
</table>

<?php

if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unnaproved' WHERE comment_id = $the_comment_id ";
    $unapproved_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}

if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    $approved_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");

}


if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
    $delete_post = mysqli_query($connection, $query);

    if(!$delete_post){
        die("MYSQL ERROR " .mysqli_error($connection));
    } else {   
        header("Location: comments.php");
        
    } 
}

?>
</form>