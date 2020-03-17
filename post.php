<?php include "includes/db.php"; ?>

<?php include "includes/header.php"; ?> 

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">

                <?php 
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];

                }

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $select_all_post = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_post)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_comment_count = $row['post_comment_count'];
                          
                ?>

            
                <h1 class="page-header">
                    <?php
                    echo $post_title;
                    ?>
                    
                    <small>Secondary Text</small>
                </h1>
                
                <!-- First Blog Post -->
                         
                <h2>
                    <a href="#"></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                
                <hr>
                <p><?php echo $post_content; ?></p>
               
                
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <hr>

            <?php } ?>

            <!-- Comments Form -->

            <?php

            if(isset($_POST['create_comment'])){
                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() )";

                $create_comment = mysqli_query($connection, $query);
                if($create_comment){
                    echo "<h4 class='boja'>You're message has been send</h4>";
                }

    
            }
                ?>

            
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">

                    <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="comment_author" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="comment_email" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="comment">You're Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
                <hr/>

            <!-- Posted Comments -->

            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id AND comment_status = 'approved' ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query){
                die('Query Faild' .mysqli_error($connection));
            }

            $query = "UPDATE posts SET post_comment_count = $post_comment_count + 1 WHERE post_id = $the_post_id";
            $updated_comment_number = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
            
            ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4><?php echo $comment_content; ?>
                    </div>
                </div>

            <?php } ?>
            
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/sidebar.php"; ?>


        </div>
        </div>
        <!-- /.row -->

        <hr>
    </div>

<?php include "includes/footer.php"; ?>

<style>

.boja {
    color: red;
}
</style>
