<?php include "includes/admin_header.php"; ?>
<?php session_start(); ?>
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
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php  echo $_SESSION['data']; ?></small>
                           
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