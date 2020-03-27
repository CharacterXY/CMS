<?php include "includes/admin_header.php"; ?>
    <div id="wrapper">

    <?php

    if(isset($_SESSION['username'])){

        $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

    }
    }

    ?>
        <!-- Navigation -->

        <?php include "includes/admin_navigation.php"; ?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <div class=post_status">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>"">
        <?php echo "<br />"; ?>
    </div>


    <div class="form-group">
    
        <select name="user_role" id="">

    
           <option value="subscriber"><?php echo $user_role; ?></option>
           <?php
           if($user_role == 'admin'){
               echo "<option value='subscriber'>Subscriber</option>";
           } else {
               echo "<option value='admin'>Admin</option>";
           }

           ?>
       
        </select>

    </div>


  <!--   <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div>
 -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email"value="<?php echo $user_email; ?>"">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
    </div>
</form>


<?php 

   if(isset($_POST['edit_user'])){
  
   $user_firstname = $_POST['user_firstname'];
   $user_lastname = $_POST['user_lastname'];
   $user_role = $_POST['user_role'];
  /*  $user_image = $_FILES['user_image']['name'];
   $user_image_temp = $_FILES['user_image']['tmp_name']; */
   $username = $_POST['username'];
   $user_email = $_POST['user_email'];
   $user_password = $_POST['user_password'];
   
    

   //move_uploaded_file($user_image_temp, "../images/$user_image" ); 

   $query = "UPDATE users SET ";
   $query .="user_firstname = '{$user_firstname}', ";
   $query .="user_lastname = '{$user_lastname}', ";
   $query .="user_role = '{$user_role}', ";
   $query .="username = '{$username}', ";
   $query .="user_email = '{$user_email}', ";
   $query .="user_password = '{$user_password}' ";
   $query .="WHERE username = '{$username}' ";

   $update_user = mysqli_query($connection, $query);

   confirmQuery($update_user); 
  
}

?>


                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>


        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>


