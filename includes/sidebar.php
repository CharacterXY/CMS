<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<div class="col-md-4">

<!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="/edwin_cms/search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-primary" type="submit" value="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form><!-- search form -->
        <!-- /.input-group -->
    </div>

       
        <div class="well">

        <?php if(isset($_SESSION['user_role'])):  ?>  
        <?php $username = $_SESSION['username']; ?>

         <h4>Logged in as <a href=""><?php echo $username; ?></a>
        <h5>You want logged out ? </h5>
        <a href="includes/logout.php" class="btn btn-primary"> Logout</a>
        
        <?php else: ?>

        <h4>Login</h4>
        <form action="includes/login.php" method="post">
        <div class="form-gorup">
            <input name="username" type="text" class="form-control" placeholder="Enter Username">
        </div>
        <br />

        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter a password">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Login</button>
            </span>
        </div>
        <hr />
        <p>You're not member yet? <a href="registration.php">Register Me</a></p>

        </form><!-- search form -->
        <!-- /.input-group -->
    </div>

     <?php endif; ?>



    <!-- Blog Search Well -->
    
   <?php

    

    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);

    ?>

<hr />
<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">

            <?php

            while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                $cat_title = $row['category_name'];
                $cat_id = $row['category_id'];

                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";

            }

            ?>
                
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

    
<!-- Side Widget Well -->
  <?php include "widget.php"; ?>

</div>