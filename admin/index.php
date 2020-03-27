<?php include "includes/admin_header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("small").click(function(){
$(this).hide();
});
});
</script>

    <div id="wrapper">


<?php if($connection) echo "Connection established !"; ?> 


    <!-- Navigation -->

        <?php include "includes/admin_navigation.php"; ?>
       

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" >
                            Welcome to Admin
                            <small><?php  echo $_SESSION['username']; ?></small>

       
                <!-- /.row -->
                <hr />
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM posts ";
                        $select_all_posts = mysqli_query($connection, $query);
                        $numbers_of_posts = mysqli_num_rows($select_all_posts);
                    ?>
                  <div class='huge'><?php echo $numbers_of_posts; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-4x""></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM comments ";
                        $select_all_comments = mysqli_query($connection, $query);
                        $numbers_of_comments = mysqli_num_rows($select_all_comments);
                    ?>
                     <div class='huge'><?php echo $numbers_of_comments; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM users ";
                        $select_all_users = mysqli_query($connection, $query);
                        $numbers_of_users = mysqli_num_rows($select_all_users);
                    ?>
                    <div class='huge'><?php echo $numbers_of_users; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM categories ";
                        $select_all_categories = mysqli_query($connection, $query);
                        $numbers_of_categories = mysqli_num_rows($select_all_categories);
                    ?>
                        <div class='huge'><?php echo $numbers_of_categories; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
<?php
$query = "SELECT * FROM posts WHERE post_status = 'published' ";
$select_all_publish = mysqli_query($connection, $query);
$numbers_of_published_posts = mysqli_num_rows($select_all_publish);

$query = "SELECT * FROM posts WHERE post_status = 'draft' ";
$select_all_draft = mysqli_query($connection, $query);
$numbers_of_draft_posts = mysqli_num_rows($select_all_draft);

$query = "SELECT * FROM comments WHERE comment_status = 'unnaproved' ";
$select_all_unnaproved_comments = mysqli_query($connection, $query);
$numbers_of_unnaproved_comments = mysqli_num_rows($select_all_unnaproved_comments);

$query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
$select_all_subscriber = mysqli_query($connection, $query);
$numbers_of_subscriber_users = mysqli_num_rows($select_all_subscriber);

?>

<div class="row">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Count'],
        <?php  
        $element_text = ['Posts of Users', 'Draft Posts', 'Active Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Pending Comments'];
        $element_count = [$numbers_of_posts, $numbers_of_draft_posts, $numbers_of_published_posts, $numbers_of_categories, $numbers_of_users, $numbers_of_subscriber_users, $numbers_of_comments, $numbers_of_unnaproved_comments];

        for($i = 0; $i < 8; $i++){

            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

        }

        ?>
        ]);

        var options = {
          chart: {
            title: 'WEB PAGE DATA',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));

      }
    </script>

    <div id="columnchart_material" style="width: 1200px; height: 400px;"></div>
</div>


            </div>
 
                           <hr>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>

<style>
.ime {

    color: red;
}
</style>