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

    <?php

    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);

    ?>


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